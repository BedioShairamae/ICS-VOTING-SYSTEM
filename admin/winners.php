<?php 
session_start();
if(!isset($_SESSION['admin_id_token'])) {
  header("location:index.php");
}
include 'include/header.php';
include 'connection/fetch_data.php';
include 'connection/connect.php';
$fetch = new Fetch_data();

?>
  <body style="background-color: rgb(228, 228, 228);">
    <div class="page-wrapper chiller-theme toggled">
  
  <?php include 'include/sidebar.php'?>
  <?php include 'accountmodal.php'?>


  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">RESULTS</h2>
      <hr>

      
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
          <button class="btn btn-primary" style="font-size: 12px;width: 140px" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   Show All Candidates
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body mb-4">
         <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#" style="color: green">All Candidates</a>
  </li>

  <li class="nav-item">
    <a class="nav-link  btn btn-light text-primary" href="print_candidates.php" style="color: green">Print <i class="fas fa-print"></i></a>
  </li>
 
 <!--Method-->

 
    
  
  
  <!---->

</ul>


<table class="table table-hover table-borderless ">
  <thead>
    <tr>
       <th scope="col">Position</th>
      <th scope="col">Student-ID</th>
      <th scope="col">Whole Name</th>
     
      <th scope="col">Course & Year</th>
     
     
    </tr>
  </thead>
  <tbody>
    <?php
   
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
                       <th scope="row"><span style="">
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
                                        
                                                <?php
                                                 }

                                                    $elecid =$_SESSION['electsched'];
                 
                         
                                    $sqlpt = " SELECT * FROM `partylist` WHERE election_id = '$elecid' and party_id = '$partyid'  ";
                                                $resultpt = mysqli_query($con,$sqlpt); // run query
                                              
                                            
                                           
                                               
                                                 while($rows = mysqli_fetch_array($resultpt)){
                                             $pt = $rows['partylist'];
                                          }
                       ?>
                   
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
                        
       
      
    ?>
    
   

  
  </tbody>
</table>

  </div>
</div>




               


        <?php 
         $electid = $_SESSION['electsched'];

          $selectactive = " select * from election_sched where status = 'active'  ";
                  $resultselect = mysqli_query($con,$selectactive); 
                                        
                   while($active = mysqli_fetch_array($resultselect)){
                         $electid = $active['election_id'];
                         $checken = $active['voterlogin'];
                          $eventstart = $active['eventstart'];
                    $eventend = $active['eventend'];  
                    $elecyear = $active['year'];
                    $elecsem = $active['semester'];
                    $titleelect = $active['title'];
                    $resultpublic = $active['result'];

                    $_SESSION['printname'] = $titleelect;


                      if ($elecsem == '1'){
                        $sem =  $elecsem.'st'; 
                      }else if ($elecsem == '2'){
                        $sem = $elecsem.'nd'; 
                      }
                    $_SESSION['sem&year'] = $sem.' Semester Year '.$elecyear;
                         }

                         ?>

                  <div class="form-check form-switch mb-3">
                    
                   
                    <?php 
                    if($resultpublic == 0){
                      ?>
                       <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                      <?php
                    }else {
                       ?>
                       <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                      <?php
                       }
                     ?>
                   
                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: uppercase;">Publicize Result <i class="fas fa-poll-h"></i></label>
                     <button class="btn btn-light ml-5" id="printres" style="font-size: 12px;width: auto; float: right;">Print <i class="fas fa-print"></i></button>
                  </div>
                    <?php 
                    date_default_timezone_set('Asia/Manila');

                    $datenow = date('Y-m-d H:i:s');
                    if($eventstart >= $datenow){
                       ?>
                          <h2>Leading Candidate Statistics of <?php echo $titleelect ?></h2>
                          <?php
                    }else
                     if ($eventend == '0000-00-00 00:00:00' ||  $eventend == NULL) {
                        ?>
                        <h2 class="text-gray-800"><?php echo $titleelect ?> Not yet set.</h2>
                        <script type="text/javascript">
                          $('#flexSwitchCheckDefault').attr('disabled',true);
                                
                                
                        </script>
                        <?php
                     }
                    else if($datenow < $eventend) {
                        ?>
                          <h2>Leading Candidate Statistics of <?php echo $titleelect ?></h2>
                          <?php
                     }else if ($datenow > $eventend){
                          ?>
                          <h2><?php echo $titleelect ?> RESULTS</h2>
                          <?php
                     }


                    ?>
                           <ul class="nav nav-tabs">
                       <li class="nav-item">
                <a class="nav-link active" href="winners.php">Winners</a>
              </li>
                      <?php 
                      $fetch ->candidate_linkres();
                       ?>
             
            
                     </ul>
                     <div class="card mb-4">
                       <div class="card-body" id="electionresult">

                    <table class="table  table-hover table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Candidate Photo</th>
                      <th scope="col">Position</th>
                      <th scope="col">Name</th>
                      <th scope="col">Course,Year and Section</th>
                      <th scope="col">Partylist</th>
                      <th scope="col">Votes Received</th>
                    </tr>
                  </thead>
                  <tbody>

                   
