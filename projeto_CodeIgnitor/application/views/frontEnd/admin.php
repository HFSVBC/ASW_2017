<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="coponentCont container">
	<h2 class="page-header">Admin</h2>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href='#users' class="tabTriger" aria-controls="users" role="tab" data-toggle="tab">Utilizadores</a></li>
		<li role="presentation"><a href='#game' class="tabTriger" aria-controls="game" role="tab" data-toggle="tab">Jogos</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="users">
			<table id='admin-users' class="table table-striped table-condensed table-responsive">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Apelido</th>
						<th>Username</th>
						<th>Email</th>
						<th>Balance</th>
						<th>D. Nascimento</th>
						<th>Sexo</th>
						<th>Pais</th>
						<th>Distrito</th>
						<th>Concelho</th>
						<th>D. criaçao</th>
						<th>D. activaçao</th>
						<th>Nivel</th>
						<th>Opçoes</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="game">
			<table id='admin-plays' class="table table-striped">
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