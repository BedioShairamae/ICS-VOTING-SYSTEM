<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



include 'PHPMailer/Exception.php';
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP(); 

$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;

if(isset($_POST['compare'])) {
        include '../admin/connection/connect.php';
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $course = $_POST['course'];
        $section = $_POST['section'];
       
        $svid = substr($email, 0, strpos($email,'@'));
       
        
                                         $sectionqry = " select * from year where yearid = '$section' ";
                                                        $resultsectionqry = mysqli_query($con,$sectionqry);
                                                     
                                                     
                                                         while($getsec = mysqli_fetch_array($resultsectionqry)){
                                                        $seksyon = $getsec['year'];
                                                         }

                                                         $courses = " select * from course where courseid = '$course'  ";
                                                              $resulta = mysqli_query($con,$courses);
                                                            
                                                            
                                                               while($getcourse = mysqli_fetch_array($resulta)){
                                                                   $kurso=  $getcourse['course'];
                                                               }
                  

  
$mail->Username = 'wmsuiscvotingsystem@gmail.com'; // email
$mail->Password = 'WMSUISC_VotingSystem01'; // password
$mail->setFrom('wmsuiscvotingsystem@gmail.com', 'WMSU-ISC'); // From email and name
$mail->addAddress($email,$svid); // to email and name
$mail->Subject = 'Greetings';
$mail->msgHTML("
<h3>Good day! Mr/Mrs $fullname, </h3>
<br>
<h4>Your log-in details are : <br><br> Email : $email <br><br> Password : $password</h4>
<h4>
You are completely registered as an adviser for  <span style='font-weight:Bolder'> $kurso - $seksyon </span>  at ISCVOTING SYSTEM. You've been given a task of verifying their registration and validity under your class advisee.
 </h4>



<h4><br>Thank you!<br></h4>
");

  }
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
if(!$mail->send()){
    echo "Mailer Error: " ;
}else{
    //echo "Message sent!";
}
?>

