<?php
session_start();
include 'connection/connect.php';
include 'connection/fetch_data.php';
if(isset($_POST['compare'])) {
    $val = $_POST['val'];
    
       $sql = " select * from course where course = '$val'  ";
                    $result = mysqli_query($con,$sql); // run query
                    $count= mysqli_num_rows($result); // to count if necessary
                   //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                 if ($count==1){
                echo 'exist';
              }else {
                  echo 'proceed';
              }
        
    
    
    
    
}

if(isset($_POST['compareyr'])) {
    $val = $_POST['val'];
    
       $sql = " select * from year where year = '$val'   ";
                    $result = mysqli_query($con,$sql); // run query
                    $count= mysqli_num_rows($result); // to count if necessary
                   //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                 if ($count==1){
                echo 'exist';
              }else {
                  echo 'proceed';
              }
        
    
    
    
    
}

if(isset($_POST['comparepos'])) {
    $val = $_POST['val'];
    $elecid =$_SESSION['electsched'];
       $sql = " select * from position where pos_name = '$val' and election_id='$elecid'  ";
                    $result = mysqli_query($con,$sql); // run query
                    $count= mysqli_num_rows($result); // to count if necessary
                   //  $get_id =  mysqli_insert_id($con); // this code gets the newly inserted id . if insert is the action
                 if ($count==1){
                echo 'exist';
              }else {
                  echo 'proceed';
              }
        
    
    
    
    
}

if(isset($_POST['savec'])) {
    $txtcourseadd = $_POST['txtcourseadd'];
    
    $txtcourseadd= strtoupper($txtcourseadd);
    $conditions = "`course`";
    $insertvalue = "'$txtcourseadd'";
    $fetch = new Fetch_data();
    $fetch -> insertquery('course',$conditions,$insertvalue);
    $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
        New course <strong>Saved Successfully!</strong>
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
      header('location:course_year.php');
    
}

if(isset($_POST['savey'])) {
    $txtyearadd = $_POST['txtyearadd'];
    $conditions = "`year`";
    $insertvalue = "'$txtyearadd'";
    $fetch = new Fetch_data();
    $fetch -> insertquery('year',$conditions,$insertvalue);
    $_SESSION['action'] = '   <div class="alert alert-primary" id="alerto" role="alert">
        New Year<strong>Saved Successfully!</strong>
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
      header('location:course_year.php');
    
}
?>