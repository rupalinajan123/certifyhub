<link href="<?php echo base_url(); ?>assets/front/styles/lib.css" rel="stylesheet">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"> -->
<!-- <link rel="icon" href="<?php echo base_url();?>assets/img/favicon.png" sizes="32x32"> -->
<link href="<?php echo base_url(); ?>assets/front/styles/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
<style type="text/css">
 label.error {
    color: red !important;
    font-weight: 600;
} 

.social-media ul li a i {
line-height: normal;
}
  section.sh-inner-header {
margin-top: 0 !important;
}

.header .top_bar_login.ml-auto {
margin-top: 5px;
}

.social-media ul li a i.fa:before {
top: 9px;
position: relative;
}
  .sh-detail-button {
justify-content: center;
}

.sh-detail-button a.btn.btn-primary {
margin: 3px 0;
}
section.sh-product-detail-section .sh-product-detail.sticky {
top: 0 !important;
}
.sh-videos-section .owl-item {
border: 1px solid #00000026;
border-radius: 6px;
margin-bottom: 10px;
padding: 10px;
cursor: pointer;
height: auto;
overflow: hidden;
}

.sh-videos-section .owl-item img {
max-width:100%;
max-height: 85%;
}

/*.tab-content>.active
{

  display: block;
  height: 600px;
  padding-top: 160px;
}*/


/* Start Gallery CSS */
.thumb {
  margin-bottom: 15px;
}
.thumb:last-child {
  margin-bottom: 0;
}
/* CSS Image Hover Effects: https://www.nxworld.net/tips/css-image-hover-effects.html */
.thumb 
figure img {
  -webkit-filter: grayscale(100%);
  filter: grayscale(100%);
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}
.thumb 
figure:hover img {
  -webkit-filter: grayscale(0);
  filter: grayscale(0);
}





</style>


