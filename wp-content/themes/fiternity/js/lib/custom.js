/*Email validation*/
function isValidEmailAddress(r) {
	var e = RegExp(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i);
	return e.test(r)
}

/*Telephone validation*/
function isNumber(elementRef) {
  keyCode=elementRef.charCode;
  // var keyCode = (event.which) ? event.which : (window.event.keyCode) ?    window.event.keyCode : -1;
  // console.log(keyCode);
  if ((keyCode >= 48) && (keyCode <= 57) || (keyCode <= 32)) {
	  return true;
  }  else if (keyCode == 43) {
	  if (jQuery('#'+elementRef.target.id).val().trim().length == 0){
		  return true;
	  } else {
		  return false;
	  }
  }
  return false;
}

/*Name validation*/
function onlyAlphabets(e) {
  try {
	  if (window.event) {
		  var charCode = window.event.keyCode;
	  }else if (e) {
		  var charCode = e.which;
	  } else {
		  return true;
	  }
	  if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode==0 || charCode==8){
		  return true;
	  }else{
		  return false;
	  }
  }
  catch (err) {
	  alert(err.Description);
  }
}

/*validate email with charCode*/
jQuery(document).on('keypress','#user_email,#email',function(e){
jQuery(this).attr('maxlength','100');
  try {
	  if (window.event) {
		  var charCode = window.event.keyCode;
	  } else if (e) {
		  var charCode = e.which;
	  } else { return true; }
	  if ((charCode > 63 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 47 && charCode < 58) || charCode==0 || charCode==8 || charCode==46 || charCode==45 || charCode==95){
		  return true;
	  } else {
		  return false;
	  }
  }
  catch (err) {
	  alert(err.Description);
  }
});

jQuery(document).on('keypress','#dbem_phone,#telephone,#no_of_seats',function(e){
  var keyCode=e.charCode;
  if (keyCode == 32 && jQuery('#'+e.target.id).val().trim().length == 0) {
	  return false;
  }
  if (keyCode == 43 && jQuery('#'+e.target.id).val().trim().length == 0) {
	  return true;
  } else {
	  if ((keyCode >= 48) && (keyCode <= 57) || (keyCode <= 32)) {
		  return true;
	  } else {
		  return false;
	  }
  }
  return false;
});

jQuery(document).on('keypress','#user_name,#firstname',function(e){
  try {
  if (window.event) {
	  var charCode = window.event.keyCode;
  }
  else if (e) {
	  var charCode = e.which;
  }
  else { return true; }
  if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode==0 || charCode==8)
	return true;
  else if ((charCode === 32 && !this.value.length))
	return false;
  else if (charCode == 32)
	return true;
  else
	  return false;
  }
  catch (err) {
   // alert(err.Description);
  }
});

/*allow only one space*/
var lastkey;
var ignoreChars = ' '+String.fromCharCode(0);
jQuery(document).on('keypress','#user_name,#dbem_phone,#no_of_seats,#firstname,#telephone',function(e){
 e = e || window.event;
 var char = String.fromCharCode(e.charCode);
 if (ignoreChars.indexOf(char) == 0 && ignoreChars.indexOf(lastkey) == 0) {
	 lastkey = char;
	 return false;
 } else {
	 lastkey = char;
	 return true;
 }
});

