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
<!-- Modal User Details -->
<div class="modal fade" id="userDetails" tabindex="-1" role="dialog" aria-labelledby="userDetails-modal">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
    		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="userDetails-modal">Detalhes do Utilizador</h4>
	      	</div>
	      	<div class="modal-body">
	      		<div class="alert alert-success" id="alertSuccess-user-admin" role="alert">
      				<strong>Sucesso! </strong><span class="message"></span>
      			</div>
      			<div class="alert alert-danger" id="alertError-user-admin" role="alert">
      				<strong>Erro! </strong><span class="message"></span>
      			</div>
      			<div class="row">
		      		<div class="form-group col-xs-12 col-md-6">
			        	<label for="name-usr-adm">Nome</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="name-usr-adm" name="name-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="surname-usr-adm">Apelido</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="surname-usr-adm" name="surname-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="username-usr-adm">Nome de Utilizador</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="username-usr-adm" name="username-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="email-usr-adm">E-mail</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="email-usr-adm" name="email-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="balance-usr-adm">Saldo</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="balance-usr-adm" name="balance-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="birthDate-usr-adm">Data de Nascimento</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="birthDate-usr-adm" name="birthDate-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="sex-usr-adm">Sexo</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="sex-usr-adm" name="sex-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="country-usr-adm">País</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="country-usr-adm" name="country-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="district-usr-adm">Distrito</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="district-usr-adm" name="district-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="county-usr-adm">Concelho</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="county-usr-adm" name="county-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="creationDate-usr-adm">Data de Criação</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="creationDate-usr-adm" name="creationDate-usr-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="level-usr-adm">Nivel</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="level-usr-adm" name="level-usr-adm" readonly>
					    </div>
					</div>
				</div>
			</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	      	</div>
   		</div>
  	</div>
</div>
<!-- custom js -->
<script type="text/javascript" src="custom/js/admin.js"></script>