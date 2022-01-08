<?php
session_start();
 include 'admin/connection/connect.php';
	if(isset($_POST['btneditsave'])) {
			
		
			
                
            ///This will save 1 image only
             
               foreach($_FILES['images']['name'] as $key=>$val){
                  $image_name = $_FILES['images']['name'][$key];
                   $tmp_name   = $_FILES['images']['tmp_name'][$key];
                $size       = $_FILES['images']['size'][$key];
                 $type       = $_FILES['images']['type'][$key];
                 $error      = $_FILES['images']['error'][$key];
                                                                                                                                    
             
                                                                                                                                    
           $fileName =basename($_FILES['images']['name'][$key]);
                                                                                                                                    
            $pname = 'Photo'.'_'.$fileName;
                // File upload path
            $uploads_dir = 'upload/';
             move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);
      
                  
      
      $studid = $_SESSION['voter_login'];
      $name = $_POST['txtname'];
      $txtsurname = $_POST['txtsurname'];
      $txtmname = $_POST['txtmname'];
      $gender = $_POST['gender'];
      $course = $_POST['txtcourse'];
      $yr = $_POST['yr'];

      
    $sql = " UPDATE `student` SET `name`='$name',`surname`='$txtsurname',`middle_name`='$txtmname',`gender`='$gender',`course`='$course',`year` = '$yr' ,`photo` = '$pname'  WHERE s_id='$studid'  ";
                        $result = mysqli_query($con,$sql); 
                        if($result) {
                          $_SESSION['alerto'] = '<div class="alert alert-primary" id="noti" role="alert" style="text-align: center;">
                      <strong >Account Updated Successfully!</strong>
                    </div>
                    <script type="text/javascript">
                      
                      var timer =setInterval(function(){
                        document.getElementById("noti").classList.add("d-none");
                        clearInterval(timer);
                      },3000);      
                            
                    </script>';
                    header("location:myaccount.php");
                        }
                    
}
}


if(isset($_POST['savetrigger'])){ 
  $email = $_POST['email'];

        //Make the imagename array set at form. look likes this name="imagename[]"
      foreach($_FILES['imagename']['name'] as $key=>$val){
                      $image_name = $_FILES['imagename']['name'][$key];
                       $tmp_name   = $_FILES['imagename']['tmp_name'][$key];
                    $size       = $_FILES['imagename']['size'][$key];
                     $type       = $_FILES['imagename']['type'][$key];
                     $error      = $_FILES['imagename']['error'][$key];
                                                                                                                                        
                 
                                                                                                                                        
               $fileName =basename($_FILES['imagename']['name'][$key]);
                     $rand = rand(100,1000);                                                                                                                   
                $pname = $rand.'Photo'.'_'.$fileName;
                    // File upload path
                $uploads_dir = 'upload/';
             move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);
                 
                     
                 $sql = " SELECT * FROM `student` where email ='$email' ";
                             $result = mysqli_query($con,$sql); // run query
                            
                              while($row = mysqli_fetch_array($result)){
                            $sid = $row['s_id'];
                              }
                      
                              
                      $updatephoto = "UPDATE `student` SET `photo`='$pname' WHERE s_id = '$sid' ";
                        $uptres =  mysqli_query($con,$updatephoto);                                                                                                 
             
                }
    
    
                
  
}

?>