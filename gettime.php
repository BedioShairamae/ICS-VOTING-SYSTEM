<?php 
session_start();
include 'admin/connection/connect.php';
$eventenddown =$_SESSION['eventenddown'];
	
	if(isset($_POST['getstart'])){ 

		  if($eventenddown== NULL || $eventenddown == '0000-00-00 00:00:00'){
               	echo 'notset';
               }else {
               	echo date('M',strtotime($eventenddown)).' '.date('j',strtotime($eventenddown)).','.date('Y',strtotime($eventenddown)).' '.date('H',strtotime($eventenddown)).':'.date('i',strtotime($eventenddown)).':'.date('s',strtotime($eventenddown));
               }
	

             

          
		
	}

if(isset($_POST['checkchange'])){ 
   $def = $_SESSION['election_title'];
		$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                 							
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];
               $checken = $active['voterlogin'];
               	$eventstart = $active['eventstart'];
				  $eventend = $active['eventend'];	
				  $elecyear = $active['year'];
				  $elecsem = $active['semester'];
              $electtitle = $active['title'];
               }
               date_default_timezone_set('Asia/Manila');
               $datenow = date('Y-m-d H:i:s');

               if ($eventenddown != $eventend){
               	echo 'changed';

               	$_SESSION['eventenddown'] = $eventend;
                     $_SESSION['election_title'] = $electtitle;
               }else if($eventend == NULL || $eventend == '0000-00-00 00:00:00' ){
               	echo 'Notset';
               	 	
               }else if($datenow > $eventend){
               	echo 'End';
               		
               }else if($def != $electtitle) {
                  echo 'changedtitle';
                  $_SESSION['eventenddown'] = $eventend;
                     $_SESSION['election_title'] = $electtitle;
               }
	
}
	

	
 ?>