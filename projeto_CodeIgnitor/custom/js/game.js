$(window).on('load', function(){
    $('#gameBody button, #gameBody input').prop('disabled', true);
    loadGameInfo();
	setInterval( function () {
        loadGameInfo();
	}, 1000 );
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

    // margin table left
    gameCssChanges();
    $(window).on('resize', function() {
        gameCssChanges();
    });
});
var cleanAlert, firstTimeRun = true, counter = 0, jogador_timer = true, gameTimer;
var cards_table = {"AC":[-5, 5],"KC":[-1905, 5],"QC":[-1745, 5],"JC":[-1590, 5], "10C":[-1430, 5],"9C":[-1270, 5],"8C":[-1115, 5],"7C":[-955, 5],"6C":[-795, 5],
                   "5C":[-640, 5],"4C":[-480, 5],"3C":[-325, 5],"2C":[-165, 5],"AS":[-5, -195],"KS":[-1905, -195],"QS":[-1745, -195],"JS":[-1590, -195],
                   "10S":[-1430, -195],"9S":[-1270, -195],"8S":[-1115, -195],"7S":[-955, -195],"6S":[-795, -195],"5S":[-640, -195],"4S":[-480, -195],"3S":[-325, -195],
                   "2S":[-165, -195],"AH":[-10, -395],"KH":[-1905, -395],"QH":[-1745, -395],"JH":[-1590, -395], "10H":[-1430, -395],"9H":[-1270, -395],
                   "8H":[-1115, -395],"7H":[-955, -395],"6H":[-795, -395],"5H":[-640, -395],"4H":[-480, -395],"3H":[-325, -395],"2H":[-165, -395],"AD":[-10, -595],
                   "KD":[-1905, -595],"QD":[-1745, -595],"JD":[-1590, -595],"10D":[-1430, -595],"9D":[-1270, -595],"8D":[-1115, -595],"7D":[-955, -595],"6D":[-795, -595],
                   "5D":[-640, -595],"4D":[-480, -595],"3D":[-325, -595],"2D":[-165, -595]}

// var cardsIdConv = function(card){
//     card = card.split(" ");
//     return card[0]

// }

