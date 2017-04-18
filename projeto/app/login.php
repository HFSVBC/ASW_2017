<?php 
	require_once("config.php");
    require_once('../../fykXspR43K/loginSession.php');
    $name     = "John";
    $surname  = "Doe";
    $email    = "johndoe@gmail.com";
    $password =  "guest";
    $username = "guest";

    $sent_username = $_POST["username"] ;
    $sent_password = $_POST["password"];
    
    if($username===$sent_username && $password===$sent_password){
    	$_SESSION['loggedIn'] = array(
    			'name'     => $name,
                'surname'  => $surname,
                'email'    => $email,
    			'username' => $username,
    		);
    	header("Location: ../");
    }
    else{
    	echo "Utilizador/Password Errado(a)";
    }