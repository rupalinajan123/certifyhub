<style type="text/css">.cat_names_full{display: none;}</style>
<div id="content">
	<section class="style-default-bright">
		<div class="section-body designation_panel">
			<div class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="section-header">
							<h2 class="text-primary"><?php echo $title; ?></h2>
						</div>
					</div>
					<!--end .col -->
					<div class="col-md-6"> 
						 <a href="<?php echo base_url().'admin/products/add_lead_product?action=basic_info'; ?>" class="btn ink-reaction btn-primary pull-right mt-4" data-id="">Add Product</a> 
					</div>
					<div class="col-lg-12">
						<?php $this->load->view('include/message');?>
						<div class="cards">
							<div class="card-bodys row ml-2">
								<form class="form" id="search_form" name="search_form" method="post" action="<?php echo base_url('admin/products/export_csv') ?>">
									<div class="col-md-2">
										<div class="form-group floating-label">
											<input type="text" autocomplete="off" class="form-control" name="product_name" value="" id="product_name">
											<label for="regular2">Product Name</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group floating-label">
											<input type="text" autocomplete="off" class="form-control" name="type" value="" id="type">
											<label for="regular2">Product Type</label>
										</div>
									</div>
									<!-- <div class="col-md-2">
										<div class="form-group floating-label">
											<input type="text" autocomplete="off" class="form-control" name="full_lead" value="" id="full_lead">
											<label for="regular2">Full/Lead Product</label>
										</div>
									</div> -->

									<div class="col-md-2">
										<div class="form-group floating-label">
											<select class="form-control select2-list" name="user_id" id="user_id">
												<option value="">Select Partner</option>
												<?php if (!empty($users_list)) {
													foreach ($users_list as $users) { ?>
														<option value="<?php echo $users['user_id'] ?>"><?php echo ucwords($users['first_name'].' '.$users['last_name']) ?></option>
													<?php }
												} ?>
											</select>
											<label for="user_id">Partner Name</label>
										</div>
									</div>
									<div class="col-md-2">
									<div class="form-group floating-label">
										<select class="form-control select2-list" name="company_name" id="company_name">
											<option value=""></option>
										</select>
										<label for="regular2">Select Company</label>
									</div>
								</div>
									<div class="col-md-2">
										<div class="form-group floating-label">
											<select class="form-control select2-list" name="status" value="" id="status">
												<option option=""></option>
												<?php 
												$PRODUCT_STATUS=$this->config->item('PRODUCT_STATUS');
												$html='';
												if (!empty($PRODUCT_STATUS)) {
													foreach ($PRODUCT_STATUS as $row=>$val) { ?>
														
														<option value="<?php echo $row?>"><?php echo $val['label']?></option>;
													<?php  }} ?>
											</select>
											<label for="regular2">Status</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group  ">
											<button type="submit" id="btn-filter" name="search_filter" class="btn ink-reaction btn-primary">Search</button>

											<button type="button" id="btn-filter-clear" class="btn ink-reaction btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>

											<button type="submit" id="" name="export_excel" class="btn ink-reaction btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Export"><i class="fa fa-download  text-info"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="table-responsive">
							<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th style="width: 4%">ID</th>
										<th>Product Name</th>
										<th style="width: 09%">Product Type</th>
										<!--<th>Company Name</th>-->
										<th style="width: 13%">Added By</th>
										<th style="width: 13%">Created On</th>
										<th style="width: 4%">Contact</th>
										<th style="width: 09%">Display Order</th>
										<th style="width: 09%">Product Kind</th>
										<th style="width: 10%">Status</th>
										<th style="width: 10%">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive --> 
					</div>
					<!--end .col --> 
				</div>
				<!--end .row --> 
			</div>
		</div>
		<!--end .section-body --> 
	</section>
</div>
<!--end #content-->

<?php $this->load->view('include/common_script');?>
<script src="<?php echo base_url(); ?>assets/js/myjs_lib.js"></script>

