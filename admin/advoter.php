<?php 
 session_start();
include 'connection/fetch_data.php';
include 'connection/connect.php';

	if(isset($_POST['getvoter'])){ 
  ?>
  
 
   <fieldset id="checkArray">
      <table class="table table-hover" id="table_id1">
  <thead class="thead-dark">
    <tr>
    	<th scope="col"><input type="checkbox" id="checkitall" name=""></th>
      <th scope="col">Voters-iD</th>
      <th scope="col">Last Name</th>
      <th scope="col">Given Name</th>
      <th scope="col">Middle Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Course&year</th>
     <!-- <th scope="col">Date-Registered</th>-->
      <th scope="col">Status</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $fetch = new Fetch_data();
      $fetch -> select_students();
    ?>
  </tbody>
</table>
</fieldset>
Options on Selected : <button type="button" class="btn btn-primary" id="clearselected" style="font-size: 12px">Clear Selected</button> <button type="submit" name="verifyit" id="verifyit" class="btn btn-success" style="font-size: 12px">Verify</button> <button type="submit" name="rev" id="revokeit" class="btn btn-danger" style="font-size: 12px">Revoke</button> <button class="btn btn-danger" name="deleteit" style="font-size: 12px" type="submit" id="deleteit">Delete</button>
  <?php
}


if(isset($_POST['getadviser'])){ 
	?>

      <table class="table table-hover" id="table_id1" >
  <thead class="thead-dark">
    <tr>
      <th scope="col">Scope-Course</th>
      <th scope="col">Scope-Year</th>
      <th scope="col">Last Name</th>
      <th scope="col">Given Name</th>
      <th scope="col">Middle Name</th>
     
     
      <th scope="col">Date-Registered</th>
      <th scope="col">Status</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody >
    <?php
     $fetch = new Fetch_data();
      $fetch -> select_adviser();
    ?>
  </tbody>
</table>
  <?php
}

if(isset($_POST['triggersaveadv'])){ 

$emailval = $_POST['emailval'];
$sectionval = $_POST['sectionval'];
$courseval = $_POST['courseval'];
$lastnameval = $_POST['lastnameval'];
$givennameval = $_POST['givennameval'];
$middlenameval = $_POST['middlenameval'];
$elecid =$_SESSION['electsched'];
	date_default_timezone_set('Asia/Manila');
	$datenow = date('Y-m-d H:i:s');

			$check = " SELECT * FROM `adviser` where scope_section = '$sectionval' and scope_course = '$courseval'  ";
	                $resultck = mysqli_query($con,$check); // run query
	                $countck= mysqli_num_rows($resultck); // to count if necessary
	               //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
	          if ($countck>=1){
	             	echo 'already';
	          }else {
	          	foreach($_FILES['imagename']['name'] as $key=>$val){
	                  $image_name = $_FILES['imagename']['name'][$key];
	                   $tmp_name   = $_FILES['imagename']['tmp_name'][$key];
	                $size       = $_FILES['imagename']['size'][$key];
	                 $type       = $_FILES['imagename']['type'][$key];
	                 $error      = $_FILES['imagename']['error'][$key];
	                                                                                                                                    
	             
	                                                                                                                                    
	           $fileName =basename($_FILES['imagename']['name'][$key]);
	                                                                                                                                  
	            $pname = $fileName;
	                // File upload path
	            $uploads_dir = '../upload';
	         move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);
	             
	              	
	         	$sql = " INSERT INTO `adviser`(`lastname`, `firstname`, `middlename`, `email`, `photo`, `scope_section`, `scope_course`,`date_registered`,`password`) VALUES ('$lastnameval','$givennameval','$middlenameval','$emailval','$pname','$sectionval','$courseval','$datenow','$lastnameval') ";
			 			                $result = mysqli_query($con,$sql); 
			 			                                                                                                  
	         	
	            } 
	          }

			//Make the imagename array set at form. look likes this name="imagename[]"
	
	          

	                                       
	
	
	            
	
}

