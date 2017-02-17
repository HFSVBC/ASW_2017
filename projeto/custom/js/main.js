"use strict"
$(window).on('load', function(){
	$('#log-btn').on('click', function(){
		$('#loginModal').modal('show');
	});
	$('#reg-btn').on('click', function(){
		$('#regModal').modal('show');
		
	});
});