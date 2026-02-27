<!-- <?php //echo base_url('partner/products/product_save/ui_checklist') ?> -->
 <form autocomplete="off" action="" method="POST" name="product_form" enctype="multipart/form-data">
  <input type="hidden" name="mode" id="mode" value="<?php echo @$mode ?>">
	<input type="hidden" name="id" id="id" value="<?php echo @$product_id; ?>">
	<input type="hidden" name="status" value="<?php echo @$edit_data['status'] ?>">
	<input type="hidden" name="remark_value" id="remark_value" value="">
	<input type="hidden" name="prod_type" id="prod_type" value="<?php echo @$edit_data['type']?>">
	<br>
	<div class="row mx-0">
		<div class="col-lg-12 col-md-12">
			        <?php
        $no = 1;
        $i = 0;
        foreach ($ui_lists as $checklist) { ?>
          <div class="col-sm-7" >
            <?php echo $no++.'] '.$checklist['name']; ?><span class="required">*</span>
          </div>
           <input type="hidden" name="ui_checklist_id[]" value="<?php echo $checklist['id'];?>">
           <input type="hidden" name="checklist_id[]" value="<?php echo @$ui_checklist[$i]['id'];?>">

            <div class="col-sm-3 radio radio-styled ui_buttons force_required">
              <label>
                <input type="radio" name="ui[<?php print $i;['radio'] ?>]" id="ui_yes" value="yes" class="ui_class" <?php if(@$ui_checklist[$i]['status']=="yes"){ echo "checked";}?> >
                <span>YES</span>
              </label>
              <label>
                <input type="radio" name="ui[<?php print $i;['radio'] ?>]" id="ui_no" class="ui_class" value="no" <?php if(@$ui_checklist[$i]['status']=="no"){ echo "checked";}?>>
                
                <span>NO</span>
              </label>
              <label>
                <input type="radio" name="ui[<?php print $i;['radio'] ?>]" id="ui_na" class="ui_class" value="na" <?php if(@$ui_checklist[$i]['status']=="na"){ echo "checked";}?>>
                <span>NA</span>
              </label>
            </div>

            <div class="col-sm-2">
            	<div class="form-group">
		             <textarea placeholder="Remark..." name="remark[<?php print $i;['remark'] ?>]" id="" class="form-control" ><?php echo @$ui_checklist[$i]['remarks']?></textarea>
		         </div>
            </div>

        <?php $i++;
          }?>  
        <span id='ui-check-list-error' class="error"></span>
		</div>
		<div class="col-lg-6 col-md-6">

		</div>
		
		<div class="col-md-12 text-center">
			<a href="<?php echo base_url().$back_url; ?>" class="btn-sm mt-4 btn ink-reaction btn-default"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back to Documentation</a>

            <a href="<?php echo base_url('partner/products') ?>" class="btn-sm btn ink-reaction btn-danger mt-4">Cancel</a>
            <button type="submit" name="submit_ui_checklist" value="submit" class=" btn-sm btn ink-reaction btn-primary mt-4">Save & Continue &nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
		</div>

	</div>
</form>
