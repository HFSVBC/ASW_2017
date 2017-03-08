<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="custom/css/home.css">
<div id="maincontainer">
	<div id="contBanner">
		<h1 id="slogan">May the flop be with you</h1>
		<span id="playBTN">Play <span class="glyphicon glyphicon-play" aria-hidden="true"></span></span>
	</div>
	<div id="contGamesBeingPlayed">
		<div class="page-header">
			<h3>Jogos a Decorrer</h3>
		</div>
		<table id="table-GBP" class="table">
			<thead>
				<tr>
					<th>Nome do Jogo</th>
					<th>Número de Utilizadores</th>
					<th>Valor da Aposta</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<div id="contAuthors">
		<div class="page-header">
			<h3>Criado Por</h3>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="row">
					<div class="profPic col-xs-12 col-md-4">
						<img src="custom/images/profPics/catarina.jpeg">
					</div>
					<div class="col-xs-12 col-md-8">
						<h4>Catarina Sousa</h4>
						<p>Aluno da licenciatura em Tecnologias de Informação</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="row">
					<div class="profPic col-xs-12 col-md-4">
						<img src="custom/images/profPics/hugo.jpg">
					</div>
					<div class="col-xs-12 col-md-8">
						<h4>Hugo Curado</h4>
						<p>Aluno da licenciatura em Tecnologias de Informação</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="row">
					<div class="profPic col-xs-12 col-md-4">
						<img src="custom/images/profPics/pedro.jpeg">
					</div>
					<div class="col-xs-12 col-md-8">
						<h4>Pedro Neto</h4>
						<p>Aluno da licenciatura em Tecnologias de Informação</p>
					</div>
				</div>
			</div>
		</div>
		<h4 id="A-Course">ASW 2016/2017</h4>
		<div id="descProj">
			<div class="page-header">
				<h4>Descrição do Projeto</h4>
			</div>
			<p>O própsito final da aplicação deve ser um site que permita que vários utilizadores registados possam jogar Poker entre si. No registo cada jogador terá direito a uma verba (fictícia, obviamente) de €500.00, dinheiro esse que servirá para as apostas virtuais. A aplicação deverá permitir várias partidas simultaneamente. O número de jogadores por partida deverá ser entre 2 e 9. Cada jogo permitirá que os jogadores apostem de acordo com as regras e o dinheiro ganho ou perdido reflectir-se-á no saldo de cada jogador no final de cada partida.</p>
		</div>
	</div>
</div>
<!-- custom js -->
<script type="text/javascript" src="custom/js/home.js"></script>