/*********Mobile Validation*********/
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("android") > -1 && !(ua.indexOf('chrome firefox') > -1)) {
	$(document).on('keyup keypress','#user_name,#firstname',function(e) {
		var regex = /^[a-zA-Z]$/;
		var regexSpace = /^[a-zA-Z\s]$/;
		var str = $(this).val();
		var subStr = str.substr(str.length - 1);
		if (!regex.test(subStr)) {
			if (str.length == 1) {
				$(this).val(str.substr(0, (str.length - 1)));
			}
			else if (str.length > 1) {
				if (!regexSpace.test(subStr)) {
					$(this).val(str.substr(0, (str.length - 1)));
				}
			}
			else {
				$(this).val();
			}
		}
	});
}
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("android") > -1 && !(ua.indexOf('chrome firefox') > -1)) {
	$(document).on('keyup keypress','#user_email,#email',function(e) {
		var regex = /^[a-zA-Z0-9@_-]$/;
		var regexSpace = /^[a-zA-Z0-9.@_!#$%^&()=,[]|{}]$/;
		var str = $(this).val();
		var subStr = str.substr(str.length - 1);
		if (!regex.test(subStr)) {
			if (str.length == 1) {
				$(this).val(str.substr(0, (str.length - 1)));
			}
			else if (str.length > 1) {
				if (!regexSpace.test(subStr)) {
					$(this).val(str.substr(0, (str.length - 1)));
				}
			}
			else {
				$(this).val();
			}
		}
	});
}
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("android") > -1 && !(ua.indexOf('chrome firefox') > -1)) {
	jQuery('#dbem_phone,#telephone,#no_of_seats').prop('type','tel');
	$('#dbem_phone,#telephone,#no_of_seats').bind('input keyup keypress', function(e) {
		var regex = /^[0-9]*$/;
		var regexSpace = /^[+0-9]*$/;
		var str = $(this).val();
		var subStr = str.substr(str.length - 1);
		if (regex.test(subStr)) {
		   $(this).val();
		} else {
			if (str.length == 1) {
			   $(this).val(str.substr(0, (str.length - 1)));
			} 
			else if (str.length > 1) {
				if (!regexSpace.test(subStr)) {
				   $(this).val(str.substr(0, (str.length - 1)));
				}
			}
			else {
				$(this).val();
			}
		}
	}); 
}

