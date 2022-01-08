<?php 
 session_start();
 
                    
                    if(isset($_POST['compare'])) {
                         include 'admin/connection/connect.php';
                    	
                    	$currentpass = $_POST['currentpass'];
                         $studid = $_SESSION['voter_login'];

                                        $sql = " select * from student where s_id = '$studid'  ";
                                              $result = mysqli_query($con,$sql);
                                              $count= mysqli_num_rows($result);
                                            
                                           
                                               while($row = mysqli_fetch_array($result)){
                                                 $defaultpass= $row['password']; 
                                               }
                                        

                    		if($currentpass == $defaultpass) {
                    			echo 'success';
                    		}else {
                    		
                    			echo 'fail';
                    		}
                    	


                    }

                    if(isset($_POST['savenewpass'])){
                          include 'admin/connection/connect.php';
                         $txtnew = $_POST['txtnew'];

                               $studid = $_SESSION['voter_login'];

                                        $sql = " UPDATE `student` SET `password`='$txtnew' , `con`=0  WHERE s_id = '$studid'  ";
                                              $result = mysqli_query($con,$sql);
                                            if($result) {
                                             $_SESSION['alerto'] = '<div class="alert alert-primary" id="noti" role="alert" style="text-align: center;">
                      <strong >Password changed Successfully!</strong>
                    </div>
                    <script type="text/javascript">
                      
                      var timer =setInterval(function(){
                        document.getElementById("noti").classList.add("d-none");
                        clearInterval(timer);
                      },3000);      
                            
                    </script>';
                    header("location:myaccount.php");
                                            }
                    }

?>