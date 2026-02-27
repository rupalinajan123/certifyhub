<?php //print_r($package_details);exit;?>
<!-- The Modal -->

<div class="modal fade" id="product_lead_page"  role="dialog">
   <div class="modal-dialog ">
      <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title"><?php echo $title; ?> </h4>
         </div>
         <!-- Modal body -->
         <div class="modal-body">

            <form action="#" method="POST" name="product_lead" id="product_lead" class="form floating-label">
              <?php  get_csrf_token(); ?>
              <input type="hidden" name="product_type" id="product_type" value="<?php echo $product_type; ?>">
               <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
               <input type="hidden" name="action_type" value="<?php echo $action_type; ?>">
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="number">Contact Number <span class="required">*</span></label>
                          <input type="text" tabindex="1" name="phone" id="phone" class="form-control" placeholder="Contact Number" value="<?php echo set_value('number'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="Email">Email ID<span class="required">*</span></label>
                        <input type="text" tabindex="2" name="email" id="email" class="form-control" placeholder="Email Id" value="<?php echo set_value('email'); ?>">
                      </div>
                    </div>
  
                  </div>
                  <div class="row">
                       <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="first_name">First Name </label>
                          <input type="text" tabindex="3" name="first_name" id="first_name" class="form-control nospace" placeholder="First Name" value="<?php echo set_value('first_name'); ?>">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="last_name">Last Name </label>
                          <input type="text" tabindex="4" name="last_name" id="last_name" class="form-control nospace" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
                        </div>
                      </div>                    
                  </div>
                  <div class="row justify-content-center" >
               <button type="submit" name="submit" class="btn btn-primary ml-1">Submit</button>
               <button type="button" class="btn btn-dismiss" data-dismiss="modal">Cancel</button>
                  </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- modal End-->

<script type="text/javascript">
var ajax_url = base_url + 'products/save-lead-enquiry';
jQuery.validator.addMethod("accept", function(value, element, param) {
  return this.optional(element) || value.match(new RegExp("." + param + "$"));
});
 $.validator.addMethod("email",
    function(value, element) {
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    },
    "Please enter a valid email."
);
  
  $("form[name='product_lead']").validate({
    rules: {
      first_name: {
       /* lettersonly: true,*/
       required: false,
        minlength: 2,
        maxlength: 100,
       // accept:{"[a-zA-Z]+"} , 
      },
      last_name: {
      /* lettersonly: true,*/
      required: false,
        minlength: 2,
        maxlength: 100,
       // accept: "[a-zA-Z]+", 
      },

      email: {
      
        email: true,
        <?php if($action_type=="free_trial"){  ?>
        remote: {
            url: "<?php echo base_url('products/lead-enquiry-unique/'.$product_id.'/'.$product_type.'/'.$action_type)?>",
            type: "post"
        }<?php } ?>
        
      },

      phone: {
        required: true,
        minlength: 10,
        maxlength:10,
        number:true,
        <?php if($action_type!="free_trial"){  ?>
        remote: {
            url: "<?php echo base_url('products/lead-enquiry-unique/'.$product_id.'/'.$product_type.'/'.$action_type)?>",
            type: "post"
        }<?php } ?>
      },
    },

    messages: {
      first_name: {
        accept: "Please enter valid first name."
      },
      last_name: {
        accept: "Please enter valid last name."
      },

      email: {
     
        email: "Please enter a valid email.",
         <?php if($action_type=="free_trial") { ?>
         remote : "Email already submited."<?php } ?>

      },
    
      phone: {
         required: "Please enter contact no.",
         maxlength :"Please enter 10 digit number.",
         minlength :"Please enter 10 digit number.",
         number: "Please enter only numbers.",
            <?php if($action_type!="free_trial") { ?>
         remote : "Phone number already submited."<?php } ?>
      },
    },
      submitHandler: function(form) {
        var Form = document.getElementById('product_lead');            
        var formData = new FormData(Form);


        $.ajax({
          type: "POST",
          url: ajax_url,
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          cache: false,
          timeout: 1000000,
          success: function (data) {
              if (data.status) {
              Swal.fire('Succussful!', data.message,'success').then(function(){ location.reload(); });

              $('#product_lead_page').modal("hide");
              $('#popup_model').html('');
              $('.modal-backdrop').remove();
            
            }else{
              Swal.fire('Error!', data.message,'error'); 
            }         
          },
          error: function (e) {
              Swal.fire("Enquiry not submitted", data.message,'error');
          }
        });
      }
  });


</script>