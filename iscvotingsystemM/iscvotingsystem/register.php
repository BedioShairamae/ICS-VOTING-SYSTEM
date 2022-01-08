<?php 
session_start();
include 'admin/connection/connect.php';
 function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


date_default_timezone_set('Asia/Manila');
$datenows = date('Y-m-d H:i:s');
$ipreal = getUserIpAddr();


  $check = "select * from temp where ipaddress = '$ipreal' ";
        $resultcheck = mysqli_query($con,$check); // run query
                $countiptemp= mysqli_num_rows($resultcheck);
             if($countiptemp >= 1)  {
                 while($gettemp = mysqli_fetch_array($resultcheck)){
                    $tempid = $gettemp['tempid'];
                    $_SESSION['temp'] = $tempid;
                 }
             } else {
            $inserttemp = "INSERT INTO `temp`(`ipaddress`, `date-visited`) VALUES ('$ipreal','$datenows')";
            $tempres = mysqli_query($con,$inserttemp); 
			$get_id =  mysqli_insert_id($con);	
			$_SESSION['temp'] = $get_id;
             }
include 'admin/connection/connect.php';
include 'include/header.html'?>
			<body class="regback">

				<div class="container">
				<div class="row">
						 <div class="regform">
						 
						 <form method="post" action="registration_process.php">
						 	 
						 			
						 	 		<div class="row">
						 	 			 <div class="col-sm-3"></div> 
						 	 			 
						 	 			<div class="col-sm-6">
						 	 				<div class="card">
						 	 				  <div class="card-header">
						 	 				   <h3>Voters Registration</h3>
						 	 				
						 	 				  </div>
						 	 				  <div class="card-body">
						 	 				   <?php
						 	 				   if(isset($_SESSION['error'])) {
						 	 				   	echo $_SESSION['error'];
						 	 				   	unset($_SESSION['error']);

						 	 				   }

						 	 				   ?>

						 	 				<label>Enter Organization Email:
						 	 					</label>
						 	 					<span style="color: grey"><i class="fas fa-info-circle"></i> bg*****2021@wmsu.edu.ph</span>
						 	 					<input type="email" name="txtmail" id="checkforsimilar" class="form-control" autofocus="" required="">
						 	 					<span style="color: red" id="notify"></span>
						 	 				<br>

						 	 					<label>Enter Given Name:
						 	 					</label>
						 	 					<input type="text" name="txtname" class="form-control" required="">
						 	 						<br>
						 	 				<label>Enter Middle Name:
						 	 					</label>
						 	 					<input type="text" name="txtinit" class="form-control">
						 	 				<br>
						 	 				<label>Enter Surname:
						 	 					</label>
						 	 					<input type="text" name="txtsurname" class="form-control" required="">
						 	 				
						 	 				
						 	 				
						 	 				<br>
						 	 				<div class="row">
						 	 					<div class="col">
						 	 						<label>Gender :</label><select class="form-select" name="gender" required="">
						 	 						<option value="male">Male</option>
						 	 						<option value="female">Female</option>
						 	 						
						 	 					</select>
						 	 					
						 	 					</div>
						 	 					<div class="col">
						 	 						<label>Year:</label> <select class="form-select" name="yr" required="">
						 	 							<?php 
						 	 									$sql = " select * from year ";
						 	 							                $result = mysqli_query($con,$sql); 
						 	 							                $count= mysqli_num_rows($result); 
						 	 							              
						 	 							           
						 	 							                 while($row = mysqli_fetch_array($result)){
						 	 											?>
						 	 											<option value="<?php echo $row['yearid']; ?>"><?php echo $row['year']; ?></option>
						 	 											<?php
						 	 							                 }
						 	 							          
						 	 							 ?>
						 	 						
						 	 					
						 	 					</select>
						 	 					
						 	 					</div>
						 	 				</div>
						 	 				

						 	 					<label>Course</label> 
						 	 					<select style="margin-top: 10px;" class="form-select" name="txtcourse" required="">
						 	 						<?php 
						 	 									$sqls = " select * from course";
						 	 							                $results = mysqli_query($con,$sqls); 
						 	 							              
						 	 							              
						 	 							           
						 	 							                 while($row = mysqli_fetch_array($results)){
						 	 											?>
						 	 											<option value="<?php echo $row['courseid']; ?>"><?php echo $row['course']; ?></option>
						 	 											<?php
						 	 							                 }
						 	 							          
						 	 							 ?>
						 	 						
						 	 					</select>
						 	 					<br>
						 	 					<label>Select Section:
						 	 					</label>
						 	 				
						 	 					<select class="form-select" name="txtsection">
						 	 							 <?php 
											                    $sql = " select * from section ";
											                            $result = mysqli_query($con,$sql);
											                         
											                         
											                             while($row = mysqli_fetch_array($result)){
											                      ?>
											                       <option value="<?php echo $row['sec_id'] ?>"><?php echo $row['section'] ?></option>
											                      <?php
											                             }
											                   ?>
						 	 					</select>
						 	 				
						 	 				<br>
						 	 				
						 	 				  </div>
						 	 				   <div class="card-footer">
						 	 				   	<button style="height: 40px;" type="submit" name="btnregister" id="reg" class="btn btn-success form-control">Register</button>
						 	 				   </div> 
						 	 				   
						 	 				</div>
						 	 				
										 	
						 	 			</div>
						 	 			<div class="col-sm-3" >
						 	 					
						 	 			</div>
						 	 		</div>
						    	

						 </form>
						</div> 


				</div>
				</div>
	
				<script type="text/javascript">
					
					  $(document).ready(function() {
					 	     $('#checkforsimilar').keyup(function(){ 
					 	      var value = $(this).val();


					 	      $.ajax({
					 	                url : "verify.php",
					 	                 method: "POST",
					 	                  data  : {checkforsimilar:1,values:value},
					 	                  success : function(data){

					 	                  	if (value == '') {
					 	                  		$('#reg').attr('disabled',true);
					 	                  		$('#notify').html('');
					 	                  		$('#checkforsimilar').attr('style','border:1px solid #ced4da');
					 	                  	}else {
					 	                  			if(data =='exist'){
					 	     						$('#notify').html('*This Email is already taken.');
					 	     						$('#reg').attr('disabled',true);
					 	     						$('#checkforsimilar').attr('style','border:1px solid red');

					 	     					}else if(data== 'proceed'){
					 	     						$('#notify').html('');
					 	     						$('#reg').removeAttr('disabled');
					 	     						$('#checkforsimilar').attr('style','border:1px solid #ced4da;background-color:#ccf2d9');
					 	     					}else if (data =='notmatch') {
					 	     						$('#notify').html('*This Email is not valid. Please use WMSU Email only.');
					 	     						$('#reg').attr('disabled',true);
					 	     						$('#checkforsimilar').attr('style','border:1px solid red');
					 	     					}else if (data == 'match') {
					 	     						$('#notify').html('');
					 	     						$('#reg').removeAttr('disabled');
					 	     					}
					 	                  	}

					 	     				

					 	                  }
					 	               })
					 	     })
					 	      
					 	      				
					 	            	      	 
					 	     
					 	     });      
					 	          	     
				      	
				</script>

</body>
<?php include 'include/footer.html'?>
