<?php 
session_start();
if(!isset($_SESSION['voter_login'])) {
	header("location:index.php");
}



include 'admin/connection/connect.php';
/*$sid = $_SESSION['voter_login'];
$sql = " select * from student where s_id = '$sid'  ";
$result = mysqli_query($con,$sql); 
		
                 while($row = mysqli_fetch_array($result)){
                 $voted = $row['voted'];
                 }
      if($voted == 1){

      }*/
          

include 'include/header.html'; 
include 'class.php';
?>
	<style type="text/css">
		
	</style>
	<body style="background-color: rgb(11, 57, 11)">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			
			Swal.fire({
  icon: 'success',
  showConfirmButton: false,
  title: 'You have successfully casted your vote!',
  text: 'Thank you for your participation!',
  footer: '<a href="statistics.php" class="btn btn-secondary" >View STATISTICS  <i class="fas fa-chart-line"></i> </a>'
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.dismiss) {
   window.history.back();
  } 
})      
		      	
		</script>
					
	

			</body>

		<script type="text/javascript">

		
				function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}      
			      	
			</script>	
<?php include 'include/footer.html'?>
