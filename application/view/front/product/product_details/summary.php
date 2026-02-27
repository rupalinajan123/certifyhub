<?php //print_r($package_details);exit;?>
<!-- The Modal -->
<style type="text/css">
  div.show_hide{display: none;}
  div.exist_customer{padding-top: 30px;}
  .pro-btns .form-group {	
width: auto;
  }

</style>
<?php if ($product_details['id'] != 50) {?>
<div class="modal fade" id="summary_page">
   <div class="modal-dialog ">
      <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Product Summary</h4>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form action="<?php echo base_url();?>products/summary-post" method="POST" name="product_summery">
               <input type="hidden" name="product_id" value="<?php echo $product_details['id'] ?>">
               <input type="hidden" name="package_id" value="<?php echo $package_details['package_id'] ?>">
               <div class="form-group">
                  <p><b>Product Name: </b><?php echo ($product_details['product_name'] ? $product_details['product_name'] :'') ?></p>
                  <p><b>Package Name: </b><?php echo ($package_details['package_name'] ? $package_details['package_name'] :'') ?></p>
                  <?php //echo /*($package_details['type']=='Multi Tendancy' && ($package_details['product_offered']=='SAAS') ?*/ 
                  //'<p><b>Implementation Cost: </b>'.number_format(($package_details['implementation_amount']+$package_details['features_amount']),2).' /-</p>' 
                  /*:'<p><b>Implementation Cost: </b>'.number_format($package_details['implementation_amount'],2).' /-</p>')*/ ?>
               </div>
               
               
               <!-- <div class="form-group">
                  <label for="email"><b>Enter Quantity</b></label>
                  <input type="number" readonly="true" min="1" class="form-control" id="quantity" name="quantity" value="1">
               </div> -->
               <button type="submit" class="btn btn-checkout">Checkout</button>
               <button type="button" class="btn btn-dismiss" data-dismiss="modal">Cancel</button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php }?>
