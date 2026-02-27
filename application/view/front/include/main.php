<?php $this->load->view('front/include/header');?>
	<body>
		<?php if(ENVIRONMENT == "production") { ?>
		<!-- Google Tag Manager (noscript) -->
		<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBN4QBF"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
		<!-- End Google Tag Manager (noscript) -->
		<?php } ?>
		<div id="popup_model"></div>
		<!-- <div id="preloader"></div> -->
		<div class="super_container">
			<!-- Header -->
			<?php $this->load->view('front/include/head');
			//$this->load->view('front/include/message');
			?>
			<!-- Home -->
			<?php echo $subview; ?>
			<!-- Footer -->
			<?php $this->load->view('front/include/footer');?>
		</div>
		<!-- scripts files -->
		<?php $this->load->view('front/include/footer_js');?>
	</body>
</html>
<script type="text/javascript">
	$(document).on('click','.other_cat',function (e) {
		e.preventDefault();   
		if( $(this).hasClass( "active") ){
			$('.cat_listing').find('li.topCat').show();
			$('.cat_listing').find('li.otherCat').hide();
			$(this).removeClass('active');
			$(this).html('<i class="fa fa-angle-double-right"></i>Other Industries');
		}else{

			$('.cat_listing').find('li.otherCat').show();
			$('.cat_listing').find('li.topCat').hide();
			// $('.cat_listing').find('li.otherCat').addClass('temp_show').removeClass('otherCat');
			$(this).addClass('active');
			$(this).html('<i class="fa fa-angle-double-left"></i>Previous');
			
		}
		

	});
</script>