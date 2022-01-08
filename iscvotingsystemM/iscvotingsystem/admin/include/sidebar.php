
 <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <!--<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@500&display=swap" rel="stylesheet"> -->
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand" style="background-color: rgb(33, 74, 33);">
        <a href="#" style="font-family: 'Jost', sans-serif;color: white;text-align: center;letter-spacing: 3px">PACBOG</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>

      <div class="sidebar-header" data-toggle="modal" data-target="#accounts" style="cursor: pointer;">
        <div class="user-pic">
          <?php
          $id = $_SESSION['admin_id_token']; 
          include 'connection/connect.php';
            $ss = " select * from admin where  admin_id= '$id'  ";
                                  $resultss = mysqli_query($con,$ss); 
                                  $countss= mysqli_num_rows($resultss); 
                                
                                   while($row = mysqli_fetch_array($resultss)){ 
                                    $src = '../upload/';
                                    $image_src = $src.$row['photo'];


                                    ?>
                                      <img src="<?php echo $image_src ?>"
                                      alt="User picture" data-toggle="modal" data-target="#accounts" class="rounded-circle">
                                  </div>
                                  <div class="user-info">
                                    <span class="user-name" style="cursor: pointer" data-toggle="modal" data-target="#accounts">
                                      <strong>Admin- <?php echo $row['name']; ?></strong>
                                    </span>
                                    <span class="user-role">Administrator</span>
                                    <span class="user-status">
                                      <i class="fa fa-circle"></i>
                                      <span>Online</span>
                                    </span>
                                  </div>

                                    <?php
                                   
                                   }
          ?>
        <span style="color:grey;font-size:10px;float:right">Click Here to Edit</span>
      </div>

      <!-- Button trigger modal -->
      
     

      <!-- sidebar-header  -->
      
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Reports</span>
          </li>
          <li class="sidebar">
            <a href="statistics.php">
              <i class="fa fa-tachometer-alt"></i>
              <span>Statistics</span>
              
            </a>
          
          </li>

           <li class="sidebar">
            <a href="winners.php">
             <i class="fas fa-trophy"></i>
              <span>Results</span>
              
            </a>
          
          </li>
        
        
          


          <li class="header-menu">
            <span>Manage</span>
          </li>
            <li>
            <a href="election.php">
           <i class="fas fa-calendar-day"></i>
              <span>Election</span>
            
            </a>
          </li>
         <li>
            <a href="voters.php">
                <i class="fas fa-balance-scale-right"></i>
       
              <span>Voters</span>
            
            </a>
            </li> 
          </li>
            <li class="sidebar">
            <a href="position.php">
           <i class="fas fa-poll-h"></i>
              <span>Position</span>
              
            </a>
           
          </li>
        
            <li class="sidebar">
            <a href="candidates.php">
            <i class="fas fa-users"></i>
              <span>Candidates</span>
            </a>
          
          </li>
            
          
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer" style="background-color: rgb(33, 74, 33);">
      <a href="#" style="cursor: default;" disabled>
        
      </a>
      <a href="#" disable style="cursor: default;">
       
      </a>
      <a href="#" style="cursor: default;">
       
      </a>
      <a href="logout.php" style="color: white">
        Logout
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>