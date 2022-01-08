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
				<header class="headerbackground">
 			 
 			 		<span id="sidenav-toggle"  onclick="openNav()"><i class="fas fa-bars"></i></span>
 			    <script type="text/javascript">

    
        function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}      
              
      </script> 
 			 
					 <div class="container title">

					 	<h3><?php echo  $_SESSION['election_title'] ?><?php echo $elecyear.'-'.date($elecyear+1) ?> <br><span>Semester <?php echo $elecsem ?></span></h3>
					 </div> 
					
						
				</header>
				
				 
				<nav class="navbar navbar-expand-lg  custom">
	<div class="container">
  <a class="navbar-brand" href="statistics.php"><i style="padding-right: 10px" class="fas fa-chart-line"></i>Overall Statistics</a>
 <?php include 'include/positionstandstatistics.php'?>
  </div>
  
				</nav>

<div id="mySidenav" class="sidenav">
	<?php include 'include/sidebar.php'?>
	<button onclick="window.location.href='logout.php'" class="logout"><i class="fas fa-power-off"></i> Logout</button>
</div>
            


			<!--	<div class="container">
          <?php
                     if(isset($_GET['sortby'])) {
                    $sort = $_GET['sortby'];
                    $posid = $_GET['id'];
                             $fetch-> getgraphsby($posid);
                        }else {
                           $fetch->getgraphs();
                        }

                    ?>
				 
                          <script>
                                window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    exportEnabled: true,
    animationEnabled: true,
    title:{
        text: "Mayor Voting Statistics"
    },
    legend:{
        cursor: "pointer",
        itemclick: explodePie
    },
    data: [{
        type: "pie",
        showInLegend: true,
        toolTipContent: "{name}: <strong>{y}%</strong>",
        indexLabel: "{name} - {y}% of Votes",
        dataPoints: [
            { y: 26, name: "Baldwick Pota", exploded: true },
            { y: 20, name: "Escobar NANA" },
            { y: 5, name: "Andole bole" },
            { y: 3, name: "Cristhine Korn" },
            { y: 7, name: "May noayss" },
            { y: 17, name: "Excuse me" },
            { y: 22, name: "Botyo ma"}
        ]
    }]
});
chart.render();
}

