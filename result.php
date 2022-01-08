<?php
session_start();
 include 'include/header.html';
	include 'admin/connection/connect.php';
$selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                 							
         while($active = mysqli_fetch_array($resultselect)){
               $electid = $active['election_id'];
               $checken = $active['voterlogin'];
               	$eventstart = $active['eventstart'];
				  $eventend = $active['eventend'];	
				  $elecyear = $active['year'];
				  $elecsem = $active['semester'];
               }
              

              
				 $dateandtime = date("Y-m-d H:i:s");
				
            
 ?>
			<body style="background-color: rgb(217, 217, 217);" >
			
				
		
<style type="text/css">
	.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1.5s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { top:-100px; opacity:1} 
  to { top:0px; opacity:0 }
}

@keyframes animatebottom { 
   0% {
              transform: translate(0%,0%) scale(0);
            }
             50% {
              transform: translate(0%,0%) scale(1.2);
            }

             70% {
              transform: translate(0%,0%) scale(0.95);
            }

              95% {
              transform: translate(0%,0%) scale(1.1);
            }

             100% {
              transform: translate(0%,0%) scale(1);
            }
}


	.sink {
  position: relative;
  -webkit-animation-name: animatecandidate;
  -webkit-animation-duration: 2s;
  animation-name: animatecandidate;
  animation-duration: 2s
}

@-webkit-keyframes animatecandidate {
  from { top:-100px; opacity:0 } 
  to { top:0px; opacity:1 }
}

