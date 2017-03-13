"use strict"
$(window).on('load', function(){
	$('#log-btn').on('click', function(){
		$('#loginModal').modal('show');
	});
	$('#reg-btn').on('click', function(){
		$('#regModal').modal('show');
		
	});

	submitActivator();	
	
	$("#confPassword, #passwordReg").on("change focus input", function() {
		var confPass = $("#confPassword");
		var pass     = $("#passwordReg");
		
		if(confPass.val() != pass.val()){
			$(".passwordFG").addClass(" has-error");
			passCheck = false;
		}else{
			$(".passwordFG").removeClass(" has-error");
			passCheck = true;
		}
	});

	$('#regForm .form-control').on('input change', function(){
		$('.form-control').each(function(){
			if($(this).val() != ""){
				inputCheck = true;
			}else{
				inputCheck = false;
			}
		});
		submitActivator();
	});

	$.datetimepicker.setLocale('pt');
	$(".birthDate").datetimepicker({
		timepicker:false,
 		format:'Y-m-d',
 		maxDate:'+1970/01/01'//today is maximum date calendar
	});
	$(".country").countrySelect({
		"preferredCountries": ["pt"],
	}).on('change', function(){
		if($(this).val() == 'Portugal'){
			$('.countyDistrit-FormGroup').show();
		}else{
			$('.countyDistrit-FormGroup').hide();
		}
	});


	showCon($(".dist"));

	$(".dist").on("change", function(){
		console.log("ola")
		showCon($(this));
	});
});

var passCheck = false, inputCheck = false, recaptchaCheck = false;

var recaptchaCallback = function(){
	recaptchaCheck = true;
	submitActivator();
}

var submitActivator = function(){
	if (inputCheck && passCheck && recaptchaCheck){
		$("#regInModal").prop('disabled', false);
	}else{
		$("#regInModal").prop('disabled', true);
	}
}
var showCon = function(obg){
	var distVal = $(obg).val();
	var i=0;
	$(".con > option").each(function(){
		if($(this).attr("data-parentDist")==distVal){
			$(this).show();
			if (i==0){
				$(".con").val($(this).val());
			}
			i++;
		}else{
			$(this).hide();
		}
	});
}

var userLogIn = function(){
	var form = $('#loginForm');
	var options = { 
		success: showResponse_LogiInUser
	};
	form.ajaxSubmit(options);

    return false;
}

var showResponse_LogiInUser = function(responseText, statusText, xhr, $form){
	$('.alert').hide();
	var response = JSON.parse(responseText);
	if(response.success === true) {
		location.reload();
    }else{
    	$('#regInModal').prop('disabled', false).val="Registar";
        $(".alert-danger > .message").html(response.messages);
        $(".alert-danger").show();
        setTimeout(function(){
        	$(".alert-danger").hide();
        }, 3000);
    }
}

var userReg = function(){
	$('#regInModal').prop('disabled', true).val="A carregar...";
	var form = $('#regForm');
	var options = { 
		success: showResponse_RegUser
	};
	form.ajaxSubmit(options);

    return false;
}

var showResponse_RegUser = function(responseText, statusText, xhr, $form){
	$('.alert').hide();
	console.log(responseText);
	var response = JSON.parse(responseText);
	if(response.success === true) {
		$("#regFormBody, #regFormButtons").hide();
        $("#alertSuccess > .message").html(response.messages);
        if (response.messages.indexOf("Email n&atilde;o enviado") > -1) {
        	$("#alertSuccess").addClass(" alert-warning").removeClass("alert-success");
        }else{
        	$("#alertSuccess").addClass(" alert-success").removeClass("alert-warning");
        };
        $(".alert-success").show();
    }else{
    	$('#regInModal').prop('disabled', false).val="Registar";
        $(".alert-danger > .message").html(response.messages);
        $(".alert-danger").show();
        setTimeout(function(){
        	$(".alert-danger").hide();
        }, 3000);
    }
}