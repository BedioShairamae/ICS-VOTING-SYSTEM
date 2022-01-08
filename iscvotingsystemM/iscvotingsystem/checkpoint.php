<?php 
session_start();
include 'admin/connection/connect.php';
 ?>
<!DOCTYPE html>
<html>

<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	 <!--<link rel="shortout icon" type="image/x-icon" href="">--> <!---->
    	  <script src="https://kit.fontawesome.com/129b086bc9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<title>Confirm Personal Data</title>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap');
	body{
		background-color: #ced9cf;
 	font-family: 'Barlow Semi Condensed', sans-serif;
	}
</style>
</head>
<body>


	<?php //?>

		<div class="container mt-5">
		<div class="row">
				
				  <div class="col-md-2"></div> 
				  <div class="col-md-8">
				  	 <div class="card shadow">
				  	 	 <div class="card-body">
				  	 	 		<h5>Confirm your personal data.</h5>
				  	 	 		<span style="font-size: 12px;font-style: italic">This is due to a scheduling change, and your account will be validated by the advisor.</span><br>
				  	 	 		<span style="font-size: 12px;font-style: italic;color: red">You can change any data you wish.</span>
				  	 	 		<hr>
				  	 	 		 <form method="post" action="checkstatus.php" id="checkpoint" onsubmit="return false" >
				  	 	 		    		<input type="hidden" name="triggerring">                  
				  	 	 		
				  	 	 		
				  	 	 		<?php 
				  	 	 		$sid = $_SESSION['voter_login'];
				  	 	 				$sql = " select * from student where s_id='$sid'  ";
				  	 	 		                $result = mysqli_query($con,$sql); // run query
				  	 	 		                $count= mysqli_num_rows($result); // to count if necessary
				  	 	 		               //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
				  	 	 		             if ($count==1){
				  	 	 		             	//while($row = mysqli_fetch_array($result)){} is where we output all the data in database
				  	 	 		                 while($row = mysqli_fetch_array($result)){
				  	 	 		                 	$cours = $row['course'];
				  	 	 		                 	$yr = $row['year'];
				  	 	 		                 	$sc = $row['section'];

				  	 	 								?>
				  	 	 								 <div class="row">
				  	 	 								 	 <div class="col-md-6">
				  	 	 								 	 	<label>Surname</label>
				  	 	 								 	 	<input type="text"  name="sname" class="form-control mb-2" value="<?php echo $row['surname'] ?>">
				  	 	 								 	 	<label>Name</label>
				  	 	 								 	 	<input type="text" name="fname" class="form-control mb-2" value="<?php echo $row['name'] ?>">
				  	 	 								 	 	<label>Middle name</label>
				  	 	 								 	 	<input type="text" name="mname" class="form-control mb-2" value="<?php echo $row['middle_name'] ?>">
				  	 	 								 	 </div> 
				  	 	 								 	 <div class="col-md-6">
				  	 	 						<label>Course</label> 
						 	 					<select style="margin-top: 10px;" class="form-select" name="txtcourse" required="" value="<?php echo $row['course'] ?>">
						 	 						<?php 
						 	 									$sqls = " select * from course where courseid = '$cours'  ";
						 	 							                $results = mysqli_query($con,$sqls); 
						 	 							              
						 	 							              
						 	 							           
						 	 							                 while($row = mysqli_fetch_array($results)){
						 	 							                 
						 	 											?>
						 	 											<option value="<?php echo $row['courseid']; ?>"><?php echo $row['course']; ?></option>
						 	 											<?php
						 	 							                 }

						 	 							                 $sqlss = " select * from course  ";
						 	 							                $resultss = mysqli_query($con,$sqlss); 
						 	 							              
						 	 							              
						 	 							           
						 	 							                 while($row = mysqli_fetch_array($resultss)){
						 	 							                 
						 	 											?>
						 	 											<option value="<?php echo $row['courseid']; ?>"><?php echo $row['course']; ?></option>
						 	 											<?php
						 	 							                 }
						 	 							          
						 	 							 ?>
						 	 						
						 	 					</select>

				  	 	 								 	 	<label>Year</label> <select class="form-select" name="yr" required="" value="<?php echo $row['year'] ?>">
						 	 							<?php 
						 	 									$sql = " select * from year where yearid = '$yr' ";
						 	 							                $result = mysqli_query($con,$sql); 
						 	 							                $count= mysqli_num_rows($result); 
						 	 							              
						 	 							           
						 	 							                 while($row = mysqli_fetch_array($result)){
						 	 											?>
						 	 											<option value="<?php echo $row['yearid']; ?>"><?php echo $row['year']; ?></option>
						 	 											<?php
						 	 							                 }
						 	 							                 $sqll = " select * from year ";
						 	 							                $resultl = mysqli_query($con,$sqll); 
						 	 							              
						 	 							           
						 	 							                 while($row = mysqli_fetch_array($resultl)){
						 	 											?>
						 	 											<option value="<?php echo $row['yearid']; ?>"><?php echo $row['year']; ?></option>
						 	 											<?php
						 	 							                 }
						 	 							          
						 	 							 ?>
						 	 						
						 	 					
						 	 					</select>
				  	 	 								 	 		<label>Section
						 	 					</label>
						 	 				
						 	 					<select class="form-select" name="txtsection" value="<?php echo $row['section'] ?>">
						 	 							 <?php 
											                    $sql = " select * from section where sec_id = '$sc' ";
											                            $result = mysqli_query($con,$sql);
											                         
											                         
											                             while($row = mysqli_fetch_array($result)){
											                      ?>
											                       <option value="<?php echo $row['sec_id'] ?>"><?php echo $row['section'] ?></option>
											                      <?php
											                             }


											                               $sqltt = " select * from section ";
											                            $resulttt = mysqli_query($con,$sqltt);
											                         
											                         
											                             while($row = mysqli_fetch_array($resulttt)){
											                      ?>
											                       <option value="<?php echo $row['sec_id'] ?>"><?php echo $row['section'] ?></option>
											                      <?php
											                             }
											                   ?>
						 	 					</select>

				  	 	 								 	 </div> 

				  	 	 								 	 <div class="container mt-4">
				  	 	 								 	 	 <button class="btn btn-success" type="submit" style="width: 100%">Confirm</button>
				  	 	 								 	 </div> 
				  	 	 								 	 
				  	 	 								 	 
				  	 	 								 </div> 
				  	 	 								 
				  	 	 								

				  	 	 								<?php
				  	 	 		                 }
				  	 	 		          }

				  	 	 		 ?>

				  	 	 		  </form>

				  	 	 </div> 
				  	 	 
				  	 </div> 
				  	 
				  </div> 
				  <div class="col-md-2"></div> 
				  
				 
				 

		</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			
			$(document).ready(function() {
				$('#checkpoint').on('submit', function(event){
				   event.preventDefault();
				   			 $.ajax({
					                 url : $(this).attr('action'),
					                  method: "POST",
					                   data  : $(this).serialize(),
					                   success : function(data){
					      					Swal.fire(
											  'Account updated!',
											  'You are subject to verification!',
											  'success'
											).then((result) => {
  /* Read more about isConfirmed, isDenied below */
											  if (result.isConfirmed) {
											   window.location.href="home.php";
											  }
											})
					                   }
					                })
				   });
					             
			      });      
		      	
		</script>


</body>
</html>