<?php $this->load->view('front/breadcrumb');?>
<?php $this->load->view('front/include/message'); ?>
<section class="sh-product-detail-section">
      <div class="sh-product-detail" id="myHeader">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-3">
              <div class="sh-product-d-img">
                <img name="<?php echo $products['logo']; ?>" alt="Product logo" src="<?php echo base_url('show_image?image_type=product_logo&image_name='.$products['logo']);?>" class="img-fluid">
              </div>
            </div>
            <div class="col-12 col-lg-9">
              <div class="sh-product-d-content">
                <div class="row">
                  <div class="col-12 col-lg-8 sh-detail-title">
                    <h2><?php echo $products['product_name'] ? $products['product_name'] : '';  ?>
                    <!-- <a href="" data-toggle="tooltip" data-placement="top" title="Verified Prodcts"><i class="fa fa-check-circle" aria-hidden="true"></i></a>  -->
                  </h2>
                   
                    <span class="sh-tag">
                      By: <?php echo $products['company_name'] ? $products['company_name'] : '';  ?>
                    </span>
                    <p>
                     <?php echo $products['short_brief'] ? htmlspecialchars_decode(stripslashes($products['short_brief'])) : '';  ?>
                    </p>  <div class="sh-rating">
                                <?php $this->config->load('ratings.php');
                                $product_id  = $products['product_id'];
                                $rating_data = $this->config->item('PODUCT_RATINGS');    
                                $rating_arr  = array();      
                                $star_rating = $no_of_person = "";                       
                                if(isset($rating_data[$product_id])) { $rating_arr = $rating_data[$product_id]; }
                                if(count($rating_arr)>0){
                                  if($product_id != "")
                                  {
                                    $star_rating  = $rating_arr['star_rating'];
                                    $no_of_person = $rating_arr['no_of_persons']; 
                                  }
                                  else
                                  {     
                                    $star_rating = $no_of_person= "0";
                                  }
                                } ?>
                             <span>
                            <?php  for ($i = 1; $i <= 5; $i++) {
                            if ($star_rating >= $i) { ?>
                               <i class="fa fa-star" aria-hidden="true"></i>
                            <?php } else { ?>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php }
                            } ?>
                          </span>
                          (<?php echo ($no_of_person)?$no_of_person:'0';?>) 
                    
                    </div>
                     <?php if(@$package_type != 'private'){?>
                    <div class="sh-bg-box">
                      <div class="sh-share-btn">
                        <span class="sh-text-share-btn"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</span>
                        <ul class="sh-share-items">

                          <li><a href="<?php echo $email_share;?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
                          <li><a href="<?php echo $twitter_share;?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="<?php echo $facebook_share;?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="<?php echo $linkedin_share;?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>

                        </ul>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-12 col-lg-4 sh-detail-button">
                   <!--  <a href="#" class="btn btn-primary">Buy Now</a> -->

                  <?php if($products['product_type'] == 'Lead' && $products['free_trial'] == 't') { ?> 
                    <a class="btn btn-primary  KnowLink product-lead" href="javascript:void(0)"  data-product_id="<?php echo $products['product_id'];?>" data-product_type="<?php echo $products['product_type'];?>" data-action_type="free_trial">free trial</a>
                    <?php } ?>

                    <a href="javascript:void(0)" onclick="scrollSmoothTo('ProductTOPPricing')" class="buyLink  btn btn-primary"><span>Buy Now</span></a>

                    <a href="javascript:void(0)" class=" KnowLink product-lead btn btn-primary" data-product_id="<?php echo $products['product_id'];?>" data-product_type="<?php echo $products['product_type'];?>"  data-action_type="enquiry"><span>Know More</span></a>
                   <?php if (!empty($product_details)) {
                          foreach ($product_details as $product) {                              
                              if (@$product['package_type'] == 'free') { 
                                if($products['product_id']!=50){?>
                                <a class="btn btn-primary trialLink" href="<?php echo $this->config->item('PORTAL_LINK').'/product/order-summary/'.$products['product_id'].'/'.$product['package_id']?>" data-product_id="<?php echo $product['product_id']; ?>" data-package_id="<?php echo $product['package_id']; ?>">Free Trial</a>
                              <?php }else{?>
                            <a href="javascript:void(0)" class="btn btn-primary trialLink" data-product_id="<?php echo $product['product_id']; ?>" data-package_id="<?php echo $product['package_id']; ?>"><span>Free Trial</span></a>
                            <?php  }
                            }
                          }
                        }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sh-product-detail-2 content">
        <div class="container">
          <div class="row">
            <section id="registration-form" class="inner-page borderTOP">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 product_details">
                    <ul class="nav nav-tabs sh-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Overview">Overview</a>
                      </li>
                        <?php  if(sizeof(@$product_images) >0 || @$products['video']!='') { ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Videos">Videos</a>
                      </li>
                    <?php }?>
                      <li class="nav-item">
                       <a class="nav-link"  data-toggle="tab" href="#ProductTOPPricing">Pricing</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Resources">Resources</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Ratings">Ratings</a>
                      </li>
                    <!--   <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Vendor">Vendor</a>
                      </li> -->
                    </ul>
                  </div>
                </div>
              </div>
              <div class="tab-content active" id="myTabContent">
                <div class="tab-pane active show fade" id="Overview">
                  <div class="container">
                    <div class="sh-overview-detail">
                      <h2>Brief</h2>
                      <p><?php echo $products['brief'] ? htmlspecialchars_decode(stripslashes($products['brief'])) : '';  ?></p>
                      <h2>Overview</h2>
                      <?php $this->load->view('front/product/product_details/overview'); ?>

                      
                      <h2> Highlights</h2>
                      <p><?php echo htmlspecialchars_decode($products['highlight']);?> </p>

                      <h2>Usage</h2>
                      <?php $this->load->view('front/product/product_details/usage'); ?>

                      <h2>Support</h2>
                      <!-- <ol>
                        <li>Standard support includes</li>
                      </ol> -->
                      <?php $this->load->view('front/product/product_details/support'); ?>

                      <?php if(!empty($products['product_id'])): ?>
                      <h2>Categories</h2>
                      <div class="sh-tags-btns category_tags">
                        <?php $cat = category_name_by_product_front($products['product_id']); 
                         
                         if (!empty($cat)) {
                         foreach ($cat as $catkey  ) { 

                          $name     = str_replace(' ', '-', trim($catkey['name']));
                          $cat_name   = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $name));
                          ?>
                        <a href="<?php echo  base_url().'products/'.$cat_name; ?>"><?php echo ucfirst($catkey['name']); ?></a>
                         <?php }
                          } ?>
                      </div>
                    <?php endif; ?>

                    </div>
                  </div>
                </div>
              <!-- Videos section -->

                <?php  if(sizeof(@$product_images) >0 || @$products['video']!='') { ?>
                
                <div class="tab-pane fade" id="Videos">
                  <div class="container">
                    <div class="sh-videos-section">
                      <div class="row">
                        <div class="col-12 col-lg-9">
                          <div class="sh-video-wrap">

                          <?php if($products['video']!=''){ ?>
                            <video width="100%" height="100%"  muted="" width="768" height="512" controls>
                            <source type="video/mp4" src='<?php echo base_url(); ?>uploads/products_videos/<?php echo $products["video"]; ?>' >
                            </video>
                          <?php }else{ ?>
                             <p style="text-align: center;">No Video Available.</p>
                          <?php }?>
                          </div>
                        </div>

                      <?php if(!empty($product_images)){?>
                          <div class="col-12 col-lg-3">
                     <?php foreach ($product_images as $key => $value) {  
                        if($value['product_image'] != '' && file_exists('uploads/product_images/'.$value['product_image'])){
                        ?>
                        
                          <div class="owl-item">
                            <div class="course">
                             <!--  <div class="course_image"><img height="512" width="768" src="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>" alt="">
                              </div> -->

                              <div class="course_image" ><a data-fancybox="gallery" href="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>"><img src="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>" alt=""></a>
                              </div>
                              
                            </div>
                          </div> 
                       
                    <?php } 
                    }?></div><?php  }?>  
                     
                      </div>
                      
                 </div> 
                    </div>
                  </div>
         
              <?php } ?>
              <!-- /Videos section -->
                 <!-- pricing -->
                <div class="tab-pane fade" id="ProductTOPPricing">
                  <div class="container">
                    
                      <h2>Pricing</h2>
                 <?php if ( isset($package_type) && $package_type == 'private' ) {
                    $this->load->view('front/product/product_details/private_offer_pricing');

                 }elseif ( $products['product_type'] == 'Lead' ) {
                  $this->load->view('front/product/product_details/lead_product_pricing'); 

                 }else{
                    $this->load->view('front/product/product_details/pricing'); 
                 } ?>
            
               </div>
             </div>

                <div class="tab-pane fade" id="Resources">
                  <div class="container">
                    <div class="sh-overview-detail">
                      <h2>Help Documentation</h2>
                    <?php 
                    $user_manual_file= $this->config->item('USER_MANUAL_UPLOAD') . $products['user_manual'];
                    $case_study_file = $this->config->item('CASE_STUDY_UPLOAD') . $products['case_study'];

                    
                    $sample_report_file = $this->config->item('products_sample_report') . $products['sample_report'];
                    $process_doc_file = $this->config->item('products_process_doc') . $products['process_doc'];


                  
                    $sample_reportFileExist   = is_file($sample_report_file);
                    $process_docFileExist   = is_file($process_doc_file);

                    $caseStudyFileExist   = is_file($case_study_file);
                    
                    $userManualFileExist  = is_file($user_manual_file);?>

                      <div class="sh-tags-btns">
                      <?php if (!empty($products['sample_report']) && $sample_reportFileExist){ ?>
                        <a href="<?php echo base_url('downlaod?file_type=sample_report&file_name='.urlencode($products['sample_report'])); ?>">Data-sheet</a>
                      <?php } else{ ?>
                          <a href="javascript:void(0);" disabled>Data-sheet</a>
                      <?php } ?>
                      <?php if (!empty($products['process_doc']) && $process_docFileExist) { ?>
                        <a href="<?php echo base_url('downlaod?file_type=process_doc&file_name='.urlencode($products['process_doc'])); ?>">Brochure</a>
                        <?php } else{ ?>
                          <a href="javascript:void(0);" disabled>Brochure</a>
                      <?php } ?>
                      <?php if (!empty($products['case_study']) && $caseStudyFileExist) { ?>
                        <a href="<?php echo base_url('downlaod?file_type=case_study&file_name='.urlencode($products['case_study'])); ?>">Case Study</a>
                      <?php } else{ ?>
                          <a href="javascript:void(0);" disabled>Case Study</a>
                      <?php } ?>
                      <?php if (!empty($products['user_manual']) && $userManualFileExist) { ?>
                        <a href="<?php echo base_url('downlaod?file_type=user_manual&file_name='.urlencode($products['user_manual'])); ?>">User Manual</a>
                       <?php } else{ ?>
                          <a href="javascript:void(0);" disabled>User Manual</a>
                      <?php } ?>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="Ratings">
                  <div class="container">
                    <div class="sh-rating-block">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="sh-review-block-1">
                            <span class="sh-rating sh-rating-1">
                              <?php $this->config->load('ratings.php');
                                $product_id  = $products['product_id'];
                                $rating_data = $this->config->item('PODUCT_RATINGS');    
                                $rating_arr  = array();      
                                $star_rating = $no_of_person = "";                       
                                if(isset($rating_data[$product_id])) { $rating_arr = $rating_data[$product_id]; }
                                if(count($rating_arr)>0){
                                  if($product_id != "")
                                  {
                                    $star_rating  = $rating_arr['star_rating'];
                                    $no_of_person = $rating_arr['no_of_persons']; 
                                  }
                                  else
                                  {     
                                    $star_rating = $no_of_person= "0";
                                  }
                                } ?>
                             <span>
                            <?php  for ($i = 1; $i <= 5; $i++) {
                            if ($star_rating >= $i) { ?>
                               <i class="fa fa-star" aria-hidden="true"></i>
                            <?php } else { ?>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php }
                            } ?>
                            
                            </span>
                            <h2> <?php echo ($star_rating)?$star_rating:'0';?> <span> Out of 5 </span></h2>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="sh-rating-wrap-1">
                            <ul>
                              <li>
                                <?php  if(isset($rating_data[$product_id])) { $rating_arr = $rating_data[$product_id]; 
                                 } 
                                $one_star = $two_star = $three_star = $four_star = $five_star ="";
                                if(count($rating_arr)>0){
                                  if($product_id != "")
                                  {
                                    $one_star  = $rating_arr['one_star'];
                                    $two_star  = $rating_arr['two_star']; 
                                    $three_star = $rating_arr['three_star']; 
                                    $four_star = $rating_arr['four_star']; 
                                    $five_star = $rating_arr['five_star']; 
                                  }
                                  else
                                  {     
                                    $one_star = $two_star = $three_star = $four_star = $five_star = "0";
                                  }
                                } 
                                ?>
                                <span>5</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $five_star; ?>%"></div>
                                  </div>
                                  <span><?php echo "(".$five_star.")"; ?> </span>
                                </div>
                              </li>
                              <li>
                                <span>4</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $four_star; ?>%"></div>
                                  </div>
                                  <span><?php echo "(".$four_star.")"; ?></span>
                                </div>
                              </li>
                              <li>
                                <span>3</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $three_star; ?>%"></div>
                                  </div>
                                  <span><?php echo "(".$three_star.")"; ?></span>
                                </div>
                              </li>
                              <li>
                                <span>2</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $two_star; ?>%"></div>
                                  </div>
                                  <span><?php echo "(".$two_star.")"; ?></span>
                                </div>
                              </li>
                              <li>
                                <span>1</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $one_star;?>%"></div>
                                  </div>
                                  <span><?php echo "(".$one_star.")"; ?></span>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                       
                      </div>
                    </div> 
                  </div>
                </div>
                <div class="tab-pane fade" id="Vendor">
                  <div class="container">
                    <div class="sh-vendor-block">
                      <div class="sh-vendor-image">
                        <!-- <img src="images/eNlight-360.png" alt="eNlight-360"> -->
                      </div>
                      <div class="sh-vendor-text">
                        <span>
                          <h2>ESDS Software Solution LTD.</h2>
                          <p>B-24 & 25, NICE Industrial Area  <br>
                            Satpur MIDC,  Nashik 422007
                          </p>
                        </span>
                        <ul>
                          <li>
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            <a href="https://www.esds.co.in/">www.esds.co.in</a>
                          </li>
                          <li>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <a href="mailto:support@spochub.com">support@spochub.com</a>
                          </li>
                          <li>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a href="tel:1800-001-009">1800-001-009</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
  </div>
  </div>
