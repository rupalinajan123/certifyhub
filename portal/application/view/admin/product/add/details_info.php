
 <form autocomplete="off" action="<?php echo base_url('partner/products/product_save/details_info') ?>" method="POST" name="product_form" enctype="multipart/form-data">
    <input type="hidden" name="mode" id="mode" value="<?php echo @$mode ?>">
	<input type="hidden" name="id" id="id" value="<?php echo @$product_id; ?>">
	<input type="hidden" name="status" value="<?php echo @$edit_data['status'] ?>">
	<input type="hidden" name="remark_value" id="remark_value" value="">
	<input type="hidden" name="prod_type" id="prod_type" value="<?php echo @$edit_data['type']?>">
<br>
	<div class="row mx-0">
		<div class="col-lg-6 col-md-6">
			<div class="form-group">
              	<h4>Descriptions:<!--<span class="required">*</span>--></h4>
                <textarea id="brief" name="brief" class="form-control control-7-rows ckeditors" placeholder="Enter Brief ..."><?php echo @$edit_data['brief']; ?></textarea>
            </div>

            <div class="form-group ">
                <h4>Benefits:<!--<span class="required">*</span>--></h4>
                <textarea id="overview" name="overview" class="form-control  control-12-rows ckeditors" placeholder="Enter Overview ..."><?php echo @$edit_data['overview'] ?></textarea>
           </div>

            <div class="form-group">
                <h4> Highlights:<!--<span class="required">*</span>--></h4>
              	<textarea id="highlight" name="highlight" class="form-control control-12-rows ckeditors" placeholder="Enter Highlight ..."><?php echo @$edit_data['highlight'] ?></textarea>
          </div>
            
		</div>

		<div class="col-lg-6 col-md-6">
			<div class="form-group">
                <h4> Delivery Methodology:<!--<span class="required">*</span>--></h4>
                <textarea id="usage" name="usage" class="form-control control-12-rows ckeditors" placeholder="Enter Usage ..."><?php echo @$edit_data['usage']; ?></textarea>
            </div>

            <div class="form-group">
                <h4> Other:<!--<span class="required">*</span>--></h4>
                <textarea id="support" name="support" class="form-control control-12-rows ckeditors" placeholder="Enter Support ..."><?php echo @$edit_data['support']; ?></textarea>
            </div>
		</div>

		<div class="col-md-12 text-center">
        <?php if($this->session->userdata('user_type') == 'admin'){
              $curl = 'admin/products';
            } else{
              $curl = 'partner/products';
            }?>
            <a href="<?php echo base_url().$back_url; ?>" class="btn-sm mt-4 btn ink-reaction btn-default"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back to Basic info</a> 
            <a href="<?php echo base_url($curl) ?>" class="btn-sm  btn ink-reaction btn-danger mt-4">Cancel</a>
            <button type="submit" name="submit_details_info" value="submit" class="btn-sm  btn ink-reaction btn-primary mt-4">Save & Continue &nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
		</div>

	</div>
</form>
