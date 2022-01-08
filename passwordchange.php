<?php 
session_start();
if(!isset($_SESSION['voter_login'])) {
  header("location:index.php");
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
  <link rel="stylesheet" type="text/css" href="include/css/login.css?v=4">
  <link rel="stylesheet" type="text/css" href="include/css/register.css?v=3">
  <link rel="stylesheet" type="text/css" href="include/css/home.css?v=13">
  <link rel="stylesheet" type="text/css" href="include/css/myaccount.css?v=1">
  <link rel="stylesheet" type="text/css" href="include/css/passwordchange.css">
 
  <script type="text/javascript" src="include/js/mains.js"></script>
<title>ICS-Voting-System</title>
</head>
			<body style="background-color: rgb(217, 217, 217);">
			
				
		
<div id="mySidenav" class="sidenav">
	<?php include 'include/sidebar.html'?>
	<button onclick="window.location.href='index.php'" class="logout"><i class="fas fa-power-off"></i> Logout</button>
</div>
            


				<div class="container" style="margin-top: 40px; cursor: default;">
				                                  
               <div class="card passdef">
                     <div class="container"> 
                              <p>  </p>
               	         <h4>Managing Password<span style="float: right;margin-right: 10px"><span style="margin-right: 50px;font-weight: normal;font-size: 14px;cursor: default;">Status : <span style="color: green"> ONLINE<i class="fas fa-check-circle"></i></span></span>
                               <?php
                                        if(isset($_GET['change_your_Default_password'])) {
                                             echo '';
                                        }else {
                                             echo ' <a href="myaccount.php" style="color: black"><i class="fas fa-times"></i></a>';
                                        }
                                        ?>

                             </span></h4>
                             <p><br>    </p>	
                              <div class="row">   
                                   <div class="col-sm-1"></div>
                                   


                                   <?php
                                        if(isset($_GET['change_your_Default_password'])) {

                                              ?>

                                             <div class="col-sm-6">
                                                  <!--Move the user location to home after saving-->
                                         <form method="post" action="newpassword.php">
                                               
                                                        <label>Enter New Password</label>
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
                                                   
                                                 <label>
                            <input type="checkbox" class="clickshow" name="" id="clickshow"> Show Password
                           </label> 
                                                        

                                                  <br> 
                                                  <button type="submit" id="btnsavepass" name="btnsavepass" class="btn btn-success" disabled=""> Save Password  </button>
                                         </form>
                                             
                                   </div>


                                             <?php

                                        }
                                        else {
                                             ?>

                                             <div class="col-sm-6">
                                         <form method="post" action="manage_password.php">
                                                  <label>Enter Current Password</label>
                                                  <input type="password" name="txtcurrent" id="txtcurrent" class="form-control"  required="" autofocus="">
                                                   <div id="notify"></div> 
                                                   
                                                       <br> 
                                                        <label>Enter New Password</label>
                                                  <input type="password" name="txtnew" id="txtnew" class="form-control" disabled=""> 
                                                     <div class="d-none" id="restrict">
                                                     
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
                                                  <input type="password" name="txtreenter" id="txtreenter" class="form-control" disabled="" >
                                                  <div id="pregmatch"></div> 
                                                   
                                                           <label>
                            <input type="checkbox" class="clickshow" name="" id="clickshows"> Show Password
                           </label> 

                                                  <br> 
                                                  <button type="submit" id="btnsavepass" name="savenewpass" class="btn btn-success" disabled=""> Save Password  </button>
                                                  <button type="button" onclick="window.location.href='myaccount.php'" class="btn btn-danger">Cancel</button>
                                         </form>
                                             
                                   </div>


                                             <?php
                                        } 

                                   ?>


                                   



                                   <div class="col-sm-5">
                                         <div class="container">
                                              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="https://th.bing.com/th/id/OIP.C0sPLvPbSnOoq4S10oosbAHaEK?w=313&h=180&c=7&o=5&pid=1.7" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://th.bing.com/th/id/OIP.liQDgBkVvAyWxgtkDpFgdwHaEK?w=313&h=180&c=7&o=5&pid=1.7" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://th.bing.com/th/id/OIP.iNaAcACReF3DjGQgQDiLcAHaD6?w=304&h=180&c=7&o=5&pid=1.7" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
                                         </div> 
                                         
                                   </div>
                               </div>
                                        <p><br>     </p>
                              </div>
               </div> 
            
				 </div> 
		  
      <script type="text/javascript">
        $(document).ready(function() {
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

             $('#clickshows').click(function() {
            if($(this).prop("checked") == true) {
              const type = $('#txtnew').attr("type");

               
                if(type==="password"){
                  $('#txtcurrent').attr("type","text");
                  $('#txtnew').attr("type","text");
                  $('#txtreenter').attr("type","text");
                }
                                      
               }
            else if($(this).prop("checked") == false) {
                   const types = $('#txtnew').attr("type");

               
                if(types==="text"){
                    $('#txtcurrent').attr("type","password");
                  $('#txtnew').attr("type","password");
                  $('#txtreenter').attr("type","password");
                }                            
             }
          });     
        });
       
              
      </script>
      
       
       <script type="text/javascript" src ="include/js/password.js"></script>
      
		 	 
			 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	 	

			</body>

<?php include 'include/footer.html'?>
