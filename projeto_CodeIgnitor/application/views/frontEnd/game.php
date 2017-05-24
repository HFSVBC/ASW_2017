<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="custom/css/game.css">
<div id="main">
	<div id="cont-Body">
		<div id="gameBody">			
			<div class="row" id="gameMainCont">
				<div class="col-xs-12 col-md-3" id="lateralComands">
					<div id="messa-game">
						<h3 class="mesa-creditos" >Créditos disponiveis: <span id="userPoints"></span></h3>
					</div>
					<div id="botoes_game" class="btn-group-vertical" role="group" aria-label="...">
						<button type="button" id="desistir" class="btn btn-danger">Desistir</button>
						<button type="button" id="cobrir_aposta" class="btn btn-warning">Cobrir a aposta (<span class="actualBet-Game"></span> créditos)</button>
						<button type="button" id="allIn" class="btn btn-danger">All In</button>
					</div>
					<div class="input-group">
						<input id="aumentValue" type="number" class="form-control"  placeholder="Aumentar para">
						<span class="input-group-btn">
							<button id="aumentSend" type="button" class="btn btn-default">Aumentar</button>
      					</span>
					</div>
					<div id="gametimmer" class="hideBeforeGame">
						<h3>Duração do Jogo</h3>
						<h4>
							<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
							<span class="TimerCounter"></span>
						</h4>
					</div>
					<div id="nowPlayer" class="hideBeforeGame">
						<h3 id="nowPlayer-Game-label">Próximo a Jogar:</h3>
						<h4 id="nowPlayer-Game">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							<span id="nowPlayer-Game"></span>
						</h4>
					</div>
					<div id="gameHistory-cont">
						<h4>Histórico de Jogadas</h4>
						<div id="gameHistory"></div>
					</div>
				</div>
				<div class="col-xs-12 col-md-9" id="gameMainArea">
					<div class="container-alerts">
						<div class="alert alert-warning" id="warningGame" role="alert"><strong>Aviso! </strong><span id="warningGame-msg"></span></div>
						<div class="alert alert-danger" id="dangerGame" role="alert"><strong>Perigo! </strong><span id="dangerGame-msg"></span></div>
						<div class="alert alert-danger" id="erroGame" role="alert"><strong>Erro! </strong><span id="erroGame-msg"></span></div>
					</div>
					<div id="GameTableConts">
						<img src="custom/images/gameTable.png" id="tableTop">
						<div id="table-cards-cont">
			        		<div class="cards-table">
			        			<img id="table-card01" src="custom/images/cards.png">
			        		</div>
			        		<div class="cards-table">
			        			<img id="table-card02" src="custom/images/cards.png">
			        		</div>
			        		<div class="cards-table">
			        			<img id="table-card03" src="custom/images/cards.png">
			        		</div>
			        		<div class="cards-table">
			        			<img id="table-card04" src="custom/images/cards.png">
			        		</div>
			        		<div class="cards-table">
			        			<img id="table-card05" src="custom/images/cards.png">
			        		</div>
			        	</div>
			        	<div id="gameValuesStats" class="hideBeforeGame">
			        		<h4>Aposta Atual: <span class="actualBet-Game"></span> créditos</h4>
			        		<h4>Valor do Pote: <span id="pot-Game"></span> créditos</h4>
			        	</div>
					</div>
					<div id="gamePlayers">
						<div class="players" id="player-1">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-2">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-3">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-4">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-5">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-6">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-7">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-8">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-9">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
						<div class="players" id="player-10">
							<div class="playerAvatar"></div>
							<div class="playerUsername"></div>
						</div>
					</div>
					<div id="myCards">
						<div class="myCards-table">
		        			<img id="myCards-card01" src="custom/images/cards.png">
		        		</div>
		        		<div class="myCards-table">
		        			<img id="myCards-card02" src="custom/images/cards.png">
		        		</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CUSTOM JS -->
<script type="text/javascript">
	var gameId     = "<?php echo $_GET['id']; ?>";
	var myUsername = "<?php echo $loggedIn_user; ?>";
</script>
<script type="text/javascript" src="custom/js/game.js"></script>