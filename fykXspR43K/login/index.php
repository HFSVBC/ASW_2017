<?php
    require_once("../phpScripts/config.php");
    require_once("../../fykXspR43K/conection.php");
    require_once('../../fykXspR43K/loginSession.php');
    session_regenerate_id(true);
    
    if ($_SESSION['loggedIn'] == true){
        header("Location: ".$appLocation);
    }

    if (isset($_POST['username']) && isset($_POST['password'])){

        $user = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT ID, username, password, accessLevel FROM USERS_Main  WHERE username='$user'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if (password_verify($pass, $row['password'])){
                    if ($row['accessLevel'] == 0 || $row['accessLevel'] == 1){
                        $user = $row['ID'];
                        $site = "WDWH Inventory";
                        $ip   = $_SERVER['REMOTE_ADDR'];
                        $sql = "INSERT INTO USERS_Access (USER, site, IP) VALUES ('$user', '$site', '$ip')";
                        if (mysqli_query($conn, $sql)) {
                            $_SESSION['loggedIn'] = true;
                            header("Location: ".$appLocation);
                        }
                        else{
                            $error = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>An error has occurred! Please try again later.'. mysqli_error($conn).'</div>';
                        }
                    }else{
                        $error = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>LogIn failed! You are not allowed to view this content.</div>';
                    }
                }
            }
		}else{
            $error = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>LogIn failed! Username and/or password are/is incorrect.</div>';
        }
		$conn->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<title><?php echo $siteName ?> | LogIn</title>

<!-- jQuery JS -->
<script type="text/javascript" src="<?php echo $jsDir ?>jquery-3.1.1.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $cssDir ?>bootstrap.min.css">
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?php echo $jsDir ?>bootstrap.min.js"></script>

<style type="text/css">
	body{
		background-color: #f0f0f0;
	}
	.thumbnail{
		margin-top: -121.5px;
		position: absolute;
		top: 35%;
		left: 50%;
		padding: 15px;
        -webkit-box-shadow: 0px 0px 30px 0px rgba(50, 50, 50, 0.36);
        -moz-box-shadow:    0px 0px 30px 0px rgba(50, 50, 50, 0.36);
        box-shadow:         0px 0px 30px 0px rgba(50, 50, 50, 0.36);
	}
    @media screen and (max-width: 480px) {
        .thumbnail{
            margin-top: -130px;
        }
    }
	.input-group{
		margin-bottom: 10px;
	}
	div.input-group.w3-right{
		float: right;
		margin-top: 10px;
	}
	#copyright{
		position: absolute;
		bottom: 10px;
		text-align: center;
		width: 100%;
	}
</style>
</head>
<body>
	<div class="row" id="LogIn-container">
        <div class="thumbnail col-md-4 col-xs-11">
            <div class="page-header">
                <div id="headerText">
                    <h3><?php echo $siteLogo ?> | LogIn</h3>
                </div>
            </div>
            <?php echo $error; ?>
            <form method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
                </div>
                <footer class="form-footer">
                    <div class="input-group w3-right">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="copyright"><a href="https://www.hugocurado.info" target="_blanc">Hugo Curado</a> all rights reserved, Copyright © <?php echo date("Y") ?></div>
    <script type="text/javascript">
        $(".thumbnail").css("margin-left", "-"+String(($(".thumbnail").width()+30)/2)+"px");
    </script>
</body>
</html>