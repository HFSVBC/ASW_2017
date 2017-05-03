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
var cards_table = {"As de paus":[-10, 0],"Rei de paus":[-2560, 0],"Dama de paus":[-2345, 0],"Valete de paus":[-2130, 0], "10 de paus":[-1920, 0],"9 de paus":[-1705, 0],"8 de paus":[-1495, 0],"7 de paus":[-1285, 0],"6 de paus":[-1070, 0],
                   "5 de paus":[-860, 0],"4 de paus":[-645, 0],"3 de paus":[-435, 0],"2 de paus":[-225, 0],"As de copas":[-10, -265],"Rei de copas":[-2560, -265],"Dama de copas":[-2345, -265],"Valete de copas":[-2130, -265], 
                   "10 de copas":[-1920, -265],"9 de copas":[-1705, -265],"8 de copas":[-1495, -265],"7 de copas":[-1285, -265],"6 de copas":[-1070, -265],"5 de copas":[-860, -265],"4 de copas":[-645, -265],"3 de copas":[-435, -265],
                   "2 de copas":[-225, -265],"As de espadas":[-10, -535],"Rei de espadas":[-2560, -535],"Dama de espadas":[-2345, -535],"Valete de espadas":[-2130, -535], "10 de espadas":[-1920, -535],"9 de espadas":[-1705, -535],
                   "8 de espadas":[-1495, -535],"7 de espadas":[-1285, -535],"6 de espadas":[-1070, -535],"5 de espadas":[-860, -535],"4 de espadas":[-645, -535],"3 de espadas":[-435, -535],"2 de espadas":[-225, -535],"As de ouros":[-10, -800],
                   "Rei de ouros":[-2560, -800],"Dama de ouros":[-2345, -800],"Valete de ouros":[-2130, -800],"10 de ouros":[-1920, -800],"9 de ouros":[-1705, -800],"8 de ouros":[-1495, -800],"7 de ouros":[-1285, -800],"6 de ouros":[-1070, -800],
                   "5 de ouros":[-860, -800],"4 de ouros":[-645, -800],"3 de ouros":[-435, -800],"2 de ouros":[-225, -800]}

var showCards = function(cards){
    for(var i=0; i < cards.length; i++){
        $('#table-card0'+String(i+1)).css({
            'left': cards_table[cards[i]][0]+'px',
            'top': cards_table[cards[i]][1]+'px',
            'display': 'inline'
        });
    }
}
var gameControl = function(nowUsername, cardsOnTable, round)
{
    //isto e o flop
	if(nowUsername == myUsername){
        $('#gameBody button, #gameBody input').prop('disabled', false);
        // ativa escuta de botoes
	}else{
        $('#gameBody button, #gameBody input').prop('disabled', true);
	}
    showCards(cardsOnTable);
    if (round == '4'){
        $('#gameBody button, #gameBody input').prop('disabled', true);
        $('#nowPlayer-Game').html('Terminou');
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
            if (cleanAlert){$('.alert').hide();}
        	if (response.success === true){
                // console.log(response.messages)
        		$('#start-Game').html(response.messages[0][0]);
                $('.actualBet-Game').html(response.messages[0][1]);
                $("#pot-Game").html(response.messages[0][2]);
                if(response.messages[0][4] == '1'){
                    $('#myCars-Game').html("Desistiu");
                }else{
                    $('#myCars-Game').html(response.messages[0][3]);
                }

                $("#gameHistory").html(response.messages[0][6]);
                $("#players-Game").html(response.messages[0][7]);
        		$('#nowPlayer-Game').html(response.messages[0][9]);
        		$("#userPoints").html(response.messages[0][10]);
        		
        		gameControl(response.messages[0][9], response.messages[0][8], response.messages[0][5]);
        	}else{
        		if(response.messages[0] == "Em Espera"){
                    cleanAlert = true;
        			$('#warningGame-msg').html("Em Espera, sem utilizadores suficientes.");
                    $("#players-Game").html(response.messages[1]);
                    $("#userPoints").html(response.messages[2]);
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