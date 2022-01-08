 <?php 
 session_start();
 include 'connection/fetch_data.php';
  include 'connection/connect.php';
        //Restrict Adding Same Entry Data
        if(isset($_POST['btnsave'])) {
                       $email = $_POST['txtmail'];
                          $name = $_POST['txtname'];
                          $surname = $_POST['txtsurname'];
                          $middlename = $_POST['txtinit'];
                          $gender = $_POST['gender'];
                          $year = $_POST['yr'];
                          $course = $_POST['txtcourse'];

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

   $conditions = "`sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`,`year`, `date_registered`, `email`,`password`, `election_id`, `con`";
   $insertvalue = " '$svid','$name','$surname','$middlename','$gender','$course','$year','$datenow','$email','$pass','$elecid',1";
    $fetch = new Fetch_data();
    $fetch -> insertquery('student',$conditions,$insertvalue);
                
                      $sql = " select * from student where sv_id= '$svid'  ";
                       $result = mysqli_query($con,$sql); 
                      
                        while($row = mysqli_fetch_array($result)){
                            $defpass = $row['password'];
                        }
                       ?>
                             <input type="hidden" id="codsss" value="<?php echo $defpass;?>">
                                    <input type="hidden" id="emsss" value="<?php echo $email?>">  
                                     <script type="text/javascript">
                              
                                           var code = document.getElementById('codsss').value;
                                           var email = document.getElementById('emsss').value;
                                    
                                          loadDoc();
                                    
                                          function loadDoc() {
                                       var xhttp = new XMLHttpRequest();
                                      xhttp.onreadystatechange = function() {
                                       if (this.readyState == 4 && this.status == 200) {
                                      const data = this.responseText;
                                       
                                        // Your condition here if data success.
                                    
                                                   }
                                                };
                                        xhttp.open("GET", "../sendmail/emailsendpass.php?compare=1&code="+code+"&email="+email,true);
                                      
                                        xhttp.send();
                                            }
                                            
                                           
                                       
                
                                </script>
                       <?php
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
        header("location:save.php");
        }


        if (isset($_POST['btnsavesaveaccount'])){
          $id = $_SESSION['admin_id_token'];
                                   $ad_name = $_POST['ad_name'];
                                   $ad_user = $_POST['ad_user'];
                                   $ad_pass = $_POST['ad_pass'];
          if($ad_pass == '') {
              $updatedvalues = "`name` = '$ad_name',`user`='$ad_user' ";
   $wherecondition = "admin_id = '$id'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('admin',$updatedvalues,$wherecondition);
          }else {
              $updatedvalues = "`name` = '$ad_name',`user`='$ad_user',`pass`='$ad_pass' ";
   $wherecondition = "admin_id = '$id'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('admin',$updatedvalues,$wherecondition);

          } 
           $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       account <strong>updated Successfully!</strong>
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
                        
      ?>
      <script type="text/javascript">
        
       window.history.back();

              
      </script>
      <?php


        }

        if(isset($_POST['compare'])) {
          $val = $_POST['val'];

                $sql = " select * from admin where pass = '$val'  ";
                            $result = mysqli_query($con,$sql); 
                            $count= mysqli_num_rows($result);
                           
                     if($count == 1 ){
                      echo 'proceed';
                     }else {
                      echo 'wrong';
                     }
                      
        }
       ?>