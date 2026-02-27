
<div id="content">
    <section>
        <div class="section-body">
            <div class="row mx-0 d-flex align-items-center">
                <div class="col-md-6">
                  <div class="section-header">
                    <h2 class="text-primary"><?php echo $title; ?></h2> 
                      <?php if(!empty($product_name)){?><?php echo '('.$product_name.')';}?>
                    
                  </div>
                </div>

                <div class="col-md-6">
                    <?php // if(empty($edit_data['id'])){?>
                    <input type="hidden" name="product_type" value="lead">
                    <!--<label class="radio-inline radio-styled">-->
                    <!--  <input type="radio" class="product_type" id="product_type" name="product_type" checked="true" value="Full"><span> <b>Full Product</b></span>-->
                    <!--</label>-->
                    <!--<label class="radio-inline radio-styled">-->
                    <!--  <input type="radio" class="product_type" name="product_type" value="Lead" <?php if($product_type == 'lead') { ?> checked="true" <?php } ?>><span><b> Lead Product</b> </span>-->
                    <!--</label>-->
                  <?php // }?>
                </div>   
                
                <div class="col-md-3">
                    <a href="<?php echo base_url('admin/products') ?>" class="btn-sm btn ink-reaction btn-default pull-right"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back to list</a> 
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-md-12">
                <div class="form-bg">
                <?php $this->load->view('include/message'); ?>
                <div class="card">
                  <div class="card-head">
                    <ul class="nav nav-tabs nav-justified" data-toggle="tabs">
                        <li id="basic_info" class="<?php echo $action == 'basic_info' ? 'active' :''; ?>">
                           <?php 
                            if($mode == 'edit') { ?> 
                              <a href="#basic_info" class="basic_info_tab">Basic Information</a> 
                            <?php } else { ?>
                              <a href="javascript:void(0); ">Basic Information</a>
                          <?php } ?>
                        </li>
                        <li id="details_info" class="<?php echo $action == 'details_info' ? 'active' :''; ?>">
                             <?php 
                            if($mode == 'edit') { ?> 
                              <a href="#details_info" class="details_info_tab">Detail Information</a> 
                            <?php } else { ?>
                              <a href="javascript:void(0); ">Detail Information</a>
                          <?php } ?>
                        </li>
                        <li id="documentation" class="<?php echo $action == 'documentation' ? 'active' :''; ?>">
                            <a href="<?php if($mode == 'edit') {?> #documentation_info <?} else { ?>javascript:void(0); <?php } ?>" class="documentation_tab">Documentation</a>
                        </li>
                    </ul>
                  </div><!--end .card-head -->
                  <div class="card-body tab-content">
                    <div class="tab-pane <?php echo $action == 'basic_info' ? 'active' :''; ?>" id="basic_info">
                        <?php if( $action == 'basic_info'){
                            $this->load->view('admin/products/add/basic_info');
                        }?>
                    </div>
                    <div class="tab-pane <?php echo $action == 'details_info' ? 'active' :''; ?>" id="details_info">
                        <?php if( $action == 'details_info'){
                            $this->load->view('admin/products/add/details_info');
                        }?>
                    </div>
                    <div class="tab-pane <?php echo $action == 'documentation' ? 'active' :''; ?>" id="documentation">
                        <?php if( $action == 'documentation'){
                            $this->load->view('admin/products/add/documentation');
                        }?>
                    </div>
                  </div><!--end .card-body -->
                </div><!--end .card -->
               
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('include/common_script'); ?>
<script src="<?php echo base_url(); ?>assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/libs/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/js/libs/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">
  var mode = '<?php echo $mode; ?>';
  if(mode == 'edit'){
    $('.product_type').attr('disabled',true);
  }

</script>

