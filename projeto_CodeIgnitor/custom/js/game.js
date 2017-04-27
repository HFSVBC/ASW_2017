$(window).on('load', function(){
    $('#gameBody button, #gameBody input').prop('disabled', true);
	setInterval( function () {
    	loadGameInfo();
	}, 500 );
	// loadGameInfo();
	$('#desistir').on('click', function(){
        $('.alert').hide();
    	PlayerAction("Desistir", "Desistiu da sua mao" );
    });
    $('#cobrir_aposta').on('click', function(){
        $('.alert').hide();
        PlayerAction("Cobrir", "Cobriu a aposta");
    });
    $('#aumentSend').on('click', function(){
        $('.alert').hide();
        PlayerAction("Aumenta", "Aumentou a aposta");
    });
    $('#allIn').on('click', function(){
        $('.alert').hide();
        PlayerAction("AllIn", "Apostou tudo");
    });
});
var cleanAlert;
var gameControl = function(nowUsername, cardsOnTable, round, allIn)
{
	cardsOnTable = $.parseJSON(cardsOnTable);
    //isto e o flop
	if(nowUsername == myUsername){
        $('#gameBody button, #gameBody input').prop('disabled', false);
        // ativa escuta de botoes
        if (allIn){
            $('#gameBody button, #gameBody input').prop('disabled', true);
            if ($('#userPoints').html() != 0){
                $("#allIn, #desistir").prop('disabled', false);
            }
        }
	}else{
        $('#gameBody button, #gameBody input').prop('disabled', true);
	}
	switch(round){
    	case '1':
    		$('#boardCards-Game').html(cardsOnTable[0] +' , ' +cardsOnTable[1]+' , ' +cardsOnTable[2] );
    		break;
    	case '2':
    		$('#boardCards-Game').html(cardsOnTable[0] +' , ' +cardsOnTable[1]+' , ' +cardsOnTable[2]+' , ' +cardsOnTable[3] );
    		break;
    	case '3':
    		$('#boardCards-Game').html(cardsOnTable[0] +' , ' +cardsOnTable[1]+' , ' +cardsOnTable[2]+' , ' +cardsOnTable[3]+' , ' +cardsOnTable[4] );
    		break;
        case '4':
            $('#boardCards-Game').html(cardsOnTable[0] +' , ' +cardsOnTable[1]+' , ' +cardsOnTable[2]+' , ' +cardsOnTable[3]+' , ' +cardsOnTable[4] );
            $('#gameBody button, #gameBody input').prop('disabled', true);
            $('#nowPlayer-Game').html('Terminou');
            break;
    }
}
var loadGameInfo = function()
{
    if (cleanAlert){
        $('.alert').hide();
    }
	var data  = {id_jogo: gameId};
    $.ajax({
        url:  baseURL + "index.php/game/getGameInfo",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
        	if (response.success === true){
        		$('#start-Game').html(response.messages[0][0]);
        		$('#nowPlayer-Game').html(response.messages[0][1]);
        		$('#myCars-Game').html(response.messages[0][3]);
                console.log(response.messages[0][3]);
        		$('.actualBet-Game').html(response.messages[0][4]);
        		$("#userPoints").html(response.messages[0][5]);
        		$("#gameHistory").html(response.messages[0][7]);
                var allIn = false;
                if (response.messages[0][7].indexOf("AllIn") > -1){
                    allIn = true;
                }
        		$("#pot-Game").html(response.messages[0][8]);
        		$("#players-Game").html(response.messages[0][9]);
        		gameControl(response.messages[0][1], response.messages[0][2], response.messages[0][6], allIn);
        	}else{
        		if(response.messages = "Em Espera"){
                    cleanAlert = true;
        			$('#warningGame-msg').html("Em Espera, sem utilizadores suficientes.");
        			$('#warningGame').show();
        		}else{
        			$('#erroGame-msg').html(response.messages);
        			$('#erroGame').show();
        		}
        	}
        }
    });
}


var PlayerAction = function(action, msg)
{
    if(action=="AllIn"){
        var raise = $('#userPoints').html();
    }else{
        var raise = $('#aumentValue').val();
    }
	
    //qual o jogador
    //atualizar o proximo jogador
    //mudar o player_folded para true
    var data = {id_jogo: gameId, raiseAmount: raise};
    $.ajax({
        url: baseURL + "index.php/game/playerAction/" + action,
        type: "post",
        data: data,
        dataType: 'json',
        success: function(response) {
            if(response.success === true){
                $('#warningGame-msg').html(msg);
                $('#warningGame').show();
            }else{
                $('#erroGame-msg').html("Ação não permitida");
                $('#erroGame').show();

            }
        }
    })
}