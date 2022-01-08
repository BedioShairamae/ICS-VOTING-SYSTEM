<?php   
session_start();
include 'connection/connect.php';

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
<title>ISC Results</title>
</head>
<body>

 <style type="text/css" >
   @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap');
    *{
      font-family: 'Cairo', sans-serif;
    }
    @page { size: auto;  margin: 0mm; }
   
      @media screen and (max-width: 1500px)  { 
         .introduction{
        position: relative;
    }
     .intro {
        text-align: center;
        margin-top: 50px;
        padding-top: 30px;
     }
     .wmsuimg {
        position: absolute;
        left: 300px;
        width: 130px; float: right;
     }
     .gccimg {
        position: absolute;
        right: 320px;
        width: 100px; float: right;
        padding-bottom: : 8px;
     }
     h5 {
        
     }
      }

     @media screen and (max-width: 800px) {
    .introduction{
        position: relative;
    }
     .intro {
        text-align: center;
        margin-top: 50px;
        padding-top: 30px;
     }
     .wmsuimg {
        position: absolute;
        left: 40px;
     }
     .gccimg {
        position: absolute;
        right: 50px;
     }

     }

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

  <div  class="introduction">
                      
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
                         }

                         ?>  
                              
                               
                   
                                 <img class="wmsuimg" style="" src="img/bgwmsu.jfif">
                                  <img class="gccimg" style="" src="https://lms.wmsuics.tech/login/new_login/img/ics_resize.png">
                                 <div class="intro">
                                  
                                 <h4 >Western Mindanao State University</h4>
                                 <h5>Institute of Computer Studies </h5>
                                 <span id="zambo" style="">Zamboanga City</span>

                                
                               
                                
                                  
                                 </div> 


                                 <br><br>
                                 <h5 style="text-align: center;font-weight: bold;text-transform: uppercase;"><?php echo $_SESSION['printname'].'  '.$_SESSION['sem&year'].'-'.$elecyear+1 ?></h5>

                                 <br>

                                  <div class="container"> 


                                       <div class="row">

                                           <div class="col-md-2"></div> 
                                           <div class="col-md-8">
                                             
                                                <table class="table  table-hover table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Position</th>
                      <th scope="col">Candidate Photo</th>
                      
                      <th scope="col">Student_ID</th>
                       <th scope="col">Name</th>
                      <th scope="col">Course,Year and Section</th>
                     
                      <th scope="col">Partylist</th>
                    </tr>
                  </thead>
                  <tbody>

                   
<!-------------------------------------------------------------------->

                     <?php 
                    

               /*   $getname = " select * from position where pos_id  IN (SELECT pos_id FROM candidate) and election_id ='$electid'  ";
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
                                                              $section = $uname['section'];
                                                          
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
                                                      <img src="<?php echo $imgsrc ?>" style="width: 60px;height: 70px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" class="">
                                                      
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



                                
                   
                }/////elseend

*/

   
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
                                                                $src = "../upload/";
                                                            $photo = $stud['photo'];
                                                            $gender = $stud['gender'];
                                                              $section = $stud['section'];
                                                          
                                                            if($photo == ''){

                                                                  if($gender == 'male'){
                                                                       $imgsrc = "../upload/undraw_profile_pic_ic5t.png";
                                                                    }else {
                                                                        
                                                                        $imgsrc = "../upload/undraw_female_avatar_w3jk.png";
                                                                    }
                                                            }else {
                                                                $imgsrc = $src.$stud['photo'];
                                                            }
                                                ?>

                                                <td>
                                                  
                                                    <img src="<?php echo $imgsrc ?>" style="width: 60px;height: 70px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" class="">
                                                      
                                                </td>
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
                       
                                                    <td>
                                                        <?php 

                             $prtylist = " select * from `partylist` where party_id = '$partyid' ";
                                          $resultprtylist = mysqli_query($con,$prtylist);
                                       
                                       
                                           while($getpt = mysqli_fetch_array($resultprtylist)){
                                      echo $getpt['partylist'];
                                           }

                            ?>

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
                        
       
      
    

                      ?>

                      <!-------------------------------------------------------------------->
                       </tbody>
                      </table>
                                           
                                       
                               
                                  
                            
                                 
                                     <div class="" style="text-align: center;">
                                     
                                                     
                                                  <!--  <span style="font-size: 14px;">End of File</span> -->
                                                    </div> 
                                                    </div> 

                                           </div> 
                                           <div class="col-md-2"></div>     
                                            

                                        </div>      
                                          
                                 
                                   </div> 
                             

                                       
                     </div> 
                     
                    <button class="btn btn-primary print" id="printpage" style="font-size: 15px;position: fixed;z-index: 9999;bottom: 10px;right:20px;width: 90px "> PRINT <i class="fas fa-print"></i></button>

                      <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary print" style="font-size: 15px;position: fixed; left: 20px;top:10px;width: 90px">Back</a>



<script type="text/javascript">

	$('#printpage').click(function() { 
    window.print();
    })
window.print();      
      	
</script>

</body>
</html>