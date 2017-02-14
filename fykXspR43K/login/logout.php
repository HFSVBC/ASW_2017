<?php
	require_once("../app/config.php");
    require_once('../../fykXspR43K/loginSession.php');
    session_regenerate_id(true);
    unset($_SESSION['loggedIn']);
    session_destroy();
    header("Location: ".$logIN);
?>
