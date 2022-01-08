<?php
session_start();
unset($_SESSION['election_id']);
	unset($_SESSION['voter_login']);

	include 'admin/connection/connect.php';
$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                 							
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];
               $checken = $active['voterlogin'];
               	$eventstart = $active['eventstart'];
				  $eventend = $active['eventend'];	
				  $elecyear = $active['year'];
				  $elecsem = $active['semester'];
               }
              

               if($checken == 'enabled') {
               	header("location:index.php");
               }
                date_default_timezone_set('Asia/Manila');
				 $dateandtime = date("Y-m-d H:i:s");
              
 include 'include/header.html';
 ?>
			<body style="background-color: rgb(217, 217, 217);">
			
				
		

            


				<div class="container" style="margin-top: 40px; cursor: default;">
					<p><br></p>
				     	<div class="card" style="border-top: 5px solid #2a5427;border-bottom: 5px solid #2a5427">
				     		 <div class="container" style="text-align: center;">
				     		 	<p></p>
				     		 	<h1 >System is under maintenance  <i class="fas fa-tools"></i></h1>
				     		 	<h2><i class="fas fa-cog fa-spin"></i></h2>
				     		 	<h5>The system is temporarily unavailable for voters. <br>Please wait, we’ll get to you in an instant. Thank you!</h5>
				     		 	<h5><p id="demo"></p></h5>
						
				     		 	<p><br></p>
				     		 </div> 
				     		 
				     	</div>
				     	<p><br></p>
			 </div> 
				

		 	
				
	 		
		 	





			</body>
	
<?php include 'include/footer.html'?>
