
 <form autocomplete="off" action="<?php echo base_url('partner/products/product_save/api_info') ?>" method="POST" name="product_form" enctype="multipart/form-data">
  <input type="hidden" name="mode" id="mode" value="<?php echo @$mode ?>">
	<input type="hidden" name="id" id="id" value="<?php echo @$product_id; ?>">
	<input type="hidden" name="status" value="<?php echo @$edit_data['status'] ?>">
	<input type="hidden" name="remark_value" id="remark_value" value="">
	<input type="hidden" name="prod_type" id="prod_type" value="<?php echo @$edit_data['type']?>">
	<br>
	<div class="row mx-0">
		<div class="col-lg-12 col-md-12">
			
         <?php
         $pro_u_url = $pro_u_u = $pro_u_p = $onb_url = $onb_u = $onb_p =$pckg_u_url = $pckg_u_u =  $pckg_u_p = $pro_u_id = $onb_id = $pckg_u_id= '';

         if (!empty($api_data)) {
           foreach ($api_data as $api) {
              if ($api['api_type'] == 'profile_update') {
                $pro_u_id   = $api['id'];
                $pro_u_url = $api['api_url'];
                $pro_u_u = $api['username'];
                $pro_u_p = $api['password'];
              }
              if ($api['api_type'] == 'onbording') {
                $onb_id   = $api['id'];
                $onb_url  = $api['api_url'];
                $onb_u    = $api['username'];
                $onb_p    = $api['password'];
              }
              if ($api['api_type'] == 'pckg_upgd') {
                $pckg_u_id   = $api['id'];
                $pckg_u_url = $api['api_url'];
                $pckg_u_u = $api['username'];
                $pckg_u_p = $api['password'];
              }
              
           }
         }
          ?>
          <div  class="col-lg-12 form-group">
            <div class="form-group row reg hide">
              <div class="col-sm-2">
                <h4>Base URL:<span class="required">*</span></h4>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="register_api" placeholder="Ex.http://example.com" value="<?php echo @$edit_data['register_api']??set_value('register_api') ?>" >
              </div>
            </div>
            <div class="inst hide">Note: For Instance Base product base url create after intance created, It will take automatically.</div>
          </div>
          <div class="col-lg-12 form-group">
            <div class="col-md-4">
              <label class="text-black"><b>On bording slug URL:</b><span class="required">*</span></label>
              <input type="hidden" name="api_data[onbording][id]" value="<?php echo $onb_id; ?>">
              <input type="text" name="api_data[onbording][api_url]" required class="form-control" placeholder="Ex. register.php" value="<?php echo $onb_url; ?>">
            </div>
            <div class="col-md-4">
              <label class="text-black"><b>Username:</b><span class="required">*</span></label>
              <input type="text" name="api_data[onbording][username]" required class="form-control" placeholder="Username" value="<?php echo $onb_u; ?>">
            </div>
            <div class="col-md-4">
              <label class="text-black"><b>Password:</b><span class="required">*</span></label>
              <input type="text" name="api_data[onbording][password]" required class="form-control" placeholder="Password" value="<?php echo $onb_p; ?>">
            </div>
          </div>
		</div>
		
		<div class="col-md-12 text-center">
            <a href="<?php echo base_url().$back_url; ?>" class="btn-sm mt-4 btn ink-reaction btn-default"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back to UI Checklist</a> 
            <a href="<?php echo base_url('partner/products') ?>" class=" btn-sm btn ink-reaction btn-danger mt-4">Cancel</a>
            <button type="submit" name="submit_basic_info" value="submit" class=" btn-sm btn ink-reaction btn-primary mt-4">Save & Continue &nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
		</div>

	</div>
</form>


<script type="text/javascript">
  
 <?php 
if(!empty($prod_type['type']) && $prod_type['type'] == 'Multi Tenant' ){
  echo "$('.reg').removeClass('hide');";
 }elseif(!empty($prod_type['type']) && $prod_type['type'] == 'Instance Base'){
   echo "$('#add_demo_url').removeClass('hide');$('.inst').removeClass('hide');";
}
?> 

</script>