if(isset($_POST['triggersaveadv1'])){ 
$trigger = $_POST['triggersaveadv1'];
$emailval = $_POST['emailval1'];
$sectionval = $_POST['sectionval1'];
$courseval = $_POST['courseval1'];
$lastnameval = $_POST['lastnameval1'];
$givennameval = $_POST['givennameval1'];
$middlenameval = $_POST['middlenameval1'];
$advid = $_POST['advid'];

if($trigger == 'noimage'){
				$sql = " UPDATE `adviser` SET `lastname`='$lastnameval',`firstname`='$givennameval',`middlename`='$middlenameval',`email`='$emailval',`scope_section`='$sectionval',`scope_course`='$courseval' WHERE adv_id = '$advid'  ";
		                $result = mysqli_query($con,$sql); // run query
		               
}else {
	$unlink ="select * from adviser where adv_id='$advid'";
					$unlinking = mysqli_query($con,$unlink); 


					                 while($row = mysqli_fetch_array($unlinking)){
										$photo = $row['photo'];
					                 }
					                 $src = '../upload/'.$photo;
					                 unlink($src);


		foreach($_FILES['imagename1']['name'] as $key=>$val){
	                  $image_name = $_FILES['imagename1']['name'][$key];
	                   $tmp_name   = $_FILES['imagename1']['tmp_name'][$key];
	                $size       = $_FILES['imagename1']['size'][$key];
	                 $type       = $_FILES['imagename1']['type'][$key];
	                 $error      = $_FILES['imagename1']['error'][$key];
	                                                                                                                                    
	             
	                                                                                                                                    
	           $fileName =basename($_FILES['imagename1']['name'][$key]);
	                                                                                                                                  
	            $pname = $fileName;
	                // File upload path
	            $uploads_dir = '../upload';
	         move_uploaded_file($tmp_name , $uploads_dir .'/'.$pname);
	             
	              	
	         	$sql = " UPDATE `adviser` SET `lastname`='$lastnameval',`firstname`='$givennameval',`middlename`='$middlenameval',`email`='$emailval',`scope_section`='$sectionval',`scope_course`='$courseval' , `photo`='$pname' WHERE adv_id = '$advid'  ";
			 			                $result = mysqli_query($con,$sql); 
			 			                                                                                                  
	         	
	            } 
}

	
	                                       
	
	
	            
	
}

if(isset($_POST['deleteadv'])){ 

	$id = $_POST['id'];
				$unlink ="select * from adviser where adv_id='$id'";
					$unlinking = mysqli_query($con,$unlink); 


					                 while($row = mysqli_fetch_array($unlinking)){
										$photo = $row['photo'];
					                 }
					                 $src = '../upload/'.$photo;
					                 unlink($src);
					          


			$sql = " DELETE From `adviser` where adv_id = '$id'   ";
	                $result = mysqli_query($con,$sql); // run query
	               
}

if(isset($_POST['selecttrigger'])){ 
	$selecttrigger = $_POST['selecttrigger'];
	$selectcheck = $_POST['selectcheck'];
	if ($selecttrigger == 'verify'){

	 foreach ($selectcheck as $checkid) {
											
         		$sql = " UPDATE `student` SET `isverified`=1 WHERE s_id ='$checkid'  ";
                         $result = mysqli_query($con,$sql); // run query
                         
                   

		}                            
									
	} 
	else if ($selecttrigger == 'delete') {
			
	 foreach ($selectcheck as $checkid) {
											
                                       
				$sql = "DELETE FROM `student` WHERE s_id ='$checkid' and isverified = 0  ";
                         $resultde = mysqli_query($con,$sql); // run query	

	} 
	}else if ($selecttrigger == 'revoke') {
			
	 foreach ($selectcheck as $checkid) {
											
                                       
			$sql = " UPDATE `student` SET `isverified`=0 WHERE s_id ='$checkid'  ";
                         $result = mysqli_query($con,$sql); // run query	

	} 
	}
	
}


?>

