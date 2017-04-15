"use strict";
$(window).on('load', function(){

	gamesTable = $('#jogos').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
        "ajax": baseURL + "index.php/game/getGames",
	});
    setInterval( function () {
        gamesTable.ajax.reload();
    }, 5000 );

});


var gamesTable;


var teste = function(){
  //criar condiçao para entrar
  window.location.href = baseURL + "index.php/userpages/view/game";
}

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
        gamesTable.ajax.reload();
    }else{
        $(".alert-danger > .message").html(response.messages);
        $(".alert-danger").show();
    }
    setTimeout(function(){
       	$(".alert").hide();
    }, 7000);
}
