<?php
session_start();
include 'admin/connection/connect.php';
include 'admin/connection/fetch_data.php';
$fetch = new Fetch_data();

	if(isset($_POST['txtmail'])) {
										$email = $_POST['txtmail'];
						 	 						$name = $_POST['txtname'];
						 	 						$surname = $_POST['txtsurname'];
						 	 						$middlename = $_POST['txtinit'];
						 	 						$gender = $_POST['gender'];
						 	 						$year = $_POST['yr'];
						 	 						$course = $_POST['txtcourse'];
													$tempid = $_SESSION['temp'];
													$txtcode = $_POST['txtcode'];
													$txtsection = $_POST['txtsection'];
					$svid = substr($email, 0, strpos($email,'@'));
					$elecid= $_SESSION['election_id'];
	
		
							$sqlses = " select * from temp where tempid = '$tempid'  ";
									             	                $results = mysqli_query($con,$sqlses); // run query
									             	               
									             	                 while($row = mysqli_fetch_array($results)){
									             							$code = $row['code'];
					  }
		
		if($txtcode == '') {
			echo '<div class="alert alert-danger" id="error1" style="cursor: default;" role="alert">
											 <h6><strong>Unknown value or Input is Null</strong></h6>
											</div>
											<script>
											setInterval(function(){
						 						document.getElementById("error1").classList.add("d-none");
						 					},5000);
						 					</script>

											';
		}else if($txtcode == $code)


		{
				
	 date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');

   $conditions = "`sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`,`year`,`section`, `date_registered`, `email`,`logintype`, `election_id`,`con`";
   $insertvalue = " '$svid','$name','$surname','$middlename','$gender','$course','$year','$txtsection','$datenow','$email','personal','$elecid' ,1 ";
    $fetch = new Fetch_data();
    $fetch -> insertquery('student',$conditions,$insertvalue);
			echo '<div class="alert alert-success" style="cursor: default;" role="alert">
											 <h6><strong>Verified and Registered Successfully ..Redirecting <i class="fas fa-spinner fa-pulse"></i> </h6>
											</div>

											<script>
											setInterval(function(){
						 						
						 						window.location.href="upload.php?updateaccount_photo&email='.$email.'";
						 					},4000);
						 					</script>

											';

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
						$s = createRandomPassword();
						 $updatedvalues = "`password` = '$s'";
						   $wherecondition = "sv_id = '$svid'";
						    $fetch = new Fetch_data();
						    $fetch -> updatequery('student',$updatedvalues,$wherecondition);
						    
						     $gethtecode = "select * from student where sv_id = '$svid'";
                                $getcode = mysqli_query($con,$gethtecode); 
                                while($rowcode = mysqli_fetch_array($getcode)){ 
                                        $codess = $rowcode['password'];
                                }
						    ?>
						         <input type="hidden" id="codess" value="<?php echo $codess;?>">
                                    <input type="hidden" id="emss" value="<?php echo $email?>">  
                                     <script type="text/javascript">
                              
                                           var code = $('#codess').val();
                                           var email = $('#emss').val();
                                    
                                          loadDoc();
                                    
                                          function loadDoc() {
                                       var xhttp = new XMLHttpRequest();
                                      xhttp.onreadystatechange = function() {
                                       if (this.readyState == 4 && this.status == 200) {
                                      const data = this.responseText;
                                       
                                        // Your condition here if data success.
                                    
                                                   }
                                                };
                                        xhttp.open("GET", "sendmail/emailsendpass.php?compare=1&code="+code+"&email="+email,true);
                                      
                                        xhttp.send();
                                            }
                                            
                                           
                                       
                
                                </script>
						    <?php

		}	else {
			echo '<div class="alert alert-danger" id="error1" style="cursor: default;" role="alert">
											 <h6><strong>Invalid Code</strong></h6>
											</div>
											<script>
											var timer = setInterval(function(){
						 						document.getElementById("error1").classList.add("d-none");
						 						clearInterval(timer);
						 					},3000);
						 					</script>
';
		}
		

	}
	if(isset($_POST['resend'])) {

	}

	if(isset($_POST['checkforsimilar'])) {
		
		$values = $_POST['values'];
		$elec = $_SESSION['election_id'];

				 if (preg_match("~@wmsu\.edu.ph$~",$values)){
									
								$sql = " select * from student where email = '$values' and election_id = '$elec'  ";
			                $result = mysqli_query($con,$sql); 
			                $count= mysqli_num_rows($result); 
			              
			             if ($count==1){
			             	echo 'exist';
			           
						          }else {
						          	echo 'proceed';

						          }

								} else {
									echo 'notmatch';
								}
		
					
	}
	
	

?>