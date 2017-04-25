<?php
	include("home.php");

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$login_cookie = $_SESSION['emailUser'];
		
		$select = "SELECT * FROM usuario WHERE codigo='$id'";
	    $saberr = $conexao->prepare($select);
	    $saberr->execute();
		foreach($saberr as $saber) {
			$email = $saber["email"];
		}

		$query = "UPDATE amizades SET aceite='sim' WHERE de='$email' AND para='$login_cookie'";
		$ins = $conexao->prepare($query);
		$ins->execute();
		if ($ins) {
			header("Location: pedidos.php");
		}else{
			echo "<h3>Erro ao aceitar amizade.</h3>";
		}
	}

	if (isset($_GET['remove'])) {
		$id = $_GET['remove'];
		$login_cookie = $_SESSION['emailUser'];
		
		$select = "SELECT * FROM usuario WHERE codigo='$id'";
	    $saberr = $conexao->prepare($select);
	    $saberr->execute();
		foreach($saberr as $saber) {
			$email = $saber["email"];
		}

		$query = "DELETE FROM amizades WHERE de='$login_cookie' AND para='$email' OR para='$login_cookie' AND de='$email'";
		$ins = $conexao->prepare($query);
		$ins->execute();
		if ($ins) {
			header("Location: pedidos.php");
		}else{
			echo "<h3>Erro ao recusar amizade.</h3>";
		}
	}
?>
<html>
<header>
	<style type="text/css">
		img#profile2{float: center; margin-top: 15px; width: 80px; height: 80px;}
		h3{text-align: center; color: #4169E1;}
		div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px; text-align: center;}
		div.pub a{color: #666; text-decoration: none;}
		div.pub a:hover{color: #111; text-decoration: none;}
		div.pub p{content: #666; text-align: center;}
		div.pub span{display: block; margin: auto; padding-top: 20px; text-align: center;}
		div.pub input{border-radius: 3px; background-color: #4169E1; border: none; color: #FFF; height: 25px; padding-right: 5px; padding-left: 5px; cursor: pointer;}
		div.pub input:hover{background-color: #001F3F;}
	</style>
</header>
<body>
	<br />
	<br />
	<br />
	<?php
		$login_cookie = $_SESSION['emailUser'];
		$select = "SELECT * FROM amizades WHERE para='$login_cookie' AND aceite='nao' ORDER BY id desc";
	    $pubs = $conexao->prepare($select);
	    $pubs->execute();
		foreach($pubs as $pub) {
			$email = $pub['de'];

			$select = "SELECT * FROM usuario WHERE email='$email'";
		    $saberr = $conexao->prepare($select);
		    $saberr->execute();
			foreach($saberr as $saber) {
				$nome = $saber['nome'];
			}
			$id = $pub['id'];

			echo '<div class="pub" id="'.$id.'">';
					if ($saber["foto"]=="") {
						echo '<a href="profile.php?id='.$saber["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="img/perfil.png" id="profile2"></a>';
					}else{
						echo '<a href="profile.php?id='.$saber["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="upload/'.$saber["foto"].'" id="profile2"></a>';
					}
				echo '<span>'.$nome.' quer ser seu amigo</span><br />
				<p><a href="profile.php?id='.$saber['codigo'].'">Ver perfil de '.$nome.'</a></p><br />
				<a href="pedidos.php?id='.$saber['codigo'].'"><input type="submit" value="Sim, aceito" name="add"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="pedidos.php?remove='.$saber['codigo'].'"><input type="submit" value="Não, obrigado" name="remove"></a>
				<br /><br />
			</div>';
		}
	?>
	<br />
	<h3>Não há mais pedidos de amizade.</h3>
	<br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>