<script type="text/javascript">
	
	$('#table_id1').DataTable();   
	  $('.btndel').click(function() { 
		var id = $(this).data("cid");
		
		/*$('#candidate-id').val(id);
		$('#deletemodal').removeClass('close');
		$('#deletemodal').removeClass('d-none');
		$('#deletemodal').addClass('open');*/

		     		Swal.fire({
			  title: 'Are you sure you want to delete this voters account?',
			  text: "You won't be able to recover this!",
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
			      'Account Deleted!',
			      'it has been permanently Deleted!',
			      'warning'
			    ).then((result) => {
			  if (result.isConfirmed) { 
			  $('#managevoter').click();
			  }

			})  
			 

			    	
			    				       }
			    				    };
			    		xhttp.open("POST", "action.php",true);
			    		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    		xhttp.send("deletestudent=1&svid="+id);
			    				
			          	      	 


			  }
			}) 	      	 

	})
     $('.btnverify').click(function() { 
      var id = $(this).data('sid');
          Swal.fire({
        title: 'Mark as Verified?',
        text: "The voter will be able to vote and escape viewing mode.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#36b9cc',
        cancelButtonColor: '#f6c23e',
        confirmButtonText: 'Yes, Mark as verified!'
      }).then((result) => {
        if (result.isConfirmed) {
           
               var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
               Swal.fire(
                    'Voter',
                    'Was Marked Verified Successfully!',
                    'success'
                  ).then((result) => {
                if (result.isConfirmed) {
               $('#managevoter').click();
                }
              })
                           }
                        };
                xhttp.open("POST", "reset.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("verify=1&id="+id);
                    
                             


                  //
        }
      })
     
     })

     $('.btnrevoke').click(function() { 
          
             var id = $(this).data('sid');
          Swal.fire({
        title: 'Are you sure?',
        text: "Revoking the validity of voter to vote. it will disable the voters right to vote!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74a3b',
        cancelButtonColor: '#f6c23e',
        confirmButtonText: 'Yes, Revoke!'
      }).then((result) => {
        if (result.isConfirmed) {
           
               var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
               Swal.fire(
                    'Voters validity to vote',
                    'Revoked successfully. If you want to validate voter again, click verify.',
                    'warning'
                  ).then((result) => {
                if (result.isConfirmed) {
                 $('#managevoter').click();
                }
              })
                           }
                        };
                xhttp.open("POST", "reset.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("revoke=1&id="+id);
                    
                             


                  //
        }
      })
     })

