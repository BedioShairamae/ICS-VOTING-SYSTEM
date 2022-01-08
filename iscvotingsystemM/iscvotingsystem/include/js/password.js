       $(document).ready(function() {
                    
                      $('#txtcurrent').keyup(function(){ 
                              var value = $(this).val();
                            
                                   $.ajax({
                               url : "manage_password.php",
                                method: "POST",
                                 data  : {compare:1,currentpass:value},
                                 success : function(data){
                                          
                                   if(value == '') {
                                        $('#txtreenter').attr('disabled',true);
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                       $('#notify').html('');  
                                        $('#txtnew').attr('disabled',true);
                                        $('#btnsavepass').attr('disabled',true);
                                        
                                  }else {
                                           if (data == 'success') {
                                        $('#txtnew').removeAttr('disabled');
                                      //  $('#txtreenter').removeAttr('disabled');
                                        $('#txtnew').attr('required',true);
                                      //  $('#txtreenter').attr('required',true);
                                      $('#txtcurrent').attr('disabled',true);
                                        $('#notify').html('');
                                         $('#txtnew').focus();
                                   }else if (data == 'fail') {
                                        $('#txtnew').removeAttr('required');
                                     //   $('#txtreenter').removeAttr('required');
                                        $('#txtnew').attr('disabled',true);
                                        $('#txtreenter').attr('disabled',true);
                                        $('#txtnew').val('');
                                        $('#txtreenter').val('');
                                         $('#pregmatch').html('');
                                         $('#btnsavepass').attr('disabled',true);
                                        $('#notify').html('<h6 style="color: red">Password doesnt Match your current pass <i class="fas fa-exclamation-triangle"></i></h6>');
                                   }


                                  }
                                 
                                   
                                 }
                              })
                        })
                     
                         $('#txtnew').keyup(function(){ 
                              var newvalue = $(this).val();

                              if(newvalue == '') {
                                   $('#restrict').addClass('d-none');
                                  
                                   $('#txtreenter').attr('disabled',true);
                                   $('#txtreenter').val('');

                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                              }else {
                                  $('#restrict').removeClass('d-none'); 
                                   var lowerCaseLetters = /[a-z]/g;
                                   var upperCaseLetters = /[A-Z]/g;
                                    var numbers = /[0-9]/g;

                                    if(newvalue.match(lowerCaseLetters) && newvalue.match(upperCaseLetters) &&  newvalue.match(numbers) && newvalue.length >= 8 ) {
                                          $('#restrict').addClass('d-none');
                                          $('#txtreenter').removeAttr('disabled');
                                        $('#txtreenter').attr('required',true);
                                    }else {

                                     if(newvalue.match(lowerCaseLetters)) {
                                        $('#lower').addClass('d-none');
                                    }else {
                                        $('#lower').removeClass('d-none');
                                        $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    if(newvalue.match(upperCaseLetters)) {
                                        $('#upper').addClass('d-none');
                                    }else {
                                        $('#upper').removeClass('d-none');
                                        $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    if(newvalue.match(numbers)) {
                                        $('#numb').addClass('d-none');
                                    }else {
                                        $('#numb').removeClass('d-none');
                                        $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }
                                    if(newvalue.length >= 8) { 
                                       $('#chara').addClass('d-none');
                                      
                                    }else {
                                         $('#chara').removeClass('d-none');
                                         $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    }

                               




                              }
                              
                         })
                       

                       $('#txtreenter').keyup(function(){ 
                              var valuenew = $('#txtnew').val();
                              var reentervalue = $(this).val();

                              if(valuenew == reentervalue) {
                                   $('#pregmatch').html('<span style="color: Green">Password Match <i class="fas fa-check-circle"></i></span>');
                                  
                                 
                                   $('#btnsavepass').removeAttr('disabled');

                              } else {
                                    $('#pregmatch').html('<span style="color: red">Password does not Match <i class="fas fa-times-circle"></i> </span>');
                                     $('#btnsavepass').attr('disabled',true);
                              }    


                         })  

                       


                        $('#passnew').keyup(function(){ 
                              var passval = $(this).val();

                              if(passval == '') {
                                    $('#numb').removeClass('d-none');
                                      $('#lower').removeClass('d-none');
                                       $('#upper').removeClass('d-none');
                                        $('#chara').removeClass('d-none');
                                         $('#restrict').removeClass('d-none');
                                         $('#repass').attr('disabled',true);
                              }else {
                                
                                   var lowerCaseLetters = /[a-z]/g;
                                   var upperCaseLetters = /[A-Z]/g;
                                    var numbers = /[0-9]/g;
                                   
                                     if(passval.match(lowerCaseLetters) && passval.match(upperCaseLetters) &&  passval.match(numbers) && passval.length >= 8 ) {
                                          $('#restrict').addClass('d-none');
                                          $('#repass').removeAttr('disabled');
                                        $('#repass').attr('required',true);
                                    }else {
                                       $('#restrict').removeClass('d-none');

                                     if(passval.match(lowerCaseLetters)) {
                                        $('#lower').addClass('d-none');
                                    }else {
                                        $('#lower').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                          if(passval.match(upperCaseLetters)) {
                                        $('#upper').addClass('d-none');
                                    }else {
                                        $('#upper').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                         if(passval.match(numbers)) {
                                        $('#numb').addClass('d-none');
                                    }else {
                                        $('#numb').removeClass('d-none');
                                        $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                       if(passval.length >= 8) { 
                                       $('#chara').addClass('d-none');
                                      
                                    }else {
                                         $('#chara').removeClass('d-none');
                                         $('#repass').attr('disabled',true);
                                         $('#repass').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    }

                                   

                              }
                              
                         })

                         $('#repass').keyup(function(){ 
                              var valuenew = $('#passnew').val();
                              var reentervalue = $(this).val();

                              if(valuenew == reentervalue) {
                                   $('#pregmatch').html('<span style="color: Green">Password Match <i class="fas fa-check-circle"></i></span>');
                                  
                                 
                                   $('#btnsavepass').removeAttr('disabled');

                              } else {
                                    $('#pregmatch').html('<span style="color: red">Password does not Match <i class="fas fa-times-circle"></i> </span>');
                                     $('#btnsavepass').attr('disabled',true);
                              }    


                         })  

                    
                    });      
                        
                    
                         
                         
                       