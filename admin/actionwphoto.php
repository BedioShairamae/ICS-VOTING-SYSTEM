<?php
 session_start();
 include 'connection/fetch_data.php';
  if(isset($_POST['btnsave'])) {
                       $email = $_POST['txtmail'];
                          $name = $_POST['txtname'];
                          $surname = $_POST['txtsurname'];
                          $middlename = $_POST['txtinit'];
                          $gender = $_POST['gender'];
                          $year = $_POST['yr'];
                          $course = $_POST['txtcourse'];
                          

		
                
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
            $uploads_dir = '../upload';
             move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);
                
         $svid = substr($email, 0, strpos($email,'@'));
        $course_year = $course .'-'.$year;
    date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');
$elecid =$_SESSION['electsched'];
   function createRandomPassword() { 

						    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
						    srand((double)microtime()*1000000); 
						    $i = 0; 
						    $pass = '' ; 

						    while ($i <= 7) { 
						        $num = rand() % 33; 
						        $tmp = substr($chars, $num, 1); 
						        $pass = $pass . $tmp; 
						        $i++; 
						    } 

						    return $pass; 

						} 
						$pass = createRandomPassword();
   $updatedvalues = "`sv_id`='$svid',`name`='$name',`surname`='$surname',`middle_name`='$middlename',`gender`='$gender',`course`='$course',`year`='$year',`email`='$email',`election_id`='$elecid',`photo` = '$pname' ";
   $wherecondition = "sv_id = '$sv_id'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('student',$updatedvalues,$wherecondition);
    echo $course.$year;
    
     $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
        New Voter <strong>Saved Successfully!</strong>
      </div>
      <script type="text/javascript">
       
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }   

              
      </script>';
        header("location:voters.php");
                                        
                                                                                                                            
         
            }

        }
      



 if(isset($_POST['btnedit'])) {
           $email = $_POST['txtmail'];
                          $name = $_POST['txtname'];
                          $surname = $_POST['txtsurname'];
                          $middlename = $_POST['txtinit'];
                          $gender = $_POST['gender'];
                          $year = $_POST['yr'];
                          $course = $_POST['txtcourse'];
 $sv_id = $_POST['svsid'];
           $svid = substr($email, 0, strpos($email,'@'));
                          $course_year = $course .'-'.$year;

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
            $uploads_dir = '../upload';
             move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);

 
 $updatedvalues = "`sv_id`='$svid',`name`='$name',`surname`='$surname',`middle_name`='$middlename',`gender`='$gender',`course`='$course',`year`='$year',`email`='$email',`photo`='$pname',`election_id`='1'";
   $wherecondition = "s_id = '$sv_id'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('student',$updatedvalues,$wherecondition);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
      Voter Data <strong>Updated Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:voters.php');                  

        }
      }


?>