</section>

<!-- Know More Popup -->
<div class="modal fade sh-form-popup" id="kmoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Enquiry </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="#" method="POST" name="product_lead" id="product_lead" class="form floating-label" novalidate="novalidate">
        <input type="hidden" name="csrf_token" value="feb2d0060c6a722761f4be77124212ed">              <input type="hidden" name="product_type" id="product_type" value="Full">
        <input type="hidden" name="product_id" value="29">
        <input type="hidden" name="action_type" value="enquiry">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="number">Contact Number <span class="required">*</span></label>
              <input type="text" tabindex="1" name="phone" id="phone" class="form-control" placeholder="Contact Number" value="">
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="Email">Email ID<span class="required">*</span></label>
              <input type="text" tabindex="2" name="email" id="email" class="form-control" placeholder="Email Id" value="">
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="first_name">First Name </label>
              <input type="text" tabindex="3" name="first_name" id="first_name" class="form-control nospace" placeholder="First Name" value="">
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="last_name">Last Name </label>
              <input type="text" tabindex="4" name="last_name" id="last_name" class="form-control nospace" placeholder="Last Name" value="">
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <button type="submit" name="submit" class="btn btn-primary ml-1">Submit</button>
          <button type="button" class="btn btn-dismiss" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
    
  </div>
