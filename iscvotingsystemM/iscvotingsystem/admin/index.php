<?php
session_start();
if(isset($_SESSION['admin_id_token'])) {
	header("location:statistics.php");
}else if (!isset($_SESSION['admin_id_token'])) {
	
}
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
<title>VS-Admin</title>
</head>
<body style="background-color: #ced9cf">
	<p></p>
	<div class="container" style="margin-top:30px;">
	<div class="row">
		 <div class="col-sm-4"></div> 
		 <style type="text/css">
		 	@import url('https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap');
		 	* {
		 		 font-family: 'Barlow Semi Condensed', sans-serif;
		 	}
		 	.img h5 {
		 		font-weight: bolder;
		 		font-size: 28px;
		 	}
		 	.img h6 {
		 		color: grey;
		 	}
		 	.button {
		 		height: 50px;
		 		background-color: rgb(11, 57, 11);
		 	}
		 	.button:hover {
		 		background-color: rgb(57, 94, 57);
		 	}
		 </style>
		<div class="col-sm-4 col-md-4">
			 <div class="card" style="box-shadow: rgba(0,0,0,.8);cursor: default; border-top: 3px solid #0d4b23; border-bottom:  3px solid #0d4b23;border-radius: 20px">
			 	 <form method="post" id="login_form">
			 	 	 <div class="container">
			 	 	 		 <div class="img" style="text-align: center;">
			 	 	 		 	<p></p>
			 	 	 		 	<img src="../include/png/icslogo.png" class="rounded" width="190">
			 	 	 		 	<br><h5>ISC Voting System</h5>
			 	 	 		 	<h6>Administrative Login</h6>


			 	 	 		 	<br>
			 	 	 		 	<span id="alerto"></span>
			 	 	 		 	
			 	 	 		 </div> 
			 	 	 		 <label>Enter Username</label>
			 	 	 		 	<input type="text" name="txtuser" class="form-control" required="">
			 	 	 		 	<p></p>
			 	 	 		 	 <label>Enter Password</label>
			 	 	 		 	 <p></p>
			 	 	 		 	<input type="password" name="txtpass" id="txtpassword" class="form-control" required="">
			 	 	 		 	  <label for="showpass" class="eye" style="cursor: pointer;user-select: none;font-size: 14px">
								 <input type="checkbox"  name="" id="showpass" >
								    Show Password</label>
			 	 	 		 	

								    	 <script type="text/javascript">
								    	 	//<i class="far fa-eye-slash"></i>
								    	 	
								    	 	 $('#showpass').click(function() {
								    	 	      if($(this).prop("checked") == true) {
								    	 	                $('#txtpassword').attr('type','text');                        		
								    	 	         }
								    	 	      else if($(this).prop("checked") == false) {
								    	 	                $('#txtpassword').attr('type','password');                          
								    	 	       }
								    	 	    });
								    	 	
								    	 </script>
			 	 	 		 	
			 	 	 		 	<input type="submit" name="btnlogin" class="btn btn-primary form-control button mt-4" value="LOGIN">
			 	 	 		 	<p><br></p>

			 	 	 		 
			 	 	 </div> 
			 	 	 
			 	    	

			 	    	                  
			 	 </form>
			 	

			 </div> 
			 
		</div>
	 <div class="col-sm-4"></div> 
	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	
	<script>
	$(document).ready(function() {
		$('#login_form').on('submit', function(event){
   event.preventDefault();
   	
   	   $.ajax({
   	           url : "login.php",
   	            method: "POST",
   	             data  : $(this).serialize(),
   	             success : function(data){
   					$('#alerto').html(data);
   					setInterval(function() {
   						window.location.href="statistics.php";
   					},2000);
   	             }
   	          })
   	    
   	    

			});
	});
	</script>

</body>
</html>