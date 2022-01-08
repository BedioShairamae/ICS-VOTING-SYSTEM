<?php 
session_start();
include '../admin/connection/connect.php';
/*
$_SESSION['election_title']
$_SESSION['election_id']
$_SESSION['eventenddown']
$_SESSION['adviser_login']
$_SESSION['scopesection'] 
$_SESSION['scopecourse']
$_SESSION['changepassword'] 



*/
if(!isset($_SESSION['adviser_login'])){
	header('location:../index.php');
}
$advid = $_SESSION['adviser_login'];
			$updatestatus = " UPDATE `adviser` SET `status`=1 WHERE adv_id ='$advid'  ";
	        $result = mysqli_query($con,$updatestatus); // run query
 
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
	
<title>VS-Adviser</title>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
<body style="background-color: #d5d7e5;">
	<link rel="stylesheet" type="text/css" href="datatable/datatable.css?v=1"/>
	<script type="text/javascript" src="datatable/datatable.js"></script>
	
	<header>
		<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../include/png/icslogo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
     <span style="padding: 5px;font-family: 'Staatliches', cursive;"><?php
     $elecyear = $_SESSION['electionyear'];
      echo $_SESSION['election_title'].' '.$elecyear.'-'.date($elecyear+1) ?> </span> 
    </a>
  </div>
</nav>
	</header>


	 <div class="container mt-4 ">
	 		


	
	 	
	 	<div class="row">
	 		<div class="col-sm-3">
	 			<div class="card shadow">
	 			  
	 			  <div class="card-body">
	 			   		
	 			   		 <div id="adviser_details"></div> 
	 			   		 

	 			  </div>
	 			</div>

	 			<div class="card shadow mt-3">
	 			  
	 			  <div class="card-body">
	 			   		
	 			   	<a href="javascript:void(0)" id="logoutclick" class="btn btn-link" style="text-decoration: none;width: 100%">Logout <i class="fas fa-power-off"></i></a>	 
	 			   		 

	 			  </div>
	 			</div>
	 		</div>

	 		<div class="col-sm-9">
	 			
	 			<div class="card shadow">
	 			  
	 			  <div class="card-body">
	 			   		 <form method="post" action="advoter.php" onsubmit="return false" id="selectallsubmit">
              <input type="hidden" name="selecttrigger" id="selecttrigger" value="verify">
	 			  	 <div id="voters_details" style="overflow-x: scroll"></div> 

	 			  	</form>

	 			  </div>
	 			</div>

	 		</div>




	 	
	 	</div>







	 </div> 


	 <!-- Modal -->
	 <div class="modal fade" id="updatephoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	   <div class="modal-dialog modal-dialog-centered" role="document">
	     <div class="modal-content">
	      
	       <div class="modal-body">
	        	 <form method="post" action="action.php" enctype="multipart/form-data" id="uploadimage" onsubmit="return false">
	        	 	<input type="hidden" name="savephotoadv">
	        		
	 				<input type="file" name="image" id="fileimg" class="form-control" style="font-size: 12px;" required="">
	 				<div class="progress d-none" id="uploadprogress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 2%"  id="innerprogress"></div>