<script type="text/javascript">
	var load_url = "<?php echo site_url('admin/products/change_product_status')?>";
	var products_list = "<?php echo site_url('admin/products/products_list')?>";
	var del_url = "<?php echo site_url('admin/products/delete_product') ?>";
	setTimeout(function() {	    $('.alert').remove()	}, 5000);
	$(function() {

		var table_members = $('#table').DataTable({
			"ordering": false,
			"language": {
				"zeroRecords": "No matching records found.",
				"infoFiltered": ""
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"members": [], //Initial no members.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": products_list,
				"type": "POST",
				"data": function(data) {
					data.product_name = $('#product_name').val();
					data.type = $('#type').val();
					//data.full_lead = $('#full_lead').val();

					data.company_name = $('select[name=company_name]').val();
					data.status = $('select[name=status]').val();
					data.user_id = $('select[name=user_id]').val();
					// data.filter_by 		= $("input[name='filter_by']:checked").val();
				},
				"error": function (x, status, error) {
					Swal.fire('Error', "An error occurred: " + status + "nError: " + error, 'error');
				},
				"statusCode":{
					401: function(responseObject, textStatus, jqXHR) {
						Swal.fire({  type: 'error',  title: 'Oops...',  text: 'Your session has expired please login again.'});
						setTimeout(function() {    window.location.href = logout_url;   }, 1500);
					},        
				},
			},
			
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [1,2,3], //last column
				"orderable": false, //set not orderable
				className: 'dt-body-left'
			}, ],

		});
		

		var submitActor = null;
		var $form = $("form[name='search_form']");
		var $submitActors = $form.find('button[type=submit]');
					
		$("form[name='search_form']").validate({
			rules: {
				
			},
			 messages: {
				
			}, 
			submitHandler: function(form) {
				var $submitActors = $form.find('button[type=submit]');

				if (submitActor.name == 'search_filter') {            
	              table_members.ajax.reload();
	            }

	          	if (submitActor.name == 'export_excel') {  
	          		form.submit();
	          	}
			}
		});
		$submitActors.click(function(event) {
		    submitActor = this;
		});

		$('form[name="search_form"]').on('click', 'button#btn-filter-clear', function(e) {
			$('form[name="search_form"]').trigger('reset');
			$('.select2-list').select2().select2('val','');
			$('#status').val('').trigger("change");
			table_members.ajax.reload();
		});
		$(".select2-list").select2({});

		//active and In-active	
		$('.designation_panel').on('change', '.product_status_leads', function(e) {
			e.preventDefault();
			// obj.update_status($(this), load_url);
			update_status($(this),load_url);

		});


		function update_status(el, load_url)
		{
			var status = el.val();
			console.log(status);
			var id = el.data('id');
			var text= el.find('option:selected').text();
			if(status==''){
				$('.product_status_leads option').prop('selected', function() {
								return this.defaultSelected;
					});
				return false;

			}
			var msg = 'Do you want to change status as '+text+' ?';
			var btn_text = 'Yes';
			var color_btn = '#ffa726';		

			Swal.fire({
				title: "Are you sure ?",
				text: msg,
				icon: "question",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: color_btn,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: load_url,
						data: {
							'products_id': id,
							'product_status': status
						},
						type: "POST",
						dataType: 'json',
						success: function(data) {
							if (data.status === true) 
							{
								table_members.ajax.reload(); //just reload table
							}
							if (data.status === false) {
								Swal.fire(data.message,'','warning');
							}
						}
					});
				} else {
				//Swal.fire("some error occer", { icon: "error",});
					$('.product_status_leads option').prop('selected', function() {
								return this.defaultSelected;
					});
				}
			});
		}
		//product_order

		$(document).on('change', 'select.product_order', function(e) {
			e.preventDefault();

			let order 	= $(this).val();
			let id 		= $(this).data('id');

			

			var msg = 'Do you want to change display order ?';
			var btn_text = 'Yes';
			var color_btn = '#ffa726';		

			Swal.fire({
				title: "Are you sure ?",
				text: msg,
				icon: "question",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: color_btn,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: base_url+'admin/products/update_display_order',
						data: {
							'products_id': id,
							'product_order': order
						},
						type: "POST",
						dataType: 'json',
						success: function(data) {
							if (data.status === true) 
							{
								//Swal.fire(data.message,'','success');
								toastr.success(data.message);
								table_members.ajax.reload(); //just reload table
							}
							if (data.status === false) {
								//Swal.fire(data.message,'','warning');
								toastr.error(data.message);
								$('.product_order option').prop('selected', function() {
									return this.defaultSelected;
								});
							}
						}
					});
				} else {
				//Swal.fire("some error occer", { icon: "error",});
					$('.product_order option').prop('selected', function() {
						return this.defaultSelected;
					});
				}
			});

		});	

		$(document).on('change', 'select.product_kind', function(e) {
			e.preventDefault();

			let kind 	= $(this).val();
			let id 		= $(this).data('id');

			var text= $(this).find('option:selected').text();

			if(kind==''){
				$('.product_kind option').prop('selected', function() {
					return this.defaultSelected;
				});
				return false;
			}

			var msg = 'Do you want to change kind as '+text+' ?';
			var btn_text = 'Yes';
			var color_btn = '#ffa726';		

			Swal.fire({
				title: "Are you sure ?",
				text: msg,
				icon: "question",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: color_btn,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: base_url+'admin/products/update_kind',
						data: {
							'products_id': id,
							'product_kind': kind
						},
						type: "POST",
						dataType: 'json',
						success: function(data) {
							if (data.status === true) 
							{
								Swal.fire(data.message,'','success');
								table_members.ajax.reload(); //just reload table
							}
							if (data.status === false) {
								Swal.fire(data.message,'','warning');
							}
						}
					});
				} else {
				//Swal.fire("some error occer", { icon: "error",});
					$('.product_kind option').prop('selected', function() {
						return this.defaultSelected;
					});
				}
			});

		});	
		
		//delete product
		$(document).on('click', 'a.delete_product', function(e) {
			e.preventDefault();
			var $this = $(this);
			var status = $this.attr('data-status');
			var option={
					title: "Are you sure ?",
					text: 'Do you want to delete this record?',
					icon: "question",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#ffa726',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes',
				};
			if(status==7 || status==8){
				option={
					title: "Are you sure ?",
					text: 'Do you want to delete this record?',
					icon: "question",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#ffa726',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes',
					// allowOutsideClick: false,

					input: 'textarea',
					preConfirm: (result) => {
						// reason = result;
						if ($.trim(result) != '') return result.value;
						Swal.showValidationMessage(`Enter remark.`);
					},
					inputPlaceholder: "Write something",
		  
				};
			}
			Swal.fire(option).then((result) => {
				
				if ($.trim(result.value) !='') {
					var id = $this.attr('data-id');
					$.ajax({
						url: del_url,
						data: {'product_id': id,remark:result.value},
						type: "POST",
						dataType: 'json',
						success: function(data) {
							if (data.status === true) {
								Swal.fire('Status !', data.message, 'success') 
								table_members.ajax.reload();
							}
							if (data.status === false) {
								Swal.fire("some error occer", {	icon: "error"});
							}
						}
					});

				} else {

				}
			});
		});


	});
	get_partners_company();
		function get_partners_company(){
			
			$.ajax({
				url: base_url + 'admin/partners/list_company_dropdowns',
				type: "post",
				dataType: 'html',
				async : false,
				success: function(response) {
				
					$('#company_name').html(response);
					
				},
				cache: false
			})
		}

	$(document).on('click', 'a.showMore', function(e) {
		$(this).parent().parent().find('p.cat_names_full').show();
		$(this).parent().remove();
	});
    
    

</script> 
