<?php 
session_start();
include 'admin/connection/connect.php';
 ?>
<!DOCTYPE html>
<html>

<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	 <!--<link rel="shortout icon" type="image/x-icon" href="">--> <!---->
    	  <script src="https://kit.fontawesome.com/129b086bc9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<title>Upload photo?</title>
<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap');
	body{
		background-color: #ced9cf;
 	font-family: 'Barlow Semi Condensed', sans-serif;
	}
</style>
</head>
<body>


	<?php //?>

		<div class="container mt-5">
		<div class="row">
				 <div class="col-md-3"></div> 
				  <div class="col-md-6">
				  	<div class="card shadow">
				  	  
				  	  <div class="card-body" id="form">
				  	  	 <form method="post" enctype="multipart/form-data" action="editwphoto.php" id="myimage" onsubmit="return false" >
				  	  	 	<input type="hidden" name="savetrigger">
				  	  	<h5 class="text-gray-800">Upload a Profile Picture</h5>
				  	   		 <div class="" style="text-align: center;"> 
				  	   		 
				  	  	<img src="undraw_voting_nvu7.png" style="height: 400px;width: 400px" class="img-thumbnail" id="configimage">
				  	  	</div>
				  	  	<br>
				  	  	<input type="file" name="imagename[]" id="image" class="form-control" required="">
				  	  	<br> 
				  	  	<button type="submit" style="float: right;" class="btn btn-success">Upload</button>
				  	  	<button type="button" id="skip" style="float: right; margin-right: 5px;" class="btn btn-secondary">Skip</button>

				  	  		<?php 
				  	  		if(isset($_GET['updateaccount_photo'])){
				  	  			$email = $_GET['email'];

				  	  		?>
				  	  		<input type="hidden" name="email" value="<?php echo $email ?>" id="email">
				  	  		<?php

				  	  				}
				  	  		 ?>
				  	  		
				  	  	 </form>
				  	  </div>
				  	</div>
				  </div> 
				  <div class="col-md-3"></div> 
				 

		</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			
			$(document).ready(function() {

					                    const inpfile = document.getElementById("image"); //id of input tag type file
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

			      	  	  $('#myimage').on('submit', function(event){
			      	           event.preventDefault();
			      	           var email = $('#email').val();
			      	         var formData = new FormData(this);
			      	        $.ajax({
			      	           url : $(this).attr('action'),
			      	             data:formData,
			      	              cache:false,
			      	              contentType: false,
			      	              processData: false,
			      	              method: "POST",
			      	                                                          
			      	             success : function(data){
			      	                   Swal.fire(
									  'Your Photo!',
									  'Was Uploaded Successfully!',
									  'success'
									).then((result) => {
									  /* Read more about isConfirmed, isDenied below */
									  if (result.isConfirmed) {
									    window.location.href="index.php?Registered_successfully&email="+email; 
									  } 
									})                            
			      	              }
			      	             })
			      	  });
			      	  	  $('#skip').click(function() { 
			      	  	  	 var email = $('#email').val();
			      	  	  	 window.location.href="index.php?Registered_successfully&email="+email; 
			      	  	  })
			      });      
		      	
		</script>


</body>
</html>