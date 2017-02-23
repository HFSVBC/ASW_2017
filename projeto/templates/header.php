<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	
	<title><?php echo $siteName; ?></title>
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

	<!-- jQuery -->
	<script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Date Picker -->
	<link rel="stylesheet" type="text/css" href="assets/datetimepicker/jquery.datetimepicker.min.css">
	<script type="text/javascript" src="assets/datetimepicker/jquery.datetimepicker.full.min.js"></script>
	<!-- Country Select -->
	<link rel="stylesheet" type="text/css" href="assets/country_select/css/countrySelect.min.css">
	<script type="text/javascript" src="assets/country_select/js/countrySelect.min.js"></script>
	<!-- recaptcha -->
  	<script src='https://www.google.com/recaptcha/api.js'></script>

	<!-- custom js -->
	<script type="text/javascript" src="custom/js/main.js"></script>
	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="custom/css/main.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  	<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
	      		</button>
	      		<a class="navbar-brand" href="<?php echo $baseURL; ?>"><?php echo $siteName; ?></a>
	    	</div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      		<ul class="nav navbar-nav">
			        
	      		</ul>
	      		<ul class="nav navbar-nav navbar-right">
	      			<?php 
	      				if (!isset($_SESSION['loggedIn'])){
	      					echo "	
					        	<li id='log-btn'><a href='#'>Log In</a></li>
					        	<li id='reg-btn'><a href='#'>Registar</a></li>" ;
	      				}else{
	      					echo "
	      						<li class='dropdown'>
          							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Bem vindo, ".$_SESSION['loggedIn']['name']." <span class='caret'></span></a>
          							<ul class='dropdown-menu'>
							            <li><a href='#'>Perfil</a></li>
							            <li role='separator' class='divider'></li>
							            <li><a href='app/logout.php'>Log Out</a></li>
							        </ul>
          						</li>
								";
	      				}
	      			?>
	      		</ul>
	    	</div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
	<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
  		<div class="modal-dialog" role="document">
	      	<form method="post" action="app/login.php" id="loginForm">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Log In</h4>
      			</div>
	      		<div class="modal-body">
	      			<div class="form-group">
					    <label for="username">Nome de Utilizador</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="username" name="username">
					    </div>
					</div>
					<div class="form-group">
					    <label for="password">Password</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
						    <input type="password" class="form-control" id="password" name="password">
					    </div>
					</div>
					<div class="checkbox">
    					<label>
      						<input type="checkbox" name="rememberMe"> Lembrar-me
    					</label>
  					</div>    			
	      		</div>
	      		<div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-primary">Entrar</button>
	      		</div>
    		</div><!-- /.modal-content -->
    		</form>
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- formulario do registo -->
	<div class="modal fade" tabindex="-1" role="dialog" id="regModal">
  		<div class="modal-dialog modal-lg" role="document">
	      	<form method="post" action="app/login.php" id="regForm">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Registar</h4>
      			</div>
	      		<div class="modal-body row">
					<div class="form-group col-xs-12 col-md-6">
					    <label for="name">Nome *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="name" name="name" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="surname">Apelido *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="surname" name="surname" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="username">Nome de Utilizador *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="username" name="username" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="email">Email *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
						    <input type="email" class="form-control" id="email" name="email" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="password">Password *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
						    <input type="password" class="form-control" id="password" name="password" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="confPassword">Confirmar Password *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
						    <input type="password" class="form-control" id="confPassword" name="confPassword" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="birthDate">Data de Nascimento *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
						    <input type="text" class="form-control" id="birthDate" name="birthDate" required onkeydown="return false">
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="sexo">Sexo *</label>
					    <select type="checkbox" class="form-control" id="sexo" name="sexo" required>
					    	<option value="f">Feminino</option>
					    	<option value="m">Masculino</option>
					    	<option value="ND" selected>Prefiro Não Dizer</option>
					    </select>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="avatar">Avatar *</label>
					    <div class="input-group">
						    <div class="input-group-addon"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></div>
						    <input type="file" class="form-control" id="avatar" name="avatar" required>
						    <div class="input-group-addon"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></div>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="country">País *</label>
					    <div class="input-group" id="country_input-group">
						    <input type="text" id="country" name="country" required>
					    </div>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="dist">Distrito *</label>
					    <select type="checkbox" class="form-control" id="dist" name="dist" required>
					    	<?php 
					    		$sql    = "SELECT nome, id FROM dist_con WHERE tipo = 0";
					    		$result = $conn->query($sql);
					    		$output = "";
					    		if ($result->num_rows > 0) {
					    			while ($row = $result->fetch_assoc()) {
									    $output.="<option value='".$row['id']."'>".$row['nome']."</option>";
									}
								}
								echo $output;
					    	?>
					    </select>
					</div>
					<div class="form-group col-xs-12 col-md-6">
					    <label for="con">Concelho *</label>
					    <select type="checkbox" class="form-control" id="con" name="con" required>
					    	<?php 
					    		$sql    = "SELECT nome, id, parent_id FROM dist_con WHERE tipo = 1";
					    		$result = $conn->query($sql);
					    		$output = "";
					    		if ($result->num_rows > 0) {
					    			while ($row = $result->fetch_assoc()) {
									    $output.="<option value='".$row['id']."' data-parentDist='".$row['parent_id']."'>".$row['nome']."</option>";
									}
								}
								echo $output;
								$conn->close();
					    	?>
					    </select>
					</div>
					<div class="form-group col-md-12">
					    <label for="username">Captcha *</label>
					    <div class="input-group">
						    <div class="g-recaptcha" data-sitekey="6LdydxYUAAAAAITNNEGJOOkAjfAlRdyDwSW-xWvp"></div>
					    </div>
					</div>
					<div class="form-group col-md-12">
    					<label for="confPolicys">
      						<input type="checkbox" name="confPolicys" id="confPolicys" required> Concordo com os Termos e Condições
    					</label>
  					</div>    			
	      		</div>
	      		<div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-primary">Registar</button>
	      		</div>
    		</div><!-- /.modal-content -->
    		</form>
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->