<!-------------------------------------------------------------------->

                     <?php 
                       if(isset($_GET['sortby'])) {
                  $sort = $_GET['sortby'];
                  $posids = $_GET['id'];
                  $elecid = $_SESSION['electsched'];
                  $getname = " select * from position where pos_id ='$posids' and election_id ='$electid'  ";
                                 $resultgetname = mysqli_query($con,$getname); 
                                  $counter= mysqli_num_rows($resultgetname); 
                                  if($counter >= 1) {



                                   while($name = mysqli_fetch_array($resultgetname)){
                                                  
                                    $posname = $name['pos_name'];
                                    $nowinn = $name['pos_noofwinner'];
                                    $countofvote = $name['maxvote'];
                                    $posid = $name['pos_id'];
                                    $ppp= true;

                                     $selectwin = "select * from candidate where  pos_id = '$posid'  order by votes desc limit $nowinn ";
                                             $resultwin = mysqli_query($con,$selectwin); 
                                             $counterwin= mysqli_num_rows($resultwin);  
                                             if($counterwin >=1 ) {
                                              while($winner = mysqli_fetch_array($resultwin)){ 
                                                $winvotes= $winner['votes'];
                                                $votes =  $winner['votes'];
                                          $s_id = $winner['sv_id'];
                                                $posid = $winner['pos_id'];
                                                $advocacy = $winner['advocacy'];
                                                $voters = $winner['voters'];
                                                $cid = $winner['cid'];
                                                $partylist = $winner['partylist'];

                                                 $getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
                                     $resultgetstud = mysqli_query($con,$getstud); 
                                                       
                                       while($uname = mysqli_fetch_array($resultgetstud)){
                                                            $src = "../upload/";
                                                            $photo = $uname['photo'];
                                                          
                                                            if($photo == ''){
                                                                  $imgsrc = $src.'undraw_profile_pic_ic5t.png';
                                                            }else {
                                                                $imgsrc = $src.$uname['photo'];
                                                            }
                                                            $fullname = $uname['surname'].' '.$uname['name'];
                                                            $courseid = $uname['course'];
                                                  $yearid = $uname['year'];

                                                    
                                                    }
                                                       if ($votes == 0) { 



                                                      }else {

                                                        ?>

                                                <tr>
                                                    <td class="">
                                                      <img src="<?php echo $imgsrc ?>" style="width: 80px;height: 80px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" class="">
                                                      
                                                    </td>
                                                    <td>
                                                      <?php echo $posname ?>
                                                    </td>
                                                    <td>
                                                      <?php echo $fullname ?>
                                                    </td>
                                                    <td>
                                                      <?php 
                                                        $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      echo $getcourse['course'].'-';
                                      
                                           }

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
                                                    </td>

                                                    <td>
                                                        <?php 

                             $prtylist = " select * from `partylist` where party_id = '$partylist' ";
                                          $resultprtylist = mysqli_query($con,$prtylist);
                                       
                                       
                                           while($getpt = mysqli_fetch_array($resultprtylist)){
                                      echo $getpt['partylist'];
                                           }

                            ?>

                                                    </td>

                                                    <td>
                                                      <?php 
                                                      echo $votes
                                                       ?>
                                                    </td>
                                                   

                                                </tr>
                                                <?php

                                                      }


                                              }

                                            }
                                  }



                                }
                   

                }else {

                  $getname = " select * from position where pos_id  IN (SELECT pos_id FROM candidate) and election_id ='$electid'  ";
                                 $resultgetname = mysqli_query($con,$getname); 
                                  $counter= mysqli_num_rows($resultgetname); 
                                  if($counter >= 1) {



                                   while($name = mysqli_fetch_array($resultgetname)){
                                                  
                                    $posname = $name['pos_name'];
                                    $nowinn = $name['pos_noofwinner'];
                                    $countofvote = $name['maxvote'];
                                    $posid = $name['pos_id'];
                                    $ppp= true;

                                     $selectwin = "select * from candidate where  pos_id = '$posid'  order by votes desc limit $nowinn ";
                                             $resultwin = mysqli_query($con,$selectwin); 
                                             $counterwin= mysqli_num_rows($resultwin);  
                                             if($counterwin >=1 ) {
                                              while($winner = mysqli_fetch_array($resultwin)){ 
                                                $winvotes= $winner['votes'];
                                                $votes =  $winner['votes'];
                                          $s_id = $winner['sv_id'];
                                                $posid = $winner['pos_id'];
                                                $advocacy = $winner['advocacy'];
                                                $voters = $winner['voters'];
                                                $cid = $winner['cid'];
                                                $partylist = $winner['partylist'];

                                                 $getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
                                     $resultgetstud = mysqli_query($con,$getstud); 
                                                       
                                       while($uname = mysqli_fetch_array($resultgetstud)){
                                                            $src = "../upload/";
                                                            $photo = $uname['photo'];
                                                            $gender = $uname['gender'];
                                                          
                                                            if($photo == ''){

                                                                  if($gender == 'male'){
                                                                       $imgsrc = "../upload/undraw_profile_pic_ic5t.png";
                                                                    }else {
                                                                        
                                                                        $imgsrc = "../upload/undraw_female_avatar_w3jk.png";
                                                                    }
                                                            }else {
                                                                $imgsrc = $src.$uname['photo'];
                                                            }
                                                            $fullname = $uname['surname'].' '.$uname['name'];
                                                            $courseid = $uname['course'];
                                                  $yearid = $uname['year'];

                                                    
                                                    }
                                                       if ($votes == 0) { 



                                                      }else {

                                                        ?>

                                                <tr>
                                                    <td class="">
                                                      <img src="<?php echo $imgsrc ?>" style="width: 80px;height: 80px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" class="">
                                                      
                                                    </td>
                                                    <td>
                                                      <?php echo $posname ?>
                                                    </td>
                                                    <td>
                                                      <?php echo $fullname ?>
                                                    </td>
                                                    <td>
                                                      <?php 
                                                        $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      echo $getcourse['course'].'-';
                                      
                                           }

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
                                                    </td>

                                                    <td>
                                                        <?php 

                             $prtylist = " select * from `partylist` where party_id = '$partylist' ";
                                          $resultprtylist = mysqli_query($con,$prtylist);
                                       
                                       
                                           while($getpt = mysqli_fetch_array($resultprtylist)){
                                      echo $getpt['partylist'];
                                           }

                            ?>

                                                    </td>

                                                    <td>
                                                      <?php 
                                                      echo $votes
                                                       ?>
                                                    </td>
                                                   

                                                </tr>
                                                <?php

                                                      }


                                              }

                                            }
                                  }



                                }
                   
                }/////elseend



                      ?>

                      <!-------------------------------------------------------------------->
                       </tbody>
                      </table>
                         </div>
                     </div>
                                     
                       


      <hr>
      <input type="hidden" name="" value="<?php echo $titleelect ?>" id="titles">
      <footer class="text-center">
        <div class="mb-2">
          <small>
            ©Copyrights &middot; 2021 
          </small>
        </div>
      
      </footer>
    </div>
  </main>



                                
                                 
                                  
                                 
               
                  <style type="text/css">
                       @media print { 
       @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap')
        .introduction{
        position: relative;
    }
     .intro {
        text-align: center;
        margin-top: 50px;
        padding-top: 25px;
     }
     .wmsuimg {
        position: absolute;
        left: 80px;
        width: 120px; float: right;
     }
     .gccimg {
        position: absolute;
        right: 110px;
        width: 90px; float: right;
     }
     h5 {
      font-family: 'Oswald', sans-serif;
      font-size: 16px;
     font-style: italic;
     }
     h4 {
        font-size: 18px;
     }
     #zambo {
        font-size: 14px;padding-top: 5px;
     }
     .print{
        display: none;
     }

     }
                  </style>               
                                
                                  
                                 
 
  <!-- page-content" -->
  <script type="text/javascript">
    
    $(document).ready(function() {

      $('#printres').click(function() { 
       window.location.href="print.php";
        //PrintDiv('electionresult');
      })
      
   function PrintDiv(id) {
    var tt = $('#titles').val();
            var data=document.getElementById(id).innerHTML;
            var myWindow = window.open('', 'my div', 'height=800,width=800');
            myWindow.document.write('<html><head><title>Print Election Results</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body >');
           myWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">');

            myWindow.document.write('<img class="wmsuimg" style="" src="img/bgwmsu.jfif" style="position: absolute; left: 80px;width: 100px; float: right;">');
              myWindow.document.write('  <img class="gccimg" style="" src="https://lms.wmsuics.tech/login/new_login/img/ics_resize.png" style="position: absolute;right: 110px;width: 4pr0px; float: right;">');
               myWindow.document.write('<div class="intro" style=" text-align: center;margin-top: 50px; padding-top: 25px;">');
               myWindow.document.write('<h4 style="font-size: 18px;">Western Mindanao State University</h4>');
                myWindow.document.write(' <h5 style="font-size: 16px;font-style: italic;">Isc voting system</h5>');
                 myWindow.document.write('<span id="zambo" style="font-size: 14px;padding-top: 5px;">Zamboanga City</span>');
                   myWindow.document.write('</div>');

             myWindow.document.write('<h4> '+tt+' RESULTS</h4>');
            myWindow.document.write(data);
          
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                //myWindow.close();
            };

        }
             $('#flexSwitchCheckDefault').click(function() {
                  if($(this).prop("checked") == true) {
                      
                                                
                                                    
                                                       var xhttp = new XMLHttpRequest();
                                                      xhttp.onreadystatechange = function() {
                                                       if (this.readyState == 4 && this.status == 200) {
                                                      const data = this.responseText;
                                                    
                                                        // Your condition here if data success.
                                                    
                                                                   }
                                                                };
                                                        xhttp.open("POST", "reset.php",true);
                                                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                        xhttp.send("Publicize=1");
                                                            
                                                                     
                                                     
                                                                                
                     }
                  else if($(this).prop("checked") == false) {
                       
                                                             var xhttp = new XMLHttpRequest();
                                                      xhttp.onreadystatechange = function() {
                                                       if (this.readyState == 4 && this.status == 200) {
                                                      const data = this.responseText;
                                                    
                                                        // Your condition here if data success.
                                                    
                                                                   }
                                                                };
                                                        xhttp.open("POST", "reset.php",true);
                                                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                        xhttp.send("unPublicize=1");
                                                                                   
                   }
                });
          });      
          
  </script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>


<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>

