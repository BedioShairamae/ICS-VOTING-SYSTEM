<?php 
session_start();
if(!isset($_SESSION['voter_login'])) {
  header("location:index.php");
}
include 'admin/connection/connect.php';
$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                              
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];
               $checken = $active['voterlogin'];
                $eventstart = $active['eventstart'];
          $eventend = $active['eventend'];  
          $elecyear = $active['year'];
          $elecsem = $active['semester'];
               }
               if($electid != $_SESSION['election_id']) {
                header("location:change_sched_detect.php");
               }

               if($checken == 'disabled') {
                header("location:unable_login.php");
               }else {
                      date_default_timezone_set('Asia/Manila');
         $dateandtime = date("Y-m-d H:i:s");


              
                 if( $eventstart == '0000-00-00 00:00:00' || $eventend == '0000-00-00 00:00:00' || $eventstart == '' || $eventend == '' ) { 
            
         } else if($eventstart <= $dateandtime && $eventend <= $dateandtime )  { 

             header("location:election_end.php");
         }
          
               }
include 'include/header.html'; 
include 'class.php';
$fetch = new Fetch_data();
?>
			<body style="background-color: rgb(217, 217, 217);">
				<header class="headerbackground">
 			 
 			 		<span id="sidenav-toggle"  onclick="openNav()"><i class="fas fa-bars"></i></span>
 			
 			 
					 <div class="container title">

					 	<h3>ICS Election <?php echo $elecyear ?> <br><span>Semester <?php echo $elecsem ?></span></h3>
					 </div> 
					
						
				</header>
				
				 
				<nav class="navbar navbar-expand-lg  custom">
	<div class="container">
  <a class="navbar-brand" href="#"><i style="padding-right: 10px" class="far fa-question-circle"></i> About Us</a>
 
  </div>
  
				</nav>

<div id="mySidenav" class="sidenav">
	<?php include 'include/sidebar.php'?>
	<button onclick="window.location.href='logout.php'" class="logout"><i class="fas fa-power-off"></i> Logout</button>
</div>
            


				<div class="container" style="margin-top: 40px;">
				                                  
                  	<div class="card" style="box-shadow:  0 2rem 5rem 0 #00000040;">
                  	  <div class="card-header">
                  	    Product Overview
                  	  </div>
                  	  <div class="card-body">
                  	    <blockquote class="blockquote mb-0 aboutusdet">
                  	      <p>The Institute of Computer Studies is an institute located at Western Mindanao State University offering courses such as Bachelor of Science in Information Technology, Bachelor of Science in Computer Studies, Bachelor of Science in Information System and Masters in Information System. 
                  	      	<br>
	The ISC election is held each year and follows the traditional election where the voter has to go to a precinct and wait for the line to enter, take the election and cast his/her vote which can be time consuming. Manual tally of votes is also a problem since it takes a lot of time and sometimes inaccurate. In some cases, some might even vote twice. <br>
	With the use of the election system, the vote’s integrity will be maintained and provide an accurate analytics and data integrity since it will eliminate human errors. This voting solution can eliminate certain common avenues of fraud, speed up the processing of results, increase accessibility and make voting more convenient for the students. This system contains a voter’s panel where he/she can select the candidates and the positions to vote and also an admin panel where the list of voters and vote results can be found. We can also edit, add and delete voters in this section.

                  	      </p>
                  	      <footer class="blockquote-footer">SE <cite title="Source Title">documentation</cite></footer>
                  	    </blockquote>
                  	  </div>
                  	</div>

                  	<p><br></p>
                  	<hr>

                  	<br>
                  	<div class="card" style="box-shadow:  0 2rem 5rem 0 #00000040;">
                  	  <div class="card-header">
                  	    Project Site
                  	  </div>
                  	  <div class="card-body">
                  	    <blockquote class="blockquote mb-0 aboutusdet">
                  	      <p>The ICS is the Institute in Western Mindanao State University. <br> It started on a laddered program in the year 1994, offering: 2 years Associate Computer Technology,<br> 3 years diploma in Computer Technology, 4 years Bachelor of Computer Science, 5 years Bachelor of Computer Engineering under the College of Engineering and Technology. In the year 2000, the laddered program was removed. The Computer Engineer and Computer Science was separated, <br> At the same time Computer Science has a major, Information Technology and Software Technology. It was revised in the year 2006 but nothing was change, 2016 last year the curriculum was change and the major was removed, <br> BSCS and BSIT at the same time the ICS become an Institute and it was headed by MIT Roderick P. Go. The ICS is now located beside the WMSU court. <br> <br>
	The goal of the client’s project is to provide an election system for the benefit of the students under the institute and adapt to new technology and since it is an institute in the field of computer science and technology, it is only right to implement such systems. <br>
	The main transaction of the client’s business in relation to the project is to make an online voting system. <br>The online voting systems are software platforms used to securely conduct votes and elections. <br> As a digital platform, they eliminate the need to cast your votes using paper or having to gather it personally. It also protects the integrity of your vote by preventing voters from being able to vote multiple times. <br> It means that the client do not want to have gathering, and wants an online voting system to avoid the virus that is currently spreading. 


                  	      </p>
                  	      <footer class="blockquote-footer">SE <cite title="Source Title">documentation</cite></footer>
                  	    </blockquote>
                  	  </div>
                  	</div>
<p><br></p>
<hr>
<br>

				 </div> 
				

		 	

	 	
		 	





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
