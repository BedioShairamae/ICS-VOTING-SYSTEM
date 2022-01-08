<?php 
	session_start();
	include 'connect.php';

	if(isset($_POST['getcontent'])){ 
		$id = $_POST['id'];
		$title = $_POST['title'];

      ?>
                  <h6 style="text-align: left;font-style: italic;"><?php echo $title ?></h6>
                   <button class="btn btn-success mb-2 fetchdata" type="button" style="font-size: 12px;float: right;" data-id="<?php echo $id ?>">Fetch all voters</button>
                  <br><br>
                  <?php

				$sql = " select * from student where election_id = '$id'  ";
		                $result = mysqli_query($con,$sql); // run query
		                $count= mysqli_num_rows($result); // to count if necessary
		               //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
		             if ($count>=1){
		             	//while($row = mysqli_fetch_array($result)){} is where we output all the data in database
		             	?>
                    <style type="text/css">
                  
                    .asxax::-webkit-scrollbar {
                          width: 1px;
                        }
                 </style>
		              <div class="asxax" style="height:300px;overflow-y: scroll;">
                  
		             	<?php
		                 while($row = mysqli_fetch_array($result)){
			?>
		

	 <ul class="list-group" style="text-align: left;">
      <li class="list-group-item"><?php echo $row['email'].'__'.$row['surname'].' '.$row['name'].' '.substr($row['middle_name'],0,1).'.' ?> <input type="checkbox"  style="float: right;" name="fetchselectedstudent[]" class="todesellect" value="<?php echo $row['s_id'] ?>"></li>
                              
                    
    </ul>


		<?php
		                 }
		                 ?>
                     </div> 
		                 	 <button class="btn btn-secondary mt-2 mb-2" type="submit" name="fetchselected" style="font-size: 12px;float: right;">Fetch selected</button>

                      <button class="btn btn-light  mt-2 mb-2 deselect" type="button" style="font-size: 12px;float: right;margin-right: 4px">Unselect</button>

                      <script type="text/javascript">
                      	
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

                      	  $('.deselect').click(function() { 
        $('.todesellect').prop('checked',false);
      })      
                            	
                      </script>
		                 <?php
		          }else {

		          }
		
	}

	if(isset($_POST['fetchselectedd'])){ 
		$fetchselectedstudent = $_POST['fetchselectedstudent'];
unset($_SESSION['emptydata']);
		for($i=0;$i< count($fetchselectedstudent);$i++){
		//	echo $fetchselectedstudent[$i];

			 $sql = " select * from student where s_id = '$fetchselectedstudent[$i]'  ";
                 $result = mysqli_query($con,$sql); // run query
                 $count= mysqli_num_rows($result); // to count if necessary
                //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
              if ($count>=1){
                
                  while($row = mysqli_fetch_array($result)){
                      $svid = $row['sv_id'];
                      $name = $row['name'];
                      $surname = $row['surname'];
                      $middle_name = $row['middle_name'];
                      $gender = $row['gender'];
                      $course = $row['course'];
                      $year = $row['year'];
                      $section = $row['section'];
                      $date_registered = $row['date_registered'];
                      $logintype = $row['logintype'];
                      $email = $row['email'];
                      $password = $row['password'];
                      $photo = $row['photo'];
                      $toupt = $row['toupdate'];
                     

                     $electionid = $_SESSION['electsched']; 

   $insert = "INSERT INTO `student`(`sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`, `year`, `section`, `date_registered`, `logintype`, `email`, `password`, `photo`, `election_id`, `voted`, `con`, `isverified`,`toupdate`) VALUES ('$svid','$name','$surname','$middle_name','$gender','$course','$year','$section','$date_registered','$logintype','$email','$password','$photo','$electionid',0,0,0,'$toupt')";
                      mysqli_query($con,$insert);

                  }
           }else {
                echo 'nodata';  
           }
		}
		
	}
 ?>