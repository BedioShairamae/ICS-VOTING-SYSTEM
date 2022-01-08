
<!-- Modal -->
<div class="modal fade" id="editcourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h6>Edit Course</h6>
      </div>
       <form method="post" action="courseyear.php">
      <div class="modal-body">

        		
        		<input type="text" id="txtcourse" name="txtcourse" class="form-control">
        		<input type="hidden" id="courseid" name="courseid">



      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary" name="btneditcourse" style="font-size: 12px;">Save</button>
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
              	 	
       		<h4 style="color: white;font-weight: bolder;">Are you sure you want to remove this Course ?</h4>  
       		 <form method="post" action="courseyear.php">
       		    	                  
       		
       		

		 <button type="submit" class="btn btn-danger" name="delcourse">Yes</button><button type="button" class="btn btn-warning" id="closedel" >No</button>
              <input type="hidden" id="candidate-id" name="id">
               </form>
              	 </div> 
              	 
            
              </div>

</div>

<!---->


<!-- Modal -->
<div class="modal fade" id="edityear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h6>Edit Year</h6>
      </div>
       <form method="post" action="courseyear.php">
      <div class="modal-body">

            
            <input type="text" id="txtyear" name="txtyear" class="form-control">
            <input type="hidden" id="yearid" name="yearid">



      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary" name="btnedityear" style="font-size: 12px;">Save</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 12px;">Cancel</button>
      </div>
         </form>
    </div>
  </div>
</div>

<!--Delete Modal-->
<div id="editmodal" class="d-none">

              <!-- Modal content -->
              <div id="contents" class="editmodal-contents">
                 <div class="container popup">
                  
          <h4 style="color: white;font-weight: bolder;">Are you sure you want to remove this Year ?</h4>  
           <form method="post" action="courseyear.php">
                                  
          
          

     <button type="submit" class="btn btn-danger" name="delyear">Yes</button><button type="button" class="btn btn-warning" id="closeyear" >No</button>
              <input type="hidden" id="candidate-idyear" name="id">
               </form>
                 </div> 
                 
            
              </div>

</div>

<!---->

	
<script>
         $(document).ready(function() {
  //# for id , . for classes
      $('#table_id').DataTable();
      $('#table_ids').DataTable();
     

     $('.btndel').click(function() { 
    var id = $(this).data("courseid");
    
    
    $('#candidate-id').val(id);
   
  $('#deletemodal').removeClass('close');
    $('#deletemodal').removeClass('d-none');
    $('#deletemodal').addClass('open');

  })


	 $('.btndelyear').click(function() { 
    var id = $(this).data("yearid");
    
    
    $('#candidate-idyear').val(id);
    $('#editmodal').removeClass('close');
    $('#editmodal').removeClass('d-none');
    $('#editmodal').addClass('open');
    

  })
   $('#closeyear').click(function() { 
    $('#editmodal').removeClass('open');
    $('#editmodal').addClass('close');
    
  })

	$('#closedel').click(function() { 
		$('#deletemodal').removeClass('open');
		$('#deletemodal').addClass('close');
		
	})
  $('.edit').click(function() { 
    var id = $(this).data("courseid");
    var course = $(this).data("course");
    $('#courseid').val(id);
    $('#txtcourse').val(course);
  })

    $('.edityear').click(function() { 
    var id = $(this).data("yearid");
    var course = $(this).data("year");
    $('#yearid').val(id);
    $('#txtyear').val(course);
  })

         }); 
           
   </script>