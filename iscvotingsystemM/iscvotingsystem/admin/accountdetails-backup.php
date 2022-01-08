<?php 
session_start();
include 'include/header.php'?>
	<body style="background-color: rgb(228, 228, 228);">
		<div class="page-wrapper chiller-theme toggled">
 	
 	<?php include 'include/sidebar.php'?>
  <?php include 'accountmodal.php'?>


  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">VOTER DETAILS</h2>
      <hr>
     	
       <div class="row" id="form">

        <?php
        if(isset($_GET['view'])) {
          $id = $_GET['id'];

          include 'connection/connect.php';

                   $sql = " select * from student where s_id = '$id'  ";
                                $result = mysqli_query($con,$sql); 
                               
                             
                          
                                 while($row = mysqli_fetch_array($result)){
                                  if($row['photo'] == '') {
                                    $imagesrc = "../upload/noimage.jfif";
                                  }else {
                                    $imagesrc = "../upload/".$row['photo'];
                                  }
                                     
                                      $email = $row['email'];
                                      $givenname = $row['name'];
                                      $surname = $row['surname'];
                                      $middlename = $row['middle_name'];
                                      $gender = $row['gender'];
                                      
                                      
                                     
                                       $course = $row['course'];
                                       $year = $row['year'];
                                 }
                           


             
              ?>


                  <form method="post" enctype="multipart/form-data" id="form-edit" action="action.php" >
             
         
        <div class="row">
                        <div class="col-sm-5">
                           <div class="container imageconf">
                            <img id="configimage" src="<?php echo  $imagesrc?>" class="img-thumbnail" >
                            <br>
                            <label><input type="file" name="images[]" class="form-control" id="images" disabled></label><br>
                            <label style="cursor: pointer;" id="checkboxphoto" ><input type="checkbox" id="updatephoto" name=""> UPDATE PHOTO</label>
                           </div> 
                           
                          

                        </div>
                        <div class="col-sm-7 ">
                           <div class="container userdetails" id="userdata">

                               <label>Enter Organization Email :
                        </label>
                        <span style="color: grey"><i class="fas fa-info-circle"></i> s*****2021@wmsu.edu.ph</span>
                        <input type="email" name="txtmail" class="form-control"  id="em" value="<?php echo $email?>" required="" style="font-size: 13px;">
                        <span style="color: red"><h6 id="note"></h6></span>
                      <br>

                        <label>Enter Given Name :
                        </label>
                        <input type="text" name="txtname" class="form-control" value="<?php echo $givenname?>" required="" style="font-size: 13px;">
                      
                      <br>
                      <label>Enter Surname :
                        </label>
                        <input type="text" name="txtsurname" class="form-control" value="<?php echo $surname?>" required="" style="font-size: 13px;">
                        <br>
                      <label>Enter Middle Name :
                        </label>
                        <input type="text" name="txtinit" id="txtinit" class="form-control" value="<?php echo $middlename?>" required="" style="font-size: 13px;">
                      
                      <br>
                      <div class="row">
                        <div class="col">
                          <label>Gender :</label><select class="form-select" name="gender" required="" style="font-size: 13px;">
                            <option value="<?php echo $gender?>"><?php echo $gender?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          
                        </select>
                        
                        </div>
                        <div class="col">
                          <label>Year:</label> <select class="form-select" name="yr" required="" style="font-size: 13px;">
                           
                          <?php 
                           $sqlsis = " select * from year where yearid = '$year' ";
                                            $resultsis = mysqli_query($con,$sqlsis); 
                                          
                                          
                                       
                                             while($rowss = mysqli_fetch_array($resultsis)){
                                    ?>
                                    <option value="<?php echo $rowss['yearid']; ?>"><?php echo $rowss['year']; ?></option>
                                    <?php
                                             }
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
                          $sqlsi = " select * from course where courseid = '$course' ";
                                            $resultsi = mysqli_query($con,$sqlsi); 
                                          
                                          
                                       
                                             while($rows = mysqli_fetch_array($resultsi)){
                                    ?>
                                    <option value="<?php echo $rows['courseid']; ?>"><?php echo $rows['course']; ?></option>
                                    <?php
                                             }


                                $sqls = " select * from course ";
                                            $results = mysqli_query($con,$sqls); 
                                          
                                          
                                       
                                             while($row = mysqli_fetch_array($results)){
                                    ?>
                                    <option value="<?php echo $row['courseid']; ?>"><?php echo $row['course']; ?></option>
                                    <?php
                                             }
                                      
                             ?>
                        </select>      
                      <br>         
                      <input type="hidden" name="svsid" value=<?php echo $id?>>
                      <br>  
                      <a id="cancelbtn" href="voters.php" >Cancel</a>  <button type="submit" id="btnsave" name="btnedit">Update</button> 
      
                          
                           </div> 


                        </div>
                      </div>
  </form>  



              <?php


        }
        ?>
         

       </div>
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
          
             $(document).ready(function() {
                   $('#updatephoto').click(function() {
                        if($(this).prop("checked") == true) {
                                    $('#images').removeAttr('disabled');
                              $('#images').attr('required' , true);
                               
                                $('#form-edit').attr('action','actionwphoto.php');                        
                           }
                        else if($(this).prop("checked") == false) {
                                $('#images').attr('disabled' , true);
                             $('#images').removeAttr('required');
                              $('#form-edit').attr('action','action.php');                            
                         }
                      });

                   $('#em').keyup(function(){ 
            var value = $(this).val();

              $.ajax({
                   url : "validate.php",
                    method: "POST",
                     data  : {checkedit:1,value:value},
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
                 const inpfile = document.getElementById("images"); 
                            const regform=document.getElementById ("form"); 
                            const previewimage=regform.querySelector("#configimage"); 
        
                             inpfile.addEventListener("change",function () {
                                const file = this.files[0];
        
                                if(file) {
                                    const reader = new FileReader();
                                    
                                    
                                    reader.addEventListener("load",function() {
                                        previewimage.setAttribute("src",this.result);
                                       
                                    });
                                    reader.readAsDataURL(file);
                                }
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