<?php 
session_start();
include 'admin/connection/connect.php';
	if(isset($_POST['txtemail'])) {
		
		$email = $_POST['txtemail'];
		$pass = $_POST['txtpass'];
			//Check if election has started or not yet
		$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                 							
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];	
              
               $eventstart = $active['eventstart'];
               $eventend = $active['eventend'];		
               $_SESSION['election_title'] = $active['title'];
               $_SESSION['election_id'] = $electid;
               $_SESSION['eventenddown']= $eventend;
               $_SESSION['electionyear'] = $active['year'];
               											
         }
			
				$sql = " select * from student where email = '$email' and password = '$pass' and election_id ='$electid'  ";
		                $result = mysqli_query($con,$sql); 
		                $count= mysqli_num_rows($result);
		               
		           	if($count == 1) {
		           	    
		                             while($row = mysqli_fetch_array($result)){
											 	$_SESSION['voter_login'] = $row['s_id'];
											 	$sid = $row['s_id'];
											 	$_SESSION['greetvotername']= $row['name'];
											 	$_SESSION['useremail']= $row['email'];
											 	$gender = $row['gender'];
											 	$toupdate = $row['toupdate'];
											 	if($toupdate == 1){
											 		$_SESSION['toupdatetriggercheckvalidity']=1;
											 	}

											 	$OTP = rand(1000,9000);

											 	$entercode = "UPDATE `student` SET `logincode`='$OTP' WHERE s_id='$sid' ";
											 	mysqli_query($con,$entercode);


											 	if($gender=='male'){
											 		$_SESSION['abbr'] = 'Mr.';
											 	}else {
											 		$_SESSION['abbr'] = 'Ms.';
											 	}
                                                $detect = $row['con'];
                 								}
		                if($detect == 1) {
		                   	echo '<div class="container"><div class="alert alert-info" role="alert"> <h6><strong>Login Successfully ✓</strong></h6></div></div>
		           		<script type="text/javascript">
		           			
		           			setInterval(function(){
		           				window.location.href="passwordchange.php?change_your_Default_password";
		           				},1000);      
		           		      	
		           		</script>
		           		';

		           		$_SESSION['otpgood']=1;
		           	
		                }

		                else {
		                   
		                    	echo '<div class="container"><div class="alert alert-info" role="alert"> <h6><strong>Login Successfully ✓</strong></h6></div></div>
		           		<script type="text/javascript">
		           			
		           			setInterval(function(){
		           				window.location.href="otp.php";
		           				},1000);      
		           		      	
		           		</script>
		           		';
		                }
		               
		           	
		           		
											

                 											
                 									          
		           	}else {

		           				$checkadviser = "SELECT * FROM `adviser` where email = '$email' and password = '$pass' ";
		           				 $resultadv = mysqli_query($con,$checkadviser); 
		                			$countadv= mysqli_num_rows($resultadv);

		                			if($countadv == 1) {
		                				 while($row = mysqli_fetch_array($resultadv)){
											 	$_SESSION['adviser_login'] = $row['adv_id'];
											 	$_SESSION['scopesection'] = $row['scope_section'];
											 	$_SESSION['scopecourse'] = $row['scope_course'];
											 	$_SESSION['changepassword'] = $row['changepass'];

                                               
                 								}
                 								echo '<div class="container"><div class="alert alert-info" role="alert"> <h6><strong>Login Successfully ✓</strong></h6></div></div>
		           		<script type="text/javascript">
		           			
		           			setInterval(function(){
		           				window.location.href="adviser/";
		           				},1000);      
		           		      	
		           		</script>
		           		';
		                			}else {
		                				echo '<div class="container">
								 		   
								 		    <div class="alert alert-danger" role="alert">
											 <h6><strong>Unknown Email or Password .</strong></h6>
											</div>

											</div> 
											<script>
											var timer = setInterval(function(){
												$(".alert").addClass("d-none");
												clear();
												},3000);
												function clear(){
													clearInterval(timer);
												}
											</script>

											';
		                			}


		           		

		              }  

	//	header('location:home.php');
	}

	if(isset($_POST['confirm'])){ 
		$otp = $_POST['otp'];
		$sid = $_SESSION['voter_login'];

	

				$sql = " SELECT * FROM `student` where s_id = '$sid' and logincode='$otp'  ";
		                $result = mysqli_query($con,$sql); 
		                $count= mysqli_num_rows($result); 
		             
		             if ($count==1){
		             $_SESSION['otpgood']=1;

		             echo "good";	
		          }else {
		          		echo "wrong";
		          }
		
	}
		           
?>
		  
          