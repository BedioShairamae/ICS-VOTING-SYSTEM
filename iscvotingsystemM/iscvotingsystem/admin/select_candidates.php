<?php 
session_start();
include 'include/header.php';
include 'connection/connect.php';
include 'connection/fetch_data.php';
$fetch  = new Fetch_data();

?>
	<body style="background-color: rgb(228, 228, 228);">
		<link rel="stylesheet" type="text/css" href="include/datatable/datatable.css"/>
		<script type="text/javascript" src="include/datatable/datatable.js"></script>
		<div class="page-wrapper chiller-theme toggled">
 	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 	<?php include 'include/sidebar.php'?>


  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">SELECT VOTERS</h2>
      <hr> 	
       <div class="row">
          
       	<?php 
        if(isset($_GET['sortby'])) {
          $sort = $_GET['sortby'];
          $posid = $_GET['id'];

                   $sql = " select * from position where pos_id = '$posid'  ";
                                  $result = mysqli_query($con,$sql); 
                                 
                              
                                   while($row = mysqli_fetch_array($result)){
                                      $limit= $row['pos_maxcandidate'];
                                   }
                                      
                                      $checkforentries = " select * from candidate where pos_id = '$posid'  ";
                                      $resultcheck = mysqli_query($con,$checkforentries); 
                                      $entry= mysqli_num_rows($resultcheck); 
                                    
                            

          
            
          if($entry >= $limit) {
            ?>
             <div class="position-relative mt-4" id="timee">
 
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
                   <div class="card" style=" box-shadow:  0 1rem 4rem 0 #00000040;">
          <p></p>
           <div class="container">
          <h5>For the Position Of <?php echo $sort?></h5>
          </div>

          <hr>
         


          <p>
 <!-- <a class="btn btn-secondary" style="font-size: 14px;float: right;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
 <i class="fas fa-info-circle"></i> Information
  </a>
 
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <h6 style="cursor: default;">In selecting CANDIDATE.We required photo . If action column displays <span style="color: blue">Update</span>. then it is needed to update  the accounts Photo . </h6>
  </div>
</div>-->
<br>
      <table class="table table-striped" id="table_id">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Voters-iD</th>
      <th scope="col">Last Name</th>
      <th scope="col">Given Name</th>
      <th scope="col">Middle Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Course&year</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
  $fetch -> select_candidatenotvalid();
?>   
  </tbody>
</table>





          <p></p>
         </div> 
 
  <input type="hidden" name="" id="poss" style="text-transform: uppercase;" value="<?php echo $sort?>">
 <script type="text/javascript">
  var pos = $('#poss').val();
   Swal.fire(
  'Unable to add candidate for the position of '+pos,
  'Maximum candidate limit has been reached!',
  'error'
).then((result) => {
  if (result.isConfirmed) {
    window.location.href="candidates.php";
  }
})
 </script>
            <?php
          }else {


          ?>

            <div class="position-relative mt-4" id="timee">
 
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
          <div class="card" style=" box-shadow:  0 1rem 4rem 0 #00000040;">
          <p></p>
           <div class="container">
          <h5>For the Position Of <?php echo $sort?></h5>
          </div>

          <hr>
        
          <p>
  <a class="btn btn-secondary" style="font-size: 12px;float: right;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
 <i class="fas fa-info-circle"></i> LEGEND
  </a>
 
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
   <p></p>
                <h6>Legend : </h6>
                <br>
                <span class="text-danger" style="font-size: 13px"><i class="fas fa-ban"></i> Unqualified</span> = Voters that is not yet verified, By their respective advisers or admin.
                <br><br>
                <span style="font-size: 12px;width: 70px" class="btn btn-success">Select</span> = A fully verified voter.
                <p></p>
  </div>
</div>
<br>
      <table class="table table-striped" id="table_id">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Voters-iD</th>
      <th scope="col">Last Name</th>
      <th scope="col">Given Name</th>
      <th scope="col">Middle Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Course&year</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
  $fetch -> select_candidate();
?>   
  </tbody>
</table>





          <p></p>
         </div> 
          <a href="candidates.php" class="btn btn-secondary" style="font-size: 12px;"><i class="fas fa-arrow-left"></i> Cancel</a><p></p>

          <?php
           }
        }
        ?>
       	 


       </div>
    
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



</div>

<!-- Button trigger modal -->

<!--Delete Modal-->
<div id="deletemodal" class="d-none">

              <!-- Modal content -->
              <div id="contents" class="delmodal-contents">
              	 <div class="container popup">
              	 	
       		<h4 style="color: white;font-weight: bolder;">Are you sure you want to remove this student ?</h4>  
       		 <form method="post" action="#">
       		    	                  
       		
       		

		 <button type="submit" class="btn btn-danger">Yes</button><button type="button" class="btn btn-warning" id="closedel" >No</button>
              <input type="hidden" id="candidate-id" name="">
               </form>
              	 </div> 
              	 
            
              </div>

</div>

<!---->

<!--Add Modal -->
<div class="modal fade" id="addadvocacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h6 style="font-weight: bolder;">Set Advocacy</h6>
      </div>
       <form method="post" action="action.php">
      <div class="modal-body">
           <div class="container">
             <h6>Select PARTY-LIST :</h6>  

                
              <select class="form-select " name="partylist" >
              <option value="1" style="text-align: center;" >Independent</option>
                  <?php 
                  $elecid =$_SESSION['electsched'];
                 
                         
                                    $sql = " SELECT * FROM `partylist` WHERE election_id = '$elecid'   ";
                                                $result = mysqli_query($con,$sql); // run query
                                                $count= mysqli_num_rows($result); // to count if necessary
                                            
                                             if ($count>=1){
                                               
                                                 while($row = mysqli_fetch_array($result)){
                                                  ?>
                                      <option style="text-align: center;" value="<?php echo $row['party_id'] ?>"><?php echo $row['partylist'] ?></option>
                                    <?php
                                                 }
                                          }else{
                                  ?>
                                  
                                  <?php
                                }

                   ?>
              </select>
               <br>
            <h6>Visions,Missions,Advocacy Etc:</h6>
            <span>Type Here...</span>
              <textarea cols="5"  class="form-control" name="advocacy" id="textarea" style="height: 300px;font-size:14px" onclick="this.select();">

              </textarea> 

              <br>
             
             
            
              <input type="hidden" name="posid" value="<?php echo $posid;?>">
            <input type="hidden" name="svid" id="idval">
           
           </div> 
           
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" name="savecan" style="font-size: 13px;">Save Candidate</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 13px;">Cancel</button>
      </div>
        </form>
    </div>
  </div>
</div>


	
<script>
         $(document).ready(function() {
  //# for id , . for classes
      $('#table_id').DataTable();
     

     $('.btndel').click(function() { 
		var id = $(this).data("cid");
		
		$('#candidate-id').val(id);
		$('#deletemodal').removeClass('close');
		$('#deletemodal').removeClass('d-none');
		$('#deletemodal').addClass('open');

	})




	$('#closedel').click(function() { 
		$('#deletemodal').removeClass('open');
		$('#deletemodal').addClass('close');
		
	})

  $('.btnselect').click(function() { 
    var svid = $(this).data("uid");
    $('#idval').val(svid);
   
  })

         }); 
           
   </script>
<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>