
<!-- Header// -->
    <header class="header">
      <div class="header_container animate__animated animate__fadeInDown">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <div class="header_content d-flex flex-row align-items-center justify-content-start">
                <div class="logo_container">
                  <a href="<?php echo base_url(); ?>">
                    <div class="logo_content d-flex flex-row align-items-end justify-content-start">
                      <div class="logo_img"><img src="<?php echo base_url('show_image?image_type=logo&image_name=logocolor.png'); ?>" alt="Spochub logo"
                          class="img-fluid">
                      </div>
                    </div>
                  </a>
                </div>

              </div>
            </div>
            <div class="col-md-8 col-sm-8">
             <div class="top_bar_login ml-auto">
                <ul class="tb_ul0">
                  <li>
                    <div class="header_search_content d-flex flex-row align-items-center justify-content-end">
                      <form name="search_form" method="POST" action="#" class="w-100 search_position">
                        <?php //$search_key = text_clean($this->input->get('search'));   ?>
                        <input type="text" class="search_input" id="search_input" autocomplete="off" placeholder="Search" required="required" name="search" value="<?php echo text_clean($this->input->get('search')); ?>">
                        
                        <button class="header_search_button d-flex flex-column align-items-center justify-content-center"> <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <div id="suggesstion-box"></div>
                      </form>
                    </div>
                  </li>
                </ul>
                <?php
                  $pactive =  $this->router->fetch_class() == 'products' && $this->router->fetch_method() == 'index' && empty($this->uri->segment(2)) ? 'active' : '';
                  $sactive =  $this->router->fetch_class() == 'services' && $this->router->fetch_method() == 'index' && empty($this->uri->segment(2)) ? 'active' : '';
                 ?>
                <ul class="tb_ul1">
                  <li class=""><a class="hover-1 <?php echo $pactive; ?>" href="<?php echo base_url().'products'; ?>">Products </a></li>
                  <!-- <li class=""><a class="hover-1 <?php echo $sactive; ?>" href="<?php echo base_url().'services'; ?>">Services </a></li> -->
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="false">Login <span
                        class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li class="hvr-bounce-to-right"><a target="_blank" href="<?php echo $this->config->item('PORTAL_LINK').'/login'; ?>">Client </a></li>
                      <li class="hvr-bounce-to-right"><a target="_blank" href="<?php echo $this->config->item('PORTAL_LINK').'/partner/login'; ?>">Partner</a></li>
                      <li class="hvr-bounce-to-right"><a target="_blank" href="<?php echo $this->config->item('PORTAL_LINK').'/consultant/login'; ?>">Consultant</a></li>
                      <!--<li class="hvr-bounce-to-right"><a target="_blank" href="<?php //echo $this->config->item('PORTAL_LINK').'/distributor/login'; ?>">Distributor</a></li>-->
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="false">Sign Up <span
                        class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li class="hvr-bounce-to-right"><a target="_blank" href="<?php echo $this->config->item('PORTAL_LINK').'/register'; ?>">Client </a></li>
                      <li class="hvr-bounce-to-right"><a target="_blank" href="<?php echo $this->config->item('PORTAL_LINK').'/partner/register'; ?>">Partner</a></li>
                      <li class="hvr-bounce-to-right"><a target="_blank" href="<?php echo $this->config->item('PORTAL_LINK').'/consultant/register'; ?>">Consultant</a></li>
                      <!--<li class="hvr-bounce-to-right"><a target="_blank" href="<?php //echo $this->config->item('PORTAL_LINK').'/distributor/register'; ?>">Distributor</a></li>-->
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    </header>
  

