<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="custom/css/game.css">
<div id="main">
	<div id="cont-Body">
		<div id="gameBody">

			<table id="table_game" class="table">
			    <tbody>
			      	<tr id="InitialTime">
			        	<td><b>Início</b></td>
			      	</tr>
			      	<tr id="ActualPlayer">
			        	<td><b>Jogador atual</b></td>
			      	</tr>
			      	<tr id="BoardCards">
			        	<td><b>Cartas da mesa</b></td>
			      	</tr>
					<tr id="MyCards">
						<td><b>Minhas cartas</b></td>
					</tr>
					<tr id="ActualBet">
						<td><b>Aposta atual</b></td>
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
