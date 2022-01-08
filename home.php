<?php 
session_start();
if(!isset($_SESSION['voter_login'])) {
	header("location:index.php");
}else if (isset($_SESSION['toupdatetriggercheckvalidity'])){
  header("location:checkpoint.php");
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

					 	<h3><?php echo  $_SESSION['election_title'] ?> <?php echo $elecyear.'-'.date($elecyear+1) ?> <br><span>Semester <?php echo $elecsem ?></span></h3>
					 </div> 
					
						
				</header>

				 
				<nav class="navbar navbar-expand-lg  custom" >
                     <div class="container">
                        <a class="navbar-brand" href="home.php" style="z-index: 1"><i style="padding-right: 10px"  class="fas fa-users"></i>All Candidates</a>
                         <?php include 'include/positionstand.php'?>
                     </div> 
                     
		
				</nav>
  <script src="notify.js"></script>
<div id="mySidenav" class="sidenav">
	<?php include 'include/sidebar.php'?>
	<button onclick="window.location.href='logout.php'" class="logout"><i class="fas fa-power-off"></i> Logout</button>
</div>

				<div class="container">
				
					
                    <?php
                    if(isset($_SESSION['action'])){
                        echo $_SESSION['action'];
                        unset($_SESSION['action']);
                    }
                    $vid = $_SESSION['voter_login'];
                    			$sql = " select * from student where s_id = '$vid' and voted='1'  ";
                    	                $result = mysqli_query($con,$sql); // run query
                    	                $count= mysqli_num_rows($result); // to count if necessary
                    	              
                    	             if ($count==1){
                    	             	$fetch ->alreadyvoted();
                    	          }else {
                    	          		 if(isset($_GET['sortby'])) {
                    $sort = $_GET['sortby'];
                    $posid = $_GET['id'];
                    ?>
                        	 <div id="candidate_content">
                        	 	<?php
                             $fetch-> get_candidatesby($posid);
                             ?>
                         </div>
                             <?php
                        }else {
                        	?>
                        	 <div id="candidate_content">
                        	 	
                        	 	<?php 
                        	 	 $fetch-> get_candidates(); 
                        	 	 ?>

                        	 </div> 
                        	 
                        	<?php
                           
                        }
                    	          }
                    
                    

                    ?>

				 </div>
				 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">

				 <style type="text/css">
				 	h2{
  color: #396;
  font-weight: 100;
  font-size: 20px;
 font-family: 'Alfa Slab One', cursive;
}

#clockdiv{
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 30px;
}

#clockdiv > div{
  padding: 14px;
  border-radius: 3px;
  background: #076b20;
  display: inline-block;
}

#clockdiv div > span{
  padding: 5px;
  border-radius: 3px;
  background: #414642;
  display: inline-block;
}

.smalltext{
  padding-top: 5px;
  font-size: 14px;
}
#timerontop:hover  {
	opacity: 60%;
}