var gameCssChanges = function (){
    var h, w;
    var tableTop = $('#tableTop');
    h = tableTop.height();
    w = tableTop.width();
    $('#GameTableConts').css('height', h);
    tableTop.css('margin-left', '-'+String(w/2)+'px');
    $('#gamePlayers').css({
        'margin-left': '-'+String(w/2)+'px',
        'height':h
    });

    var tableCardsCont = $('#table-cards-cont');
    h = tableCardsCont.height();
    w = tableCardsCont.width();
    tableCardsCont.css({
        'margin-top' : '-'+String(h/2)+'px',
        'margin-left': '-'+String(w/2)+'px'
    });

    var gameValuesStats = $('#gameValuesStats');
    w = gameValuesStats.width();
    gameValuesStats.css('margin-left', '-'+String(w/2)+'px');
}
var showCards = function(cards, object){
    var i =0;
    while(cards != null && i < cards.length){
        $(object+'-card0'+String(i+1)).css({
            'left': cards_table[cards[i]][0]+'px',
            'top': cards_table[cards[i]][1]+'px',
            'display': 'inline'
        });
        i++;
    }
}
var loadPlayers = function(players){
    for (var p in players){
        var idPlayer = parseInt(p) + 1;
        $('#player-'+String(idPlayer)+' > .playerUsername').html(players[p][0]);
        $('#player-'+String(idPlayer)+' > .playerAvatar').html(players[p][1]);
    }
}
var gameControl = function(nowUsername, cardsOnTable, round)
{
    if (round < '4'){
        //isto e o flop
    	if(nowUsername == myUsername){
            $('#gameBody button, #gameBody input').prop('disabled', false);
            cheksTimeOut();
            // ativa escuta de botoes
    	}else{
            $('#gameBody button, #gameBody input').prop('disabled', true);
    	}
    }else{
        $('#gameBody button, #gameBody input').prop('disabled', true);
        clearInterval(gameTimer);

        var data  = {game_id: gameId};
        $.ajax({
            url:  baseURL + "index.php/game/getGameWinners",
            type: "post",
            data: data,
            dataType: 'json',
            success:function(response) {
                if(response.success === true){
                    var winners = "";
                    for(UW in response.messages){
                        $('#nowPlayer-Game-label').html('Vencedor - '+ response.messages[UW][1])
                        winners += '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>\
                                    <span>'+response.messages[UW][0]+'</span>';
                    }
                    $('#nowPlayer-Game').html(winners); 
                }else{
                    $('#erroGame-msg').html(response.messages);
                    $('#erroGame').show();
                    cleanAlert = true;
                }
            }
        });
        
    }
    showCards(cardsOnTable, '#table');
}
var cheksTimeOut = function(){
    var data  = {id_jogo: gameId};
    $.ajax({
        url:  baseURL + "index.php/game/checkIfTimeOutActive",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            if(response.success === true){
                if(response.messages == true){
                    $.ajax({
                        url:  baseURL + "index.php/game/checkTimeLeftForTimeOut",
                        type: "post",
                        data: data,
                        dataType: 'json',
                        success:function(response) {
                            if(response.success === true){
                                if(response.messages <= 0 && jogador_timer){
                                    PlayerAction("Desistir", "Desistiu da sua mao" );
                                }
                                else if(response.messages < 10){
                                    $('#erroGame-msg').html("O seu tempo esta a terminar: " + response.messages);
                                    $('#erroGame').show();
                                }
                            }else{
                                $('#erroGame-msg').html(response.messages);
                                $('#erroGame').show();
                                cleanAlert = true;
                            }
                        }
                    });

                }
            }else{
                $('#erroGame-msg').html(response.messages);
                $('#erroGame').show();
            }
        }
    });
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
                if(firstTimeRun){
                    firstTimeRun = false;
                    loadTimer(response.messages[0][0]);
                    // cheksTimeOut();
                }
                $('.actualBet-Game').html(response.messages[0][1]);
                $("#pot-Game").html(response.messages[0][2]);
                showCards($.parseJSON(response.messages[0][3]), '#myCards')

                $("#gameHistory").html(response.messages[0][6]);
                loadPlayers(response.messages[0][7]);
        		$('#nowPlayer-Game').html('<span class="glyphicon glyphicon-user" aria-hidden="true"></span>\
                                           <span>'+response.messages[0][9]+'</span>');
        		$("#userPoints").html(response.messages[0][10]);

        		gameControl(response.messages[0][9], response.messages[0][8], response.messages[0][5]);
                $('.hideBeforeGame').show();
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
                jogador_timer = false;
            }else{
                $('#erroGame-msg').html("Ação não permitida");
                $('#erroGame').show();
            }
        }
    })
}

var loadTimer = function(counter)
{
    $(".TimerCounter").html(convertTime(counter));
    gameTimer = setInterval(function(){
        $(".TimerCounter").html(convertTime(counter));
        counter++;
    }, 1000);
}

var convertTime = function(segundos)
{
    var dias = 0, horas = 0, minutos = 0;
    while(segundos > 59){
        minutos++;
        segundos-=60;
        if(minutos > 59){
            horas++;
            minutos-=60;
            if(horas > 23){
                dias++;
                horas-=24;
            }
        }
    }
    if(dias < 10){
        dias = "0" + dias.toString();
    }
    if(horas < 10){
        horas = "0" + horas.toString();
    }
    if(minutos<10){
        minutos = "0" + minutos.toString();
    }
    if(segundos<10){
        segundos = "0" + segundos.toString();
    }
    if (dias > 0){
        return dias.toString() + " dias " + horas.toString() + ":" + minutos.toString() + ":" + segundos.toString();
    }
    else{
        return horas.toString() + ":" + minutos.toString() + ":" + segundos.toString();
    }
}
