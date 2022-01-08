<?php 
session_start();
include 'connection/fetch_data.php';
include 'connection/connect.php';
	if(isset($_POST['checkvalid'])){ 
		$value = $_POST['value'];
					$sql = " select * from student where email = '$value'  ";
			                $result = mysqli_query($con,$sql); 
			                $count= mysqli_num_rows($result); 
			             
			             
			                 if (preg_match("~@wmsu\.edu.ph$~",$value)){ 

			                
			             if ($count==1){
			             
				        echo 'exist';
			          }else {
			          	echo 'proceed';
			          }
			           }else {
			           	echo 'notvalid';
			           }
		
	}

	if(isset($_POST['checkedit'])){ 
			$value = $_POST['value'];
					$sql = " select * from student where email = '$value'  ";
			                $result = mysqli_query($con,$sql); 
			                $count= mysqli_num_rows($result); 
			             
			             
			              if (preg_match("~@wmsu\.edu.ph$~",$value)){ 

			                
			             if ($count==1){
			             	 while($row = mysqli_fetch_array($result)){
 									$defemail = $row['email'];
                 				 }
                 				 if($defemail == $value) {
                 				 	echo 'proceed';
                 				 }else {
                 				 		 echo 'exist';
                 				 }
				       
			          }else {
			          	echo 'proceed';
			          }
			           }else {
			           	echo 'notvalid';
			           }
	}
 ?>
