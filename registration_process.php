<?php
session_start();
include 'admin/connection/connect.php';
 include 'include/header.html'?>
			<body class="regback">
				<script type="text/javascript">
					
	
document.onkeydown = function(){
  switch (event.keyCode){
        case 116 : //F5 button
            event.returnValue = false;
            event.keyCode = 0;
            return false;
        case 82 : //R button
            if (event.ctrlKey){ 
                event.returnValue = false;
                event.keyCode = 0;
                return false;
            }
    }
}  
				      	
				</script>
				<div class="container">
				<div class="row">
					<?php
					if (isset($_POST['btnregister'])) {
													$email = $_POST['txtmail'];
						 	 						$name = $_POST['txtname'];
						 	 						$surname = $_POST['txtsurname'];
						 	 						$middlename = $_POST['txtinit'];
						 	 						$gender = $_POST['gender'];
						 	 						$year = $_POST['yr'];
						 	 						$course = $_POST['txtcourse'];
						 	 						$txtsection = $_POST['txtsection'];
						$tempid = $_SESSION['temp'];
					function createRandomPassword() { 

						    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
						    srand((double)microtime()*1000000); 
						    $i = 0; 
						    $pass = '' ; 

						    while ($i <= 7) { 
						        $num = rand() % 33; 
						        $tmp = substr($chars, $num, 1); 
						        $pass = $pass . $tmp; 
						        $i++; 
						    } 

						    return $pass; 

						} 
						$s = createRandomPassword();
						 $inserttemp = "UPDATE `temp` SET `code`='$s' WHERE tempid = '$tempid' ";
            			$tempres = mysqli_query($con,$inserttemp); 

                                
                                $gethtecode = "select * from temp where tempid = '$tempid'";
                                $getcode = mysqli_query($con,$gethtecode); 
                                while($rowcode = mysqli_fetch_array($getcode)){ 
                                        $code = $rowcode['code'];
                                }
                                    
								//SEND EMAIL HERE
                                        
                                    ?>
                                    <input type="hidden" id="code" value="<?php echo $code;?>">
                                    <input type="hidden" id="em" value="<?php echo $email?>">  
                                     <script type="text/javascript">
                              
                                           var code = $('#code').val();
                                           var email = $('#em').val();
                                    
                                          loadDoc();
                                    
                                          function loadDoc() {
                                       var xhttp = new XMLHttpRequest();
                                      xhttp.onreadystatechange = function() {
                                       if (this.readyState == 4 && this.status == 200) {
                                      const data = this.responseText;
                                       
                                        // Your condition here if data success.
                                    
                                                   }
                                                };
                                        xhttp.open("GET", "sendmail/emailsend.php?compare=1&code="+code+"&email="+email,true);
                                      
                                        xhttp.send();
                                            }
                                            
                                           
                                       
                
                                </script>
                                    
                                    <?php
                                


								//////////////////////////////////////////////////////////////////////////////
									           

					 	 							

						?>
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
								<div class="card verify" >
								  <div class="card-header">
								
								  </div>
								  <div class="card-body">
								  	 <form method="post" id="form" action="verify.php">
								  	    	                  
								  	
								  	
								    <blockquote class="blockquote mb-0">
								    	 <h4> <span id="datachanged">A verification code was sent to  </span><span style="font-weight: bolder"><?php echo $email?> ..</span><br> <span style="color: grey;font-size: 12px">Check your email for incoming message at   </span> <a style="font-size: 15px;text-decoration: none" href="https://gmail.com/" target="_blank">gmail.com</a></h4>
								   
								    	 <!--alerts-->
								    	 <!-- -->
								    	 <!---->
								    	  <div class="" style="color:red;font-size: 18px;" id="data"></div> 
								    	  
								    
								      		<input type="hidden" name="txtmail" value="<?php echo $email; ?>">
								      		<input type="hidden" name="txtname" value="<?php echo $name; ?>">
								      		<input type="hidden" name="txtsurname" value="<?php echo $surname; ?>">
								      		<input type="hidden" name="txtinit" value="<?php echo $middlename; ?>">
								      		<input type="hidden" name="gender" value="<?php echo $gender; ?>">
								      		<input type="hidden" name="yr" value="<?php echo $year; ?>">
								      		<input type="hidden" name="txtcourse" value="<?php echo $course; ?>">
								      	 	<input type="hidden" name="txtsection" value="<?php echo $txtsection ?>">

								         	<input type="text" name="txtcode" class="form-control" id="vericode">	
								         	<span style="color: grey;font-size: 12px">verification code sensitive, make sure to enter it correctly.</span>
								         	<input type="hidden" id="email" value=<?php echo $email?>>
								         	<br>

								         	<button class="form-control btn btn-success" type="submit" style="height: 40px;" id="verifyclick">Verify</button>  
								         	
								     <p><br></p>
								      <footer class="blockquote-footer" style="font-size: 12px;">Didnt received a code? <cite title="Source Title">Kindly check your Email.</cite></footer>
								    </blockquote>
								     </form>
								  </div>
								</div>
								
								
							</div>
							<div class="col-sm-4"></div>
						 
						 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
						 
						 <script>
						 	  $(document).ready(function() {
						 	$('#form').on('submit', function(event){
						 	   event.preventDefault();
						 	   			 $.ajax({
						 	           url : "verify.php",
						 	            method: "POST",
						 	             data  : $(this).serialize(),
						 	             success : function(data){
						 					$('#data').html(data);

						 					
						 	             }
						 	          })
						 	   });
						 	  

						 	 $('#resend').click(function() {
						 	
						 	   $.ajax({
						 	           url : "verify.php",
						 	            method: "POST",
						 	             data  : {resend:1},
						 	             success : function(data){
						 					$('#datachanged').html('Verification code Resent Successfully to  ');
						 					$('#resend').addClass('d-none');
						 	             }
						 	          })
						 	    })
						 	});      
						 	    
						 </script>
						<?php	 						

					}
					?>	


				</div>
				</div>

</body>
<?php include 'include/footer.html'?>
