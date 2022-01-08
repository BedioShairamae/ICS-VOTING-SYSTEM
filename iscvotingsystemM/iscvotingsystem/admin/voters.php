<?php 
session_start();
if(!isset($_SESSION['admin_id_token'])) {
  header("location:index.php");
}
include 'include/header.php';

include 'connection/fetch_data.php';
?>
	<body style="background-color: rgb(228, 228, 228);">
		<!--<link rel="stylesheet" type="text/css" href="include/datatable/datatable.css"/>
		<script type="text/javascript" src="include/datatable/datatable.js"></script>-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.js"></script>
		<div class="page-wrapper chiller-theme toggled">
 	
 	<?php include 'include/sidebar.php'?>
 	<?php include 'accountmodal.php'?>

  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;"> <span id="displaytxt">VOTERS</span></h2>
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
           <div class="pf mt-2" id="timee">
 
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
    <a class="nav-link active" id="managevoter" href="javascript:void(0)">Voters</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="manageadviser" href="javascript:void(0)">Advisers</a>
  </li>
  
</ul>
       	 <div class="card" style=" box-shadow:  0 1rem 4rem 0 #00000040;">
       	 	<p></p>
       	 	 <div class="container" >
       	 	<div class="add-new" >
       	 		<!--<button onclick="window.location.href='save.php'" >Add new <i class="fas fa-plus"> </i></button>-->
            <button id="mannage"  onclick="window.location.href='course_year.php'" style="width: auto">Manage SECTION,COURSE and YEAR <i class="fas fa-users-cog"></i></button>

              <button id="addadv" class="d-none" data-toggle="modal" data-target="#addnewadviser" data-backdrop="static" data-keyboard="false"  style="width: 140px">Add new <i class="far fa-plus-square"></i></button>


       	 	</div>
       	 	</div>

       	 	<hr>
           <?php
          if(isset($_SESSION['action'])) {
            echo  $_SESSION['action'];
            unset($_SESSION['action']);
          }

          ?>
           <form method="post" action="advoter.php" onsubmit="return false" id="selectallsubmit">
              <input type="hidden" name="selecttrigger" id="selecttrigger" value="verify">
            
           <div id="tablecontent"> </div> 
           
             </form>

       	 	<p></p>
       	 </div> 
       	 



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



<!-- Modal -->
<div class="modal fade" id="addnewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       	<h6 style="font-size: 14px;"><i class="fas fa-info-circle"></i> <strong>Email must be Legitimate </strong> . Upon saving notify the student that generated passwords are sent through their Email</h6>
      </div>
       <form method="post" action="save.php">
      <div class="modal-body">

        		
        		    <label>Enter Organization Email :
						 	 					</label>
						 	 					<span style="color: grey"><i class="fas fa-info-circle"></i> s*****2021@wmsu.edu.ph</span>
						 	 					<input type="email" name="txtmail" class="form-control" autofocus="" required="" style="font-size: 13px;">
						 	 				
						 	 				<br>

						 	 					<label>Enter Given Name :
						 	 					</label>
						 	 					<input type="text" name="txtname" class="form-control" required="" style="font-size: 13px;">
						 	 				
						 	 				<br>
						 	 				<label>Enter Surname :
						 	 					</label>
						 	 					<input type="text" name="txtsurname" class="form-control" required="" style="font-size: 13px;">
						 	 					<br>
						 	 				<label>Enter Middle Name :
						 	 					</label>
						 	 					<input type="text" name="txtinit" class="form-control" required="" style="font-size: 13px;">
						 	 				
						 	 				<br>
						 	 				<div class="row">
						 	 					<div class="col">
						 	 						<label>Gender :</label><select class="form-select" name="gender" required="" style="font-size: 13px;">
						 	 						<option value="male">Male</option>
						 	 						<option value="female">Female</option>
						 	 						
						 	 					</select>
						 	 					
						 	 					</div>
						 	 					<div class="col">
						 	 						<label>Year:</label> <select class="form-select" name="yr" required="" style="font-size: 13px;">
						 	 						<option value="1">1st year</option>
						 	 						<option value="2">2nd year</option>
						 	 						<option value="3">3rd year</option>
						 	 						<option value="4">4th year</option>
						 	 					</select>
						 	 					
						 	 					</div>
						 	 				</div>                  
        	
        		



      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary" style="font-size: 12px;">Save</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 12px;">Cancel</button>
      </div>
      	 </form>
    </div>
  </div>
</div>

