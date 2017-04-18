 <?php
 	require_once("app/config.php");
    require_once('../fykXspR43K/conection.php');
    require_once('../fykXspR43K/loginSession.php');
 	session_regenerate_id(true);
 	include "templates/header.php"; 
?>
<style type="text/css">
	body{
		background: url(<?php echo $baseURL; ?>custom/images/backgroundPic.jpg) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	#slogan{
		width: 700px;
		color: #ffffff;
		position: absolute;
		top: 40%;
		left: 50%;
		margin-top: -110px;
		margin-left: -350px; 
		font-family: 'Lobster', cursive;
		font-size: 100px;
		text-align: center;
	}
	#playBTN{
		background: url(<?php echo $baseURL; ?>custom/images/btnBack.png) no-repeat center center; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		position: absolute;
		top: 60%;
		left: 50%;
		padding: 5px 20px;
		border-radius: 25px;
		font-size: 100px;
		margin-left: -169.5px;
		margin-top: -76px;
		font-family: 'Lobster', cursive;
		cursor: pointer;
		border-right: solid 5px rgba(0, 0, 0, 0.7);
		border-bottom: solid 5px rgba(0, 0, 0, 0.7);
		color: #ffffff;
	}
	#playBTN:active{
		border: none;
	}
</style>
<h1 id="slogan">May the flop be with you</h1>
<span id="playBTN">Play <span class="glyphicon glyphicon-play" aria-hidden="true"></span></span>
<?php
 	include "templates/footer.php"; 
?>