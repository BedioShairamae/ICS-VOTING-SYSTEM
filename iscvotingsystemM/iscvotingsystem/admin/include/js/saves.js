 $(document).ready(function() {
          $('#checkphoto').click(function() {
               if($(this).prop("checked") == true) {
                             $('#image').removeAttr('disabled');
                              $('#image').attr('required' , true);
                                $('#form-add').attr('action','actionwphoto.php');   
                                              
                  }
               else if($(this).prop("checked") == false) {
                       $('#image').attr('disabled' , true);
                       $('#image').removeAttr('required');
                     
                                                  
                }
             });

            $('#remain').click(function() {
               if($(this).prop("checked") == true) {

                             if($('#checkphoto').prop("checked") == true) {
                            
                                   $('#form-add').attr('action','savewphoto.php');                
                                  }
                               else if($('#checkphoto').prop("checked") == false) {
                                     $('#form-add').attr('action','save_sv.php');   
                                                                  
                                }


                            
                                                    
                  }
               else if($(this).prop("checked") == false) {
                     if($('#checkphoto').prop("checked") == true) {
                            
                                 $('#form-add').attr('action','actionwphoto.php');               
                                  }
                               else if($('#checkphoto').prop("checked") == false) {
                                     $('#form-add').attr('action','action.php');   
                                                                  
                                }
                                                  
                }
             });

            $('#txtinit').keyup(function(){ 
              var val = $(this).val();
              if (val == '') {
          $('#remain').attr('disabled',true);
              }else {
               $('#remain').removeAttr('disabled'); 
              }
            
            })

            $('#em').keyup(function(){ 
              var typevalue = $(this).val();
              $('#email_entered').text(typevalue);
            })
       });


         const inpfile = document.getElementById("image"); 
                            const regform=document.getElementById ("form"); 
                            const previewimage=regform.querySelector("#configimage"); 
        
                             inpfile.addEventListener("change",function () {
                                const file = this.files[0];
        
                                if(file) {
                                    const reader = new FileReader();
                                    
                                    
                                    reader.addEventListener("load",function() {
                                        previewimage.setAttribute("src",this.result);
                                       
                                    });
                                    reader.readAsDataURL(file);
                                }
                             });    





