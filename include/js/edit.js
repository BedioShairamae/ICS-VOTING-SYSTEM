$('#editmyaccount').click(function() { 
	 
               						var name = $('#txtname').val();
                          var surname = $('#txtsurname').val();
                          var mname = $('#txtmname').val();
               						var mail = $('#txtemail').val();
               						var course = $('#txtcourse').val();
                          var year= $('#txtyear').val();
               						var gender = $('#txtgender').val();
                          var section = $('#txtsection').val();
               						var pass = $('#txtpass').val();
	 $.ajax({
	           url : "edit.php",
	            method: "POST",
	             data  : {edit_account:1,name:name,surname:surname,mname:mname,email:mail,course:course,year:year,gender:gender,password:pass,section:section},
	             success : function(data){
				$('#userdata').html(data);
				$('#checkboxphoto').removeClass('d-none');
	             }
	          }) 
	    

})



   $('#checkphoto').click(function() {
                                      if($(this).prop("checked") == true) {
                                     $('#image').removeAttr('disabled');
                                     $('#image').attr('required' , true);
                                     $('#form-edit').attr('action','editwphoto.php');
                                      }
                                      else if($(this).prop("checked") == false) {
                                        $('#image').attr('disabled' , true);
                                        $('#image').removeAttr('required');
                                        $('#form-edit').attr('action','edit.php');
                                      }
                                    });