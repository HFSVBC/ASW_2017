"use strict";
$(window).on('load', function(){
    $('#InputBegin').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:$('#InputBeginTill').val()?$('#InputBeginTill').val():'+1970/01/01'
            })
        },
        timepicker:false
    }).keydown(function(e) {
        if(e.keyCode !== 8 && e.keyCode !== 46) {
            e.preventDefault();
        }
    });
    $('#InputBeginTill').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                minDate:$('#InputBegin').val()?$('#InputBegin').val():false
            })
        },
        timepicker:false,
        maxDate:'+1970/01/01'//today is maximum date calendar
    }).keydown(function(e) {
        if(e.keyCode !== 8 && e.keyCode !== 46) {
            e.preventDefault();
        }
    });
    pesquisa = "NULL/NULL/NULL/NULL/NULL/NULL";
	gamesTable = $('#jogos').DataTable({
    	  "columnDefs": [{
            "orderable": false,
            "targets"  : -1
        }],
        paging: false,
        searching: false,
        "ajax": baseURL + "index.php/game/getGames/"+pesquisa,
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

    // advance search user
    $('.adv_search_fields').on('click, change', function(){
        adv_Search();
    });
});


var gamesTable, pesquisa;

var adv_Search = function(table, pesquisa){
    var begin_op = $('#InputBegin').val();
    if (begin_op == ""){
        begin_op = "NULL";
    }
    var begin2_op = $('#InputBeginTill').val();
    if (begin2_op == ""){
        begin2_op = "NULL";
    }
    var numPlayers_op = $('#numPlayers').val();
    if (numPlayers_op == ""){
        numPlayers_op = "NULL";
    }
    var numPlayers2_op = $('#numPlayersTill').val();
    if (numPlayers2_op == ""){
        numPlayers2_op = "NULL";
    }
    var bet_op = $('#InputBet').val();
    if (bet_op == ""){
        bet_op = "NULL";
    }
    var bet2_op = $('#InputBetTill').val();
    if (bet2_op == ""){
        bet2_op = "NULL";
    }
    var creator_op     = $('#creator').val();

    pesquisa = numPlayers_op + "/" + numPlayers2_op + "/" + bet_op + "/" + bet2_op + "/" + begin_op + "/" + begin2_op;
    console.log(pesquisa)
    gamesTable.ajax.url(baseURL + "index.php/game/getGames/" + pesquisa).load();

    return false;
}

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
