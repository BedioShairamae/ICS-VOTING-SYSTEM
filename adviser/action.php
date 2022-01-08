<?php 
session_start();
include '../admin/connection/connect.php';
	
	if(isset($_POST['checkifnew'])){ 
$adv = $_SESSION['adviser_login'];
		$sql = " select * from adviser where adv_id='$adv'  ";
                $result = mysqli_query($con,$sql); // run query
              
                 while($row = mysqli_fetch_array($result)){
                 	$changepass = $row['changepass'];
                 }
          
			if($changepass == 0) {
				echo 'new';
			}
		
	}
	if(isset($_POST['skip'])){ 
		$adv = $_SESSION['adviser_login'];
				$sql = "UPDATE `adviser` SET `changepass`=1 WHERE adv_id ='$adv'  ";
		                $result = mysqli_query($con,$sql); // run query
		               
	}
	if(isset($_POST['savenewpass'])){ 
		$password = $_POST['password'];
		$adv = $_SESSION['adviser_login'];
				$sql = "UPDATE `adviser` SET `password`='$password' , `changepass`=1 WHERE adv_id ='$adv'  ";
		                $result = mysqli_query($con,$sql); // run query

		
	}
	if(isset($_POST['compare'])){
		$advid = $_SESSION['adviser_login'];
		$val = $_POST['val'];
			$sql = " select * from adviser where adv_id ='$advid' and password = '$val'  ";
	                 $result = mysqli_query($con,$sql); 
	                 $count= mysqli_num_rows($result); 
	               
	              if ($count==1){
	              	
	                 echo 'right';
	           } else {
	           	echo 'wrong';
	           }
		
	}

	if(isset($_POST['updateaccount'])){ 
		$advid = $_SESSION['adviser_login'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$email = $_POST['email'];
		$password = $_POST['password'];
				$sql = " UPDATE `adviser` SET `lastname`='$lastname',`firstname`='$firstname',`middlename`='$middlename',`email`='$email',`password`='$password' WHERE  adv_id ='$advid' ";
		                $result = mysqli_query($con,$sql); // run query
		               
	}
	if(isset($_POST['savephotoadv'])){ 
		$adv = $_SESSION['adviser_login'];

				//Make the imagename array set at form. look likes this name="imagename[]"
				$sqla = " select * from adviser where adv_id ='$adv'  ";
		                $resulta = mysqli_query($con,$sqla); // run query
		               
		                 while($row = mysqli_fetch_array($resulta)){
							$photo = $row['photo'];
		                 }
		                 $src=  '../upload/'.$photo;
		                 unlink($src);
		          
			
		                  $image_name = $_FILES['image']['name'];
		                   $tmp_name   = $_FILES['image']['tmp_name'];
		                $size       = $_FILES['image']['size'];
		                 $type       = $_FILES['image']['type'];
		                 $error      = $_FILES['image']['error'];
		                                                                                                                                    
		             
		                                                                                                                                    
		           $fileName =basename($_FILES['image']['name']);
		                 $rand = rand(100,1000);                                                                                                                   
		            $pname = $rand.'Photo'.'_'.$fileName;
		                // File upload path
		            $uploads_dir = '../upload';
		         move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);
		          $sql = " UPDATE `adviser` SET `photo`='$pname' WHERE  adv_id ='$adv' ";
		          $result = mysqli_query($con,$sql); // run query
		                                                                                                                          
		         
		           
		
		
		            
	}

 ?>