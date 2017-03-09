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
			<form id="updateProfile-Form">
				<div class="col-xs-12 col-md-9 container">
					<div id="mainProfCont">
						<div class="row">
							<div class="form-group col-xs-12 col-md-6">
							    <label for="name">Nome</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="name" name="name" value="<?php echo $fName; ?>">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="surname">Apelido</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $lName; ?>">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="username">Username</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="username" name="username" value="<?php echo $loggedIn_user; ?>" readonly>
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="email">Email</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="email" class="form-control" id="email" name="email" value="<?php echo $loggedIn_email; ?>">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="birthDate">Data de Nascimento *</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
								    <input type="text" class="form-control birthDate" name="birthDate" value="<?php echo $birthDate; ?>" required>
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="sexo">Sexo *</label>
							    <select class="form-control" id="sexo" name="sex" value="<?php echo $sex; ?>" required>
							    	<option value="f">Feminino</option>
							    	<option value="m">Masculino</option>
							    	<option value="ND">Prefiro Não Dizer</option>
							    </select>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="country">País *</label>
							    <div class="input-group" id="country_input-group">
								    <input type="text" class="country" name="country" required autocomplete="off">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="dist">Distrito *</label>
							    <select class="form-control dist" name="district" value="<?php echo $district; ?>">
							    	<?php echo $districts; ?>
							    </select>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="con">Concelho *</label>
							    <select class="form-control con" name="county" value="<?php echo $county; ?>">
							    	<?php echo $counties; ?>
							    </select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 container">
					<div id="leftProfCont">
						<div class="form-group" id="avatar">
							<label for="avatar">Imagem de Perfil</label>
							<img src="http://placehold.it/400x400">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></div>
								<input type="file" class="form-control" id="avatar" name="avatar">
							</div>
						</div>								
					</div>
				</div>
			</form>
		</div>
	</div>
</article>