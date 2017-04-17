$(window).on('load', function(){
    $('#gameBody button, #gameBody input').prop('disabled', true);
	setInterval( function () {
    	loadGameInfo();
	}, 5000 );
	// loadGameInfo();
	$('body').on('click', '#desistir', function(){
        giveUp();
    });
});
var card = 0;
var gameControl = function(nowUsername, cardsOnTable)
{
	cardsOnTable = $.parseJSON(cardsOnTable);
    //isto e o flop
    $('#boardCards-Game').html(cardsOnTable[card] +' , ' +cardsOnTable[card+1]+' , ' +cardsOnTable[card+2] );
	if(nowUsername == myUsername){
        $('#gameBody button, #gameBody input').prop('disabled', false);
        
	}else{
        $('#gameBody button, #gameBody input').prop('disabled', true);
	}
}
var loadGameInfo = function()
{
	var data = {id_jogo: gameId};
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
        		$('#actualBet-Game').html(response.messages[0][4]);
        		gameControl(response.messages[0][1], response.messages[0][2]);
        		// $('#start-Game').html();
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


var giveUp = function()
{
    //qual o jogador
    //atualizar o proximo jogador
    //mudar o player_folded para true
    var data = {id_jogo: gameId};
    $.ajax({
        url: baseURL + "index.php/game/playerAction/Desistir",
        type: "post",
        data: data,
        dataType: 'json',
        success: function(response) {
            if(response.success === true){
                $('#warningGame-msg').html("Desistiu");
                $('#warningGame').show();
            }else{
                $('#erroGame-msg').html(response.messages);
                $('#erroGame').show();

            }
        }
    })
}