</div>
</div>


<script src="<?php echo base_url(); ?>assets/front/js/jquery-3.5.1.slim.min.js"></script>


<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>


    <?php if ($products['product_id'] == 50) { ?>
    <script type="text/javascript">     
    //view_more
   
   $(document).on('change','select#package_name',function (e) {
    var package_id = $(this).val();
      $.ajax({
          url: base_url+'package-details',
          data: {'package_id':package_id}, 
          type: "POST",
          dataType: 'json',
          success: function(data){
              if (data.status) {
                  $('input[name="package_id"]').val(data.package_id);
                  $('#covid_pkg_cost').html(data.pkg_cost);
              }
          }
      });
   });
   load_a();
    /*$("#register_covid_product").modal({
        backdrop: 'static',
        keyboard: false,
    });*/
    $("#register_covid_product").on('hide.bs.modal', function(){
       $('#popup_model').html('');
       $('div.modal-backdrop').remove();
    });
  function load_a() {

    var $this =  $('a.buy-product');
    var product_id = $this.attr('data-product_id');
    var package_id = $this.attr('data-package_id');
    $.ajax({
        url: base_url+'home/summary',
        data: {'product_id': product_id,'package_id':package_id}, 
        type: "POST",
        dataType: 'json',
        success: function(data){
            if (data.status) {
                $('#popup_model').html('').html(data.body);
                $('#register_covid_product').modal('show');
            }
        }
    });
  }
</script>
<?php } ?>