<!--Delete Modal-->
<div id="deletemodal" class="d-none">

              <!-- Modal content -->
              <div id="contents" class="delmodal-contents">
              	 <div class="container popup">
              	 	
       		<h4 style="color: white;font-weight: bolder;">Are you sure you want to remove this student ?</h4>  
       		 <form method="post" action="action.php">
       		    	                  
       		
       		

		 <button type="submit" class="btn btn-danger" name="deletestudent">Yes</button><button type="button" class="btn btn-warning" id="closedel" >No</button>
              <input type="hidden" id="candidate-id" name="svid">
               </form>
              	 </div> 
              	 
            
              </div>

</div>

<!---->



<!-- Modal -->
<div class="modal fade" id="addnewadviser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="form">
      <div class="modal-header">
          <h6>Add new Adviser</h6>
      </div>
      

       <form method="post" enctype="multipart/form-data" id="savenewadviser" action="advoter.php" >
     
      <div class="modal-body">
          <div class="container">
          <div class="row">
            <div class="col-sm-6">
            
                 <input type="hidden" name="triggersaveadv">
              <label class="mt-4">Enter Organizational Email <span style="color: red">*</span> :</label>
              <input type="email" style="font-size: 13px" name="emailval" id="emailval" class="form-control t" required="">

              <label class="mt-2">Scope Year <span style="color: red">*</span></label>
              <select style="font-size: 13px" class="form-select" id="sectionval" name="sectionval">
                  <?php 
                    $sql = " select * from year ";
                            $result = mysqli_query($con,$sql);
                         
                         
                             while($row = mysqli_fetch_array($result)){
                      ?>
                       <option value="<?php echo $row['yearid'] ?>"><?php echo $row['year'] ?></option>
                      <?php
                             }
                   ?>
              </select>

              <label class="mt-2">Scope Course <span style="color: red">*</span></label>
              <select style="font-size: 13px" class="form-select" id="courseval" name="courseval">
                  <?php 
                    $sql = " select * from course ";
                            $result = mysqli_query($con,$sql);
                         
                         
                             while($row = mysqli_fetch_array($result)){
                      ?>
                       <option value="<?php echo $row['courseid'] ?>"><?php echo $row['course'] ?></option>
                      <?php
                             }
                   ?>
              </select>



            </div>
             <div class="col-sm-6">
               <h5>Personal Data</h5>
               <hr>
                <div class="row">
                   <div class="col-md-4">
                       <label >Last Name <span style="color: red">*</span></label>
                       <input style="font-size: 13px" type="text" id="lastnameval" name="lastnameval" class="form-control t" required="">

                   </div> 
                   <div class="col-md-4">
                          <label >Given Name <span style="color: red">*</span></label>
                       <input style="font-size: 13px" type="text" name="givennameval" class="form-control t" required="">
                   </div> 
                   <div class="col-md-4">
                      <label >Middle Name</label>
                       <input style="font-size: 13px" type="text" name="middlenameval" class="form-control t">
                     
                   </div> 
                   
                </div> 

                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <img src="../upload/undraw_profile_pic_ic5t.png" class="img-thumbnail" style="width: 100%;height: 200px" id="configimage">
                  </div>
                   <div class="col-md-6">
                    <i class="fas fa-info-circle"></i> This section is optional
                      <h6 class="mt-5">Upload a photo</h6>
                      <input type="file" style="font-size: 13px" name="imagename[]" class="form-control t" id="imagedd">
                   </div>

                </div>

                
                
             
             </div>
          </div>
          </div>  

      </div>
      <div class="modal-footer">
        <button type="button" style="font-size: 12px" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" style="font-size: 12px" class="btn btn-primary">Save changes</button>
      </div>
         </form>  
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modifyadviser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="forms">
      <div class="modal-header">
        Modify Adviser Data
      </div>
     <form method="post" enctype="multipart/form-data" id="savenewadviser1" action="advoter.php" >
     
      <div class="modal-body">
          <div class="container">
          <div class="row">
            <div class="col-sm-6">
             

                 <input type="hidden" name="triggersaveadv1" id="triggersaveadv1" value="noimage">
              <label class="mt-4">Organization Email :</label>
              <input type="email" style="font-size: 13px" name="emailval1" id="emailval1" class="form-control t">

              <label class="mt-2">Scope Year </label>
              <select style="font-size: 13px" class="form-select" name="sectionval1" id="sectionval1">
                   <?php 
                    $sql = " select * from year ";
                            $result = mysqli_query($con,$sql);
                         
                         
                             while($row = mysqli_fetch_array($result)){
                      ?>
                       <option value="<?php echo $row['yearid'] ?>"><?php echo $row['year'] ?></option>
                      <?php
                             }
                   ?>
              </select>

              <label class="mt-2">Scope Course </label>
              <select style="font-size: 13px" class="form-select" name="courseval1" id="courseval1">
                  <?php 
                    $sql = " select * from course ";
                            $result = mysqli_query($con,$sql);
                         
                         
                             while($row = mysqli_fetch_array($result)){
                      ?>
                       <option value="<?php echo $row['courseid'] ?>"><?php echo $row['course'] ?></option>
                      <?php
                             }
                   ?>
              </select>



            </div>
             <div class="col-sm-6">
               <h5>Personal Data</h5>
               <hr>
                <div class="row">
                   <div class="col-md-4">
                       <label >Last Name </label>
                       <input style="font-size: 13px" type="text" name="lastnameval1" id="lastnameval1" class="form-control t" required="">

                   </div> 
                   <div class="col-md-4">
                          <label >Given Name </label>
                       <input style="font-size: 13px" type="text" name="givennameval1" id="givennameval1" class="form-control t" required="">
                   </div> 
                   <div class="col-md-4">
                      <label >Middle Name</label>
                       <input style="font-size: 13px" type="text" name="middlenameval1" id="middlenameval1" class="form-control t">
                     
                   </div> 
                   
                </div> 

                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <img src="../undraw_voting_nvu7.png" class="img-thumbnail" style="width: 100%;height: 200px" id="configimages">
                  </div>
                   <div class="col-md-6">
                    <i class="fas fa-info-circle"></i> This section is optional
                      <h6 class="mt-5">
                        <input type="checkbox" name="" id="checkupdateph">
                      Update a photo</h6>
                      <input type="file" style="font-size: 13px" name="imagename1[]" class="form-control t" id="imagedds" disabled="">
                   </div>

                </div>

                <input type="hidden" id="advid" name="advid">
                
             
             </div>
          </div>
          </div>  

      </div>
      <div class="modal-footer">
        <button type="button" style="font-size: 12px" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" style="font-size: 12px" class="btn btn-primary">Save changes</button>
      </div>
         </form>  
    </div>
  </div>
