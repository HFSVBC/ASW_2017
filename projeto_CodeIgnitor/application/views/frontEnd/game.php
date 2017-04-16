<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="custom/css/game.css">
<div id="main">
	<div id="cont-Body">
		<div id="gameBody">
			<div class="alert alert-warning" id="warningGame" role="alert"></div>
			<div class="alert alert-danger" id="erroGame" role="alert"></div>
			<table id="table_game" class="table">
			    <tbody>
			      	<tr id="InitialTime">
			        	<td><b>Início</b><span id="start-Game"></span></td>
			      	</tr>
			      	<tr id="ActualPlayer">
			        	<td><b>Jogador atual</b><span id="nowPlayer-Game"></span></td>
			      	</tr>
			      	<tr id="BoardCards">
			        	<td><b>Cartas da mesa</b><span id="boardCards-Game"></span></td>
			      	</tr>
					<tr id="MyCards">
						<td><b>Minhas cartas</b><span id="myCars-Game"></span></td>
					</tr>
					<tr id="ActualBet">
						<td><b>Aposta atual</b><span id="actualBet-Game"></span></td>
					</tr>
					<tr>
						<td id="PlayersBet"><b>Aposta de cada jogador</b></td>
					</tr>
			    </tbody>
	  		</table>
	  	</div>
	</div>
	<div class="footer">
		<div class="side-bar">

			<div id="messa-game">
				<p class="turn-play" >É a sua vez de jogar</p>
				<p class="mesa-creditos" >créditos disponiveis</p>
			</div>
			<div id="botoes_game" class="btn-group-vertical" role="group" aria-label="...">
				<button type="button" id="desistir" class="btn">Desistir</button>
				<button type="button" id="cobrir_aposta" class="btn">Cobrir a aposta(10 créditos)</button>
				<p id="aument">Aumentar para</p><input id="aument1" type="text"><button id="aument2" type="button" class="btn">Enviar</button>
			</div>

			<button class="btn btn-primary" id="chat" type="button">
				Chat <span class="badge">4</span>
			</button>
		</div>
	</div>
</div>
<!-- CUSTOM JS -->
<script type="text/javascript">
	var gameId = "<?php echo $_GET['id']; ?>";
</script>
<script type="text/javascript" src="custom/js/game.js"></script>