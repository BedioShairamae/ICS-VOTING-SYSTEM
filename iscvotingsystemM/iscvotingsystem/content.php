<?php 
session_start();
include 'admin/connection/connect.php';
include 'class.php';
$fetch = new Fetch_data();
	if(isset($_POST['candidate'])){ 
	 $fetch-> get_candidates(); 
	}

if(isset($_POST['summary'])){ 
	 $fetch-> get_summary(); 
}

	
	
 ?>

 <script type="text/javascript">
 	
 			$('.btnvote1').click(function() { 
			  		var id = $(this).data("cid");
					var fullname = $(this).data("fullname");
					 
					   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {castvote:1,cid:id,fullname:fullname},
					             success : function(data){
					
					             }
					          })
					   
					    
			  		getcancontent();
			  	})
			$('.btncancelvote1').click(function() { 
			  			var id = $(this).data("cid");
			  			   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {cancelvote:1,cid:id},
					             success : function(data){
						//getcancontent();
						location.reload();
					             }
					          })
			  	
			  	})
			$('.voteid').click(function() { 
			  		var id = $(this).data("cid");
					var fullname = $(this).data("fullname");
					
					   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {castvote:1,cid:id,fullname:fullname},
					             success : function(data){
								location.reload();
					             }
					          })
					   
					    
			  		
			  	})
			  	  	$('.cancelvoteid').click(function() { 
			  			var id = $(this).data("cid");
			  			   $.ajax({
					           url : "votar.php",
					            method: "POST",
					             data  : {cancelvote:1,cid:id},
					             success : function(data){
					
					             }
					          })
			  	
			  	})
			 function getcancontent(){
			 	 $.ajax({
			           url : "content.php",
			            method: "POST",
			             data  : {candidate:1},
			             success : function(data){
								$('#candidate_content').html(data);
								
			             }
			          })
			 }  



        function summary(){
         $.ajax({
                 url : "content.php",
                  method: "POST",
                   data  : {summary:1},
                   success : function(data){
                $('#candidate_contentss').html(data);
                
                   }
                })
       }    

			 	$('.submitvote').click(function() { 
			 		 summary();
			 		/*
				Swal.fire({
				  title: 'Are you sure You Want to Submit All your Votes?',
				  text: "Once Submitted,You are unable to edit or modify your votes.",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#36b9cc',
				  cancelButtonColor: '#f6c23e',
				  confirmButtonText: 'Yes, Submit it!'
				}).then((result) => {
				  if (result.isConfirmed) {
				     $.ajax({
				           url : "submit.php",
				            method: "POST",
				             data  : {submitvote:1},
				             success : function(data){
								window.location.href="vote.php";
				             }
				          })
				  }
				})
				*/
			})
       	
 </script>