<?php 
session_start();
if(!isset($_SESSION['admin_id_token'])) {
  header("location:index.php");
}
include 'include/header.php';
include 'connection/fetch_data.php';
$fetch= new Fetch_data();
?>
	<body style="background-color: rgb(228, 228, 228);">
		<div class="page-wrapper chiller-theme toggled">
 	
 	<?php include 'include/sidebar.php'?>
 	<?php include 'accountmodal.php'?>


  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">ELECTION</h2>
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
       <div class="row">
          
       
 <div class="card" style=" box-shadow:  0 1rem 4rem 0 #00000040;">
<p></p>
<?php 
  if(isset($_SESSION['status'])) {
    echo  $_SESSION['status'];
    unset($_SESSION['status']);
  }
?>
<p><i class="fas fa-info-circle"></i> In this Section , Shows the Managable Data of this current Election .</p>
   <div class="card text-center shadow">
  <div class="card-header">
    <span style="font-weight: bolder;color: green;">Active</span>
  </div>
  <div class="card-body">
    <button class="btn btn-danger" style="font-size: 14px;float: right;" data-toggle="modal" data-target="#exampleModalCenter"  data-backdrop="static" data-keyboard="false"><i class="fas fa-exclamation-triangle"></i> RESET ELECTION <i class="fas fa-exclamation-triangle"></i> </button>
    <br><br>
   <?php
          if(isset($_SESSION['action'])) {
            echo  $_SESSION['action'];
            unset($_SESSION['action']);
          }



          ?>
    <?php
    $fetch ->select_electActive();
    ?>
  
   
  </div>
  <div class="card-footer text-muted">

  </div>
</div>
<p></p>
<hr>
<p><i class="fas fa-info-circle"></i> In this Section , Shows the Managable Data of the Past Election .</p>
<div class="card text-center">
  <div class="card-header">
    <span style="font-weight: bolder;color: red">Inactive</span>
  </div>
  <div class="card-body">
     <div class="container">
         
            <button style="font-size: 14px" required class="btn btn-info" data-toggle="modal" data-target="#addnewsched" >Add new Schedule <i class="fas fa-plus"> </i></button>
            <p></p>
         
          </div>
    <?php
    $fetch -> select_electionInactive();
    ?>
  </div>
  <div class="card-footer text-muted">
 
  </div>
</div>
<p></p>
 </div>



       </div>

     <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header " id="modalheader" style="text-align: center;justify-content: center;">
        <h1 style="font-weight: bolder;color: red;text-align: center;" class="modal-title rs" id="exampleModalLongTitle">WARNING !</h1>
       
      </div>
      <div class="modal-body" style="text-align: center;">
         <div  class="container" id="contentreset">
           <h6>Are you sure you want to start over with the election? It will reset everything, including the number of votes, and users who have finished voting will be able to vote again.</h6>

           <br>
           <span style="font-weight: bolder;">This action cannot be undone.</span>
         </div> 
         
        
        <br><br>
         <div class="container" style="text-align: center;"> 
          <form method="post" action="reset.php" onsubmit="return false" id="resetting">
                      <input type="hidden" name="reset">           
         
         
       <button type="submit" class="btn btn-danger rs resetyes" name="reset"  style="width: 100px;border-radius: 10px; margin:5px;">Yes</button>
        <button type="button" class="btn btn-warning rs" data-dismiss="modal" style="width: 100px;border-radius: 10px; margin:5px;">No</button>
        </form>
       
        </div> 
      </div>
     
    </div>
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




<!--view Modal -->
<div class="modal fade" id="Fetchdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header"><i  class="far fa-question-circle"></i></div>
       <form method="post" action="change_sched.php">
      <div class="modal-body" style="cursor: default;">
       <h6 style="font-weight: bolder;"> Are you sure you want to Fetch the data's  in this written schedule? 
        It will Show all the data corresponds with its schedule. <br><br>
        
      </h6>
      
            <input type="hidden" id="shid" name="shid">
      </div>
      <div class="modal-footer">
        
       <button type="submit"  name="yesfetch" class="btn btn-success" style="font-size: 13px;">Yes , Proceed</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="font-size: 13px;">No</button>
      </div>
        </form>
    </div>
  </div>
