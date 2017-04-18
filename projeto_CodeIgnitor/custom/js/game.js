$(window).on('load', function(){
    $('#gameBody button, #gameBody input').prop('disabled', true);
	setInterval( function () {
    	loadGameInfo();
	}, 500 );
	// loadGameInfo();
	$('#desistir').on('click', function(){
    	PlayerAction("Desistir", "Desistiu da sua mao" );
    });
    $('#cobrir_aposta').on('click', function(){
        PlayerAction("Cobrir", "Cobriu a aposta");
    });
    $('#All_in').on('click', function(){
        PlayerAction("Allin", "Apostou tudo");
    });
    $('#aumentSend').on('click', function(){
        PlayerAction("Aumenta", "Aumentou a aposta");
    });
});
var gameControl = function(nowUsername, cardsOnTable, round)
{
	cardsOnTable = $.parseJSON(cardsOnTable);
    //isto e o flop
	if(nowUsername == myUsername){
        $('#gameBody button, #gameBody input').prop('disabled', false);
        // ativa escuta de botoes
        
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
    		$('#gameBody button, #gameBody input').prop('disabled', true);
    		break;
    }
}
var loadGameInfo = function()
{
	var data  = {id_jogo: gameId};
    $.ajax({
        url:  baseURL + "index.php/game/getGameInfo",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
        	$('.alert').hide();
        	if (response.success === true){
        		$('#start-Game').html(response.messages[0][0]);
        		$('#nowPlayer-Game').html(response.messages[0][1]);
        		$('#myCars-Game').html(response.messages[0][3]);
        		$('.actualBet-Game').html(response.messages[0][4]);
        		$("#userPoints").html(response.messages[0][5]);
        		$("#gameHistory").html(response.messages[0][7]);
        		$("#pot-Game").html(response.messages[0][8]);
        		$("#players-Game").html(response.messages[0][9]);
        		gameControl(response.messages[0][1], response.messages[0][2], response.messages[0][6]);
        	}else{
        		if(response.messages = "Em Espera"){
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
	var raise = $('#aumentValue').val();
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
                $('#warningGame-msg').html(response.messages);
                $('#warningGame').show();
            }else{
                $('#erroGame-msg').html(response.messages);
                $('#erroGame').show();

            }
        }
    })
}