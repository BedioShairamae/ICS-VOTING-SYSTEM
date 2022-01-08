<?php 
	

		class Fetch_data {

			//functions for Adding , Updating And Deleting
				function insertquery($table,$tabledata,$insertvalue) { 
					include 'connect.php';
								$sql = "INSERT INTO `$table` ($tabledata) VALUES ($insertvalue) ";
						                $result = mysqli_query($con,$sql); // run query
						               
				}

				function updatequery($table,$updatedvalues,$wherecondition) { 
					include 'connect.php';
								$sql = "UPDATE `$table` SET $updatedvalues WHERE  $wherecondition";
						                $result = mysqli_query($con,$sql); // run query
						               
				}

				function deletequery($table,$wherecondition) { 
					include 'connect.php';
								$sql = "DELETE FROM `$table` WHERE $wherecondition";
						                $result = mysqli_query($con,$sql); // run query
						               
				}

				function count_row($table,$wherecondition){
					include 'connect.php';
					
								$sql = " select * from $table where  $wherecondition  ";
						                $result = mysqli_query($con,$sql);
						                $count= mysqli_num_rows($result); 
						            echo $count;
						            
				}

				function selectcourse() {
					include 'connect.php';
								$sql = " select * from course ";
						                $result = mysqli_query($con,$sql);
						             
						             
						                 while($row = mysqli_fetch_array($result)){
											?>
											 <tr>
						                      <td><span style="text-transform:uppercase"><?php echo $row['course']; ?></span></td>
						                      <td>
						                        <button class="btn btn-success edit" data-courseid="<?php echo $row['courseid'] ?>" data-course="<?php echo $row['course']; ?>"  data-toggle="modal" data-target="#editcourse" style="font-size: 10px;"> <i class="fas fa-pen"></i></button>
						                        <button  class="btn btn-danger btndel" data-courseid="<?php echo $row['courseid'] ?>"  style="font-size: 10px;"> <i class="fas fa-times"></i></button>
						                      </td>
						                    </tr>
											<?php
						                 }
						          
				}

				function selectyear() {
						include 'connect.php';
								$sql = " select * from year ";
						                $result = mysqli_query($con,$sql);
						             
						             
						                 while($row = mysqli_fetch_array($result)){
											?>
											<tr>
				                  <td><?php echo $row['year']; ?></td>
				                  <td>
				                     <button class="btn btn-success edityear" data-year="<?php echo $row['year']; ?>" data-yearid="<?php echo $row['yearid']; ?>" data-toggle="modal" data-target="#edityear" style="font-size: 10px;"> <i class="fas fa-pen"></i></button>
				                        <button class="btn btn-danger btndelyear" data-yearid="<?php echo $row['yearid']; ?>"  style="font-size: 10px;"> <i class="fas fa-times"></i></button>
				                  </td>
				                </tr>
											<?php
										}
				}

				function select_position() {
					include 'connect.php';
						$electionid = $_SESSION['electsched'];
								$query = " select * from position where election_id = '$electionid' ORDER BY `pos_id` asc  ";
						                $result = mysqli_query($con,$query);
						                $count= mysqli_num_rows($result); 
						              
						            
						           while($row = mysqli_fetch_array($result)){
						           	$posid = $row['pos_id'];
							            ?>
							              <tr>
							      <th scope="row"><?php echo $row['pos_name']?></th>
							       <td><?php echo $row['pos_noofwinner'] ?></td>
							       <td><?php echo $row['maxvote'] ?></td>
							      <td><?php echo $row['pos_maxcandidate'] ?></td>
							      
							      <td>

							        <p style="color: green;">
							        		<?php 
							        				$checkcount = " select * from candidate where pos_id = '$posid'  ";
							        		                $resultfind = mysqli_query($con,$checkcount); 
							        		                $count= mysqli_num_rows($resultfind);
							        		                echo $count;
							        		                $allcan = $count;
							        		              
							        		            
							        		 ?>

							        </p>
							      </td>
							      <td><?php echo date("@g:ia F j,Y",strtotime ($row['date_registered'])) ?></td>
							      <td >
							          <div class="btn-group" role="group" aria-label="Basic example">
							<button  class="btn btn-warning btnedit" data-pid="<?php echo $row['pos_id']?>" data-name="<?php echo $row['pos_name']?>" data-maximumcount="<?php echo $row['pos_maxcandidate'] ?>" data-noofwinner="<?php echo $row['pos_noofwinner'] ?>" data-noofvotes="<?php echo $row['maxvote'] ?>" data-cancount="<?php echo $allcan ?>" data-toggle="modal" data-target="#editposition" style="font-size: 10px;"><i style="font-size: 15px;" class="fas fa-pen"></i></button> 

							<?php 
							if($count >=1) {
								?>
								<button class="btn btn-secondary btninvalid"  style="font-size: 10px;"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
								<?php
							}else {
								?>
								<button class="btn btn-danger btndel" data-pid="<?php echo $row['pos_id']?>" style="font-size: 10px;"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
								<?php
									}
							 ?>
						
							

							
							           </div>
							           
							        

							      </td>
							    </tr>
							            <?php

				                             }
				}



				function select_students() {
				 	include 'connect.php';
				 	$electionid = $_SESSION['electsched'];
				 	 			$sql = " select * from student where election_id = '$electionid'  ";
				 	 	                $result = mysqli_query($con,$sql);
				 	 	 					$count= mysqli_num_rows($result); // to count if necessary
				 	 	             	            


				 	 	 					

				 	 	             	             if ($count>=1){
				 	 	             	          ?>

				 	 	             	          <div class="card mb-3">
				 	 	 					 	<div class="card-body" style="text-align: right;">
				 	 	 					 		 
				 	 	 					 		 <!-- Example single danger button -->
							<div class="btn-group">
							  <button style="font-size: 12px;" type="button" class="btn btn-secondary dropdown-toggle mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <i class="fas fa-database"></i> Change || Fetch Voters Data
							  </button>
							  <div class="dropdown-menu">
							
							    <?php 
							    $fetchanother = "select * from `election_sched` where election_id != '$electionid'";
							    $resultfetchanother  = mysqli_query($con,$fetchanother);
							     while($fetch = mysqli_fetch_array($resultfetchanother)){ 
							     	?>
							     	 <button class="dropdown-item changedata" type="button" data-id="<?php echo $fetch['election_id'] ?>" data-name="<?php echo $fetch['title'] ?>" href="javascript:void(0)"><?php echo $fetch['title'] ?></button>
							     	<?php
							     }
							     ?>
							    
							  </div>
							</div>
						

				 	 	 					 	</div>
				 	 	 					 </div> 
				 	 	 					 					 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	
	
  
  $(document).ready(function() {
          $('.changedata').click(function() { 
        var id = $(this).data('id');
        var name = $(this).data('name');
      	Swal.fire({
  title: 'Are you sure you want to change the Current Voters Data with '+name+'?',
  text: "You won't be able to revert this! All Data will be removed and replaced with what election schedule you have Selected.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#e74a3b',
  cancelButtonColor: '#f6c23e',
  confirmButtonText: 'Yes, Change it!'
}).then((result) => {
  if (result.isConfirmed) {
    /*Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )*/

    var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			 if (this.readyState == 4 && this.status == 200) {
			const data = this.responseText;
		
				if(data=='data'){
					 Swal.fire(
					  'Voters Data!',
					  'Was Fetched Successfully!',
					  'success'
					).then((result) => {
					  if (result.isConfirmed) {
					   location.reload();
					  }
					})
				}else if(data=='nodata') {
					 Swal.fire(
					  'No Voters Data Found',
					  'This election schedule is empty!',
					  'error'
					).then((result) => {
					  if (result.isConfirmed) {
					   location.reload();
					  }
					})
				}
		
						       }
						    };
				xhttp.open("POST", "reset.php",true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("changefetch=1&id="+id);
  }
})
  
		

      
      })
        });      
        
      	
</script>
				 	 	             	          <?php  
				 	 	             	       
				 	 	               
				 	 	          
				 	 	                 while($row = mysqli_fetch_array($result)){
				 	 	                 	$courseid = $row['course'];
				 	 	                 	$yearid = $row['year'];
				 	 	                 	$s_id = $row['s_id'];
				 	 	                 	$section = $row['section'];
				 	 	                 	$isverified = $row['isverified'];
				 	 	                 	$gender = $row['gender'];
				 	 						?>
				 	 							  <tr>
				 	 							  	<td><input type="checkbox" class="checkit"   value="<?php echo $s_id ?>" name="selectcheck[]" ></td>
										      <th scope="row"><?php
										        if($row['photo'] == '') {
					                                    if($gender == 'male'){
						                                           $imagesrc = "../upload/undraw_profile_pic_ic5t.png";
						                                        }else {
						                                            
						                                            $imagesrc = "../upload/undraw_female_avatar_w3jk.png";
						                                        }

					                                  }else {
					                                    $imagesrc = "../upload/".$row['photo'];
					                                  }


										       echo '<img src="'.$imagesrc.'" style="width:80px;height:80px;" class="img-thumbnail" >'.$row['sv_id'] ?></th>
										      <td><?php echo $row['surname'] ?></td>
										      <td><?php echo $row['name'] ?></td>
										      <td><?php echo $row['middle_name'] ?></td>
										      <td><?php echo $row['gender']; ?></td>
										      <td><?php 
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
                  
										       ?></td>
										       <!--<td>
										       	<?php echo date("@g:ia F j,Y",strtotime ($row['date_registered'])) ?>
										       </td>-->
										       <td>
										       	<?php 
							        				$checkcount = " select * from candidate where sv_id = '$s_id'  ";
							        		                $resultfind = mysqli_query($con,$checkcount); 
							        		                $count= mysqli_num_rows($resultfind);
							        		               if($count >=1 ){
							        		               	echo '<span class="text-success">Candidate</span>';
							        		               }else {

							        		               		if($isverified == 0){
							        		               			echo '<span class="text-danger">Not yet Verified</span>';
							        		               		}else {
							        		               				echo '<span class="text-primary">Verified Voter</span>';
							        		               		}
							        		               
							        		               }
							        		              
							        		            
							        		 ?>
							        			
										       </td>
										      <td>
										      		<!--<div class="btn-group" role="group" aria-label="Basic example">-->
										<button onclick="window.location.href='accountdetails.php?view&id=<?php echo $row['s_id']; ?>' " class="btn btn-warning mb-1" type="button" style="font-size: 12px;font-weight: bolder; width: 100%;">view</button>

										
											<?php 

											
											 if($count >=1 ){ 
											 	if($isverified == 0){ 
												?>
												<button class="btn btn-success btnverify mb-1" type="button" data-sid="<?php echo $s_id ?>" style="font-size: 12px;font-weight: bolder;width: 100%;">Verify</button>
												<?php
											}else {
												?>
												<button class="btn btn-secondary mb-1" type="button" data-sid="<?php echo $s_id ?>"  style="font-size: 12px;font-weight: bolder;width: 100%;">Revoke</button>
												<?php
											}
											 	?>
											 	 <button class="btn btn-secondary mb-1 " type="button" style="font-size: 10px;width: 100%;"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
											 	<?php


											 }else {
											 	if($isverified == 0){ 
											 		?>
											 		<button class="btn btn-success btnverify mb-1" type="button" data-sid="<?php echo $s_id ?>" style="font-size: 12px;font-weight: bolder;width: 100%;">Verify</button>  


											 	 <button class="btn btn-danger btndel mb-1" type="button" data-cid="<?php echo $row['s_id']; ?>" style="font-size: 10px;width: 100%;"><i style="font-size: 12px;" class="far fa-times-circle"></i></button>
											 	 
											 	<?php
											 	}else {
											 	?>
											 	<button class="btn btn-danger btnrevoke mb-1" type="button" data-sid="<?php echo $s_id ?>"  style="font-size: 12px;font-weight: bolder;width: 100%;">Revoke</button>

											 	 <button class="btn btn-secondary mb-1" type="button"  style="font-size: 10px;width: 100%;"><i style="font-size: 12px;" class="far fa-times-circle" disabled=""></i></button>

											 	<?php	
											 	}
											 	
											 }
											 ?>
										
										      	<!--	 </div> -->
										      		 
										      	

										      </td>
										    </tr>
				 	 						<?php

				 	 	                 }
				 	 	             }else {
				 	 	             	$_SESSION['emptydata']=1;
				 	 	             	?>
				 	 	 					 <div class="card mb-3">
				 	 	 					 	<div class="card-body" style="text-align: right;">
				 	 	 					 		 
				 	 	 					 		 <!-- Example single danger button -->
							<div class="btn-group">

							  <button style="font-size: 12px;" type="button" class="btn btn-secondary  mr-3" data-toggle="modal" data-target="#modalshown" data-backdrop="static" data-keyboard="false" >
							    <i class="fas fa-database"></i> Fetch Voters data 
							  </button>
							


							</div>

						
						

				 	 	 					 	</div>
				 	 	 					 </div> 
				 	 	 					 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	
	
  
  $(document).ready(function() {
  	

  	$('#deselect').click(function() { 
        $('.todesellect').prop('checked',false);
      })

  	$('.fetchview').click(function() { 
  		var elecid = $(this).data('elecid');
  		var electitle = $(this).data('electitle');

  		tofetch(elecid,electitle);
  	
  	})
  	function tofetch(id,electtitle){
  		
  			 var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
  			 if (this.readyState == 4 && this.status == 200) {
  			const data = this.responseText;
  		
  			$('#fetchcontent').html(data);
  		
  						       }
  						    };
  				xhttp.open("POST", "../admin/connection/fetching.php",true);
  				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  				xhttp.send("getcontent=1&id="+id+"&title="+electtitle);
  						
  		      	      	 
  	}
  	$('#modalshown').modal('show');
          $('.fetchdata').click(function() { 
        var id = $(this).data('id');
      
  
		 var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			 if (this.readyState == 4 && this.status == 200) {
			const data = this.responseText;
		
				if(data=='data'){
					 Swal.fire(
					  'Voters Data!',
					  'Was Fetched Successfully!',
					  'success'
					).then((result) => {
					  if (result.isConfirmed) {
					   location.reload();
					  }
					})
				}else if(data=='nodata') {
					 Swal.fire(
					  'No Voters Data Found',
					  'This election schedule is empty!',
					  'error'
					).then((result) => {
					  if (result.isConfirmed) {
					   location.reload();
					  }
					})
				}
		
						       }
						    };
				xhttp.open("POST", "reset.php",true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("fetch=1&id="+id);
						


      
      })
        });      
        
      	
</script>
				 	 	 					<?php
				 	 	             }


				 	 	          

				}

				function candidate_link() {
					include 'connect.php';
					$electionid = $_SESSION['electsched'];
								$sql = " select * from position where election_id ='$electionid' order by `pos_id` asc ";
						                $result = mysqli_query($con,$sql); 
						                $count= mysqli_num_rows($result); 
						              
						                 while($row = mysqli_fetch_array($result)){
												?>
												 <li class="nav-item">
									 <a class="nav-link active  " href="candidates.php?sortby=<?php echo $row['pos_name']; ?>&id=<?php echo $row['pos_id']; ?>"><?php echo $row['pos_name']; ?></a>
									 	</li>
												<?php
						                 }
						          
				}
				function candidate_linkw() {
					include 'connect.php';
					$electionid = $_SESSION['electsched'];
								$sql = " select * from position where election_id ='$electionid' order by `pos_id` asc ";
						                $result = mysqli_query($con,$sql); 
						                $count= mysqli_num_rows($result); 
						              
						                 while($row = mysqli_fetch_array($result)){
												?>
												 <li class="nav-item">
									 <a class="nav-link active  " href="winners.php?sortbyc=<?php echo $row['pos_name']; ?>&id=<?php echo $row['pos_id']; ?>"><?php echo $row['pos_name']; ?></a>
									 	</li>
												<?php
						                 }
						          
				}
				function candidate_linkres() {
					include 'connect.php';
					$electionid = $_SESSION['electsched'];
								$sql = " select * from position where election_id ='$electionid' order by `pos_id` asc ";
						                $result = mysqli_query($con,$sql); 
						                $count= mysqli_num_rows($result); 
						              
						                 while($row = mysqli_fetch_array($result)){
												?>
												 <li class="nav-item">
									 <a class="nav-link active  " href="winners.php?sortby=<?php echo $row['pos_name']; ?>&id=<?php echo $row['pos_id']; ?>"><?php echo $row['pos_name']; ?></a>
									 	</li>
												<?php
						                 }
						          
				}

				function select_candidate() {
						include 'connect.php';
						$electionid = $_SESSION['electsched'];
									$sql = " SELECT * FROM student WHERE s_id NOT IN (SELECT sv_id FROM candidate) and election_id = '$electionid' ";
							                $result = mysqli_query($con,$sql);
							                $count= mysqli_num_rows($result);
							              
							              
							        
							                 while($row = mysqli_fetch_array($result)){
							                 	$id = $row['sv_id'];
							                 	$photo = $row['photo'];
							                 	$courseid = $row['course'];
				 	 	                 	$yearid = $row['year'];
				 	 	                 	$section = $row['section'];
				 	 	                 	$isverified = $row['isverified'];
							                 		
							                 					?>
							                 					
													    <tr>
													      <th scope="row"><?php echo $row['sv_id']; ?></th>
													      <td><?php echo $row['surname']; ?></td>
													      <td><?php echo $row['name']; ?></td>
													      <td><?php echo $row['middle_name']; ?></td>
													      <td><?php echo $row['gender']; ?></td>
													      <td><?php 
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


										       ?></td>
													      <td>
													           <div class="container" style="margin: 8px;">

													           	<?php
													          /* 	if($photo == '') {
													           		?>
													           		
													           		<a href="editaccount.php?edit&id=<?php echo $row['s_id']; ?>">Update</a>
													           		<?php

													           	}else {*/
													           		if($isverified == 0){
													           			?>
													           			<span class="text-danger" style="font-size: 13px"><i class="fas fa-ban"></i> Unqualified</span>
													           			<?php
													           		}else {
													           			?>
													           		 <button class="btn btn-success btnselect" data-uid="<?php echo $row['s_id']; ?>" data-toggle="modal" data-target="#addadvocacy" style="font-size: 12px;">Select</button>
													           		<?php	
													           		}
													           		
													           	//}
													           	?>
													           
													           </div> 
													           
													        

													      </td>
													    </tr>
													<?php
							                 			
												
							                 }
							          
				}

				function select_candidatenotvalid() {
						include 'connect.php';
						$electionid = $_SESSION['electsched'];
									$sql = " SELECT * FROM student WHERE s_id NOT IN (SELECT sv_id FROM candidate) and election_id = '$electionid' ";
							                $result = mysqli_query($con,$sql);
							                $count= mysqli_num_rows($result);
							              
							        
							                 while($row = mysqli_fetch_array($result)){
							                 	$id = $row['sv_id'];
							                 	$photo = $row['photo'];
							                 	$courseid = $row['course'];
				 	 	                 	$yearid = $row['year'];
				 	 	                 	$section = $row['section'];
							                 		
							                 					?>
							                 					
													    <tr>
													      <th scope="row"><?php echo $row['sv_id']; ?></th>
													      <td><?php echo $row['surname']; ?></td>
													      <td><?php echo $row['name']; ?></td>
													      <td><?php echo $row['middle_name']; ?></td>
													      <td><?php echo $row['gender']; ?></td>
													      <td><?php 
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


										       ?></td>
													      <td>
													           <div class="container" style="margin: 8px;">

													           	<?php
													          /* 	if($photo == '') {
													           		?>
													           		
													           		<a href="editaccount.php?edit&id=<?php echo $row['s_id']; ?>">Update</a>
													           		<?php

													           	}else {*/
													           		?>
													           		<span style="color:red;font-size: 20px"><i class="fas fa-ban"></i></span>
													           		<?php
													           	//}
													           	?>
													           
													           </div> 
													           
													        

													      </td>
													    </tr>
													<?php
							                 			
												
							                 }
							          
				}

			


				function select_electActive() {
				include 'connect.php';
				
								?>
								 <table class="table table-bordered">
							  <thead>
							    <tr>
							      <th scope="col">Year</th>
							      <th scope="col">Semester</th>
							     
							      <th scope="col">Start of Event</th>
							      <th scope="col">End of Event</th>
							      <th scope="col">Date-Created</th>
							    </tr>
							  </thead>
							  <tbody>
															<?php
					
										$sql = " SELECT * FROM `election_sched` where `status` = 'active'  order by `date-modified` asc";
								                $result = mysqli_query($con,$sql); 
								                $count= mysqli_num_rows($result);
								           
								                 while($row = mysqli_fetch_array($result)){
								                 	$voterlogin = $row['voterlogin'];
								                 		$year = $row['year'];
								                 		$semester = $row['semester'];
								                 		$title = $row['title'];
								                 		$eventstart = $row['eventstart'];
								                 		$eventend  = $row['eventend'];
								                 		$lid=$row['election_id'];
														?>
														 <tr class="table-active">
													      <th scope="row"><?php 

													      echo $year.'-'.date($year+1); 
													     

													      ?></th>
													      <td><?php echo $row['semester']; ?></td>
													      
													      <td>
													      	<?php 
													      	if( $row['eventstart'] == '' || $row['eventstart'] == '0000-00-00 00:00:00') {
													      		echo 'Not Set';
													      	}else {
													      		echo date('h:i:sa F j, Y ',strtotime($eventstart));
													      	}
													      
													      	?>
													      </td>
													      <td>
													      	<?php 
													      	if( $row['eventend'] == '' || $row['eventend'] == '0000-00-00 00:00:00') {
													      		echo 'Not Set';
													      	}else {
													      		echo date('h:i:sa F j,  Y ',strtotime($eventend));
													      	}
													      
													      	?>
													      </td>
													      <td><?php echo  date('h:i:sa , F j,  Y ',strtotime($row['date-modified'])); ?></td>
													     
													    </tr>
													     
														<?php
	
								                 }
								          
								          ?>
									          </tbody>
									          <h5 style=""><?php echo $title  ?></h5>
												</table>
												<a href="#" class="btn btn-primary btnmanage" style="font-size: 14px;width: 100%" data-year="<?php echo $year ?>" data-semester="<?php echo $semester ?>"  data-eventstart="<?php echo $eventstart ?>" data-eventend="<?php echo $eventend ?>" data-lid="<?php echo $lid ?>" data-voterlog="<?php echo $voterlogin ?>" data-title="<?php echo $title ?>"  data-toggle="modal" data-target="#Manage">Manage</a>
								          <?php

					


				}

				function select_electionInactive() {
					include 'connect.php';
					?>
					<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">Year</th>
					      <th scope="col">Semester</th>
					    <th scope="col">Title</th>
					      <th scope="col">Date-Created</th>
					       <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 	
					  			$sql = "  SELECT * FROM `election_sched` where `status` = 'inactive'  order by `date-modified` asc ";
					  	                $result = mysqli_query($con,$sql); // run query
					  	                $count= mysqli_num_rows($result); // to count if necessary
					  	              if($count>=1) {
					  	                 while($row = mysqli_fetch_array($result)){
					  						?>
					  						<tr class="table-active">
										      <th scope="row"><?php 

										        echo $row['year'].'-'.date($row['year']+1); 
										       ?></th>
											 <td><?php echo $row['semester']; ?></td>
										    	<td><?php echo $row['title'] ?></td>
										      <td><?php echo  date('h:i:sa , F j,  Y ',strtotime($row['date-modified'])); ?></td>
										      <td><button class="btn btn-success btnfetch" data-shid="<?php echo $row['election_id']; ?>" style="font-size: 14px;" data-toggle="modal" data-target="#Fetchdata">Fetch Data</button>
										      	<button class="btn btn-danger btndeletesched" data-shid="<?php echo $row['election_id'];?>" style="font-size: 14px;"><i class="fas fa-times"></i></button>
										      </td>
										     	
										    </tr>
					  						<?php
					  	                 }
					  	             }else {
					  	             	?>
					  	             	<tr>
					  	             		<td colspan="4">
					  	             				<h6 style="font-weight: bolder;letter-spacing: 5px;">No schedule were inactive</h6>
					  	             		</td>
					  	             	</tr>
					  	             	<?php
					  	             }
					  	          
					  	?>
					    
					   
					  </tbody>
					</table>
					<?php
				}


		function select_adviser(){
				include 'connect.php';
				$elecid =$_SESSION['electsched'];

						$sql = " SELECT * FROM `adviser`  ";
				                $result = mysqli_query($con,$sql); 
				                $count= mysqli_num_rows($result); 
				              
				             if ($count>=1){
				             
				                 while($row = mysqli_fetch_array($result)){
				                 	$pp = $row['photo'];
				                 	$courseid =$row['scope_course'];

				                 	if($pp == ''){
				                 		$imgsrc = '../upload/undraw_profile_pic_ic5t.png';
				                 	} else {
				                 		$imgsrc = '../upload/'.$pp;
				                 	}
				                 	$active = $row['status'];
									?>
									<tr>
										<td><?php 

						                    $sqlcourse = " select * from course where courseid = '$courseid'";
						                            $resultcourse = mysqli_query($con,$sqlcourse);
						                         
						                         
						                             while($rowcourse = mysqli_fetch_array($resultcourse)){
						                    			 echo $rowcourse['course'];
						                     
						                             }
                  

										 ?></td>
										<td><?php


										$year = $row['scope_section']; 
										 $sectionqry = " select * from year where yearid = '$year' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		echo $getsec['year'];
							                             }


										?></td>
										<td><?php echo $row['lastname'] ?></td>
										<td><?php echo $row['firstname'] ?></td>
										<td><?php echo $row['middlename'] ?></td>
										
										<td><?php echo date('h:i:sa F j,  Y ',strtotime($row['date_registered'])); ?></td>
										<td>
											<?php 
											if($active == 0){
												?>
												<span class="text-danger">PASSIVE</span>
												<?php
											}else {
												?>
												<span class="text-success">ACTIVE</span>
												<?php
											}

											 ?>
											</td>
										<td>
						<div class="btn-group" role="group" aria-label="Basic example">
							  <button type="button" data-advid="<?php echo $row['adv_id'] ?>" data-course="<?php echo $row['scope_course'] ?>" data-section="<?php echo $row['scope_section'] ?>" data-lastname="<?php echo $row['lastname'] ?>" data-firstname="<?php echo $row['firstname'] ?>" data-middlename="<?php echo $row['middlename'] ?>" data-email="<?php echo $row['email'] ?>" data-pic="<?php echo $imgsrc ?>"  data-toggle="modal" data-target="#modifyadviser" data-backdrop="static" data-keyboard="false" style="font-size: 12px" class="btn btn-warning modifyadviser">Modify</button>

							  <?php 
							  if($active == 0){
							  	?>
							  	<button type="button" data-advid="<?php echo $row['adv_id'] ?>"   style="font-size: 12px" class="btn btn-danger deleteadv">Delete</button>
							  	<?php
							  }else {
							  	?>
							  	<button type="button" disabled=""    style="font-size: 12px" class="btn btn-secondary ">Delete</button>
							  	<?php
							  }
							   ?>
							  
							 
							</div>
							</td>
									</tr>

									<?php
				                 }
				          }
		}	

		function select_section(){
				include 'connect.php';
				$elecid =$_SESSION['electsched'];

							$sql = " SELECT * FROM `section`  ";
						                $result = mysqli_query($con,$sql); // run query
						                $count= mysqli_num_rows($result); // to count if necessary
						               //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
						             if ($count>=1){
						             	//while($row = mysqli_fetch_array($result)){} is where we output all the data in database
						                 while($row = mysqli_fetch_array($result)){
											?>
											<tr>
												<td></td>
												<td><?php echo $row['section'] ?></td>
												<td>
												<a class="btn btn-success editsection" data-secid="<?php echo $row['sec_id'] ?>" data-section="<?php echo $row['section'] ?>" data-toggle="modal" data-target="#modifysec" data-backdrop="static" data-keyboard="false"  style="font-size:12px;" style="font-size: 12px"><i class="fas fa-pen"></i></a>	
												<a class="btn btn-danger deletesection" data-secid="<?php echo $row['sec_id'] ?>" data-section="<?php echo $row['section'] ?>" style="font-size: 12px"><i class="fas fa-times"></i></a>	

												</td>
											</tr>
											<?php
						                 }
						          }	
		}		
			
		}

?>
