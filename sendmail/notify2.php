<?php

session_start();
 include '../admin/connection/connect.php';
    $elecid =$_SESSION['election_id'];
    $etitle = $_SESSION['election_title'];
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

if(isset($_POST['sendnotification'])){ 
   

            $sql = " SELECT * FROM `student` where election_id = '$elecid'  ";
                    $result = mysqli_query($con,$sql); // run query
                    $count= mysqli_num_rows($result); // to count if necessary
                   //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                
                     while($row = mysqli_fetch_array($result)){
                        $email = $row['email'];
                        $svid = substr($email, 0, strpos($email,'@'));
$mail->Username = 'wmsuiscvotingsystem@gmail.com'; // email
$mail->Password = 'WMSUISC_VotingSystem01'; // password
$mail->setFrom('wmsuiscvotingsystem@gmail.com', 'WMSU-ISC'); // From email and name
$mail->addAddress($email, $svid); // to email and name
$mail->Subject = $etitle.' Voting Starts';
$mail->msgHTML("
<h3>$etitle has started. You may log in and vote within the allotted period.</h3>


<h4>Always remember to make wise decisions. <br><br>Vote Wisely! Your vote matters!</h4>
");
                     }
       $updt = "UPDATE `election_sched` SET `notification`=2 WHERE  election_id = '$elecid'";
    mysqli_query($con,$updt);         
    
   
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

