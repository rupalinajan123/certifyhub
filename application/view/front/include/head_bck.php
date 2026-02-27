  <!--   <div id="preloader"></div> -->
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
                  <li><a href="https://www.facebook.com/SPOCHUBOfficial/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/spochubofficial" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="https://www.linkedin.com/company/spochubofficial" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                <ul class="sh-calltoaction">
                  <li>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                      <i data-feather="phone"></i>  Call Free : <a href="#" target="_blank">+91 8888024365</a> <span><i data-feather="chevron-down"></i> </span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <ul>
                          <li>
                            <a>
                              <span>
                                <i data-feather="phone"></i>
                              </span>
                              <strong>
                              <h5>Call Us
                              </h5>
                              <p>
                                +91 8888024365
                              </p>
                              </strong>
                            </a>
                          </li>
                          <li>
                            <a>
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
                            <a href="mailto:connect@spochub.com">
                              <span>
                                <i data-feather="mail"></i>
                              </span>
                              <strong>
                              <h5>
                              Email
                              </h5>
                              <p>
                                connect@spochub.com
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
          <a class="navbar-brand" href="<?php echo base_url();?>">
            <img src="<?php echo base_url('show_image?image_type=logo&image_name=logocolor.png'); ?>" alt="logo">
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

<!--         <div class="sh-search-bar">
              <i class="fa fa-search" aria-hidden="true"></i>
              <form class="search" method="post" action="index.html">
                <input type="text" name="" placeholder="Try typing 'new' ">
                <ul class="sh-results">
                  <li><a href="index.html">Search Result #1</a></li>
                  <li><a href="index.html">Search Result #2</a></li>
                  <li><a href="index.html">Search Result #3</a></li>
                  <li><a href="index.html">Search Result #4</a></li>
                </ul>
              </form>
            </div> -->

            <div class="sh-search-bar header_search_content">
            <!--  <div class="header_search_content d-flex flex-row align-items-center justify-content-end"> -->
              <i class="fa fa-search" aria-hidden="true"></i>
              <form name="search_form" method="POST" action="#" class="w-100 search_position">
                <?php //$search_key = text_clean($this->input->get('search'));   ?>
                <input type="text" class="search_input" id="search_input" autocomplete="off" placeholder="Search" required="required" name="search" value="<?php echo text_clean($this->input->get('search')); ?>" >
               <!--  <button class="header_search_button d-flex flex-column align-items-center justify-content-center"> <i class="fa fa-search" aria-hidden="true"></i>
                </button> -->
                <div id="suggesstion-box" style="display: none;" Scroll></div>
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
                            <li> <a href="<?php echo base_url().'product/enlight-web-vpn/67' ?>"  target="_blank">eNlight Web VPN</a></li>
                            <li> <a href="<?php echo base_url().'product/enlight-waf/69';?>"   target="_blank">eNlight WAF</a></li>
                            <li> <a href="<?php echo base_url().'product/vtmscan/36';?>"  target="_blank">VTM Scan</a></li>
                            <li> <a href="<?php echo base_url().'product/virtual-vapt-cert-in-certification/65';?>"  target="_blank">vVAPT</a></li>
                            <li> <a href="<?php echo base_url().'product/smime-certificate/72';?>"  target="_blank">SMIME Certificate</a></li>
                            <li> <a href="<?php echo base_url().'product/ssltls-certificate/73';?>"  target="_blank">SSL/TLS Certificate</a></li>
                          </ul>
                          <h3>Healthcare</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/aa-testing-solution/50'; ?>"  target="_blank">AA+ Testing Solution</a></li>
                            <li> <a href="<?php echo base_url().'product/shatayu-hospital-information-management-system/32'; ?>"  target="_blank">Shatayu HIMS </a></li>

                          </ul>
                          <h3> Asset Management</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/enlight-360/66'; ?>" target="_blank" >eNlight 360</a></li> <!-- class="sh-blue-active" -->
                            
                            <li> <a href="<?php echo base_url().'product/business-service-monitoring/110'; ?>"  target="_blank">Business Service Monitoring</a></li>
                            <li> <a href="<?php echo base_url().'product/it-service-management/109'; ?>"  target="_blank">IT Service Management </a></li>
                            <li> <a href="<?php echo base_url().'product/it-asset-management-full-suite/108'; ?>"  target="_blank">IT Asset Manangement Full Suit</a></li>

                          </ul>
                        </div>
                        <div class="col">
                          <h3>E-mail Solution</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/e-patraa/45'; ?>">E Patraa</a>
                            <li> <a href="<?php echo base_url().'product/dmarc-assure/43'; ?>">DMARC Assure</a>
                            <li> <a href="<?php echo base_url().'product/secure-edge-atp/44'; ?>">Secure Edge</a>
                            <li> <a href="<?php echo base_url().'product/xgen-plus--enterprise-email-solution/113'; ?>">Xgen Plus - Enterprise Email Solution</a>
                            <li> <a href="<?php echo base_url().'product/microsoft-365-for-business/156'; ?>">Microsoft 365 for Business</a>
                          </ul>
                          <h3> Passwordless & SSO </h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/virtual-qr/64'; ?>">Virtual QR</a></li>
                            <li> <a href="<?php echo base_url().'product/miri-token-offline-otp/103'; ?>">MIRI Token Offline OTP</a></li>
                            <li> <a href="<?php echo base_url().'product/miri-id/104'; ?>">MIRI ID</a></li>
                            <li> <a href="<?php echo base_url().'product/miri-virtual-super-tokenized-card/105'; ?>">MIRI Virtual Super Tokenized Card</a></li>
                            <li> <a href="<?php echo base_url().'product/securias-visitor-management/106'; ?>">Securias Visitor Management </a></li>
                            <li> <a href="<?php echo base_url().'product/byfrost-single-sign-on/107'; ?>">BYFROST Single Sign On</a></li>
                          </ul>
                        </div>
                        <div class="col">
                          <h3>Endpoint Backup & Security</h3>
                          <ul>
                          <li> <a href="<?php echo base_url().'product/indefend-advanced/62'; ?>">inDefend Advanced</a></li>
                          <li> <a href="<?php echo base_url().'product/webroot-dns-protection/129'; ?>">Webroot DNS Protection</a></li>
                          <li> <a href="<?php echo base_url().'product/webroot-endpoint-security---anti-virus/128'; ?>">Webroot Endpoint Security - Anti Virus</a></li>
                          <li> <a href="<?php echo base_url().'product/webroot-security-awareness-training/130'; ?>">Webroot Security Awareness Training</a></li>
                          <li> <a href="<?php echo base_url().'product/carbonite-availability/125'; ?>">Carbonite Availability</a></li>
                          <li> <a href="<?php echo base_url().'product/carbonite-server-backup/123'; ?>">Carbonite Server Backup</a></li>
                          <li> <a href="<?php echo base_url().'product/carbonite-endpoint-backup/124'; ?>">Carbonite Endpoint Backup</a></li>

                          </ul>
                          <h3>ERP Solution</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/qad-adaptive-erp/88'; ?>">QAD ERP</a></li>
                          </ul>
                          <h3>Warehouse Management</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/pyrops/99'; ?>">PYROPS</a></li>
                          </ul>

                        </div>
                        <div class="col">
                          <h3>Video & Data Analysis</h3>
                          <ul>
                            <li><a href="<?php echo base_url().'product/enalytics/58'; ?>">eNalytics</a></li>
                            <li><a href="<?php echo base_url().'product/ensightics/61'; ?>">eNsightics</a></li>
                            <li><a href="<?php echo base_url().'product/smarten-augmented-analytics/42'; ?>">Smarten Augmented Analytics</a></li>
                            <li><a href="<?php echo base_url().'product/rubiscape---data-science-aiml-amp-analytics-simplified/112'; ?>">Rubiscape - Data Science, AI/ML & Analytics Simplified</a></li>
                          </ul>
                          <h3> OTT Platform</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/enlight-ott/116'; ?>">eNlight OTT</a></li>
                          </ul>
                          <h3> HRMS</h3>
                          <ul>
                            <li> <a href="<?php echo base_url().'product/ngage-continuous-employee-feedback/98'; ?>">n!Gage Continuous Employee Feedback</a></li>
                            <li> <a href="<?php echo base_url().'product/ncourage---rewards-amp-recognition-platform/100'; ?>">n!Courage 360 Feedback, Rewards and Recognition Platform</a></li>
                          </ul>
                        </div>
                        <div class="col">
                          <h3>Communication Platform</h3>
                          <ul>
                               <li> <a href="<?php echo base_url().'product/enlightbot/63'; ?>">eNlight BOT</a></li>
                               <li> <a href="<?php echo base_url().'product/jodo-video/89'; ?>">JODO Video</a></li>
                               <li> <a href="<?php echo base_url().'product/jodo-call/87'; ?>">JODO Call</a></li>
                               <li> <a href="<?php echo base_url().'product/jodo-basic/93'; ?>">JODO Basic</a></li>
                               <li> <a href="<?php echo base_url().'product/circleone-crm/71'; ?>">CircleOne CRM</a></li>
                               <li> <a href="<?php echo base_url().'product/invc---video-conferencing-platform/117'; ?>">inVC - Video Conferencing Platform</a></li>
                          </ul>
                          <h3> GRP</h3>
                         
                                                    <h3> Education</h3>
                          

                        </div>
                      </div>
                        <?php
                          $pactive =  $this->router->fetch_class() == 'products' && $this->router->fetch_method() == 'index' && empty($this->uri->segment(2)) ? 'active' : '';
                          $sactive =  $this->router->fetch_class() == 'services' && $this->router->fetch_method() == 'index' && empty($this->uri->segment(2)) ? 'active' : '';
                         ?>
                        <div class="row">
                        <div class="col-12 d-flex justify-content-center sh-btn-bottom">
                            <a href="<?php echo base_url().'products'; ?>"  class="hover-1 <?php echo $pactive; ?>" class="btn btn-primary">View All Products  <i data-feather="arrow-right"></i></a>
                             
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Services <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Digital Marketing</a>
                    <a class="dropdown-item" href="#">vCISO</a>
                    <a class="dropdown-item" href="#">vCFO</a>
                    
                  </div>
                </li> -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Case Study <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url().'case-study-indefend-advanced';?>" target="_blank">Indefend Advanced</a>
                    <a class="dropdown-item" href="<?php echo base_url().'case-study-document-management-system';?>" target="_blank">Document Management System</a>
                    <a class="dropdown-item" href="<?php echo base_url().'case-study-ssl-tls-certificate';?>" target="_blank">SSL/TLS Certificate</a>
                    <!-- <a class="dropdown-item" href="<?php //echo base_url().'case-study-ipas';?>" target="_blank">iPAS</a>
                    <a class="dropdown-item" href="<?php //echo base_url().'case-study-webvpn';?>" target="_blank">Web VPN</a>
                    <a class="dropdown-item" href="<?php //echo base_url().'case-study-enlight360';?>" target="_blank">eNlight 360</a> -->
                    <a class="dropdown-item" href="<?php echo base_url().'case-study-qad';?>" target="_blank">QAD</a>
                  </div>
                </li>
                <li class="nav-item dropdown sp-no-link">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Log-in
                    <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $this->config->item('PORTAL_LINK').'/login'; ?>" target="_blank">Client </a>
                    <a class="dropdown-item" href="<?php echo $this->config->item('PORTAL_LINK').'/partner/login'; ?>" target="_blank">Partner</a>
                    <a class="dropdown-item" href="<?php echo $this->config->item('PORTAL_LINK').'/consultant/login'; ?>" target="_blank">Consultant</a>
                  </div>
                </li>
                <li class="nav-item dropdown sp-no-link">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Register
                    <i data-feather="chevron-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $this->config->item('PORTAL_LINK').'/register';?>" target="_blank">Client</a>
                    <a class="dropdown-item" href="<?php echo $this->config->item('PORTAL_LINK').'/partner/register';?>" target="_blank">Partner</a>
                    <a class="dropdown-item" href="<?php echo $this->config->item('PORTAL_LINK').'/consultant/register'; ?>" target="_blank">Consultant</a>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <body>
    <!--====  End of Navigation bar  ====-->