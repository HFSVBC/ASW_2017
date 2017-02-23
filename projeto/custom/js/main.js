"use strict"
$(window).on('load', function(){
	$('#log-btn').on('click', function(){
		$('#loginModal').modal('show');
	});
	$('#reg-btn').on('click', function(){
		$('#regModal').modal('show');
		
	});
	$.datetimepicker.setLocale('pt');
	$("#birthDate").datetimepicker({
		timepicker:false,
 		format:'d/m/Y',
 		maxDate:'+1970/01/01'//today is maximum date calendar
	});
	$("#country").countrySelect({
		"preferredCountries": ["pt"],
	});
});