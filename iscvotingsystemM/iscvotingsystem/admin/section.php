<?php 
session_start();
include 'connection/fetch_data.php';
include 'connection/connect.php';
$fetch = new Fetch_data();
	
	if(isset($_POST['getsection'])){ 
		

		?>  <table class="table table-hover" id="table_idss">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Section</th>
                      <th scope="col">Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $fetch -> select_section();
                     ?>
                  </tbody>
                </table>

                <?php
	}

		if(isset($_POST['getsection1'])){ 
		

		?>  <table class="table table-hover" id="table_idss">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Section</th>
                      <th scope="col">Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $fetch -> select_section();
                     ?>
                  </tbody>
                </table>

                <?php
	}

	if(isset($_POST['deletethissection'])){ 
		$id = $_POST['id'];
				$sql = " DELETE From `section` WHERE sec_id = '$id'  ";
		                $result = mysqli_query($con,$sql); // run query
		               
		
	}
	if(isset($_POST['savenewsection'])){ 
		$txtsection = $_POST['txtsection'];
		date_default_timezone_set('Asia/Manila');
		$datenow = date('Y-m-d H:i:s');

				$sql = " INSERT INTO `section`(`section`, `date_registered`) VALUES ('$txtsection','$datenow') ";
		                $result = mysqli_query($con,$sql); // run query
		               

		
		
	}
	if(isset($_POST['savemodifiedsection'])){ 
		$txtsection = $_POST['txtsection1'];
		$scid = $_POST['scid'];

					$sql = "UPDATE `section` SET `section`='$txtsection' WHERE sec_id='$scid'  ";
			                $result = mysqli_query($con,$sql); // run query
			               
		
	}

 ?>

 <script type="text/javascript">
 	
 	$(document).ready(function() {
 		 

 	      	 $('.editsection').click(function() { 
                 var id = $(this).data('secid');
                 var section = $(this).data('section');
               	
                 $('#txtsection1').val(section);
                 $('#scid').val(id);

                  })

 	      	 $('.deletesection').click(function() { 
 	      	 	 var id = $(this).data('secid');
                 var section = $(this).data('section');
                
                 Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.isConfirmed) {

				    	 var xhttp = new XMLHttpRequest();
				    	xhttp.onreadystatechange = function() {
				    	 if (this.readyState == 4 && this.status == 200) {
				    	const data = this.responseText;
				    
				    		 Swal.fire(
						      'Section',
						      'Has been deleted Successfully!',
						      'success'
						    )
				    		
				    	section1();
				    				       }
				    				    };
				    		xhttp.open("POST", "section.php",true);
				    		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				    		xhttp.send("deletethissection=1&id="+id);
				    				
				          	      	 


				  }
				})


 	      	 
 	      	 })

 	      	 function section1(){
                      
                         var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                        const data = this.responseText;
                      
                       $('#sectioncontent').html(data);
                      
                                     }
                                  };
                          xhttp.open("POST", "section.php",true);
                          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                          xhttp.send("getsection1=1");
                              
                                       
                  }
 	      	
 	      });      
       	
 </script>