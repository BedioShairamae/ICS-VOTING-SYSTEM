<?php
session_start();
 include 'include/header.php';
    include 'connection/fetch_data.php';
     include 'connection/connect.php';
?>
	<body style="background-color: rgb(228, 228, 228);">
		<div class="page-wrapper chiller-theme toggled">
 	
 	<?php include 'include/sidebar.php'?>


  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">ADD NEW VOTERS</h2>
      <?php 
        if(isset($_SESSION['action'])) {
          echo  $_SESSION['action'];
          unset($_SESSION['action']);
        }
      ?>
      <hr>
     	
       <div class="row" id="form">
           <form method="post" enctype="multipart/form-data" id="form-add" action="action.php" >
             
         
        <div class="row">
                        <div class="col-sm-5">
                           <div class="container imageconf">
                            <img id="configimage" src="https://th.bing.com/th/id/OIP.07oHujH3TSqW-GYqt_-TaQHaFj?w=219&h=180&c=7&o=5&pid=1.7" class="img-thumbnail" >
                            <br>
                            <label><input type="file" name="images[]" class="form-control" id="image" disabled></label><br>
                            <label style="cursor: pointer;" id="checkboxphoto" ><input type="checkbox" id="checkphoto" name=""> UPLOAD PHOTO</label>
                           </div> 
                           
                          

                        </div>
                        <div class="col-sm-7 ">
                           <div class="container userdetails" id="userdata">

                               <label>Enter Organization Email :
                        </label>
                        <span style="color: grey"><i class="fas fa-info-circle"></i> s*****2021@wmsu.edu.ph</span>
                        <input type="email" name="txtmail" id="em" class="form-control" autofocus="" required="" style="font-size: 13px;">
                        <span style="color: red"><h6 id="note"></h6></span>
                      <br>

                        <label>Enter Given Name :
                        </label>
                        <input type="text" name="txtname" class="form-control" required="" style="font-size: 13px;">
                      
                      <br>
                      <label>Enter Surname :
                        </label>
                        <input type="text" name="txtsurname" class="form-control" required="" style="font-size: 13px;">
                        <br>
                      <label>Enter Middle Name :
                        </label>
                        <input type="text" name="txtinit" id="txtinit" class="form-control" required="" style="font-size: 13px;">
                      
                      <br>
                      <div class="row">
                        <div class="col">
                          <label>Gender :</label><select class="form-select" name="gender" required="" style="font-size: 13px;">
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                          
                        </select>
                        
                        </div>
                        <div class="col">
                          <label>Year:</label> <select class="form-select" name="yr" required="" style="font-size: 13px;">
                          <?php 
                                $sql = " select * from year ";
                                            $result = mysqli_query($con,$sql); 
                                            $count= mysqli_num_rows($result); 
                                          
                                       
                                             while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <option value="<?php echo $row['yearid']; ?>"><?php echo $row['year']; ?></option>
                                    <?php
                                             }
                                      
                             ?>
                        </select>
                        
                        </div>

                      </div>   
                        <label>Course</label> 
                        <select style="margin-top: 10px;" class="form-select" name="txtcourse" required="">
                         <?php 
                                $sqls = " select * from course";
                                            $results = mysqli_query($con,$sqls); 
                                          
                                          
                                       
                                             while($row = mysqli_fetch_array($results)){
                                    ?>
                                    <option value="<?php echo $row['courseid']; ?>"><?php echo $row['course']; ?></option>
                                    <?php
                                             }
                                      
                             ?>
                        </select>      
                      <br>         
                       <h6 style="font-size: 14px;"><i class="fas fa-info-circle"></i>Generated password will be sent to : <strong id="email_entered"></strong> <br> </h6>
                      <br>    <hr>
                      <label style="cursor: pointer;" id="checkboxphoto" ><input type="checkbox" id="remain" name=""  disabled> REMAIN ON THIS PAGE AFTER SAVING</label>   <br><br>     
                      <a id="cancelbtn" href="voters.php" >Cancel</a>  <button  type="submit" name="btnsave" id="btnsave" >Save</button> 
      
                          
                           </div> 


                        </div>
                      </div>
  </form>  



       </div>
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
       <script src="include/js/saves.js"></script>  
     
       <script type="text/javascript">
         
          $(document).ready(function() {
          $('#em').keyup(function(){ 
            var value = $(this).val();

              $.ajax({
                   url : "validate.php",
                    method: "POST",
                     data  : {checkvalid:1,value:value},
                     success : function(data){
                      if(value == '') {
                        $('#note').html('');
                        $('#btnsave').removeAttr('disabled');
                      }else {
                             if(data == 'exist') {
                              $('#note').html('**This Email already Exist');
                               $('#btnsave').attr('disabled',true);
                            }else if(data == 'proceed') {
                              $('#note').html('');
                              $('#btnsave').removeAttr('disabled');
                            }else if(data =='notvalid') {
                              $('#note').html('**This Email is not valid');
                               $('#btnsave').attr('disabled',true);
                            }
                      }
                   
                     }
                  })
          })
         
        
        });      
            
       </script>
      
      <hr>
      <footer class="text-center">
        <div class="mb-2">
          <small>
            ©Copyrights &middot; 2021 
          </small>
        </div>
      
      </footer>
    </div>
  </main>
  <!-- page-content" -->



</div>
	

<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>