function explodePie (e) {
    if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
        e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
    } else {
        e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
    }
    e.chart.render();

}
</script>
 <div class="container" style="margin-top: 20px;">
      <div id="chartContainer" style="height: 450px; width: 100%;"></div>
 </div> 
 <hr>
  
   <div class="row ">


       <h4 style="font-weight: bolder;"> Candidate Details </h4>
                 <?php
                     if(isset($_GET['sortby'])) {
                    $sort = $_GET['sortby'];
                    $posid = $_GET['id'];
                             $fetch-> getcandidatecardby($posid);
                        }else {
                           $fetch->getcandidatecard();
                        }

                    ?>

     


 </div>-->

           <div class="container mt-5">
               <div class="card shadow-sm">
                  <div class="card-body">
                    
                     <div class="container" style="font-size: 18px;">
                        
                                <table class="table table-striped table-lg">
            <thead>
              <tr>
                <th scope="col">Candidate</th>
                <th scope="col">Position</th>
                <th scope="col">Total vote percentage</th>
               
              </tr>
            </thead>
            <tbody>
             
             
                                    <?php 

                                      if(isset($_GET['sortby'])) {
                    $sort = $_GET['sortby'];
                    $posid = $_GET['id'];
                            include 'sort.php';
                        }else {

                          
 

                                      //$totalvotes = 0;
                                     $selectwin = "select * from candidate where  election_id='$electid'  order by votes desc  ";
                                             $resultwin = mysqli_query($con,$selectwin); 
                                             $counterwin= mysqli_num_rows($resultwin);  
                                             if($counterwin >=1 ) {
                                              while($winner = mysqli_fetch_array($resultwin)){ 
                                                $winvotes= $winner['votes'];
                                                $votes =  $winner['votes'];

                                                $totalvotes[]= $winner['votes'];
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
                                                              $ssd= $uname['s_id'];
                                                              $ssids[]= $uname['s_id'];
                                                          
                                                            if($photo == ''){

                                                                  if($gender == 'male'){
                                                                       $imgsrc = "upload/undraw_profile_pic_ic5t.png";
                                                                    }else {
                                                                        
                                                                        $imgsrc = "upload/undraw_female_avatar_w3jk.png";
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

                                                       

                                                      }
                                                       ?>

                                                <tr>
                                               
                                                    <td>
                                                             <?php 
                                                     
                                                        $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      $crs= $getcourse['course'].'-';
                                      
                                           }

                                             $year = " select * from year where yearid = '$yearid'  ";
                                          $resultas = mysqli_query($con,$year);
                                        
                                        
                                           while($getyear = mysqli_fetch_array($resultas)){
                                      $yr= $getyear['year'];
                                           }
                          
                                            $sectionqry = " select * from section where sec_id = '$section' ";
                                          $resultsectionqry = mysqli_query($con,$sectionqry);
                                       
                                       
                                           while($getsec = mysqli_fetch_array($resultsectionqry)){
                                      $sc= $getsec['section'];
                                           }
                                    
                                                    

                             $prtylist = " select * from `partylist` where party_id = '$partylist' ";
                                          $resultprtylist = mysqli_query($con,$prtylist);
                                       
                                       
                                           while($getpt = mysqli_fetch_array($resultprtylist)){
                                     $pt= $getpt['partylist'];
                                           }

                                           $cys = $crs.'-'.$yr.$sc;



                                              $getname = " select * from position where pos_id = '$posid' and election_id ='$electid'  ";
                                                          $resultgetname = mysqli_query($con,$getname); 
                                                       
                                                           while($name = mysqli_fetch_array($resultgetname)){
                                                   
                                                    $posname = $name['pos_name'];
                                                    $nowinn = $name['pos_noofwinner'];
                                                    $countofvote = $name['maxvote'];
                                                           }
                                                    
                                      
                                           

                            ?>
                                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" class="electeddetails" data-name="<?php echo $fullname ?>" data-pos="<?php echo $posname ?>" data-advoc="<?php echo $advocacy  ?>" data-pt="<?php echo $pt ?>" data-sec="<?php echo $cys ?>" data-img="<?php echo $imgsrc ?>" ><?php echo $fullname ?></a>
                                                    </td>
                                                
                                                    <td>
                                                      <?php 

                                                          $selectposition = "SELECT * FROM `position` where pos_id = '$posid'  ";
                                                                      $resultapos = mysqli_query($con,$selectposition); 
                                                                     
                                                                   
                                                                       while($rowget = mysqli_fetch_array($resultapos)){
                                                                        echo $rowget['pos_name'];
                                                                       }
                                                                
                                                      ?>
                                                    </td>

                                                    <td>
                                                     
                 
              <div class="progress" >
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"  id="<?php echo $ssd ?>" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>


             

                                                    </td>
                                                   

                                                </tr>
                                                <?php


                                              }

                                            }
                                
                                 $sum = array_sum($totalvotes);
                                 

                                

                                   for($j = 0 ; $j < count($totalvotes);$j++){
                                   //echo percentage($totalvotes[$j],$sum);
                                    if($sum == 0){

                                    }else {
                                      
                                    }

                                  
                                  ?>
                                
                                  <script type="text/javascript">
                                    
                                    $(document).ready(function() {
                                         $('#<?php echo $ssids[$j]?>').css('width',<?php echo percentage($totalvotes[$j],$sum); ?>+'%');
                                         $('#<?php echo $ssids[$j]?>').html(<?php echo percentage($totalvotes[$j],$sum); ?>+'%');
                                          });      
                                



                                  </script>
                                  <?php
                                 }


                            /////
                        }


                          function percentage($num_amount, $num_total){
                                 $count1 = $num_amount / $num_total; 
                                 $count2 = $count1 * 100; 
                                 $count = number_format($count2, 0); 
                                 return $count;

                                 }


                                  


                                     ?>

            </tbody>
          </table>
                     </div> 
                     

                  </div> 
                  
               </div> 
               
      


           </div> 
           
 
         




 <p><br></p>
 
     
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>                            
                                          
        <script type="text/javascript">
                    
                    setInterval(function(){
    
  
     $.ajax({
             url : "gettime.php",
              method: "POST",
               data  : {checkchange:1},
               success : function(data){
          if(data == 'changed'){
            Swal.fire({
        title: 'Schedule Has Changed!',
        text: "",
        icon: 'info',
      
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      })
          }else if(data == 'Notset'){
        $('#textend').text('Schedule Not Yet Set..')
          }else if (data == 'End'){
            window.location.href="election_end.php";
          }



               }
            })
       
      
},10000);
      
                          
                  </script>          




				 </div> 
				

		 	
          <script type="text/javascript">
                              
                              $(document).ready(function() {
                                      $('.electeddetails').click(function() { 
                                        var name = $(this).data('name');
                                        var pos = $(this).data('pos');
                                        var advoc = $(this).data('advoc');
                                        var src = $(this).data('img');
                                        var sec = $(this).data('sec');
                                        var pt = $(this).data('pt');
                                        $('#pos').text(pos);
                                        $('#name').text(name);
                                        $('#advoc').text(advoc);
                                        $('#imgsrc').attr('src',src);
                                        $('#sec').text(sec);
                                        $('#pt').text(pt);
                                      
                                      })
                                    });      
                                    
                             </script>
	 	
		 	


          
                             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                   <div class="modal-header">
                                   
                                   </div>
                                   <div class="modal-body">
                                     <div class="container" style="text-align: center;">
                                      <span class="badge badge-success bg-success" style="float: left;">FOR <span style="text-transform: uppercase;" id="pos">MAYOR</span></span>
                                      <br>

                              <img src="https://www.nicepng.com/png/full/136-1366211_group-of-10-guys-login-user-icon-png.png" class="rounded-circle img-thumbnail" id="imgsrc" style="width: 100px; height: 100px">
                              <br>
                              <span style="font-size: 13px;font-weight: bold" id="name">CAIMOR REENJAY</span><br>
                              <span style="font-size: 12px" id="sec"></span><br>
                               <span style="font-size: 12px;font-weight: bold" id="pt"></span>
                              <br>
                              <span style="font-size: 13px;float: left;" >Advocacy:</span>

                              <br>
                              <span id="advoc" style="font-size: 13px;text-align: left;">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </span>
                                      
                                     </div> 
                                                               
                             
                                    
                                   </div>
                                   <div class="modal-footer">
                                     <button type="button" class="btn btn-light border border-primary" style="font-size:12px" data-dismiss="modal">Close</button>
                                   
                                   </div>
                                 </div>
                               </div>
                             </div>


			</body>


	
<?php include 'include/footer.html'?>
