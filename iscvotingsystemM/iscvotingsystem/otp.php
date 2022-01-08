 <?php 
session_start();
//
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
				
				  <div class="col-md-4"></div> 
				  <div class="col-md-5">
				  	 <div class="card shadow-sm mt-5">
				  	 	 <div class="card-body">
				  	 			 <div class="container">
				<h6>Enter your ONE-TIME-PIN code sent to your email <br>( <span style="font-weight: bold"><?php echo $_SESSION['useremail']?></span> )</h6>

				  	 			 	
				  	 			 		<input type="password" class=" mt-3" id="otp" name="" style="text-align: center; border:none;outline:none;width: 100%" placeholder="Enter Code">
				  	 			 		<div id="note"></div>
				  	 			 		<hr>

				  	 			 		<button class="btn btn-light text-primary confirm " style="float: right;font-size: 14px;margin-left: 8px;">Confirm</button>
				  	 			 		<button class="btn btn-light text-success " onclick="location.reload()" style="float: right;font-size: 14px">Resend</button>
				  	 			 		<span style="font-size: 14px" class="text-danger"> No one can access your account without providing this OTP.</span>
				  	 			 </div> 
				  	 			 
				  	 		

				  	 	 </div> 
				  	 	 
				  	 </div> 
				  	 
				  </div> 
				  <div class="col-md-3"></div> 
				  
				 <input type="hidden" name="" id="useremail" value="<?php echo $_SESSION['useremail']  ?>">
				 

		</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			
			$(document).ready(function() {
					$('.confirm').click(function() { 
						var otp = $('#otp').val();
							if(otp == ""){
								$('#note').html('<span class="text-danger" style="font-size:14px">Please enter code.</span>');
							}else {
								 $.ajax({
						           url : "login.php",
						            method: "POST",
						             data  : {confirm:1,otp:otp},
						             success : function(data){
									if(data.match("good")){
										window.location.href="home.php";
						             }else if (data.match("wrong")){
						             	$('#note').html('<span class="text-danger" style="font-size:14px">Incorrect Code.</span>');
						             }
									}
						          })

							}
						  
						    
						    
					
					})
					sendmail();
					function sendmail(){

						var email = $('#useremail').val();
						  
						   $.ajax({
						           url : "sendmail/senduniqueotp.php",
						            method: "POST",
						             data  : {sendotp:1,email:email},
						             success : function(data){
											
						             }
						          })
						     
						    
					}
					             
			      });      
		      	
		</script>


</body>
</html>