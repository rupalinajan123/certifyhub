<!-- new home page css -->

<script src="<?php echo base_url(); ?>assets/front/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/front/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/front/plugins/easing/easing.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="<?php echo base_url(); ?>assets/front/js/jquery.sticky.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/sweetalert2.all.js"></script>

<script src="<?php echo base_url(); ?>assets/front/js/easyResponsiveTabs.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/comman.js"></script>

 <script>
    $(document).ready(function () {
      var width = $('.owl-stage-outer').find('div.owl-item').css('width');
      $('div.fixed_link_patch').css("width", width);
      $('div.fixed_link_patch').css("left", width);
      
      //$('.product-view').each(function() {
        //alert('***');
        var content = $('.product-view').text(); 
        //alert(content.length);
        if(content.length < 100){
          //alert('if');
         // $("#overview").removeClass("showview");
         $("#btn-product").css('display','none');
        }
        else{
          //alert('else');
         // $("#overview").addClass("showview");
          $("#btn-product").css('display','block');
        }
      //});

      var x=5;
      var size_li = $('.reviewList').find('li').length;
      $('ul.reviewList li').hide();
      $('ul.reviewList li:lt('+x+')').show();

      $('#showMore').click(function () {

          x= (x+5 <= size_li) ? x+5 : size_li;
          $('ul.reviewList li:lt('+x+')').show();
          $('.showLess_div').css('display','block');
          
          if(x == size_li){
            $('.showMore_div').css('display','none');
          }
      });

      $('#showLess').click(function () {
          x=(x-5<0) ? 3 : x-5;
          $('.reviewList li').not(':lt('+x+')').hide();
          $('.showMore_div').css('display','block');
          $('.showLess_div').css('display','block');
          //$('#showLess').show();
        
          if(x == 0){
              $('.showLess_div').hide();
          }
      });

      // Add smooth scrolling to all links
        $("a.buyLink").on('click', function(event) {

          // Make sure this.hash has a value before overriding default behavior
          if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
              scrollTop: $(hash).offset().top
            }, 800, function(){
         
              // Add hash (#) to URL when done scrolling (default click behavior)
              window.location.hash = hash;
            });
          } // End if
        });
    });
  </script>

  <script type="text/javascript">
    $('#btn-product').click(function(){         //overview page
      $("#overview").addClass("showview");
      document.getElementById('overview').style.height='100%';
      
      $("#btn-product").css('display','none');
      $("#btn-product-less").css('display','block');
      
    });

  $('#btn-product-less').click(function(){      // overview page
  
    $("#overview").removeClass("showview");
      //$("#overview").slideUp();
      document.getElementById('overview').style.height='300px';

      $("#btn-product").css('display','block');
      $("#btn-product-less").css('display','none');
  });

  $('.read_more').click(function(){ //review page

    var id = $(this).attr('data-id');
    
    $("#more_"+id).css('display','block');
    $("#btn_read_more_"+id).css('display','none');
    $("#btn_read_less_"+id).css('display','block');

  });

  $('.read_less').click(function(){ //review page
    
    var id = $(this).attr('data-id');
    $("#more_"+id).css('display','none');
    $("#btn_read_less_"+id).css('display','none');
    $("#btn_read_more_"+id).css('display','block');

  });

</script>

<!-- <link rel="stylesheet" href="https://console.genietalk.ai/devtool/app.css"/>
<script>GenietalkBusinessID="60b8a97ec9062a0028369e57";BotColor="rgb(21, 243, 243)";</script>
<script src="https://console.genietalk.ai/devtool/bundle.js"></script>
 -->

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

  