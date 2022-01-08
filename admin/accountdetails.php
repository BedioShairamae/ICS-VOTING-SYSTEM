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

                                  if($row['photo'] == '') {
                                        if($gender == 'male'){
                                           $imagesrc = "../upload/undraw_profile_pic_ic5t.png";
                                        }else {
                                            
                                            $imagesrc = "../upload/undraw_female_avatar_w3jk.png";
                                        }

                                   
                                  }else {
                                    $imagesrc = "../upload/".$row['photo'];
                                  }
                                     
                                      
                                 }
                           


             
              ?>


             
         
        <div class="row">
                        <div class="col-sm-5">
                        <?php 
                        if($isverified == 0){ 
               ?>
            <p style="font-size: 10px;
   font-family: 'Barlow Semi Condensed', sans-serif;
   background-color: #e74a3b;
   color: white;
   font-weight: bolder;
   padding: 5px;
   width: 29%;
   letter-spacing: 1px;
   border-radius: 5px; ">Not yet Verified</p>
                          <?php
                        }else {
                          ?>
            <p style="font-size: 10px;
   font-family: 'Barlow Semi Condensed', sans-serif;
   background-color: rgb(11, 57, 11);
   color: white;
   font-weight: bolder;
   padding: 5px;
   width: 31%;
   letter-spacing: 1px;
   border-radius: 5px; ">Registered voter</p>
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
                                   
                                    echo $rowss['year'];
                                   
                                             }

                                              $sectionqry = " select * from section where sec_id = '$section' ";
                                          $resultsectionqry = mysqli_query($con,$sectionqry);
                                       
                                       
                                           while($getsec = mysqli_fetch_array($resultsectionqry)){
                                      echo $getsec['section'];
                                           }
                                      ?>
                                      <br>
                                      Gender : <span style="text-transform: uppercase;"><?php echo $gender?></span>
                                      <br><br>
                                      Date Registered :  <?php echo date("@g:ia F j,Y",strtotime ($reg)) ?>
                            </h6>
                       
                       
                          
                     
                      <br>  
                      <a  class="btn btn-primary" style="float: right;padding:8px;width: 120px; margin-top: 120px;" href="voters.php" >Back</a> 
                          
                           </div> 


                        </div>
                      </div>
 



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