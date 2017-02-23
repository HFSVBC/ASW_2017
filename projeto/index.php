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
</style>
<h1 id="slogan">May the flop be with you</h1>
<span>Play <span class="glyphicon glyphicon-play" aria-hidden="true"></span></span>
<?php
 	include "templates/footer.php"; 
?>