<?php 
session_start();
if(isset($_SESSION['voter_login'])) {

	if(!isset($_SESSION['otpgood'])){
		header("location:logout.php");
	}else {
		header("location:home.php");
	}
	
}
include 'admin/connection/connect.php';
	$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                 							
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];	
              	$etitle = $active['title'];
               $eventstart = $active['eventstart'];
               $eyear = $active['year'];
               $eventend = $active['eventend'];		
               $_SESSION['election_id'] = $electid;		
               $_SESSION['election_title']	= $etitle;								
         }

     function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


date_default_timezone_set('Asia/Manila');
$datenows = date('Y-m-d H:i:s');
$ipreal = getUserIpAddr();

  $check = "select * from temp where ipaddress = '$ipreal' ";
        $resultcheck = mysqli_query($con,$check); // run query
                $countiptemp= mysqli_num_rows($resultcheck);
             if($countiptemp >= 1)  {
                 while($gettemp = mysqli_fetch_array($resultcheck)){
                    $tempid = $gettemp['tempid'];
                    $_SESSION['temp'] = $tempid;
                 }
             } else {
            $inserttemp = "INSERT INTO `temp`(`ipaddress`, `date-visited`) VALUES ('$ipreal','$datenows')";
            $tempres = mysqli_query($con,$inserttemp); 
			$get_id =  mysqli_insert_id($con);	
			$_SESSION['temp'] = $get_id;
             }


		
include 'include/header.html';
include 'class.php';
$fetch = new Fetch_data();

$fetch -> checkstatus();
?>
			<body class="back" >
				<script type="text/javascript">
					
					    
				      	
				</script>
				<div class="container">
				<div class="row">
						<div class="col-sm-5 col-lg-5 col-md-5">
							 <div class="loginform">
							 
								 <form method="post" id="submitform">
								 		 <div class="img-logo">
								 		 	<img src="include/png/icslogo.png">
								 		 </div>
								 		  <div class="logintitle">
								 		  	<h4>ISC VOTING SYSTEM</h4>
								 		  	<span id="eltitle" style="font-size: 25px">
								 		  		<?php 
									    	 	echo $etitle;
									    	 	 ?>
								 		  	</span>
								 		  	<span style="font-size: 20px;">
								 		  		<?php 
								 		  		echo '  '.$eyear.' - '.date($eyear+1);
								 		  		 ?>
								 		  	</span>
								 		  </div> 
								 		  <!--Errors Here-->
								 		  <!-- <div class="container">
								 		   
								 		    <div class="alert alert-danger" role="alert">
											 <h6><strong>Wrong Username or Password .</strong></h6>
											</div>

											</div> -->
											<!---->
											 <div id="notify"></div> 
											 
								 		<?php
								 		if(isset($_GET['Registered_successfully'])) {
								 			$email = $_GET['email'];
								 			?>
									<div class="container">
								 		   
								 		    <div class="alert alert-success" role="alert">
											 <h6><strong>We have successfully Emailed your Generated Password kindly check your email.. </strong></h6>
											</div>

											</div> 
											
											 <div class="inputs"> 
								 	 	<label>EMAIL</label>
								    	<input type="email" name="txtemail" id="emaill" class="inp" value="<?php echo $email?>" required><br>
								    	</div>
								 			<?php
								 		}else {



								 			?>
									 <div class="inputs"> 
								 	 	<label>EMAIL</label>
								    	<input type="email" name="txtemail" id="emaill" class="inp" autofocus="" required=""><br>
								    	</div>
								 			<?php


								 		}
								 		?> 
								 	
								    	 <div class="inputs">
								    	 	<label>PASSWORD</label>
								    	<input type="password" name="txtpass" class="inp" id="txtpassword" required=""><br>


								    	</div>
								    	
								    	 	<label for="showpass" style="cursor: pointer;user-select: none;font-size: 14px;padding-left: 10px">
								    	 	
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
								    	 


								    	 	<div class="container">
								    		<a href="register.php" class="register">Register</a>
								    		</div> 

								    	 <div class="loginbtn container">
								    	 
								    	<input type="submit" value="LOGIN" name="btnlogin" class="btn btn-success "> 


								    	</div> 
								    	<!-- <div class="container loginbtns">
								    	 	<button type="button"  class="btn btn-danger google"><i class="fa fa-google"></i> Login Via Google</button>	        
								    	

								    	 </div> -->
								    	  <br>
								    	   <div class="container">
								    	   	<h6 class="allrights">All rights reserved &middot; 2021</h6>  
								    	   </div> 
								    	   
								    		  
								 </form>
								</div>
						</div>
						<div class="col-sm-7">
						    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
						    <p></p>
						    	 <h2 style="text-align:center;margin-top:50px;font-family: 'Kaushan Script', cursive;">Vote Wisely! Your vote matters!</h2>

						    	 <p></p>
						 <img src=" undraw_voting_nvu7.png" class="img-fluid px-3 px-sm-8 mt-2 mb-8" style="width: 100%;">
					
						</div>
						


				</div>
				</div>
				<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
				
				
<script type="text/javascript">
	
	$(document).ready(function() {
	       $('#submitform').on('submit', function(event){
	            event.preventDefault();
	            			 $.ajax({
	         	                 url : "login.php",
	         	                  method: "POST",
	         	                   data  : $(this).serialize(),
	         	                   success : function(data){
	         	                  
	         	                   		$('#notify').html(data);
	      
	         	                  
	         	                   }
	         	                })
	            });  


					
				
	          
	      });      
      	
</script>
</body>
<?php include 'include/footer.html'?>
