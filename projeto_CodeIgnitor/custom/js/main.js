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

var passCheck = false, inputCheck = false;

var submitActivator = function(){
	if (inputCheck && passCheck){
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