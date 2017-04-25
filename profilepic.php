<?php
	include("home.php");

	if (isset($_POST['save'])) {
		if ($_FILES["file"]["error"]>0) {
			echo "<script language='javascript' type='text/javascript'>alert('Você precisa escolher uma foto.');</script>";
		}else{
			$n = rand (0, 10000000);
			$img = $n.$_FILES["file"]["name"];

			move_uploaded_file($_FILES['file']['tmp_name'], "upload/".$img);
			
			$query = "UPDATE usuario SET foto='$img' WHERE email='".$_SESSION['emailUser']."'";
			$result = $conexao->prepare($query);
			$result->execute();
			if ($result) {
				header("Location: myprofile.php");
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar a sua foto.');</script>";
			}
		}
	}

	if (isset($_POST['cancel'])) {
		header("Location: myprofile.php");
	}
?>
<html>
	<header>
		<style type="text/css">
			body{background-color: #007fff;}
			h2{margin-top: 50px; text-align: center; color: #FFF; font-size: 49px;}
			form#perfil{display: block; margin: auto; text-align: center; width: 350px; margin-top: 20px; background-color: #FFF; box-shadow: 0 0 10px #666; border-radius: 5px;}
			input[type="submit"]{width: 100px; height: 25px; border: none; border-radius: 3px; background-color: #007fff; cursor: pointer; color: #FFF;}
			input[type="submit"]:hover{background: #001F3F;}
			p{color: #FFF; text-align: center;}
		</style>
	</header>
	<body>
		<h2>Alterar a foto de perfil.</h2>
		<form method="POST" enctype="multipart/form-data" id="perfil">
			<br />
			<h3>Mostre a sua beleza ao mundo!</h3><br />
			<h3>Adicione uma foto de perfil!</h3><br /><br />
			<input type="file" name="file" /><br /><br /><br />
			<input type="submit" value="Cancelar" name="cancel">&nbsp;&nbsp;&nbsp;<input type="submit" value="Salvar" name="save" />
			<br /><br />
		</form>
		<br /><br /><br />
		<p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p>
	</body>
</html>