<!-- modal End-->
<?php if ($product_details['id'] == 50) {?>
<div class="modal fade" id="register_covid_product">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Product Summary</h4>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form action="" method="POST" name="product_summery">
               <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_details['id'] ?>">
               <input type="hidden" name="package_id" value="<?php echo $package_details['package_id'] ?>">
               <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                  <p><b>Product Name: </b><?php echo ($product_details['product_name'] ? $product_details['product_name'] :'') ?></p>
                  <p id="covid_pkg_cost"><b>Package Cost:  </b><?php echo get_currency(number_format(($package_details['implementation_amount']+$package_details['features_amount']),2));?> /-</p>
                  
                </div>
                  <div class="col-md-6 col-sm-12">
                    <p><b>Package Name: </b>
                      <select class="form-control" id="package_name">
                        <?php print_r($package_list);
                        foreach ($package_list as $package) {
                          $select = $package_details['package_id'] == $package['package_id'] ? 'selected' : '';
                          echo '<option '.$select.' value="'.$package['package_id'].'">'.ucwords($package['package_name']).'</option>';
                        }?>
                        
                      </select></p>
                    
                 </div>
                 <div class="col-12 show_hide">
                   <div class="form-group">
                      <label class="radio-inline"><input type="radio" name="customer_type"  value="exist_customer" >&nbsp;Existing Customer</label>&nbsp;&nbsp;
                      <label class="radio-inline"><input type="radio" name="customer_type" checked  value="new_customer">&nbsp;New Customer</label>
                  </div>
                 </div>
               </div>
               
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="Email">Email<span class="required">*</span></label>
                          <input type="text" tabindex="1" name="email" id="email" class="form-control" placeholder="Email" >
                          <label id="email_error" class="error" for="email">Please enter email.</label>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12 ">
                        <div class="form-group exist_customer">
                          <button type="button" class="btn btn btn-checkout btn-varify-customer">Verify Customer</button>
                          <span class="loader" ><i class="fa fa-refresh fa-spin"> </i></span>
                        </div>

                        <div class="form-group new_customer">
                          <label for="first_name">Category<span class="required">*</span></label>
                          <select tabindex="2" class="form-control" name="category" id="category">
                            <option value="">-- Select --</option>
                            <option value="Hospital">Hospital</option>
                            <option value="Clinic">Clinic</option>
                            <option value="Pathology">Pathology</option>
                          </select>
                        </div>
                        
                      </div>
                      <div class="col-md-4 col-sm-12 new_customer">
                        <div class="form-group">
                          <label for="mobile">Registration Certificate <span class="required">*</span></label>
                          <input type="file" tabindex="3" class="form-control" id="registration_certificate" name="registration_certificate" accept="application/pdf,image/x-png,image/gif,image/jpeg" data-msg-accept="Please upload pdf,jpg,jpeg,png." />
                        </div>
                      </div>
                    </div>

                    <div class="row new_customer">
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="registration_no">Registration No.<span class="required">*</span></label>
                          <input type="text" tabindex="4" name="registration_no" id="registration_no" class="form-control nospace" placeholder="Registration No." >
                        </div>
                        
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="first_name">First Name<span class="required">*</span></label>
                          <input type="text" tabindex="5" name="first_name" id="first_name" class="form-control nospace" placeholder="First Name">
                        </div>
                        
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="last_name">Last Name<span class="required">*</span></label>
                          <input type="text" tabindex="6" name="last_name" id="last_name" class="form-control nospace" placeholder="Last Name" >
                        </div>
                        
                      </div>
                    </div>
                    <div class="row new_customer">
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="company_name">Company Name<span class="required">*</span></label>
                          <input type="text" tabindex="7" name="company_name" id="company_name" class="form-control nospace" placeholder="Company Name" >
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="mobile">Mobile No.<span class="required">*</span></label>
                          <input type="text" tabindex="8" class="form-control noSpaceOnly" maxlength="10" id="cphone" name="cphone" placeholder="Mobile No.">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="mobile">GST</label>
                          <input type="text" tabindex="9" class="form-control noSpaceOnly nospace"  name="gst" placeholder="GST No." >
                        </div>
                      </div>
                    </div>
                    <div class="row new_customer">
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                           
                          <label for="company_name">Address<span class="required">*</span></label>
                          <textarea name="address" tabindex="10" id="address" placeholder="Address" class="form-control nospace"></textarea>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="state">State<span class="required">*</span></label>
                             <select class="form-control" tabindex="11" name="state" id="state">
                               <option value="">Select State</option>
                               <?php if (!empty($state)) {
                                  foreach ($state as $res) 
                                    {  $t='';
                                       
                                       echo "<option value='".$res['code']."' ".$t.">".$res['name']."</option>";
                                       
                                       
                                    }
                               } ?>
                             </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="mobile">City<span class="required">*</span></label>
                          <select class="form-control" tabindex="12" name="city" id="city">
                           <option value="">-- Select City --</option>
                          </select>
                       </div>
                      </div>
                    </div>
                    <div class="row new_customer">
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="state">Postcode<span class="required">*</span></label>
                             <input type="text" tabindex="13" name="postcode" id="postcode" maxlength="6" class="form-control nospace" placeholder="Postcode">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="exist_customer_data"></div>
               
               <!-- <div class="form-group">
                  <label for="email"><b>Enter Quantity</b></label>
                  <input type="number" readonly="true" min="1" class="form-control" id="quantity" name="quantity" value="1">
               </div> -->
               <div class="row pro-btns" style="justify-content:space-between;">
                  <div class="col-md-3 col-sm-12">
                        <div class="form-group new_customer">

                          <button type="submit" class="btn btn-primary btn-varify_otp">Verify Email</button>
                       <span class="loader1" ><i class="fa fa-refresh fa-spin"> </i></span>
                       </div>
                  </div>
                  <div class="col-md-4 col-sm-12" style="display: none;">
                        <div class="form-group" id="varify_otp">
                           <input type="hidden" name="client_id" value="">
                          <input type="text" class="form-control nospace" maxlength="6" name="varify_otp" placeholder="Enter OTP received in E-Mail">
                          <label id="varify_otp-error" class="error" for="varify_otp">Please enter OTP.</label>
                       </div>
                  </div>
                  <div class="col-md-5 col-sm-12 dis-in">
                        <div class="form-group ">
                           <button type="button" id="btn_checkout" class="btn btn-primary btn-checkout mb-2">Verify & Checkout</button>
                           <button type="button" class="btn btn-dismiss" data-dismiss="modal">Close</button>
                       </div>
                  </div>
              </div>
               
               
            </form>
         </div>
      </div>
   </div>
</div>
<!-- modal End-->
<?php }?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />
<script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
    $('.loader1').hide();
  });
  <?php if ($product_details['id'] == 50) {?>
  jQuery.validator.addMethod("gst", function(value3, element3) {
        var gst_value = value3.toUpperCase();
        var reg = /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
        if (this.optional(element3)) {          return true;        }
        if (gst_value.match(reg)) {       return true;     } else {        return false;       }
    }, "Please specify a valid GST Number");

 

    $.validator.addMethod("letter_only", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    }, "Only letters are allowed.");

    $("#register_covid_product").modal({
        backdrop: 'static',
        keyboard: false,
    });
    $("#register_covid_product").on('hide.bs.modal', function(){
     $('#popup_model').html('');
     $('div.modal-backdrop').remove();
   });

    // $('#register_covid_product').modal('show');
    $('#varify_otp,#btn_checkout,.exist_customer,#email_error,#exist_customer_data').hide();
     $(document).on('change','input[name="email"]',function(e) {
        if ($('input[name="customer_type"]:checked').val() != 'new_customer') {
          $('#btn_checkout').hide();
        }
     });
    //$('input[name="customer_type"]:checked').val() == 'new_customer'
    $(document).on('click','.btn-varify-customer',function(e) {
      $('#btn_checkout').hide();
      $('.loader').show();
      var email = $('input[name="email"]').val();
      var product_id = $('input[name="product_id"]').val();
      $('#email_error').hide();
      if (email) {
            $.ajax({
               type: "POST",
               url:base_url+"register/varify_customer",
               data: {'email': email,'product_id':product_id},
               dataType: 'json',
               success: function(data)
               {
                  if (data.status == '0') {
                    if (data.data) {
                      $('#exist_customer_data').show();
                      $('#exist_customer_data').html('').html(data.data);
                    }
                    $('#btn_checkout').show();
                  }else{
                    $('#exist_customer_data,#btn_checkout').hide();
                     Swal.fire('Error',data.message, 'error');
                  }
                  $('.loader').hide();
                  
               }
           });
      }else{
        $('#email_error').show();
        $('.loader').hide();
        $('#email_error').html('Please enter email.');
      }

    });
    $(document).on('change','input[name="customer_type"]',function(e) {
      $('#email_error').hide();
      if ($('input[name="customer_type"]:checked').val() == 'new_customer') {
        $('.new_customer').show();
        $('.exist_customer').hide();
      }else{
        $('.exist_customer').show();
        $('.new_customer').hide();
        
      }
    });

    $(document).on('click','button#btn_checkout',function(e) {
      var varify_otp = $('input[name="varify_otp"]').val();
      var product_id = $('input[name="product_id"]').val();
      var package_id = $('input[name="package_id"]').val();

      if ($('input[name="customer_type"]:checked').val() == 'exist_customer') {

             var email =$('input[name="email"]').val();
                $.ajax({
                   type: "POST",
                   url:base_url+"register/exist_customer_register",
                   data: {'email': email,'package_id':package_id,'product_id':product_id},
                   dataType: 'json',
                   success: function(data)
                   {
                      console.log(data)
                      if (data.error_code == '0') {
                         window.location.href = data.url;
                      }else{
                         Swal.fire('Error', "An error occurred: " + data.message, 'error');
                      }
                      
                      
                   }
               });
      }else{
          if (varify_otp) {
             var client_id =$('input[name="client_id"]').val();
                $.ajax({
                   type: "POST",
                   url:base_url+"register/verify_otp",
                   data: {'client_id': client_id,'otp':varify_otp,'package_id':package_id,'product_id':product_id},
                   dataType: 'json',
                   success: function(data)
                   {
                      if (data.error_code == '0') {
                         window.location.href = data.url;
                      }else{
                         Swal.fire('Error', "An error occurred: " + data.message, 'error');
                      }
                      
                   }
               });
          }else{
             $('#varify_otp-error').show();
             $('#varify_otp-error').html('Please enter OTP.');
             
          }
      }

      
    });
    $.validator.addMethod('filesize', function(value, element, param) {
      return this.optional(element) || (element.files[0].size <= param) 
    });

    $('.loader').hide();
    $("form[name='product_summery']").validate({
      rules: {
          first_name: {
          required: function(element) {
            return $('input[name="customer_type"]:checked').val() == 'new_customer';
          },
          letter_only:true,
          minlength: 2,
          maxlength: 100
        },
      last_name: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
        letter_only:true,
        minlength: 2,
        maxlength: 100
      },
      company_name: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
        // letter_only:true,
        maxlength: 255
      },
      address: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
      },
      category: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
      },
      registration_no: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
      },
      registration_certificate: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
        extension: "png|pdf|jpg|jpeg",
        filesize: 2097152,
        
      },
      state: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
      },
      city: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
      },
      postcode: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },

      },
      email:{
        required:true,
        email:true,
        remote : {
          //if this returns true, remote will be triggered
          depends: function(){
            return $('input[name="customer_type"]:checked').val() == 'new_customer';
          },
          //using these parameters
          param: {
            url : '<?php echo base_url('register/cemail_is_unique')?>',
            type: "post",
            data: {
                email: function() {
                    return $("#email").val();
                },
                product_id: function() {
                    return $("#product_id").val();
                },
            }
          }
       },
     },
      gst:{gst:true},
      cphone: {required: function(element) {
          return $('input[name="customer_type"]:checked').val() == 'new_customer';
        },
        number:true,
        minlength: 10,
        maxlength:10,
        
      },
    },
    messages: {
        first_name: {
        required: "Please enter first name."
      },
      last_name: {
        required: "Please enter last name."
      },
      company_name: {
        required: "Please enter company name."
      },
      gst:{gst:"Enter valid GST No."},
      registration_certificate:{
        required:"Please upload pdf,jpg,jpeg,png.",
        filesize:"File must be less than 2MB"
      },
      email: {
        required: "Please enter email.",
        email: "Please enter a valid email address.",
        remote:"You have already register with us."
        /*remote:"You have already register with us. Please select existing user."*/
      },
      cphone: {
        required: "Please enter mobile no."
      },
    },
    submitHandler: function(form) {
         var form_data = new FormData(form);
          $.ajax({
              
               
               type: "POST",
                    url:base_url+"register/register_covid_product",
                    //dataType: 'text',
                    data: form_data,
                    enctype: 'multipart/form-data',
                    processData: false,
                    cache: false,
                    async: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        // setting a timeout
                        $('.loader1').show();
                      
                    },
                    success: function(data)
                    {
                        //var data = JSON.parse(response);
                        if (data.error_code == '0') {
                           $('.btn-varify_otp').prop('disabled', true);
                           $('#varify_otp,#btn_checkout').show();
                           $('input[name="client_id"]').val(data.client_id); 
                           //console.log(response)   
                        }else{
                          Swal.fire('Error', data.message, 'error');
                        }
                    },
                    complete: function() {
                   
                        $('.loader1').hide();
                    
                    },
           });
          return false;
    }
   });

      //  select country
      $('#country').change(function(){
      var country = $(this).val();
      
    if(country){  
        get_state(country);
    }else{
       toastr.error('Please select oountry.');
    }
      
  });
    //select state
  $('#state').change(function(){
     
      var country  = 'IN';
      var state   = $(this).val();
      get_city(state,country);
      
  });

  function get_city(state,country,city=''){
    if(state)
     {
      // AJAX request
      $.ajax({
          url:base_url+"get-city",
            method: 'post',
            data: {state: state, country:country,city:city},
            dataType: 'html',
            success: function(response)
            {
              if(response.trim() !='error')
                {
                    $('#city').html(response);
                } 
                else
                {
                    $('#err_city').html('No record found');
                    return false;
                }   
            }
        });

     }
  }

  function get_state(country,country_code='',state_code=''){
    $.ajax({
            url:base_url+"profile/get_states",
              method: 'post',
              data: {
                country: country,
                country_code:country_code,
                state_code:state_code
              },
              dataType: 'html',
              success: function(response)
              {
                // alert(response);
                if(response.trim() !='error')
                  {
                      $('#state').html(response);
                  } 
                  else
                  {
                      $('#err_states').html('No record found');
                      return false;
                  }   
              }
          });
  }
<?php }?>

</script>