$(function(){

	$("#no_of_seats").on("keyup",function(){
		var value = parseFloat(this.value);
		if(value == 0) {
			$(this).val(1); 
			$(this).addClass('input-email-active');                                   
		} 
		if(value!='' && !isNaN(value)){
			var amountval = parseFloat($('#payamount').val());
			var totalPrice = parseFloat(amountval*value);
			var amtInPounds = parseFloat(totalPrice/100);
			$('#total_price').val(amtInPounds);
			if(amtInPounds != 0) {
			  $('.total_price_val').show();                                    
			} else {
				$('.total_price_val').hide(); 
			}
		} else {
			$('#total_price').val(0);
			$('.total_price_val').hide();
		}
	});

	/********* Mobile view tabs ***********/
	$('.tabs-menu a').on("click",function() {
		var className = $(this).attr("class");
		if(className=='move') {
			$('.tile-swapcontainer .move').show();
			$('.tile-swapcontainer .fuel').hide();
			$('.tile-swapcontainer .life').hide();
		} else if(className=='fuel') {
			$('.tile-swapcontainer .fuel').show();
			$('.tile-swapcontainer .move').hide();
			$('.tile-swapcontainer .life').hide();
		} else {
			$('.tile-swapcontainer .life').show();
			$('.tile-swapcontainer .move').hide();
			$('.tile-swapcontainer .fuel').hide();
		}
	});
	
	var err_email = "Please enter your email address";
	var err_emailvalid = "Please enter a valid email address";

	/********* Newsletter subscription validation ***********/
	$(document).on('click','#subscribe-button', function () {
		$('.msg_sub').hide();
		$('.err-msg').hide();
		var $this = $(this);
		var sub_email = $('#subscribe-email').val();
		sub_email = jQuery.trim(sub_email);
		if (sub_email == '' || sub_email == null) {
			$('#err_sub_email').text(err_email);
			$('#err_sub_email').css('display', 'block');            
			return false;
		} else if (!isValidEmailAddress(sub_email)) {
			$('#err_sub_email').text(err_emailvalid);
			$('#err_sub_email').css('display', 'block');
			return false;
		} else {
			$('#err_sub_email').css('display', 'none'); 
			$.ajax({
				type: "POST",
				url: templateUri+"/ajax.php/",
				data: {email: sub_email,action: 'subscribe'}
				}).done(function (msg) {
					if(msg==1)
					{
						$('#subscribe-email').val('');
						$('.err-msg').hide();
						$('.msg_sub').show();
					   
						setTimeout(function(){ 
							$('#preloader_sub').css('display','none');
							$('#subscribe-row').hide();
							$('#submitBtn').css('display','block');
						}, 500); 
					} else {
						$('#subscribe-email').val('');
						$('.err-msg').show();
						$('.msg_sub').hide();
						
						setTimeout(function(){ 
							$('#preloader_sub').css('display','none');
							$('#submitBtn').css('display','block');
						}, 500); 
					}
			});
			return false;
		}
	});
	/********* Booking form show and hide ***********/
	$(document).on("click","#booking-form",function(){
		if($('#form-book').css('display') == 'block')
		{
			if($('#book-form').length>0) {
				$('#book-form')[0].reset();
			}
			$('.error-message').hide();
			$('#book-form .form-row').removeClass('error-row');
			$('#book-form .input-item').removeClass('input-email-active');
			$('.total_price_val').hide();
			$(this).text('Book now');
			$('#content-event').show();
			$('#form-book').hide();
		} else {
			$('.total_price_val .input-item').addClass('input-email-active');
			$(this).text('Description');
			$('#content-event').hide();
			$('#form-book').show();
		}
	});


	/********* Search form submit ***********/
	$(".tag-search").on("click",function(){
		if($(".search-text").val() != '') {
			$(this).parents('form').submit();
		}
	});
	$(document).on("keyup",".search-text",function(){
		if($(this).val() != '') {
			$('.tag-search').removeClass('disabled');
		} else {
			if($('.disabled').length==0) {
				$('.tag-search').addClass('disabled');
			}
		}
	});
	/********* selected attribute for select box ***********/
	/*$(document).on("change","select",function(){
		$("option[value=" + this.value + "]", this).attr("selected", true).siblings().removeAttr("selected")
	});*/

	/********* Booking form validation ***********/
	$(document).on('click', '#em-booking-submit', function(){
		var name=jQuery('#user_name').val();
		var email=jQuery('#user_email').val();
		var telephone=jQuery('#dbem_phone').val();
		//var seats=jQuery('.em-ticket-select').val();
		var seats= parseFloat(jQuery('#no_of_seats').val());
		var amountval =  parseFloat($('#payamount').val());
		var availableSpaces =  parseFloat($('#available_spaces').val());
		var totalAmt =  parseFloat(amountval*seats);
		var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		var x=0;
		if (name=='' || name == undefined) {
		   jQuery('#err_user_name').text("Please enter your name").show();
		   jQuery('#err_user_name').parents('.form-row').addClass('error-row');
		   jQuery('#err_user_name').text("Please enter your name").show();
		   x++;
		} else {
		   jQuery('#err_user_name').parents('.form-row').removeClass('error-row');
		   jQuery('#err_user_name').hide();
		}
		if (seats=='' || seats == undefined || isNaN(seats)) {
		   jQuery('#err_no_of_seats').text("Please enter the number of seats you want to book").show();
		   jQuery('#err_no_of_seats').parents('.form-row').addClass('error-row');
		   x++;
		} else {
			if(seats>availableSpaces) {
				jQuery('#err_no_of_seats').text("Sorry! the maximum seats available is "+availableSpaces).show();
				jQuery('#err_no_of_seats').parents('.form-row').addClass('error-row');
				x++;
			} else {
			   jQuery('#err_no_of_seats').parents('.form-row').removeClass('error-row');
			   jQuery('#err_no_of_seats').hide();
			}
		}
		if (email!='') {
			if (!regex.test(email)) {
			   jQuery('#err_user_email').hide();
			   jQuery('#err_user_email').parents('.form-row').addClass('error-row');
			   jQuery('#err_user_email').text("Please enter a valid email address").show();
			   x++;
		   } else {
			   jQuery('#err_user_email').parents('.form-row').removeClass('error-row');
			   jQuery('#err_user_email').hide();
		   }
		} else {
		   jQuery('#err_user_email').hide();
		   jQuery('#err_user_email').text("Please enter your email address").show();
		   jQuery('#err_user_email').parents('.form-row').addClass('error-row');
		   x++;
		}
		if (telephone=='' || telephone == undefined) {
		   jQuery('#err_telephone').parents('.form-row').addClass('error-row');
		   jQuery('#err_telephone').text("Please enter your telephone number").show();
		   x++;
		} else {
		   if(telephone.length<10) {
				jQuery('#err_telephone').parents('.form-row').addClass('error-row');
				jQuery('#err_telephone').text("Please enter a valid telephone number").show();
				x++;
			} else {
				jQuery('#err_telephone').parents('.form-row').removeClass('error-row');
				jQuery('#err_telephone').hide();
			}
		}
		if (x==0) {
			if(amountval!= "000" || amountval != 000) {
				var len = $('script[src*="https://checkout.stripe.com/checkout.js"]').length; 

				$(this).parents('form').append("<script src='https://checkout.stripe.com/checkout.js' class='stripe-button' data-email="+email+" data-key='pk_live_7BzwdK9geTba3APdUNU401Cb' data-name='fiternity.co' data-currency='gbp' data-amount="+totalAmt+"></"+"script>");
				if (len > 0) {
					$('#book-form script[src*="https://checkout.stripe.com/checkout.js"]').remove();
					$('#book-form').append("<script src='https://checkout.stripe.com/checkout.js' class='stripe-button' data-email="+email+" data-key='pk_live_7BzwdK9geTba3APdUNU401Cb' data-name='fiternity.co' data-currency='gbp' data-amount="+totalAmt+"></"+"script>");
				}
				if($('.stripe-button-el').length > 0) {
					$(".stripe-button-el").remove();
				}
				$(this).val('Please wait..');
				$(this).attr('disabled','disabled');
				$(this).addClass('disabled');
				setTimeout(function(){
					$(".stripe-button-el").trigger("click");

				},2500);
				setTimeout(function(){
					$('#em-booking-submit').val('Send your booking');
					$('#em-booking-submit').removeAttr('disabled','disabled');
					$('#em-booking-submit').removeClass('disabled');
				},4000);
				return false;
			} else {
				return true;
			}
			
		}
		return false;
	});

	/********* Contact form validation ***********/
	$(document).on('click', '#contact_submit', function(){
		var name=jQuery('#firstname').val();
		var email=jQuery('#email').val();
		var telephone=jQuery('#telephone').val();
		var message=jQuery('#message').val();
		var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		var x=0;
		if (name=='' || name == undefined) {
		   jQuery('#err_name').text("Please enter your name").show();
		   jQuery('#err_name').parents('.form-row').addClass('error-row');
		   jQuery('#err_name').text("Please enter your name").show();
		   x++;
		} else {
		   jQuery('#err_name').parents('.form-row').removeClass('error-row');
		   jQuery('#err_name').hide();
		}
		if (email!='') {
			if (!regex.test(email)) {
			   jQuery('#err_email').hide();
			   jQuery('#err_email').parents('.form-row').addClass('error-row');
			   jQuery('#err_email').text("Please enter a valid email address").show();
			   x++;
		   } else {
			   jQuery('#err_email').parents('.form-row').removeClass('error-row');
			   jQuery('#err_email').hide();
		   }
		} else {
		   jQuery('#err_email').hide();
		   jQuery('#err_email').text("Please enter your email address").show();
		   jQuery('#err_email').parents('.form-row').addClass('error-row');
		   x++;
		}
		if (telephone=='' || telephone == undefined) {
		   jQuery('#err_telephone').parents('.form-row').addClass('error-row');
		   jQuery('#err_telephone').text("Please enter your telephone number").show();
		   x++;
		} else {
			if(telephone.length<10) {
				jQuery('#err_telephone').parents('.form-row').addClass('error-row');
				jQuery('#err_telephone').text("Please enter a valid telephone number").show();
				x++;
			} else {
				jQuery('#err_telephone').parents('.form-row').removeClass('error-row');
				jQuery('#err_telephone').hide();
			}
		}
		if (message=='' || message == undefined) {
		   jQuery('#err_message').parents('.form-row').addClass('error-row');
		   jQuery('#err_message').text("Please enter your message").show();
		   x++;
		} else {
		   jQuery('#err_message').parents('.form-row').removeClass('error-row');
		   jQuery('#err_message').hide();
		}
		if (x==0) {
			return true;
		}
		return false;
	});
	/*$('.input-item').on("click mousedown mouseup focus blur keydown keyup change",function(e){
     console.log(e);
	});*/


	/********* Form validation - General ***********/
	$(".input-item").not(".non-mandatory").bind({         
		keyup: function(event) {

			var $thisValue = $(this).val();
		   var $errorText  = $(this).parents('.form-row').find('label').attr('data-error');
		   var availableSpaces = parseFloat($('#available_spaces').val());
		   if ($thisValue.length == 0 && $(this).parents('.form-row').find('.error-message').length==0) {
			  if($(this).parents('.form-row').find('.error-message').is(':hidden')) {
				$(this).parents('.floating-item').next('.error-message').css('display','none');
				$(this).parents('.form-row').addClass('error-row');
				$(this).parents('.floating-item').next('.error-message').text($errorText).slideDown();
			  }
		   } else if ($thisValue.length != 0 && $(this).parents('.form-row').find('.error-message').length==0) {
			  $(this).parents('.form-row').removeClass('error-row');
			  $(this).parents('.form-row').find('.error-message').hide();
			  if ($(this).hasClass('validate-email')) {
				  if (0 == isValidEmailAddress($(this).val())) {
					  e = 'Please enter a valid email address';
					  $(this).parents(".form-row").addClass("error-row");
					  $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

				  } else {
					  $(this).parents(".form-row").removeClass("error-row");
					  $(this).parents(".form-row").find(".error-message").fadeOut(function() {
						  $(this).hide();
					  });
				  }
			  } else if ($(this).hasClass('validate-mobile')) {
				  if ($(this).val().length < 10) {
					  e = 'Please enter a valid telephone number';
					  $(this).parents(".form-row").addClass("error-row");
					  $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

				  } else {
					  $(this).parents(".form-row").removeClass("error-row");
					  $(this).parents(".form-row").find(".error-message").fadeOut(function() {
						  $(this).hide();
					  });
				  }
			  } else if ($(this).hasClass('validate-seats')) {
				  if ($(this).val() > availableSpaces) {
					  e = 'Sorry! the maximum seats available is '+availableSpaces;
					  $(this).parents(".form-row").addClass("error-row");
					  $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

				  } else {
					  $(this).parents(".form-row").removeClass("error-row");
					  $(this).parents(".form-row").find(".error-message").fadeOut(function() {
						  $(this).hide();
					  });
				  }
			  }
		   }
		},
		blur: function(event) {
			 var $thisValue = $(this).val();
		   var $errorText  = $(this).parents('.form-row').find('label').attr('data-error');
		   var availableSpaces =  parseFloat($('#available_spaces').val());
		   $(this).parent('.floating-item').removeClass('input-animate');
		   if ($thisValue.length == 0) {
				if($(this).parents('.form-row').find('.error-message').is(':hidden')) {
					$(this).parents('.floating-item').next('.error-message').css('display','none');
					$(this).parents('.form-row').addClass('error-row');
					$(this).parents('.floating-item').next('.error-message').text($errorText).slideDown();
				}
			} else {
				$(this).parents('.form-row').removeClass('error-row');
				$(this).parents('.form-row').find('.error-message').hide();
				if ($(this).hasClass('validate-email')) {
					if (0 == isValidEmailAddress($(this).val())) {
						  e = 'Please enter a valid email address';
						  $(this).parents(".form-row").addClass("error-row");
						  $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();
					} else {
						$(this).parents(".form-row").removeClass("error-row");
						$(this).parents(".form-row").find(".error-message").fadeOut(function() {
							$(this).hide();
						});
					}
				} else if ($(this).hasClass('validate-mobile')) {
					if ($(this).val().length < 10) {
						e = 'Please enter a valid telephone number';
						$(this).parents(".form-row").addClass("error-row");
						$(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();
					} else {
						$(this).parents(".form-row").removeClass("error-row");
						$(this).parents(".form-row").find(".error-message").fadeOut(function() {
							$(this).hide();
						});
					}
				} else if ($(this).hasClass('validate-seats')) {
				  if ($(this).val() > availableSpaces) {
					  e = 'Sorry! the maximum seats available is '+availableSpaces;
					  $(this).parents(".form-row").addClass("error-row");
					  $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

				  } else {
					  $(this).parents(".form-row").removeClass("error-row");
					  $(this).parents(".form-row").find(".error-message").fadeOut(function() {
						  $(this).hide();
					  });
				  }
			  }
			}
		}
	});
});

/********Learn-More functions*************/
jQuery(document).on('click','#load-more-products',function(){
    careerAjaxSend = true;
    var val = $('#child-id').val();
	var categoryId = $('#cat_id').val();
	var categoryName = $('#cat_name').val();
	var hidden = $('#blogs-hidden').val();
	var postIdArray = [];
	var cntPost = $('#pst_count').val();
	// console.log('here'+postIdArray);
	$(this).parents('.grid-widget').find('.blog_col').each(function() {
    	postIdArray.push($(this).attr('data-id'));
    });
	$.ajax({
        url : tmpl_url+'/ajax/product_load.php',
		method: 'post',
        data: {postIdArray:postIdArray, categoryId: categoryId,categoryName:categoryName,cntPost:cntPost},
	    success: function(data){
	    	setTimeout(function(){
$('.col-4 .whitebox').matchHeight();
    $('.slider-blk .whitebox').matchHeight();
},100);
	    	 if(cntPost <= parseInt(postIdArray.length+3)){
	    	 	$("#loadMore").css("display","none");
	    	 }
	    	$('#life').append(data);
	    	
        }
    });
});

jQuery(document).on('click','#load-more-events',function(){
    careerAjaxSend = true;
    console.log('lll');
	var eventCategoryId = $('#event_id').val();
	var postIdArray = [];
	var eventCategoryName = $('#cat_name').val();
	var cntPost = $('#event_count').val();
	
	$(this).parents('.cont-events').find('#eventList .event_col').each(function() {
    	postIdArray.push($(this).attr('data-id'));
    });
    console.log(postIdArray);
	$.ajax({
        url : tmpl_url+'/ajax/event_load.php',
		method: 'post',
        data: {eventCategoryId: eventCategoryId,eventCategoryName:eventCategoryName,postIdArray:postIdArray},
	    success: function(data){
	    	console.log(data);
	    	setTimeout(function(){
			$('.col-4 .whitebox').matchHeight();
			    $('.slider-blk .whitebox').matchHeight();
			},100);
	    	 if(cntPost <= parseInt(postIdArray.length+3)){
	    	 	$("#loadMoreEvent").css("display","none");
	    	 } 	
	    	$('#eventList').append(data);
	    	
        }
    });
});


// $(document).ready(function(){
// 	$(".button_cookk").click(function(){
//       var the_cookie = "cook_pol=1"; 
//       document.cookie = the_cookie;
//       $("body").removeClass("hide-content");
//       $(".cookiepolicy").fadeOut("fast");
//        });
// });
$(document).ready(function() {
jQuery(document).on('click','.button_cookk',function(){
	var cookie_name = 'cook_pol';
	var cookie_value = "1";
    $.ajax({
   		url: tmpl_url + '/ajax/cookie-ajax.php',
        data: {cookie_name: cookie_name, cookie_value:cookie_value},
        type:"POST",
        success: function(result) {
        	console.log(result);
        $("body").removeClass("hide-content");
        $(".cookiepolicy").fadeOut('fast');
        location.reload();
        	
        }
	});
});
});