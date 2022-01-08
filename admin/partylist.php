 <div class="btn-group" role="group" aria-label="Basic outlined example">
  
 
     
    <a type="button" class="btn btn-outline-success mt-3" href="candidates.php?Partylist&sortbypt=1&partylist=Independent" style="font-size: 13px"  >
              Independent <i class="fas fa-share"></i>
            </a>

                     
                       
                  
                   <?php


                   include 'connection/connect.php';
                   $electionid = $_SESSION['electsched'];
                $sql = " select * from partylist where election_id='$electionid'  ";
                            $result = mysqli_query($con,$sql); 
                            $count= mysqli_num_rows($result); 
                          if($count >= 1){
                             while($row = mysqli_fetch_array($result)){
                          
                        ?>
             
            <a type="button" class="btn btn-outline-success mt-3" href="candidates.php?Partylist&sortbypt=<?php echo $row['party_id'] ?>&partylist=<?php echo $row['partylist']; ?>" style="font-size: 13px"  >
              <?php echo $row['partylist']; ?> <i class="fas fa-share"></i>
            </a>


                        
                        <?php
                             }
                         }else {
                         	?>
                         	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                         	<script type="text/javascript">
                         		
                         	/*	Swal.fire(
							  'No Partylist Set!',
							  'All of the candidates shown were campaigning on their own.',
							  'info'
							).then((result) => {
								  if (result.isConfirmed) {
								  // window.location.href="candidates.php";
								  }
								})      */
                         	      	
                         	</script>	
                         	<?php
                         }




                   ?>
        </div>



         <div class="container mt-3">
         	<?php 
         	  if(isset($_GET['sortbypt'])){ 
         	  	$partylist = $_GET['sortbypt'];
         	  	$ptname = $_GET['partylist'];
                ?>
                  <table class="table table-hover">
  <thead>
    <tr>
    	 <th scope="col">Partylist</th>
       <th scope="col">Position</th>
      <th scope="col">Student-ID</th>
      <th scope="col">Whole Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Course & Year</th>
     
    </tr>
  </thead>
  <tbody>

    <?php
   
        $elecid = $_SESSION['electsched'];
         
                  $sql = " select * from candidate where election_id= '$elecid' and partylist='$partylist' ";
                              $result = mysqli_query($con,$sql); 
                              $count= mysqli_num_rows($result); 
                            
                        if($count >= 1) {
                        	?>
                        	<span style="font-weight: bold;font-style: italic;">↔<?php echo $ptname ?>↔</span>
                        	<?php
                               while($row = mysqli_fetch_array($result)){
                                $cid =  $row['cid'];
                                $sud = $row['sv_id'];
                                $posid = $row['pos_id'];
                                $partyid = $row['partylist'];
                                      ?>
                        <tr>

                        	  <th scope="row"><span class="text-primary">
                        	  	<?php 
                        	    $elecid =$_SESSION['electsched'];
                 
                         
                                    $sqlpt = " SELECT * FROM `partylist` WHERE election_id = '$elecid' and party_id = '$partyid' or party_id='1' ";
                                                $resultpt = mysqli_query($con,$sqlpt); // run query
                                              
                                            
                                           
                                               
                                                 while($rows = mysqli_fetch_array($resultpt)){
                                             $pt = $rows['partylist'];
                                             echo $pt;
                                          }
                        	  	 ?>

                        	  </span>
                        	</th>

                       <th scope="row"><span style="color: green">
                         <?php
                                    $sqlpos = " select * from position where pos_id= '$posid' and election_id= '$elecid'  ";
                                                $resultpos = mysqli_query($con,$sqlpos); 
                                              
                                                 while($pos = mysqli_fetch_array($resultpos)){
                                    echo $pos['pos_name'];
                                                 }
                                          
                         ?>
                       </span></th>

                       <?php
                           $sqlstud = " select * from student where s_id= '$sud' and election_id= '$elecid' ";
                                                $resultstud = mysqli_query($con,$sqlstud); 
                                              
                                                 while($stud = mysqli_fetch_array($resultstud)){
                                                  $wholename = $stud['surname'].' '.$stud['name'].' '.$stud['middle_name'];
                                                  $courseid = $stud['course'];
                                                 $yearid = $stud['year'];
                                                 $section = $stud['section'];
                                                ?>
                                                <th scope="row"><?php echo $stud['sv_id']; ?></th>
                                          <td><?php echo $wholename ?></td>
                                          <td><?php echo $stud['gender']; ?></td>
                                            <td><?php 
                              $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      echo $getcourse['course'];
                                      
                                           }
                                    

                          echo '-'; 

                          $year = " select * from year where yearid = '$yearid'  ";
                                          $resultas = mysqli_query($con,$year);
                                        
                                        
                                           while($getyear = mysqli_fetch_array($resultas)){
                                      echo $getyear['year'];
                                           }
                          
                                             $sectionqry = " select * from section where sec_id = '$section' ";
                                          $resultsectionqry = mysqli_query($con,$sectionqry);
                                       
                                       
                                           while($getsec = mysqli_fetch_array($resultsectionqry)){
                                      echo $getsec['section'];
                                           }

                           ?></td>
                                         
                                                <?php
                                                 }

                                                  
                       ?>
                      
                     
                    </tr>

                        <?php
                               }
                             }else {
                              ?>
                                <tr >
                                  <td colspan="7" style="text-align: center;font-weight: bolder;">No <span style="color:red">Candidates</span> in this Partylist Yet</td>
                                </tr>
                                <tr> <span style="font-weight: bold;font-style: italic;">↔<?php echo $ptname ?>↔</span></tr>
                              <?php
                             }
                        
     
    ?>
    
   

  
  </tbody>
</table>


                <?php  
                      	
                 }else {
                 	?>
                 	
                 	 	<h6 class="text-secondary" style="text-align: center;">↔Please Select one to show↔</h6>
                 	
                 	 
                 	<?php
                 }
         	 ?>
         </div> 
         