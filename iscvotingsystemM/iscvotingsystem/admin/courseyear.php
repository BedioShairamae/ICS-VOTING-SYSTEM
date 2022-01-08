<?php 
 session_start();
include 'connection/fetch_data.php';
include 'connection/connect.php';
	
	if(isset($_POST['btneditcourse'])){ 
		$courseid = $_POST['courseid'];
		$txtcourse = $_POST['txtcourse'];

		
	$updatedvalues = "`course`='$txtcourse' ";
   $wherecondition = "courseid = '$courseid'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('course',$updatedvalues,$wherecondition);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
      Course <strong>Updated Successfully!</strong>
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
      header('location:course_year.php');

	}

	if(isset($_POST['btnedityear'])){ 
		$year = $_POST['yearid'];
		$txtyear = $_POST['txtyear'];

	$updatedvalues = "`year`='$txtyear' ";
   $wherecondition = "yearid = '$year'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('year',$updatedvalues,$wherecondition);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
      Year <strong>Updated Successfully!</strong>
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
      header('location:course_year.php');
	}

	if(isset($_POST['delcourse'])){
	$id = $_POST['id']; 
		
	$wherecondition = " `courseid` = '$id' ";
   $fetch = new Fetch_data();
    $fetch -> deletequery('course',$wherecondition);
     $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       <strong>Deleted Successfully!</strong>
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
      header('location:course_year.php');
	}

	if(isset($_POST['delyear'])){ 
		$id = $_POST['id'];
		$wherecondition = " `yearid` = '$id' ";
   $fetch = new Fetch_data();
    $fetch -> deletequery('year',$wherecondition);
     $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       <strong>Deleted Successfully!</strong>
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
      header('location:course_year.php');
		
	}

 ?>