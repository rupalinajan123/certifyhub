<!DOCTYPE html>
<html lang="en">
  <!-- <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <!--  <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">
    <title>Spochub - Product Listing</title>
    <link href="<?php //echo base_url().'assets/front/css/lib.css';?>" rel="stylesheet">
    <link href="<?php //echo base_url().'assets/front/css/style.css';?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  </head> -->
  <?php $image_url = base_url().'assets/front/images';?>
  <body>
   <!--====================================
    =            Navigation bar            =
    =====================================-->
    <header class="sh-header">
      <div class="sh-topbar">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="sh-topbar-left">
                <p>An initiative by <a href="https://www.esds.co.in/" target="_blank">ESDS Software Solution Limited</a></p>
              </div>
            </div>
            <div class="col-12 col-md-8">
              <div class="sh-topbar-right">
                <ul class="sh-topbar-social">
                  <li><a href="https://www.facebook.com/EducationOfficial/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/Educationofficial" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="https://www.linkedin.com/company/Educationofficial" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                <ul class="sh-calltoaction">
                  <li>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                      <i data-feather="phone"></i>  Call Free : <a href="#" target="_blank"> 123 - 456 - 789</a> <span><i data-feather="chevron-down"></i> </span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <ul>
                          <li>
                            <a href="#">
                              <span>
                                <i data-feather="phone"></i>
                              </span>
                              <strong>
                              <h5>Call Us
                              </h5>
                              <p>
                                1800 209 3006
                              </p>
                              </strong>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span>
                                <i data-feather="map-pin"></i>
                              </span>
                              <strong>
                              <h5>Address
                              </h5>
                              <p>
                                Plot No. B- 24 & 25, NICE Industrial Area Satpur, MIDC, Nashik, Maharashtra 422007
                              </p>
                              </strong>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span>
                                <i data-feather="mail"></i>
                              </span>
                              <strong>
                              <h5>
                              Email
                              </h5>
                              <p>
                                support@Education.com
                              </p>
                              </strong>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="<?php echo $image_url.'/logo.png'?>" alt="logo">
          </a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          </button>
          <div class="sh-menu-wrap">
            <div class="sh-search-bar">
              <i class="fa fa-search" aria-hidden="true"></i>
              <form class="search" method="post" action="index.php">
                <input type="text" name="" placeholder="Try typing 'new' ">
                <ul class="sh-results">
                  <li><a href="index.php">Search Result #1</a></li>
                  <li><a href="index.php">Search Result #2</a></li>
                  <li><a href="index.php">Search Result #3</a></li>
                  <li><a href="index.php">Search Result #4</a></li>
                </ul>
              </form>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item dropdown mega-dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Products <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="sh-mega-inner-menu">
                      <div class="row">
                        <div class="col">
                          <h3>Web Security</h3>
                          <ul>
                            <li> <a href="#">eNlight Web VPN</a></li>
                            <li> <a href="#">eNlight WAF</a></li>
                            <li> <a href="#">VTM Scan</a></li>
                            <li> <a href="#">vVAPT</a></li>
                            <li> <a href="#">Global Sign.</a></li>
                          </ul>
                          <h3>Healthcare</h3>
                          <ul>
                            <li> <a href="#">AA+ Testing Solution</a></li>
                            <li> <a href="#">Shatayu HMIS </a></li>
                          </ul>
                          <h3> Asset Management</h3>
                          <ul>
                            <li> <a href="javascript:void(0)" target="_blank" class="sh-blue-active">eNlight 360</a></li>
                            <li> <a href="#">Sapphire</a></li>
                          </ul>
                        </div>
                        <div class="col">
                          <h3>E-mail Solution</h3>
                          <ul>
                            <li> <a href="#">E Patraa</a>
                            <li> <a href="#">DMARC Assure</a>
                            <li> <a href="#">Secure Edge</a>
                            <li> <a href="#">Xgen Plus</a>
                            <li> <a href="#">Microsoft 365</a>
                          </ul>
                          <h3> Passwordless & SSO </h3>
                          <ul>
                            <li> <a href="#">Virtual QR</a></li>
                            <li> <a href="#">MIRI Token</a></li>
                            <li> <a href="#">MIRI ID</a></li>
                            <li> <a href="#">MIRI Card</a></li>
                            <li> <a href="#">Securias</a></li>
                            <li> <a href="#">BYFROST</a></li>
                          </ul>
                        </div>
                        <div class="col">
                          <h3>Endpoint Backup & Security</h3>
                          <ul>
                            <li> <a href="#">Data Resolve</a></li>
                            <li> <a href="#">Carbonite</a></li>
                            <li> <a href="#">Webroot</a></li>
                          </ul>
                          <h3>ERP Solution</h3>
                          <ul>
                            <li> <a href="#">QAP ERP</a></li>
                          </ul>
                          <h3>Warehouse Management</h3>
                          <ul>
                            <li> <a href="#">PYROPS</a></li>
                          </ul>
                          <h3> Education</h3>
                          <ul>
                            <li> <a href="#">Saksham ERP</a></li>
                          </ul>
                        </div>
                        <div class="col">
                          <h3>Video & Data Analysis</h3>
                          <ul>
                            <li> <a href="#">eNalytics</a></li>
                            <li> <a href="#">eNsightics</a></li>
                            <li> <a href="#">Smarten</a></li>
                            <li> <a href="#">Rubiscape</a></li>
                          </ul>
                          <h3> OTT Platform</h3>
                          <ul>
                            <li> <a href="#">eNlight OTT</a></li>
                          </ul>
                          <h3> HRMS</h3>
                          <ul>
                            <li> <a href="#">enRise</a></li>
                            <li> <a href="#">n! Gage</a></li>
                            <li> <a href="#"> n!Courage 360 Feedback, Rewards and Recognition Platform</a></li>
                          </ul>
                        </div>
                        <div class="col">
                          <h3>Communication Platform</h3>
                          <ul>
                            <li> <a href="#">eNlight BOT</a></li>
                            <li> <a href="#">JODO Video</a></li>
                            <li> <a href="#">JODO Call</a></li>
                            <li> <a href="#">JODO Chat</a></li>
                            <li> <a href="#">Circle One</a></li>
                            <li> <a href="#">Yellow Messenger</a></li>
                            <li> <a href="#">In VC</a></li>
                          </ul>
                          <h3> GRP</h3>
                          <ul>
                            <li> <a href="#">iPAS</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!--                 <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Services <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Digital Marketing</a>
                    <a class="dropdown-item" href="#">vCISO</a>
                    <a class="dropdown-item" href="#">vCFO</a>
                    
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Case Study <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ipas.html" target="_blank">iPAS</a>
                    <a class="dropdown-item" href="#">Web VPN</a>
                    <a class="dropdown-item" href="#">eNlight 360</a>
                    <a class="dropdown-item" href="#">QAD</a>
                  </div>
                </li> -->
                <li class="nav-item dropdown sp-no-link">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Log-in
                    <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Client </a>
                    <a class="dropdown-item" href="#">Partner</a>
                    <a class="dropdown-item" href="#">Consultant</a>
                  </div>
                </li>
                <li class="nav-item dropdown sp-no-link">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Register
                    <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Client </a>
                    <a class="dropdown-item" href="#">Partner</a>
                    <a class="dropdown-item" href="#">Consultant</a>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    
    <!--====  End of Navigation bar  ====-->
    <!--=========================================
    =            Home middle section            =
    ==========================================-->
    
    <section class="sh-inner-header sh-top-margin">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb" class="sh-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">AA+ Covid Testing Solution</li>
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
            <div class="col-12 col-lg-3">
               <div class="sh-product-d-img">
                <img name="<?php echo $products['logo']; ?>" alt="Product logo" src="<?php echo base_url('show_image?image_type=product_logo&image_name='.$products['logo']);?>" class="img-fluid">
              </div>
            </div>
            <div class="col-12 col-lg-9">
              <div class="sh-product-d-content">
                <div class="row">
                  <div class="col-12 col-lg-9 sh-detail-title">
                    <h2><?php echo $products['product_name'] ? $products['product_name'] : '';  ?>
                    <!-- <a href="" data-toggle="tooltip" data-placement="top" title="Verified Prodcts"><i class="fa fa-check-circle" aria-hidden="true"></i></a> --> 
                  </h2>                   
                    <span class="sh-tag">
                      By: <?php echo $products['company_name'] ? $products['company_name'] : '';  ?>
                    </span>
                    <p>
                     <?php echo $products['short_brief'] ? htmlspecialchars_decode(stripslashes($products['short_brief'])) : '';  ?>
                    </p>  

                    <a href="javascript:void(0)" onclick="scrollSmoothTo('TORatings')">
                    <div class="sh-rating" >
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
                  </a>
                 
                  </div>
                 <!--  <div class="col-12 col-lg-9 sh-detail-title">
                    <div class="breadcrumb-content mb-3">
                        <h2>AA+ Covid Testing Solution</h2>
                      <div class="p-list">
                        <span class="price"> Rs. 1528.00 </span>
                        <span> <del> <i class="fa fa-inr"></i> 19456 </del> &nbsp;MRP </span>
                        <small class="d-block">*Excluding GST</small>
                        <small class="d-block ex_tagline">(It is recommended to buy video based learning and practice test)</small>
                      </div>
                      <p class="mb-1 mt-3"><b>This Product is including</b></p>
                      <ul class="terms-list check-list mt-2">
                        <li><i class="fa fa-check check-ico "></i>Final Test Exam Fees </li>
                      </ul>
                      <p>Pass an exam in a specific Office program to earn a Microsoft Office Specialist certification.</p>

                    </div>
                
                    
                  </div> -->
                  <div class="col-12 col-lg-3 sh-detail-button">
                    <div class="sh-bg-box">
                      <div class="sh-share-block-main">
                        <span class="sh-text-share-block-btn">Share : </span>
                        <ul class="sh-share-block">
                          <li><a href="https://www.facebook.com/SPOCHUBOfficial/" target="_blank"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                          <li><a href="https://www.facebook.com/SPOCHUBOfficial/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="https://twitter.com/spochubofficial" target="_blank"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="https://www.linkedin.com/company/spochubofficial" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                          <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                      </div>
                       <a href="javascript:void(0)" onclick="scrollSmoothTo('ProductTOPPricing')" class="buyLink  btn btn-primary"><span>Buy Now</span></a>
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
            <section id="registration-form" class="inner-page borderTOP">
              
              <div class="container">
                <div class="row">
                  <div class="col-md-12 product_details">
                    <ul class="nav nav-tabs sh-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Overview">Overview</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Videos">Videos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Resources">Resources</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Ratings">Ratings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Vendor">Vendor</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="tab-content active" id="myTabContent">
                <div class="tab-pane active show fade" id="Overview">
                  <div class="container">
                    <div class="sh-overview-detail">
                      <h2>Overview</h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. .
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget
                      </p>
                      <h2>
                      Highlights
                      </h2>
                      <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</li>
                      </ul>
                      <h2>Usage</h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.
                      </p>
                      <h2>Support</h2>
                      <ol>
                        <li>Standard support includes</li>
                        <li>Ticket-based support</li>
                        <li>2 support contacts</li>
                        <li>Gold support includes</li>
                        <li>Ticket-based support</li>
                        <li>6 support contacts</li>
                        <li>SLA-based support</li>
                        <li>Business hours support coverage:</li>
                        <li>Critical: 4 hours</li>
                        <li>L2: 1 day</li>
                        <li>L3: 2 days</li>
                        <li>Unlimited # of incidents</li>
                      </ol>
                      <h2>Categories</h2>
                      <div class="sh-tags-btns">
                        <a href="#">Banking and Finance</a>
                        <a href="#">Manufacturing</a>
                        <a href="#">Healthcare</a>
                        <a href="#">Defence</a>
                        <a href="#">Government</a>
                        <a href="#">Education</a>
                        <a href="#">Agriculture</a>
                        <a href="#">Transport</a>
                        <a href="#">Pharmaceutical</a>
                        <a href="#">Telecommunication</a>
                        <a href="#">Aerospace</a>
                        <a href="#">Construction</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="Videos">
                  <div class="container">
                    <div class="sh-videos-section">
                      <div class="row">
                        <div class="col-12 col-lg-8">
                          <div class="sh-video-wrap">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="Resources">
                  <div class="container">
                    <div class="sh-overview-detail">
                      <h2>Overview</h2>
                      <div class="sh-tags-btns">
                        <a href="#">Data-sheet</a>
                        <a href="#">Brochure</a>
                        <a href="#">Case Study</a>
                        <a href="#">User Manual</a>
                        <a href="#">Presentation</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="Ratings">
                  <div class="container">
                    <div class="sh-rating-block">
                      <div class="row">
                        <div class="col-12 col-md-4">
                          <div class="sh-review-block-1">
                            <span class="sh-rating sh-rating-1">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                            </span>
                            <h2> 4.8 <span> Out of 5 </span></h2>
                          </div>
                        </div>
                        <div class="col-12 col-md-4">
                          <div class="sh-rating-wrap-1">
                            <ul>
                              <li>
                                <span>5</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <div class="progress">
                                    <div class="progress-bar" style="width:80%"></div>
                                  </div>
                                  <span> (5)</span>
                                </div>
                              </li>
                              <li>
                                <span>5</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:20%"></div>
                                  </div>
                                  <span> (2)</span>
                                </div>
                              </li>
                              <li>
                                <span>5</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:0%"></div>
                                  </div>
                                  <span> (0)</span>
                                </div>
                              </li>
                              <li>
                                <span>5</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:0%"></div>
                                  </div>
                                  <span> (0)</span>
                                </div>
                              </li>
                              <li>
                                <span>5</span>
                                <div class="sh-rating">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  
                                  <div class="progress">
                                    <div class="progress-bar" style="width:0%"></div>
                                  </div>
                                  <span> (0)</span>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-12 col-md-4">
                          <div class="sh-review-login">
                            <h4>Log in to share your Experience</h4>
                            <a href="#" class="btn btn-primary">Log in</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="sh-user-review-main">
                      <ul>
                        <li>
                          <div class="sh-user-img">

                            <img src="<?php echo $image_url.'/user.jpg'?>" alt="user" class="img-fluid">
                          </div>
                          <div class="sh-review-text">
                            <h4>Joe Hall</h4>
                            <span class="sh-rating">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                            </span>
                            <small>April 29, 2021</small>
                            <p>Works Perfect.  Saves me a lot of lookups.</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    
                  </div>
                </div>
                <div class="tab-pane fade" id="Vendor">
                  <div class="container">
                    <div class="sh-vendor-block">
                      <div class="sh-vendor-image">
                        <img src="<?php echo $image_url.'/eNlight-360.png'?>" alt="eNlight-360">
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
<!--====  End of Home middle section  ====--> 
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
<!-- Bootstrap core JavaScript
================================================== -->
<script src="<?php echo base_url().'assets/front/js/ie-emulation-modes-warning.js';?>"></script>
<script src="<?php echo base_url().'assets/front/js/jquery-3.5.1.slim.min.js';?>"></script>
<script src="<?php echo base_url().'assets/front/js/popper.min.js';?>"></script>
<script src="<?php echo base_url().'assets/front/js/bootstrap.min.js';?>"></script>
<script src="<?php echo base_url().'assets/front/js/easyResponsiveTabs.js';?>"></script>
<script src="<?php echo base_url().'assets/front/js/comman.js';?>"></script>
<!--Plug-in Initialisation-->
<script type="text/javascript">
$(document).ready(function () {
//Horizontal Tab
$('.parentHorizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true, // 100% fit in a container
tabidentify: 'hor_1', // The tab groups identifier
activate: function (event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#nested-tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
//Horizontal Tab2
$('.parentHorizontalTab2').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true, // 100% fit in a container
tabidentify: 'hor_2', // The tab groups identifier
activate: function (event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#nested-tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
// Child Tab
$('.ChildVerticalTab_1').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true,
tabidentify: 'ver_1', // The tab groups identifier
activetab_bg: '#fff', // background color for active tabs in this group
inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
active_border_color: '#c1c1c1', // border color for active tabs heads in this group
active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
});
//Vertical Tab
$('#parentVerticalTab').easyResponsiveTabs({
type: 'vertical', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true, // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
tabidentify: 'hor_1', // The tab groups identifier
activate: function (event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#nested-tabInfo2');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
});
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
 <script type="text/javascript">

    scrollSmoothTo('ProductTOPPricing');
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

    scrollSmoothTo('TORatings');
    function scrollSmoothTo(ratings) {
    $('div#myTabContent').find('.tab-pane').removeClass('active show');
    $('div#myTabContent').find('#'+ratings).addClass('active show');
    $("ul#myTab").find("a.nav-link").removeClass('active');
    $("ul#myTab").find("a.nav-link").each(function() {
    $(this).removeClass('active');
        if($( this ).attr('href') == '#'+ratings){$(this).addClass('active')}
    });
    var element = document.getElementById('TO');
     element.scrollIntoView({ block: 'start', behavior: 'smooth' });
}



</script>
</body>
</html>