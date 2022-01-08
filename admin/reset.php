<?php 
session_start();
include 'connection/connect.php';
$electsched = $_SESSION['electsched'];
if(isset($_POST['reset'])){ 


				$updatetemp = " UPDATE `temp_votes` SET `vote`=NULL,`voters`=NULL WHERE election_id = '$electsched'  ";
		                $resultupt = mysqli_query($con,$updatetemp); // run query

		                $updatecan = " UPDATE `candidate` SET `votes`=NULL,`voters`=NULL WHERE election_id = '$electsched'  ";
		                $resultuptcan = mysqli_query($con,$updatecan ); // run query

		                 $updatestud = "UPDATE `student` SET `voted`=NULL WHERE election_id = '$electsched'  ";
		                $resultuptstud = mysqli_query($con,$updatestud ); // run query
                   

                    $updatestud = " UPDATE `election_sched` SET `eventstart`=NULL,`eventend`=NULL WHERE election_id = '$electsched'  ";
                    $resultuptstud = mysqli_query($con,$updatestud ); // run query

                    //DELETE FROM `position` WHERE 0

                    $delpos = "DELETE FROM `position` WHERE election_id = '$electsched' ";
                    $delposresult =  mysqli_query($con,$delpos);
                    
                    $delcan = "DELETE FROM `candidate` WHERE election_id = '$electsched' ";
                    $delcanresult =  mysqli_query($con,$delcan);

                     $deltemp = "DELETE FROM `temp_votes` WHERE election_id = '$electsched' ";
                    $deltempresult =  mysqli_query($con,$deltemp);

                      $delpt = "DELETE FROM `partylist` WHERE  election_id = '$electsched' ";
                    $delptresult =  mysqli_query($con,$delpt);

                     $updt = "UPDATE `election_sched` SET `notification`=0 WHERE  election_id = '$electsched'";
                      mysqli_query($con,$updt);

                    $letstudentupt="UPDATE `student` SET `toupdate`='1' WHERE 1 ";
                      mysqli_query($con,$letstudentupt);
		               

	header('location:election.php');
	$_SESSION['action'] = '  <div class="alert alert-primary" id="alerto" role="alert">
        <strong> ELECTION RESET  Successfully!</strong>
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
	
}

if(isset($_POST['deletesched'])){ 
  $id = $_POST['id'];
          //delete election sched
        $deletesched = "DELETE FROM `election_sched` WHERE election_id='$id' ";
        mysqli_query($con,$deletesched); 

        //delete voters
         $deletevoters = "DELETE FROM `student` WHERE election_id='$id' ";
        mysqli_query($con,$deletevoters); 
        //delete positions
         $deletepos = "DELETE FROM `position` WHERE election_id='$id' ";
        mysqli_query($con,$deletepos); 
        //delete partylist
         $deletept = "DELETE FROM `partylist` WHERE election_id='$id' ";
        mysqli_query($con,$deletept); 
        //delete candidates
         $deletecan = "DELETE FROM `candidate` WHERE election_id='$id' ";
        mysqli_query($con,$deletecan); 
        //delete temp_votes
        $deletetmp = "DELETE FROM `temp_votes` WHERE election_id='$id' ";
        mysqli_query($con,$deletetmp); 
                  
}


if(isset($_POST['verify'])){ 
  $id = $_POST['id'];
        $sql = " UPDATE `student` SET `isverified`=1 WHERE s_id='$id'  ";
                    $result = mysqli_query($con,$sql); // run query
       

}

if(isset($_POST['revoke'])){ 
  $id = $_POST['id'];
        $sql = " UPDATE `student` SET `isverified`=0 WHERE s_id='$id'  ";
                    $result = mysqli_query($con,$sql); // run query
                  
}

