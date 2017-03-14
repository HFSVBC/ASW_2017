"use strict"
$(window).on('load', function(){
	$("#prof-sexo").val(userSex);
	// $("#prof-country").countrySelect("selectCountry", userCountry);
	$("#prof-district").val(userDistrict);
	$("#prof-county").val(userCounty);

	$("#prof-avatar").on('change', function() {
		previewAvatar(this);
	});
});

function previewAvatar(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#prof-avatar-prev').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
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
        $("#alertSuccess > .message").html(response.messages);
        $("#alertSuccess").show();
        setTimeout(function(){
        	$(".alert-success").hide();
        }, 8000);
    }else{
        $("#alertError > .message").html(response.messages);
        $("#alertError").show();
        $('#submitUpdateForm').val("Guardar").prop('disabled', false);
        setTimeout(function(){
        	$(".alert-danger").hide();
        }, 8000);
    }
}