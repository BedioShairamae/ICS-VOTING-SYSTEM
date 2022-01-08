<?php 
session_start();
if(!isset($_SESSION['voter_login'])) {
  header("location:index.php");
}
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
               if($electid != $_SESSION['election_id']) {
                header("location:change_sched_detect.php");
               }

               if($checken == 'disabled') {
                header("location:unable_login.php");
               }else {
                      date_default_timezone_set('Asia/Manila');
         $dateandtime = date("Y-m-d H:i:s");


              
                 if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) { 
            
         } else if($eventstart <= $dateandtime && $eventend <= $dateandtime )  { 

             header("location:election_end.php");
         }
          
               }

                
include 'include/header.html'; 
include 'class.php';
$fetch = new Fetch_data();
?>
			<body style="background-color: rgb(217, 217, 217);">
			
				
		
<div id="mySidenav" class="sidenav">
	<?php include 'include/sidebar.php'?>
	<button onclick="window.location.href='logout.php'" class="logout"><i class="fas fa-power-off"></i> Logout</button>
</div>
            


				<div class="container" style="margin-top: 40px; cursor: default;">
				           <div class="progress">
  <div class="progress-bar bg-success" role="progressbar" style="width: 100% ; height: 10px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>                       
               <div class="card myacc">

               		<h4>My Account <span style="float: right;margin-right: 10px"><span style="margin-right: 50px;font-weight: normal;font-size: 14px;cursor: default;">Status : <span style="color: green"> ONLINE<i class="fas fa-check-circle"></i></span></span><a href="home.php" style="color: black"><i class="fas fa-times"></i></a></span></h4>
               		 <form method="post" enctype="multipart/form-data" id="form-edit" action="edit.php" >
               		 	
               		<?php
                  if(isset($_SESSION['alerto'])) {
                    echo $_SESSION['alerto'];
                    unset($_SESSION['alerto']);
                  }
                  ?>
               		<div class="card-body">
               				<div class="row">
               					<div class="col-sm-5">
               						 <div class="container imageconf">
                             <?php
                            $studid = $_SESSION['voter_login'];
                                  $sqls = " select * from student where s_id = '$studid'  ";
                                              $results = mysqli_query($con,$sqls); 
                                              $count= mysqli_num_rows($results);
                                            
                                               while($row = mysqli_fetch_array($results)){
                                                $src= 'upload/'.$row['photo'];
                                                $gender = $row['gender'];

                                                if($row['photo'] == '') {
                                                 
                                                
                                                	if($gender == 'male'){
                            						   ?>
                                                  <img src="upload/undraw_profile_pic_ic5t.png" class="img-thumbnail" style="width: 65%;height: 280px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" alt="No image Available"  >
                                                <?php
                            						                                        }else {
                            						                                              ?>
                                                  <img src="upload/undraw_female_avatar_w3jk.png" class="img-thumbnail" style="width: 65%;height: 280px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" alt="No image Available"  >
                                                <?php
                            						                                            
                            						                                         
                            						                                        }
                                                }else {
                                                  ?>
                                                  <img src="<?php echo $src ?>" class="img-thumbnail" style="width: 65%;height: 280px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" >
                                                <?php
                                                }
                                                
                                              }
                                                ?>
               						 
               						 	<br>
               						 	<label><input type="file" name="images[]" class="form-control" id="image" disabled></label><br>
               						 	<label style="cursor: pointer;" id="checkboxphoto" class="d-none"><input type="checkbox" id="checkphoto" name=""> UPDATE PHOTO</label>
               						 </div> 
               						 
               						

               					</div>
               					<div class="col-sm-7 ">
               						 <div class="container userdetails" id="userdata">
                            <?php
                            $studid = $_SESSION['voter_login'];
                                  $sql = " select * from student where s_id = '$studid'  ";
                                              $result = mysqli_query($con,$sql); 
                                              $count= mysqli_num_rows($result);
                                            
                                               while($row = mysqli_fetch_array($result)){
                                                $src= 'upload/'.$row['photo'];

                                                $fullname = $row['name'].' '.$row['middle_name'].' '.$row['surname'];
                                                $courseid = $row['course'];
                                                  $yearid = $row['year'];
                                                  $section = $row['section'];
                                        ?>
                <h4 style=""> <i style="font-style: normal; text-transform: uppercase;"><?php echo $fullname ?></i> <p>Registered-Voter</p> <br><span><?php echo $row['email'] ?>
                <br>
                  Gender : <span style="text-transform: capitalize;"><?php echo $row['gender'] ?></span> 
                 <br>
                            
                                <?php 
                              $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      echo $getcourse['course'];
                                      
                                           }
                                    

                          echo '-'; 

                          $year = " select * from year where yearid = '$yearid'  ";
                                          $resultas = mysqli_query($con,$year);
                                        
                                        
                                           while($getyear = mysqli_fetch_array($resultas)){
                                      echo $getyear['year'];
                                           }

                                            $sectionqry = " select * from section where sec_id = '$section' ";
                                          $resultsectionqry = mysqli_query($con,$sectionqry);
                                       
                                       
                                           while($getsec = mysqli_fetch_array($resultsectionqry)){
                                      echo $getsec['section'];
                                           }
                           ?>

                            <br> Password : <input type="password" id="txtpassword" name="" value="<?php echo $row['password'] ?>" style="font-size: 14px;outline: none;border:none">  <br>
                            

                           <!-- <label for="showpass" style="cursor: pointer;user-select: none;font-size: 14px;padding-left: 10px">
                        
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
                        
                       </script> -->


                              <br><br>Registered-Voter since : <?php echo date("F j,Y",strtotime ($row['date_registered'] ))?> <br>
                          </span></h4>
                          <input type="hidden" id="txtname" value="<?php echo $row['name'] ?>">
                          <input type="hidden" id="txtsurname" value="<?php echo $row['surname'] ?>">
                          <input type="hidden" id="txtmname" value="<?php echo $row['middle_name'] ?>">
                          <input type="hidden" id="txtemail" value="<?php echo $row['email'] ?>">
                          <input type="hidden" id="txtcourse" value="<?php echo $row['course'] ?>">
                           <input type="hidden" id="txtyear" value="<?php echo $row['year'] ?>">
                          <input type="hidden" id="txtgender" value="<?php echo $row['gender'] ?>">
                          <input type="hidden" id="txtpass" value="pass">
                          <input type="hidden" id ="txtsection" name="" value="<?php echo $row['section']; ?>">
                          <h6></h6>
                          <hr>
                          <button type="button" id="editmyaccount">Edit <i class="far fa-edit"></i></button>
                                        <?php
                                               }

                            ?>
               						 	
               					
               						 </div> 


               					</div>
               				</div>
               		</div> <!---->
               		 </form>	



               </div> 
             <div class="progress">
  <div class="progress-bar bg-success" role="progressbar" style="width: 100% ; height: 10px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>                       
				 </div> 
				

		 	
				 <script type="text/javascript" src="include/js/edit.js?v=1"></script>
	 		
		 	





			</body>

		<script type="text/javascript">

		
				function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}      
			      	
			</script>	
<?php include 'include/footer.html'?>
