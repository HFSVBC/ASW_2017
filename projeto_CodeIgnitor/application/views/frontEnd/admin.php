<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="custom/css/admin.css">
<div class="coponentCont container">
	<h2 class="page-header">Admin</h2>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href='#users' class="tabTriger" aria-controls="users" role="tab" data-toggle="tab">Utilizadores</a></li>
		<li role="presentation"><a href='#game' class="tabTriger" aria-controls="game" role="tab" data-toggle="tab">Jogos</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="users">
			<table id='admin-users' class="table table-striped table-responsive">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Apelido</th>
						<th>Username</th>
						<th>Email</th>
						<th>Balance</th>
						<th>D. Nascimento</th>
						<th>Pais</th>
						<th>Opçoes</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="game">
			<table id='admin-plays' class="table table-striped table-responsive">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Criador</th>
						<th>Estado</th>
						<th>Data de Criaçao</th>
						<th>Data de Fim</th>
						<th>Total de utilizadores</th>
						<th>Vencedor</th>
						<th>Opçoes</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- custom js -->
<script type="text/javascript" src="custom/js/admin.js"></script>