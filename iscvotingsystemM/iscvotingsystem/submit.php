<?php 
session_start();
include 'admin/connection/connect.php';

	if(isset($_POST['submitvote'])){ 
		$vid = $_SESSION['voter_login'];
		$electid = $_SESSION['election_id'];
			
			//get all svid in tmp votes. 
			//save id to candidates.
			//set student vote data 1= meaning already voted.

					$getallidtempvotes = " select * from temp_votes where FIND_IN_SET('$vid',voters) ";
			                $result = mysqli_query($con,$getallidtempvotes); // run query
			              		
			                 $counti= mysqli_num_rows($result); 
			                            
			                 while($row = mysqli_fetch_array($result)){
								$svid = $row['sv_id'];
								$posid = $row['posid'];

								$sql = " select * from candidate where sv_id = '$svid' and pos_id = '$posid' and election_id='$electid'  ";
						                $resultsql = mysqli_query($con,$sql); // run query
						               
						            
						                 while($rows = mysqli_fetch_array($resultsql)){
											$pos_id = $rows['posid'];
											$sv_id = $rows['sv_id'];
											$votecount = $rows['votes'];
											$voters = $rows['voters'];
						                 }
						                 $finalvote = $votecount + 1 ;
						                 $finalvoters = $voters.$vid.',';

								$submitvote = "UPDATE `candidate` SET `votes` = '$finalvote',`voters`='$finalvoters' WHERE sv_id = '$svid' and pos_id = '$posid' and election_id='$electid'";
								   $submitted = mysqli_query($con,$submitvote);


			                 }

			                 $setstud = "UPDATE `student` SET `voted`='1' WHERE s_id = '$vid'";
			                  $setres = mysqli_query($con,$setstud);
			               
			          
		
	}

 ?>