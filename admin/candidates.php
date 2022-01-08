<?php 
session_start();
if(!isset($_SESSION['admin_id_token'])) {
  header("location:index.php");
}
include 'include/header.php';
include 'connection/fetch_data.php';
 $fetch = new Fetch_data();

?>
	<body style="background-color: rgb(228, 228, 228);">
		<div class="page-wrapper chiller-theme toggled">
 	
 	<?php include 'include/sidebar.php'?>
<?php include 'accountmodal.php'?>

  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">CANDIDATES</h2>
     
     	
       <div class="row">
         <style type="text/css">
        .pf {
          position: fixed;
          z-index: 1;
          right: 10px;
          width: 200px;
        }
      </style>
           <div class="pf mt-4" id="timee">
 
  <div class="position-absolute bottom-0 end-0">
    <div class="alert alert-dark" role="alert">
   <span style="font-weight: bolder;font-size: 16px"> <div class="clock"  ><div class="displayoutside"></div></div> </span> 
       <span style=""><?php echo  date('F j,  Y ',strtotime(date('Y-m-d H:i:s'))); ?></span>

</div>
  </div>
</div>
       
     
 
        <script>
      setInterval(function(){
        const clock = document.querySelector(".displayoutside");
        let time = new Date();
        let sec = time.getSeconds();
        let min = time.getMinutes();
        let hr = time.getHours();
        let day = 'AM';
        if(hr > 12){
          day = 'PM';
          hr = hr - 12;
        }
        if(hr == 0){
          hr = 12;
        }
        if(sec < 10){
          sec = '0' + sec;
        }
        if(min < 10){
          min = '0' + min;
        }
        if(hr < 10){
          hr = '0' + hr;
        }
        clock.textContent = hr + ':' + min + ':' + sec + " " + day;
      });
    </script>
       
         <div class="card" style=" box-shadow:  0 1rem 4rem 0 #00000040;">
          
             <p></p>

             <!--The Candidates-->
             <div class="row">
                 <div class="card">
              <div class="card-header">
              <h5 id="hiddd">Manage Candidates</h5>
              </div>
              <div class="card-body">
                <h6 class="hiddd">Add Candidates For : </h6>
                  <div  class="candidates_add hiddd">
               <div class="btn-group" role="group" aria-label="Basic outlined example">
  
 
     
  

                     
                       
                  
                   <?php
                   include 'connection/connect.php';
                   $electionid = $_SESSION['electsched'];
                $sql = " select * from position where election_id='$electionid' order by `pos_id` asc ";
                            $result = mysqli_query($con,$sql); 
                            $count= mysqli_num_rows($result); 
                          
                          if($count >= 1){
                             while($row = mysqli_fetch_array($result)){
                        ?>
             
            <a type="button" class="btn btn-outline-primary" style="font-size: 13px"  onclick="window.location.href='select_candidates.php?sortby=<?php echo $row['pos_name']; ?>&id=<?php echo $row['pos_id']?>'">
              <?php echo $row['pos_name']; ?> <i class="fas fa-user-plus"></i>
            </a>


                        
                        <?php
                             }
                           }else {
                            ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                          <script type="text/javascript">
                            
                            Swal.fire(
                'No position was set.',
                'Please set one to add candidate!',
                'error'
              ).then((result) => {
                  if (result.isConfirmed) {
                   window.location.href="position.php";
                  }
                })      
                                  
                          </script> 
                            <?php
                           }

                   ?>
                 </div>
                 </div>
                 <hr>
                  <?php
          if(isset($_SESSION['action'])) {
            echo  $_SESSION['action'];
            unset($_SESSION['action']);
          }

          ?>

                 <ul class="nav nav-tabs" >
  <li class="nav-item">
    <a class="nav-link active" href="candidates.php">All Candidates</a>
  </li>

   <li class="nav-item">
    <a class="nav-link active" href="candidates.php?Partylist">Partylist</a>
  </li>
 
 <!--Method-->

 
     <?php
      $fetch -> candidate_link();
    ?>
  
  
  
  <!---->

