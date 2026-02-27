<?php //action="<?php echo base_url('partner/products/product_save/documentation/full') ?>
 <form autocomplete="off" method="POST" name="product_form" enctype="multipart/form-data">
  <input type="hidden" name="mode" id="mode" value="<?php echo @$mode ?>">
	<input type="hidden" name="id" id="id" value="<?php echo @$product_id ?>">
	<input type="hidden" name="status" value="<?php echo @$edit_data['status'] ?>">
	<input type="hidden" name="remark_value" id="remark_value" value="">
	<input type="hidden" name="prod_type" id="prod_type" value="<?php echo @$edit_data['type']?>">
<br>
	<div class="row mx-0">
		<div class="col-lg-6 col-md-6">
			<div class="form-group row">
              <div class="col-sm-4">
                <h4> Case Study:</h4>
              </div>
              <div class="col-sm-8">
              	<small>(Size:25 MB, only jpg, jpeg, png, ppt, doc, docx, pdf.)</small>
                 <label class="fileContainer">
                <input type="hidden" value="<?php echo @$edit_data['case_study']??set_value('case_study'); ?>" id="old_case_study" name="old_case_study">

                <input type="file" class="d-inline-block mb-3" name="case_study"  id="case_study" value="<?php @$edit_data['case_study']?>">
                 </br>
                <span id="case_study_error" style="color: red;"></span>
              </br>

                  <?php if(!empty(trim(@$edit_data['case_study'])) && file_exists('../uploads/case_study/'.$edit_data['case_study'])){?>
                    <div class="col-md-4" id="case_study_div">
                      <!-- <div class="card-body"> -->
                        <?php 
                          echo trim(@$edit_data['case_study']);

                           if(strpos(@$edit_data['case_study'], '.png') || strpos(@$edit_data['case_study'], '.jpg') || strpos(@$edit_data['case_study'], '.jpeg') || strpos(@$edit_data['case_study'], '.gif') ){ ?>
                            <img src="<?php echo $this->config->item('SITE_LINK').'/uploads/case_study/'.$edit_data['case_study']; ?>" width="100" height="60" id="case_study">
                        <?php } ?>
                        
                        <div class="d-flex mt-2">
                          <button type="button" value="Remove" id="btn_remove_0" class="btn-danger mr-2"><span class="fa fa-times" onclick="removeImg('<?php echo $edit_data['id']; ?>', 0, 'products', 'case_study')"></span></button>
                          <!--  </div> -->
                          <a target="__blank" id="btn_download_0" href="<?php echo base_url('downlaod?file_type=case_study&file_name='.$edit_data['case_study'].'&source=YES'); ?>" class="btn btn-info btn-sm"><i class="md md-cloud-download"></i></a>
                        </div>
                   </div>
                <?php }  ?>
                 
               
                </label>
                <span id="output2"></span>
                
              </div>
              
            </div>

            <div class="form-group row">
              <div class="col-sm-4">
                <h4> User Manual:<!-- <span class="required">*</span> --></h4>
                
              </div>
              <div class="col-sm-8">
              	<span><small>(Size:25 MB, only jpg, jpeg, png, ppt, doc, docx, pdf.)</small></span>
                <input type="hidden" value="<?php echo !empty(@$edit_data['user_manual']) ? @$edit_data['user_manual'] : ''; ?>"
                id="old_user_manual" name="old_user_manual">
                <label class="fileContainer">
                <input type="file" class="d-inline-block mb-3" name="user_manual" id="user_manual">
                 </br>
                <span id="user_manual_error" style="color: red;"></span>
                 </br>
                  
                  <?php if(!empty(trim(@$edit_data['user_manual'])) && file_exists('../uploads/user_manual/'.$edit_data['user_manual'])){?>
                      <div class="col-md-4" id="user_manual_div">
                      <!-- <div class="card-body"> -->

                        <?php 
                          echo trim(@$edit_data['user_manual']);

                          if(strpos(@$edit_data['user_manual'], '.png') || strpos(@$edit_data['user_manual'], '.jpg') || strpos(@$edit_data['user_manual'], '.jpeg') || strpos(@$edit_data['user_manual'], '.gif')){ ?>
                            <img src="<?php echo $this->config->item('SITE_LINK').'/uploads/user_manual/'.$edit_data['user_manual']; ?>" width="100" height="60" id="user_manual">
                        <?php } ?>
                        
                        <div class="d-flex mt-2">
                          <button type="button" value="Remove" id="btn_remove_0" class="btn-danger mr-2"><span class="fa fa-times" onclick="removeImg('<?php echo $edit_data['id']; ?>', 0, 'products', 'user_manual')"></span></button>
                          <!--  </div> -->
                          <a target="__blank" id="btn_download_0" href="<?php echo base_url('downlaod?file_type=user_manual&file_name='.$edit_data['user_manual'].'&source=YES'); ?>" class="btn btn-info btn-sm"><i class="md md-cloud-download"></i></a>
                        </div>
                   </div>
                 <?php }?>
                </label>
                <span id="output1"></span>
              </div>
            </div>
            
		</div>

		<div class="col-lg-6 col-md-6">
			<!-- Videos/Sample Reports/Process Doc  -->
            

            <div class="form-group row">
              <div class="col-sm-4">
                <h4>Data Sheet:</h4>
                
              </div>
              <div class="col-sm-8">
              	<span><small>(Size:25 MB, only jpg, jpeg, png, ppt, doc, docx, pdf.)</small></span>
                <input type="hidden" value="<?php echo @$edit_data['sample_report']??set_value('sample_report'); ?>" id="old_sample_report" name="old_sample_report">
                <label class="fileContainer">
                  <input type="file" class="d-inline-block mb-3" name="sample_report"  id="sample_report">
                   </br>
                  <span id="sample_report_error" style="color: red;"></span>
                </br>
                  <span id="output1"></span>
                  <?php if(!empty(trim(@$edit_data['sample_report'])) && file_exists('../uploads/products_sample_report/'.$edit_data['sample_report'])) {?>
                    <div class="col-md-4" id="sample_report_div">
                      <!-- <div class="card-body"> -->
                        <?php 
                          echo trim(@$edit_data['sample_report']);

                          if(strpos(@$edit_data['sample_report'], '.png') || strpos(@$edit_data['sample_report'], '.jpg') || strpos(@$edit_data['sample_report'], '.jpeg') || strpos(@$edit_data['sample_report'], '.gif')){ ?>
                            <img src="<?php echo $this->config->item('SITE_LINK').'/uploads/products_sample_report/'.$edit_data['sample_report']; ?>" width="100" height="60" id="sample_report">
                        <?php } ?>
                        
                        <div class="d-flex mt-2">
                          <button type="button" value="Remove" id="btn_remove_0" class="btn-danger mr-2"><span class="fa fa-times" onclick="removeImg('<?php echo $edit_data['id']; ?>', 0, 'products', 'sample_report')"></span></button>
                          <!--  </div> -->
                          <a target="__blank" id="btn_download_0" href="<?php echo base_url('downlaod?file_type=sample_report&file_name='.$edit_data['sample_report'].'&source=YES'); ?>" class="btn btn-info btn-sm"><i class="md md-cloud-download"></i></a>
                        </div>
                   </div>
                 <?php }?>
                </label>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-4">
                <h4>Brochure:</h4>
                
              </div>
              <div class="col-sm-8">
              	<span><small>(Size:25 MB, only jpg, jpeg, png, ppt, doc, docx, pdf.)</small></span>
                <input type="hidden" value="<?php echo @$edit_data['process_doc']??set_value('process_doc'); ?>" id="old_process_doc" name="old_process_doc">
                </br>
                <label class="fileContainer">
                  <input type="file" class="d-inline-block mb-3" name="process_doc" id="process_doc">
                   </br>
                  <span id="process_doc_error" style="color: red;"></span>
                  </br>
                  <span id="output1"></span>
                  <?php if(!empty(trim(@$edit_data['process_doc'])) && file_exists('../uploads/products_process_doc/'.$edit_data['process_doc'])){?>

                    <div class="col-md-4" id="process_doc_div">
                      <?php //echo $edit_data['process_doc']; ?>
                      <!-- <div class="card-body"> -->
                        <?php 
                         echo trim(@$edit_data['process_doc']);

                         if(strpos(@$edit_data['process_doc'], '.png') || strpos(@$edit_data['process_doc'], '.jpg') || strpos(@$edit_data['process_doc'], '.jpeg') || strpos(@$edit_data['process_doc'], '.gif')){ ?>
                            <img src="<?php echo $this->config->item('SITE_LINK').'/uploads/products_process_doc/'.$edit_data['process_doc']; ?>" width="100" height="60" id="process_doc">
                        <?php } ?>
                       
                       <div class="d-flex mt-2"> 
                          <button type="button" value="Remove" id="btn_remove_0" class="btn-danger mr-2"><span class="fa fa-times" onclick="removeImg('<?php echo $edit_data['id']; ?>', 0, 'products', 'process_doc')"></span></button>
                          <!--  </div> -->
                          <a target="__blank" id="btn_download_0" href="<?php echo base_url('downlaod?file_type=process_doc&file_name='.$edit_data['process_doc'].'&source=YES'); ?>" class="btn btn-info btn-sm"><i class="md md-cloud-download"></i></a>
                        </div>
                   </div>
                 <?php }?>
                </label>
              </div>
            </div>
		</div>
	</div>

  <input type="hidden" name="image_count" value="5">

	<div class="row mx-0">
		<hr>
		<div class="col-lg-12 col-md-12">
			<div class="form-group row">
              <div class="col-sm-4">
                <h4>Product Images and Video:</h4> <small>(size:2MB, only jpg, jpeg, png.)</small>
              </div>
              <div class="col-sm-12">
 
                  
                  <?php for($i=0;$i<5;$i++){ 
                    if(@$product_images[$i]['product_image']!=''){
                      $image = $product_images[$i]['product_image'];
                    }
                    else{
                      $image = 'default.png';
                    }
                    $j = $i+1;
                  ?>
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <label class="fileContainer">
                          <input type="file" class="d-inline-block product_images" onchange="loadFile(event, <?php echo $j; ?>)" accept="image/*" name="product_image_<?php echo $j;?>" id="product_image_<?php echo $j;?>" value="Logo" >
                           </br>
                          <span id="product_image_error_<?php echo $j; ?>" style="color: red;"></span>
                        </label>
                        <!-- <br>
                        <small>(size:2MB, only jpg, jpeg, png.)</small> -->
                         
                        <img height="60" width="100" id="showimg_<?php echo $j;?>" src="<?php echo base_url('show_image?image_type=product_images&image_name='.$image); ?>" />

                        <?php if(isset($product_images[$i]['product_image'])){?> 
                          <button type="button" value="Remove" id="btn_remove_<?php echo $j; ?>" class="btn-danger"><span class="fa fa-times" onclick="removeImg('<?php echo $product_images[$i]['id']; ?>', '<?php echo $j; ?>', 'product_images', 'product_image')"></span></button>
                          <input type="hidden" name="old_product_image_<?php echo $j; ?>"  ID ="old_product_image_<?php echo $j; ?>"value="<?php echo $product_images[$i]['product_image']; ?>">
 
                          <a target="__blank" id="btn_download_<?php echo $j; ?>" href="<?php echo base_url('downlaod?file_type=product_images&file_name='.$product_images[$i]['product_image'].'&source=YES'); ?>" class="btn btn-info btn-sm"><i class="md md-cloud-download"></i></a>

                        <?php } ?>

                      </div>

                    </div>
                  <?php } ?>
                
                <?php // } ?>

              </div>
              
            </div>

            <hr>
            <div class="col-lg-12 col-md-12">
              <div class="form-group row">
                <div class="col-sm-4">
                  <h4> Video:</h4><small>(Size:25 MB, only .flv, .mp4, .ts, .3gp, .mov, .avi)</small>
                </div>

              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-6">
                    <input type="hidden" value="<?php echo @$edit_data['video']??set_value('video'); ?>" id="old_video" name="old_video">
                    <label class="fileContainer">
                      <input type="file" class="d-inline-block mb-3" name="video"  id="video">
                       </br>
                      <span id="video_error" style="color: red;"></span>
                    </label>
                    </br>
                    <span id="output1"></span>
                  <?php if(!empty(trim(@$edit_data['video'])) && file_exists('uploads/products_videos/'.$edit_data['video'])){?>

                    <div class="col-md-4" id="video_div">
                      <!-- <div class="card-body"> -->
                        <?php 
                         //if(strpos(@$edit_data['video'], '.flv') || strpos(@$edit_data['video'], '.mp4') || strpos(@$edit_data['video'], '.ts') || strpos(@$edit_data['video'], '.3gp')){ ?>
                          <!-- <video width="420" height="315" controls>
                            <source src="<?php //echo base_url(); ?>uploads/products_videos/<?php //echo $products['video']; ?>" type="video/mp4">
                          </video> --> 

                          <iframe width="420" height="315" id="video" src="<?php echo base_url(); ?>uploads/products_videos/<?php echo $edit_data['video']; ?>" controls>
                          </iframe>
                        <?php //}
                        /*else{ ?>
                          <label><?php echo trim(@$edit_data['video']); ?></label>
                        <?php }*/ ?>
                        
                         </br>
                        <button type="button" value="Remove" id="btn_remove_0" class="btn-danger"><span class="fa fa-times" onclick="removeImg('<?php echo $edit_data['id']; ?>', 0, 'products', 'video')"></span></button>
                        <!--  </div> -->
                        <a target="__blank" id="btn_download_0" href="<?php echo base_url('downlaod?file_type=video&file_name='.$edit_data['video'].'&source=YES'); ?>" class="btn btn-info btn-sm"><i class="md md-cloud-download"></i></a>
                   </div>
                 <?php }?>
                </div>
              </div>
            </div>
          

      	<div class="col-md-12 text-center">
        <?php if($this->session->userdata('user_type') == 'admin'){
              $curl = 'admin/products';
            } else{
              $curl = 'partner/products';
            }?>
          <a href="<?php echo base_url().$back_url; ?>" class="btn-sm mt-4 btn ink-reaction btn-default"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back to Details info</a>
          <a href="<?php echo base_url($curl) ?>" class=" btn-sm btn ink-reaction btn-danger mt-4">Cancel</a>
          <button type="submit" name="submit_documentation" value="submit" class="btn-sm btn ink-reaction btn-primary mt-4">Save & Continue &nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
    		</div>

	</div>
</form>




