<?php
	session_start();
    ob_start();
    if(isset($_SESSION['emailUser']) && isset($_SESSION['senhaUser'])){
      $redirect = "index.php";
      header("location:$redirect");
    }

  	include("db.php");
  	if(isset($_POST['entrar'])){
	    $email = $_POST['email'];
	    $senha = $_POST['senha'];
	    $select = "SELECT * FROM Usuario WHERE Email=:email AND Senha=:senha";

	    try{
	    	$result = $conexao->prepare($select);
		    $result->bindParam(':email', $email, PDO::PARAM_STR); 
		    $result->bindParam(':senha', $senha, PDO::PARAM_STR);
		    $result->execute();
		    $count = $result->rowCount(); 
		    if($count==1){
		    	setcookie("login",$email);
		      	$_SESSION['emailUser'] = $email;
		        $_SESSION['senhaUser'] = $senha;
		        $redirect = "index.php";
		        header("location:$redirect");
		    }
		    else{
		        echo "<h3>E-mail e/ou senha incorretos!</h3>";
		    }
	    }catch(PDOException $e){
	    	echo $e;
	    }
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
		*{font-family: 'Montserrat', cursive;}
		img{display: block; margin: auto; margin-top: 20px; width: 200px; height: 200px;}
		form{text-align: center; margin-top: 10px;}
		input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
		input[type="submit"]{background-color: #4169E1; color: #FFF; border: none; width: 80px; height: 30px; margin-top: 20px; border-radius: 3px;}
		input[type="submit"]:hover{background-color: #001F3F; cursor: pointer;}
		h2{text-align: center; margin-top: 20px; color: #001F3F;}
		h3{text-align: center; color: #4169E1; margin-top: 15px;}
		a{text-decoration: none; color: #001F3F;}
		div#footer{bottom: 0; text-align: center; color: #666;}
	</style>
</head>
<body>
	<img src="img/logo.png"><br />
	<h2>Entre na sua conta</h2>
	<form method="POST">
		<input type="email" placeholder="Email/User" name="email"><br />
		<input type="password" placeholder="Senha" name="senha"><br />
		<input type="submit" value="Entrar" name="entrar">
	</form>
	<h3>Ainda não tem conta? <a href="registrar.php">Crie uma hoje!</a></h3>
	<br /><br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>