</ul>
<?php 
  if(isset($_GET['Partylist'])){ 
    include 'partylist.php';

    ?>

    <script type="text/javascript">
      
      $(document).ready(function() {
              $('.hiddd').hide();
              $('#hiddd').text('Sort By Partylist');
            });      
            
    </script>
    <?php
  }else {
    ?>
    <table class="table table-hover">
  <thead>
    <tr>
       <th scope="col">Position</th>
      <th scope="col">Student-ID</th>
      <th scope="col">Whole Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Course & Year</th>
      <th scope="col">Advocacy</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
     if(isset($_GET['sortby'])) {
        $sort = $_GET['sortby'];
        $posid = $_GET['id'];
        $elecid = $_SESSION['electsched'];
                  $sql = " select * from candidate where pos_id = '$posid' and election_id = '$elecid'  ";
                              $result = mysqli_query($con,$sql); 
                              $count= mysqli_num_rows($result); 
                            
                       if($count >=1 ) {
                               while($row = mysqli_fetch_array($result)){
                                $cid =  $row['cid'];
                                $sud = $row['sv_id'];
                                $partyid = $row['partylist'];
                                      ?>
                        <tr>
                       <th scope="row"><span style="color: green">
                         <?php
                                    $sqlpos = " select * from position where pos_id= '$posid' and election_id = '$elecid'  ";
                                                $resultpos = mysqli_query($con,$sqlpos); 
                                              
                                                 while($pos = mysqli_fetch_array($resultpos)){
                                    echo $pos['pos_name'];
                                                 }
                                          
                         ?>
                       </span></th>

                       <?php
                           $sqlstud = " select * from student where s_id= '$sud' and election_id = '$elecid'  ";
                                                $resultstud = mysqli_query($con,$sqlstud); 
                                              
                                                 while($stud = mysqli_fetch_array($resultstud)){
                                                  $wholename = $stud['surname'].' '.$stud['name'].' '.$stud['middle_name'];
                                                  $courseid = $stud['course'];
                                                    $yearid = $stud['year'];
                                                    $section = $stud['section'];
                                                ?>
                                                <th scope="row"><?php echo $stud['sv_id']; ?></th>
                                          <td><?php echo $wholename ?></td>
                                          <td><?php echo $stud['gender']; ?></td>
                                            <td><?php 
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
                           


                           ?></td>
                                          <td><button class="det" data-cid="<?php echo $cid ?>" data-name="<?php echo $stud['name'] ?>"  data-toggle="modal" data-target="#viewcandidate">Details <i class="fas fa-info-circle"></i></button></td>
                                                <?php
                                                 }



                  $elecid =$_SESSION['electsched'];
                 
                         
                                    $sqlpt = " SELECT * FROM `partylist` WHERE election_id = '$elecid' and party_id = '$partyid'  ";
                                                $resultpt = mysqli_query($con,$sqlpt); // run query
                                              
                                            
                                           
                                               
                                                 while($rows = mysqli_fetch_array($resultpt)){
                                             $pt = $rows['partylist'];
                                          }

                   

                       ?>
                        
                      <td>
                         <div class="btn-group" role="group" aria-label="Basic example">
                       <button  class="btn btn-warning btneditcan" data-cid="<?php echo $row['cid']; ?>" data-currentpt="<?php echo $pt ?>" data-curptid="<?php echo $partyid ?>" data-svid= "<?php echo $row['sv_id'] ?>" data-toggle="modal" data-target="#editcandidate" style="font-size: 10px;"><i style="font-size: 15px;" class="fas fa-pen"></i></button> <button class="btn btn-danger btndel" data-pid="<?php echo $row['cid']; ?>" style="font-size: 10px;"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
                     </div>
                      </td>
                    </tr>

                        <?php
                               }
                             }else {
                              ?>
                                <tr >
                                  <td colspan="7" style="text-align: center;font-weight: bolder;">No <span style="color: red"><?php echo $sort?></span> Candidates Added Yet</td>
                                </tr>
                              <?php
                             }
                        
       
      

      }



      else {
        $elecid = $_SESSION['electsched'];
         
                  $sql = " select * from candidate where election_id= '$elecid' ";
                              $result = mysqli_query($con,$sql); 
                              $count= mysqli_num_rows($result); 
                            
                        if($count >= 1) {
                               while($row = mysqli_fetch_array($result)){
                                $cid =  $row['cid'];
                                $sud = $row['sv_id'];
                                $posid = $row['pos_id'];
                                $partyid = $row['partylist'];
                                      ?>
                        <tr>
                       <th scope="row"><span style="color: green">
                         <?php
                                    $sqlpos = " select * from position where pos_id= '$posid' and election_id= '$elecid'  ";
                                                $resultpos = mysqli_query($con,$sqlpos); 
                                              
                                                 while($pos = mysqli_fetch_array($resultpos)){
                                    echo $pos['pos_name'];
                                                 }
                                          
                         ?>
                       </span></th>

                       <?php
                           $sqlstud = " select * from student where s_id= '$sud' and election_id= '$elecid' ";
                                                $resultstud = mysqli_query($con,$sqlstud); 
                                              
                                                 while($stud = mysqli_fetch_array($resultstud)){
                                                  $wholename = $stud['surname'].' '.$stud['name'].' '.$stud['middle_name'];
                                                  $courseid = $stud['course'];
                                                 $yearid = $stud['year'];
                                                 $section = $stud['section'];
                                                ?>
                                                <th scope="row"><?php echo $stud['sv_id']; ?></th>
                                          <td><?php echo $wholename ?></td>
                                          <td><?php echo $stud['gender']; ?></td>
                                            <td><?php 
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

                           ?></td>
                                          <td><button class="det" data-cid="<?php echo $cid ?>" data-name="<?php echo $stud['name'] ?>"  data-toggle="modal" data-target="#viewcandidate">Details <i class="fas fa-info-circle"></i></button></td>
                                                <?php
                                                 }

                                                    $elecid =$_SESSION['electsched'];
                 
                         
                                    $sqlpt = " SELECT * FROM `partylist` WHERE  party_id = '$partyid' and election_id = '$elecid' or election_id = '0'  ";
                                                $resultpt = mysqli_query($con,$sqlpt); // run query
                                              
                                            
                                           
                                               
                                                 while($rows = mysqli_fetch_array($resultpt)){
                                             $pt = $rows['partylist'];
                                            
                                          }
                       ?>
                      
                      <td>
                         <div class="btn-group" role="group" aria-label="Basic example">
                       <button  class="btn btn-warning btneditcan" data-cid="<?php echo $row['cid']; ?>" data-currentpt="<?php echo $pt ?>" data-svid= "<?php echo $row['sv_id'] ?>" data-curptid="<?php echo $partyid ?>"  data-toggle="modal" data-target="#editcandidate" style="font-size: 10px;"><i style="font-size: 15px;" class="fas fa-pen"></i></button> <button class="btn btn-danger btndel" data-pid="<?php echo $row['cid']; ?>" style="font-size: 10px;"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
                     </div>
                      </td>
                    </tr>

                        <?php
                               }
                             }else {
                              ?>
                                <tr >
                                  <td colspan="7" style="text-align: center;font-weight: bolder;">No <span style="color:red">Candidates</span> Added Yet</td>
                                </tr>
                              <?php
                             }
                        
       
      }
    ?>
    
   

  
  </tbody>
</table>



    <?php
  }

 ?>







              </div>
            </div>

             </div>
             <!---->
           
            <p></p>

          
           


         </div>



       </div>

     


     
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

<?php include 'include/modal/candidates_modal.php'?>
	

<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>