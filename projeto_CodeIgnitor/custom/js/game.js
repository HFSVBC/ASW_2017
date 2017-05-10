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
var cleanAlert, firstTimeRun = true, counter = 0;
var cards_table = {"As de paus":[-5, 5],"Rei de paus":[-1905, 5],"Dama de paus":[-1745, 5],"Valete de paus":[-1590, 5], "10 de paus":[-1430, 5],"9 de paus":[-1270, 5],"8 de paus":[-1115, 5],"7 de paus":[-955, 5],"6 de paus":[-795, 5],
                   "5 de paus":[-640, 5],"4 de paus":[-480, 5],"3 de paus":[-325, 5],"2 de paus":[-165, 5],"As de copas":[-5, -195],"Rei de copas":[-1905, -195],"Dama de copas":[-1745, -195],"Valete de copas":[-1590, -195],
                   "10 de copas":[-1430, -195],"9 de copas":[-1270, -195],"8 de copas":[-1115, -195],"7 de copas":[-955, -195],"6 de copas":[-795, -195],"5 de copas":[-640, -195],"4 de copas":[-480, -195],"3 de copas":[-325, -195],
                   "2 de copas":[-165, -195],"As de espadas":[-10, -395],"Rei de espadas":[-1905, -395],"Dama de espadas":[-1745, -395],"Valete de espadas":[-1590, -395], "10 de espadas":[-1430, -395],"9 de espadas":[-1270, -395],
                   "8 de espadas":[-1115, -395],"7 de espadas":[-955, -395],"6 de espadas":[-795, -395],"5 de espadas":[-640, -395],"4 de espadas":[-480, -395],"3 de espadas":[-325, -395],"2 de espadas":[-165, -395],"As de ouros":[-10, -595],
                   "Rei de ouros":[-1905, -595],"Dama de ouros":[-1745, -595],"Valete de ouros":[-1590, -595],"10 de ouros":[-1430, -595],"9 de ouros":[-1270, -595],"8 de ouros":[-1115, -595],"7 de ouros":[-955, -595],"6 de ouros":[-795, -595],
                   "5 de ouros":[-640, -595],"4 de ouros":[-480, -595],"3 de ouros":[-325, -595],"2 de ouros":[-165, -595]}

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
    //isto e o flop
	if(nowUsername == myUsername){
        if (round == '4'){
            $('#gameBody button, #gameBody input').prop('disabled', true);
            $('#nowPlayer-Game').html('Terminou');
        }else{
            $('#gameBody button, #gameBody input').prop('disabled', false);
            cheksTimeOut();
        }
        // ativa escuta de botoes
	}else{
        $('#gameBody button, #gameBody input').prop('disabled', true);
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
                    setInterval(function(){
                        $.ajax({
                            url:  baseURL + "index.php/game/checkTimeLeftForTimeOut",
                            type: "post",
                            data: data,
                            dataType: 'json',
                            success:function(response) {
                                if(response.success === true){
                                    if(response.messages < 0){
                                        PlayerAction("Desistir", "Desistiu da sua mao" );
                                    }
                                    else if(response.messages < 10){
                                        $('#erroGame-msg').html("O seu tempo esta a terminar");
                                        $('#erroGame').show();
                                    }
                                }else{
                                    $('#erroGame-msg').html(response.messages);
                                    $('#erroGame').show();
                                }
                            }
                        });}, 1000);
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
                    cheksTimeOut();
                }
                // console.log(response.messages)
                $('.actualBet-Game').html(response.messages[0][1]);
                $("#pot-Game").html(response.messages[0][2]);
                showCards($.parseJSON(response.messages[0][3]), '#myCards')

                $("#gameHistory").html(response.messages[0][6]);
                loadPlayers(response.messages[0][7]);
        		$('#nowPlayer-Game').html(response.messages[0][9]);
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
            }else{
                $('#erroGame-msg').html("Ação não permitida");
                $('#erroGame').show();

            }
        }
    })
}

var loadTimer = function(counter)
{
    setInterval(function(){
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
