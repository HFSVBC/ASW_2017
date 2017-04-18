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
        joinGame(id, 'CLI');
    });
    $('body').on('click','.gameStart',function(){
        var id = $('.gameJoin-BTN').attr('data-gameId');
        joinGame(id, 'DON');
    })
});


var gamesTable;


var joinGame = function(id, per){
    //criar condiçao para entrar
    var data = {id_jogo: id, permission: per};
    $.ajax({
        url:  baseURL + "index.php/game/createGameP",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            console.log(response)
            if(response.success === true) {
                if(response.messages === 'Dono'){
                    OwnerPopUp();
                }
                //window.location.href = baseURL + "game?id="+id;
            } else{
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
    }else{
        $(".alert-danger > .message").html(response.messages);
        $(".alert-danger").show();
    }
    setTimeout(function(){
       	$(".alert").hide();
    }, 7000);
}

var OwnerPopUp = function(){
    console.log("ola, consegui");
    $('.ownermessage').html("<div class='modal fade' tabindex='-1' role='dialog'>\
        <div class='modal-dialog' role='document'>\
            <div class='modal-content'>\
                <div class='modal-header'>\
                    <button type=''button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>\
                    <h4 class='modal-title'>Modal title</h4>\
                </div>\
                <div class='modal-body'>\
                    <p>Deseja iniciar o jogo?</p>\
                </div>\
                <div class='modal-footer'>\
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Nao</button>\
                    <button type='button' class='btn btn-primary gameStart'>Sim</button>\
                </div>\
            </div><!-- /.modal-content -->\
        </div><!-- /.modal-dialog -->\
    </div><!-- /.modal -->");
    $('.ownermessage').show();

}