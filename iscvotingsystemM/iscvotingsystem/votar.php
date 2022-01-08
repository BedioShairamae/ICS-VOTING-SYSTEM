<?php 
session_start();
include 'admin/connection/connect.php';

if(isset($_POST['castvote'])){ 
	$cid = $_POST['cid'];
	$fullname = $_POST['fullname'];

	$vid = $_SESSION['voter_login'];
								$sql = " select * from temp_votes where tmpvote_id = '$cid'  ";
						                $result = mysqli_query($con,$sql); // run query
						               
						            
						                 while($row = mysqli_fetch_array($result)){
											$posid = $row['posid'];
											$svid = $row['sv_id'];
											$votecount = $row['vote'];
											$voters = $row['voters'];
						                 }
						                 $finalvote = $votecount + 1 ;
						                 $finalvoters = $voters.$vid.',';
						          
						          $sqluser = " select * from student where s_id = '$svid'  ";
						                $resultuser = mysqli_query($con,$sqluser); // run query
						               
						            
						                 while($row = mysqli_fetch_array($resultuser)){
											$wholename = $row['surname'].' '.$row['name'];
						                 }

						                 $insertvote = "UPDATE `temp_votes` SET `vote`='$finalvote',`voters`='$finalvoters' WHERE tmpvote_id = '$cid' ";
						                $resultinsert = mysqli_query($con,$insertvote); // run query
						               
	
}
if(isset($_POST['cancelvote'])){ 
	$cid = $_POST['cid'];
	$vid = $_SESSION['voter_login'];
	
		$sql = " select * from temp_votes where tmpvote_id = '$cid'  ";
						                $result = mysqli_query($con,$sql); // run query
						               
						            
						                 while($row = mysqli_fetch_array($result)){
											$posid = $row['posid'];
											$svid = $row['sv_id'];
											$votecount = $row['vote'];
											$voters = $row['voters'];
						                 }

						                 $finalvote = $votecount - 1 ;
						                 $finalvoters = $voters.$vid.',';

						             
						                           

$upt = "UPDATE `temp_votes` SET `vote`='$finalvote',`voters`=TRIM(BOTH '$vid,' FROM TRIM(REPLACE(concat('$voters'),' ,$vid, ',''))) WHERE tmpvote_id = '$cid' ";
		                $resultupt = mysqli_query($con,$upt); // run query
		             if($resultupt){
		             	echo 'Run';
		             }
	
}
 ?>