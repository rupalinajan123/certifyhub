<style type="text/css">span.astric{color:#ccc;}</style>

<div class="review-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div class="owl-carousel owl-theme" id="review-slider">
               <?php if (!empty($products_top_review)) {
                  foreach ($products_top_review as $rows) { ?>
                     <div class="item">
                        <div class="review-box">
                           <div class="row">
                              <div class="col-md-5 col-sm-6">
                                 <p class="reviwer-name"> <span><?php echo ucwords($rows['first_name'].' '.$rows['last_name']) ?></span></p>

                                
                              </div>
                              <div class="col-md-3 col-sm-6">
                                  <p class="reviwer-star">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        if ($rows['ratings'] >= $i) { ?>
                                          <span class="fa fa-star"></span>
                                       <?php } else { ?>
                                          <span class="fa fa-star astric"></span>
                                    <?php } } ?>
                                 </p>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <p class="reviwer-date"><?php echo date('d-M-Y', strtotime($rows['created_on'])) ?></p>
                              </div>
                           </div>
                           <p class="reviewer-coment"><?php echo $rows['review'] ?>
                           </p>
                        </div>
                     </div>
               <?php }
               } ?>
            </div>
         </div>
      </div>
   </div>
</div>