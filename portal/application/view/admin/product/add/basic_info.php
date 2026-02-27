<?php //print_r($edit_data); ?>
<form autocomplete="off" action="#" method="POST" name="product_form" enctype="multipart/form-data">
  <input type="hidden" name="mode" id="mode" value="<?php echo @$mode ?>">
	<input type="hidden" name="id" id="id" value="<?php echo @$edit_data['id'] ?>">
	<input type="hidden" name="status" value="<?php echo @$edit_data['status'] ?>">
	<input type="hidden" name="remark_value" id="remark_value" value="">
	<input type="hidden" name="prod_type" id="prod_type" value="<?php echo @$edit_data['type']?>">
  <input type="hidden" name="prod_type" id="prod_type" value="<?php echo @$edit_data['type']?>">
<br>
	<div class="row mx-0">
		<div class="col-lg-6 col-md-6">
			<div class="form-group row">
				<div class="col-sm-2 col-md-2">
	                <h4> Logo:<span class="required">*</span></h4>
	            </div>
	            <div class="col-sm-6 col-md-6">
                	<input type="hidden" value="<?php echo @$edit_data['logo'] ?>" id="old_logo" name="old_logo">
                	<input type="hidden" value="true" id="logo_check" name="logo_check">
	                <label class="fileContainer">
	                <input type="file" class="d-inline-block" onchange="loadFile(event)" accept="image/png, image/jpeg" name="logo" id="logo" value="Logo" >
	                </label>
	                <br>
	                <br>
	                <small>(180px X 80px, size:2MB, only jpg, jpeg, png.)</small>
	            </div>

                <div class="col-sm-4 col-md-4">
                  <?php 
                  $logo = !empty($edit_data) && isset($edit_data['logo']) ? $edit_data['logo'] : 'testing1.jpg';
                  // echo $edit_data['logo'];
                  $file = $this->config->item('ABS_PATH').$this->config->item('CATEGORY_LOGO_UPLOAD').$logo;

                  if (!file_exists($file) && empty($logo)) { 
                    //assets/front/images/manufacturing-industry.png?>
                    <img style="height:80px; width: 100%" id="output"  src="<?php echo base_url('show_image?image_type=product_logo&image_name=default.png'); ?>" />
                  <?php  }else{ ?>

                   <img style="height:80px; width: 100%" id="output" src="<?php echo base_url('show_image?image_type=product_logo&image_name='.$logo); ?>" />

                 <?php }
                 ?>
                </div>
            </div>
            <div class="form-group row">
	          <div class="col-sm-4">
	            <h4>Name:<span class="required">*</span></h4>
	          </div>
	          <div class="col-sm-8">
	            <input type="text" class="form-control" name="product_name" placeholder="Name" id="product_name" value="<?php echo set_value('product_name',@$edit_data['product_name']); ?>">
	          </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-4">
                <h4>Short Brief:<span class="required">*</span></h4>
              </div>
              <div class="col-sm-8">
                <textarea name="short_brief" maxlength="75" class="form-control nospace" placeholder="Short Brief"><?php echo html_entity_decode(set_value('short_brief')); ?><?php echo @$edit_data['short_brief'] ?></textarea>
              </div>
            </div>

        <div class="form-group row">
            <div class="col-sm-4">
              <h4>Price:<span class="required">*</span></h4>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo @$edit_data['price']??set_value('price') ?>" min="0">
            </div>
          </div>
          
          <div class="form-group row">
            <div class="col-sm-4">
              <h4>MRP:</h4>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="mrp" placeholder="MRP" value="<?php echo @$edit_data['mrp']??set_value('mrp') ?>">
            </div>
          </div>
		</div>


		<div class="col-lg-6 col-md-6">
			<div class="form-group row">
              <div class="col-sm-4">
                <h4>Categories:<span class="required">*</span></h4>
              </div>

              <div class="col-sm-8 ">
                <label class="checkbox-inline checkbox-styled checkbox-primary">
                  <input type="checkbox" id="category_id_checkbox"><span>ALL</span>
                </label>
                <select class="js-select2 form-control w-100"  placeholder="category" multiple="multiple" name="category_id[]" id="category_id">

                  <?php
                  if (!empty($categories_list)) {
                    foreach ($categories_list as $categories) {
                      $category_id = isset($edit_data['category_id']) ? explode(',', $edit_data['category_id']) : array();
                      $checked = (in_array($categories['cat_id'], $category_id) ? "selected='selected'" : "");
                      echo '<option value="' . $categories['cat_id'] . '"' . $checked . '>' . $categories['name'] . '</option>';
                    }
                  } ?>
                </select>
              </div>
            </div>
           
             <!-- <div class="col-sm-8 ">
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                            <div class="input-group-append">
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
              
            </div>   -->
		</div>

		<div class="col-md-12 text-center">
            <?php if($this->session->userdata('user_type') == 'admin'){
              $curl = 'admin/products';
            } else{
              $curl = 'partner/products';
            }?>
            <a href="<?php echo base_url($curl) ?>" class="btn-sm btn ink-reaction btn-danger mt-4">Cancel</a>
            <button type="submit" name="submit_basic_info" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." value="submit" class="btn-sm btn ink-reaction btn-primary mt-4 btn-loading-state">Save & Continue &nbsp;<span class="glyphicon glyphicon-arrow-right"></span><div class="ink" style="top: 22px; left: 71.5px;"></div></button>
		</div>

	</div>
</form>
