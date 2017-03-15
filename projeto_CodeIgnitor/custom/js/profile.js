"use strict"
$(window).on('load', function(){
	$("#prof-sexo").val(userSex);
	$("#prof-district").val(userDistrict);
	$("#prof-county").val(userCounty);
    if(avatar != "NULL"){
        $('#prof-avatar-prev').attr('src', baseURL+"custom/images/users/profilePics/"+avatar);
    }

	$("#prof-avatar").on('change', function() {
		previewAvatar(this);
	});

    // Locks the form submition
    activateSubmitionPassword();

    // checks if user inserted the correct password
    $("#passNow").on('change', function() {
        cheksPassword($(this));
    });

    // cheks if passwords match
    $("#passNewRepeat, #passNew").on("change focus input", function() {
        var confPass = $("#passNewRepeat");
        var pass     = $("#passNew");
        
        if(confPass.val() != pass.val() || confPass.val() == "" || pass.val() == "" ){
            $(".passwordFG").addClass(" has-error");
            passEquals_Change = false;
        }else{
            $(".passwordFG").removeClass(" has-error");
            passEquals_Change = true;
        }
        activateSubmitionPassword();
    });
});

var passOld_Change = false, passEquals_Change = false;

var activateSubmitionPassword = function (){
    if(passOld_Change && passEquals_Change){
        $('#submitNewPassword').prop('disabled', false);
    }else{
        $('#submitNewPassword').prop('disabled', true);
    }
}

function previewAvatar(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#prof-avatar-prev').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

var cheksPassword = function(id){
    var data = {password: id.val()};
    $.ajax({
        url:  baseURL+"index.php/user/checkOldPassword",
        type: "post",
        data: data, 
        dataType: 'json',
        success:function(response) {
            var passwordGroup = $(".oldPasswordChange-group");
            if(response.success === true) {
                if(response.exists == false){
                    passwordGroup.parent().addClass(" has-error");
                    passwordGroup.parent().append("<span class='help-block' id='oldPasswordErrorMessage'>Password incorreta</span>");
                    passOld_Change = false;
                }else{
                    passwordGroup.parent().removeClass(" has-error");
                    $('#oldPasswordErrorMessage').remove();
                    passOld_Change = true;
                }               
            }else{
                console.log(response.exists);
                passOld_Change = false;
            }
            activateSubmitionPassword();
        }
    });
}

var userUpdate = function(){
	$(".alert").hide();
	var form = $('#updateProfile-Form');
	$('#submitUpdateForm').val("A Guardar...").prop('disabled', true);
	var options = { 
		success: showResponseUpdate
	};
	form.ajaxSubmit(options);

    return false;
}

var showResponseUpdate = function(responseText, statusText, xhr, $form){
    $(".alert").hide();
    console.log(responseText)
	var response = JSON.parse(responseText);
	if(response.success === true) {
        $("#alertSuccess-prof > .message").html(response.messages);
        $("#alertSuccess-prof").show();
        $('#submitUpdateForm').val("Guardar").prop('disabled', false);
        setTimeout(function(){
        	$(".alert-success").hide();
        }, 8000);
    }else{
        $("#alertError-prof > .message").html(response.messages);
        $("#alertError-prof").show();
        $('#submitUpdateForm').val("Guardar").prop('disabled', false);
        setTimeout(function(){
        	$(".alert-danger").hide();
        }, 8000);
    }
}

var changeUserPass = function(){
    $(".alert").hide();
    var form = $('#changeUserPass-Form');
    $('#submitNewPassword').val("A Guardar...").prop('disabled', true);
    var options = { 
        success: showResponseUpdatePass
    };
    form.ajaxSubmit(options);

    return false;
}

var showResponseUpdatePass = function(responseText, statusText, xhr, $form){
    $(".alert").hide();
    var response = JSON.parse(responseText);
    if(response.success === true) {
        $("#alertSuccess-profPass > .message").html(response.messages);
        $("#alertSuccess-profPass").show();
        $('#submitNewPassword').val("Guardar").prop('disabled', false);
        setTimeout(function(){
            $(".alert-success").hide();
        }, 8000);
    }else{
        $("#alertError-profPass > .message").html(response.messages);
        $("#alertError-profPass").show();
        $('#submitNewPassword').val("Guardar").prop('disabled', false);
        setTimeout(function(){
            $(".alert-danger").hide();
        }, 8000);
    }
}