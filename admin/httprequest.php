<?php 
session_start();
include 'connection/fetch_data.php';
include 'connection/connect.php';
if(isset($_POST['getdetails'])) {
	$cid = $_POST['cid'];
	
			$sql = " select * from candidate where cid = '$cid'  ";
	                $result = mysqli_query($con,$sql); // run query
	             
	                 while($row = mysqli_fetch_array($result)){
						$adv = $row['advocacy'];
	                 }

	          	if(is_null($adv)) {
	          		echo 'No Advocacy';
	          	}else {
	          		echo $adv;
	          	}

}


if(isset($_POST['btnedit'])) {

$txtdetails = $_POST['txtdetails'];
$partylist = $_POST['partylist'];
$cid = $_POST['cid'];
$svid = $_POST['svid'];
	

	$updatedvalues = "`advocacy`='$txtdetails' , `partylist`='$partylist' ";
   $wherecondition = "cid = '$cid'";
  $whereconditiontmp = "sv_id = '$svid'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('candidate',$updatedvalues,$wherecondition);
    $fetch -> updatequery('temp_votes',$updatedvalues,$whereconditiontmp);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
     Candidate Advocacy <strong>Updated Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:candidates.php');
}
if(isset($_POST['btndel'])) {
$cid = $_POST['cid'];
 $wherecondition = " `cid` = '$cid' ";
   $fetch = new Fetch_data();
    $fetch -> deletequery('candidate',$wherecondition);

     $sqlcheck = " Select * from temp_votes AS T1 where not exists( select * from candidate AS T2 where T1.sv_id = T2.sv_id and T1.posid = T2.pos_id and T1.election_id = T2.election_id)   ";
                     $resultcheck = mysqli_query($con,$sqlcheck); 
                      $counttmp= mysqli_num_rows($resultcheck);
                
                      while($row = mysqli_fetch_array($resultcheck)){
                        $tempid  = $row['tmpvote_id'];
                          for ($i=0; $i <= $countmp; $i++){
                            $del = "DELETE FROM `temp_votes` WHERE tmpvote_id = '$tempid' ";
                          }
                          $resultdel = mysqli_query($con,$del); 
                      }
               
     $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
      Candidate <strong>Deleted Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:candidates.php');
}

if(isset($_POST['btnsaveelecsched'])) {

       
        $txtstartdate = $_POST['txtstartdate'];
        $txtenddate = $_POST['txtenddate'];
        $lid = $_POST['lid'];
       $promt = $_POST['subprompt'];
       $electiontitle = $_POST['electiontitle'];

       $_SESSION['eventenddowns'] = $txtenddate;
       

        
      if($txtstartdate == '' || $txtenddate == '') {
       $updatedvalues = " `voterlogin`='$promt',`title`='$electiontitle'  ";
      }else {
         $updatedvalues = "`eventstart`='$txtstartdate',`eventend`='$txtenddate' , `voterlogin`='$promt',`title`='$electiontitle',`notification`= 0   ";
      }
     
     
   $wherecondition = " election_id = '$lid'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('election_sched',$updatedvalues,$wherecondition);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
     <strong>Updated Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:election.php');
        
}

if(isset($_POST['btnsavenewsched'])) {
  $txtsem = $_POST['txtsemester'];
  $electiontitlenew = $_POST['electiontitlenew'];
    $yearselected = $_POST['yearselected'];
        $txtstartdate = $_POST['txtstartdate'];
        $txtenddate = $_POST['txtenddate'];

        $year = date("Y");


              $sql = " select * from election_sched where title ='$electiontitlenew' ";
                          $result = mysqli_query($con,$sql); // run query
                          $count= mysqli_num_rows($result); // to count if necessary
                         //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                       if ($count == 1){
                           $_SESSION['action'] = '   <div class="alert alert-danger" id="alerto" role="alert">
                           <strong>You can only Add 2 semester per Year . Semester '.$txtsem.'  already Exist </strong>
                              </div>
                              <script type="text/javascript">
                                
                                var times = setInterval(function() {
                                  document.getElementById("alerto").classList.add("d-none");
                                   clear();
                                },15000);

                                function clear() {
                                  clearInterval(times);
                                }     
                                      
                              </script>';
                              header('location:election.php');
                    }else {

                          date_default_timezone_set('Asia/Manila');
                $datenow = date('Y-m-d H:i:s');
                 $yearonly = date("Y");

   $conditions = "  `semester`, `year`, `eventstart`, `eventend`, `date-modified`, `voterlogin`, `status`,`title`";
   $insertvalue = " '$txtsem','$yearselected','$txtstartdate','$txtenddate','$datenow','enabled','inactive','$electiontitlenew' ";
    $fetch = new Fetch_data();
    $fetch -> insertquery('election_sched',$conditions,$insertvalue);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
        <strong>New scheduled saved successfully !</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:election.php');

                    }
       
}
?>