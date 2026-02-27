<div id="content">
<section><!-- BEGIN CONTENT-->
	<div class="section-body">
		<div class="row">
		<?php if ($this->session->userdata('user_type') === 'admin') {
		      $l_url = base_url().'admin';
		    }elseif ($this->session->userdata('user_type') === 'partner') {
		      $l_url = base_url().'partner';
		   }else{ $l_url = base_url(); } ?>

			<!-- Product -->
			<div class="col-sm-12 col-md-12"><?php $this->load->view('include/message');?>
			<div class="mt-4">
	     	  <div class="col-md-3 col-sm-6 count_text">
				<a href="<?php echo $l_url.'client_products' ?>">
				<div class="card">
                 <div class="card-body">
                  <div class="d-flex alert alert-callout alert-info no-margin align-items-center">
                   <div class="icon_box"> <h1 class="text-success"><i class="fa fa-server"></i></h1></div>
                    <div class="align-items-center flex-column"> 
						<div class="product_text"> <strong class="text-xl"><?php echo $product_count; ?></strong></div>
						<div class="opacity-10 text-lg product_text"><strong>Total Products</strong></div>
				   </div>
				  </div>
				  <div class="stick-bottom-left-right mb-4 ml-4 mr-4">
                   <div class="progress progress-hairline no-margin">
		            <div class="progress-bar progress-bar-success" style="width:43%; height:15px">
	     	          </div>
                       </div>
                         </div> 
           </div>
            </div><!--end .card-body -->
		      </a>
              </div><!--end .card -->
				

			<!-- Order -->				
			<div class="col-md-3 col-sm-6 count_text">
				<a href="<?php echo $l_url.'orders' ?>">
				<div class="card">
						<div class="card-body">
							<div class="d-flex alert alert-callout alert-danger no-margin align-items-center">
							<div class="icon_box"> <h1 class="text-success"><i class="fa fa-shopping-cart"></i></h1></div>
							<div class="align-items-center flex-column"> 
					        	<div class="product_text"> <strong class="text-xl"><?php echo $orders_count; ?></strong></div>
						        <div class="opacity-10 text-lg product_text"><strong>Total Orders</strong></div>
				                 </div>
				                 </div>
								<div class="stick-bottom-left-right mb-4 ml-4 mr-4">
									<div class="progress progress-hairline no-margin">
										<div class="progress-bar progress-bar-danger" style="width:43%; height:15px"></div>
									</div>
								</div>
							</div>
						</div><!--end .card-body -->
					</a>
			</div><!--end .col -->

			<!-- Invoice -->				
			<div class="col-md-3 col-sm-6 count_text">
				<a href="<?php echo $l_url.'invoices' ?>">
				<div class="card">
						<div class="card-body">
							<div class=" d-flex alert alert-callout alert-info no-margin align-items-center">
							<div class="icon_box"> <h1 class="text-success"><i class="md md-assignment"></i></h1></div>
							<div class="align-items-center flex-column"> 
							<div class="product_text"><strong class="text-xl"><?php echo $invoice_count; ?></strong></div>
							<div class="opacity-10 text-lg product_text"><strong>Total Invoices</strong></div>
						    </div>
						     </div>
								<div class="stick-bottom-left-right mb-4 ml-4 mr-4">
									<div class="progress progress-hairline no-margin">
										<div class="progress-bar progress-bar-info" style="width:43%; height:15px"></div>
									</div>
								</div>
							
						</div><!--end .card-body -->
					</div><!--end .card -->
				</a>
			</div><!--end .col -->

			<!-- Transaction -->				
			 <div class="col-md-3 col-sm-6 count_text">
				<a href="<?php echo $l_url.'transactions' ?>">
				<div class="card">
						<div class="card-body">
							<div class=" d-flex alert alert-callout alert-warning no-margin align-items-center">
						     <div class="icon_box"> <h1 class="text-success"><i class="fa fa-exchange fa-fw"></i></h1></div>
							  <div class="align-items-center flex-column"> 
							  <div class="product_text"><strong class="text-xl"><?php echo $transaction_count; ?></strong></div>
							  <div class="opacity-10 text-lg product_text"><strong class="tt-font">Total Transactions</strong></div>
							  </div>
							 </div>
									<div class="stick-bottom-left-right mb-4 ml-4 mr-4">
									<div class="progress progress-hairline no-margin">
										<div class="progress-bar progress-bar-warning" style="width:43%; height:15px"></div>
									</div>
								</div>
							</div>
						</div><!--end .card-body -->
					</div><!--end .card -->
			</div>
				</a>
			</div><!--end .col -->


		  
	    	</div>
			<!--Card1-->

          
			
		</div><!--end .row -->	
	</div>	<!--end .section-body -->
<!-- END CONTENT -->
</section>
</div>
<?php $this->load->view('include/common_script');?>
<?php if($this->session->userdata('user_m_download_url')!="") { ?>
<script type="text/javascript">
$(document).ready(function () {
	window.location.href = '<?php echo $this->session->userdata('user_m_download_url'); ?>';
	//window.open('http://www.google.com');
});
</script>
<?php } ?>