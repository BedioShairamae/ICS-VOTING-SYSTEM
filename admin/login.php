<?php 
session_start();
include 'connection/connect.php';
	if(isset($_POST['txtuser'])) {
			$user = $_POST['txtuser'];
			$password = $_POST['txtpass'];

						$sql = " select * from admin where user = '$user' and pass= '$password'  ";
				                $result = mysqli_query($con,$sql); 
				                $count= mysqli_num_rows($result); 
				             
				             if ($count==1){
				             echo '<div class="alert alert-success" role="alert">
								 <strong>Success</strong>
								</div>';
								 while($user = mysqli_fetch_array($result)){ 
								 	$_SESSION['admin_id_token'] = $user['admin_id'];

								 }
										$selectsched = " select * from election_sched where status = 'active'  ";
								                $resultselect = mysqli_query($con,$selectsched); 								           
								                 while($row = mysqli_fetch_array($resultselect)){
								                 	$_SESSION['electsched'] = $row['election_id'];
								                 	$_SESSION['eventenddowns'] = $row['eventend'];
								                 
								                 }
								         

				          }else {
			echo '<div class="alert alert-danger" role="alert">
								 <strong>UnKnown Credentials</strong>
								</div>';
							}
	}
?>