$('.btninvalid').click(function() { 
  alert('Unable to Delete Students w/status Candidate!');
})
	

	$('#closedel').click(function() { 
		$('#deletemodal').removeClass('open');
		$('#deletemodal').addClass('close');
		
	})  

	$('.modifyadviser').click(function() { 
		var advid = $(this).data('advid');
		var course = $(this).data('course');
		var section = $(this).data('section');
		var lastname = $(this).data('lastname');
		var firstname = $(this).data('firstname');
		var middlename = $(this).data('middlename');
		var email = $(this).data('email');
		var pic = $(this).data('pic');
		$('#advid').val(advid);
		$('#emailval1').val(email);
		$('#sectionval1').val(section);
		$('#courseval1').val(course);
		$('#lastnameval1').val(lastname);
		$('#givennameval1').val(firstname);
		$('#middlenameval1').val(middlename);
		$('#configimages').attr('src',pic);




	 
	 }) 
	$('.deleteadv').click(function() { 
		var advid = $(this).data('advid');
		
					Swal.fire({
			  title: 'Are you sure you want to delete this Adviser account?',
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
			      'Account has been permanently Deleted!',
			      'warning'
			    )
			    adviser();

			    	
			    				       }
			    				    };
			    		xhttp.open("POST", "advoter.php",true);
			    		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    		xhttp.send("deleteadv=1&id="+advid);
			    				
			          	      	 


			  }
			})
	})

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

     
      	 $('#checkitall').click(function() {
      	      if($(this).prop("checked") == true) {
      	           	$('.checkit').prop('checked',true);                          		
      	         }
      	      else if($(this).prop("checked") == false) {
      	      		$('.checkit').prop('checked',false); 
      	                                       
      	       }
      	    });
      	 $('#clearselected').click(function() { 
      	 	$('.checkit').prop('checked',false); 
      	 	$('#checkitall').prop('checked',false);
      	 })

      	 

      	 $('#selectallsubmit').on('submit', function(event){
      	    event.preventDefault();

      	    var selecttrigger = $('#selecttrigger').val();


      	 var atLeastOneIsChecked = $('input[name="selectcheck[]"]:checked').length > 0;
      	   if(atLeastOneIsChecked == false){
      	   	Swal.fire(
					  'No Selected Voter',
					  'Please select one or more to '+selecttrigger+'!',
					  'error'
					)
      	   }else {

      	    		   if(selecttrigger == 'verify'){
      	    	   Swal.fire({
        title: 'Mark all selected as Verified?',
        text: "The voters will be able to vote and escape viewing mode.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#36b9cc',
        cancelButtonColor: '#f6c23e',
        confirmButtonText: 'Yes, Mark as verified!'
      }).then((result) => {
        if (result.isConfirmed) {
        						 var xhttp = new XMLHttpRequest();
      	 	                	xhttp.onreadystatechange = function() {
      	 	                	 if (this.readyState == 4 && this.status == 200) {
      	 	                	const data = this.responseText;
      	 	                
      	 	                		Swal.fire(
								  'Voters Were Marked as Verified Successfully!',
								  '',
								  'success'
								)
      	 	                		 $('#managevoter').click();

      	 	                				       }
      	 	                				    };
      	 	                		xhttp.open("POST",$(this).attr('action'),true);
      	 	                		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	 	                		xhttp.send($(this).serialize());

        }

    })
      	    
      	    }else if (selecttrigger == 'revoke'){
      	    		Swal.fire({
					  title: 'Are you sure?',
					  text: "You Want to Revoke all SELECTED Voter at once?",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#e74a3b',
					  cancelButtonColor: '#f6c23e',
					  confirmButtonText: 'Yes, revoke it!'
					}).then((result) => {
					  if (result.isConfirmed) {
					    var xhttp = new XMLHttpRequest();
      	 	                	xhttp.onreadystatechange = function() {
      	 	                	 if (this.readyState == 4 && this.status == 200) {
      	 	                	const data = this.responseText;
      	 	                
      	 	                			Swal.fire(
								  'All selected Voters has been Revoked Successfully!',
								  'Voters that is fully verified will be revoked and have to be verify again',
								  'success'
								)
      	 	                		 $('#managevoter').click();
      	 	                				       }
      	 	                				    };
      	 	                		xhttp.open("POST",$(this).attr('action'),true);
      	 	                		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	 	                		xhttp.send($(this).serialize());
					  }
					})
      	    }
		 else if (selecttrigger == 'delete'){

      	    		Swal.fire({
					  title: 'Are you sure?',
					  text: "Do you want to delete all selected voter at once? You wont be able to recover this.",
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
								  'All selected Voters were Deleted Successfully!',
								  'Only Voters that is not yet verified will be removed from the system',
								  'success'
								).then((result) => {
					  if (result.isConfirmed) {
					  window.location.href="voters.php";
					  }
					});
      	 	                		
      	 	                				       }
      	 	                				    };
      	 	                		xhttp.open("POST",$(this).attr('action'),true);
      	 	                		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	 	                		xhttp.send($(this).serialize());
					  }
					})

      	    }
      	   }
      	


      	    			
      	    });

      	 $('#verifyit').click(function() { 
      	 	$('#selecttrigger').val('verify');
      	 
      	 })
      	 $('#revokeit').click(function() { 
      	 	$('#selecttrigger').val('revoke');
      	 })
      	 $('#deleteit').click(function() { 
      	 	$('#selecttrigger').val('delete');
      	 
      	 })

      	  
</script>