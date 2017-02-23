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

	showCon($("#dist"));

	$("#dist").on("change", function(){
		showCon($(this));
	});
});

var showCon = function(obg){
	var distVal = $(obg).val();
	var i=0;
	$("#con > option").each(function(){
		if($(this).attr("data-parentDist")==distVal){
			$(this).show();
			if (i==0){
				$("#con").val($(this).val());
			}
			i++;
		}else{
			$(this).hide();
		}
	});
}