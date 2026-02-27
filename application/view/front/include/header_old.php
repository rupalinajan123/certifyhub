<!DOCTYPE html>
<html lang="en">
<!-- Meta data for home page, about us page & product details page. -->
<?php  
  $this->config->load('metadata.php');
  $product_id = $this->uri->segment('3'); 
  $class_name = $this->router->fetch_class();
  $fun_name   = $this->router->fetch_method(); 
?>
<head>
  <?php 
    $meta_arr = array();
    $meta_page_arr = array();
    $meta_title = $meta_description = $meta_keywords = '';
    $FRONTEND_META_DATA  = $this->config->item('FRONTEND_META_DATA');

    if(isset($FRONTEND_META_DATA)) { $meta_page_arr= $FRONTEND_META_DATA;}
    
    $FRONTEND_PRODUCT_META_DATA  = $this->config->item('FRONTEND_PRODUCT_META_DATA');
    if(isset($FRONTEND_PRODUCT_META_DATA[$product_id])) { $meta_arr= $FRONTEND_PRODUCT_META_DATA[$product_id]; }
    
    if(count($meta_arr)>0)
    {
      if($class_name == "products" && $fun_name == "details" && $product_id != "")
      {
        $meta_title = $meta_arr['title'];
        $meta_description = $meta_arr['description'];
        $meta_keywords = $meta_arr['keywords'];
      }
      else
      {     
        if(isset($title) && !empty($title)) { $meta_title = $title; } else { $meta_title = 'HOMEPAGE'; }
        $meta_description = 'Elearn project';
        $meta_keywords = '';
      }
    }
    elseif(count($meta_page_arr)>0){
      if($class_name == "home" && $fun_name == "index")
      {
        $meta_title = $meta_page_arr['home']['title'];
        $meta_description = $meta_page_arr['home']['description'];
        $meta_keywords = $meta_page_arr['home']['keywords'];
      }
      elseif($class_name == "home" && $fun_name== "about_us"){
        $meta_title = $meta_page_arr['about_us']['title'];
        $meta_description = $meta_page_arr['about_us']['description'];
        $meta_keywords = $meta_page_arr['about_us']['keywords'];
      }
      else
      {     
        if(isset($title) && !empty($title)) { $meta_title = $title; } else { $meta_title = 'HOMEPAGE'; }
        $meta_description = 'Elearn project';
        $meta_keywords = '';
      }


    }
    else
    { 
      if(isset($title) && !empty($title)) { $meta_title = $title; } else { $meta_title = 'HOMEPAGE'; }  
      $meta_description = 'Elearn project';
      $meta_keywords = '';
    } ?>  
  
  <title><?php echo $meta_title; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="<?php echo $meta_description; ?>">
  <meta name="keywords" content="<?php echo $meta_keywords; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
 <!-- <link rel="icon" href="favicon.png" type="image/png"> -->
  <link rel="icon" href="https://spochub.com/uat/assets/img/favicon.png" sizes="32x32">

 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/styles/jquery.mCustomScrollbar.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/styles/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/plugins/OwlCarousel2-2.2.1/animate.css">
  <link href="<?php echo base_url(); ?>assets/front/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/styles/animate.min.css" />

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/styles/main_styles.css?v2.<?php //echo rand(1,50);?>">
  <!-- <link rel="stylesheet" type="text/css" href="styles/responsive.css"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/styles/styles.css?v2.<?php //echo rand(1,50);?>">

  <!-- for sweet alert -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/styles/sweetalert2.css" />




  <!-- for sweet alert -->
<!--   <link rel="stylesheet" type="text/css" href="styles/responsive.css"> -->

    <script type="text/javascript">
      var base_url = '<?php echo base_url();?>';
    </script>
  	<?php if(ENVIRONMENT == "production") { ?>
  	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NBN4QBF');</script>
	<!-- End Google Tag Manager -->
  	<?php } ?>
</head>