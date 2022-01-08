<?php
session_start();
include 'admin/connection/connect.php';
include 'admin/connection/fetch_data.php';
$fetch = new Fetch_data();

	if(isset($_POST['btnsavepass'])) {
	 
	    $id =$_SESSION['voter_login'];
	    $newpass = $_POST['txtnewss'];
	   
	    $updatedvalues = "`password` = '$newpass',`con`= 0 ";
   $wherecondition = "s_id = '$id'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('student',$updatedvalues,$wherecondition);
     $_SESSION['action'] = '   <p><br></p><div class="alert alert-primary" id="alerto" role="alert">
     Password<strong>Changed Successfully!</strong>
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
    header("location:home.php");
	}


?>