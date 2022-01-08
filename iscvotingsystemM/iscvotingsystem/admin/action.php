 <?php 
 session_start();
include 'connection/fetch_data.php';
include 'connection/connect.php';
  //Restrict Adding Same Entry Data
        if(isset($_POST['btnsave'])) {
                       $email = $_POST['txtmail'];
                          $name = $_POST['txtname'];
                          $surname = $_POST['txtsurname'];
                          $middlename = $_POST['txtinit'];
                          $gender = $_POST['gender'];
                          $year = $_POST['yr'];
                          $course = $_POST['txtcourse'];
                          $elecid =$_SESSION['electsched'];

        $svid = substr($email, 0, strpos($email,'@'));
        $course_year = $course .'-'.$year;
    date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');

    function createRandomPassword() { 

						    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
						    srand((double)microtime()*1000000); 
						    $i = 0; 
						    $pass = '' ; 

						    while ($i <= 7) { 
						        $num = rand() % 33; 
						        $tmp = substr($chars, $num, 1); 
						        $pass = $pass . $tmp; 
						        $i++; 
						    } 

						    return $pass; 

						} 
						$pass = createRandomPassword();

   $conditions = "`sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`,`year`, `date_registered`, `email`,`password`, `election_id`, `con`";
   $insertvalue = " '$svid','$name','$surname','$middlename','$gender','$course','$year','$datenow','$email','$pass','$elecid',1";
    $fetch = new Fetch_data();
    $fetch -> insertquery('student',$conditions,$insertvalue);
                
                      $sql = " select * from student where sv_id= '$svid'  ";
                       $result = mysqli_query($con,$sql); 
                      
                        while($row = mysqli_fetch_array($result)){
                            $defpass = $row['password'];
                        }
                       ?>
                             <input type="hidden" id="codsss" value="<?php echo $defpass;?>">
                                    <input type="hidden" id="emsss" value="<?php echo $email?>">  
                                     <script type="text/javascript">
                              
                                           var code = document.getElementById('codsss').value;
                                           var email = document.getElementById('emsss').value;
                                    
                                          loadDoc();
                                    
                                          function loadDoc() {
                                       var xhttp = new XMLHttpRequest();
                                      xhttp.onreadystatechange = function() {
                                       if (this.readyState == 4 && this.status == 200) {
                                      const data = this.responseText;
                                       
                                        // Your condition here if data success.
                                    
                                                   }
                                                };
                                        xhttp.open("GET", "../sendmail/emailsendpass.php?compare=1&code="+code+"&email="+email,true);
                                      
                                        xhttp.send();
                                            }
                                            
                                           
                                       
                
                                </script>
                       <?php
                        
                 
    
    
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
        New Voter <strong>Saved Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:voters.php');
        
        }

// REstrict duplicate entries upon updating check if data already exist especially svid
        if(isset($_POST['btnedit'])) {
           $email = $_POST['txtmail'];
                          $name = $_POST['txtname'];
                          $surname = $_POST['txtsurname'];
                          $middlename = $_POST['txtinit'];
                          $gender = $_POST['gender'];
                          $year = $_POST['yr'];
                          $course = $_POST['txtcourse'];
                          $sv_id = $_POST['svsid'];
                          $elecid =$_SESSION['electsched'];
                           $svid = substr($email, 0, strpos($email,'@'));
                          $course_year = $course .'-'.$year;
 
 $updatedvalues = "`sv_id`='$svid',`name`='$name',`surname`='$surname',`middle_name`='$middlename',`gender`='$gender',`course`='$course',`year`='$year',`email`='$email',`election_id`='$elecid'";
   $wherecondition = "s_id = '$sv_id'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('student',$updatedvalues,$wherecondition);
    
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
      Voter Data <strong>Updated Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:voters.php');
        }

//todo Must restrict check if this student is a candidate , if he/she is a candidate restrict deletion
        if(isset($_POST['deletestudent'])) {
          $id = $_POST['svid'];

                    $sql = " select * from student where s_id = '$id'  ";
                                $result = mysqli_query($con,$sql); 
                               
                            
                                 while($row = mysqli_fetch_array($result)){
                                      $file = $row['photo'];
                                 }
                             $filename = "../upload/".$file   ;
                             unlink($filename); 
                          
           $wherecondition = " `s_id` = '$id' ";
   $fetch = new Fetch_data();
    $fetch -> deletequery('student',$wherecondition);
     $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       Voter <strong>Deleted Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:voters.php');
        }
   