</div>

	 				 <br>

	 		 <button type="submit" class="btn btn-light" style="font-size:12px;float: right;" >Upload</button>
	 		  </form>

	        <button type="button" class="btn btn-secondary " style="font-size:12px;float: right; margin-right: 5px" data-dismiss="modal">Cancel</button>
	       </div>
	    
	     </div>
	   </div>
	 </div>
	 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	 	<script type="text/javascript">
	 		
	 		$(document).ready(function() {
	 			$('#updatephoto').on('hidden.bs.modal', function (e) {
				   $('#uploadprogress').addClass('d-none');
				    $('#innerprogress').attr('style','width:5%');

				   $('#fileimg').val('');
				})

	 			  	  $('#uploadimage').on('submit', function(event){
	 			           event.preventDefault();
	 			       
	 			             $('#uploadprogress').removeClass('d-none');
	 			            
	 			          /*  ;*/
	 			           

	 			              var formData = new FormData(this);
	 			                          
	 			                     var url = $(this).attr('action');
	 			                                  
	 			                  var xhttp = new XMLHttpRequest();
	 			                   xhttp.onreadystatechange = function() {
	 			                   if (this.readyState == 4 && this.status == 200) {
	 			                   const data = this.responseText;
	 			                             
	 			                   $('#innerprogress').attr('style','width:100%');
	 			                 	

	 			                  var in1= setInterval(function(){
	 			                  	  $('#updatephoto').modal('hide');
	 			             	     
	 			                  	 Swal.fire(
									  'Photo Uploaded!',
									  'Profile photo Changed Successfully!',
									  'success'
									)
	 			             	
	 			             	 clearInterval(in1);
	 			             },1500);
	 			                 
	 			                     var in2= setInterval(function(){
	 			                  	
	 			             	        location.reload(); 
	 			                  
	 			             	
	 			             	 clearInterval(in1);
	 			             },2500);
	 			                  
	 			                     }
	 			                  };
	 			                 xhttp.open("POST",url,true);
	 			                 xhttp.send(formData);
	 			               

	 			  });
	 			checkifnew();
	 			function checkifnew(){
	 					
	 					 var xhttp = new XMLHttpRequest();
	 					xhttp.onreadystatechange = function() {
	 					 if (this.readyState == 4 && this.status == 200) {
	 					const data = this.responseText;
	 				
	 					if(data=='new'){
	 						$('#exampleModal').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
	 					}
	 				
	 								       }
	 								    };
	 						xhttp.open("POST", "action.php",true);
	 						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 						xhttp.send("checkifnew=1");
	 								
	 				      	      	 
	 			}
	 			
	



	 		     $('#logoutclick').click(function() { 
	 		     Swal.fire({
				  title: 'Are you sure?',
				  text: "You want to leave?",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes!'
				}).then((result) => {
				  if (result.isConfirmed) {
				   window.location.href="logout.php";
				  }
				})
	 		     })
	 		});
	  

	 	      	
	 	</script>
	 	

       <div class="row" id="form">

        <?php
        if(isset($_GET['view'])) {
          $id = $_GET['id'];

          

                   $sql = " select * from student where s_id = '$id'  ";
                                $result = mysqli_query($con,$sql); 
                               
                             
                          
                                 while($row = mysqli_fetch_array($result)){
                                 	$gender= $row['gender'];
                                 	$src='../upload/';
                                  if($row['photo'] == '') {
                                     if($gender == 'male'){
												                                          $imagesrc = $src.'undraw_profile_pic_ic5t.png';
												                                        }else {
												                                            
												                                         
												                                             $imagesrc = $src.'undraw_female_avatar_w3jk.png';
												                                        }
                                  }else {
                                    $imagesrc = "../upload/".$row['photo'];
                                  }
                                     
                                      $email = $row['email'];
                                      $givenname = $row['name'];
                                      $surname = $row['surname'];
                                      $middlename = $row['middle_name'];
                                      $gender = $row['gender'];
                                      $reg = $row['date_registered'];
                                       $section = $row['section'];
                                      $isverified = $row['isverified'];
                                     
                                       $course = $row['course'];
                                       $year = $row['year'];
                                 }
                           


             
              ?>
              <script type="text/javascript">
              	$(document).ready(function() {
              			$('#viewvoter').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });    	
              	});
                
                    	
              </script>
              <div class="modal fade " id="viewvoter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 	  <div class="modal-dialog modal-lg" role="document">
	 	    <div class="modal-content">
	 	     
	 	      <div class="modal-body">
	 	        	      
        <div class="row">
                        <div class="col-sm-5">
                        <?php 
                        if($isverified == 0){ 
               ?>
        
    <span class="badge bg-danger mb-2">Not yet Verified</span>
                          <?php
                        }else {
                          ?>
           <!-- <p style="font-size: 10px;
   font-family: 'Barlow Semi Condensed', sans-serif;
   background-color: rgb(11, 57, 11);
   color: white;
   font-weight: bolder;
   padding: 5px;
   width: auto;
   letter-spacing: 1px;
   border-radius: 5px; ">Registered voter</p>-->
   <span class="badge bg-success mb-2">Registered voter</span>
                          <?php
                        }
                         ?>
                    
                           <div class="container imageconf">
                            <img id="configimage" src="<?php echo  $imagesrc?>" class="img-thumbnail" style="height: 300px;width: 250px;border:2px solid #19531e" >
                            <br>
                           
                           </div> 
                           
                          

                        </div>
                        <div class="col-sm-7 ">
                           <div class="container userdetails" id="userdata" style="padding-top: 40px;">

                            <h4 style="text-transform: uppercase;cursor: default;"><?php echo $givenname.' '.$middlename.' '.$surname?></h4> 
                            
                            <h5><?php echo $email?></h5>

                          
                            <h6 style="cursor: default;">
                              
                               <?php 
                          $sqlsi = " select * from course where courseid = '$course' ";
                                            $resultsi = mysqli_query($con,$sqlsi); 
                                          
                                          
                                       
                                             while($rows = mysqli_fetch_array($resultsi)){
                                   
                                     echo $rows['course'].'-'; 
                                    
                                             }

                                            $sqlsis = " select * from year where yearid = '$year' ";
                                            $resultsis = mysqli_query($con,$sqlsis); 
                                          
                                          
                                       
                                             while($rowss = mysqli_fetch_array($resultsis)){
                                    ?>
                                   <?php echo $rowss['year'].$section; ?>
                                    <?php
                                             }
                                      ?>
                                      <br>
                                      Gender : <span style="text-transform: uppercase;"><?php echo $gender?></span>
                                      <br><br>
                                      Date Registered :  <?php echo date("@g:ia F j,Y",strtotime ($reg)) ?>
                            </h6>
                       
                       
                          
                     
                      <br>  
                     
                          
                           </div> 


                        </div>
                      </div>
	 	      </div>
	 	      <div class="modal-footer">
	 	        <button type="button" class="btn btn-secondary" style="font-size: 12px" data-dismiss="modal" onclick="window.location.href='../adviser/'">Close</button>
	 	       
	 	      </div>
	 	    </div>
	 	  </div>
	 	</div>


             
   
 



              <?php


        }
        ?>
         

       </div>
	 	
	 	
	 	
	 	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 	  <div class="modal-dialog" role="document">
	 	    <div class="modal-content">
	 	      <form method="post" action="#">
	 	      <div class="modal-body">
	 	      	<h5>Change DEFAULT PASSWORD</h5>
	 	        	
	 	        	       
                                               
                                                        <label class="mt-3">Enter New Password</label>
                                                  <input type="password" name="txtnewss" id="passnew" class="form-control"  autofocus="" required=""> 
                                                     <div id="restrict">
                                                     
                                                    <div class="card">
                                                              <div class="container">
                                                                 <ul>
                                                                    <li id="upper">Must have Uppercase _Ex.(ABCDEFGHI)</li>  
                                                                    <li id="lower">Must have a Lowercase _Ex. (abcdefghi)</li>
                                                                    <li id="numb">Must have a Number _Ex.(123456789)</li>
                                                                    <li id="chara">Must have at Least 8 Characters _Ex.(********)</li>
                                                                 </ul>
                                                                 
                                                              </div>     
                                                        </div> 
                                                         <br>
                                                         </div> 
                                                  <label>ReEnter New Password</label>
                                                  <input type="password" name="txtreenter" id="repass" class="form-control" disabled="" required="">
                                                  <div id="pregmatch"></div> 
                                                   
                                                  
                                                        

                                                  <br> 
                                                 
                                         

                           <label>
                           	<input type="checkbox" class="clickshow" name="" id="clickshow"> Show Password
                           </label>
	 	        	 
	 	        	
	 	      </div>
	 	      <div class="modal-footer">
	 	        <button type="button" class="btn btn-secondary" style="font-size: 12px" id="skipp" data-dismiss="modal">Skip</button>
	 	        <button type="button" style="font-size: 12px" class="btn btn-primary" id="btnsavepass" name="btnsavepass" disabled="">Save changes</button>
	 	      </div>
	 	      </form> 	
	 	    </div>
	 	  </div>
	 	</div>
	
		<script type="text/javascript">
			
			$(document).ready(function() {
				//showpassword
			      	$('#clickshow').click(function() {
 			      if($(this).prop("checked") == true) {
 			        const type = $('#passnew').attr("type");

 			         
 			          if(type==="password"){
 			          	$('#passnew').attr("type","text");
 			          	$('#repass').attr("type","text");
 			          }
 			      	                     		
 			         }
 			      else if($(this).prop("checked") == false) {
 			             const types = $('#passnew').attr("type");

 			         
 			          if(types==="text"){
 			          	$('#passnew').attr("type","password");
 			          	$('#repass').attr("type","password");
 			          }                            
 			       }
 			    });




			      	$('#btnsavepass').click(function() { 
			      	var newpass =$('#passnew').val();
			      		
			      		 var xhttp = new XMLHttpRequest();
			      		xhttp.onreadystatechange = function() {
			      		 if (this.readyState == 4 && this.status == 200) {
			      		const data = this.responseText;
			      	
			      			Swal.fire(
						  'Password Changed Successfully!',
						  '',
						  'success'
						)
			      			location.reload();
			      	
			      					       }
			      					    };
			      			xhttp.open("POST", "action.php",true);
			      			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      			xhttp.send("savenewpass=1&password="+newpass);
			      					
			      	      	      	 
			      	})
			      });      
		      	
		</script>
	 
	 <script type="text/javascript">
	 	$(document).ready(function() {
	 		
 			$('#table_id1').DataTable();         

 			$('#skipp').click(function() { 
 					
 					 var xhttp = new XMLHttpRequest();
 					xhttp.onreadystatechange = function() {
 					 if (this.readyState == 4 && this.status == 200) {
 					const data = this.responseText;
 				
 						// Your condition here if data success.
 				
 								       }
 								    };
 						xhttp.open("POST", "action.php",true);
 						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 						xhttp.send("skip=1");
 								
 				      	      	 
 			})
 			 
	 		adviser_details();
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
	 		voters_details();
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


	 		  $('#passnew').keyup(function(){ 
                              var passval = $(this).val();

                              if(passval == '') {
                                    $('#numb').removeClass('d-none');
                                      $('#lower').removeClass('d-none');
                                       $('#upper').removeClass('d-none');
                                        $('#chara').removeClass('d-none');
                                         $('#restrict').removeClass('d-none');
                                         $('#repass').attr('disabled',true);
                              }else {
                                
                                   var lowerCaseLetters = /[a-z]/g;
                                   var upperCaseLetters = /[A-Z]/g;
                                    var numbers = /[0-9]/g;
                                   
                                     if(passval.match(lowerCaseLetters) && passval.match(upperCaseLetters) &&  passval.match(numbers) && passval.length >= 8 ) {
                                          $('#restrict').addClass('d-none');
                                          $('#repass').removeAttr('disabled');
                                        $('#repass').attr('required',true);
                                    }else {
                                       $('#restrict').removeClass('d-none');

                                     if(passval.match(lowerCaseLetters)) {
                                        $('#lower').addClass('d-none');
                                    }else {
                                        $('#lower').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                          if(passval.match(upperCaseLetters)) {
                                        $('#upper').addClass('d-none');
                                    }else {
                                        $('#upper').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                         if(passval.match(numbers)) {
                                        $('#numb').addClass('d-none');
                                    }else {
                                        $('#numb').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                       if(passval.length >= 8) { 
                                       $('#chara').addClass('d-none');
                                      
                                    }else {
                                         $('#chara').removeClass('d-none');
                                         $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    }

                                   

                              }
                              
                         })

	 		   $('#repass').keyup(function(){ 
                              var valuenew = $('#passnew').val();
                              var reentervalue = $(this).val();

                              if(valuenew == reentervalue) {
                                   $('#pregmatch').html('<span style="color: Green">Password Match <i class="fas fa-check-circle"></i></span>');
                                  
                                 
                                   $('#btnsavepass').removeAttr('disabled');

                              } else {
                                    $('#pregmatch').html('<span style="color: red">Password does not Match <i class="fas fa-times-circle"></i> </span>');
                                     $('#btnsavepass').attr('disabled',true);
                              }    


                         })  



	 	});
	 	      
	       	
	 </script>


</body>
</html>
