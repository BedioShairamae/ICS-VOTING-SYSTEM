<?php 
session_start();
include '../admin/connection/connect.php';

if(isset($_POST['selecttrigger'])){ 
	$selecttrigger = $_POST['selecttrigger'];
	$selectcheck = $_POST['selectcheck'];
	if ($selecttrigger == 'verify'){

	 foreach ($selectcheck as $checkid) {
											
         		$sql = " UPDATE `student` SET `isverified`=1 WHERE s_id ='$checkid'  ";
                         $result = mysqli_query($con,$sql); // run query
                         
                   

		}                            
									
	} 
	else if ($selecttrigger == 'delete') {
			
	 foreach ($selectcheck as $checkid) {
											
                                       
				$sql = "DELETE FROM `student` WHERE s_id ='$checkid' and isverified = 0  ";
                         $resultde = mysqli_query($con,$sql); // run query	

	} 
	}else if ($selecttrigger == 'revoke') {
			
	 foreach ($selectcheck as $checkid) {
											
                                       
			$sql = " UPDATE `student` SET `isverified`=0 WHERE s_id ='$checkid'  ";
                         $result = mysqli_query($con,$sql); // run query	

	} 
	}
	
}

 ?>