<!-- Bootstrap core JavaScript
  ================================================== -->
  <script src="<?=base_url()?>assets/csc/js/ie-emulation-modes-warning.js"></script>
  <script src="<?=base_url()?>assets/csc/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/front/js/jquery-3.5.1.slim.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
  <script src="<?=base_url()?>assets/front/js/sweetalert2.all.js"></script>
  <script src="<?=base_url()?>assets/csc/js/popper.min.js"></script>
  <script src="<?=base_url()?>assets/csc/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/csc/js/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="<?=base_url()?>assets/csc/js/aos.js"></script>
  <script src="<?=base_url()?>assets/csc/js/comman.js?v=<?=time()?>"></script>
  <!--<script src="<?=base_url()?>assets/js/custom.js?v=<?=time()?>"></script>-->
  <script>
    feather.replace()
  </script>
  <script>
    AOS.init();
  </script>
  <script>
    // Preloader
    $(window).on('load', function () {
        if ($('#preloader').length) {
            $('#preloader').delay(100).fadeOut('slow', function () {
                $(this).remove();
            });
        }
    });
      
    $("#search_input").keyup(function(){
    	search_fun();	
    });
    
    
    function search_fun() {
        $('form[name="search_form"]').find('input[name="search"]').removeClass('border border-danger');
        $('form[name="search_form"]').find('input[name="search"]').attr('placeholder', 'Search here...');
    	$('#search-error').remove(); 
    	$("#suggesstion-box").html('');
    	$("#suggesstion-box").hide();
     	$('.header_search_button ').removeClass('search_btn_new');
     	let search_str = $('form[name="search_form"]').find('input[name="search"]').val();
     	if(search_str){
    //  		if (search_str.length > 2) {
    			$.ajax({
    				type: "POST",
    				url:  base_url+'predective-search',
    				data:{search_key:search_str},
    				async:false,
    				dataType: "HTML",
    				beforeSend: function(){
    					// $("#search_input").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    				},
    				success: function(data){
    				    // console.log(data);
    					if (data !='') {
    						$("#suggesstion-box").show();
    						$("#suggesstion-box").html(data);
    						$('form[name="search_form"]').find('#suggesstion-box').focus();
    				// 		console.log('suggesstion-box>>'+$('#suggesstion-box').focus());
    						$('.header_search_button ').addClass('search_btn_new');
    						// $('#suggesstion-box').focus();
    					}else{
    						$('.header_search_button ').addClass('search_btn_new');
    						$('form[name="search_form"]').find('input[name="search"]').attr('placeholder', 'No result found for this query.');
    	 					$('form[name="search_form"]').find('input[name="search"]').focus();
    					}
    				}
    			});
            
    //  		}else{
    //  			$('.header_search_button ').addClass('search_btn_new');
    // 	 		$('form[name="search_form"]').find('input[name="search"]').after('<span id="search-error" class="help-block">Please enter more characters to search.</span>');
    // 	 		$('form[name="search_form"]').find('input[name="search"]').focus();
    //  		}
    
     	}else{
    //  		$('.header_search_button ').addClass('search_btn_new');
    //  		$('form[name="search_form"]').find('input[name="search"]').after('<span id="search-error" class="help-block">Please enter search text.</span>');
            $('form[name="search_form"]').find('input[name="search"]').addClass('border border-danger');
     		$('form[name="search_form"]').find('input[name="search"]').focus();
     	}
    }
  </script>