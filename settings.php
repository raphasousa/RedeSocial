<?php
	include("home.php");

	try{
		$select = "SELECT * FROM usuario WHERE email='".$_SESSION['emailUser']."'";
	    $infoo = $conexao->prepare($select);
	    $infoo->execute();
    }catch(PDOException $e){
    	echo $e;
    }
    foreach($infoo as $info) {
		$email = $info["email"];
	}

	if (isset($_POST['salvar'])) {
		$nome = $_POST['nome'];
		$data = $_POST['data'];
		$pass = $_POST['pass'];
		$texto = $_POST['texto'];

		if($nome==""){
			echo "<h3>Escreva o seu nome</h3>";
		}elseif($data==""){
			echo "<h3>Escrevq a sua data de nascimento</h3>";
		}elseif($pass==""){
			echo "<h3>Escreva uma senha</h3>";
		}elseif(strlen($texto) > 255){
			echo "<h3>A descrição deve ter no máximo 250 caracteres</h3>";
		}else{
			$query = "UPDATE usuario SET nome='$nome', data_nascimento='$data', senha='$pass', descricao='$texto' WHERE email='$email'";
			$result = $conexao->prepare($query);
			$result->execute();
			if ($result) {
				header("Location: myprofile.php");
			}else{
				echo "<h3>Algo não correu como esperávamos.</h3>";
			}
		}
	}

	if (isset($_POST['cancel'])) {
		header("Location: myprofile.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
		*{font-family: 'Montserrat', cursive;}
		img[name="p"]{display: block; margin: auto; margin-top: 20px; width: 200px;}
		form{text-align: center; margin-top: 10px;}
		input[type="text"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="date"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
		input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
		input[type="submit"]{border: none; width: 120px; height: 30px; margin-top: 20px; border-radius: 3px; background: #4169E1; color: #FFF;}
		input[type="submit"]:hover{background-color: #001F3F; cursor: pointer;}
		textarea{width: 250px; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #CCC;}
		h2{text-align: center; color: #4169E1; margin-top: 20px;}
		h3{text-align: center; color: #4169E1; margin-top: 15px;}
		a{text-decoration: none; color: #333;}
	</style>
</head>
<body>
	<!-- <img name="p" src="img/logo.png"><br /> -->
	<h2>Alterar as suas informações</h2>
	<form method="POST" name="form">
		<input type="text" placeholder="Nome" maxlength="50" value="<?php echo $info['nome']; ?>" name="nome"><br />
		<input type="text" placeholder="Data de Nascimento" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo $info['data_nascimento']; ?>" name="data"><br />
		<input type="password" placeholder="Senha" maxlength="30" value="<?php echo $info['senha']; ?>" name="pass"><br /><br />
		<textarea placeholder="Escreva algo sobre você" name="texto"><?php echo $info['descricao']; ?></textarea>
		<input type="submit" value="Cancelar" name="cancel">&nbsp;&nbsp;&nbsp;<input type="submit" value="Atualizar" name="salvar">
	</form>
	<br /><br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>