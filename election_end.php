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
              

              
				 $dateandtime = date("Y-m-d H:i:s");
				
            
 ?>
			<body style="background-color: rgb(217, 217, 217);" >
			
				
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			
	let timerInterval
Swal.fire({
  title: 'Election has Ended!',
  html: '',
  timer: 1000,
  icon: 'info',
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    
  }
})      
		      	
		</script>

            


				<div class="container" style="margin-top: 45px; cursor: default;">
					<p><br></p>
				     	<div class="card shadow" style="border-top: 5px solid #2a5427;border-bottom: 5px solid #2a5427">
				     		 <div class="container" style="text-align: center;">
				     		 	<?php
				     		 	include 'admin/connection/connect.php';
				     		 
				     		 		
									unset($_SESSION['voter_login']);

									$selectactive = " select * from election_sched where status = 'active'  ";
					        $resultselect = mysqli_query($con,$selectactive); 
					                 							
					         while($active = mysqli_fetch_array($resultselect)){
					               $electid = $active['election_id'];
					               $checken = $active['voterlogin'];
					               	$eventstart = $active['eventstart'];
									  $eventend = $active['eventend'];	
									  $elecyear = $active['year'];
									  $elecsem = $active['semester'];
									  $title = $active['title'];
									  $electionresult = $active['result'];
					               }
				     		 		?>
				     		 		<p></p>
				     		 		
				     		 		 
				     		 	<h1 style="font-weight: 20px; font-weight: bolder;" class="mb-5"><?php echo $title ?> <br> <span style="font-weight: normal;">has ended..</span> </h1>

				     		 			
				     		 	
				     		 			 
				     		 		<p></p>
				     		 		<?php
				     		 		if ($electionresult == 0){
				     		 			?>
				     		 			<h4 class="mb-4">As of this moment, no results are available. <br> The system will provide you a link for the results through email <br> or you can check here later, please standby. </h4>
				     		 			<?php
				     		 		}else {
				     		 			?>
				     		 			<a class="mb-4 btn btn-success" href="result.php"><?php echo $title ?> RESULTS <i class="fas fa-poll-h"></i></a>
				     		 			<?php
				     		 		}
				     		 
				     		 	?>
				     		 	
				     		 </div>  
				     		 	
				     	</div>
				     	<p><br></p>
			 </div> 
				

		 	
				
	 		<script type="text/javascript">
	 			
	 			function myFunction() {
			
			$('.card').addClass('sink');
			}     

			$(window).scroll(function() {
				
    if ($(this).scrollTop() < 100) {
	 	
		    }
		}); 
	 		      	
	 		</script>
		 	





			</body>
	
<?php include 'include/footer.html'?>