</div>


<?php 
  if(isset($_SESSION['emptydata'])){


    ?>
      <div class="modal fade " id="modalshown" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg " role="document">
                  <div class="modal-content">
                    
                    <div class="modal-body">
                      
                       <ul class="nav nav-tabs" >
                  
                       <?php 
                        $electionid = $_SESSION['electsched'];
                  $fetchanother = "select * from `election_sched` where election_id != '$electionid'";
                  $resultfetchanother  = mysqli_query($con,$fetchanother);
                   while($fetch = mysqli_fetch_array($resultfetchanother)){ 
                    $idleast = $fetch['election_id'];
                    $titles[] = $fetch['title'];
                    $idleasts[] = $fetch['election_id'];
                    
                    ?>
                      <li class="nav-item">
                    
                      <a class="nav-link active fetchview" id="tobeactive<?php echo $idleast ?>"  href="javascript:void(0)" data-electitle="<?php echo $fetch['title'] ?>" data-elecid="<?php echo $idleast ?>"><?php echo $fetch['title'] ?></a>
                      </li>
                    <?php
                         }
                         ?>
                     
                    
                  </ul>


                   <div class="card">
                     <form method="post" action="connection/fetching.php" id="fetchselected" onsubmit="return false">
                          <input type="hidden" name="fetchselectedd">                  
                    
                    
                     <div class="card-body" id="fetchcontent" >
                      
                      <?php 
                      $eid = $idleasts[0];
                       ?>
                  <h6 style="text-align: left;font-style: italic;"><?php echo $titles[0] ?></h6>
                  <button class="btn btn-success mb-2 fetchdata" type="button" style="font-size: 12px;float: right;" data-id="<?php echo $eid ?>">Fetch all voters</button>
                  <br><br>
                 <?php
                      $sqlsi = " select * from student where election_id= '$eid'   ";
                    $resultsi = mysqli_query($con,$sqlsi); // run query
                    $countsi= mysqli_num_rows($resultsi); // to count if necessary
                   //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                 if ($countsi>=1){
                  //while($row = mysqli_fetch_array($result)){} is where we output all the data in database
                 ?>
                 <style type="text/css">
                  
                    .asxax::-webkit-scrollbar {
                          width: 1px;
                        }
                 </style>
                  <div class="asxax" style="height:300px;overflow-y: scroll;">
                  
                 <?php
                     while($row = mysqli_fetch_array($resultsi)){

      ?>
  

  <ul class="list-group" style="text-align: left;">
      <li class="list-group-item"><?php echo $row['email'].'__'.$row['surname'].' '.$row['name'].' '.substr($row['middle_name'],0,1).'.' ?> <input type="checkbox"  style="float: right;" name="fetchselectedstudent[]" class="todesellect" value="<?php echo $row['s_id'] ?>"></li>
                              
                    
    </ul>


    <?php
                     }
                     ?>
                     </div> 
                      <button class="btn btn-secondary mt-2 mb-2" type="submit" name="fetchselected" style="font-size: 12px;float: right;">Fetch selected</button>

                      <button class="btn btn-light deselect mt-2 mb-2" type="button" style="font-size: 12px;float: right;margin-right: 4px">Unselect</button>

                      <script type="text/javascript">
                        
                        $('.deselect').click(function() { 
                               $('.todesellect').prop('checked',false);
                              })    

                                $('#fetchselected').on('submit', function(event){
         event.preventDefault();
          var formData = new FormData(this);
         var atLeastOneIsChecked = $('input[name="fetchselectedstudent[]"]:checked').length > 0;

                           if(atLeastOneIsChecked == false){
                            Swal.fire(
                              'Error Action!',
                              'Please select one or more!',
                              'error'
                            )

                           }else {

               
                 var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                const data = this.responseText;
              
                  Swal.fire(
            'Voters Data!',
            'Was Fetched Successfully!',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
             location.reload();
            }
          })
              
                             }
                          };
                  xhttp.open("POST",$('#fetchselected').attr('action'),true);
                 // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.send(formData);
                      

                           }

                               
         });
             
                              
                      </script>
                     <?php
              }else {

              }
    
                       ?>


                     </div> 
                      </form>
                     
                   </div> 
                   
              
              
                     
                    </div>
                  
                  </div>
                </div>
              </div>


    <script type="text/javascript">
      tofetch(<?php echo $idleasts[0] ?>,<?php echo $titles[0] ?>);
      $('.fetchdata').click(function() { 
        var id = $(this).data('id');
      
  
     var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
      const data = this.responseText;
    
        if(data=='data'){
           Swal.fire(
            'Voters Data!',
            'Was Fetched Successfully!',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
             location.reload();
            }
          })
        }else if(data=='nodata') {
           Swal.fire(
            'No Voters Data Found',
            'This election schedule is empty!',
            'error'
          ).then((result) => {
            if (result.isConfirmed) {
             location.reload();
            }
          })
        }
    
                   }
                };
        xhttp.open("POST", "reset.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("fetch=1&id="+id);
            


      
      })


    
    
      
          $('.fetchview').click(function() { 
      var elecid = $(this).data('elecid');
      var electitle = $(this).data('electitle');

      tofetch(elecid,electitle);
    
    })
    function tofetch(id,electtitle){
      
         var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
        const data = this.responseText;
      
        $('#fetchcontent').html(data);
      
                     }
                  };
          xhttp.open("POST", "../admin/connection/fetching.php",true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("getcontent=1&id="+id+"&title="+electtitle);
              
                       
    }
    $('#modalshown').modal('show');      
            
    </script>
    <?php
  }
   ?>
  

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
<script>
         $(document).ready(function() {
  //# for id , . for classes
      $('#table_id').DataTable();
      voter();


        const inpfile = document.getElementById("imagedd"); //id of input tag type file
                             const regform=document.getElementById ("form"); // div containing the form
                             const previewimage=regform.querySelector("#configimage"); // id of img tag
         
                              inpfile.addEventListener("change",function () {
                                 const file = this.files[0];
         
                                 if(file) {
                                     const reader = new FileReader();
                                     
                                     
                                     reader.addEventListener("load",function() {
                                         previewimage.setAttribute("src",this.result);
                                        
                                     });
                                     reader.readAsDataURL(file);
                                 }
                              });

                 const inpfiles = document.getElementById("imagedds"); //id of input tag type file
                             const regforms=document.getElementById ("forms"); // div containing the form
                             const previewimages=regforms.querySelector("#configimages"); // id of img tag
         
                              inpfiles.addEventListener("change",function () {
                                 const files = this.files[0];
         
                                 if(files) {
                                     const readers = new FileReader();
                                     
                                     
                                     readers.addEventListener("load",function() {
                                         previewimages.setAttribute("src",this.result);
                                        
                                     });
                                     readers.readAsDataURL(files);
                                 }
                              });


         $('#savenewadviser').on('submit', function(event){
                 event.preventDefault();

                   var email = $('#emailval').val();
                var fullname = $('#lastnameval').val();
              
                var section =$('#sectionval').val();
                var course = $('#courseval').val();
                

               var formData = new FormData(this);
            
               var url = $(this).attr('action');
                    
                  var xhttp = new XMLHttpRequest();
                 xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                 const data = this.responseText;
                  $('#addnewadviser').modal('hide');
                  if(data.match('already')){

                    Swal.fire(
                              'Error adding adviser',
                              'Unable to add since the year and section chosen already exist!',
                              'error'
                            )
                  }else {

                       Swal.fire(
                              'New Adviser!',
                              'Has been added And Notify through his/her Email Successfully!',
                              'success'
                            )
                         adviser();
                      
                
             
                         var xhttps = new XMLHttpRequest();
                        xhttps.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                        const data = this.responseText;
                          
                                     }
                                  };
            xhttps.open("POST", "../sendmail/email_advcredentials.php",true);
            xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttps.send("compare=1&email="+email+"&fullname="+fullname+"&password="+fullname+"&section="+section+"&course="+course);

                  }
                     

                
                              
                                             
                      
           
                     

               
                              }
                           };
                   xhttp.open("POST",url,true);
                   xhttp.send(formData);

                             
                                
                               
        });

         $('#savenewadviser1').on('submit', function(event){
                 event.preventDefault();


               var formData = new FormData(this);
            
               var url = $(this).attr('action');
                    
                  var xhttp = new XMLHttpRequest();
                 xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                 const data = this.responseText;
                  $('#modifyadviser').modal('hide');
                      Swal.fire(
                      'Adviser Data!',
                      'Has been modified Successfully!',
                      'success'
                    )

                      adviser();

               
                              }
                           };
                   xhttp.open("POST",url,true);
                   xhttp.send(formData);

                      
                                        
                                
                               
        });

          $('#checkupdateph').click(function() {
               if($(this).prop("checked") == true) {
                      $('#imagedds').removeAttr('disabled');
                      $('#imagedds').attr('required',true);   
                      $('#triggersaveadv1').val('wimage');                         
                  }
               else if($(this).prop("checked") == false) {
                    $('#imagedds').removeAttr('required');
                      $('#imagedds').attr('disabled',true);  
                      $('#triggersaveadv1').val('noimage');      
                                                
                }
             });

         $('#addnewadviser').on('hidden.bs.modal', function (e) {
            $('.t').val('');
            $('#configimage').attr('src','../upload/undraw_profile_pic_ic5t.png');
          })
        

          $('#modifyadviser').on('hidden.bs.modal', function (e) {
            $('#imagedds').val('');
            $('#imagedds').attr('disabled',true);
            $('#checkupdateph').prop('checked',false);
             $('#configimages').attr('src','../upload/undraw_profile_pic_ic5t.png');
           
          })


                           




      $('#manageadviser').click(function() { 
          $(this).addClass('active');
          $('#managevoter').removeClass('active');
          $('#displaytxt').text('ADVISERS');
          $('#mannage').addClass('d-none');
          $('#addadv').removeClass('d-none');
          $('#tablecontent').html('Fetching DATA <i class="fas fa-spinner fa-pulse"></i>');
          adviser();
      })

      $('#managevoter').click(function() { 
         $(this).addClass('active');
          $('#manageadviser').removeClass('active');
          $('#displaytxt').text('VOTERS');
          $('#mannage').removeClass('d-none');
          $('#addadv').addClass('d-none');
            $('#tablecontent').html('Fetching DATA <i class="fas fa-spinner fa-pulse"></i>');
          voter();
      
      })

      function voter(){


       
           var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
          const data = this.responseText;
        

           $('#tablecontent').html(data);
        
                       }
                    };
            xhttp.open("POST", "advoter.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("getvoter=1&");
                
                         
      }
      function adviser(){
           var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
          const data = this.responseText;
        
           $('#tablecontent').html(data);
        
                       }
                    };
            xhttp.open("POST", "advoter.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("getadviser=1&");
      }
     


   

         }); 

           
   </script>
<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>