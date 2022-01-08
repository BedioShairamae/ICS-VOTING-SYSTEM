<?php
session_start();
 include 'include/header.html';
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
              	
              
				 $dateandtime = date("Y-m-d H:i:s");
				
               if($eventstart <= $dateandtime && $eventend <= $dateandtime )  {


			     	 //header("location:election_end.php");
		      }
 ?>
			<body style="background-color: rgb(217, 217, 217);">
			
				
		

            


				<div class="container" style="margin-top: 40px; cursor: default;">
					<p><br></p>
				     	<div class="card" style="border-top: 5px solid #2a5427;border-bottom: 5px solid #2a5427">
				     		 <div class="container" style="text-align: center;">
				     		 	
				     		 	
				     		 		<p></p>
				     		 	<h4 style="color: red;font-weight: bolder;">CHANGE OF SCHEDULE DETECTED! <i class="fas fa-exclamation-triangle"></i></h4>
				     		 	<h5>This is Due to Election nearly Ends .</h5>
				     		 	<h5>We are Redirecting you to Login Page..</h5>
				     		 	<h5><p id="demo"></p></h5>
						<div class="row begin-countdown">
					  <div class="col-md-12 text-center">
					    <progress value="8" max="8" id="pageBeginCountdown"></progress>
					    <p> Within  <span id="pageBeginCountdownText">8 </span> seconds</p>
					  </div>
					</div>
					<script>
					
					ProgressCountdown(8, 'pageBeginCountdown', 'pageBeginCountdownText').then(value => alert(`Page has started: ${value}.`));

							function ProgressCountdown(timeleft, bar, text) {
							  return new Promise((resolve, reject) => {
							    var countdownTimer = setInterval(() => {
							      timeleft--;

							      document.getElementById(bar).value = timeleft;
							      document.getElementById(text).textContent = timeleft;

							      if (timeleft <= 0) {
							        clearInterval(countdownTimer);
							       window.location.href="logout.php";
							      }
							    }, 1000);
							  });
							}
												</script>
				     		 	<p></p>
				     		 		
				     		 	
				     		 </div> 
				     		 
				     	</div>
				     	<p><br></p>
			 </div> 
				

		 	
				
	 		
		 	





			</body>
	
<?php include 'include/footer.html'?>
