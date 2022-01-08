<?php 
session_start();
if(!isset($_SESSION['admin_id_token'])) {
  header("location:index.php");
}
include 'include/header.php';

include 'connection/fetch_data.php';
$fetch = new Fetch_data();
?>
	<body style="background-color: rgb(228, 228, 228);">
		<link rel="stylesheet" type="text/css" href="include/datatable/datatable.css"/>
		<script type="text/javascript" src="include/datatable/datatable.js"></script>
		<div class="page-wrapper chiller-theme toggled">
 	
 	<?php include 'include/sidebar.php'?>


  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
      <h2 style="font-family: 'Jost', sans-serif;letter-spacing: 5px;">COURSE AND YEAR</h2>
      <hr> 	
       <div class="row">
          
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
       	 	<div class="add-new" >
       	 		<a href="voters.php" class="btn btn-secondary" style="font-size: 11px;"><i class="fas fa-arrow-left"></i> Back to Voters Page</a>
       	 		<p></p>
       	 		
       	 		<p>




  <a class="btn btn-primary" id="addcourse" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="font-size:12px;"><i class="fas fa-plus"></i> Add Course</a>
  <a class="btn btn-primary" id="addyr" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2" style="font-size:12px;"><i class="fas fa-plus"></i> Add year</a>

  <a class="btn btn-info "  id="msec" type="button"  data-toggle="modal" data-target="#managesection" data-backdrop="static" data-keyboard="false"  style="font-size:12px;"><i class="fas fa-pen-square"></i> Manage Section</a>


  
</p>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">
            <form method="post" action="val.php">
                <h6>Adding new course</h6>
                <label>Enter Course:</label>
                <input type="text" id="txtcourseadd" style="text-transform:uppercase" name="txtcourseadd" style="font-size:12px" class="form-control" required>
                <span id="valiid" style="color:red"></span>
                <br>
                <input type="submit" class="btn btn-success" id="savecourse" name="savec" style="font-size:12px" value="save">
            </form>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">
        <form method="post" action="val.php">
            <h6>Adding year</h6>
            <label>Enter Year</label>
                <input type="text" id="txtyearadd" name="txtyearadd" style="font-size:12px" class="form-control" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                 <span id="valiidy" style="color:red"></span>
                <br>
                <input type="submit" class="btn btn-success" id="saveyear" name="savey" style="font-size:12px" value="save">
            </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="managesection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6>Manage Sections</h6>
      </div>
      <div class="modal-body">
            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#addnewsec" data-backdrop="static" data-keyboard="false" style="font-size: 12px"><i class="fas fa-plus-circle" ></i> Add new</a>
           <div id="sectioncontent">
           
      

            </div> 
      </div>
      <div class="modal-footer">
        <a type="button" style="font-size: 12px" class="btn btn-secondary" data-dismiss="modal">Close</a>
       
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addnewsec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-center" role="document">
    <div class="modal-content">
     
      <div class="modal-body shadow">
        <h5 class="mb-2 mt-2"> Add new Section</h5>
           <div class="card">
             <form method="post" action="section.php" id="formsection" onsubmit="return false">
                                    
              <input type="hidden" name="savenewsection">
            
               <div class="container">
               
              <label class="mt-3 mb-2">Enter New Section</label>
              <input style="font-size: 13px" type="text" class="form-control mb-4" name="txtsection" id="txtsection" required="">

               <div style="float: right;">
               
              <a class="btn btn-secondary mb-4" data-dismiss="modal" style="font-size: 12px;"> Close</a>
              <a href="javascript:void(0)" id="saveaa"  class="btn btn-primary mb-4" type="submit" style="font-size: 12px;">Save</a>
              <button type="submit" class="d-none" id="btnsubmitsave"></button>
              </div> 
              </div> 
               </form>
           </div> 
           
            


      </div>
     
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modifysec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-center" role="document">
    <div class="modal-content">
     
      <div class="modal-body shadow">
        <h5 class="mb-2 mt-2"> Modify Section</h5>
           <div class="card">
             <form method="post" action="section.php" id="formsectionmodify" onsubmit="return false">
                                    
              <input type="hidden" name="savemodifiedsection">
            
               <div class="container">
               
              <label class="mt-3 mb-2">Section</label>
              <input style="font-size: 13px" type="text" class="form-control mb-4" name="txtsection1" id="txtsection1" required="">

               <div style="float: right;">
                <input type="hidden" id="scid" name="scid">
               
              <a class="btn btn-secondary mb-4" data-dismiss="modal" style="font-size: 12px;"> Close</a>
              <a href="javascript:void(0)" id="saveaa1"  class="btn btn-primary mb-4" type="submit" style="font-size: 12px;">Save</a>
              <button type="submit" class="d-none" id="btnsubmitsave1"></button>
              </div> 
              </div> 
               </form>
           </div> 
           
            


      </div>
     
    </div>
  </div>
