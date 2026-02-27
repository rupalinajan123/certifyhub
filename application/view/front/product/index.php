    <!--=========================================
    =            Home middle section            =
    ==========================================-->
    
    <section class="sh-inner-header sh-top-margin">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb" class="sh-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    
    
    <section class="sh-product-listing sh-product-listing_1">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-3">
            <!-- button for mobile view-->
            <button class="sh-button "><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
            <ul class="sh-left-filter">
              <li class="sh-category-1">
                <a href="#">Categories</a>
                <ul>
                <?php if(!empty($cat_list)){
                foreach($cat_list as $rows){ ?>
                  <li>
                  <!--  <input class="styled-checkbox" id="Finance" type="checkbox" value="value1"> -->  
                     <a  href="<?php echo base_url('products/'.replace_space_with_dash($rows['name']));?>"  class="has-subcategory collapsed <?php if(trim($category_id) == $rows['cat_id']){ echo "active";}?>" active><label for="Finance"><?php echo $rows['name']?> </label> 
                      </a>
                  </li>
                  <?php }}?>
                </ul>
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-9">
            <!--<h2 class="sh-title"><span>Search Result Products</span></h2>-->
            <h2 class="sh-title"><span><?php echo isset($cat_name) && !empty($cat_name) ? ucfirst($cat_name) : 'Search Result Products';  ?></span></h2>
            <div class="sh-product-list-main">
                <div class="row">
                  <?php
                    if (!empty($product_list)) {
                    foreach ($product_list as $p_list) {               
                    $url = empty($p_list['seo_url']) ? base_url('product/'.$p_list['id']) : base_url($p_list['seo_url']);?>
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="sh-product-section sh-product-list-main sh-light-bg">
                        <div class="sh-search-result" data-aos="fade-up" data-aos-duration="2000">
                          <div class="sh-product-img">
                          <?php 
                  if (isset($p_list['cover_image'])) {
                    $cover_url = base_url()."uploads/cover_image/".$p_list['cover_image'];
                    // $cover_url = base_url('show_image?image_type=cover_image&image_name='.$product['cover_image']);
                  } 
                  else{
                    $cover_url = base_url()."assets/csc/images/product-1.jpg";
                  }
                  ?>
                  <img src="<?php echo $cover_url; ?>" alt="eNlight-WAF" class="img-fluid">
                            <!-- <img src="<?php echo base_url() ?>assets/csc/images/product-1.jpg" alt="eNlight-WAF" class="img-fluid"> -->
                          </div>
                          <div class="sh-product-inner">
                            <div class="sh-product-content">
                            <?php $logo_url = base_url('show_image?image_type=product_display_logo&image_name=testing.jpg');
                            $temp_product_logos  = $this->config->item('temp_product_logos');
                            $logo_url = base_url('show_image?image_type=product_logo&image_name='.$p_list['logo']);
                          
                            if (isset($temp_product_logos[$p_list['id']])) {
                                //$logo_url = base_url('show_image?image_type=product_display_logo&image_name='.$temp_product_logos[$p_list['id']]);
                            }?>
                              <img src="<?php echo $logo_url ?>" alt="QAD" class="img-fluid">
                              <h4><a href="<?php echo $url; ?>"><?php echo $p_list['product_name'] ?></a></h4>
                              <p>
                              <?php echo ucfirst(htmlspecialchars_decode(stripslashes( $p_list['short_brief'] ))); ?>
                              </p>
                              <!-- <div class="sh-p-time">
                                <span class="sh-time"><i class="fi fi-sr-calendar"></i> 5 Months </span>
                                <span class="sh-time"><i class="fi fi-sr-clock"></i> 18 Jul, 2023 </span>
                              </div> -->
                              
                            </div>
                            <div class="sh-product-footer">
                              <div class="sh-review-star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <span> (5)</span>
                              </div>
                              <div class="sh-p-list">
                                <span class="sh-price"> <i class="fi fi-bs-indian-rupee-sign"></i> <?php echo $p_list['price']; ?> </span>
                                <span> <del> <i class="fa fa-inr"></i> <?php echo $p_list['price']*2; ?> </del> &nbsp;MRP </span>
                              </div>
                              <a href="<?php echo $url;?>" class="btn btn-primary"><i class="fi fi-rs-shopping-cart"></i> Buy Now</a>
                            </div>
                          </div>  
                        </div>

                      </div>
                    </div>
                    <?php }} else { ?>
                    <div class="col-md-4 col-sm-6">
                      <div class="course relPro">
                        <h3>No result found!</h3>
                      </div>
                    </div>
                  <?php }?>
                </div>      
                <!-- pagination -->
          
                <!-- <?php if (!empty($product_list)) {
                        if (!empty($links)): 
                          //echo '<div class="clearfix"></div>';
                          ?>
                  <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <nav aria-label="Page navigation example" class="sh-pagination">
                        <ul class="pagination justify-content-end">
                          <?php echo $links; ?>
                          
                        </ul>
                      </nav>
                    </div>
                  </div>
                  <?php endif; } ?> -->
                
                <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                  <nav aria-label="Page navigation example" class="sh-pagination">
                    <ul class="pagination justify-content-end">
                         <?php echo $links; ?>
                    </ul>
                  </nav>
                </div>
              </div>

               <div class="row">
                <div class="col-12 col-md-12">
                  <div class="user-feedback " id="feedback_action">
                    <div class="user-like">
                      Have you found the product you are looking for on our site?
                      <a class="btn btn-sm btn-success thumbs-up" data-response="1" id="" href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Yes</a>
                      <a href="#" data-response="0" class="btn btn-sm btn-danger thumbs-down"><i class="fa fa-thumbs-down" aria-hidden="true"></i> No</a>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--====  End of Home middle section  ====-->