//Todo Restrict adding if inserted data already exist
if (isset($_POST['savepos'])) {
  $posname = $_POST['txtposname'];
  $txtmaxcandidate = $_POST['txtmaxcandidate'];
  $txtnoofwinner = $_POST['txtnoofwinner'];
  $txtnovote = $_POST['txtnovote'];
  date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');
   $elecid =$_SESSION['electsched'];
    $conditions = "`pos_name`, `pos_noofwinner`, `pos_maxcandidate`,`maxvote`, `date_registered`, `election_id`";
   $insertvalue = "'$posname','$txtnoofwinner','$txtmaxcandidate','$txtnovote','$datenow','$elecid'";
    $fetch = new Fetch_data();
    $fetch -> insertquery('position',$conditions,$insertvalue);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
        New Position <strong>Saved Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:position.php');}

//Todo Restrict Update if inserted data already exist
if (isset($_POST['saveeditpos'])) {
  $posname = $_POST['txtposname'];
  $txtmaxcandidate = $_POST['txtmaxcandidate'];
  $txtnoofwinner = $_POST['txtnoofwinner'];
  $posid = $_POST['posid'];
  $txtnovote = $_POST['txtnovote'];
  $txtcandidatecount = $_POST['txtcandidatecount'];
  date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');

  if($txtmaxcandidate >= $txtcandidatecount ) {
      $updatedvalues = "`pos_name`='$posname',`pos_noofwinner`='$txtnoofwinner',`pos_maxcandidate`='$txtmaxcandidate' ,`maxvote`='$txtnovote'";
   $wherecondition = "pos_id = '$posid'";
    $fetch = new Fetch_data();
    $fetch -> updatequery('position',$updatedvalues,$wherecondition);
      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       Position <strong>Updated Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
  }else {
     $_SESSION['action'] = '   <div class="alert alert-danger" id="alerto" role="alert">
      <strong>Unable to Update. </strong> The No of Candidate in Current Position is greater than inputted Number! Try a higher number.
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },15000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
  }
   

      header('location:position.php');


      }


//Todo Restrict Deletion if Data of this position already Exist
if(isset($_POST['btndeletepos'])) {
  $posid= $_POST['posid'];
 
  $wherecondition = " `pos_id` = '$posid' ";
   $fetch = new Fetch_data();
    $fetch -> deletequery('position',$wherecondition);
     $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       Position <strong>Deleted Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:position.php');
}

if(isset($_POST['savecan'])) {
 
$advocacy = $_POST['advocacy'];
$posid = $_POST['posid'];
$svid = $_POST['svid'];
$partylist = $_POST['partylist'];



   date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');
   $elecid =$_SESSION['electsched'];
    $conditions = "`sv_id`, `pos_id`, `advocacy`, `date_registered`, `election_id`,`partylist`";
   $insertvalue = "'$svid','$posid','$advocacy','$datenow','$elecid','$partylist'";
    $fetch = new Fetch_data();
    $fetch -> insertquery('candidate',$conditions,$insertvalue);

    $conditions1 = " `sv_id`, `posid`, `election_id`,`advocacy`,`partylist`";
   $insertvalue1 = "'$svid','$posid','$elecid','$advocacy','$partylist' ";
    $fetch -> insertquery('temp_votes',$conditions1,$insertvalue1);

      $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
       Candidate <strong>Saved Successfully!</strong>
      </div>
      <script type="text/javascript">
        
        var times = setInterval(function() {
          document.getElementById("alerto").classList.add("d-none");
           clear();
        },3000);

        function clear() {
          clearInterval(times);
        }     
              
      </script>';
      header('location:candidates.php');

}


///Manage partylist

  if(isset($_POST['partylistcontent'])){ 

      ?>
         <table class="table table-striped" id="table_ids">
  <thead class="thead-dark">
    

    <tr>
      <th scope="col">No</th>
       <th scope="col">Partylist</th>
        <th scope="col">Date Created</th>
       <th scope="col" >Action</th>
    </tr>
 


  </thead>
  <tbody>
    <?php
     $elecid =$_SESSION['electsched'];
            $sql = " SELECT * FROM `partylist` where election_id = '$elecid' ";
                        $result = mysqli_query($con,$sql); // run query
                        $count= mysqli_num_rows($result); // to count if necessary
                       //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                     if ($count>=1){
                       //while($row = mysqli_fetch_array($result)){} is where we output all the data in database
                         while($row = mysqli_fetch_array($result)){
                      ?>
                      <tr>
                        <td><?php echo $row['party_id'] ?></td>
                        <td><?php echo $row['partylist'] ?></td>
                        <td><?php echo date('h:i:sa F j,  Y ',strtotime($row['date_created']));  ?></td>
                        <td>
                          
                           <div class="btn-group" role="group" aria-label="Basic example">
              <button  class="btn btn-warning btneditpt" data-pid="<?php echo $row['party_id']?>" data-name="<?php echo $row['partylist']?>"  data-toggle="modal" data-target="#editpt" style="font-size: 10px;"><i style="font-size: 15px;" class="fas fa-pen"></i></button> 

             
                <button class="btn btn-danger btndeletept" data-pid="<?php echo $row['party_id']?>" style="font-size: 10px;"><i style="font-size: 15px;" class="far fa-times-circle"></i></button>
                
            
              

              
                         </div>
                         
                        </td>
                      </tr>
                      <?php
                         }
                  }
       

    ?>
  </tbody>