<?php if ( isset($package_type) && $package_type == 'private' ) { ?>
  <script src="<?php echo base_url(); ?>assets/front/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript">

    scrollSmoothTo('ProductTOPPricing');


</script>
 
<?php } ?> 


<script type="text/javascript">
      function scrollSmoothTo(pricing) {
    $('div#myTabContent').find('.tab-pane').removeClass('active show');
    $('div#myTabContent').find('#'+pricing).addClass('active show');

    $("ul#myTab").find("a.nav-link").removeClass('active');

    $("ul#myTab").find("a.nav-link").each(function() {
      $(this).removeClass('active');
        if($( this ).attr('href') == '#'+pricing){$(this).addClass('active')}
    });

    var element = document.getElementById('ProductTOP');
     element.scrollIntoView({ block: 'start', behavior: 'smooth' });

}
   //view_more
   $(document).on('click','a.view_more',function (argument) {

     $(this).parent().parent().find('li.flitem').removeClass('flitem');
     $(this).remove()
   });

         $('.product-view').each(function() {
        var content = $(this).text(); 
        if(content.length < 100){
         // $("#overview").removeClass("showview");
         $("#btn-product").css('display','none');
        }
        else{
         // $("#overview").addClass("showview");
          $("#btn-product").css('display','block');
        }
      });

      var x=5;
      var size_li = $('.reviewList').find('li').length;
      $('ul.reviewList li').hide();
      $('ul.reviewList li:lt('+x+')').show();

      $('#showMore').click(function () {

          x= (x+5 <= size_li) ? x+5 : size_li;
          $('ul.reviewList li:lt('+x+')').show();
          $('.showLess_div').css('display','block');
          
          if(x == size_li){
            $('.showMore_div').css('display','none');
          }
      });

      $('#showLess').click(function () {
          x=(x-5<0) ? 3 : x-5;
          $('.reviewList li').not(':lt('+x+')').hide();
          $('.showMore_div').css('display','block');
          $('.showLess_div').css('display','block');
          //$('#showLess').show();
        
          if(x == 0){
              $('.showLess_div').hide();
          }
      });

      // ---- Social Media --------------------
$(".social-open-menu").click(function() {
    $(".social-itens").toggleClass("open");
    $(".social-itens").toggleClass("hidden");
});

<?php if(!empty($product_images)){?>
// Fancybox Config
$('[data-fancybox="gallery"]').fancybox({
  buttons: [
    "slideShow",
    "thumbs",
    "zoom",
    "fullScreen",
    "share",
    "close"
  ],
  loop: false,
  protect: true
});



$(document).ready(function() {
  $(".gallery").magnificPopup({
    delegate: "a",
    type: "image",
    tLoading: "Loading image #%curr%...",
    mainClass: "mfp-img-mobile",
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
    }
  });
});
<?php } ?>

</script>


<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>