<?php if( $action == 'basic_info'){ ?>
<script type="text/javascript"> 
    var action_url = '<?php echo base_url('admin/products/product_save/basic_info/lead') ?>';
    var product_type = 'lead';
    var loadFile = function(event) {
      $('#output').attr('src', URL.createObjectURL(event.target.files[0]));
    };
</script>
<script src="<?php echo base_url(); ?>assets/js/product/basic_info.js"></script>
<?php } ?>

<?php if( $action == 'details_info'){ ?>
<script src="<?php echo base_url(); ?>assets/js/product/details_info.js"></script>
<script type="text/javascript">
var action_url = '<?php echo base_url('admin/products/product_save/details_info/lead') ?>';
var product_type = 'lead';
$(function() {
    $('.ckeditors').ckeditor();
});


var loadFile1 = function(event) {
  $('#output1').html('<a target="__blank" href="'+URL.createObjectURL(event.target.files[0])+'" >'+event.target.files[0].name+'</a>');
};

var loadFile2 = function(event) {
  $('#output2').html('<a target="__blank" href="'+URL.createObjectURL(event.target.files[0])+'" >'+event.target.files[0].name+'</a>');
};
</script>
<?php } ?>

<?php if( $action == 'documentation'){ ?>
<script type="text/javascript"> 
    var action_url = '<?php echo base_url('admin/products/product_save/documentation/lead') ?>';
    var remove_url = '<?php echo base_url('admin/products/remove_image') ?>';
    var loadFile = function(event,i) {
      $('#showimg_').attr('src', URL.createObjectURL(event.target.files[0]));
    };
    var src_url = '<?php echo base_url('show_image?image_type=product_images&image_name=default.png'); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/product/documentation.js"></script>
<?php }  ?>



<script type="text/javascript">

$(document).on('change','input[name="product_type"]',function (e) {
  var val = $(this).val();
  var mode = '<?php echo $mode; ?>';
  var product_id = '<?php echo $product_id; ?>';

  if (val == 'Full') {
    if(mode == 'edit'){
      window.location.href = base_url+'admin/products/add?action=basic_info&mode=edit&product_id='+product_id;
    }
    else{
      window.location.href = base_url+'admin/products/add?action=basic_info';
    }
  }
});
var mode = '<?php echo $mode; ?>';
var product_id = '<?php echo $product_id; ?>';
if(mode == 'edit' && product_id != '')
{
$(document).on('click','.basic_info_tab',function (e) {
e.preventDefault()
window.location.href = base_url+'admin/products/add_lead_product?action=basic_info&mode=edit&product_id='+product_id;
});
$(document).on('click','.details_info_tab',function (e) {
  e.preventDefault();
window.location.href = base_url+'admin/products/add_lead_product?action=details_info&mode=edit&product_id='+product_id;
});
$(document).on('click','.documentation_tab',function (e) {
  e.preventDefault();
 window.location.href = base_url+'admin/products/add_lead_product?action=documentation&mode=edit&product_id='+product_id;
});

}

/*var product_type = '<?php //echo $product_type; ?>';
if(product_type == 'lead'){
  $('#ui_checklist').hide();
  $('#api_info').hide();
}
*/
$('#other_programming_lang,#other_framework').hide();//,select[name="framework"]

<?php if (isset($edit_data['programming_lang']) && $edit_data['programming_lang'] == 'other' ) { ?>
  $('#other_programming_lang').show();
<?php } ?>

<?php if (isset($edit_data['framework']) && $edit_data['framework'] == 'other' ) { ?>
  $('#other_framework').show();
<?php } ?>

<?php if(!empty($edit_data['type']) && $edit_data['type'] == 'Multi Tenant' ){ ?>
  $('.reg').removeClass('hide');
 <?php }elseif(!empty($edit_data['type']) && $edit_data['type'] == 'Instance Base'){ ?>
  $('#add_demo_url').removeClass('hide');$('.inst').removeClass('hide');
 <?php } ?>
</script>
<!-- <script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            html += '<button id="removeRow" type="button" class="btn btn-danger" style="position: absolute;">Remove</button>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script> -->