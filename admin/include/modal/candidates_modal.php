

<!--view Modal -->
<div class="modal fade" id="viewcandidate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h6 style="font-weight: bolder;">Advocacy</h6>
      </div>
       <form method="post" action="action.php">
      <div class="modal-body">


      
              <p id="the_details">
              </p>
              -<span id="Name_of_student"></span>
      </div>
      <div class="modal-footer">
        
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 13px;">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!--Edit Modal -->
<div class="modal fade" id="editcandidate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h6 style="font-weight: bolder;">Updating Candidate</h6>
      </div>
       <form method="post" action="httprequest.php">

      <div class="modal-body">
          
          <h6>Current PARTY-LIST :</h6>  

                
              <select class="form-select " name="partylist" >
                <option style="text-align: center;"  id="currentpt"></option>
                  <?php 
                  $elecid =$_SESSION['electsched'];
                 
                         
                                    $sql = " SELECT * FROM `partylist` WHERE election_id = '$elecid' or election_id ='0' ";
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
                                  <option>NULL</option>
                                  <?php
                                }

                   ?>
              </select>
              <br>


              <textarea cols="3" name="txtdetails" id="txtdetalye" class="form-control">
                
              </textarea>
        
                                  
            
          
           <input type="hidden" name="svid" id="svids">
          <input type="hidden" name="cid" id="txtid">
           
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" name="btnedit" style="font-size: 13px;">Save changes</button>
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
                  
          <h4 style="color: white;font-weight: bolder;">Are you sure you want to remove this Candidate ?</h4>  
           <form method="post" action="httprequest.php">
                                  
          
          

     <button type="submit" class="btn btn-danger" name="btndel">Yes</button><button type="button" class="btn btn-warning" id="closedel" >No</button>
              <input type="hidden" id="candidate-id" name="cid">
               </form>
                 </div> 
                 
            
              </div>

</div>

<!---->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script type="text/javascript">
  
  $(document).ready(function() {
           $('.btndel').click(function() { 
    var id = $(this).data("pid");
    
   /* $('#candidate-id').val(id);
    $('#deletemodal').removeClass('close');
    $('#deletemodal').removeClass('d-none');
    $('#deletemodal').addClass('open'); */
    
      Swal.fire({
        title: 'Are you sure you want to delete this candidate?',
        text: "you can still readd it if you want to.",
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
            'Candidate Deleted!',
            'it has been removed from the record!',
            'warning'
          ).then((result) => {
        if (result.isConfirmed) { 
        location.reload();
        }

      })  
       

            
                         }
                      };
              xhttp.open("POST", "httprequest.php",true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("btndel=1&cid="+id);
                  
                           


        }
      })           


  })

  $('#closedel').click(function() { 
    $('#deletemodal').removeClass('open');
    $('#deletemodal').addClass('close');
    
    
  })


  $('.btneditcan').click(function() { 
    var cid = $(this).data("cid");
    var cpt = $(this).data("currentpt");
    var svid = $(this).data("svid");
    var curptid =$(this).data("curptid");
    $('#txtid').val(cid);
    $('#currentpt').text(cpt);
    $('#svids').val(svid);
    $('#currentpt').val(curptid);
    
    $.ajax({
              url : "httprequest.php",
               method: "POST",
                data  : {getdetails:1,cid:cid},
                success : function(data){
            $('#txtdetalye').val(data);
                }
             });
  })

  $('.det').click(function() { 
   var cid = $(this).data("cid");
   var name = $(this).data("name");
   $('#Name_of_student').text(name);
  

      $.ajax({
              url : "httprequest.php",
               method: "POST",
                data  : {getdetails:1,cid:cid},
                success : function(data){
            $('#the_details').text(data);
                }
             });
            
       

  })
        });      
        
</script>