@keyframes animatecandidate { 
  from{ opacity:0 } 
  to{  opacity:1 }
}
.opacity {
	opacity: 0;
}
.shad:hover {
	box-shadow: 10px 10px 5px grey;
}
</style>
<style>
/* width */
::-webkit-scrollbar {
  width: 5px;
 background-color: red;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
            


				<div class="container" style="margin-top: 5px; cursor: default;">
					<p><br></p>
				     	<div class="card" style="border-top: 5px solid #2a5427;border-bottom: 5px solid #2a5427">
				     		 <div class="container">
				     		 	<?php
				     		 	include 'admin/connection/connect.php';
				     		 
				     		 		
									unset($_SESSION['voter_login']);

									$selectactive = " select * from election_sched where status = 'active'  ";
					        $resultselect = mysqli_query($con,$selectactive); 
					                 							
					         while($active = mysqli_fetch_array($resultselect)){
					               $electid = $active['election_id'];
					               $checken = $active['voterlogin'];
					               	$eventstart = $active['eventstart'];
									  $eventend = $active['eventend'];	
									  $elecyear = $active['year'];
									  $elecsem = $active['semester'];
									   $title = $active['title'];
					               }
				     		 		?>
				     		 		<p></p>
				     		 		
				     		 		 
				     		 		<!--animate-bottom-->
				     		 			 <div class="">
				     		 		 

				     		 		 </div> 
				     		 			 <div class="winners">
				     		 			 	<div class="row">
				     		 			 		<div class="col-sm-2"></div>
				     		 			 		<div class="col-sm-8" >

				  	<h4 style=" ">Here are the Winners! <br>   ❝ <span style="font-weight: bolder;"><?php echo $title ?>   <?php

            if ($elecsem == '1'){
               echo $elecsem.'st'; 
            }else if ($elecsem == '2'){
              echo $elecsem.'nd'; 
            }

            ?> Semester  Year <?php echo $elecyear.'-'.$elecyear+1 ?></span>❞</h4>

				     		 			 			 <div class="card " style="margin-top: 20px;">
				     		 			 			 	<div class="card-body">
				     		 			 			 		<h5>Elected Candidates</h5>
				     		 			 			 		<hr>

				     		 			 			 		<table class="table table-striped">
																  <thead>
																    <tr>
																      <th scope="col">Position</th>
																      <th scope="col">Name</th>
																      <th scope="col">Course,Year and Section</th>
																      <th scope="col">Partylist</th>
																      <th scope="col">Received votes</th>
																    </tr>
																  </thead>
																  <tbody>
																   
																    <!--<tr>
																      <th scope="row">Mayor</th>
																      <td>Larry</td>
																      <td>the Bird</td>
																      <td>@twitter</td>
																    </tr>-->

																    <?php 

																    $electid = $_SESSION['election_id'];
				     		 			 			
 $getname = " select * from position where pos_id  IN (SELECT pos_id FROM candidate) and election_id ='$electid'  ";
                                 $resultgetname = mysqli_query($con,$getname); 
                                  $counter= mysqli_num_rows($resultgetname); 
                                  if($counter >= 1) {



                                   while($name = mysqli_fetch_array($resultgetname)){
                                                  
                                    $posname = $name['pos_name'];
                                    $nowinn = $name['pos_noofwinner'];
                                    $countofvote = $name['maxvote'];
                                    $posid = $name['pos_id'];
                                    $ppp= true;
                                    	//$totalvotes = 0;
                                     $selectwin = "select * from candidate where  pos_id = '$posid'  order by votes desc limit $nowinn ";
                                             $resultwin = mysqli_query($con,$selectwin); 
                                             $counterwin= mysqli_num_rows($resultwin);  
                                             if($counterwin >=1 ) {
                                              while($winner = mysqli_fetch_array($resultwin)){ 
                                                $winvotes= $winner['votes'];
                                                $votes =  $winner['votes'];
                                                $totalvotes[]= $winner['votes'];
                                          $s_id = $winner['sv_id'];
                                                $posid = $winner['pos_id'];
                                                $advocacy = $winner['advocacy'];
                                                $voters = $winner['voters'];
                                                $cid = $winner['cid'];
                                                $partylist = $winner['partylist'];

                                                 $getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
                                     $resultgetstud = mysqli_query($con,$getstud); 
                                                       
                                       while($uname = mysqli_fetch_array($resultgetstud)){
                                                            $src = "../upload/";
                                                            $photo = $uname['photo'];
                                                            $gender = $uname['gender'];
                                                              $section = $uname['section'];
                                                              $ss= $uname['s_id'];
                                                              $ssid[]= $uname['s_id'];
                                                          
                                                            if($photo == ''){

                                                                  if($gender == 'male'){
                                                                       $imgsrc = "upload/undraw_profile_pic_ic5t.png";
                                                                    }else {
                                                                        
                                                                        $imgsrc = "upload/undraw_female_avatar_w3jk.png";
                                                                    }
                                                            }else {
                                                                $imgsrc = $src.$uname['photo'];
                                                            }
                                                            $fullname = $uname['surname'].' '.$uname['name'];
                                                            $courseid = $uname['course'];
                                                  $yearid = $uname['year'];

                                                    
                                                    }
                                                       if ($votes == 0) { 



                                                      }else {

                                                        ?>

                                                <tr>
                                                  <!--  <td class="">
                                                      <img src="<?php echo $imgsrc ?>" style="width: 140px;height: 140px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" class="">
                                                      
                                                    </td>-->
                                                    <td>
                                                      <?php echo $posname ?>
                                                    </td>
                                                    <td>
                                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" class="electeddetails" data-name="<?php echo $fullname ?>" data-pos="<?php echo $posname ?>" data-advoc="<?php echo $advocacy  ?>" data-img="<?php echo $imgsrc ?>"><?php echo $fullname ?></a>
                                                    </td>
                                                    <td>
                                                      <?php 
                                                        $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      echo $getcourse['course'].'-';
                                      
                                           }

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
                                    
                                                       ?>
                                                    </td>

                                                    <td>
                                                        <?php 

                             $prtylist = " select * from `partylist` where party_id = '$partylist' ";
                                          $resultprtylist = mysqli_query($con,$prtylist);
                                       
                                       
                                           while($getpt = mysqli_fetch_array($resultprtylist)){
                                      echo $getpt['partylist'];
                                           }

                            ?>

                                                    </td>

                                                    <td>
                                                      <?php 
                                                    // echo $votes;

                                                     // echo  $totalvotes;

                                                       ?>
                                                     
                                                       <div class="progress">
							  <div class="progress-bar" id="<?php echo $ss ?>" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
                                                    </td>
                                                   

                                                </tr>
                                                <?php

                                                      }


                                              }

                                            }
                                  }



                                }

                                 $sum = array_sum($totalvotes);
                                // echo $sum;

                                

                                 for($i = 0 ; $i < count($totalvotes);$i++){
                                 	 //echo percentage($totalvotes[$i],$sum);

                                 	// echo $ssid[$i];
                                 	?>
                                 	<script type="text/javascript">
                                 		
                                 		$(document).ready(function() {
                                 		      	$('#<?php echo $ssid[$i]?>').css('width',<?php echo percentage($totalvotes[$i],$sum); ?>+'%');
                                 		      	$('#<?php echo $ssid[$i]?>').html(<?php echo percentage($totalvotes[$i],$sum); ?>+'%');
                                 		      });      
                                 	      	
                                 	</script>
                                 	<?php
                                 }

                                 function percentage($num_amount, $num_total){
                                 $count1 = $num_amount / $num_total; 
                                 $count2 = $count1 * 100; 
                                 $count = number_format($count2, 0); 
                                 return $count;

                                 }
                            
                              



																     ?>


																  </tbody>
																</table>

				     		 			 			 	</div>
				     		 			 			 </div> 

				     		 			 			 <script type="text/javascript">
				     		 			 			 	
				     		 			 			 	$(document).ready(function() {
				     		 			 			 	      	$('.electeddetails').click(function() { 
				     		 			 			 	      		var name = $(this).data('name');
				     		 			 			 	      		var pos = $(this).data('pos');
				     		 			 			 	      		var advoc = $(this).data('advoc');
				     		 			 			 	      		var src = $(this).data('img');
				     		 			 			 	      		$('#pos').text(pos);
				     		 			 			 	      		$('#name').text(name);
				     		 			 			 	      		$('#advoc').text(advoc);
				     		 			 			 	      		$('#imgsrc').attr('src',src);
				     		 			 			 	      	
				     		 			 			 	      	})
				     		 			 			 	      });      
				     		 			 			       	
				     		 			 			 </script>
				     		 			 			 
				     		 			 			
				     		 			 			 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				     		 			 			   <div class="modal-dialog" role="document">
				     		 			 			     <div class="modal-content">
				     		 			 			       <div class="modal-header">
				     		 			 			       
				     		 			 			       </div>
				     		 			 			       <div class="modal-body">
				     		 			 			         <div class="container" style="text-align: center;">
				     		 			 			         	<span class="badge badge-success bg-success" style="float: left;">ELECTED <span style="text-transform: uppercase;" id="pos">MAYOR</span></span>
				     		 			 			         	<br>

															<img src="https://www.nicepng.com/png/full/136-1366211_group-of-10-guys-login-user-icon-png.png" class="rounded-circle img-thumbnail" id="imgsrc" style="width: 100px; height: 100px">
															<br>
															<span style="font-size: 13px;font-weight: bold" id="name">CAIMOR REENJAY</span>
															<br>
															<span style="font-size: 13px;float: left;" >Advocacy:</span>

															<br>
															<span id="advoc" style="font-size: 13px;text-align: left;">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
																tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
																quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
																consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
																cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
																proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
															</span>
				     		 			 			         	
				     		 			 			         </div> 
				     		 			 			      				     		 			 			 
				     		 			 			 
				     		 			 			        
				     		 			 			       </div>
				     		 			 			       <div class="modal-footer">
				     		 			 			         <button type="button" class="btn btn-light border border-primary" style="font-size:12px" data-dismiss="modal">Close</button>
				     		 			 			       
				     		 			 			       </div>
				     		 			 			     </div>
				     		 			 			   </div>
				     		 			 			 </div>

				     		 			 			<!--
				     		 			 		<?php 
				     		 			 		$electid = $_SESSION['election_id'];
				     		 			 			

			                    	$getname = " select * from position where pos_id  IN (SELECT pos_id FROM candidate) and election_id ='$electid'  ";
			                    			 $resultgetname = mysqli_query($con,$getname); 
			                    				$counter= mysqli_num_rows($resultgetname); 
			                    				if($counter >= 1) {



			                    				 while($name = mysqli_fetch_array($resultgetname)){
			                    												
			                    					$posname = $name['pos_name'];
			                    					$nowinn = $name['pos_noofwinner'];
			                    					$countofvote = $name['maxvote'];
			                    					$posid = $name['pos_id'];
			                    					?>
			                	 <div class="row">
				     		 
				     		 		<h5 style="text-transform: uppercase;font-weight: bolder;"><?php echo $posname ?></h5>
			                    					<?php
			                    					$selectwin = "select * from candidate where  pos_id = '$posid'  order by votes desc limit $nowinn ";
			                    									 $resultwin = mysqli_query($con,$selectwin); 
			                    									 $counterwin= mysqli_num_rows($resultwin);	
			                    									 if($counterwin >=1 ) {}
			                    									 	while($winner = mysqli_fetch_array($resultwin)){ 
			                    									 		$winvotes= $winner['votes'];
			                    									 		$votes =  $winner['votes'];
								     		 			 						$s_id = $winner['sv_id'];
															                 	$posid = $winner['pos_id'];
															                 	$advocacy = $winner['advocacy'];
															                 	$voters = $winner['voters'];
															                 	$cid = $winner['cid'];
															                 	$partylist = $winner['partylist'];

			                    									 		

			                    					$getstud= " select * from student where s_id = '$s_id' and election_id = '$electid'  ";
			                    				   $resultgetstud = mysqli_query($con,$getstud); 
			                    								             
			                    						 while($uname = mysqli_fetch_array($resultgetstud)){
			                    								                 	$src = "upload/";
			                    								                 	$photo = $uname['photo'];
			                    								                 	$gender= $uname['gender'];
			                    								                 	
			                    								          		if($photo == '') {
			                    								                 	
			                    								                 		if($gender == 'male'){
                            						                                          	$imgsrc  = "upload/undraw_profile_pic_ic5t.png";
                            						                                        }else {
                            						                                            
                            						                                          	$imgsrc  = "upload/undraw_female_avatar_w3jk.png";
                            						                                        }
			                    								                 	}else {
			                    								                 		$imgsrc = $src.$uname['photo'];
			                    								                 	}
			                    								                 	
			                    					
			                    								                 
			                    								                 	$fullname = $uname['surname'].' '.$uname['name'];
			                    								                 	$courseid = $uname['course'];
				 	 	                 											$yearid = $uname['year'];
				 	 	                 											$section = $uname['section'];
			                    													
			                    													}
			                    											
			                    									 ?>

			                    	
				     		 	<div class="card shadow" id="sink" style="height: 730px;">
						            
			                   <img class="card-img-top img-thumbnail" style="height: 450px;" width="100%" src="<?php echo $imgsrc ?>" alt="Card image cap" >
						  <div class="card-body">
						    <h5 class="card-title " style="font-weight: bolder; margin-left: 80px; ">
						    	<?php echo $fullname ?>
						    <span class="positions" style="float: right;">
						    	<span>Elected <span style="text-transform: uppercase; "><?php echo $posname ?></span></span>
			                    			

			                    						</span>
						</h5>
						    <h6 style="font-size: 15px; text-align: center;">
						    				<?php 
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
										       ?>
										      <br>
										      PARTYLIST :<br>
										       <span style="font-weight: bold;">
										       	<?php 

										       	 $prtylist = " select * from `partylist` where party_id = '$partylist' ";
							                            $resultprtylist = mysqli_query($con,$prtylist);
							                         
							                         
							                             while($getpt = mysqli_fetch_array($resultprtylist)){
							                     		echo $getpt['partylist'];
							                             }

										        ?></span>	
						    		
						    </h6>
			                    								                 	
						 
						  	 <div class="container" style="overflow-y: scroll;height:120px; border: 1px solid #c9cdca;border-radius:5px"> 
						  	 
						    <p class="card-text"><?php echo $advocacy ?>
						
						    Not sure what you're going to do with love this icon now you've found it? Check out our guide on getting started. Or deep dive into how to use a specific styling trick or method in our docs.
						    Not sure what you're going to do with love this icon now you've found it? Check out our guide on getting started. Or deep dive into how to use a specific styling trick or method in our docs.
						    Not sure what you're going to do with love this icon now you've found it? Check out our guide on getting started. Or deep dive into how to use a specific styling trick or method in our docs.
						</p>
						
						    </div>
						     <h5 style="float: left;" class="mt-2">Votes Received : <?php echo $votes ?></h5>
						   
						  </div>
						 	
						
						</div>
						<p></p>
						

			                    									 <?php





			                    									 	}
			                    									 	echo '</div>';


			                    					 }
			                    					}else {
			                    						echo 'no candidate';
			                    					}
				     		 			 				          
				     		 			 		          


				     		 			 		          
				     		 			 		?>	
				     		





				     		 			 		</div>
				     		 			 		<div class="col-sm-2"></div> -->

				     		 			 	</div>
				     		 			 	
				     		 			 	 
				     		 			 </div> 
				     		 			 
				     		 		<p></p>
				     		 		<?php
				     		 
				     		 	?>
				     		 	
				     		 </div> 
				     		 	
				     	</div>
				     	<p><br></p>
			 </div> 
				

		 	
				
	 		<script type="text/javascript">
	 			
	 			function myFunction() {
			
			$('.card').addClass('sink');
			}     

			$(window).scroll(function() {
				
    if ($(this).scrollTop() < 100) {
	 	
		    }
		}); 
	 		      	
	 		</script>
		 	





			</body>
	
<?php include 'include/footer.html'?>
