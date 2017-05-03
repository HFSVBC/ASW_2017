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

    $('body').on('click', '.gameJoin-BTN', function(){
        var id = $(this).attr('data-gameId');
        joinGame(id);
    });
    $('#TimeOutCheck').on('change', function(){
        if($(this).prop('checked')){
            $('#TimeOut').prop('disabled', false);
        }else{
            $('#TimeOut').prop('disabled', true);
        }
    });
});


var gamesTable;


var joinGame = function(id){
    //criar condiçao para entrar
    var data = {id_jogo: id};
    $.ajax({
        url:  baseURL + "index.php/game/createGameP",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            console.log(response)
            if(response.success === true) {
                window.location.href = baseURL + "game?id="+id;
            }
            else{
                $('#erroGame-msg').html(response.messages);
                $('#erroGame').show();
            }
        }
    });
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
        $('#EditPart').modal('hide');
    }else{
        $(".alert-danger > .message").html(response.messages);
        $(".alert-danger").show();
    }
    setTimeout(function(){
       	$(".alert").hide();
    }, 7000);
}