.circle{
    position:relative;
   
    width:80px;
    height:80px;
    background:#ecf0f1;
    border:solid 5px #2c3e50;
    border-radius:100%;
    overflow:hidden;
    animation: rotates 2s infinite linear;
    -webkit-animation: rotates 2s infinite linear;
}
.up{
    width: 30px;
    height: 40px;
    left:20px;
    overflow:hidden;
    background:#cef;
    position:absolute;
}
.up:before,.up:after{
    content:"";
    width:30px;height:30px;
    background:#ecf0f1;
    position:absolute;
    z-index:1;
}
.up:before{
    top:30px;
    left:-17px;
    transform:rotate(45deg);
    -webkit-transform:rotate(45deg);
}
.up:after{
    top:30px; left:17px;
    transform:rotate(45deg);
    -webkit-transform:rotate(45deg);
}
.innera{
    position:relative;
    top:15px;
    width:30px;height:30px;
    background:#13e6a9;
    animation: mymove 2s infinite linear;
    -webkit-animation: mymove 2s infinite linear;
}
.down{
    width: 30px;
    height: 40px;
    left:20px;
    top:40px;
    overflow:hidden;
    background:#cef;
    position:absolute;
    z-index:1;
}
.down:before,.down:after{
    content:"";
    width:30px;
    height:40px;
    background:#ecf0f1;
    position:absolute;
    z-index:1;
}
.down:before{
    top:-25px;
    left:-17px;
    transform:rotate(45deg);
    -webkit-transform:rotate(45deg);
}
.down:after{
    top:-25px;
    left:24px;
    transform:rotate(45deg);
    -webkit-transform:rotate(45deg);
}
.innerb{
    position:relative;
    top:40px;
    width:30px;height:30px; background:#13e6a9;
    animation: mymoveb 2s infinite linear;
    -webkit-animation: mymoveb 2s infinite linear;
}
@keyframes mymove{
    0%{top:15px;}
    100%{top:45px;}
}
@keyframes mymoveb{
    0%{top:40px;}
    90%{top:20px;}
    100%{top:-5px;}
}
@keyframes rotates{
    0%{transform:rotate(0deg);}
    80%{transform:rotate(0deg);}
    100%{transform:rotate(180deg);}
}
@-webkit-keyframes mymove{
    0%{top:15px;}
    100%{top:45px;}
}
@-webkit-keyframes mymoveb{
    0%{top:40px;}
    90%{top:20px;}
    100%{top:-5px;}
}
@-webkit-keyframes rotates{
    0%{-webkit-transform:rotate(0deg);}
    80%{-webkit-transform:rotate(0deg);}
    100%{-webkit-transform:rotate(180deg);}
}			 </style> 
				
<div class="fixed-top" id="timerontop" style="z-index: 0;">
	<div class="alert alert-secondary mt-4 mr-5 shadow " id="countdownclick"   role="alert" style="position:absolute; right: 0; margin-right: 15px;">
<h2><?php echo  $_SESSION['election_title'] ?>  <br> <span id="textend" style="text-align: center;">Will End at :</span></h2>
<div id="clockdiv">
  <div>
    <span class="days"></span>
    <div class="smalltext">Days</div>
  </div>
  <div>
    <span class="hours"></span>
    <div class="smalltext">Hours</div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext">Minutes</div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext">Seconds</div>
  </div>
</div>
</div>
	
	<div class="alert  mt-4 mr-5   d-none" id="countdownclickshow"   role="alert" style="position:absolute; right: 0;text-align: center; cursor: pointer ">
		
			<div class="circle">
    <div class="up">
        <div class="innera"></div>
    </div>
    <div class="down">
        <div class="innerb"></div>
    </div>
</div>
		<span class="bg-success" style="padding: 2px;color: white">TIME</span>

	</div>
	

</div>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
  if(isset($_SESSION['greetvotername'])){
  
    ?>
    <script type="text/javascript">
  
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Good Day , <?php echo $_SESSION['abbr'].$_SESSION['greetvotername'] ?>!',
  text: "Welcome to Election Year <?php echo $_SESSION['electionyear'].' - '.date($_SESSION['electionyear']+1) ?>",

  footer: "We thank you for your participation!",
  showConfirmButton: false,
  timer: 15000
})
            
    </script>
    <?php
    unset($_SESSION['greetvotername']);
  }
 ?>
		 	
	 

	<script>

	
		
		realtimeend();
function realtimeend(){
		 $.ajax({
           url : "gettime.php",
            method: "POST",
             data  : {getstart:1},
             success : function(data){

             	if(data == 'notset'){
       $('.days').text('-');
    $('.hours').text('-');
    $('.minutes').text('-');
    $('.seconds').text('-');
             	}else {
             		$('#textend').text('Will End at :');

             var countDownDate = new Date(data).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    

  	 $('.days').text(days);
    $('.hours').text(hours);
    $('.minutes').text(minutes);
    $('.seconds').text(seconds);
   
   
   
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
  window.location.href="election_end.php";
  }
}, 1000);
             	}


	
             }
          })
}      
	      	

