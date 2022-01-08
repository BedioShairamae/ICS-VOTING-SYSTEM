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
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">STATISTICS</h2>
       <style type="text/css">
        .pf {
          position: fixed;
          z-index: 1;
          right: 10px;
          width: 200px;
        }
      </style>
       <div class="pf mt-4" id="timee">
 <div class="position-absolute bottom-0 start-50 translate-middle-x">
    <!--<div class="alert alert-dark" role="alert">
   <span style="font-weight: bolder;font-size: 16px"> <div class="clock"  ><div class="displayoutside"></div></div> </span> 
       <span style=""><?php echo  date('F j,  Y ',strtotime(date('Y-m-d H:i:s'))); ?></span>

</div>-->
 </div>

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
      <hr>

      <?php 
      if(isset($_SESSION['action'])){
        echo $_SESSION['action'];
        unset($_SESSION['action']);
      }
       ?>
       

       <div class="row">
          <div class="row">
            <div class="col-sm-3">
              <a href="voters.php" style="text-decoration: none">
              <div class="card" style="border-right: 5px solid #f6c23e;height: 150px">
                 <div class="container">
                  <p></p>
                    <h6 style="text-align: center;">Percentage of Voters who Cast a Ballot<br> <span>
                      <br>

                   <?php 
                   $electionid = $_SESSION['electsched'];
                   
                      $sql = " select * from `student` where election_id ='$electionid' and isverified = 1 ";
                                  $result = mysqli_query($con,$sql); // run query
                                  $count= mysqli_num_rows($result); // to count if necessary
                                  

                          $vt = "SELECT * FROM `student` WHERE voted = 1 and election_id ='$electionid' ";
                           $resultvt = mysqli_query($con,$vt);
                             $countvt= mysqli_num_rows($resultvt); 
                            


                            try {
                              echo cal_percentage($countvt, $count).'%';
                          } catch(DivisionByZeroError $e){
                             
                          }          
                            
                            
                             function cal_percentage($num_amount, $num_total) {
                            $count1 = $num_amount / $num_total;
                            $count2 = $count1 * 100;
                            $count = number_format($count2, 0);
                            return $count;
                          }        
                            
                    ?>
                    <br>
                   <?php echo $countvt.' vote/s out of '.$count ?>
                      
                    </span></h6>


                 </div> 
                 
               
             </div> 
             </a>
            </div>
            <div class="col-sm-3">
              <a href="voters.php" style="text-decoration: none">
              <div class="card" style="border-right: 5px solid #9b233c;height: 150px">
                 <div class="container">
                  <p></p>
                
                    <h6 style="text-align: center;">Number of Verified Voters <br> <span>
                   <?php 
                   $electionid = $_SESSION['electsched'];
                    $wherecondition = "election_id ='$electionid' and isverified = 1 ";
                    $fetch ->count_row('student',$wherecondition);
                    ?>
                    <br><br>
                    Unverified Voters
                    <br>
                     <?php 
                   $electionid = $_SESSION['electsched'];
                    $wherecondition = "election_id ='$electionid' and isverified = 0 ";
                    $fetch ->count_row('student',$wherecondition);
                    ?>
                      
                    </span></h6>


                 </div> 
                 
               
             </div> 
             </a>
            </div>
            <div class="col-sm-3">
              <a href="position.php" style="text-decoration: none">
              <div class="card" style="border-right: 5px solid #239b82;height: 150px">
                <div class="container">
                  <p></p>
                  <br>
                    <h6 style="text-align: center;">Number of Position  <br> <span>
                      <?php 
                      $electionid = $_SESSION['electsched'];
                    $wherecondition = "election_id ='$electionid'";
                    $fetch ->count_row('position',$wherecondition);
                    ?>

                    </span></h6>
                 </div> 
             </div>
             </a>
            </div>
            <div class="col-sm-3">
              <a href="candidates.php" style="text-decoration: none">
              <div class="card" style="border-right: 5px solid #1a77c9;height: 150px">
                 <div class="container">
                  <p></p>
                  <br>
                    <h6 style="text-align: center;">Number of Candidates  <br> <span>
                      <?php 
                      $electionid = $_SESSION['electsched'];
                    $wherecondition = "election_id ='$electionid'";
                    $fetch ->count_row('candidate',$wherecondition);
                    ?>
                    </span></h6>
                 </div> 
             </div>
             </a>
            </div>
            
          </div>
        <p><br></p> 
       
      <?php 
      include 'connection/connect.php';
        $electid = $_SESSION['election_id'];
                $sqlss = " select * from candidate where election_id = '$electid' ";
                            $resultss = mysqli_query($con,$sqlss); // run query
                        $countss= mysqli_num_rows($resultss); 
                       
                        if($countss >= 1) {
                          

          ?>
          <script>
                        
                        
        window.onload = function () {
          
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          
          title:{
            text:"Candidates Poll "
          },
          axisX:{
            interval: 1
          },
          axisY2:{
            interlacedColor: "rgba(1,77,101,.2)",
            gridColor: "#446044",
            title: "Number of Votes"
          },

          data: [{
            type: "bar",
            name: "companies",
            axisYType: "secondary",
            color: "#014D65",
           
            dataPoints: [
             <?php 
              while($row = mysqli_fetch_array($resultss)){
                      $canid = $row['sv_id'];
                      $vote= $row['votes'];
                        $sqlget = " select * from student where s_id = '$canid' and election_id='$electid'  ";
                                      $resultget = mysqli_query($con,$sqlget); 
                                    
                                       while($user = mysqli_fetch_array($resultget)){
                                        $canname = $user['surname'].' '.$user['name'];
                                        if($vote == '') {
                                          ?>
                                  { y: <?php echo '0'?>, label: "<?php echo $canname;?>" },
                                <?php 
                                        }else {
                                          ?>
                                  { y: <?php echo $vote?>, label: "<?php echo $canname;?>" },
                                <?php 
                                        }
                                      
                                       }
                                
                              

                             }
             ?>
            
             
             
            
            ]

          }]
        });

        chart.render();

        }
        </script>
      
          <?php
        }else {
          ?>
          <script>
window.onload = function () {
  
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  
  title:{
    text:"Candidates Poll"
  },
  axisX:{
    interval: 1
  },
  axisY2:{
    interlacedColor: "rgba(1,77,101,.2)",
    gridColor: "#446044",
    title: "Number of Votes"
  },
  data: [{
    type: "bar",
    name: "companies",
    axisYType: "secondary",
    color: "#014D65",
    dataPoints: [
      
      { y: 0, label: "Null" },
    
    ]
  }]
});
chart.render();

}
</script>
          <?php
        }
       ?>
 <div id="chartContainer" style="height: 450px; width: 100%;"></div>





       </div>

     


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


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>
  

<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>

