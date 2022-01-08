<?php 
session_start();
include 'admin/connection/connect.php';
include 'class.php';
	if(isset($_POST['checkstatus'])){ 
			$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                 							
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];	
              
               $eventstart = $active['eventstart'];
               $eventend = $active['eventend'];	
               $notification = $active['notification'];	
               										
         }
         date_default_timezone_set('Asia/Manila'); 
         $datenow = date('Y-m-d H:i:s');
          $startin24 = strtotime($eventstart."24 hour");
         if($notification == 0){
          if($eventstart == '0000-00-00 00:00:00' || $eventstart == NULL){

          }else

         		 if ($startin24 < $datenow){
			         	echo 'votingstartsendemails1';
			         }





          }else if( $notification == 1){
              if($eventstart == '0000-00-00 00:00:00' || $eventstart == NULL){

          }else

             if ($eventstart < $datenow){
                echo 'votingstartsendemails2';
               }
          }


         else {
         	echo 'nvm';
         }
        
	}

  if(isset($_POST['triggerring'])){ 
  $sid = $_SESSION['voter_login'];
                   $sname = $_POST['sname'];
                   $fname = $_POST['fname'];
                   $mname = $_POST['mname'];
                   $txtcourse = $_POST['txtcourse'];
                   $yr = $_POST['yr'];
                   $txtsection = $_POST['txtsection'];


                       $sql = " UPDATE `student` SET `name`='$fname',`surname`='$sname',`middle_name`='$mname',`course`='$txtcourse',`year`='$yr',`section`='$txtsection', `toupdate`=0 ,`isverified` = 0 WHERE s_id = '$sid'  ";
                                   $result = mysqli_query($con,$sql); // run query
                                   unset($_SESSION['toupdatetriggercheckvalidity']);
                                   
    
  }

 ?>