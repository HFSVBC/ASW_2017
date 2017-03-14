<!-- CUSTOM CSS -->
<link rel="stylesheet" type="text/css" href="custom/css/profile.css">
<article id="profilePage">
	<header id="PP-header">
		<div class="row">
			<div class="col-xs-12 col-md-10" id="name-Cont">
				<h1 id="nome user"><?php echo $loggedIn_user; ?></h1>
				<h3 id="hPerfil">Perfil</h3>
			</div>
			<div class="col-xs-12 col-md-2" id="SButton-cont">
				<span id="SButton"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Mudar Password</span>
				<span id="SButton-balance"><span class="glyphicon glyphicon-eur" aria-hidden="true"></span> <?php echo number_format($balance, 2, ',', ' '); ?></span>
			</div>
		</div>
	</header>
	<div id="PP-body">
		<div class="row">
			<form id="updateProfile-Form" onsubmit="event.preventDefault(); return userUpdate();" method="post" action="<?php base_url(); ?>index.php/user/update">
				<div id="alert-container">
					<div class="alert alert-success" id="alertSuccess" role="alert">
	      				<strong>Sucesso! </strong><span class="message"></span>
	      			</div>
	      			<div class="alert alert-danger" id="alertError" role="alert">
	      				<strong>Erro! </strong><span class="message"></span>
	      			</div>
	      		</div>
				<div id="btns-update-prof">
					<input type="submit" value="Guardar" class="btn btn-warning" id="submitUpdateForm">
					<a href="<?php echo base_url(); ?>" class="btn btn-default">Fechar</a>
				</div>
				<div class="col-xs-12 col-md-9 container">
					<div id="mainProfCont">
						<div class="row">
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-name">Nome</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="prof-name" name="name" value="<?php echo $fName; ?>">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-surname">Apelido</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="prof-surname" name="surname" value="<?php echo $lName; ?>">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-username">Username</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="prof-username" name="username" value="<?php echo $loggedIn_user; ?>" readonly>
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-email">Email</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="email" class="form-control" id="prof-email" name="email" value="<?php echo $loggedIn_email; ?>">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-birthDate">Data de Nascimento *</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
								    <input type="text" class="form-control birthDate" id="prof-birthDate" name="birthDate" value="<?php echo $birthDate; ?>" required>
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-sexo">Sexo *</label>
							    <select class="form-control" id="prof-sexo" name="sex" required>
							    	<option value="f">Feminino</option>
							    	<option value="m">Masculino</option>
							    	<option value="ND">Prefiro Não Dizer</option>
							    </select>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-country">País *</label>
							    <div class="input-group" id="country_input-group">
								    <input type="text" class="countryInput" id="prof-country" name="country" required autocomplete="off">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="dist prof-district">Distrito *</label>
							    <select class="form-control dist" id="prof-district" name="district">
							    	<?php echo $districts; ?>
							    </select>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="prof-county">Concelho *</label>
							    <select class="form-control con" id="prof-county" name="county">
							    	<?php echo $counties; ?>
							    </select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 container">
					<div id="leftProfCont">
						<div class="form-group" id="avatar">
							<label for="prof-avatar">Imagem de Perfil</label>
							<img src="http://placehold.it/400x400" id="prof-avatar-prev">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></div>
								<input type="file" class="form-control" id="prof-avatar" name="avatar">
							</div>
						</div>								
					</div>
				</div>
			</form>
		</div>
	</div>
</article>
<!-- CUSTOM JS -->
<script type="text/javascript">
	var userSex      = "<?php echo $sex; ?>";
	var userCountry  = "<?php echo $country; ?>";
	var userDistrict = "<?php echo $district; ?>";
	var userCounty   = "<?php echo $county; ?>";
</script>
<script type="text/javascript" src="custom/js/profile.js"></script>