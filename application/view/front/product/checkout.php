<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

<form id="frm_checkout" name="frm_checkout" method="post" action="<?=base_url()?>front-end/products/checkout">
    <div class="row">
        <div class="col-12 col-md-8 ed-left-cart">
            <div class="ed-order-title">
                <h3>Checkout</h3>
            </div>
            <h4><i data-feather="shopping-cart"></i> Order Summary </h4>
            <div class="table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col" width="40%">Name</th>
                  <th scope="col" width="20%">Price</th>
                  <th scope="col" width="20%">Quantity</th>
                  <th scope="col" width="20%">Total</th>
                  <th scope="col" width="10%"></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="product-name">
                     <!--https://csc.esdsdev.com/show_image?image_type=product_logo&image_name=121_1212121212.jpg-->
                     <img src="<?=base_url()?>show_image?image_type=product_logo&image_name=<?=$product_details['logo']?>" alt="image-3" style="max-height:50px;margin-right: 10px;">
                     <strong> <?=ucwords($product_details['product_name'])?> </strong>
                  </td>
                  <td>
                     <?=number_format($product_details['price'], 2)?> INR
                  </td>
                  <td>
                     <div class="qty">
                        <span class="minus bg-dark">-</span>
                        <input type="number" class="count" name="qty" value="1">
                        <span class="plus bg-dark">+</span>
                     </div>
                  </td>
                  <td>
                     <strong class="price_total"> <?=number_format($product_details['price'], 2)?> INR </strong>
                  </td>
                  <td>
                     <a href="javascript:void(0)" id="delete_product" class="ed-delete"><strong>
                         <i class="fa fa-trash"></i>
                     <!--<i data-feather="trash-2"></i>-->
                     </strong>
                     </a>
                  </td>
               </tr>
               <tr>
                  <td class="product-name" colspan="5" style="padding:0;"></td>
               </tr>
               <tr>
                  <td class="product-name" colspan="5" style="border: none;">
                     <strong> General Configuration </strong>
                  </td>
               </tr>
               <tr>
                  <td class="product-name" colspan="3" style="border: none;padding:4px .75rem;">
                     <div class="ed-dropdown-list">
                        <div>
                           <p>Proctor Test</p>
                           <select class="form-control" name="proctor_test" id="proctor_test" onchange="general_config_price('proctor_test')">
                              <?php 
                                 $proctor_test = PROCTOR_TEST;
                                 if(count($proctor_test) > 0){
                                 	foreach($proctor_test as $key => $val){ ?>
                              <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }
                                 } ?>
                           </select>
                        </div>
                     </div>
                  </td>
                  <td style="border: none;padding:4px .75rem;">
                     <strong id="proctor_test_price"> 0.00 INR </strong>
                  </td>
                  <td style="border: none;padding:4px .75rem;"></td>
               </tr>
               <tr>
                  <td class="product-name" colspan="3" style="border: none;padding:4px .75rem;">
                     <div class="ed-dropdown-list">
                        <div>
                           <p>Video based e-learning course</p>
                           <select class="form-control" name="video_based_course" id="video_based_course" onchange="general_config_price('video_based_course')">
                              <?php 
                                 $video_based_course = VIDEO_BASED_COURSE;
                                 if(count($video_based_course) > 0){
                                 	foreach($video_based_course as $key => $val){ ?>
                              <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }
                                 } ?>
                           </select>
                        </div>
                     </div>
                  </td>
                  <td style="border: none;padding:4px .75rem;">
                     <strong id="video_based_course_price"> 0.00 INR </strong>
                  </td>
                  <td style="border: none;padding:4px .75rem;"></td>
               </tr>
               <tr style="padding-bottom: .75rem;">
                  <!--<td class="product-name" colspan="3" style="border: none;padding:4px .75rem;">-->
                  <!--  <div class="ed-dropdown-list">-->
                  <!--    <div>-->
                  <!--      <p>Proctor Test</p>-->
                  <!--      <select class="form-control" style="margin-bottom: 0;">-->
                  <!--        <option>Test Taken from home (One time free)</option>-->
                  <!--      </select>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</td>-->
                  <!--<td style="border: none;padding:4px .75rem;">-->
                  <!--  <strong> 2009 INR </strong>-->
                  <!--</td>-->
                  <!--<td style="border: none;padding:4px .75rem;" style="margin-bottom: 0;"></td>-->
                  <td class="product-name" colspan="3" style="border: none;padding:4px .75rem;">
                     <div class="ed-dropdown-list">
                        <div>
                           <p>5 Practice Tests</p>
                           <select class="form-control" name="practice_test" id="practice_test" onchange="general_config_price('practice_test')">
                              <?php 
                                 $practice_test = PRACTICE_TEST;
                                 if(count($practice_test) > 0){
                                 	foreach($practice_test as $key => $val){ ?>
                              <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }
                                 } ?>
                           </select>
                        </div>
                     </div>
                  </td>
                  <td style="border: none;padding:4px .75rem;">
                     <strong id="practice_test_price"> 0.00 INR </strong>
                  </td>
                  <td style="border: none;padding:4px .75rem;"></td>
               </tr>
            </tbody>
         </table>
      </div>
            <!--<form id="additional_information">-->
                <input type="hidden" name="hid_gst" id="gst" value="<?=GST?>">
                <input type="hidden" name="hid_gst_price" id="gst_price" value="<?=GST?>">
                <input type="hidden" name="hid_id" id="prod_id" value="<?=$product_details['id']?>">
                <input type="hidden" name="hid_price" id="unit_price" value="<?=$product_details['price']?>" >
                <input type="hidden" name="hid_qty" id="prod_qty" value="1">
                <input type="hidden" name="hid_proctor_test" id="proctor_test_price_hidden" value="0.00">
                <input type="hidden" name="hid_video_based_course" id="video_based_course_price_hidden" value="0.00">
                <input type="hidden" name="hid_practice_test" id="practice_test_price_hidden" value="0.00">
                <input type="hidden" name="hid_sub_total" id="sub_total" value="">
                <input type="hidden" name="hid_total_due" id="total_due" value="">
                
                
                
                
                
                <!--Session data start-->
                <input type="hidden" name="session_user_id" id="session_user_id" value="<?php echo !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : ''; ?>">
                
                <input type="hidden" name="session_first_name" id="session_first_name" value="<?php echo !empty($this->session->userdata('first_name')) ? $this->session->userdata('first_name') : ''; ?>">
                
                <input type="hidden" name="session_last_name" id="session_last_name" value="<?php echo !empty($this->session->userdata('last_name')) ? $this->session->userdata('last_name') : ''; ?>">
                <input type="hidden" name="session_email" id="session_email" value="<?php echo !empty($this->session->userdata('email')) ? $this->session->userdata('email') : ''; ?>">
                
                <input type="hidden" name="session_phone" id="session_phone" value="<?php echo !empty($this->session->userdata('phone')) ? $this->session->userdata('phone') : ''; ?>">
                
                <input type="hidden" name="session_user_type" id="session_user_type" value="<?php echo !empty($this->session->userdata('user_type')) ? $this->session->userdata('user_type') : ''; ?>">
                
                <!--Session data end-->
                
          
                <div id="additional_information">
                    <h4 class="ed-subtitle mb-10"><i data-feather="user"></i> Additional Information 
                    <?php if(!empty($this->session->userdata('user_type')) && $this->session->userdata('user_type')== 'client'){ ?>
                    
                    <input type="checkbox" class="form-check-label" name="my_self" id="my_self"> <span class="text-primary" style="font-size:12px;"> My Self</span>
                    
                    <?php } ?>
                    </h4>
                    <div class="sh-order-login-block">
                        <em>Please make sure that information given below will come on your issued certificate.</em>
                    <div class="row pl-2 pr-2">
                       <div class="col-12 col-md-6 p-2">
                          <div class="form-group mb-0">
                             <span>
                             <i data-feather="user"></i>
                             <input type="text" class="form-control" placeholder="Full Name" name="name" id="name" >
                             </span>
                          </div>
                       </div>
                       <div class="col-12 col-md-6 p-2">
                          <div class="form-group mb-0">
                             <span>
                             <i data-feather="phone"></i>
                             <input type="text" class="form-control" placeholder="Phone number" name="phone" id="phone" >
                             </span>
                          </div>
                       </div>
                       <div class="col-12 col-md-6 p-2">
                          <div class="form-group mb-0 sh-verification-email">
                             <span>
                             <i data-feather="mail"></i>
                             <input type="text" class="form-control" placeholder="Email Address" name="email" id="email" >
                             <!--<button> <i data-feather="check-circle"></i> Verify email </button>-->
                             </span>
                          </div>
                       </div>
                       <div class="col-12 col-md-6 p-2">
                          <div class="form-group mb-0">
                             <span>
                             <i data-feather="user"></i>
                             <input type="text" class="form-control" placeholder="Age" name="age" id="age" >
                             </span>
                          </div>
                       </div>
                       <!-- <div class="col-12 col-md-6 p-2">
                          <div class="form-group mb-0">
                             <span>
                                <i data-feather="user"></i>
                                <select class="form-control" id="id_proof" name="id_proof" >
                                   <option value="">Student ID Proof</option>
                                   <?php 
                                   $id_proof = ID_PROOF;
                                   if(count($id_proof) > 0){
                                   foreach($id_proof as $val){ ?>
                                   <option value="<?php echo $val; ?>"><?php echo $val;
                                   ?></option>
                                   <?php }
                                   } ?>
                                </select>
                             </span>
                          </div>
                       </div>
                       <div class="col-12 col-md-6 p-2">
                          <div class="form-group mb-0">
                             <span>
                             <i data-feather="grid"></i>
                             <input type="text" name="id_nummber" id="id_nummber" class="form-control" placeholder="ID" >
                             </span>
                          </div>
                       </div> -->
                       <div class="col-12 col-md-12 p-2">
                          <div class="form-group mb-0">
                             <span>
                             <i data-feather="map-pin"></i>
                             <input type="text" class="form-control" placeholder="Address"  name="address" id="address" >
                             </span>
                          </div>
                       </div>
                       <!--<div class="col-12 col-md-6 p-2">-->
                       <!--   <input type="submit" class="btn btn-primary sh-checkout" value="Save" name="">-->
                       <!--</div>-->
                    </div>
                 </div>
                </div>
            <!--</form>-->
        </div>
        <div class="col-12 col-md-4 ed-right-cart">
            <!-- <input type="submit" class="btn btn-primary sh-checkout btn-block" value="Continue Shopping" name=""> -->
            <a href="<?=base_url()?>products" class="btn btn-primary sh-checkout btn-block">Continue Shopping</a>
            <!-- <h4 class="ed-subtitle"><i data-feather="credit-card"></i> Payment Method</h4>
            <div class="ed-card-details-block">
                <div><img src="<?=base_url()?>assets/csc/images/Mastercard-Logo.png" alt="Mastercard-Logo"
                        style="max-height:30px;"><span>MasterCard</span></div>
                <p>****5987</p>
            </div>
            <a href="#" class="ed-link-1">Change Payment Method</a>
            <div class="sh-coupon-form">
                <strong>Voucher</strong>
                <p><span class="promo_code_error" style="color: red"></span></p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code" name="promo_code" value="" id="promo_code">
                    <div class="input-group-append">
                        <input type="hidden" name="check_coupon_code nospace" id="check_coupon_code" value="true">
                        <a href="javascript:void(0);" class="btn btn-danger btn-sm check_coupon me-2">Apply Coupon</a>
                        <div><a href="javascript:void(0);" class="btn btn-danger btn-sm removed_coupon"
                                style="display: none">Remove</a></div>
                    </div>
                </div>
            </div> -->
            <h4 class="ed-subtitle"><i data-feather="file-text"></i> Summary</h4>
            <ul class="ed-checkout">
                <li>
                    <span> Subtotal </span> <strong class="sub_total">
                        <?=number_format($product_details['price'], 2)?> INR
                    </strong>
                </li>
                <li>
                    <span> Gst
                        <?php echo GST.'%'; ?>
                    </span> <strong class="gst_price">
                        <?=number_format(0, 2)?> INR
                    </strong>
                </li>
                <li>
                    <span> Total Due </span> <strong class="sub_total_total_due">
                        <?=number_format($product_details['price'], 2)?> INR
                    </strong>
                </li>
                <li class="ed-total">
                    <span> Total Due </span> <strong class="sub_total_total_due">
                        <?=number_format($product_details['price'], 2)?> INR
                    </strong>
                </li>
            </ul>
        
            <!--<a href="#" class="btn btn-primary sh-checkout btn-block">Checkout</a>-->
            
            <button type="<?php echo !empty($this->session->userdata('user_id')) ? 'submit' : 'button'; ?>" name="submit" value="submit" id="submit_frm" class="btn btn-primary sh-checkout btn-block">Checkout</button>
            <input type="checkbox" class="form-check-label" name="policy_chk" id="policy_chk" style="width:auto;"/>  
            <label for="checkbox"> I agree to these <a href="<?php echo  base_url().'privacy-policy'?>" target="_blank" style="color:blue;">Privacy Policy</a>.</label>                 
         </div>
    </div>
</form>
 