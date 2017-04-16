$(window).on('load', function(){
    $('#gameBody button, #gameBody input').prop('disabled', true);
	setInterval( function () {
    	loadGameInfo();
	}, 1000 );
	// loadGameInfo();
	
});
var card = 0;
var gameControl = function(nowUsername, cardsOnTable)
{
	cardsOnTable = $.parseJSON(cardsOnTable);
    $('#boardCards-Game').html(cardsOnTable[card]);
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

var baralho_cartas = ['As de paus','Rei de paus','Dama de paus','Valete de paus', '10 de paus','9 de paus','8 de paus','7 de paus','6 de paus',
'5 de paus','4 de paus','3 de paus','2 de paus','As de copas','Rei de copas','Dama de copas','Valete de copas', '10 de copas','9 de copas',
'8 de copas','7 de copas','6 de copas','5 de copas','4 de copas','3 de copas','2 de copas','As de espadas','Rei de espadas','Dama de espadas',
'Valete de espadas', '10 de espadas','9 de espadas','8 de espadas','7 de espadas','6 de espadas','5 de espadas','4 de espadas','3 de espadas',
'2 de espadas','As de ouros','Rei de ouros','Dama de ouros','Valete de ouros', '10 de ouros','9 de ouros','8 de ouros','7 de ouros','6 de ouros',
'5 de ouros','4 de ouros','3 de ouros','2 de ouros']

// var dar_cartas_inicio = function(){



// }