if(isset($_POST['fetch'])){ 
$id = $_POST['id'];
unset($_SESSION['emptydata']);

 $letstudentupt="UPDATE `student` SET `toupdate`='1' WHERE 1 ";
                      mysqli_query($con,$letstudentupt); 

     $sql = " select * from student where election_id = '$id'  ";
                 $result = mysqli_query($con,$sql); // run query
                 $count= mysqli_num_rows($result); // to count if necessary
                //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
              if ($count>=1){
                  echo 'data';
                  while($row = mysqli_fetch_array($result)){
                      $svid = $row['sv_id'];
                      $name = $row['name'];
                      $surname = $row['surname'];
                      $middle_name = $row['middle_name'];
                      $gender = $row['gender'];
                      $course = $row['course'];
                      $year = $row['year'];
                      $section = $row['section'];
                      $date_registered = $row['date_registered'];
                      $logintype = $row['logintype'];
                      $email = $row['email'];
                      $password = $row['password'];
                      $photo = $row['photo'];
                      $toupt = $row['toupdate'];
                     



    $insert = "INSERT INTO `student`(`sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`, `year`, `section`, `date_registered`, `logintype`, `email`, `password`, `photo`, `election_id`, `voted`, `con`, `isverified`,`toupdate`) VALUES ('$svid','$name','$surname','$middle_name','$gender','$course','$year','$section','$date_registered','$logintype','$email','$password','$photo','$electsched',0,0,0,'$toupt')";
                      mysqli_query($con,$insert);

                  }
           }else {
                echo 'nodata';  
           }
  
}


if(isset($_POST['changefetch'])){ 
$id = $_POST['id'];
        
        $letstudentupt="UPDATE `student` SET `toupdate`='1' WHERE 1 ";
                      mysqli_query($con,$letstudentupt);


     $sql = " select * from student where election_id = '$id'  ";
                 $result = mysqli_query($con,$sql); // run query
                 $count= mysqli_num_rows($result); // to count if necessary
                //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
              if ($count>=1){
                  echo 'data';
                   $del = "Delete From student where election_id = '$electsched' ";
                   mysqli_query($con,$del);
                   $delcan = "DELETE FROM `candidate` WHERE election_id = '$electsched' ";
                    $delcanresult =  mysqli_query($con,$delcan);

                     $deltemp = "DELETE FROM `temp_votes` WHERE election_id = '$electsched' ";
                    $deltempresult =  mysqli_query($con,$deltemp);
                  while($row = mysqli_fetch_array($result)){
                      $svid = $row['sv_id'];
                      $name = $row['name'];
                      $surname = $row['surname'];
                      $middle_name = $row['middle_name'];
                      $gender = $row['gender'];
                      $course = $row['course'];
                      $year = $row['year'];
                      $section = $row['section'];
                      $date_registered = $row['date_registered'];
                      $logintype = $row['logintype'];
                      $email = $row['email'];
                      $password = $row['password'];
                      $photo = $row['photo'];
                      $toupt = $row['toupdate'];
                     



    $insert = "INSERT INTO `student`(`sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`, `year`, `section`, `date_registered`, `logintype`, `email`, `password`, `photo`, `election_id`, `voted`, `con`, `isverified`,`toupdate`) VALUES ('$svid','$name','$surname','$middle_name','$gender','$course','$year','$section','$date_registered','$logintype','$email','$password','$photo','$electsched',0,0,0,'$toupt')";
                      mysqli_query($con,$insert);

                  }
           }else {
                echo 'nodata';  
           }
  
}

if(isset($_POST['Publicize'])){ 
  $elecid = $_SESSION['electsched'];
      $sql = " UPDATE `election_sched` SET `result`=1 WHERE election_id='$elecid'  ";
                  $result = mysqli_query($con,$sql); // run query
                
}
if(isset($_POST['unPublicize'])){ 
  $elecid = $_SESSION['electsched'];
   $sql = " UPDATE `election_sched` SET `result`=0 WHERE election_id='$elecid'  ";
                  $result = mysqli_query($con,$sql); // run query
}

 ?>