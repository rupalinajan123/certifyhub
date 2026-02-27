<?php 
if ($this->session->userdata('user_type') === 'client') {
	$l_url = 'portal/';
}elseif ($this->session->userdata('user_type') === 'consultant') {
	$l_url = 'portal/consultant/';

}else{
	$l_url = 'portal/admin/';
}?>
<style>
    #user_details{width:100% !important;left:50px !important;}
</style>
    <!--====================================
    =            Navigation bar            =
    =====================================-->
    <div id="preloader"></div>
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
                  <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url()?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/share?url=<?php echo base_url()?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url()?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="https://www.instagram.com/?url=<?php echo base_url()?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                <!-- <ul class="sh-calltoaction">
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
                </ul> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="<?php echo base_url()?>">
            <img src="<?php echo base_url()?>assets/csc/images/logo.png" alt="logo">
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
              <!--<form class="search" method="post" action="index.html">-->
              <!--  <input type="text" name="" placeholder="Try typing 'new' ">-->
              <!--  <ul class="sh-results">-->
              <!--    <li><a href="index.html">Search Result #1</a></li>-->
              <!--    <li><a href="index.html">Search Result #2</a></li>-->
              <!--    <li><a href="index.html">Search Result #3</a></li>-->
              <!--    <li><a href="index.html">Search Result #4</a></li>-->
              <!--  </ul>-->
              <!--</form>-->
              
              <form class="search" name="search_form" method="GET" action="<?php echo base_url('products')?>">
                <input type="text" class="search_input" id="search_input" onclick="testfunction()" autocomplete="off" placeholder="Try typing 'new' " required="required" name="search" value="<?php echo text_clean($this->input->get('search')); ?>" >
                <!-- <ul id="suggesstion-box" class="sh-results" style="">
                    <li><a href="javascript:void(0)">Searching...</a></li>
                </ul> -->
                <div id="suggesstion-box"  class="new-search";  Scroll></div>
              </form>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item dropdown mega-dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Certificates <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                    <div class="sh-mega-inner-menu">
                      <div class="row" style="overflow: scroll;height: 500px;">
                      <div class="col-md-6 col-xs-6 col-sm-6"> 
    <?php
                            if($cat_wise_prod){
                                foreach($cat_wise_prod as $Prokey => $Proval){
                                  if ($Prokey == "Microsoft" || $Prokey == "Adobe"){
                                    ?>
                                    <h3><?php echo $Prokey; ?></h3>
                                    <ul>
                                    <?php
                                    foreach($Proval as $key){
                                        $url_short = str_replace(' ','-', strtolower($key['product_name']));?>
                                        
                                        <li> <a href="<?php echo base_url().'product/'.$key['id'] ?>"  target="_blank"><?php echo ucwords($key['product_name'])?></a></li>
                                        <?php
                                    }
                                    
                                    ?>
                                    </ul>
                                 
                                    <?php
                                }
                                }
                            }
                            ?>
</div>
<div class="col-md-6 col-xs-6 col-sm-6"> 
<?php
                            if($cat_wise_prod){
                                foreach($cat_wise_prod as $Prokey => $Proval){
                                  if($Prokey != "Microsoft" && $Prokey != "Adobe"){
                                    ?>
                                    <h3><?php echo $Prokey; ?></h3>
                                    <ul>
                                    <?php
                                    foreach($Proval as $key){
                                        $url_short = str_replace(' ','-', strtolower($key['product_name']));?>
                                        
                                        <li> <a href="<?php echo base_url().'product/'.$key['id'] ?>"  target="_blank"><?php echo ucwords($key['product_name'])?></a></li>
                                        <?php
                                    }
                                    
                                    ?>
                                    </ul>
                                 
                                    <?php
                                  }
                                }
                            }
                            ?>
</div>
                          
                      </div>
                      <div class="row">
                        <div class="col-12 d-flex justify-content-center sh-btn-bottom">
                            <a target="_blank" href="<?php echo base_url().'products'; ?>"  class="hover-1 <?php echo $pactive; ?>" class="btn btn-primary">View All Certificates  <i data-feather="arrow-right"></i></a>
                             
                        </div>
                    </div>
                  </div>
                 </div>
                </li>
                
                <li class="nav-item">
   <a class="nav-link" href="contact-us" style="padding-left: 0;">
    Contact Us
   </a>
   </li>
                <?php if ($this->session->userdata('user_type') == 'client') { ?>
                <li class="nav-item dropdown mega-dropdown" >
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        <!--Products <i data-feather="chevron-down"></i>-->
                        
                        <?php
                        if($this->session->userdata('client_profile_image')!="")
                        {
                            $img_url = $this->config->item('CLIENT_PROFILE_UPLOAD').$this->session->userdata('profile_image');
                        } else {
                            $img_url = 'assets/img/user.png';
                        }
                        ?>
                        <img src="<?php echo base_url().$img_url; ?>" alt="Profile Image" style="width:20px;height:20px;" />
                        <span class="profile-info">
                        <?php  echo ucfirst($this->session->userdata('logged_in') && $this->session->userdata('first_name') && $this->session->userdata('last_name') ? $this->session->userdata('first_name')." ".$this->session->userdata('last_name') : $this->session->userdata('username') ); ?> <i data-feather="chevron-down"></i>
                        <!--<em>Login as <?php echo ucfirst($this->session->userdata('user_type'));?></em>-->
                        </span>
                    </a>
                    <div id="user_details" class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="sh-mega-inner-menu">
                            <div class="row">
                                <div class="col-md-12">
                                <ul>
                                <li><a href="<?php echo base_url().$l_url.'profile'; ?>"><i class="fa fa-fw fa-user text-danger"></i> My Profile</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url().$l_url.'dashboard'; ?>"><i class="fa fa-fw fa-dashboard text-danger"></i> Dashboard</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url().$l_url.'orders'; ?>"><i class="fa fa-fw fa-list text-danger"></i> My Orders</a></li>
								<li class="divider"></li>
								
								<li><a href="<?php echo base_url().$l_url.'login/logout'; ?>"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    
				
				<?php } else { ?>
                    <li class="nav-item dropdown sp-no-link">
                      <!--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">-->
                      <a class="nav-link dropdown-toggle" href="<?php echo base_url().'portal/'; ?>" id="" role="button">
                        Log-in
                        <!--<i data-feather="chevron-down"></i>-->
                      </a>
                      <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url().'portal/'; ?>">Client </a>
                        <a class="dropdown-item" href="<?php echo base_url().'portal/partner'; ?>">Course Provider</a>
                        <a class="dropdown-item" href="#">Consultant</a>
                      </div>-->
                    </li>
                    <li class="nav-item dropdown sp-no-link">
                      <!--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">-->
                      <a class="nav-link dropdown-toggle" href="<?php echo base_url().'portal/register'; ?>" id="" role="button">
                        Register
                       <!-- <i data-feather="chevron-down"></i>-->
                      </a>
                      <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url().'portal/register'; ?>">Client </a>
                        <a class="dropdown-item" href="<?php echo base_url().'portal/partner/register'; ?>">Course Provider</a>
                        <a class="dropdown-item" href="#">Consultant</a>
                      </div>-->
                    </li>
                <?php } ?>
                
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    
    <!--====  End of Navigation bar  ====-->
    <script>
    function testfunction(){
      $("#suggesstion-box").hide();
    }
    
    </script>
    <!-- <script>
     $(document).ready(function(){
     $("input").blur(function(){
      $("#suggesstion-box").hide();
     });
      });
    </script> -->