setInterval(function(){
	  
	
	   $.ajax({
	           url : "gettime.php",
	            method: "POST",
	             data  : {checkchange:1},
	             success : function(data){
					if(data == 'changed'){
						Swal.fire({
			  title: '',
			  text: "Schedule Has Changed!",
			  icon: 'info',
			
			}).then((result) => {
			  if (result.isConfirmed) {
			   	location.reload();
			  }
			})
					}else if(data == 'Notset'){
				$('#textend').text('Schedule Not Yet Set..')
					}else if (data == 'End'){
						window.location.href="election_end.php";
					}else if(data == 'changedtitle'){
              Swal.fire({
        title: 'The Election Title Has Changed!',
        text: "",
        icon: 'info',
      
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      })
          }



	             }
	          })
	     
	    
},5000);


 
   
   $('#countdownclick').click(function() { 
  
  	$(this).addClass('d-none');
  	$('#countdownclickshow').removeClass('d-none');

   
   })
   $('#countdownclickshow').click(function() { 
   	$(this).addClass('d-none');
  	$('#countdownclick').removeClass('d-none');

   
   })
 


</script>
		 	
     
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header" >
                <h6 style="">Vote Summary</h6>
            </div>
            <div class="modal-body">
             
              <div id="candidate_contentss"></div> 
              
      
      
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light border border-dark" style="font-size:12px" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-light border border-primary finalsubmit" style="font-size:12px">SUBMIT</button>
            </div>
          </div>
        </div>
      </div>


		 
<!--Modal-->
		  <?php include 'modal/sweetiepie.php'?>
<!---->		

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


			</body>

		<script type="text/javascript">

			  	$('.btnvote1').click(function() { 

			  		var id = $(this).data("cid");
					var fullname = $(this).data("fullname");
					
					   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {castvote:1,cid:id,fullname:fullname},
					             success : function(data){
						getcancontent();
					             }
					          })
					   
					    
			  		
			  	})

			  	$('.btncancelvote1').click(function() { 
			  			var id = $(this).data("cid");
			  			   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {cancelvote:1,cid:id},
					             success : function(data){
					//	getcancontent();
          location.reload();
					             }
					          })
			  	
			  	})

			  		$('.voteid').click(function() { 
			  		var id = $(this).data("cid");
					var fullname = $(this).data("fullname");
					
					   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {castvote:1,cid:id,fullname:fullname},
					             success : function(data){
						location.reload();
					             }
					          })
					   
					    
			  		
			  	})
			  	  	$('.cancelvoteid').click(function() { 
			  			var id = $(this).data("cid");
			  			   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {cancelvote:1,cid:id},
					             success : function(data){
						location.reload();
					             }
					          })
			  	
			  	})
			  	  	realtimemonitor();

			  	  function realtimemonitor(){
			  	  	setInterval(function(){
			  	  		getcancontent();
			  	  	},20000);
			  	  }
				


			 function getcancontent(){
			 	 $.ajax({
			           url : "content.php",
			            method: "POST",
			             data  : {candidate:1},
			             success : function(data){
								$('#candidate_content').html(data);
								
			             }
			          })
			 }
       summary();

        function summary(){
         $.ajax({
                 url : "content.php",
                  method: "POST",
                   data  : {summary:1},
                   success : function(data){
                $('#candidate_contentss').html(data);
                
                   }
                })
       }
			
			$('.yessubmit').click(function() { 
		
				
				 
				 
			})
			  
		
			$('.submitvote').click(function() { 
  summary();

        /*
			
        */

       
			})

      $('.finalsubmit').click(function() { 
          Swal.fire({
          titleText: 'Are you sure?  ',
          text: "You want to submit your vote? Once submitted, you will not be able to edit or modify it.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#36b9cc',
          cancelButtonColor: '#f6c23e',
          confirmButtonText: 'Yes, Submit it!'
        }).then((result) => {
          if (result.isConfirmed) {
             $.ajax({
                   url : "submit.php",
                    method: "POST",
                     data  : {submitvote:1},
                     success : function(data){
                window.location.href="vote.php";
                     }
                  })
          }
        })
      
      })
	

		
			
			   
			    
		
				function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}      
			      	
			</script>	

  
<?php include 'include/footer.html'?>
