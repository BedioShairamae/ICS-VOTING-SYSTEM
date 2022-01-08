<!-- Modal -->
      <div class="modal fade" id="accounts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Account</h5>
             
            </div>
           	
             <form method="post" id="formaccount" enctype="multipart/form-data" action="save_sv.php">
                	                  
           
            
            <div class="modal-body">
            	 <div class="container">
            	 
             	<?php 
             	include 'connection/connect.php';
             	$id = $_SESSION['admin_id_token'];
             					$ss = " select * from admin where  admin_id= '$id'  ";
             			                $resultss = mysqli_query($con,$ss); 
             			                $countss= mysqli_num_rows($resultss); 
             			              
             			                 while($row = mysqli_fetch_array($resultss)){
             							?>
             							<h6><input type="checkbox" name="" id="upphoto"> Update Photo</h6>
             							<input type="file" name="images[]" id="image" class="form-control" disabled="">

             							<br>
             							<label>Name</label>
             							<input type="text" name="ad_name" value="<?php echo $row['name']; ?>" class="form-control" required>
             							<label>Type</label>
             							<input type="text" name="" disabled value="<?php echo $row['type']; ?>" class="form-control">
             							<label>User</label>
             							<input type="text" name="ad_user" value="<?php echo $row['user']; ?>" class="form-control" required>
             							<label>Password</label>
             							<input type="password" id="newpas" value="<?php echo $row['pass'] ?>" name="ad_pass" class="form-control">
             							<br>
             							<label>Enter Current Password to save.</label>
             							<input type="password" name="" id="ver" class="form-control" required="" >
             							<span id="err" style="color: red"></span> <br>

                           <label for="showpass" class="eye" style="cursor: pointer;user-select: none;font-size: 14px">
                 <input type="checkbox"  name="" id="showpass" >
                    Show Password</label>
                
                       <script type="text/javascript">
                        //<i class="far fa-eye-slash"></i>
                        $(document).ready(function() {
                          
                       
                         $('#showpass').click(function() {
                              if($(this).prop("checked") == true) {
                                        $('#ver').attr('type','text');   
                                          
                                         $('#newpas').attr('type','text');                          
                                 }
                              else if($(this).prop("checked") == false) {
                                        $('#ver').attr('type','password');     
                                        $('#newpas').attr('type','password');                          
                               }
                            });
                          });
                        
                       </script>
             							<?php
             			                 }
             			          
             			                 
             	 ?>
             	 </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" style="font-size: 12px;" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="savesave" disabled="" name="btnsavesaveaccount" style="font-size: 12px;">Save changes</button>
            </div>
              </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      	
      	$(document).ready(function() {
      	      	
      	      	 $('#upphoto').click(function() {
      	      	      if($(this).prop("checked") == true) {
      	      	                   	$('#image').removeAttr('disabled');
      	      	                   	$('#image').attr('required',true);
      	      	                   	$('#formaccount').attr('action','savewphoto.php');

      	      	         }
      	      	      else if($(this).prop("checked") == false) {
      	      	         		$('#image').attr('disabled',true);
      	      	                   	$('#image').removeAttr('required');
      	      	                   	$('#formaccount').attr('action','save_sv.php');                              
      	      	       }
      	      	    });


      	      	 $('#ver').keyup(function(){ 
      	      	 	var val = $(this).val();

      	      	 		loadDoc();

      	      	 		 function loadDoc() {
				    var xhttp = new XMLHttpRequest();
				    xhttp.onreadystatechange = function() {
				        if (this.readyState == 4 && this.status == 200) {
				         	const ress = this.responseText;

				         	if(val == '') {
				         		$('#err').html('');
				         		$('#savesave').attr('disabled',true);
				         	}else {
				         			    if(ress.match('proceed')) {
				            	$('#savesave').removeAttr('disabled');
				            	$('#err').html('');

				            }else if (ress.match('wrong')){
				            	$('#err').html('Password does not match');

				            }
				         	}
				        

				       }
				    };
				    xhttp.open("POST", "save_sv.php",true);
				    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				    xhttp.send("compare=1&val="+val);
				}

      	      	 		    
      	      	 })
      	      });      
            	
      </script>