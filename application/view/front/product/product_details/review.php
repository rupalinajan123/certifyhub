<style type="text/css">
span.astric{color:#ccc;}
div.alert_msg{position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius:.25rem;}

         </style>

         <?php  //print_r($products_review); ?>

   <div class="post-comments mt-4 mb-4">
        <div class="latest-comments">
            <ul class="reviewList">
                <?php if (!empty($products_review)) :
                    //echo"<pre>";print_r($products_review); die;
                foreach ($products_review as $key => $review) : ?>
                    <li>
                       <div class="comments-box">
                            <div class="comments-text">
                                <div class="avatar-name">
                                   <h5><?php echo ucwords($review['first_name'].' '.$review['last_name']) ?></h5>

                                    <p class="pro-rew-rating">
                                        <?php for ($i = 1; $i <= 5; $i++) {
                                        if ($review['ratings'] >= $i) { ?>
                                        <span class="fa fa-star"></span>
                                        <?php } else { ?>
                                        <span class="fa fa-star"></span>
                                        <?php }
                                        } ?>
                                    </p>
                                    <span class="reply"><i class="fa fa-calendar"></i><?php echo date('d-M-Y',strtotime($review['created_on'])); //date('d-M-Y h:m', strtotime($review['created_on'])) ?>
                                    </span>
                                </div>

                                <p id="review_text">
                                    <?php 
                                        $len = strlen($review['review']);
                                        $review_text1 = substr($review['review'], 0, 150);

                                        $review_text2 = substr($review['review'], 150, $len);

                                        echo $review_text1; 
                                    ?>
                                    <p id="more_<?php echo $key; ?>" style="display: none;"><?php echo $review_text2; ?></p>
                                   
                                </p>
                        
                                
                                <?php if(strlen($review['review']) > 150) { ?>
                                 <a class="read-full read_more" data-id="<?php echo $key; ?>" href="javascript:void(0);" id="btn_read_more_<?php echo $key; ?>"><i class="fa fa-angle-right"></i>Read Full</a>
                                 <a class="read-full read_less" data-id="<?php echo $key; ?>" href="javascript:void(0);" id="btn_read_less_<?php echo $key; ?>" style="display: none;"><i class="fa fa-angle-right"></i>Read Less</a>
                                <?php } ?>
                        </div>
                    </div>
                </li>
                <?php endforeach;
                    else :
                        echo '<div class="alerts alert-danger alert_msg " role="alert">No reviews for this product.</div>';
                    endif; 
                ?>
            </ul>

            <?php if(sizeof($products_review) > 5) { ?>
                <div class="text-center showMore_div"> <a href="javascript:void(0);" id="showMore" class="linkAnchor hasIcon  d-inline-block w-auto"><span>Read More Reviews</span></a></div>

                <div class="text-center showLess_div" style="display: none;" > <a href="javascript:void(0);" id="showLess" class="linkAnchor hasIcon  d-inline-block w-auto"><span>Read Less Reviews</span></a></div>
           <?php  } ?>
        </div>
    </div>



