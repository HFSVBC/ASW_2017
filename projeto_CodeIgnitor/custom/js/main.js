"use strict"
$(window).on('load', function(){
	// shows forms on request
	$('#log-btn').on('click', function(){
		$('#loginModal').modal('show');
	});
	$('#reg-btn').on('click', function(){
		$('#regModal').modal('show');
		
	});
	
	// cheks if passwords match
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

	// checks if username is already registered
	$('#usernameReg').on('change', function() {
		if ($(this).val() != ""){
			checkUsername($(this));
		}
	});

	// checks if email is already registered
	$('#emailReg').on('change', function() {
		if ($(this).val() != ""){
			cheksEmail($(this));
		}
	});

	// checks if form is complete and activates submition
	submitActivator();	
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

	// initializes datepicker and blocks dates greather than today
	$.datetimepicker.setLocale('pt');
	$(".birthDate").datetimepicker({
		timepicker:false,
 		format:'Y-m-d',
 		maxDate:'+1970/01/01'//today is maximum date calendar
	});

	// Checks if Portugal is selected and activates, or not, 
	// districts and counties options
	$(".countryInput").countrySelect({
		"preferredCountries": ["pt"],
	}).on('change', function(){
		if($(this).val() == 'Portugal'){
			$('.countyDistrit-FormGroup').show();
		}else{
			$('.countyDistrit-FormGroup').hide();
		}
	});

	// Manages districts and counties on registration form
	showCon($(".dist"));
	$(".dist").on("change", function(){
		showCon($(this));
	});
});

var passCheck = false, inputCheck = false, recaptchaCheck = false, emailExistsCheck = false, usernameExistsCheck = false;

var recaptchaCallback = function(){
	recaptchaCheck = true;
	submitActivator();
}

var submitActivator = function(){
	if (inputCheck && passCheck && recaptchaCheck && emailExistsCheck && usernameExistsCheck){
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

var cheksEmail = function(id){
	var data = {email: id.val()};

    $.ajax({
        url:  baseURL+"index.php/user/checkEmail",
        type: "post",
        data: data, 
        dataType: 'json',
        success:function(response) {
            var emailGroup = $(".emailReg-group");
            if(response.success === true) {
            	if(response.exists == true){
            		emailGroup.parent().addClass(" has-error");
            		emailGroup.parent().append("<span class='help-block' id='emailErrorMessage'>Email já registado</span>");
            		emailExistsCheck = false;
            	}else{
            		emailGroup.parent().removeClass(" has-error");
            		$('#emailErrorMessage').remove();
            		emailExistsCheck = true;
            	}               
            }else{
                console.log(response.exists);
                emailExistsCheck = false;
            }
            submitActivator();
        }
    });
}

var checkUsername = function(id){
	var data = {username: id.val()};

    $.ajax({
        url:  baseURL+"index.php/user/checkUsername",
        type: "post",
        data: data, 
        dataType: 'json',
        success:function(response) {
            var usernameGroup = $(".usernameReg-group");
            if(response.success === true) {
            	if(response.exists == true){
            		usernameGroup.parent().addClass(" has-error");
            		usernameGroup.parent().append("<span class='help-block' id='usernameErrorMessage'>Username já registado</span>");
            		usernameExistsCheck = false;
            	}else{
            		usernameGroup.parent().removeClass(" has-error");
            		$('#usernameErrorMessage').remove();
            		usernameExistsCheck = true;
            	}               
            }else{
                console.log(response.exists);
                usernameExistsCheck = false;
            }
            submitActivator();
        }
    });
}

// AJAX for forms submitions
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