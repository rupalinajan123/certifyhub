<!-- -->

<style type="text/css">
  span.astric{color:#ccc;}
  div.price-fill{position: relative; background: #e31e28}
</style>  
	<!-- product overview -->
	<section class="product-overview-wrapper">
		<div class="container">
			<?php $this->load->view('front/breadcrumb');?>

         	<?php $this->load->view('front/include/message'); ?>

        	<?php if (!empty($products)) { ?>

			<div class="row">
				<div class="col-sm-9 col-md-10">
					<div class="product_box">
						<div class="pro-left-img">
							<img name="<?php echo $products['logo']; ?>" alt="Product logo" src="<?php echo base_url('show_image?image_type=product_logo&image_name='.$products['logo']);?>" class="img-fluid">
						</div>
						<div class="pro-right-desc">
							<h1 class="product-title-details"><?php echo $products['product_name'] ? $products['product_name'] : '';  ?></h1>
			                <span class="by-farm">By: <?php echo $products['company_name'] ? $products['company_name'] : '';  ?> </span>
			                <span class="version">Version: <?php echo $products['version'] ? $products['version'] : '';  ?></span>
			                <div class="desc-prodct"><?php echo $products['brief'] ? htmlspecialchars_decode(stripslashes($products['brief'])) : '';  ?></div>
			                <p class="pro-rew-rating">
			                 <?php for ($i = 1; $i <= 5; $i++) { 
			                  if ($products['rating'] >= $i) { ?>
			                     <span class="fa fa-star active"></span>
			                  <?php } else { ?>
			                     <span class="fa fa-star astric"></span>
			               <?php }
			                  } ?>
			                  <span class="pr-rvw-cnt"> (<?php echo ($products['rating'])?$products['rating']:'0';?>)</span> </p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-3 price-fill d-flex align-content-center flex-wrap"
					style="position: relative; background: #e31e28">
					<div class="price_right">
						<a href="javascript:void(0)" onclick="scrollSmoothTo('pricing')" class="buyLink linkAnchor "><span>Buy Now</span></a>

              			<a href="javascript:void(0)" class="linkAnchor KnowLink product-lead" data-product_id="<?php echo $products['product_id'];?>" data-product_type="<?php echo $products['product_type'];?>" ><span>Know More</span></a>

			            <?php
			            if (!empty($product_details)) {
			                foreach ($product_details as $product) {
			                  
			                  if (@$product['package_type'] == 'free') { 
			                    if($products['product_id']!=50){?>
			                      <a href="<?php echo $this->config->item('PORTAL_LINK').'/product/order-summary/'.$products['product_id'].'/'.$product['package_id']?>" data-product_id="<?php echo $product['product_id']; ?>" data-package_id="<?php echo $product['package_id']; ?>" class="linkAnchor trialLink"><span>Free Trial</span></a>
			                  <?php }else{?>
			                    <a href="javascript:void(0)" class="linkAnchor trialLink" data-product_id="<?php echo $product['product_id']; ?>" data-package_id="<?php echo $product['package_id']; ?>"><span>Free Trial</span></a>
			                <?php  }
			              }
			                }
			              }?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>
	<!-- tab wrapper -->
	<?php if (!empty($products)) { ?>
	<div class="tabs-wrapper bgPatterns">
		<div class="container" id="product-tab">
			<h6><b>For accessing the User Manual and Case Study, please refer the Usage Section.</b></h6></br>
      		<ul class="points-links nav nav-tabs" id="myTab" role="tablist">
		        <li class="nav-item">
		            <a class="nav-link active" href="#overview" data-toggle="tab" role="tab" aria-selected="true">Overview</a>
		        </li>
		        <li class="nav-item">
		           <a class="nav-link" href="#pricing" data-toggle="tab" role="tab" aria-selected="true">Pricing</a>
		        </li>

		        <?php //if (!empty($products['usage'])) : ?>
		        <li class="nav-item">
	               <a class="nav-link" href="#usage" data-toggle="tab" role="tab" aria-selected="true">Usage</a>
	            </li>
		        <?php //endif; ?>

		        <?php //if (!empty($products['support'])) : ?>
		        <li class="nav-item">
	               <a class="nav-link" href="#support" data-toggle="tab" role="tab" aria-selected="true">Support</a>
	            </li>
	         	<?php //endif; ?>

	         	<li class="nav-item">
	            	<a class="nav-link" href="#review" data-toggle="tab" role="tab" aria-selected="true">Reviews</a>
	         	</li>

      		</ul>
		  <!-- //tabs links -->
		  <!-- tabs content -->
		  <div class="tab-content" id="myTabContent">
			<!-- overview  -->
			<?php $this->load->view('front/product/product_details/overview'); ?>

		     <!-- pricing -->
		     <?php if ( isset($package_type) && $package_type == 'private' ) {
		        $this->load->view('front/product/product_details/private_offer_pricing');

		     }elseif ( $products['product_type'] == 'Lead' ) {
		      $this->load->view('front/product/product_details/lead_product_pricing'); 

		     }else{
		        $this->load->view('front/product/product_details/pricing'); 
		     } ?>

		     <!-- usage -->
		     <?php //if (!empty($products['usage'])) : ?>
		        <?php $this->load->view('front/product/product_details/usage'); ?>
		     <?php //endif; ?>

		     <!-- support -->
		     <?php //if (!empty($products['support'])) : ?>
		        <?php $this->load->view('front/product/product_details/support'); ?>
		     <?php //endif; ?>

		     <!-- review -->
		     <?php $this->load->view('front/product/product_details/review'); ?>
				<!-- //tabs content -->
			</div>
		</div>

	<!-- reviews cust. -->
	<?php $this->load->view('front/product/product_details/review_footer'); ?>
	<!-- //reviews cust. -->
	<?php }
	 ?>
	<script src="<?php echo base_url(); ?>assets/front/js/jquery-3.2.1.min.js"></script>
	<?php if ($products['product_id'] == 50) {?>
   
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
    var product_id = $this.attr('data-product_id'),
        package_id = $this.attr('data-package_id');

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

    scrollSmoothTo('pricing');

    function scrollSmoothTo(pricing) {
    $('div#myTabContent').find('.tab-pane').removeClass('active show');
    $('div#myTabContent').find('#pricing').addClass('active show');

    $(".points-links").find("a.nav-link").removeClass('active');

    $("ul.points-links").find("a.nav-link").each(function() {
      if($( this ).attr('href') == '#pricing'){$(this).addClass('active')}
    });

    var element = document.getElementById(pricing);
     element.scrollIntoView({ block: 'start', behavior: 'smooth' });
}
</script>
 
<?php } ?> 

<script type="text/javascript">
   //view_more
   $(document).on('click','a.view_more',function (argument) {
   
    
     $(this).parent().parent().find('li.flitem').removeClass('flitem');
     $(this).remove()
   });
</script>


