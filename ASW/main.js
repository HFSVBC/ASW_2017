$(window).on("load", function(){
	$("#log-btn").on('click', function(){
	$('#login').modal('show');
	} );

	$(".btn-primary-log").on('click', function() {
		$('#login').modal('hide');
	})

	$("#reg-btn").on('click', function(){
		$('#regin').modal('show');
	});

	$(".btn-primary-reg").on('click', function(){
		$('#regin').modal('hide');
	})

	$(function () {
        $('#datetimepicker4').datetimepicker();
    });



	$('.carousel').carousel('cycle');



})