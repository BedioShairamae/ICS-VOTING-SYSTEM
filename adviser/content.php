<?php 
session_start();
include '../admin/connection/connect.php';

if(isset($_POST['getadviserdetails'])){ 
	$advid = $_SESSION['adviser_login'];

			$sql = " select * from adviser where adv_id = '$advid'  ";
	                $result = mysqli_query($con,$sql); // run query
	              
	                 while($row = mysqli_fetch_array($result)){
	                 	if($row['photo'] == '') {
					                                   
					             
							$imagesrc = "../upload/undraw_profile_pic_ic5t.png";
											
					     }else {
					         $imagesrc = "../upload/".$row['photo'];
					    }
					?>
					 <div class="" style="text-align: center;"> 
					 <img src="<?php echo $imagesrc ?>" class="rounded-circle" style="width: 150px;height: 150px;">
					 <button class="mb-2 btn btn-light" style="font-size: 12px" data-toggle="modal" data-target="#updatephoto" data-backdrop="static" data-keyboard="false"><span >Update photo </span><i class="fas fa-edit"></i></button> 
					<h5 style="font-weight: normal;text-transform: uppercase;"><?php echo $row['lastname'].' '.$row['firstname'] ?></h5>
					<span style="font-size: 13px"><?php echo $row['email'] ?></span>
					<button class="btn btn-light" style="font-size: 15px;float: right;position: absolute; right: 0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
						   <i class="fas fa-user-edit"></i>
						  </button>
					</div>




</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
  	
   <form method="post" action="action.php" onsubmit="return false" id="updateaccount" >
   	<input type="hidden" name="updateaccount">



   		<label>Last Name</label>
      	<input type="text" name="lastname" value="<?php echo $row['lastname'] ?>" class="form-control" required> 
      	<label>First Name</label>
      	<input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control" required> 
      	<label>Middle Name</label>
      	<input type="text" name="middlename" value="<?php echo $row['middlename'] ?>" class="form-control" >  

      	<label>Email</label>
      	<input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" required>    

      	<label>Password</label>
      	<input type="password" name="password" value="<?php echo $row['password'] ?>" class="form-control" required>   
      	<br>
      	<label>Enter Current Password</label>
      	<input type="password" name="" value="" id="currentpass" class="form-control" required="">    
      	 <input type="checkbox"  name="" id="showpass" >
                         Show Password</label>

                    
                       

                       
                        

                      
                      

                       <script type="text/javascript">
                        //<i class="far fa-eye-slash"></i>
                       
                         $('#showpass').click(function() {
                              if($(this).prop("checked") == true) {
                                        $('#currentpass').attr('type','text');                            
                                 }
                              else if($(this).prop("checked") == false) {
                                        $('#currentpass').attr('type','password');                          
                               }
                            });
                        
                       </script>  
      	<button type="submit" class="btn btn-success mt-3" style="font-size: 12px;width: 100%" id="saveupdate" disabled=""> Save</button>    <label for="showpass" style="cursor: pointer;user-select: none;font-size: 14px;padding-left: 10px">
                        
                                     
   </form>
  
  </div>
</div>
					<?php
	                 }
	          
	
}
if(isset($_POST['getvoterdetails'])){ 
	$electionid = $_SESSION['election_id'];
	?>
	<script type="text/javascript" src="../admin/include/datatable/datatable.js"></script>
		 <div class="table-responsive">
		 
  <table class="table table-hover table-sm " id="table_id1">
  <thead class="thead-dark">
    <tr>
    	<th scope="col"><input type="checkbox" id="checkitall" name=""></th>
      <th scope="col">Voters-iD</th>
      <th scope="col">Last Name</th>
      <th scope="col">Given Name</th>
      <th scope="col">Middle Name</th>
      <th scope="col">Gender</th>
   <th scope="col">Course&year</th> 
     <!-- <th scope="col">Date-Registered</th>-->
      <th scope="col">Status</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>


	<?php	
	$scopesections = $_SESSION['scopesection'];
	$scopecourses = $_SESSION['scopecourse'];
			$sql = " select * from student where election_id = '$electionid' and year = '$scopesections' and course = '$scopecourses'  ";
				 	 	                $result = mysqli_query($con,$sql);
				 	 	 					$count= mysqli_num_rows($result); // to count if necessary
				 	 	             	            


				 	 	 					

				 	 	             	             if ($count>=1){
				 	 	             	          ?>

				 	 	             	          <div class="card mb-3">
				 	 	 					 	<div class="card-body" >
				 	 	 					 		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Sigmar+One&display=swap" rel="stylesheet">
											<span class="text-dark" style="padding: 5px;font-weight: bolder;font-size: 20px;">
												Verification of a student's Registration
											</span>
				 	 	 					 	<span class="text-dark" style="padding: 5px;font-weight: bolder;font-size: 24px; float:right;">	 
				 	 	 					 		 <!-- Example single danger button -->

											<?php 
											$scopecourse = $_SESSION['scopecourse'];
											$scopesection = $_SESSION['scopesection'];
											$course = " select * from course where courseid = '$scopecourse'  ";
										                      $resulta = mysqli_query($con,$course);
										                    
										                    
										                       while($getcourse = mysqli_fetch_array($resulta)){
										      						echo $getcourse['course'].'-';
										                       }


										            $sectionqry = " select * from year where yearid = '$scopesection' ";
							                            $resultsectionqry = mysqli_query($con,$sectionqry);
							                         
							                         
							                             while($getsec = mysqli_fetch_array($resultsectionqry)){
							                     		echo $getsec['year'];
							                             }           

											?>
												</span>

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
										      	<!--	<div class="btn-group" role="group" aria-label="Basic example"> -->
										<button onclick="window.location.href='index.php?view&id=<?php echo $row['s_id']; ?>' " class="btn btn-warning mb-1" type="button" style="font-size: 12px;font-weight: bolder;width: 100%">view</button>

										
											<?php 

											
											 if($count >=1 ){ 
											 	if($isverified == 0){ 
												?>
												<button class="btn btn-success btnverify mb-1" type="button" data-sid="<?php echo $s_id ?>" style="font-size: 12px;font-weight: bolder;width: 100%">Verify</button>
												<?php
											}else {
												?>
												<button class="btn btn-secondary mb-1" type="button" data-sid="<?php echo $s_id ?>"  style="font-size: 12px;font-weight: bolder;width: 100%">Revoke</button>
												<?php
											}
											 	?>
											 	 <button class="btn btn-secondary mb-1" type="button" style="font-size: 10px;width: 100%"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
											 	<?php


											 }else {
											 	if($isverified == 0){ 
											 		?>
											 		<button class="btn btn-success btnverify mb-1" type="button" data-sid="<?php echo $s_id ?>" style="font-size: 12px;font-weight: bolder;width: 100%">Verify</button>  


											 	 <button class="btn btn-danger btndel mb-1" type="button" data-cid="<?php echo $row['s_id']; ?>" style="font-size: 10px;width: 100%"><i style="font-size: 12px;" class="far fa-times-circle"></i></button>
											 	<?php
											 	}else {
											 	?>
											 	<button class="btn btn-danger btnrevoke mb-1" type="button" data-sid="<?php echo $s_id ?>"  style="font-size: 12px;font-weight: bolder;width: 100%">Revoke</button>

											 	 <button class="btn btn-secondary " type="button"  style="font-size: 10px;width: 100%"><i style="font-size: 12px;" class="far fa-times-circle" disabled=""></i></button>

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
				 	 	             	?>
				 	 	 					 <div class="card mb-3">
				 	 	 					 	<div class="card-body" style="text-align: right;">
				 	 	 					 		 
				 	 	 					 		 <!-- Example single danger button -->
							<div class="btn-group">
							  <button style="font-size: 12px;" type="button" class="btn btn-secondary dropdown-toggle mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <i class="fas fa-database"></i> Fetch Voters Data 
							  </button>
							  <div class="dropdown-menu">
							
							    <?php 
							    $fetchanother = "select * from `election_sched` where election_id != '$electionid'";
							    $resultfetchanother  = mysqli_query($con,$fetchanother);
							     while($fetch = mysqli_fetch_array($resultfetchanother)){ 
							     	?>
							     	 <button class="dropdown-item fetchdata" type="button" data-id="<?php echo $fetch['election_id'] ?>" href="javascript:void(0)"><?php echo $fetch['title'] ?></button>
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
?>
</tbody>
</table>
</div> 
 <div class="mt-4">

Options on Selected : <button type="button" class="btn btn-primary" id="clearselected" style="font-size: 12px">Clear Selected</button> <button type="submit" name="verifyit" id="verifyit" class="btn btn-success" style="font-size: 12px">Verify</button> <button type="submit" name="rev" id="revokeit" class="btn btn-danger" style="font-size: 12px">Revoke</button> <button class="btn btn-danger" name="deleteit" style="font-size: 12px" type="submit" id="deleteit">Delete</button>
</div> 


<?php

}

 ?>
 <script type="text/javascript">
 	$(document).ready(function() {
 			$('#table_id1').DataTable();     

 			  $('.btnverify').click(function() { 
      var id = $(this).data('sid');
       Swal.fire({
        title: 'Mark as Verified?',
        text: "The voter will be able to vote and escape viewing mode.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#36b9cc',
        cancelButtonColor: '#f6c23e',
        confirmButtonText: 'Yes, Mark as verified!'
      }).then((result) => {
        if (result.isConfirmed) {
           
               var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
               Swal.fire(
                    'Voter',
                    'Was Marked Verified Successfully!',
                    'success'
                  ).then((result) => {
                if (result.isConfirmed) {
               voters_details();
                }
              })
                           }
                        };
                xhttp.open("POST", "../admin/reset.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("verify=1&id="+id);
                    
                             


                  //
        }
      })
    
    
     })    

 			  $('.btnrevoke').click(function() { 
          
             var id = $(this).data('sid');
          Swal.fire({
        title: 'Are you sure?',
        text: "Revoking the validity of voter to vote. it will disable the voters right to vote!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74a3b',
        cancelButtonColor: '#f6c23e',
        confirmButtonText: 'Yes, Revoke!'
      }).then((result) => {
        if (result.isConfirmed) {
           
               var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
               Swal.fire(
                    'Voters Validity to Vote',
                    'Has been revoked Successfully, if you regret it Undo action by clicking Verify!',
                    'warning'
                  ).then((result) => {
                if (result.isConfirmed) {
                   voters_details();
                }
              })
                           }
                        };
                xhttp.open("POST", "../admin/reset.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("revoke=1&id="+id);
                    
                             


                  //
        }
      })
     })

 			  $('.btndel').click(function() { 
 			  var id = $(this).data('cid');
 			  	Swal.fire({
					  title: 'Are you sure?',
					  text: "You Want to Delete this Voter? You wont be able to revert this.",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#e74a3b',
					  cancelButtonColor: '#f6c23e',
					  confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.isConfirmed) {
					  		
					  		var xhttp = new XMLHttpRequest();
 			 		xhttp.onreadystatechange = function() {
 			 		 if (this.readyState == 4 && this.status == 200) {
 			 		const data = this.responseText;
 			 		Swal.fire(
								  'Voter Deleted Successfully!',
								  '',
								  'success'
								)
 			 	
 			 		voters_details();
 			 	
 			 					       }
 			 					    };
 			 			xhttp.open("POST", "../admin/action.php",true);
 			 			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 			 			xhttp.send("deletestudent=1&svid="+id);
					   
					  }
					})
 			 		
 			 	
 			 					
 			 	      	      	 


 			  })
 			   $('#checkitall').click(function() {
      	      if($(this).prop("checked") == true) {
      	           	$('.checkit').prop('checked',true);                          		
      	         }
      	      else if($(this).prop("checked") == false) {
      	      		$('.checkit').prop('checked',false); 
      	                                       
      	       }
      	    });
 			  $('#clearselected').click(function() { 
      	 	$('.checkit').prop('checked',false); 
      	 	$('#checkitall').prop('checked',false);
      	 })

 			   $('#verifyit').click(function() { 
      	 	$('#selecttrigger').val('verify');
      	 
      	 })
      	 $('#revokeit').click(function() { 
      	 	$('#selecttrigger').val('revoke');
      	 })
      	 $('#deleteit').click(function() { 
      	 	$('#selecttrigger').val('delete');
      	 
      	 })

      	  $('#selectallsubmit').on('submit', function(event){
      	    event.preventDefault();

      	    var selecttrigger = $('#selecttrigger').val();


      	 var atLeastOneIsChecked = $('input[name="selectcheck[]"]:checked').length > 0;
      	   if(atLeastOneIsChecked == false){
      	   	Swal.fire(
					  'No Selected Voter',
					  'Please select one or more to '+selecttrigger+'!',
					  'error'
					)
      	   }else {

      	    		   if(selecttrigger == 'verify'){
      	    	   Swal.fire({
        title: 'Mark all selected as Verified?',
        text: "The voters will be able to vote and escape viewing mode.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#36b9cc',
        cancelButtonColor: '#f6c23e',
        confirmButtonText: 'Yes, Mark as verified!'
      }).then((result) => {
        if (result.isConfirmed) {
        						 var xhttp = new XMLHttpRequest();
      	 	                	xhttp.onreadystatechange = function() {
      	 	                	 if (this.readyState == 4 && this.status == 200) {
      	 	                	const data = this.responseText;
      	 	                
      	 	                		Swal.fire(
								  'Voters Were Marked as Verified Successfully!',
								  '',
								  'success'
								)
      	 	                		  voters_details();

      	 	                				       }
      	 	                				    };
      	 	                		xhttp.open("POST",$(this).attr('action'),true);
      	 	                		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	 	                		xhttp.send($(this).serialize());

        }

    })
      	    
      	    }else if (selecttrigger == 'revoke'){
      	    		Swal.fire({
					  title: 'Are you sure?',
					  text: "You Want to Revoke all SELECTED Voter at once?",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#e74a3b',
					  cancelButtonColor: '#f6c23e',
					  confirmButtonText: 'Yes, revoke it!'
					}).then((result) => {
					  if (result.isConfirmed) {
					    var xhttp = new XMLHttpRequest();
      	 	                	xhttp.onreadystatechange = function() {
      	 	                	 if (this.readyState == 4 && this.status == 200) {
      	 	                	const data = this.responseText;
      	 	                
      	 	                			Swal.fire(
								  'All selected Voters has been Revoked Successfully!',
								  'Voters that is fully verified will be revoked and have to be verify again',
								  'success'
								)
      	 	                		  voters_details();
      	 	                				       }
      	 	                				    };
      	 	                		xhttp.open("POST",$(this).attr('action'),true);
      	 	                		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	 	                		xhttp.send($(this).serialize());
					  }
					})
      	    }
		 else if (selecttrigger == 'delete'){

      	    		Swal.fire({
					  title: 'Are you sure?',
					  text: "You Want to Delete all SELECTED Voter at once? You wont be able to revert this.",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#e74a3b',
					  cancelButtonColor: '#f6c23e',
					  confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.isConfirmed) {
					    var xhttp = new XMLHttpRequest();
      	 	                	xhttp.onreadystatechange = function() {
      	 	                	 if (this.readyState == 4 && this.status == 200) {
      	 	                	const data = this.responseText;
      	 	                
      	 	                			Swal.fire(
								  'All selected Voters were Deleted Successfully!',
								  'Only Voters that is not yet verified will be removed from the system',
								  'success'
								)
      	 	                		  voters_details();
      	 	                				       }
      	 	                				    };
      	 	                		xhttp.open("POST",$(this).attr('action'),true);
      	 	                		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	 	                		xhttp.send($(this).serialize());
					  }
					})

      	    }
      	   }
      	


      	    			
      	    });
$('#updateaccount').on('submit', function(event){
   event.preventDefault();
   			
   			 	 var xhttp = new XMLHttpRequest();
   			 	xhttp.onreadystatechange = function() {
   			 	 if (this.readyState == 4 && this.status == 200) {
   			 	const data = this.responseText;
   			 	Swal.fire(
								  'Account Updated Successfully!',
								  '',
								  'success'
								)
   			 		adviser_details();
   			 
   			 				       }
   			 				    };
   			 		xhttp.open("POST", $(this).attr('action'),true);
   			 		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   			 		xhttp.send($(this).serialize());

   			 		

   			 				
   			       	      	 
   });

function adviser_details(){
	 			
	 			   	 var xhttp = new XMLHttpRequest();
	 			   	xhttp.onreadystatechange = function() {
	 			   	 if (this.readyState == 4 && this.status == 200) {
	 			   	const data = this.responseText;
	 			   
	 			   	$('#adviser_details').html(data);
	 			  
	 			   				       }
	 			   				    };
	 			   		xhttp.open("POST", "content.php",true);
	 			   		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 			   		xhttp.send("getadviserdetails=1");
	 			   				
	 			         	      	 
	 			    
	 			    
	 		}


function voters_details(){
	 				  
	 				  	 var xhttp = new XMLHttpRequest();
	 			   	xhttp.onreadystatechange = function() {
	 			   	 if (this.readyState == 4 && this.status == 200) {
	 			   	const data = this.responseText;
	 			   
	 			   $('#voters_details').html(data);
	 			  
	 			   				       }
	 			   				    };
	 			   		xhttp.open("POST", "content.php",true);
	 			   		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 			   		xhttp.send("getvoterdetails=1");
	 		}

	 		$('#currentpass').keyup(function(){ 
	 			var val = $(this).val();
	 				
	 				 var xhttp = new XMLHttpRequest();
	 				xhttp.onreadystatechange = function() {
	 				 if (this.readyState == 4 && this.status == 200) {
	 				const data = this.responseText;
	 			
	 				if(data == 'right'){
	 					$('#saveupdate').removeAttr('disabled');
	 				}else if(data=='wrong'){
	 					$('#saveupdate').attr('disabled',true);
	 				}
	 			
	 							       }
	 							    };
	 					xhttp.open("POST", "action.php",true);
	 					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 					xhttp.send("compare=1&val="+val);
	 							
	 			      	      	 
	 		
	 		})
 	});
 
       	
 </script>