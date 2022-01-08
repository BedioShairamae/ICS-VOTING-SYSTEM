<?php 
session_start();
if(!isset($_SESSION['admin_id_token'])) {
  header("location:index.php");
}
include 'include/header.php';
include 'connection/fetch_data.php';


?>
	<body style="background-color: rgb(228, 228, 228);">
		<div class="page-wrapper chiller-theme toggled">
 	  <!--<link rel="stylesheet" type="text/css" href="include/datatable/datatable.css"/>
    <script type="text/javascript" src="include/datatable/datatable.js"></script>-->

     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.js"></script>
 	<?php include 'include/sidebar.php'?>
 	<?php include 'accountmodal.php'?>
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;" id="txttitle">POSITION</h2>
      <hr>
     <div class="row">
       <style type="text/css">
        .pf {
          position: fixed;
          z-index: 1;
          right: 10px;
          width: 200px;
        }
      </style>
       <div class="pf mt-4" id="timee">
 
  <div class="position-absolute bottom-0 end-0">
    <div class="alert alert-dark" role="alert">
   <span style="font-weight: bolder;font-size: 16px"> <div class="clock"  ><div class="displayoutside"></div></div> </span> 
       <span style=""><?php echo  date('F j,  Y ',strtotime(date('Y-m-d H:i:s'))); ?></span>

</div>
  </div>
</div>
       
     
 
        <script>
      setInterval(function(){
        const clock = document.querySelector(".displayoutside");
        let time = new Date();
        let sec = time.getSeconds();
        let min = time.getMinutes();
        let hr = time.getHours();
        let day = 'AM';
        if(hr > 12){
          day = 'PM';
          hr = hr - 12;
        }
        if(hr == 0){
          hr = 12;
        }
        if(sec < 10){
          sec = '0' + sec;
        }
        if(min < 10){
          min = '0' + min;
        }
        if(hr < 10){
          hr = '0' + hr;
        }
        clock.textContent = hr + ':' + min + ':' + sec + " " + day;
      });
    </script>

       
        <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" id="manageposition" href="javascript:void(0)">Position</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="managepartylist" href="javascript:void(0)">Partylist</a>
  </li>
  
</ul>

     <div class="card" style=" box-shadow:  0 1rem 4rem 0 #00000040;">
          <p></p>
           <div class="container">
          <div class="add-new" >
            <button data-toggle="modal" data-target="#addposition" id="addnew" >Add new <i class="fas fa-plus"> </i></button>
           
          </div>
          </div>
          <hr>

          <?php
          if(isset($_SESSION['action'])) {
            echo  $_SESSION['action'];
            unset($_SESSION['action']);
          }

          ?>
           <div class="partylistcontent">

       
           
      <table class="table table-striped" id="table_id">
  <thead class="thead-dark">
    

    <tr>
      <th scope="col">Position-Name</th>
       <th scope="col">Maximum Numbers of Winners</th>
        <th scope="col">Number of candidate to vote</th>
      <th scope="col">Maximum-Candidates allowed</th>
    
      <th scope="col">No# of Candidates in current position</th>
      <th scope="col">Date-Modified</th>
     
       <th scope="col" >Action</th>
    </tr>
 


  </thead>
  <tbody>
    <?php
     
      $fetch = new Fetch_data();
      $fetch -> select_position();
       

    ?>
  </tbody>
</table>
</div> 

          <p></p>
         </div> 
       </div>
      <hr>
      <footer class="text-center">
        <div class="mb-2">
          <small>
            ©Copyrights &middot; 2021 
          </small>
        </div>
      
      </footer>
    </div>
  </main>
  <!-- page-content" -->

<script type="text/javascript">
  
  $(document).ready(function() {
          $('.btninvalid').click(function() { 
          alert('Unable to Delete Position w/Candidates Data attached! ');
          })
          $('#managepartylist').click(function() { 
            $('#txttitle').text('PARTYLIST');
            $(this).addClass('active');
            $('#addnew').attr('data-target','#editpartylist');
            $('#manageposition').removeClass('active');

$('.partylistcontent').html('Fetching DATA <i class="fas fa-spinner fa-pulse"></i>');
          
               var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
                // Your condition here if data success.
            $('.partylistcontent').html(data);
             
                           }
                        };
                xhttp.open("POST", "action.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("partylistcontent=1");
                    
                             
          })
         
           $('#manageposition').click(function() { 
            $('.partylistcontent').html('Fetching DATA <i class="fas fa-spinner fa-pulse"></i>');
             $('#txttitle').text('POSITION');
              $(this).addClass('active');
              $('#addnew').attr('data-target','#addposition');
            $('#managepartylist').removeClass('active');
               var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
                // Your condition here if data success.
            $('.partylistcontent').html(data);

                           }
                        };
                xhttp.open("POST", "action.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("positioncontent=1");
                    
                             
          })
          
        });      
        
</script>

</div>
	
<?php include 'include/modal/position_modal.php'?>

<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>