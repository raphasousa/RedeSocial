<?php
	include("home.php");

	$login_cookie = $_SESSION['emailUser'];
	$id = $_GET["id"];
	try{
		$select = "SELECT * FROM usuario WHERE codigo='$id'";
	    $saberr = $conexao->prepare($select);
	    $saberr->execute();
    }catch(PDOException $e){
    	echo $e;
    }
    foreach($saberr as $saber) {
		$email = $saber["email"];
	}
	if ($email==$_SESSION['emailUser']) {
		$redirect = "myprofile.php";
     	header("location:$redirect");
	}

	if (isset($_POST['chat'])) {
		header("Location: chat.php?from=".$id);
	}

	if (isset($_POST['add'])) {
		$login_cookie = $_SESSION['emailUser'];
		if (!isset($login_cookie)) {
			header("Location: login.php");
		}

		$id = $_GET['id'];
		$select = "SELECT * FROM usuario WHERE codigo='$id'";
	    $saberr = $conexao->prepare($select);
	    $saberr->execute();
		foreach($saberr as $saber) {
			$email = $saber["email"];
		}
		$data = date("Y/m/d");

		$query = "INSERT INTO amizades (de, para, data) VALUES ('$login_cookie', '$email', '$data')";
		$ins = $conexao->prepare($query);
		$ins->execute();
		if ($ins) {
			header("Location: profile.php?id=".$id);
		}else{
			echo "<h3>>Erro ao enviar pedido.</h3>";
		}
	}

	if (isset($_POST['cancelar'])) {
		$login_cookie = $_SESSION['emailUser'];
		if (!isset($login_cookie)) {
			header("Location: login.php");
		}

		$id = $_GET['id'];
		$select = "SELECT * FROM usuario WHERE codigo='$id'";
	    $saberr = $conexao->prepare($select);
	    $saberr->execute();
		foreach($saberr as $saber) {
			$email = $saber["email"];
		}

		$query = "DELETE FROM amizades WHERE de='$login_cookie' AND para='$email'";
		$ins = $conexao->prepare($query);
		$ins->execute();
		if ($ins) {
			header("Location: profile.php?id=".$id);
		}else{
			echo "<h3>>Erro ao cancelar pedido.</h3>";
		}
	}

	if (isset($_POST['remover'])) {
		$login_cookie = $_SESSION['emailUser'];
		if (!isset($login_cookie)) {
			header("Location: login.php");
		}

		$id = $_GET['id'];
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
			header("Location: profile.php?id=".$id);
		}else{
			echo "<h3>>Erro ao desfazer amizade.</h3>";
		}
	}

	if (isset($_POST['aceitar'])) {
		$login_cookie = $_SESSION['emailUser'];
		if (!isset($login_cookie)) {
			header("Location: login.php");
		}

		$id = $_GET['id'];
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
			header("Location: profile.php?id=".$id);
		}else{
			echo "<h3>Erro ao aceitar amizade.</h3>";
		}
	}

	if (isset($_GET["love"])) {
		$login_cookie = $_SESSION['emailUser'];
		$publicacaoid = $_GET['love'];
		$data = date("Y/m/d");

		$ins = "INSERT INTO loves (`user`,`pub`,`data`) VALUES ('$login_cookie','$publicacaoid','$data')";
		$result = $conexao->prepare($ins);
		$result->execute();
		if ($ins) {
			header("Location: index.php#".$publicacaoid);
		}else{
			echo "<h3>Erro ao curtir publicação</h3>";
		}
	}

	if (isset($_GET["unlove"])) {
		$login_cookie = $_SESSION['emailUser'];
		$publicacaoid = $_GET['unlove'];

		$del = "DELETE FROM loves WHERE `user`='$login_cookie' AND `pub`='$publicacaoid'";
		$result = $conexao->prepare($del);
		$result->execute();
		if ($del) {
			header("Location: index.php#".$publicacaoid);
		}else{
			echo "<h3>Erro ao descurtir publicação</h3> ";
		}
	}
