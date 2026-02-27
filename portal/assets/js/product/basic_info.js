
// custom method for url validation with or without http://
$.validator.addMethod("cus_url", function(value, element) {
	return this.optional(element) || /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?|^((http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/.test(value);
}, "Please enter a valid URL ex.http://.");

$.validator.addMethod('filesize', function (value, element,param) {   
    // console.log(sizeInMB);
    if(this.optional(element) || (element.files[0].size / (1024*1024)).toFixed(2) <=param){
      return true
    }else{
      return false;
    }  
}, 'File size error.');

$.validator.addMethod("is_version", function(value, element) {
	var pattern = new RegExp(/^[0-9.]+$/);
	if (this.optional(element) || (pattern.test(value))) {
	  return true;
	}
}, "Please enter a valid version.");


$(document).on('click', '.select2-selection__choice__remove', function() {
  $('#category_id_checkbox').prop("checked", false);
});

$(".js-select2").select2({
	closeOnSelect: false,
	placeholder: "Select categories",
	allowHtml: true,
	allowClear: true,
	/*tags: true*/ // создает новые опции на лету
});

$('.icons_select2').select2({
    width: "100%",
    templateSelection: iformat,
    templateResult: iformat,
    allowHtml: true,
    placeholder: "Select categories",
    dropdownParent: $('.select-icon'), //обавили класс
    allowClear: true,
    multiple: false
});

function iformat(icon, badge, ) {
    var originalOption = icon.element;
    var originalOptionBadge = $(originalOption).data('badge');

    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
}

$(document).on('change','select[name="programming_lang"],select[name="framework"]',function(e) {
  if ($(this).val() == 'other') {
    $('#other_'+$(this).attr("name")).show();
  }else{
    $('#other_'+$(this).attr("name")).hide();
  }
});


$('.version').keyup(function() {   this.value = this.value.replace(/[^0-9\.]/g, ''); });

$(document).on('change','#logo',function(){
    //Replace with your selector to find the file input in your form
      var fileInput = $('form[name=product_form]').find("input[name=logo]")[0];
      var file = fileInput.files && fileInput.files[0];

      if (file) {
        var img = new Image();

        img.src = window.URL.createObjectURL(file);

        img.onload = function() {
          var width = img.naturalWidth,
          height = img.naturalHeight;
          window.URL.revokeObjectURL(img.src);
          if (width <= 180 && height <= 80) {
            valid =true;
            $('#logo_check').val(true);
            $('.logo-error').remove();
          } else {
            $('.logo-error').remove();
            $('input[name=logo]').focus();
            $('input[name=logo]').find('.fileContainer').closest(".form-group").addClass("has-error");
            $('input[name=logo]').closest('.fileContainer input').after('<span id="logo-error"  class="help-block logo-error">File choose width:180px, height:80px.</span>');
            $('#logo_check').val(false);
            // return false;
          }
        };
      } 
})

$("select[name=type]").change(function() {
  var select_data = $(this).val();
    // alert(select_data);
    if(select_data){
     if (select_data == "Instance Base") {
      $('#add_demo_url').removeClass('hide');
      $('.inst').removeClass('hide');
      $('.reg').addClass('hide');

    } else {
      $('#add_demo_url').addClass('hide');
      $('.inst').addClass('hide');
      $('.reg').removeClass('hide');

    }
  }else{
     $('.reg,#add_demo_url').addClass('hide');
     $('.inst').addClass('hide');
  }

});

/*Product Name accepts only +,-,&,num,character*/
    jQuery.validator.addMethod("letterswithspace", function(value, element) {
      return this.optional(element) || /[a-z 0-9~%.:_\-@\=+&]*$/i.test(value); 
    }, "letters only");


$("form[name='product_form']").validate({
    ignore: [],
    rules: {
      product_name: {
        required : true,
        noSpace : true,
        letterswithspace : true,
      },
       short_brief: {
        required : true,
        noSpace : true,
        //letterswithspace : true,
      },
      'category_id[]': {
        required: true
      },
      sub_category_id: {
        required: false
      },
      other_programming_lang: {
         noSpace: true,
         required: function(element){
            return $("#programming_lang").val() == 'other';
        }
      },
      other_framework: {
        noSpace: true,
        required: function(element){
            return $("#framework").val() == 'other';
        }
      },
      version: {
        noSpace: true,
        is_version: true,
      },
      demo_url: {
        cus_url: true
      },

      client_login_url: {
        required: function() {
          if ($('select[name=type]').val() == 'Multi Tenant') {
            return true;
          } else {
            return false;
          }
        },
        cus_url: true
      },
      type: {
        required: true
      },
      logo: {
        required: function() {
          if ($('#old_logo').val() == '') {
            return true;
          } else {
            return false;
          }
        },
        accept: "jpg,png,jpeg"
      },

    },
    messages: {
      product_name: {
        required: "Please enter product name.",
        letterswithspace : "Please enter valid product name.",
        noSpace: "Space is not allowed."
      },
      short_brief: {
      required: "Please enter short brief.",
      //  letterswithspace : "Please enter valid product name.",
        //noSpace: "Space is not allowed."
      },
      'category_id[]': {
        required: "Please select categories."
      },
      sub_category_id: {
        required: "Please select sub categories."
      },
      demo_url: {
        isurl: "Please enter a valid URL ex.http://"
      },
      register_api: {
        cus_url: "Please enter a valid URL ex.http://"
      },
      client_login_url: {
        required: "Please enter a valid URL ex.http://"
      },
      type: {
        required: "Please select product type."
      },
      logo: {
        accept: "Allowed only jpg, jpeg, png only.Max size 2MB."
      },

    },
    submitHandler: function(form) {
      var valid = true;
      //Replace with your selector to find the file input in your form
      var fileInput = $(form).find("input[name=logo]")[0];
      var file = fileInput.files && fileInput.files[0];

      if (file) {
        var img = new Image();

        img.src = window.URL.createObjectURL(file);

        img.onload = function() {
          var width = img.naturalWidth,
          height = img.naturalHeight;

          window.URL.revokeObjectURL(img.src);

          if (width <= 180 && height <= 80) {
            valid =true;
          } else {
            $('input[name=logo]').focus();
            $('input[name=logo]').find('.fileContainer').closest(".form-group").addClass("has-error");
            $('input[name=logo]').closest('.fileContainer input').after('<span id="' + Math.random() + '-error" class="help-block">File choose width:180px, height:80px.</span>');
        
          }
        };
      } 

      if (valid === true && $('#logo_check').val()=='true') {  

          var formData = new FormData(form);


        $.ajax({
          url:  action_url,
          data:  formData,
          type: "POST",
          dataType: 'json',
          contentType: false,
          processData: false,
         
          success: function(data){
              
              if (data.status === true) { 
                Swal.fire('Success', data.msg , 'success').then((result) => {
                  window.location.href = data.url; 
                });

              }else{

                Swal.fire('Error', data.msg , 'error').then((result) => {
                  window.location.href = data.url; 
                });
              }


          }
        }); 
      }
    }
});


$("#category_id_checkbox").click(function() {
    if ($("#category_id_checkbox").is(':checked')) {

      $("select#category_id > option").prop("selected", true);
      $("select#category_id").trigger("change");
    } else {

      $("select#category_id > option").prop("selected", false);
      $("select#category_id").trigger("change");
    }
});
var a = $("select[name='category_id[]'] option").length;

if (a == $("select[name='category_id[]'] option:selected").length) {
    $('#category_id_checkbox').prop("checked", true);
}

$("select#category_id").change(function() {
    var a = $("select[name='category_id[]'] option").length;

    if (a == $("select[name='category_id[]'] option:selected").length) {
      $('#category_id_checkbox').prop("checked", true);
    }
});
