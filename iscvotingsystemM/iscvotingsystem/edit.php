<?php 
session_start();
	if(isset($_POST['edit_account'])) {
	include 'admin/connection/connect.php';
		$surname = $_POST['surname'];
		$mname = $_POST['mname'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$course = $_POST['course'];
		$year = $_POST['year'];
		$gender = $_POST['gender'];
		$password = $_POST['password'];
		$section = $_POST['section'];

			?>
			
			    
			    	
			    	
			    				<label>Organization Email :
						 	 					</label><br>
						 	 					<span style="color: grey;font-size: 14px;"><i class="fas fa-info-circle"></i> Unable to Edit email . As this is verifed and considered as your identity and registration id</span>
						 	 					<input style="cursor:not-allowed;" type="text" name="txtemail" value="<?php echo $email?>" class="form-control" style="font-size: 16px;" disabled>
						 	 				
						 	 				
						 	 				<label>Edit Name :</label>
						 	 					<input type="text" name="txtname" value="<?php echo $name?>" class="form-control" style="font-size: 16px;" required>
						 	 					<label>Edit Surname :</label>
						 	 					<input type="text" name="txtsurname" value="<?php echo $surname?>" class="form-control" style="font-size: 16px;" required>
						 	 					<label>Edit Middle Name :</label>
						 	 					<input type="text" name="txtmname" value="<?php echo $mname?>" class="form-control" style="font-size: 16px;" required>
						 	 				
						 	 				<div class="row">
						 	 					<div class="col">
						 	 						<label>Gender :</label><select class="form-select" name="gender" required="">
						 	 							<option value="<?php echo $gender?>"><?php echo $gender?></option>
						 	 						<option value="male">Male</option>
						 	 						<option value="female">Female</option>
						 	 						
						 	 					</select>
						 	 					
						 	 					</div>
						 	 				
						 	 					</div>
						 	 				<div class="col">
                          <label>Year:</label> <select class="form-select" name="yr" required="" style="font-size: 13px;">
                           
                          <?php 
                           $sqlsis = " select * from year where yearid = '$year' ";
                                            $resultsis = mysqli_query($con,$sqlsis); 
                                          
                                          
                                       
                                             while($rowss = mysqli_fetch_array($resultsis)){
                                    ?>
                                    <option value="<?php echo $rowss['yearid']; ?>"><?php echo $rowss['year']; ?></option>
                                    <?php
                                             }
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
                          $sqlsi = " select * from course where courseid = '$course' ";
                                            $resultsi = mysqli_query($con,$sqlsi); 
                                          
                                          
                                       
                                             while($rows = mysqli_fetch_array($resultsi)){
                                    ?>
                                    <option value="<?php echo $rows['courseid']; ?>"><?php echo $rows['course']; ?></option>
                                    <?php
                                             }


                                $sqls = " select * from course ";
                                            $results = mysqli_query($con,$sqls); 
                                          
                                          
                                       
                                             while($row = mysqli_fetch_array($results)){
                                    ?>
                                    <option value="<?php echo $row['courseid']; ?>"><?php echo $row['course']; ?></option>
                                    <?php
                                             }
                                      
                             ?>
                        </select>   
                        <br>
                        <label>Edit Section :</label>
                       
                       
                          <select class="form-select" name="txtsection" style="font-size: 16px;" required >
                        	 <?php 
                         $sectionqry = " select * from section where sec_id='$section' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		$gettsec= $getsec['section'];
							                     		$gettsecid = $getsec['sec_id'];

							                     			?>
							                     			<option value="<?php echo $gettsec ?>"><?php echo $gettsec ?></option>
							                     			<?php
							                     		

							                             }

							   $sectionqrys = " select * from section  ";
							   $resultsectionqrys = mysqli_query($con,$sectionqrys);
							                         
							                         
							  while($getsecs = mysqli_fetch_array($resultsectionqrys)){
							                     		$gettsec= $getsecs['section'];
							                     		$gettsecid = $getsecs['sec_id'];

							                     			?>
							                     			<option value="<?php echo $gettsec ?>"><?php echo $gettsec ?></option>
							                     			<?php
							                     		

							                             }
							                   

                         	?>
                        	</select>
						 
                        <br>


						 	 				<label>Change Password? click <a style="text-decoration: none" href="passwordchange.php">CHANGE</a></label>
						 	 				<input type="password" name="txtpass" value="<?php echo $password?>" class="form-control">
						 	 				<br>		
						 	 					
						 	 				<a id="cancelbtn" href="myaccount.php" >Cancel</a>	<button type="submit" name="btneditsave">Save</button> 
			

			<?php

	}


if(isset($_POST['btneditsave'])) {
	include 'admin/connection/connect.php';
			$studid = $_SESSION['voter_login'];
			$name = $_POST['txtname'];
			$txtsurname = $_POST['txtsurname'];
			$txtmname = $_POST['txtmname'];
			$gender = $_POST['gender'];
			$course = $_POST['txtcourse'];
			$yr = $_POST['yr'];
			$txtsection = $_POST['txtsection'];

			
		$sql = " UPDATE `student` SET `name`='$name',`surname`='$txtsurname',`middle_name`='$txtmname',`gender`='$gender',`course`='$course' ,`year` = '$yr',`section`='$txtsection'  WHERE s_id='$studid'  ";
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
?>