?>
<html>
<header>
	<style type="text/css">
		h2{text-align: center; padding-top: 30px; color: #FFF;}
		img#profile{width: 100px; height: 100px; display: block; margin: auto; margin-top: 30px; border: 5px solid #007fff; background-color: #007fff; border-radius: 10px; margin-bottom: -30px;}
		img#profile2{float: left; margin-top: 0px; width: 18px;}

		div#menu{width: 400px; height: 200px;display: block; margin: auto; border: none; border-radius: 5px; background-color: #007fff; text-align: center;}
		div#menu input{height: 25px; border: none; border-radius: 3px; background-color: #FFF; cursor: pointer;}
		div#menu input[name="add"]{margin-right: 20px;}
		div#menu input[name="aceitar"]{margin-right: 20px;}
		div#menu input[name="remover"]{margin-right: 20px;}
		div#menu input[name="cancelar"]{margin-right: 20px;}
		div#menu input[name="chat"]{margin-right: 20px;}
		div#menu input:hover{height: 25px; border: none; border-radius: 3px; background-color: transparent; cursor: pointer; color: #FFF;}
		div#menu h5{text-align: center; color: #FFF;}
		div#menu h6{text-align: center; color: #FFF;}

		div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
		div.pub a{margin-left: 5px; color: #666; text-decoration: none;}
		div.pub a:hover{color: #111; text-decoration: none;}
		div.pub p{margin-left: 10px; content: #666; padding-top: 10px;}
		div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px;}
		div.pub img{display: block; margin: auto; width: 100%; margin-top: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;}

		div#love{width: 400px; height: 30px; display: block; margin: auto; border: none; border-radius: 5px; background: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 1px;}
		div#love p{color: #000; font-size: 12px; padding-top: 5px; padding-left: 5px;}
		div#love a[name="no"]{color: #111; font-size: 16px; text-decoration: none;}
		div#love a[name="no"]:hover{color: #666; font-size: 16px; text-decoration: none;}
		div#love a[name="yes"]{color: #007fff; font-size: 16px; text-decoration: none;}
		div#love a[name="yes"]:hover{color: #007fff; font-size: 16px; text-decoration: none;}
	</style>
</header>
<body>
	<?php
		if ($saber["foto"]=="") {
			echo '<img src="img/user.png" id="profile">';
		}else{
			echo '<img src="upload/'.$saber["foto"].'" id="profile">';
		}
	?>
	<div id="menu">
		<form method="POST">
			<h2><?php echo $saber['nome']; ?></h2>
			<h6><?php echo "Nascimento: ".date('d/m/Y', strtotime($saber['data_nascimento'])); ?></h6><br />
			<h6><?php echo $saber['descricao']; ?></h6><br />
			<?php
				$select = "SELECT * FROM amizades WHERE de='$login_cookie' AND para='$email' OR para='$login_cookie' AND de='$email'";
			    $amigos = $conexao->prepare($select);
			    $amigos->execute();
			    $count = $amigos->rowCount(); 
				foreach($amigos as $amigoss) {
					$cod = $amigoss["id"];
				}
				if ($count>=1 AND $amigoss["aceite"]=="sim") {
					echo '<input type="submit" value="Remover amigo" name="remover"><input type="submit" name="chat" value="Conversar">';
				}elseif ($count>=1 AND $amigoss["aceite"]=="nao" AND $amigoss["para"]==$login_cookie){
					echo '<input type="submit" value="Aceitar pedido" name="aceitar"><input type="submit" name="chat" value="Conversar">';
				}elseif ($count>=1 AND $amigoss["aceite"]=="nao" AND $amigoss["de"]==$login_cookie){
					echo '<input type="submit" value="Cancelar pedido" name="cancelar"><input type="submit" name="chat" value="Conversar">';
				}else{
					echo '<input type="submit" value="Adicionar amigo" name="add"><input type="submit" name="chat" value="Conversar">';
				}
			?>
		</form>
	</div>
	<?php
		$pubs = "SELECT * FROM post WHERE user='$email' ORDER BY codigo desc;";
		$result = $conexao->prepare($pubs);
	    $result->execute();

	    $select = "SELECT * FROM usuario WHERE email='$email'";
	    $saberr = $conexao->prepare($select);
	    $saberr->execute();
	    foreach($saberr as $saber) {
			$nome = $saber['nome'];
		}

		$select = "SELECT * FROM amizades WHERE de='$login_cookie' AND para='$email' AND aceite='sim' OR para='$login_cookie' AND de='$email' AND aceite='sim'";
	    $amigos = $conexao->prepare($select);
	    $amigos->execute();
	    $count = $amigos->rowCount(); 
		foreach($amigos as $amigoss) {
			$cod = $amigoss["id"];
		}

		if ($count==1) {
			foreach($result as $pub) {
				$email = $pub['user'];
				$id = $pub['codigo'];

				$selectloves = "SELECT * FROM loves WHERE pub='$id'";
				$resultloves = $conexao->prepare($selectloves);
	       		$resultloves->execute();
				$loves = $resultloves->rowCount(); 

				if ($pub['imagem']=="") {
					echo '<div class="pub" id="'.$id.'">
						<p>';
							if ($saber["foto"]=="") {
								echo '<img src="img/perfil.png" id="profile2">';
							}else{
								echo '<img src="upload/'.$saber["foto"].'" id="profile2">';
							}
						echo '<a href="profile.php?id='.$saber['codigo'].'">'.$nome.'</a> - '.date('d/m/Y', strtotime($pub["data"])).'</p>
						<span>'.$pub['texto'].'</span><br />
					</div>
					<div id="love">';
						$selectemail = "SELECT user FROM loves WHERE pub='$id' AND user='$login_cookie'";
						$resultemail = $conexao->prepare($selectemail);
		           		$resultemail->execute();
						$count_email = $resultemail->rowCount();
						if ($count_email >= 1) {
							$loves = $loves - 1;
							if ($loves > 1) {
								echo '<p><a href="index.php?unlove='.$id.'" name="yes">Curtiu</a> | Você e mais '.$loves.' pessoas curtiram isso</p>';
							}elseif ($loves == 1) {
								echo '<p><a href="index.php?unlove='.$id.'" name="yes">Curtiu</a> | Você e mais uma pessoa curtiram isso</p>';
							}else {
								echo '<p><a href="index.php?unlove='.$id.'" name="yes">Curtiu</a> | Você curtiu isso</p>';
							}
						}else{
							if ($loves > 1) {
								echo '<p><a href="index.php?love='.$id.'" name="no">Curtir</a> | '.$loves.' pessoas curtiram isso</p>';
							}elseif ($loves == 1) {
								echo '<p><a href="index.php?love='.$id.'" name="no">Curtir</a> | Uma pessoa curtiu isso</p>';
							}else {
								echo '<p><a href="index.php?love='.$id.'" name="no">Curtir</a> | Seja a primeira pessoa a curtir isso</p>';
							}
						}
					echo '</div>';
				}else{
					echo '<div class="pub" id="'.$id.'">
						<p>';
							if ($saber["foto"]=="") {
								echo '<img src="img/perfil.png" id="profile2">';
							}else{
								echo '<img src="upload/'.$saber["foto"].'" id="profile2">';
							}
						echo '<a href="profile.php?id='.$saber['codigo'].'">'.$nome.'</a> - '.date('d/m/Y', strtotime($pub["data"])).'</p>
						<span>'.$pub['texto'].'</span>
						<img src="upload/'.$pub["imagem"].'" />
					</div>
					<div id="love">';
						$selectemail = "SELECT user FROM loves WHERE pub='$id' AND user='$login_cookie'";
						$resultemail = $conexao->prepare($selectemail);
		           		$resultemail->execute();
						$count_email = $resultemail->rowCount();
						if ($count_email >= 1) {
							$loves = $loves - 1;
							if ($loves > 1) {
								echo '<p><a href="index.php?unlove='.$id.'" name="yes">Curtiu</a> | Você e mais '.$loves.' pessoas curtiram isso</p>';
							}elseif ($loves == 1) {
								echo '<p><a href="index.php?unlove='.$id.'" name="yes">Curtiu</a> | Você e mais uma pessoa curtiram isso</p>';
							}else {
								echo '<p><a href="index.php?unlove='.$id.'" name="yes">Curtiu</a> | Você curtiu isso</p>';
							}
						}else{
							if ($loves > 1) {
								echo '<p><a href="index.php?love='.$id.'" name="no">Curtir</a> | '.$loves.' pessoas curtiram isso</p>';
							}elseif ($loves == 1) {
								echo '<p><a href="index.php?love='.$id.'" name="no">Curtir</a> | Uma pessoa curtiu isso</p>';
							}else {
								echo '<p><a href="index.php?love='.$id.'" name="no">Curtir</a> | Seja a primeira pessoa a curtir isso</p>';
							}
						}
					echo '</div>';
				}

		        foreach($result2 as $saber) {
					$nome = $saber['nome'];
					$id = $pub['codigo'];

					
				}
			}
		}elseif ($count==0){
			echo '<div class="pub" id="'.$id.'">
					<p>Aviso</p>
					<span>Você precisa ser amigo de '.$nome.' para poder ver suas publicações.</span><br />
				</div>';
		}
	?>

	<br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>