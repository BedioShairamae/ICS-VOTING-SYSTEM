
<!--Add Modal -->
<div class="modal fade" id="addposition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h6 style="font-weight: bolder;">Add New Position</h6>
      </div>
       <form method="post" action="action.php">
      <div class="modal-body">
           <div class="container">
             
                <label>Position Name:</label>
                   <input type="text" name="txtposname" id="try" class="form-control" style="font-size: 13px;" required="">   
                   <span id="valiid" style="color:red"></span><br>
                    <label>Maximum Candidates allowed:</label>
                   <input type="text" name="txtmaxcandidate" class="form-control" value="3" style="font-size: 13px;" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> 
                   <label>Number of winners:</label>
                   <input type="text" name="txtnoofwinner" class="form-control" value="1"  style="font-size: 13px;" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">                  
                <label>Minimum vote to cast per voter:</label>
                   <input type="text" name="txtnovote" class="form-control" value="1"  style="font-size: 13px;" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
           
           </div> 
           
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" id="savevepos"  name="savepos" style="font-size: 13px;">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 13px;">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!--Edit Modal -->
<div class="modal fade" id="editposition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h6 style="font-weight: bolder;">Updating Position</h6>
      </div>
       <form method="post" action="action.php">
      <div class="modal-body">
         
             
          <label>Position Name :</label>
            <input type="text" name="txtposname"  id="txtposnameval" class="form-control" >
             <label> Maximum Candidates allowed:</label>
            <input type="text" name="txtmaxcandidate"  id="txtmaxcandidateval" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <input type="hidden" name="txtcandidatecount" id="txtcandidatecount" >
            <label>Maximum Numbers of Winners:</label>
                   <input type="text" name="txtnoofwinner" id="txtnoofwinner" class="form-control" value="1"  style="font-size: 13px;" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">  

                   <label>Maximum vote to cast per voters:</label>
                   <input type="text" name="txtnovote" id="txtnovote" class="form-control" value="1"  style="font-size: 13px;" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">  


                      <input type="hidden" name="posid" id="idval">            

           
          
           
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" name="saveeditpos" style="font-size: 13px;">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 13px;">Close</button>
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
                  
          <h4 style="color: white;font-weight: bolder;">Are you sure you want to remove this Position ?</h4>  
           <form method="post" action="action.php">
                                  
          
          

     <button type="submit" class="btn btn-danger" name="btndeletepos">Yes</button><button type="button" class="btn btn-warning" id="closedel" >No</button>
              <input type="hidden" id="posid" name="posid">
               </form>
                 </div> 
                 
              </div>

</div>

<!---->



<!-- Modal -->
<div class="modal fade" id="editpartylist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
     
       <form method="post" onsubmit="return false" id="savepartylist">
          <input type="hidden" name="savepartylist">                 
       
      
      <div class="modal-body">
            
         <div class="container">
           
          <label>Enter Partylist</label>
          <input type="text" name="partylist" id="partylist" class="form-control" required="">


         </div> 
         



      </div>
      <div class="modal-footer">
           <button type="submit" style="font-size: 12px" class="btn btn-primary">Save changes</button>
        <button type="button" style="font-size: 12px" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editpt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
     
       <form method="post" onsubmit="return false" id="saveedittedpartylist">
          <input type="hidden" name="savepartylist">                 
       
      
      <div class="modal-body">
            
         <div class="container">
           
          <label>Modify Partylist</label>
          <input type="text" name="partylist" id="partylistval" data-pid="" class="form-control" required="">
          <input type="hidden" name="" id="partylistid">

         </div> 
         



      </div>
      <div class="modal-footer">
           <button type="submit" style="font-size: 12px" class="btn btn-primary">Save changes</button>
        <button type="button" style="font-size: 12px" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
      </form>
    </div>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
         $(document).ready(function() {
  //# for id , . for classes
      $('#table_id').DataTable();
   
      $('.btndel').click(function() { 
    var id = $(this).data("pid");
    
   /* $('#posid').val(id);
    $('#deletemodal').removeClass('close');
    $('#deletemodal').removeClass('d-none');
    $('#deletemodal').addClass('open');
    */
       Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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
                    'Deleted!',
                    'Position has been deleted.',
                    'success'
                  )
                       $('#manageposition').click();
                  
                                 }
                              };
                      xhttp.open("POST", "action.php",true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xhttp.send("btndeletepos=1&posid="+id);
                          
                                   



                
                }
              })

  })

$('.btnedit').click(function() { 
    var pid = $(this).data("pid");
    var name = $(this).data("name");
    var maxcount = $(this).data("maximumcount");
    var nowinner = $(this).data("noofwinner");
    var numvote = $(this).data("noofvotes");
    var cancount = $(this).data("cancount");
   
     $('#txtposnameval').attr("autofocus",true);
      $('#txtposnameval').val(name);
      $('#txtmaxcandidateval').val(maxcount);
      $('#txtcandidatecount').val(cancount);
      $('#txtnoofwinner').val(nowinner);
      $('#idval').val(pid);
      $('#txtnovote').val(numvote);

})
  

  $('#closedel').click(function() { 
    $('#deletemodal').removeClass('open');
    $('#deletemodal').addClass('close');
    
    
  })
  
    $('#try').keyup(function(){ 
          
         var val = $(this).val();
             
                  
                var xhttp = new XMLHttpRequest();
               xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
               const data = this.responseText;
                if(data == 'exist') {
                       $('#valiid').text('This position already exist! '); 
                       $('#savevepos').attr('disabled',true);
                    }else if(data=='proceed') {
                        $('#valiid').text(''); 
                         $('#savevepos').removeAttr('disabled');
                        
                    }
             
                            }
                         };
                 xhttp.open("POST", "val.php",true);
                 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                 xhttp.send("comparepos=1&val="+val);
                           
                     
                     
         }) 


    $('#savepartylist').on('submit', function(event){

       event.preventDefault();
       var partylist = $('#partylist').val();
        
           
               
                 var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                const data = this.responseText;
              
                // / 
                $('#editpartylist').modal('hide');
                Swal.fire(
                  'New Partylist!',
                  'Was Saved Successfully!',
                  'success'
                ).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                       $('#managepartylist').click();
                
                  }
                })
               
               

              
                             }
                          };
                  xhttp.open("POST", "action.php",true);
                  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.send("savepartylist=1&partylist="+partylist);
                      
                               
       });


    $('#saveedittedpartylist').on('submit', function(event){
       event.preventDefault();
      var partylist = $('#partylistval').val();
      var id = $('#partylistid').val();
            

             var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                const data = this.responseText;
              
                // / 
                $('#editpt').modal('hide');
                Swal.fire(
                  'Modified Partylist!',
                  'Was Saved Successfully!',
                  'success'
                ).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                       $('#managepartylist').click();
                
                  }
                })
               
               

              
                             }
                          };
                  xhttp.open("POST", "action.php",true);
                  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.send("saveeditpartylist=1&partylist="+partylist+"&id="+id);


       });

    function partylist(){
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
    }
  

         }); 
           
   </script>