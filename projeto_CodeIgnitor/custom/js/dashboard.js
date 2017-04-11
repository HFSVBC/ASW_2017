"use strict"
$(window).on('load', function(){
	$('#jogos').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }]
	});
});

var createGame = function(){
	var form = $('#createGame-Form');
	var options = { 
		success: showResponse_createGame
	};
	form.ajaxSubmit(options);
    return false;
}

var showResponse_createGame = function(responseText, statusText, xhr, $form){
	$('.alert').hide();
	console.log(responseText)
	var response = JSON.parse(responseText);
	if(response.success === true) {
        $("#alertSuccess > .message").html(response.messages);
        $(".alert-success").show();
    }else{
        $(".alert-danger > .message").html(response.messages);
        $(".alert-danger").show();
    }
    setTimeout(function(){
       	$(".alert").hide();
    }, 7000);
}
