 <?php
 	require_once("../app/config.php");
    require_once('../../fykXspR43K/conection.php');
    require_once('../../fykXspR43K/loginSession.php');
 	session_regenerate_id(true);
 	include "../templates/header.php"; 
?>
<article id="profilePage">
	<header id="PP-header">
		<div class="row">
			<div class="col-xs-12 col-md-10" id="name-Cont">
				<h1 id="nome user"><?php echo $_SESSION['loggedIn']['name']; ?></h1>
				<h3 id="hPerfil">Perfil</h3>
			</div>
			<div class="col-xs-12 col-md-2" id="SButton-cont">
				<span id="SButton"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Mudar Password</span>
			</div>
		</div>
	</header>
	<div id="PP-body">
		<div class="row">
			<form method="post" action="<?php echo $baseURL;?>app/profileUpdate" id="updateProfile-Form">
				<div class="col-xs-12 col-md-8 container">
					<div id="mainProfCont">
						<div class="row">
							<div class="form-group col-xs-12 col-md-6">
							    <label for="name">Nome</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="name" name="name">
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="surname">Apelido</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="surname" name="surname">
							    </div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-12 col-md-6">
							    <label for="username">Username</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="text" class="form-control" id="username" name="username" readonly>
							    </div>
							</div>
							<div class="form-group col-xs-12 col-md-6">
							    <label for="email">Email</label>
							    <div class="input-group">
								    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
								    <input type="email" class="form-control" id="email" name="email">
							    </div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 container">
					<div id="mainProfCont"></div>
				</div>
			</form>
		</div>
	</div>
</article>
<?php
 	include "../templates/footer.php"; 
?>