</div>


 <script type="text/javascript">
         
           $(document).ready(function() {
              
                
                $('#txtcourseadd').keyup(function(){ 


                 var txtvalue = $(this).val();
                  
                      
                     var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                    const data = this.responseText;
                    if(data == 'exist') {
                       $('#valiid').text('This course already exist!'); 
                       $('#savecourse').attr('disabled',true);
                    }else if(data=='proceed') {
                        $('#valiid').text(''); 
                         $('#savecourse').removeAttr('disabled');
                        
                    }
                            
                      // Your condition here if data success.
                  
                                 }
                              };
                      xhttp.open("POST", "val.php",true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xhttp.send("compare=1&val="+txtvalue);
                         
                                   
                   })
                   
                     $('#txtyearadd').keyup(function(){ 
               
                 var txtvalue = $(this).val();
                  
                      
                     var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                    const data = this.responseText;
                    if(data == 'exist') {
                       $('#valiidy').text('This year already exist!'); 
                       $('#saveyear').attr('disabled',true);
                    }else if(data=='proceed') {
                        $('#valiidy').text(''); 
                         $('#saveyear').removeAttr('disabled');
                        
                    }
                            
                      // Your condition here if data success.
                  
                                 }
                              };
                      xhttp.open("POST", "val.php",true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xhttp.send("compareyr=1&val="+txtvalue);
                         
                                   
                   })
               
               });      
                         
               
       </script>
       	 		
       	 	</div>
       	 	</div>

       	 	<hr>
           <?php
          if(isset($_SESSION['action'])) {
            echo  $_SESSION['action'];
            unset($_SESSION['action']);
          }

          ?>
          <div class="row">
            <div class="col-sm-6">
              <h5 style="font-weight: bolder;">COURSE</h5>
              <hr>
                    <table class="table table-hover" id="table_id">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Course</th>
                      <th scope="col">Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $fetch -> selectcourse();
                     ?>
                  </tbody>
                </table>
            </div>
            <div class="col-sm-6">
               <h5 style="font-weight: bolder;">YEAR</h5>
               <hr>
                  <table class="table table-hover" id="table_ids">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Year</th>
                  <th scope="col">Action</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php 
                $fetch -> selectyear();
                 ?>
              </tbody>
            </table>
            </div>
          </div>
  





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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
  
  $(document).ready(function() {
            $('#msec').click(function() { 
                  section();
                  
                  })
                  
                  function section(){
                      
                         var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                        const data = this.responseText;
                      
                       $('#sectioncontent').html(data);
                      
                                     }
                                  };
                          xhttp.open("POST", "section.php",true);
                          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                          xhttp.send("getsection=1");
                              
                                       
                  }

                  $('#saveaa').click(function() { 
                  $('#btnsubmitsave').click();
                  })

                   $('#saveaa1').click(function() { 
                  $('#btnsubmitsave1').click();
                  })

                  $('#formsection').on('submit', function(event){
                     event.preventDefault();
                    
                       
                           
                               var xhttp = new XMLHttpRequest();
                              xhttp.onreadystatechange = function() {
                               if (this.readyState == 4 && this.status == 200) {
                              const data = this.responseText;
                            $('#addnewsec').modal('hide');

                             Swal.fire(
                          'New Section',
                          'Has been added Successfully!',
                          'success'
                        )
                             section();
                            
                                           }
                                        };
                                xhttp.open("POST", "section.php",true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send($(this).serialize());
                                    
                                             
                     });

                     $('#formsectionmodify').on('submit', function(event){
                     event.preventDefault();
                    
                       
                           
                               var xhttp = new XMLHttpRequest();
                              xhttp.onreadystatechange = function() {
                               if (this.readyState == 4 && this.status == 200) {
                              const data = this.responseText;
                            $('#addnewsec').modal('hide');

                             Swal.fire(
                          'Section',
                          'Has been modified Successfully!',
                          'success'
                        )
                             section();
                             $('#modifysec').modal('hide');
                            
                                           }
                                        };
                                xhttp.open("POST", "section.php",true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send($(this).serialize());
                                    
                                             
                     });

                  $('#addnewsec').on('hidden.bs.modal', function (e) {
                 $('#txtsection').val('');
                })
                 
               
        });      
        
</script>
<!-- Button trigger modal -->

<?php include 'include/modal/courseyear.php' ?>
<?php include 'include/extensions.html'?>
<?php include 'include/footer.html'?>