</table>
     
      <?php
    
  }
  if(isset($_POST['positioncontent'])){ 
      ?>
       <table class="table table-striped" id="table_id">
  <thead class="thead-dark">
    

    <tr>
      <th scope="col">Position-Name</th>
       <th scope="col">Maximum Numbers of Winners</th>
        <th scope="col">Maximum-vote to cast per voters</th>
      <th scope="col">Maximum-Candidates allowed</th>
    
      <th scope="col">No# of Candidates in current position</th>
      <th scope="col">Date-Modified</th>
     
       <th scope="col" >Action</th>
    </tr>
 


  </thead>
  <tbody>
    <?php
     
      $fetch = new Fetch_data();
      $fetch -> select_position();
       

    ?>
  </tbody>
</table>
      <?php
  }

if(isset($_POST['savepartylist'])){ 
  $partylist = $_POST['partylist'];
  $elecid =$_SESSION['electsched'];
  date_default_timezone_set('Asia/Manila');
  $datenow = date('Y-m-d H:i:s');

          $sql = " INSERT INTO `partylist`(`partylist`, `date_created`, `election_id`) VALUES ('$partylist','$datenow','$elecid')  ";
                      $result = mysqli_query($con,$sql); // run query

                  
                    
  
}

if(isset($_POST['saveeditpartylist'])){ 
  $partylist = $_POST['partylist'];
  $id = $_POST['id'];

            $sql = "UPDATE `partylist` SET`partylist`='$partylist' WHERE party_id='$id'  ";
                        $result = mysqli_query($con,$sql); // run query
                      

  
}
if(isset($_POST['deletept'])){ 
  $val = $_POST['val'];
        $sql = " DELETE FROM `partylist` WHERE party_id='$val'  ";
                    $result = mysqli_query($con,$sql); // run query
                   
}


if(isset($_POST['addtime'])){ 
  $duration = $_POST['duration'];
  $length = $_POST['length'];

        $selectactive = " select * from election_sched where status = 'active'  ";
        $resultselect = mysqli_query($con,$selectactive); 
                              
         while($active = mysqli_fetch_array($resultselect)){
             
               $eventend = $active['eventend'];   
                     
         }
$elecid =$_SESSION['electsched'];



  if ($duration == 'days'){
  $mod_date = strtotime($eventend."+".$length." days");
   $indays = date("Y-m-d H:i:s",$mod_date);
  
   $upt = "UPDATE `election_sched` set `eventend` = '$indays' where election_id = '$elecid'  ";
   mysqli_query($con,$upt);

  }else if ($duration == 'hours'){
     $mod_date1 = strtotime($eventend."+".$length." hour");
   $inhours = date("Y-m-d H:i:s",$mod_date1);
   
    $upt1 = "UPDATE `election_sched` set `eventend` = '$inhours' where election_id = '$elecid'  ";
   mysqli_query($con,$upt1);

  }else if ($duration == 'minutes'){

    $mod_date2 = strtotime($eventend."+".$length." minute");
   $inminutes = date("Y-m-d H:i:s",$mod_date2);
 

    $upt2 = "UPDATE `election_sched` set `eventend` = '$inminutes' where election_id = '$elecid'  ";
   mysqli_query($con,$upt2);
     

  }




     /* $sql = " select * from database where data = '$datainputted'  ";
                  $result = mysqli_query($con,$sql); // run query*/
        
}




       ?>

       <script type="text/javascript">
         $(document).ready(function() {
            $('#table_id').DataTable();
             $('#table_ids').DataTable();

              $('.btndeletept').click(function() { 
              var id = $(this).data('pid');
             

                    Swal.fire({
                title: 'Are you sure?',
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
                    'Partylist has been deleted.',
                    'success'
                  )
                      partylist();
                  
                                 }
                              };
                      xhttp.open("POST", "action.php",true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                      xhttp.send("deletept=1&val="+id);
                          
                                   



                
                }
              })
        })
              $('.btneditpt').click(function() { 
               var pt = $(this).data('name');
               var id = $(this).data('pid');
               $('#partylistval').val(pt);
               $('#partylistid').val(id);
              })

               function partylist(){
      var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
              const data = this.responseText;
            
                // Your condition here if data success.
            $('.partylistcontent').html(data);
            
                           }
                        };
                xhttp.open("POST", "action.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("partylistcontent=1");
    }
         });
       </script>
       <?php include 'include/modal/position_modal.php'?>
