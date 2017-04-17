<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- custom css -->
<link rel="stylesheet" type="text/css" href="custom/css/admin.css">
<div class="coponentCont container">
	<h2 class="page-header">Admin</h2>
	<div class="alert alert-success" id="alertSuccess-user-admin" role="alert">
		<strong>Sucesso! </strong><span class="message"></span>
	</div>
	<div class="alert alert-danger" id="alertError-user-admin" role="alert">
		<strong>Erro! </strong><span class="message"></span>
	</div>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href='#users' class="tabTriger" aria-controls="users" role="tab" data-toggle="tab">Utilizadores</a></li>
		<li role="presentation"><a href='#game' class="tabTriger" aria-controls="game" role="tab" data-toggle="tab">Jogos</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="users">
			<!-- advanced search -->
			<form class="form-inline" id="advancedSearch" onsubmit="event.preventDefault(); return adv_Search();">
				<div class="form-group">
					<label for="Distritos">Distrito:</label>
					<select id="Distritos" class="form-control adv_search_fields distAdm">
						<option value="NULL" clss="ND_DistCon">Não Selecionado</option>
						<?php echo $districts; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="concelho">Concelho:</label>
					<select id="concelho" class="form-control adv_search_fields conAdm">
						<option value="NULL" clss="ND_DistCon">Não Selecionado</option>
						<?php echo $counties; ?>
					</select>
				</div>
				<div id="ageGroup" class="form-group">
				  	<div class="form-group">
					    <label for="InputAge">Faixa etária de:</label>
					    <input type="text" class="form-control adv_search_fields" id="InputAge" placeholder="faixa etária" autocomplete="off">
				  	</div>
				  	<div class="form-group" id="agetill">
					    <label for="InputAgeTill">Até:</label>
					    <input type="text" class="form-control adv_search_fields" id="InputAgeTill" placeholder="faixa etária" autocomplete="off">
				  	</div>
				</div>
			  	<button type="submit" class="btn btn-default" id="searchAdv_btn">Busca</button>
			</form>
			<table id='admin-users' class="table table-striped table-responsive">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Apelido</th>
						<th>Username</th>
						<th>Email</th>
						<th>Saldo</th>
						<th>D. Nascimento</th>
						<th>País</th>
						<th id="opsAdminUser">Opções</th>
					</tr>
				</thead>
				<tfoot>
            		<tr>
						<th>Nome</th>
						<th>Apelido</th>
						<th>Username</th>
						<th>Email</th>
						<th class="hideTableSerach">Saldo</th>
						<th class="hideTableSerach">D. Nascimento</th>
						<th>País</th>
						<th id="opsAdminUser-Bottom">Opções</th>
            		</tr>
        		</tfoot>
				<tbody></tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="game">
			<form class="form-inline" id="advancedSearchGame" onsubmit="event.preventDefault(); return adv_SearchGame();">
				<div class="form-group">
					<label for="state">Estado:</label>
					<select id="state" class="form-control adv_search_fieldsGame stateADM">
						<option value="NULL" clss="ND_State">Não Selecionado</option>
						<option value="1" clss="ND_State">Em espera</option>
						<option value="0" clss="ND_State">A decorrer</option>
						<option value="-1" clss="ND_State">Terminado</option>
					</select>
				</div>
			  	<button type="submit" class="btn btn-default" id="searchAdvGame_btn">Busca</button>
			</form>
			<table id='admin-plays' class="table table-striped table-responsive">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Dono</th>
						<th>Estado</th>
						<th>Total de utilizadores</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tfoot>
            		<tr>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Dono</th>
						<th class="hideTableSerach">Estado</th>
						<th class="hideTableSerach">Total de utilizadores</th>
						<th id="opsAdminUser-Bottom">Opções</th>
            		</tr>
        		</tfoot>
        		<tbody></tbody>
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
<!-- Modal Game Details -->
<div class="modal fade" id="gameDetails" tabindex="-1" role="dialog" aria-labelledby="gameDetails-modal">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
    		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="gameDetails-modal">Detalhes do Jogo</h4>
	      	</div>
	      	<div class="modal-body">
      			<div class="row">
		      		<div class="form-group col-xs-12 col-md-6">
			        	<label for="name-game-adm">Nome</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="name-game-adm" name="name-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="desc-game-adm">Descrição</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="desc-game-adm" name="desc-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="owner-game-adm">Dono</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="owner-game-adm" name="owner-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="nowPlyer-game-adm">Jogador Atual</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="nowPlyer-game-adm" name="nowPlyer-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="begin-game-adm">Inicio</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="begin-game-adm" name="begin-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="end-game-adm">Fim</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="end-game-adm" name="end-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="potValue-game-adm">Valor do Pote</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="potValue-game-adm" name="potValue-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
			        	<label for="currentBet-game-adm">Aposta Atual</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="currentBet-game-adm" name="currentBet-game-adm" readonly>
					    </div>
					</div>
					<div class="form-group col-md-12">
			        	<label for="cards-game-adm">Cartas da Mesa</label>
					    <div class="input-group">
						    <input type="text" class="form-control" id="cards-game-adm" name="cards-game-adm" readonly>
					    </div>
					</div>
					<div class="col-md-12">
			        	<label>Jogadores e Cartas</label>
			        	<table class="table table-striped table-responsive">
			        		<thead>
			        			<tr>
			        				<th>Username</th>
			        				<th>Cartas</th>
			        				<th>Aposta do Jogador</th>
			        				<th>Desistiu</th>
			        			</tr>
			        		</thead>
			        		<tbody id="players-game-adm"></tbody>
			        	</table>
					</div>
					<div class="col-md-12">
			        	<label>Aposta de Cada Jogador</label>
			        	<ul id="histoy-game-adm"></ul>
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
