<?php

	class Fetch_data
	{
		
			function get_candidates() {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
							$sql = " select * from temp_votes where election_id = '$electid'  ";
					                $result = mysqli_query($con,$sql); 
					                $count= mysqli_num_rows($result); 
					          $notverified = false;    
					             if ($count>=1){
					             	
					                 while($row = mysqli_fetch_array($result)){
					                 	$s_id = $row['sv_id'];
					                 	$posid = $row['posid'];
					                 	$advocacy = $row['advocacy'];
					                 	$voters = $row['voters'];
					                 	$partylist= $row['partylist'];
					                 	$cid = $row['tmpvote_id'];

					                 	?>
								                 	<p></p>
							<div class="row candidatecard" >	
			                    				<div class="card " style="height: auto">
			                    					
			                    					<div class="card-body">
			                    						<span class="positions">
			                    							<?php
			                    										$getname = " select * from position where pos_id = '$posid' and election_id ='$electid'  ";
			                    								                $resultgetname = mysqli_query($con,$getname); 
			                    								             
			                    								                 while($name = mysqli_fetch_array($resultgetname)){
			                    													echo 'For '.$name['pos_name'];
			                    													$posname = $name['pos_name'];
			                    													$nowinn = $name['pos_noofwinner'];
			                    													$countofvote = $name['maxvote'];
			                    								                 }
			                    								          
			                    							?>
			                    						</span>
			                    						  <div class="container">
			                    						  	 <div class="row">

			                    						     <?php
			                    										$getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
			                    								                $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    								                 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	$photo = $uname['photo'];
			                    								                 	$gender = $uname['gender'];
			                    								                 	if($photo == '') {
			                    								                 		
			                    								                 		  if($gender == 'male'){
												                                          $imgsrc = $src.'undraw_profile_pic_ic5t.png';
												                                        }else {
												                                            
												                                         
												                                             $imgsrc = $src.'undraw_female_avatar_w3jk.png';
												                                        }
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
				 	 	                 											$section = $uname['section'];

			                    													?>
			                    													<div class="col-sm-3">
			                    						  	 		
			                    						  <img src="<?php echo $imgsrc ?>" style="width: 120px;height: 120px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" >
			                    						</div>
			                    						  	 
			                    						  	 <div class="col-sm-4 candidate-data">
			                    						     <h4><span>For</span> <?php echo $posname ?></h4>
			                    													<h3><?php echo $uname['surname'].' '.$uname['name'] ?></h3>
													   								<h5>
													   									<?php 
										      		$course = " select * from course where courseid = '$courseid'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						echo $getcourse['course'];
										      						
										                       }
										                

										      echo '-'; 

										      $year = " select * from year where yearid = '$yearid'  ";
										                      $resultas = mysqli_query($con,$year);
										                    
										                    
										                       while($getyear = mysqli_fetch_array($resultas)){
										      						echo $getyear['year'];
										                       }
										      
										                        $sectionqry = " select * from section where sec_id = '$section' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		echo $getsec['section'];
							                             }
										       ?>
										      <br>
										      PARTYLIST :
										       <span style="font-weight: bold;">
										       	<?php 

										       	 $prtylist = " select * from `partylist` where party_id = '$partylist' ";
							                            $resultprtylist = mysqli_query($con,$prtylist);
							                         
							                         
							                             while($getpt = mysqli_fetch_array($resultprtylist)){
							                     		echo $getpt['partylist'];
							                             }

										        ?></span>
													   								</h5>
			                    													<?php
			                    								                 }
			                    								          
			                    							?>
													   		
			                    								<?php 
			                    								$studentid = $_SESSION['voter_login'];
			                    										$studentverificationcheck = "select * from student where s_id='$studentid' ";
			                    								                $verifying= mysqli_query($con,$studentverificationcheck); // run query
			                    								               
			                    								                 while($getinfo = mysqli_fetch_array($verifying)){
			                    													$studentvalidity = $getinfo['isverified'];
			                    								                 }

			                    								         if($studentvalidity == 0) {
			                    								         	 $notverified = true; 


			                    								         	

			                    								         } else {






			                    								$selectactive = " select * from election_sched where election_id = '$electid'  ";
														        $resultselect = mysqli_query($con,$selectactive); 
														                 							
														         while($active = mysqli_fetch_array($resultselect)){
														               $electid = $active['election_id'];
														               $checken = $active['voterlogin'];
														               
														               $eventstart = $active['eventstart'];
														               $eventend = $active['eventend'];		
														               }
														               date_default_timezone_set('Asia/Manila');
														               $dateandtime = date("Y-m-d H:i:s");
														             
														               if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														          ?>
														           <div class="card border-secondary" style=";width: 240px">
														           	 <div class="container">	 
														           	<p></p>
														           	<h6>Election has not yet STARTED</h6>
														           	<p></p>
														           	 </div> 
														           </div> 
														           
														          <?php
														               }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														          ?>
														           <div class="card border-secondary" style="width: 240px">
														           	 <div class="container">	 
														           	<p></p>
														           	<h6>Election has not yet STARTED</h6>
														           	<p></p>
														           	 </div> 
														           </div> 
														           
														          <?php
														               }
														                else if($eventstart <= $dateandtime && $eventend > $dateandtime ) {
														          
																		   	$vid = $_SESSION['voter_login'];             	
																			          
																			         
																			           	  $checkvotess = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotess = mysqli_query($con,$checkvotess); 
																		                $countvoterss= mysqli_num_rows($resultcheckvotess); 
																		                 if($countofvote >=$countvoterss) {
																		                 		 $checkvotesse = " select * from temp_votes where election_id = '$electid' and tmpvote_id='$cid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotesse = mysqli_query($con,$checkvotesse); 
																		                $countvotersse= mysqli_num_rows($resultcheckvotesse); 
																		                		if($countvotersse >=1) {


																		                					?>
																		                <!--	<div class="card " style="width:100%;text-align: center;border-radius: 50px; margin-top: 50px;">
																			           	 <div class="container">	 
																			           	<p></p>
																		    <h1 style=" color: rgb(11, 57, 11);"><i class="fas fa-check-circle"></i><br><span style="font-size: 14px;color: black">VOTED</span></h1>

																			           	<p></p>
																			           	 </div> 
																			           </div>
																			           <h1 style="font-weight: bolder;background-color: rgb(11, 57, 11);
   color: white;text-align: center;user-select: none;padding: 10px;">VOTED <br><a style="font-size: 20px;color:#ddc9cc	;background-color: #950a1f;padding:5px; border-radius: 5px;text-decoration: none;color: white" href="javascript:void()" class="btncancelvote btncancelvote1"data-cid="<?php echo $row['tmpvote_id']; ?>" data-fullname="<?php echo $fullname ?>">CANCEL</a></h1>-->
   		
   		
   		 <div class="card shadow-sm">
   		 	 <div class="card-body" style="text-align: center;">
   		 	 	<span  ><i class="fas fa-circle"></i></span>
   		 	 	<span style="font-size: 14px;font-weight: bold;">VOTED</span>

   		 	 	<button class="btn btn-light  btncancelvote1" data-cid="<?php echo $row['tmpvote_id']; ?>" data-fullname="<?php echo $fullname ?>" style="font-size: 12px;float: right;"><i class="fas fa-times text-danger"></i></button>
   		 	 </div> 
   		 	 
   		 </div> 
   		 

																		                	<?php
																		                		}else {
																		                			if($countvotersse <= $countofvote) {
																		                				
																		                			
																					           		 $checkvotesser = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																					                $resultcheckvotesser = mysqli_query($con,$checkvotesser); 
																					                $countvotersser= mysqli_num_rows($resultcheckvotesser);
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotesser)){
																					                		$possid = $rowget['posid'];

																					                		
																					                	       }
																					                	        $checkvotessert = " select * from position where election_id = '$electid' and pos_id ='$posid'  ";
																					                $resultcheckvotessert = mysqli_query($con,$checkvotessert); 
																					               
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotessert)){
																					                		$maxboto = $rowget['maxvote'];
																					                		
																					                	       }
																					               

																					               if( $countvotersser >= $maxboto) {
																					               	?>
																		                	<!--<div class="card " style="width:100%;text-align: center;border-radius: 50px; margin-top: 50px;">
																			           	 <div class="container">	 
																			           	<p></p>
																		                		<h6>You Have already  casted your vote for the position of <?php echo $posname  ?></h6>
																			           			<br>
																			           				<p></p>
																			           	 </div> 
																			           </div>
																			            <h5 style="font-weight: bolder;background-color:rgb(11, 57, 11);
   									color: white;text-align: center;user-select: none;padding: 15px;">You Have already  casted your vote for the position of <?php echo $posname  ?></h5>-->
   													
   													 <div class="card ">
   		 	 <div class="card-body" style="text-align: center;">
   		 	 	<span ><i class="far fa-circle" style="cursor:not-allowed;"></i></span>
   		 	 

   		 	 	
   		 	 </div> 
   		 	 
   		 </div> 
																		                	<?php	
																					               	 	
																					               }else {
																					               ?>
																					             
						 <button class="btnvote btnvote1" style="margin-top: 50px;z-index: 4 !important" data-cid="<?php echo $row['tmpvote_id'] ?>" data-fullname="<?php echo $fullname ?>">vote</button>
																					               <?php
																					             
																					               }
																					           
																				                	
																					   

																		                			}////
																		                			
																		                	
																		                	
																		                		} // ends hereeeeeee

																		                		}


																		                
																		                	
																		                }
																			           	
																			          
														             
														               }
			                    								?>
							   					 
			                    						</div>
			                    						
			                    						 	 <div class="col-sm-5 propaganda">
			                    						 	<h6 style="font-weight: bolder">Details</h6>
			                    						 	<hr>
			                    						 	<p>
			                    						 		<?php echo $advocacy ?>
			                    						 	</p>
			                    						 </div> 
			                    						 </div>
			                    						</div>
			                    						  </div>
			                    					</div>


			                    				</div>


			       				<p></p>	
					                 	<?php
					
					                 }
					                ?>
					                <?php 
					                 if($studentvalidity == 0) {

			                 			}else {

			                 				  if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														        
											 }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														         
											}else {
												?>
			                 				  <button data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" class="btn btn-primary submitvote"   style="padding: 18px;font-size: 20px;letter-spacing: 2px;text-transform: uppercase;">Submit votes</button>
			                 				<?php	
											}
			                 				

			                 				
			                 			}

					                 ?>
					              


					                 <div class="" style="margin-top: 150px;"></div>
					                 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
					                 	 <div class="container" style="">
					                 	 			<h6 style="text-align: center; font-size: 20px;font-weight: bold">Vote Wisely! Your vote matters!  <br><br><span style="font-family: 'Barlow Semi Condensed', sans-serif;font-weight: bolder;">ISC ELECTION</span></h6>

					                 	 </div> 
					                 	 	 <div class="" style="margin-top: 150px;"></div> 
					                 	 	 
					                 
					                <?php
					          }else {
					          		?>
					          		<p></p>
	                 <div class="row candidatecard" style="text-align: center;">   
                                                <div class="card" style="background-image: url(include/png/backnocan.jpg); background-size: cover;background-repeat: no-repeat;height: 300px;background-position: center;">
                                                     <div class="container" style="background-color: rgba(0,0,0,.5);color: white;padding: 35px;margin-top:5px;">
                                                       <h1 style="font-weight: bolder;font-size: 80px">Ooopps!</h1><br>
                                                       <h4>Selection of Candidates  has not yet finish . Or Election for such Postions has not yet started. <br> </h4>   
                                                       <br>
                                                       <img src="" style="width: 100%">
                                                     </div> 
                                                     <p></p>
                                                   
                                                </div>
                                            </div>
					          		<?php
					          }

					          if($notverified == true){
					          	?>
					          <style type="text/css">
					          	#pamparampampam:hover {
					          		opacity:0%;

					          	}
					          </style>
					          	<div class="fixed-bottom" >
					          		
					          			<div class="alert alert-danger" id="pamparampampam"  role="alert" style="width: auto; float: right; margin-right: 10px;font-size: 15px">
								Your account is not yet verified.Please wait for your adviser or for the administrator to  confirm your registration.
								</div>
					          	</div>
					          
					          	<?php
					          }

			}


			function get_candidatesby($positionid) {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
							$sql = " select * from temp_votes where posid = '$positionid' and election_id = '$electid'  ";
					                $result = mysqli_query($con,$sql); 
					                $count= mysqli_num_rows($result); 
					              
					             if ($count>=1){
					             	
					                 while($row = mysqli_fetch_array($result)){
					                 	$s_id = $row['sv_id'];
					                 	$posid = $row['posid'];
					                 	$advocacy = $row['advocacy'];
					                 	$cid = $row['tmpvote_id'];
					                 	$partylist = $row['partylist'];


					                 	?>
								                 	<p></p>
							<div class="row candidatecard">	
			                    				<div class="card" style="height: auto">
			                    					
			                    					<div class="card-body" >
			                    						<span class="positions">
			                    							<?php
			                    										$getname = " select * from position where pos_id = '$posid' and election_id ='$electid'  ";
			                    								                $resultgetname = mysqli_query($con,$getname); 
			                    								             
			                    								                 while($name = mysqli_fetch_array($resultgetname)){
			                    													echo $name['pos_name'];
			                    													$posname = $name['pos_name'];
			                    													$countofvote = $name['maxvote'];
			                    								                 }
			                    								          
			                    							?>
			                    						</span>
			                    						  <div class="container">
			                    						  	 <div class="row">

			                    						     <?php
			                    										$getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
			                    								                $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    								                 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	$photo = $uname['photo'];
			                    								                 	$gender = $uname['gender'];
			                    								                 	if($photo == '') {
			                    								                 		 if($gender == 'male'){
												                                          $imgsrc = $src.'undraw_profile_pic_ic5t.png';
												                                        }else {
												                                            
												                                         
												                                             $imgsrc = $src.'undraw_female_avatar_w3jk.png';
												                                        }
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
				 	 	                 											$section = $uname['section'];
			                    													?>
			                    													<div class="col-sm-3">
			                    						  	 		
			                    						  <img src="<?php echo $imgsrc ?>" style="width: 120px;height: 120px;border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" >
			                    						</div>
			                    						  	 
			                    						  	 <div class="col-sm-4 candidate-data">
			                    						     <h4><span>For</span> <?php echo $posname ?></h4>
			                    													<h3><?php echo $uname['surname'].' '.$uname['name'] ?></h3>
													   								<h5>
													   										<?php 
										      		$course = " select * from course where courseid = '$courseid'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						echo $getcourse['course'];
										      						
										                       }
										                

										      echo '-'; 

										      $year = " select * from year where yearid = '$yearid'  ";
										                      $resultas = mysqli_query($con,$year);
										                    
										                    
										                       while($getyear = mysqli_fetch_array($resultas)){
										      						echo $getyear['year'];
										                       }
										     	  $sectionqry = " select * from section where sec_id = '$section' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		echo $getsec['section'];
							                             }

										       ?>
										       <br>
										       PARTYLIST : 
										       <span style="font-weight: bold;"><?php 



										       	 $prtylist = " select * from `partylist` where party_id = '$partylist' ";
							                            $resultprtylist = mysqli_query($con,$prtylist);
							                         
							                         
							                             while($getpt = mysqli_fetch_array($resultprtylist)){
							                     		echo $getpt['partylist'];
							                             }

										       

										        ?></span>
													   							</h5>
			                    													<?php
			                    								                 }
			                    								          
			                    							?>
													   		
			                    								<?php 
			                    								$studentid = $_SESSION['voter_login'];
			                    										$studentverificationcheck = "select * from student where s_id='$studentid' ";
			                    								                $verifying= mysqli_query($con,$studentverificationcheck); // run query
			                    								               
			                    								                 while($getinfo = mysqli_fetch_array($verifying)){
			                    													$studentvalidity = $getinfo['isverified'];
			                    								                 }

			                    								         if($studentvalidity == 0) {
			                    								         	?>
					          <style type="text/css">
					          	#pamparampampam:hover {
					          		opacity:0%;

					          	}
					          </style>
					          	<div class="fixed-bottom" >
					          		
					          			<div class="alert alert-danger" id="pamparampampam"  role="alert" style="width: auto; float: right; margin-right: 10px;font-size: 15px">
								Your account is not yet verified.Please wait for your adviser or for the administrator to  confirm your registration.
								</div>
					          	</div>
					          
					          	<?php
			                    								         } else { 
			                    								$selectactive = " select * from election_sched where election_id = '$electid'  ";
														        $resultselect = mysqli_query($con,$selectactive); 
														                 							
														         while($active = mysqli_fetch_array($resultselect)){
														               $electid = $active['election_id'];
														               $checken = $active['voterlogin'];
														               
														               $eventstart = $active['eventstart'];
														               $eventend = $active['eventend'];		
														               }
														               date_default_timezone_set('Asia/Manila');
														               $dateandtime = date("Y-m-d H:i:s");
														             
														               if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														          ?>
														           <div class="card border-secondary" style="margin-top: 35%;width: 240px">
														           	 <div class="container">	 
														           	<p></p>
														           	<h6>Election has not yet STARTED</h6>
														           	<p></p>
														           	 </div> 
														           </div> 
														           
														              <?php
														               }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														          ?>
														           <div class="card border-secondary" style="margin-top: 35%;width: 240px">
														           	 <div class="container">	 
														           	<p></p>
														           	<h6>Election has not yet STARTED</h6>
														           	<p></p>
														           	 </div> 
														           </div> 
														           
														          <?php
														               }
														                  else if($eventstart <= $dateandtime && $eventend > $dateandtime ) {
														          
																		   	$vid = $_SESSION['voter_login'];             	
																			          
																			         
																			           	  $checkvotess = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotess = mysqli_query($con,$checkvotess); 
																		                $countvoterss= mysqli_num_rows($resultcheckvotess); 
																		                 if($countofvote >=$countvoterss) {
																		                 		 $checkvotesse = " select * from temp_votes where election_id = '$electid' and tmpvote_id='$cid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotesse = mysqli_query($con,$checkvotesse); 
																		                $countvotersse= mysqli_num_rows($resultcheckvotesse); 
																		                		if($countvotersse >=1) {


																		                					?>
																		                	 <!--	<div class="card " style="width:100%;text-align: center;border-radius: 50px; margin-top: 50px;">
																			           	 <div class="container">	 
																			           	<p></p>
																		    <h1 style=" color: rgb(11, 57, 11);"><i class="fas fa-check-circle"></i><br><span style="font-size: 14px;color: black">VOTED</span></h1>

																			           	<p></p>
																			           	 </div> 
																			           </div>
																			           <h1 style="font-weight: bolder;background-color: rgb(11, 57, 11);
   color: white;text-align: center;user-select: none;padding: 10px;">VOTED <br><a style="font-size: 20px;color:#ddc9cc	;background-color: #950a1f;padding:5px; border-radius: 5px;text-decoration: none;color: white" href="javascript:void()" class="btncancelvote btncancelvote1"data-cid="<?php echo $row['tmpvote_id']; ?>" data-fullname="<?php echo $fullname ?>">CANCEL</a></h1>-->
    <div class="card shadow-sm">
   		 	 <div class="card-body" style="text-align: center;">
   		 	 	<span  ><i class="fas fa-circle"></i></span>
   		 	 	<span style="font-size: 14px;font-weight: bold;">VOTED</span>

   		 	 	<button class="btn btn-light  btncancelvote1" data-cid="<?php echo $row['tmpvote_id']; ?>" data-fullname="<?php echo $fullname ?>" style="font-size: 12px;float: right;"><i class="fas fa-times text-danger"></i></button>
   		 	 </div> 
   		 	 
   		 </div> 
																		                	<?php
																		                		}else {
																		                			if($countvotersse <= $countofvote) {
																		                				
																		                			
																					           		 $checkvotesser = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																					                $resultcheckvotesser = mysqli_query($con,$checkvotesser); 
																					                $countvotersser= mysqli_num_rows($resultcheckvotesser);
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotesser)){
																					                		$possid = $rowget['posid'];

																					                		
																					                	       }
																					                	        $checkvotessert = " select * from position where election_id = '$electid' and pos_id ='$posid'  ";
																					                $resultcheckvotessert = mysqli_query($con,$checkvotessert); 
																					               
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotessert)){
																					                		$maxboto = $rowget['maxvote'];
																					                		
																					                	       }
																					               

																					               if( $countvotersser >= $maxboto) {
																					               	?>
																		                	<!--<div class="card " style="width:100%;text-align: center;border-radius: 50px; margin-top: 50px;">
																			           	 <div class="container">	 
																			           	<p></p>
																		                		<h6>You Have already  casted your vote for the position of <?php echo $posname  ?></h6>
																			           			<br>
																			           				<p></p>
																			           	 </div> 
																			           </div>-->
																			            <div class="card ">
   		 	 <div class="card-body" style="text-align: center;">
   		 	 	<span  ><i class="far fa-circle"></i></span>
   		 	 

   		 	 	
   		 	 </div> 
   		 	 
   		 </div> 
																		                	<?php	
																					               	 	
																					               }else {
																					               ?>
																					               <!-- <button class="btnvote"  data-cid="<?php echo $row['cid']; ?>" data-fullname="<?php echo $fullname ?>">Vote</button> -->
						 <button class="btnvote voteid" style="margin-top: 50px"  data-cid="<?php echo $row['tmpvote_id'] ?>" data-fullname="<?php echo $fullname ?>">vote</button>
																					               <?php
																					               
																					               }
																					           
																					                	
																					   

																		                			}	////
																		                			
																		                	
																		                	
																		                		} 
																		                	}
																		                
																		                	
																		                }
																			           	
																			          
														             
														               }
			                    								
			                    								?>
							   					 
							   					 
			                    						</div>
			                    						
			                    						 	 <div class="col-sm-5 propaganda" style="  height: auto;">
			                    						 	<h6 style="font-weight: bolder">Details</h6>
			                    						 	<hr>
			                    						 	<p>
			                    						 		<?php echo $advocacy ?>
			                    						 	</p>
			                    						 </div> 
			                    						 </div>
			                    						</div>
			                    						  </div>
			                    					</div>


			                    				</div>


			       				<p></p>	
					                 	<?php



					               
					              
					
					                 }
					          }else {


					          		?>
					          		<p></p>
	                 <div class="row candidatecard" style="text-align: center;">   
                                                <div class="card" style="background-image: url(include/png/backnocan.jpg); background-size: cover;background-repeat: no-repeat;height: 300px;background-position: center;">
                                                     <div class="container" style="background-color: rgba(0,0,0,.5);color: white;padding: 35px;margin-top:5px;">
                                                       <h1 style="font-weight: bolder;font-size: 80px">Ooopps!</h1><br>
                                                       <h4>Selection of Candidates  has not yet finish . Or Election for such Postions has not yet started. <br> </h4>   
                                                       <br>
                                                       <img src="" style="width: 100%">
                                                     </div> 
                                                     <p></p>
                                                   
                                                </div>
                                            </div>
					          		<?php
					          }


					                 if($studentvalidity == 0) {

			                 			}else {

			                 				  if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														        
											 }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														         
											}else {
												?>
			                 				  <button data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" class="btn btn-primary submitvote"   style="padding: 18px;font-size: 20px;letter-spacing: 2px;text-transform: uppercase;">Submit votes</button>

			                 				  <p><br></p>
			                 				<?php	
											}
			                 				

			                 				
			                 			}



			}
			function getPositions($page) {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
				$sql = " select * from position where election_id ='$electid' order by `pos_id` asc ";
						                $result = mysqli_query($con,$sql); 
						                $count= mysqli_num_rows($result); 
						              
						                 while($row = mysqli_fetch_array($result)){
												?>
									 <li class="nav-item">
									 <a class="nav-link active  " href="<?php echo $page ?>.php?sortby=<?php echo $row['pos_name']; ?>&id=<?php echo $row['pos_id']; ?>"><?php echo $row['pos_name']; ?></a>
									 	</li>

												<?php
						                 }
			}

			function getcandidatecard(){
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
							$sql = " select * from candidate where election_id = '$electid'  ";
					                $result = mysqli_query($con,$sql); 
					                $count= mysqli_num_rows($result); 
					              
					                 while($row = mysqli_fetch_array($result)){
					                 	$s_id = $row['sv_id'];
					                 	$posid = $row['pos_id'];
					                 	$advocacy = $row['advocacy'];
										?>
										   <div class="col-sm-4">
						             <p></p>
						            <div class="card" style="height: 600px;">
						            	<?php 
						            	
			                    										$getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
			                    								                $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    								                 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	
			                    								                 	$photo = $uname['photo'];
			                    								                 	$gender = $uname['gender'];
			                    								                 	if($photo == '') {
			                    								                 		 if($gender == 'male'){
												                                          $imgsrc = $src.'undraw_profile_pic_ic5t.png';
												                                        }else {
												                                            
												                                         
												                                             $imgsrc = $src.'undraw_female_avatar_w3jk.png';
												                                        }
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
			                    								                 	?>
			                   <img class="card-img-top img-thumbnail" style="height: 350px;" width="100%" src="<?php echo $imgsrc ?>" alt="Candidate Image" >
						  <div class="card-body">
						    <h5 class="card-title" style="font-weight: bolder;"><?php echo $fullname ?> 

						    <span class="positions" style="float: right;">
						    	<span>For</span>
			                    							<?php
			                    										$getname = " select * from position where pos_id = '$posid' and election_id = '$electid'  ";
			                    								                $resultgetname = mysqli_query($con,$getname); 
			                    								             
			                    								                 while($name = mysqli_fetch_array($resultgetname)){
			                    													echo $name['pos_name'];
			                    													$posname = $name['pos_name'];
			                    								                 }
			                    								          
			                    							?>
			                    						</span>
						</h5>
						    <h6 style="font-size: 14px;">
						    	
						    		<?php 
										      		$course = " select * from course where courseid = '$courseid'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						echo $getcourse['course'];
										      						
										                       }
										                

										      echo '-'; 

										      $year = " select * from year where yearid = '$yearid'  ";
										                      $resultas = mysqli_query($con,$year);
										                    
										                    
										                       while($getyear = mysqli_fetch_array($resultas)){
										      						echo $getyear['year'];
										                       }
										       ?>
						    </h6>
			                    								                 	<?php
			                    								                
			                    								                 }
						            	 ?>
						 
						  	 <div class="container" style="overflow-y: scroll;height:120px"> 
						  	 
						    <p class="card-text"><?php echo $row['advocacy']; ?></p>
						    </div>
						  </div>
						  <ul class="list-group list-group-flush">
						    <li class="list-group-item">TOTAL VOTES RECEIVED : <span style="font-weight: bolder;"><?php
						    if($row['votes'] == '') {
						    	echo 'No votes';
						    }else {
						    	echo $row['votes'];
						    }

						     ?></span>  </li>
						    
						    
						   
						  </ul>
						 
						</div>
						        </div>
										<?php
					                 }
					          
			}

				function getcandidatecardby($posid){
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
							$sql = " select * from candidate where pos_id = '$posid' and election_id = '$electid'  ";
					                $result = mysqli_query($con,$sql); 
					                $count= mysqli_num_rows($result); 
					              
					                 while($row = mysqli_fetch_array($result)){
					                 	$s_id = $row['sv_id'];
					                 	$posid = $row['pos_id'];
					                 	$advocacy = $row['advocacy'];
										?>
										   <div class="col-sm-4">
						             <p></p>
						            <div class="card" style="height: 600px;">
						            	<?php 
						            	
			                    										$getstud= " select * from student where s_id = '$s_id' and election_id='$electid'  ";
			                    								                $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    								                 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	$photo = $uname['photo'];
			                    								                 	$gender = $uname['gender'];
			                    								                 	if($photo == '') {
			                    								                 		 if($gender == 'male'){
												                                          $imgsrc = $src.'undraw_profile_pic_ic5t.png';
												                                        }else {
												                                            
												                                         
												                                             $imgsrc = $src.'undraw_female_avatar_w3jk.png';
												                                        }
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
			                    								                 	?>
			                   <img class="card-img-top img-thumbnail" style="height: 350px;" width="100%" src="<?php echo $imgsrc ?>" alt="Card image cap" >
						  <div class="card-body">
						    <h5 class="card-title" style="font-weight: bolder;"><?php echo $fullname ?> 

						    <span class="positions" style="float: right;">
						    	<span>For</span>
			                    							<?php
			                    										$getname = " select * from position where pos_id = '$posid' and election_id = '$electid'  ";
			                    								                $resultgetname = mysqli_query($con,$getname); 
			                    								             
			                    								                 while($name = mysqli_fetch_array($resultgetname)){
			                    													echo $name['pos_name'];
			                    													$posname = $name['pos_name'];
			                    								                 }
			                    								          
			                    							?>
			                    						</span>
						</h5>
						    <h6 style="font-size: 14px;">

						    	<?php 
										      		$course = " select * from course where courseid = '$courseid'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						echo $getcourse['course'];
										      						
										                       }
										                

										      echo '-'; 

										      $year = " select * from year where yearid = '$yearid'  ";
										                      $resultas = mysqli_query($con,$year);
										                    
										                    
										                       while($getyear = mysqli_fetch_array($resultas)){
										      						echo $getyear['year'];
										                       }
										       ?>
						    </h6>
			                    								                 	<?php
			                    								                
			                    								                 }
						            	 ?>
						 
						  	 <div class="container" style="overflow-y: scroll;height:120px"> 
						  	 
						    <p class="card-text"><?php echo $row['advocacy']; ?></p>
						    </div>
						  </div>
						  <ul class="list-group list-group-flush">
						  <li class="list-group-item">TOTAL VOTES RECEIVED : <span style="font-weight: bolder;"><?php
						    if($row['votes'] == '') {
						    	echo 'No votes';
						    }else {
						    	echo $row['votes'];
						    }

						     ?></span>  </li>
						   
						  </ul>
						 
						</div>
						        </div>
										<?php
					                 }
					          
			}

				function count_any_row($table,$wherecondition) {
					include 'admin/connection/connect.php';
					$electid = $_SESSION['election_id'];
								$sql = " select * from $table where $wherecondition  ";
						                $result = mysqli_query($con,$sql);
						                $count= mysqli_num_rows($result);
						           echo $count;
						          
				}

				function count_votes($votersid) {
					include 'admin/connection/connect.php';
					$electid = $_SESSION['election_id'];
								$sql = " select * from candidate where sv_id='$votersid' and election_id = '$electid' ";
						                $result = mysqli_query($con,$sql);
						                $count= mysqli_num_rows($result);
						          

						    while($row = mysqli_fetch_array($result)){
						          echo $row['votes'];
						    }
						                    
						          
				}

			function getgraphs() {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
								$sql = " select * from candidate where election_id = '$electid' ";
						                $result = mysqli_query($con,$sql); // run query
						            $count= mysqli_num_rows($result); 
						           
						            if($count >= 1) {
						          		

					?>
					<script>
						            
						            
				window.onload = function () {
				  
				var chart = new CanvasJS.Chart("chartContainer", {
				  animationEnabled: true,
				  
				  title:{
				    text:"Candidates Poll "
				  },
				  axisX:{
				    interval: 1
				  },
				  axisY2:{
				    interlacedColor: "#48cd85",
				    gridColor: "rgb(205,74,144)",
				    title: "Number of Votes"
				  },

				  data: [{
				    type: "bar",
				    name: "companies",
				    axisYType: "secondary",
				    color: "#2a8eb0",
				   
				    dataPoints: [
				     <?php 
				      while($row = mysqli_fetch_array($result)){
											$canid = $row['sv_id'];
											$vote= $row['votes'];
												$sqlget = " select * from student where s_id = '$canid' and election_id='$electid'  ";
											                $resultget = mysqli_query($con,$sqlget); 
											              
											                 while($user = mysqli_fetch_array($resultget)){
											                 	$canname = $user['surname'].' '.$user['name'];
											                 	if($vote == '') {
											                 		?>
																  { y: <?php echo '0'?>, label: "<?php echo $canname;?>" },
																<?php	
											                 	}else {
											                 		?>
																  { y: <?php echo $vote?>, label: "<?php echo $canname;?>" },
																<?php	
											                 	}
																			
											                 }
											          
						                 	

						                 }
				  	 ?>
				  	
				     
				     
				    
				    ]

				  }]
				});
				chart.render();

				}
				</script>
					<?php
				}else {
					?>
					          		<p></p>
	                 <div class="row candidatecard" style="text-align: center;">   
                                                <div class="card" style="background-image: url(include/png/backnocan.jpg); background-size: cover;background-repeat: no-repeat;height: 300px;background-position: center;">
                                                     <div class="container" style="background-color: rgba(0,0,0,.5);color: white;padding: 35px;margin-top:5px;">
                                                       <h1 style="font-weight: bolder;font-size: 80px">Ooopps!</h1><br>
                                                       <h4>There was no candidates in this selected position . No Statistic Data shown <br> </h4>   
                                                       <br>
                                                       <img src="" style="width: 100%">
                                                     </div> 
                                                     <p></p>
                                                   
                                                </div>
                                            </div>
					          		<?php
				}
				
			}
  
 			function getgraphsby($posid) {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
								$sql = " select * from candidate where pos_id = '$posid' and election_id = '$electid' ";
						                $result = mysqli_query($con,$sql); // run query
						            $count= mysqli_num_rows($result); 
						          
						            $sqlpos = " select * from position where pos_id = '$posid' and election_id = '$electid' ";
						                $resultpos = mysqli_query($con,$sqlpos); // run query
						            
						             while($rows = mysqli_fetch_array($resultpos)){ 
						            	$posname = $rows['pos_name'];
						            }

						            if($count >= 1) {
						          
						                
						          

					?>
					<script>
				window.onload = function () {
				  
				var chart = new CanvasJS.Chart("chartContainer", {
				  animationEnabled: true,
				  
				  title:{
				    text:" <?php echo $posname ?> Candidates Poll"
				  },
				  axisX:{
				    interval: 1
				  },
				  axisY2:{
				    interlacedColor: "#48cd85",
				    gridColor: "rgb(205,74,144)",
				    title: "Number of Votes"
				  },

				  data: [{
				    type: "bar",
				    name: "companies",
				    axisYType: "secondary",
				    color: "#2a8eb0",
				   
				    dataPoints: [
				     <?php 
				      while($row = mysqli_fetch_array($result)){
											$canid = $row['sv_id'];
											$vote= $row['votes'];
												$sqlget = " select * from student where s_id = '$canid' and election_id = '$electid'  ";
											                $resultget = mysqli_query($con,$sqlget); 
											              
											                 while($user = mysqli_fetch_array($resultget)){
											                 	$canname = $user['surname'].' '.$user['name'];

																if($vote == '') {
											                 		?>
																  { y: <?php echo '0'?>, label: "<?php echo $canname;?>" },
																<?php	
											                 	}else {
											                 		?>
																  { y: <?php echo $vote?>, label: "<?php echo $canname;?>" },
																<?php	
											                 	}		
											                 }
											          
						                 	

						                 }
				  	 ?>
				  	
				     
				     
				    
				    ]

				  }]
				});
				chart.render();

				}
				</script>
					<?php
				}else {
					?>
					          		<p></p>
	                 <div class="row candidatecard" style="text-align: center;">   
                                                <div class="card" style="background-image: url(include/png/backnocan.jpg); background-size: cover;background-repeat: no-repeat;height: 300px;background-position: center;">
                                                     <div class="container" style="background-color: rgba(0,0,0,.5);color: white;padding: 35px;margin-top:5px;">
                                                       <h1 style="font-weight: bolder;font-size: 80px">Ooopps!</h1><br>
                                                       <h4>There was no candidates in this selected position . No Statistic Data shown <br> </h4>   
                                                       <br>
                                                       <img src="" style="width: 100%">
                                                     </div> 
                                                     <p></p>
                                                   
                                                </div>
                                            </div>
					          		<?php
				}
			}


			function alreadyvoted() {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
							$sql = " select * from temp_votes where election_id = '$electid'  ";
					                $result = mysqli_query($con,$sql); 
					                $count= mysqli_num_rows($result); 
					              
					             if ($count>=1){
					             	
					                 while($row = mysqli_fetch_array($result)){
					                 	$s_id = $row['sv_id'];
					                 	$posid = $row['posid'];
					                 	$advocacy = $row['advocacy'];
					                 	$voters = $row['voters'];
					                 	$cid = $row['tmpvote_id'];
					                 	$partylist = $row['partylist'];

					                 	?>
								                 	<p></p>
							<div class="row candidatecard">	
			                    				<div class="card" style="height: auto">
			                    					
			                    					<div class="card-body">
			                    						<span class="positions">
			                    							<?php
			                    										$getname = " select * from position where pos_id = '$posid' and election_id ='$electid'  ";
			                    								                $resultgetname = mysqli_query($con,$getname); 
			                    								             
			                    								                 while($name = mysqli_fetch_array($resultgetname)){
			                    													echo $name['pos_name'];
			                    													$posname = $name['pos_name'];
			                    													$nowinn = $name['pos_noofwinner'];
			                    													$countofvote = $name['maxvote'];
			                    								                 }
			                    								          
			                    							?>
			                    						</span>
			                    						  <div class="container">
			                    						  	 <div class="row">

			                    						     <?php
			                    										$getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
			                    								                $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    								                 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	$photo = $uname['photo'];
			                    								                 	if($photo == '') {
			                    								                 		$imgsrc = $src.'undraw_profile_pic_ic5t.png';
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
				 	 	                 											$section = $uname['section'];
			                    													?>
			                    													<div class="col-sm-3">
			                    						  	 		
			                    						  <img src="<?php echo $imgsrc ?>" style="width: 120px;height: 120px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" >
			                    						</div>
			                    						  	 
			                    						  	 <div class="col-sm-4 candidate-data">
			                    						     <h4><span>For</span> <?php echo $posname ?></h4>
			                    													<h3><?php echo $uname['surname'].' '.$uname['name'] ?></h3>
													   								<h5>
													   									<?php 
										      		$course = " select * from course where courseid = '$courseid'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						echo $getcourse['course'];
										      						
										                       }
										                

										      echo '-'; 

										      $year = " select * from year where yearid = '$yearid'  ";
										                      $resultas = mysqli_query($con,$year);
										                    
										                    
										                       while($getyear = mysqli_fetch_array($resultas)){
										      						echo $getyear['year'];
										                       }
										      
										                        $sectionqry = " select * from section where sec_id = '$section' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		echo $getsec['section'];
							                             }
										      ?>
										       <br> PARTYLIST: 
										      <span style="font-weight: bold;"> <?php 

										       $prtylist = " select * from `partylist` where party_id = '$partylist' ";
							                            $resultprtylist = mysqli_query($con,$prtylist);
							                         
							                         
							                             while($getpt = mysqli_fetch_array($resultprtylist)){
							                     		echo $getpt['partylist'];
							                             }

										       ?></span>
													   								</h5>
			                    													<?php
			                    								                 }
			                    								          
			                    							?>
													   		
			                    								<?php 
			                    								$selectactive = " select * from election_sched where election_id = '$electid'  ";
														        $resultselect = mysqli_query($con,$selectactive); 
														                 							
														         while($active = mysqli_fetch_array($resultselect)){
														               $electid = $active['election_id'];
														               $checken = $active['voterlogin'];
														               
														               $eventstart = $active['eventstart'];
														               $eventend = $active['eventend'];		
														               }
														               date_default_timezone_set('Asia/Manila');
														               $dateandtime = date("Y-m-d H:i:s");
														             
														               if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														          ?>
														           <div class="card border-secondary" style="margin-top: 35%;width: 240px">
														           	 <div class="container">	 
														           	<p></p>
														           	<h6>Election has not yet STARTED</h6>
														           	<p></p>
														           	 </div> 
														           </div> 
														           
														          <?php
														               }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														          ?>
														           <div class="card border-secondary" style="margin-top: 35%;width: 240px">
														           	 <div class="container">	 
														           	<p></p>
														           	<h6>Election has not yet STARTED</h6>
														           	<p></p>
														           	 </div> 
														           </div> 
														           
														          <?php
														               }
														                else if($eventstart <= $dateandtime && $eventend > $dateandtime ) {
														          
																		   	$vid = $_SESSION['voter_login'];             	
																			          
																			         
																			           	  $checkvotess = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotess = mysqli_query($con,$checkvotess); 
																		                $countvoterss= mysqli_num_rows($resultcheckvotess); 
																		                 if($countofvote >=$countvoterss) {
																		                 		 $checkvotesse = " select * from temp_votes where election_id = '$electid' and tmpvote_id='$cid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotesse = mysqli_query($con,$checkvotesse); 
																		                $countvotersse= mysqli_num_rows($resultcheckvotesse); 
																		                		if($countvotersse >=1) {


																		                					?>
																		                <!--	<div class="card " style="width:100%;text-align: center;border-radius: 50px; margin-top: 50px;">
																			           	 <div class="container">	 
																			           	<p></p>
																		    <h1 style=" color: rgb(11, 57, 11);"><i class="fas fa-check-circle"></i><br><span style="font-size: 14px;color: black">VOTED</span></h1>

																			           	<p></p>
																			           	 </div> 
																			           </div>-->
																			        <div class="card shadow-sm mt-5">
   		 	 <div class="card-body" style="text-align: center;">
   		 	 	<h4>VOTED ✓</h4>

   		 	 
   		 	 </div> 
   		 	 
   		 </div> 

																		                	<?php
																		                		}else {
																		                			if($countvotersse <= $countofvote) {
																		                				
																		                			
																					           		 $checkvotesser = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																					                $resultcheckvotesser = mysqli_query($con,$checkvotesser); 
																					                $countvotersser= mysqli_num_rows($resultcheckvotesser);
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotesser)){
																					                		$possid = $rowget['posid'];

																					                		
																					                	       }
																					                	        $checkvotessert = " select * from position where election_id = '$electid' and pos_id ='$posid'  ";
																					                $resultcheckvotessert = mysqli_query($con,$checkvotessert); 
																					               
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotessert)){
																					                		$maxboto = $rowget['maxvote'];
																					                		
																					                	       }
																					               

																					               if( $countvotersser >= $maxboto) {
																					               	?>
																		                   <div class="card shadow-sm mt-5">
														   		 	 <div class="card-body" style="text-align: center;">
														   		 	 	<h4>-</h4>

														   		 	 
														   		 	 </div> 
														   		 	 
														   		 </div> 

																		                	<?php	
																					               	 	
																					               }else {
																					               ?>
																					              <!-- <button class="btnvote"  data-cid="<?php echo $row['cid']; ?>" data-fullname="<?php echo $fullname ?>">Vote</button> -->
						 <button class="btnvote btnvote1"  data-cid="<?php echo $row['tmpvote_id'] ?>" data-fullname="<?php echo $fullname ?>">vote</button>
																					               <?php
																					             
																					               }
																					           
																					                	
																					   

																		                			}////
																		                			
																		                	
																		                	
																		                		}
																		                
																		                	
																		                }
																			           	
																			          
														             
														               }
			                    								?>
							   					 
			                    						</div>
			                    						
			                    						 	 <div class="col-sm-5 propaganda">
			                    						 	<h6 style="font-weight: bolder">Details</h6>
			                    						 	<hr>
			                    						 	<p>
			                    						 		<?php echo $advocacy ?>
			                    						 	</p>
			                    						 </div> 
			                    						 </div>
			                    						</div>
			                    						  </div>
			                    					</div>


			                    				</div>


			       				<p></p>	
					                 	<?php
					
					                 }
					                ?>
					              
					                 <div class="" style="margin-top: 150px;"></div>
					                 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
					                 	 <div class="container" style="">
					                 	 			<h6 style="text-align: center; font-size: 20px;font-weight: bold;">Vote Wisely! Your vote matters!  <br><br><span style="font-family: 'Barlow Semi Condensed', sans-serif;font-weight: bolder;">ISC ELECTION</span></h6>

					                 	 </div> 
					                 	 	 <div class="" style="margin-top: 150px;"></div> 
					                 	 	 
					                 
					                <?php
					          }else {
					          		?>
					          		<p></p>
	                 <div class="row candidatecard" style="text-align: center;">   
                                                <div class="card" style="background-image: url(include/png/backnocan.jpg); background-size: cover;background-repeat: no-repeat;height: 300px;background-position: center;">
                                                     <div class="container" style="background-color: rgba(0,0,0,.5);color: white;padding: 35px;margin-top:5px;">
                                                       <h1 style="font-weight: bolder;font-size: 80px">Ooopps!</h1><br>
                                                       <h4>Selection of Candidates  has not yet finish . Or Election for such Postions has not yet started. <br> </h4>   
                                                       <br>
                                                       <img src="" style="width: 100%">
                                                     </div> 
                                                     <p></p>
                                                   
                                                </div>
                                            </div>
					          		<?php
					          }

			}

			function checkstatus(){
				?>
				<script type="text/javascript">
					$.ajax({
						      	      	            url : "checkstatus.php",
						      	      	             method: "POST",
						      	      	              data  : {checkstatus:1},
						      	      	              success : function(data){

										      	      	if(data.match("votingstartsendemails1")){
										      	      		
										      	      		
										      	      		
										      	      		   $.ajax({
										      	      		           url : "sendmail/notify1.php",
										      	      		            method: "POST",
										      	      		             data  : {sendnotification:1},
										      	      		             success : function(data){
										      	      		
										      	      		             }
										      	      		          })
										      	      		      
										      	      		    


										      	      	}else if(data.match("votingstartsendemails2")){

										      	      			  $.ajax({
										      	      		           url : "sendmail/notify2.php",
										      	      		            method: "POST",
										      	      		             data  : {sendnotification:1},
										      	      		             success : function(data){
										      	      		
										      	      		             }
										      	      		          })

										      	      	}

										      	      	else {

										      	      	}              
										      
						      	      	              }
						      	      	           })
					
					setInterval(function(){
						
							
						   
						      	      	 
						      	      	    $.ajax({
						      	      	            url : "checkstatus.php",
						      	      	             method: "POST",
						      	      	              data  : {checkstatus:1},
						      	      	              success : function(data){

										      	      	if(data.match("votingstartsendemails")){
										      	      		
										      	      		
										      	      		
										      	      		   $.ajax({
										      	      		           url : "sendmail/notify.php",
										      	      		            method: "POST",
										      	      		             data  : {sendnotification:1},
										      	      		             success : function(data){
										      	      		
										      	      		             }
										      	      		          })
										      	      		      
										      	      		    


										      	      	}else {

										      	      	}              
										      
						      	      	              }
						      	      	           })
						      	      	 
						      	      	        	      	 
					},5000);      
				      	
				</script>
				<?php
			}


			///xaxaxaxaxaxaxaxaxaxaxa
				function get_summary() {
				include 'admin/connection/connect.php';
				$electid = $_SESSION['election_id'];
					$vid = $_SESSION['voter_login'];             	
																			          
																			         
							$sql = " select * from temp_votes where election_id = '$electid' and FIND_IN_SET('$vid',voters)  ";
					                $result = mysqli_query($con,$sql); 
					                $count= mysqli_num_rows($result); 
					          $notverified = false;    
					             if ($count>=1){



					             	?>
					             
					             	
					             	<table class="table table-striped">
								  <thead>
								    <tr>
								      <th scope="col">Candidate Name</th>
								      <th scope="col">Position</th>
								      <th scope="col">Vote casted</th>
								     <!-- <th scope="col">Remarks</th> -->
								    </tr>
								  </thead>
  									<tbody>
   
    



					             	<?php
					             	
					                 while($row = mysqli_fetch_array($result)){
					                 	$s_id = $row['sv_id'];
					                 	$posid = $row['posid'];
					                 	$advocacy = $row['advocacy'];
					                 	$voters = $row['voters'];
					                 	$partylist= $row['partylist'];
					                 	$cid = $row['tmpvote_id'];

					                 	?>

			                    						     <?php

			                    										$getname = " select * from position where pos_id = '$posid' and election_id ='$electid'  ";
			                    								                $resultgetname = mysqli_query($con,$getname); 
			                    								             
			                    								                 while($name = mysqli_fetch_array($resultgetname)){
			                    													
			                    													$posname = $name['pos_name'];
			                    													$nowinn = $name['pos_noofwinner'];
			                    													$countofvote = $name['maxvote'];
			                    								                 }
			                    								          
			                    									$getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
			                    								                $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    								                 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	$photo = $uname['photo'];
			                    								                 	$gender = $uname['gender'];
			                    								                 	if($photo == '') {
			                    								                 		
			                    								                 		  if($gender == 'male'){
												                                          $imgsrc = $src.'undraw_profile_pic_ic5t.png';
												                                        }else {
												                                            
												                                         
												                                             $imgsrc = $src.'undraw_female_avatar_w3jk.png';
												                                        }
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
				 	 	                 											$section = $uname['section'];
				 	 	                 											$userid = $uname['s_id'];

			                    													//place image

			                    													//COurse
										      		$course = " select * from course where courseid = '$courseid'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						//echo 
										                       	$Cc = $getcourse['course'];
										      						
										                       }
										                

										    
										    //Year

										      $year = " select * from year where yearid = '$yearid'  ";
										                      $resultas = mysqli_query($con,$year);
										                    
										                    
										                       while($getyear = mysqli_fetch_array($resultas)){
										      						//echo 

										                       	$yr = $getyear['year'];
										                       }



										                       //Section
										      
										                        $sectionqry = " select * from section where sec_id = '$section' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		//echo 
							                             	$sc = $getsec['section'];
							                             }
										      

										      //Partylist
										       	 $prtylist = " select * from `partylist` where party_id = '$partylist' ";
							                            $resultprtylist = mysqli_query($con,$prtylist);
							                         
							                         
							                             while($getpt = mysqli_fetch_array($resultprtylist)){
							                     	//	echo 
							                             	$pt = $getpt['partylist'];
							                             	//
							                             }



										      
			                    													
			                    								                 }
			                    								          
			                    							 ?>
							                             <tr>
							                             	<td><?php echo $fullname ?></td>
							                             	<td><?php echo $posname ?></td>
							                             	<td><span style="text-align: center;" id="<?php echo $userid ?>"></span></td>
							                          	<!--   	<td> <div id="remarks<?php echo $userid ?>"></div>  -->
							                             	 </td>
							                             </tr>

							                             <?php


							                            
													   		
			                    								
			                    								$studentid = $_SESSION['voter_login'];
			                    										$studentverificationcheck = "select * from student where s_id='$studentid' ";
			                    								                $verifying= mysqli_query($con,$studentverificationcheck); // run query
			                    								               
			                    								                 while($getinfo = mysqli_fetch_array($verifying)){
			                    													$studentvalidity = $getinfo['isverified'];
			                    								                 }

			                    								         if($studentvalidity == 0) {
			                    								         	 $notverified = true; 


			                    								         	

			                    								         } else {






			                    								$selectactive = " select * from election_sched where election_id = '$electid'  ";
														        $resultselect = mysqli_query($con,$selectactive); 
														                 							
														         while($active = mysqli_fetch_array($resultselect)){
														               $electid = $active['election_id'];
														               $checken = $active['voterlogin'];
														               
														               $eventstart = $active['eventstart'];
														               $eventend = $active['eventend'];		
														               }
														               date_default_timezone_set('Asia/Manila');
														               $dateandtime = date("Y-m-d H:i:s");
														             
														               if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														       //Election not yet started
														               }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														        //Election not yet started
														               }
														                else if($eventstart <= $dateandtime && $eventend > $dateandtime ) {
														          
																		   	$vid = $_SESSION['voter_login'];             	
																			  
																			         
																			           	  $checkvotess = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotess = mysqli_query($con,$checkvotess); 
																		                $countvoterss= mysqli_num_rows($resultcheckvotess); 
																		                 if($countofvote >=$countvoterss) {
																		                 		 $checkvotesse = " select * from temp_votes where election_id = '$electid' and tmpvote_id='$cid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																		                $resultcheckvotesse = mysqli_query($con,$checkvotesse); 
																		                $countvotersse= mysqli_num_rows($resultcheckvotesse); 
																		                		if($countvotersse >=1) {

																		                			//Candidates that the user had selected
																		                			?>
																		                			<script type="text/javascript">
																		                				
																		                				$(document).ready(function() {
																		                				      	$('#<?php echo $userid ?>').html('✓');
																		                				      	$('#remarks<?php echo $userid ?>').html('<span class="text-success">Good</span>')
																		                				      });      
																		                			      	
																		                			</script>
																		                			<?php
																		                		}else {
																		                			if($countvotersse <= $countofvote) {
																		                				
																		                			
																					           		 $checkvotesser = " select * from temp_votes where election_id = '$electid' and posid ='$posid' and FIND_IN_SET('$vid',voters)  ";
																					                $resultcheckvotesser = mysqli_query($con,$checkvotesser); 
																					                $countvotersser= mysqli_num_rows($resultcheckvotesser);
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotesser)){
																					                		$possid = $rowget['posid'];

																					                		
																					                	       }
																					                	        $checkvotessert = " select * from position where election_id = '$electid' and pos_id ='$posid'  ";
																					                $resultcheckvotessert = mysqli_query($con,$checkvotessert); 
																					               
																					                	   while($rowget = mysqli_fetch_array($resultcheckvotessert)){
																					                		$maxboto = $rowget['maxvote'];
																					                		
																					                	       }
																					               

																					               if( $countvotersser >= $maxboto) {
																					              //The candidate which is not selectd
																					               	?>
																					               	<script type="text/javascript">
																					               		
																					               		$(document).ready(function() {
																					        	$('#remarks<?php echo $userid ?>').html('<span class="text-success">Good</span>')
																					               		      });      
																					               	      	
																					               	</script>
																					               	<?php
																					               	 	
																					               }else {
																					            // The button for vote... to vote..
																					               	?>
																					               	<script type="text/javascript">
																					               		
																					               		$(document).ready(function() {
																					        	$('#remarks<?php echo $userid ?>').html('<span class="text-danger">Lack</span>')
																					               		      });      
																					               	      	
																					               	</script>
																					               	<?php

																					               }
																					           
																					                	
																					   

																		                			}////
																		                			
																		                	
																		                	
																		                		} // ends hereeeeeee

																		                		}


																		                
																		                	
																		                }
																			           	
																			          
														             
														               }
			                    							
					
					                 }
					                ?>
					                  </tbody>
												</table>
					                <?php 
					                 if($studentvalidity == 0) {

			                 			}else {

			                 				  if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) {
														        
											 }else  if( $eventstart > $dateandtime && $eventend > $dateandtime ) {
														         
											}else {
												//The submit vote to do final votes
											}
			                 				

			                 				
			                 			}

					                //LOGO BELOW
					          }else {
					          		?>
					          		<p></p>
	                 <div class="row candidatecard" style="text-align: center;">   
                                                <div class="card" style="background-image: url(include/png/backnocan.jpg); background-size: cover;background-repeat: no-repeat;height: 300px;background-position: center;">
                                                     <div class="container" style="background-color: rgba(0,0,0,.5);color: white;padding: 35px;margin-top:5px;">
                                                       <h1 style="font-weight: bolder;font-size: 80px">Ooopps!</h1><br>
                                                       <h4>Selection of Candidates  has not yet finish . Or Election for such Postions has not yet started. <br> </h4>   
                                                       <br>
                                                       <img src="" style="width: 100%">
                                                     </div> 
                                                     <p></p>
                                                   
                                                </div>
                                            </div>
					          		<?php
					          }

					          if($notverified == true){
					          	?>
					          <style type="text/css">
					          	#pamparampampam:hover {
					          		opacity:0%;

					          	}
					          </style>
					          	<div class="fixed-bottom" >
					          		
					          			<div class="alert alert-danger" id="pamparampampam"  role="alert" style="width: auto; float: right; margin-right: 10px;font-size: 15px">
								Your account is not yet verified.Please wait for your adviser or for the administrator to  confirm your registration.
								</div>
					          	</div>
					          
					          	<?php
					          }

			}
	}




?>

