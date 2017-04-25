<?php
	include("db.php");

	if (isset($_POST['criar'])) {
		$email = $_POST['email'];
	    $nome = $_POST['nome'];
	    $senha = $_POST['senha'];
	    $data = $_POST['data'];
	    $select = "INSERT INTO usuario (email, nome, senha, data_nascimento) VALUES (:email, :nome, :senha, :data)";

	    $result = $conexao->prepare($select);
	    $result->bindParam(':email', $email, PDO::PARAM_STR); 
	    $result->bindParam(':nome', $nome, PDO::PARAM_STR);
	    $result->bindParam(':senha', $senha, PDO::PARAM_STR);
	    $result->bindParam(':data', $data, PDO::PARAM_STR);
	    $result->execute();
	    if ($result) {
			echo '<h3>Usuario cadastrado com sucesso!</h3>';
		}else{
			echo "<h3>Algo não correu como esperávamos.</h3>";
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
		input[type="text"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="date"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
		input[type="submit"]{background-color: #4169E1; color: #FFF; border: none; width: 120px; height: 30px; margin-top: 20px; border-radius: 3px;}
		input[type="submit"]:hover{background-color: #001F3F; cursor: pointer;}
		h2{text-align: center; margin-top: 20px; color: #001F3F;}
		h3{text-align: center; color: #4169E1; margin-top: 15px;}
		a{text-decoration: none; color: #001F3F;}
		div#footer{bottom: 0; text-align: center; color: #666;}
	</style>
</head>
<body>
	<img src="img/logo.png"><br />
	<h2>Crie a sua conta</h2>
	<form method="POST">
		<input type="text" placeholder="Nome" maxlength="50" name="nome"><br />
		<input type="text" placeholder="Data de Nascimento" onfocus="(this.type='date')" onblur="(this.type='text')" name="data"><br />
		<input type="email" placeholder="Email" maxlength="100" name="email"><br />
		<input type="password" placeholder="Senha" maxlength="30" name="senha"><br />
		<input type="submit" value="Cadastrar" name="criar">
	</form>
	<h3>Já é cadastrado? <a href="login.php">Entre aqui!</a></h3>
	<br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div>
</body>
</html>