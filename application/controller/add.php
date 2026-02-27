<div id="content">
  <section class="style-default-bright">
    <div class="section-body designation_panel">
      <div class="row">
        <div class="row">
          <div class="col-md-6">
            <div class="section-header">
              <h2 class="text-primary"><?php echo $title; ?></h2>
            </div>
          </div>
          <div class="col-md-6"> </div>
        </div>
        <form name="document_type" method="POST" action="<?php echo base_url().'admin/master/document_type/save' ?>" class="height-set ml-3">
            <input type="hidden" name="type_id" value="<?php echo !empty($edit_data) ? $edit_data['id'] : ''; ?>">
            <div class="row">
               <?php $this->load->view('include/message'); ?>
               <div class="col-md-3">
                 <h4 class="text-black">Business Type:<span class="required">*</span></h4>
               </div>
               <div class="col-md-9 error_place1"><br>
                  <?php 
                  if (!empty($business_type)) {
                     $editbusiness_type =  !empty($edit_data) ? json_decode($edit_data['business_type']) : array();
                     foreach ($business_type as $type) { 
                        $checked = in_array($type['id'],$editbusiness_type) ? 'checked' : ''?>
                     <label class="checkbox-inline checkbox-styled">
                        <input type="checkbox" name="business_type[]" value="<?php echo $type['id'] ?>" <?php  echo $checked;?> >
                        <span><?php echo ucfirst($type['name']); ?></span>
                     </label>
                 <?php } 
                  } ?>
               </div>
            </div>

            <div class="row">
               <div class="col-md-3">
                 <h4 class="text-black">Document Category:<span class="required">*</span></h4>
               </div>
               <div class="col-md-9 error_place"><br>
                  <?php 
                  $DOC_CAT = $this->config->item('DOC_CAT');
                  if (!empty($DOC_CAT)) {
                     $editdocument_category =  !empty($edit_data) ? json_decode($edit_data['document_category']) : array();
                     foreach ($DOC_CAT as $cat =>$cat_name) { 
                        $checkedc = in_array($cat,$editdocument_category) ? 'checked' : ''?>

                     <label class="checkbox-inline checkbox-styled">
                        <input type="checkbox" name="document_category[]" value="<?php echo $cat ?>" <?php  echo $checkedc;?> >
                        <span><?php echo ucfirst($cat_name); ?></span>
                     </label>
                 <?php } 
                  } ?>
               </div>
            </div>

            <div class="row">
               <div class="col-md-3">
                 <h4 class="text-black">Document Type:<span class="required">*</span></h4>
               </div>
               <div class="col-md-4"><br>
                  <input type="text" name="document_type" placeholder="Document Type Name" class="form-control" value="<?php echo !empty($edit_data) ? $edit_data['name'] : ''; ?>">
               </div>
               <div class="col-md-5"><br></div>
            </div>
            <br>
          <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary pull-center" ><?php echo !empty($edit_data) ? 'Update' : 'Add'; ?></button>
                <a href="<?php echo base_url();?>admin/master/document_type" class="btn btn-danger pull-center">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div><?php $this->load->view('include/common_script');?>

<script type="text/javascript">

   $.validator.addMethod('cb_selectone', function(value,element){
    if(element.length>0){
        for(var i=0;i<element.length;i++){
            if($(element[i]).val('checked')) return true;
        }
        return false;
    }
    return false;
   }, 'Please select at least one option');

$("form[name='document_type']").validate({
		rules: {
			document_type 		  : { 
        required: true,
        noSpace:true
      },
         'document_category[]' : {required : true},
         'business_type[]' : {required : true},
		},
		messages: {
		    document_type		  : {required: "Please enter first name."}
		},
    errorPlacement: function(error, element) {
      if(element.closest('div').hasClass('error_place')) {
        $('.error_place').append(error[0]);
      }else if(element.closest('div').hasClass('error_place1')) {
        $('.error_place1').append(error[0]);
      }else{
        error.insertAfter(element);
      }
    },
   	submitHandler: function(form) {
	     form.submit();
   	}
});
</script> 
