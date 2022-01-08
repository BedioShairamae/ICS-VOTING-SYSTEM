<?php 

	  $electid = $_SESSION['election_id'];
                            

                                     $selectwin = "select * from candidate where  pos_id = '$posid'  order by votes";
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

                                                       

                                                      }
                                                       ?>

                                                <tr>
                                                  <!--  <td class="">
                                                      <img src="<?php echo $imgsrc ?>" style="width: 140px;height: 140px; border:1px solid #19531e;margin-top: 5px;border-radius: 5px;" class="">
                                                      
                                                    </td>-->
                                                  
                                                    <td>
                                                      <?php 
                                                     
                                                        $course = " select * from course where courseid = '$courseid'  ";
                                          $resulta = mysqli_query($con,$course);
                                        
                                        
                                           while($getcourse = mysqli_fetch_array($resulta)){
                                      $crs= $getcourse['course'].'-';
                                      
                                           }

                                             $year = " select * from year where yearid = '$yearid'  ";
                                          $resultas = mysqli_query($con,$year);
                                        
                                        
                                           while($getyear = mysqli_fetch_array($resultas)){
                                      $yr= $getyear['year'];
                                           }
                          
                                            $sectionqry = " select * from section where sec_id = '$section' ";
                                          $resultsectionqry = mysqli_query($con,$sectionqry);
                                       
                                       
                                           while($getsec = mysqli_fetch_array($resultsectionqry)){
                                      $sc= $getsec['section'];
                                           }
                                    
                                                    

                             $prtylist = " select * from `partylist` where party_id = '$partylist' ";
                                          $resultprtylist = mysqli_query($con,$prtylist);
                                       
                                       
                                           while($getpt = mysqli_fetch_array($resultprtylist)){
                                     $pt= $getpt['partylist'];
                                           }

                                           $cys = $crs.'-'.$yr.$sc;

                                               $getname = " select * from position where pos_id = '$posid' and election_id ='$electid'  ";
                                                          $resultgetname = mysqli_query($con,$getname); 
                                                       
                                                           while($name = mysqli_fetch_array($resultgetname)){
                                                   
                                                    $posname = $name['pos_name'];
                                                    $nowinn = $name['pos_noofwinner'];
                                                    $countofvote = $name['maxvote'];
                                                           }
                                                    
                                           

                            ?>
                                                      <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false" class="electeddetails" data-name="<?php echo $fullname ?>" data-pos="<?php echo $posname ?>" data-advoc="<?php echo $advocacy  ?>" data-pt="<?php echo $pt ?>" data-sec="<?php echo $cys ?>" data-img="<?php echo $imgsrc ?>"><?php echo $fullname ?></a>
                                                    </td>
                                                   <!--<td>
                                                      <?php 
                                                      /*
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
                                           */

                            ?>

                                                    </td> -->
                                                    <td>
                                                       <?php 

                                                          $selectposition = "SELECT * FROM `position` where pos_id = '$posid'  ";
                                                                      $resultapos = mysqli_query($con,$selectposition); 
                                                                     
                                                                   
                                                                       while($rowget = mysqli_fetch_array($resultapos)){
                                                                        echo $rowget['pos_name'];
                                                                       }
                                                                
                                                      ?>
                                                    </td>

                                                    <td>
                                                      <?php 
                                                    // echo $votes;

                                                     // echo  $totalvotes;

                                                    ?>
                                                     
                                                       <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="<?php echo $ss ?>" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
                                                    </td>
                                                   

                                                </tr>
                                                <?php


                                              }

                                            }
                                

                                 $sum = array_sum($totalvotes);
                                // echo $sum;

                                

                                 for($i = 0 ; $i < count($totalvotes);$i++){
                                 // echo percentage($totalvotes[$i],$sum);

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

                               
                            
                              

 ?>