<button href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</button>
 <div class="container " id="userint">
 	<?php
 	$id = $_SESSION['voter_login'];
 			$sql = " select * from student where s_id = '$id'  ";
 	                $result = mysqli_query($con,$sql); 
 	                $count= mysqli_num_rows($result); 
 	           
 	                 while($row = mysqli_fetch_array($result)){
 	                 	$src = "upload/";
			                    								                 	$photo = $row['photo'];
			                    								                 	if($photo == '') {
			                    								                 		$imgsrc = 'https://th.bing.com/th/id/OIP.1DLYAqE5UY19idJJOkFQegHaHa?w=195&h=195&c=7&o=5&pid=1.7';
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$row['photo'];
			                    								                 	}
 		?>
 			<h6 style="text-align: center;"><img src="<?php echo $imgsrc ?>" class="rounded-circle" width="50"><br>
 	<span style="font-weight: bolder"><?php echo $row['surname'].' '.$row['name'] ?> </span><br> <span style="font-size: 12px"><?php echo $row['email']; ?></span><br><span> ONLINE <i style="color: green" class="fas fa-check-circle"></i></span></h6>	
 		<?php
 	                 }
 	          
 	?>
 	
 </div> 
 
	
<hr>
  <a href="home.php"><i style="padding-right: 10px"  class="fas fa-users"></i> Candidates</a><hr>
  <a href="statistics.php"><i style="padding-right: 10px" class="fas fa-chart-line"></i> Statistics </a><hr>
  <a href="aboutus.php"><i style="padding-right: 10px" class="far fa-question-circle"></i> About us </a><hr>
  <a href="myaccount.php"><i style="padding-right: 10px" class="fas fa-user-cog"></i> My Account</a>