</div>


  <!--view Modal -->
<div class="modal fade" id="Manage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h6 style="font-weight: bolder;">Manage Election Schedules</h6>
          <span style="font-weight: bolder;font-size: 16px;float: right;"> <div class="clock"  ><div class="displaymanage"></div></div> </span> 
      </div>
       <form method="post" action="httprequest.php">
      <div class="modal-body" style="height: 450px;overflow-y: scroll">
         
        <script>
      setInterval(function(){
        const clock = document.querySelector(".displaymanage");
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
    <h5 style="font-weight: bolder;text-align: center;" class="mb-3" id="electiontitletxt">(Re-Elect) ICS ELECTION</h5>

     <div class="row">
        <div class="col-md-6">
            <label>Year :</label>
              <input type="text" name="txtyear" style="font-weight: bolder;text-align: center;" id="year" class="form-control" disabled="">
        </div> 
         <div class="col-md-6">
             <label>Semester :</label>
               <input type="text" name="txtsemester" style="font-weight: bolder;text-align: center;" id="sem" class="form-control" disabled="">
         </div> 
        
     </div> 
     
      
             
               
                <label class="mt-2">Title of Election :</label>
            
               <textarea class="form-control" name="electiontitle" rows="2" id="electiontitle">
                 
               </textarea>
               <br>
                <div class="row">
                 </span></label> </h6>
                 <hr>
                 <h6>SET DATE AND TIME ELECTION SCHEDULES</h6>
                 <?php 
                 if ($_SESSION['eventenddowns'] == NULL || $_SESSION['eventenddowns'] == '0000-00-00 00:00:00' || $_SESSION['eventenddowns'] == ''){
                  ?>
                  <button class="btn btn-light mb-2 mt-2" type="button" disabled="" style="font-size: 12px;position: absolute;right: 10px;width: 150px; padding: 10px"><i class="fas fa-ban"></i> Add Duration Time</button>
                  <?php
                 }else {
                  ?>
                  <button class="btn btn-light mb-2 mt-2" type="button" data-dismiss="modal"  data-toggle="modal" data-target="#extensiontime" data-backdrop="static" data-keyboard="false" style="font-size: 12px;position: absolute;right: 10px;width: 150px; padding: 10px"><i class="fas fa-plus-circle"></i> Add Duration Time</button>
                  <?php
                 }
                  ?>

                 



                  <div class="col-sm-6">
                     <label>Event Start :</label>
               <input type="datetime-local" id="startdate" name="txtstartdate"  class="form-control"  >
                  </div>
                   <div class="col-sm-6">
                     <label>Event End:</label>
               <input type="datetime-local" id="enddate" name="txtenddate" class="form-control"  >
                  </div>
                </div>

              <input type="hidden" value="" id="lid" name="lid">

        
        <hr>
        <h6>Other Managable Action:</h6>
        <label>Do you want to allow user/voters from Logging in into the voting system while you are setting some candidates and other stuffs for the election?</label>
            <div class="card">
               <div class="container">
                Current Status : <span id="enabled" style="color: green;font-weight: bolder;text-transform: uppercase;"></span>
                <span id="disabled" style="color: red;font-weight: bolder;text-transform: uppercase;"></span>
                   <p></p>
               <label><input type="radio" class="prom" name="prompt" value="enabled" > <span style="color: green;">ENABLE voters Login </span></label>
            <label><input type="radio" class="prom" name="prompt" value="disabled"> <span style="color: red;">DISABLE voters Login </span></label>
            <input type="hidden" id="subprompt" value="enabled" name="subprompt">
              <p></p>
               </div> 
               
             
            </div> 
            
           
      </div>
      <div class="modal-footer">
        
       <button type="submit" class="btn btn-primary" name="btnsaveelecsched" style="font-size: 13px;">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 13px;">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!--view Modal -->
<div class="modal fade" id="addnewsched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
     
      <span style="font-weight: bolder"> <div class="clock"  ><div class="display"></div></div> </span> 
       <span style="font-weight: bolder;"><?php echo  date('F j,  Y ',strtotime(date('Y-m-d H:i:s'))); ?></span>
                             <script>
      setInterval(function(){
        const clock = document.querySelector(".display");
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
     </div>
       <form method="post" action="httprequest.php">
      <div class="modal-body" style="cursor: default;">
              
               <label >Title of Election :</label>
            
               <textarea class="form-control" required="" style="font-size: 14px" name="electiontitlenew" rows="2" >
                 
               </textarea>
             
                <label class="mt-2">Year :</label>
               <select id="cboYear" class="form-select" name="yearselected">
                           <option value="<?php echo date('Y') ?>" >Select Year</option>

                  </select>
            <script type="text/javascript">

    $(document).ready(function(){
        Years(); // this will run the function Years() after the DOM (document object model) has been loaded.
    });

    function Years() {
        // get the current date and put in today variable
        var today = new Date(); 
        // get the year and put it in yyyy variable
        yyyy = today.getFullYear();
        custom = new Date(yyyy + 40);

        // appending from year 2015 up to present in the select tag
        for (var index = yyyy; index <= custom; index++) {
            $('#cboYear').append('<option value ="' + index + '">' + index + '</option>')
        }
    }
</script>
             

              <label class="mt-2">Select Semester :</label>
               
               <select class="form-select" name="txtsemester">
                  <option value="1">1</option>
                   <option value="2">2</option>
               </select>


               
                <hr>
                <p><i class="fas fa-info-circle"></i> This Section is Optional. <br> You can set it later if you want to start the Election</p> <hr>
              

                <div class="row">
                  <h6>Event Schedule</h6>
                  <div class="col-sm-6">
                     <label>Event Start :</label>
               <input type="datetime-local" id="startdate" name="txtstartdate" class="form-control" >
                  </div>
                   <div class="col-sm-6">
                     <label>Event End:</label>
               <input type="datetime-local" id="enddate" name="txtenddate" class="form-control"  >
                  </div>
                </div>
      </div>
      <div class="modal-footer">
        
       <button type="submit" name="btnsavenewsched" class="btn btn-primary" style="font-size: 13px;">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 13px;">cancel</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="extensiontime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered border-success" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel"> Adding Time</h6>
        
      </div>
       <form method="post"  id="addtime" onsubmit="return false">
                  <input type="hidden" name="addtime" >             
       
      
      <div class="modal-body">
          
          
           <div class="row">
              <div class="col-md-6">
                <h6>Duration :</h6>
                <select class="form-select" name="duration">
                  <option value="days">Days</option> 
                  <option value="hours">Hours</option> 
                  <option value="minutes">Minutes</option> 


                </select>
              </div> 
               <div class="col-md-6">
                <h6>Length :</h6>
                 <input type="text" id="txtlength" required="" name="length" class="form-control" maxlength="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
               </div> 
              
           </div> 

           
            
           

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" style="font-size: 12px"  data-toggle="modal" data-target="#Manage">Cancel</button>

        <button type="submit" class="btn btn-success" style="font-size: 12px" ><i class="fas fa-plus-circle"></i> Add</button>
      
      </div>

      </form>
    </div>
  </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    
      $(document).ready(function() {

            $('#addtime').on('submit', function(event){
               event.preventDefault();


                     
                       var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                       if (this.readyState == 4 && this.status == 200) {
                      const data = this.responseText;
                   $('#extensiontime').modal('hide');
                   $('#txtlength').val('');

                   Swal.fire(
                'Election Duration Added!',
                'Added time Successfully!',
                'success'
              ).then((result) => {
                      if (result.isConfirmed) {
                       location.reload();
                      }
                    })
                    
                                   }
                                };
                        xhttp.open("POST", "action.php",true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send($(this).serialize());
                            
                        

               });

            $('#extensiontime').on('hidden.bs.modal', function (e) {
            $('#txtlength').val('');
            })


          $('#resetting').on('submit', function(event){
             event.preventDefault();
                   
                 
                    var xhttp = new XMLHttpRequest();
                   xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                   const data = this.responseText;
                 
                       $('#contentreset').html('<h2>Resetting <i class="fas fa-sync fa-spin"></i></h2> <br> <h6>all modules are being cleared</h6>');
                $('.rs').hide();
                $('#modalheader').addClass('bg-danger');
              var reset=  setInterval(function(){
                 $('#contentreset').html('<h2>Resetting <i class="fas fa-sync fa-spin"></i></h2> <br> <h6>all modules are being cleared</h6>');
                clearInterval(reset);
                },2000);
               var reset1=  setInterval(function(){
                 $('#contentreset').html('<h2>Resetting <i class="fas fa-sync fa-spin"></i></h2> <br> <h6>All modules are cleared..</h6>');
                clearInterval(reset1);
                },4000);

                var reset2=  setInterval(function(){
                 $('#contentreset').html('<h2>Election Has Reset Successfully!</h2> ');
                 $('#modalheader').removeClass('bg-danger');
                  $('#modalheader').addClass('bg-success');
                clearInterval(reset2);
                },8000);
                 var reset3=  setInterval(function(){
                $('#exampleModalCenter').modal('hide');
                location.reload();
                clearInterval(reset3);
                },10500);
                 
                                }
                             };
                     xhttp.open("POST", "reset.php",true);
                     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                     xhttp.send($(this).serialize());
                         
                                  
             });


        $('.prom').click(function() { 
          var val = $(this).val();
          $('#subprompt').val(val);
        })
          
            $('.btnmanage').click(function() {
              var year = $(this).data("year");
              var semester = $(this).data("semester");
              var title = $(this).data("title");
              var eventstart = $(this).data("eventstart");
              var eventend = $(this).data("eventend");
              var id = $(this).data("lid");
              var voterlog = $(this).data("voterlog");
             var yearadd = parseInt(year);
             var valyear = yearadd+1;
          $('#electiontitle').val(title);  
          $('#electiontitletxt').text(title);
          $('#year').val(year+'-'+valyear);
          $('#sem').val(semester);
          
          $('#startdate').val(eventstart);
         
          $('#enddate').val(eventend);
          $('#lid').val(id);
         
          if(voterlog == 'enabled') {
            $('#enabled').text(voterlog);
          }else {
             $('#disabled').text(voterlog);
          }
              
              })
          
            $('.btnfetch').click(function() { 
            var shid = $(this).data("shid");
            $('#shid').val(shid);
            })

              $('#Manage').on('show.bs.modal', function (e) {
              $('#timee').hide();
          })

            $('#Manage').on('hidden.bs.modal', function (e) {
            $('#timee').show();
          })

            $('.btndeletesched').click(function() { 
              var id = $(this).data('shid');
            Swal.fire({
            title: 'Warning!',
            text: "Resetting this election will erase data including the voters, position, vote counts and candidates. Do you want to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#f6c23e',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
            
                    var xhttp = new XMLHttpRequest();
                   xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                   const data = this.responseText;
                 
                     Swal.fire(
                      'Election Data',
                      'Successfully Deleted!',
                      'success'
                        ).then((result) => {
                              if (result.isConfirmed) {
                               location.reload();
                              }
                            })
                 
                                }
                             };
                     xhttp.open("POST", "reset.php",true);
                     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                     xhttp.send("deletesched=1&id="+id);
                         
                                  
                  
                  
             
            }
          })
            })
          });      
                    
          
  </script>
<?php include 'include/extensions.html'?>

<?php include 'include/footer.html'?>