<!--=========================================
  =            Home middle section            =
  ==========================================-->
<section class="sh-inner-header sh-top-margin sh-inner-header-type-2">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb" class="sh-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url('products')?>">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $products['product_name']; ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<section class="sh-product-detail-section">
    <div class="sh-product-detail" id="myHeader">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-4">
              <div class="sh-product-d-img">
                <!-- <img src="images/icon/image-6.png" alt="QAD" class="img-fluid"> -->
                <img src="<?=base_url('show_image?image_type=product_logo&image_name='.$products['logo'])?>" alt="Product logo" name="<?=$products['logo']?>" class="img-fluid">
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="sh-product-d-content">
                <div class="row">
                  <div class="col-12 col-lg-8 sh-detail-title">
                    <div class="breadcrumb-content mb-3">
                      <h2><?php echo $products['product_name'] ? $products['product_name'] : '';  ?></h2>
                      <div class="p-list">
                        <span class="price"> Rs. <?php echo $products['price'] ? number_format($products['price'],2) : number_format(0,2);  ?> </span>
                        <span> <del> <i class="fa fa-inr"></i> <?php echo $products['mrp'] ? number_format($products['mrp']*2,2) : number_format(0,2); ?> </del> &nbsp;MRP </span>
                        <small class="d-block">*Excluding GST</small>
                        <small class="d-block ex_tagline">(It is recommended to buy video based learning and practice test)</small>
                      </div>
                      <p class="mb-1 mt-3"><b>This Product is including</b></p>
                      <ul class="terms-list check-list mt-2">
                        <li><i class="fa fa-check check-ico "></i>Final Test Exam Fees </li>
                      </ul>
                      <p><?php echo $products['short_brief'] ? htmlspecialchars_decode(stripslashes($products['short_brief'])) : '';  ?></p>
                      <div class="sh-p-time">
                        <span class="sh-time"><i class="fi fi-sr-calendar"></i> 6 Months </span>
                        <span class="sh-time"><i class="fi fi-sr-clock"></i> 18 Jul, 2023 </span>
                      </div>
                      <div class="sh-review-star">
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
                    </div>
                    
                    
                  </div>
                  <div class="col-12 col-lg-4 sh-detail-button">
                    <div class="sh-bg-box">
                      <div class="sh-share-block-main">
                        <span class="sh-text-share-block-btn">Share : </span>
                        <ul class="sh-share-block">
                          <!-- <li><a href="https://www.facebook.com/SPOCHUBOfficial/" target="_blank"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li> -->
                          <li><a rel="nofollow" href="<?php echo $facebook_share;?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                          <li><a rel="nofollow" href="<?php echo $twitter_share;?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                          <li><a rel="nofollow" href="<?php echo $linkedin_share;?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                          <li><a rel="nofollow" href="<?php echo $instagram_share;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                      </div>
                      <input type="hidden" name="product_id" id="product_id" value="<?=$product_id?>">
                      <a href="javascript:void(0)" onclick="scrollSmoothTo('ProductTOPPricing')" class="btn btn-primary buy_now">Buy Now</a>
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Send Inquiry</a>
                    </div>
                    
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
        <section id="registration-form" class="inner-page borderTOP" style="text-align: justify;">
          <div class="container">
            <div class="row">
              <div class="col-md-12 product_details">
                <ul class="nav nav-tabs sh-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#Overview">Overview</a>
                  </li>
                  <?php if($products['brief'] !='') { ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Description">Description</a>
                  </li>
                  <?php } ?>
                  <?php if(!empty($product_images)){?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#SampleCertificate">Sample Certificate</a>
                  </li>
                    <?php } ?>
                    <?php if (!empty($products['sample_report']) && $sample_reportFileExist){ ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Resources">Certificate Resources</a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="tab-content active" id="myTabContent">
            <div class="tab-pane active show fade" id="Overview">
              <div class="container">
                <div class="sh-overview-detail">
                  <!--<h2>Descriptions</h2>-->

                  <!--<p><?php echo $products['brief'] ? htmlspecialchars_decode(stripslashes($products['brief'])) : '';  ?></p>-->
                  <h2>Benefits</h2>
                  <?php $this->load->view('front/product/product_details/overview'); ?>
                  <?php if( $products['highlight'] !=''){ ?>
                  <h2> Highlights</h2>
                  <p><?php echo htmlspecialchars_decode($products['highlight']);?> </p>
                  <?php } ?>
                  <h2>Delivery Methodology</h2>
                  <?php $this->load->view('front/product/product_details/usage'); ?>
                  <?php if( $products['support'] !=''){ ?>
                  <h2>Other</h2>
                  <!-- <ol>
                    <li>Standard support includes</li>
                  </ol> -->
                  <?php $this->load->view('front/product/product_details/support'); ?>
                      <?php } ?>
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
            <div class="tab-pane active show fade" id="Description" style="min-height: 0px;">
              <div class="container">
                <div class="sh-overview-detail">
                  <h2>Descriptions</h2>

                  <p><?php echo $products['brief'] ? htmlspecialchars_decode(stripslashes($products['brief'])) : '';  ?></p>
                 
                </div>
              </div>
            </div>
            <?php  if(sizeof(@$product_images) >0 || @$products['video']!='') { ?>
            <div class="tab-pane fade" id="SampleCertificate">
              <div class="container">
                <div class="sh-videos-section">
                  <div class="row">
                    <div class="col-12 col-lg-8" style="overflow-y: scroll; height: 467px;">
                     <?php if(!empty($product_images)){?>
                      <?php foreach ($product_images as $key => $value) {
                        if($value['product_image'] != '' && file_exists('uploads/product_images/'.$value['product_image'])){?>
                          <div class="owl-item">
                            <div class="course">
                                <!--<div class="course_image"><img height="512" width="768" src="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>" alt="">-->
                                <!--</div>-->
                                <div class="course_image" >
                                    <a data-fancybox="gallery" href="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>">
                                        <img src="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>" alt="product image" style="width:100%;height:100%">
                                    </a>
                                </div>
                            </div>
                          </div>
                        <?php }
                       } ?>
                     
                    <?php  }?>
                    </div>
                    <?php if(!empty($product_images)){?>
                      <div class="col-12 col-lg-3" style="overflow-y: scroll; height: 467px;">
                      <?php foreach ($product_images as $key => $value) {
                        if($value['product_image'] != '' && file_exists('uploads/product_images/'.$value['product_image'])){?>
                          <div class="owl-item">
                            <div class="course">
                                <!--<div class="course_image"><img height="512" width="768" src="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>" alt="">-->
                                <!--</div>-->
                                <div class="course_image" >
                                    <a data-fancybox="gallery" href="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>">
                                        <img src="<?php echo base_url().'uploads/product_images/'.$value['product_image']; ?>" alt="product image" style="width:100%;height:100%">
                                    </a>
                                </div>
                            </div>
                          </div>
                        <?php }
                       } ?>
                      </div>
                    <?php  }?>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            
            <?php } ?>
            <?php if (!empty($products['sample_report']) && $sample_reportFileExist){ ?>
            <div class="tab-pane fade" id="Resources">
              <div class="container">
                <div class="sh-overview-detail">
                  <h2>Overview</h2>
                  <?php 
                      $user_manual_file= $this->config->item('USER_MANUAL_UPLOAD') . $products['user_manual'];
                      $case_study_file = $this->config->item('CASE_STUDY_UPLOAD') . $products['case_study'];
                      $sample_report_file = $this->config->item('products_sample_report') . $products['sample_report'];
                      $process_doc_file = $this->config->item('products_process_doc') . $products['process_doc'];
                      
                      $sample_reportFileExist   = is_file($sample_report_file);
                      $process_docFileExist   = is_file($process_doc_file);
                      $caseStudyFileExist   = is_file($case_study_file);
                      $prod_name = $this->uri->segment('2');
                      $userManualFileExist  = is_file($user_manual_file);
                  ?>
                  
                  
                  <div class="sh-tags-btns">
                    <?php if (!empty($products['sample_report']) && $sample_reportFileExist){ ?>
                      <a href="<?php echo base_url('downlaod?file_type=sample_report&file_name='.urlencode($products['sample_report']).'&prod_name='.$prod_name); ?>">
                      <?php $path_info = pathinfo(base_url().'/uploads/products_sample_report/'.urlencode($products['sample_report']));
                        if($path_info['extension']=='pdf'){?>
                           <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
                            <?php
                        }else{?>
                            <!--<img src='<?=base_url()?>assets/csc/images/doc.png' alt="photo1" height="100" width="100" />-->
                            <i class="fa fa-file-word-o" style="font-size:48px;color:blue"></i>
                        <?php }
                         ?>
                         <br>Data-sheet
                      </a>
                      <?php } else{ ?>
                        <!--<a href="javascript:void(0);" disabled>Data-sheet</a>-->
                      <?php } ?>
                      <?php if (!empty($products['process_doc']) && $process_docFileExist) { ?>
                        <a href="<?php echo base_url('downlaod?file_type=process_doc&file_name='.urlencode($products['process_doc']).'&prod_name='.$prod_name); ?>">
                            <?php $path_info = pathinfo(base_url().'/uploads/products_process_doc/'.urlencode($products['process_doc']));
                        if($path_info['extension']=='pdf'){?>
                           <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
                            <?php
                        }else{?>
                            <!--<img src='<?=base_url()?>assets/csc/images/doc.png' alt="photo1" height="100" width="100" />-->
                            <i class="fa fa-file-word-o" style="font-size:48px;color:blue"></i>
                        <?php }
                         ?>
                         <br>Brochure</a>
                      <?php } else{ ?>
                        <!--<a href="javascript:void(0);" disabled>Brochure</a>-->
                      <?php } ?>
                      <?php if (!empty($products['case_study']) && $caseStudyFileExist) { ?>
                        <a href="<?php echo base_url('downlaod?file_type=case_study&file_name='.urlencode($products['case_study']).'&prod_name='.$prod_name); ?>">
                             <?php $path_info = pathinfo(base_url().'/uploads/case_study/'.urlencode($products['case_study']));
                        if($path_info['extension']=='pdf'){?>
                           <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
                            <?php
                        }else{?>
                            <!--<img src='<?=base_url()?>assets/csc/images/doc.png' alt="photo1" height="100" width="100" />-->
                            <i class="fa fa-file-word-o" style="font-size:48px;color:blue"></i>
                        <?php }
                         ?>
                         <br>Case Study</a>
                      <?php } else{ ?>
                        <!--<a href="javascript:void(0);" disabled>Case Study</a>-->
                      <?php } ?>
                      <?php if (!empty($products['user_manual']) && $userManualFileExist) { ?>
                        <a href="<?php echo base_url('downlaod?file_type=user_manual&file_name='.urlencode($products['user_manual']).'&prod_name='.$prod_name); ?>">
                             <?php $path_info = pathinfo(base_url().'/uploads/case_study/'.urlencode($products['case_study']));
                        if($path_info['extension']=='pdf'){?>
                           <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
                            <?php
                        }else{?>
                            <!--<img src='<?=base_url()?>assets/csc/images/doc.png' alt="photo1" height="100" width="100" />-->
                            <i class="fa fa-file-word-o" style="font-size:48px;color:blue"></i>
                        <?php }
                         ?>
                         <br>User Manual</a>
                      <?php } else{ ?>
                        <!--<a href="javascript:void(0);" disabled>User Manual</a>-->
                      <?php } ?>
                  </div>
                    
                    
                  <!--<div class="sh-tags-btns">-->
                  <!--  <a href="#">Data-sheet</a>-->
                  <!--  <a href="#">Brochure</a>-->
                  <!--  <a href="#">Case Study</a>-->
                  <!--  <a href="#">User Manual</a>-->
                  <!--  <a href="#">Presentation</a>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </section>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>
<!--====  End of Home middle section  ====-->
    <!-- Checkout Modal -----------------
=================================================-->
<div class="modal fade sh-login-page" id="checkoutModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="checkout-box">
          <img src="<?=base_url()?>assets/csc/images/checkout.jpg" alt="checkout">

          <!-- <h5>Please check the details carefully, once an order is placed can not be canceled or refunded.</h5> -->
          <h5>Please check the details carefully. Once an order is placed, it cannot be cancelled or refunded.</h5>

          <button type="button" id="okay_check" class="btn btn-primary sh-checkout mt-3" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--=================================
=            Inquiry Form          =
==================================-->
<div class="modal fade sh-inquiry-form" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Send as and Inquiry</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form action="#" method="POST" name="product_lead" id="product_lead" class="form floating-label" action="<?php base_url(); ?>front-end/products/save_lead_enquiry">
    <?php  get_csrf_token(); ?>
    <input type="hidden" name="product_type" id="product_type" value="<?php echo $product_type; ?>">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="action_type" value="enquiry">
  <div class="modal-body">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label>Email ID</label>
          <input type="text" name="email" id="email" class="form-control" placeholder="Enter email id">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label>Phone</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text p-0" id="inputGroupPrepend">
                <select class="form-control">
                  <option>+91</option>
                </select>
              </span>
            </div>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" aria-describedby="inputGroupPrepend" required>
            
          </div>
        </div>
      </div>
      <!-- <div class="col-12 col-md-12">
        <div class="form-group">
          <label>Certificate Name</label>
          <select class="form-control">
            <option>Certificate Name </option>
          </select>
        </div>
      </div> -->
      <div class="col-12 col-md-12">
        <div class="form-group">
          <label>Message</label>
          <input type="text" name="message" class="form-control" placeholder="Enter Message">
        </div>
      </div>
         <div class="col-12 col-md-12">
      <div class="form-check">
        <input type="checkbox" name="whatsappcheck" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">I want to receive updates directly on WhatsApp</label>
      </div>
      <p>
        By tapping submit, you agree to Knowledge <a href="#"> Privacy Policy </a> and <a href="#"> Tearms & Conditions </a>
      </p>
    </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
</div>
</div>
</div>

<script>

   // window.onscroll = function() {myFunction()};
    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;
    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
  
    function scrollSmoothTo(scroll_id) {
        $('div#myTabContent').find('.tab-pane').removeClass('active show');
        $('div#myTabContent').find('#'+scroll_id).addClass('active show');
        $("ul#myTab").find("a.nav-link").removeClass('active');
        $("ul#myTab").find("a.nav-link").each(function() {
        $(this).removeClass('active');
            if($( this ).attr('href') == '#'+scroll_id){$(this).addClass('active')}
        });
        var element = document.getElementById(scroll_id);
         element.scrollIntoView({ block: 'start', behavior: 'smooth' });
    }
</script>

<script type="text/javascript">
var load_order_summary = "<?php echo base_url('order-summary')?>";
var ajax_url = base_url + 'front-end/products/save_lead_enquiry';
$(function() {
    $(document).on('click', 'a.buy_now', function(e) {
        $('#checkoutModal').modal("show");
        //location.href = load_order_summary;
        // Swal.fire("Cancellation and refund not allowed!","",'warning').then((value) => {
        //         location.href = load_order_summary;
        // });
        var product_id = $('#product_id').val();
        sessionStorage.setItem('product_id', product_id);
        //location.href = load_order_summary;
    });
    
    $(document).on('click', '#okay_check', function(e) {
        //$('#checkoutModal').modal("show");
        location.href = load_order_summary;
       
    });

    $("form[name='product_lead']").validate({
    rules: {
      first_name: {
       /* lettersonly: true,*/
       required: true,
        minlength: 2,
        maxlength: 100,
       // accept:{"[a-zA-Z]+"} , 
      },
      last_name: {
      /* lettersonly: true,*/
      required: true,
        minlength: 2,
        maxlength: 100,
       // accept: "[a-zA-Z]+", 
      },

      email: {
        email: true,
      },

      phone: {
        required: true,
        minlength: 10,
        maxlength:10,
        number:true,
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
});

</script>