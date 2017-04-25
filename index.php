<?php
	include("home.php");

	if (isset($_POST['publish'])) {
		if ($_FILES["file"]["error"] > 0) {

			$email = $_SESSION['emailUser'];
		    $texto = $_POST["texto"];
			$hoje = date("Y-m-d");

			if ($texto == "") {
				echo '<br /><div id="footer"><p>Escreva alguma coisa antes de publicar!</p></div>';
			}else{
				$select = "INSERT INTO post (user, texto, data) VALUES (:email, :texto, :hoje)";
				$result = $conexao->prepare($select);
			    $result->bindParam(':email', $email, PDO::PARAM_STR); 
			    $result->bindParam(':texto', $texto, PDO::PARAM_STR);
			    $result->bindParam(':hoje', $hoje, PDO::PARAM_STR);
			    $result->execute();
				if ($result) {
					echo '<br /><div id="footer"><p>Publicado com sucesso!</p></div>';
				}else{
					echo "<h3>Algo não correu como esperávamos.</h3>";
				}
			}
		}else{
			$n = rand(0, 1000000);
			$img = $n.$_FILES["file"]["name"];

			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$img);

			$email = $_SESSION['emailUser'];
		    $texto = $_POST["texto"];
			$hoje = date("Y-m-d");

			if ($texto == "") {
				echo '<br /><div id="footer"><p>Escreva alguma coisa antes de publicar!</p></div>';
			}else{
				$select = "INSERT INTO post (user, texto, imagem, data) VALUES (:email, :texto, :img, :hoje)";
			    $result = $conexao->prepare($select);
			    $result->bindParam(':email', $email, PDO::PARAM_STR); 
			    $result->bindParam(':texto', $texto, PDO::PARAM_STR);
			    $result->bindParam(':img', $img, PDO::PARAM_STR);
			    $result->bindParam(':hoje', $hoje, PDO::PARAM_STR);
			    $result->execute();
			    if ($result) {
					echo '<br /><div id="footer"><p>Publicado com sucesso!</p></div>';
				}else{
					echo "<h3>Algo não correu como esperávamos.</h3>";
				}
			}
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
		img#profile2{float: left; margin-top: 0px; width: 20px; height: 20px;}
		
		div#publish{width: 400px; height: 210px; display: block; margin: auto; border: none; border-radius: 5px; background: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
		div#publish textarea{width: 365px; height: 150px; display: block; margin: auto; border-radius: 5px; padding-left: 5px; padding-top: 5px; border-width: 1px; border-color: #A1A1A1;}
		div#publish img{margin-top: 0px; margin-left: 10px; width: 40px; cursor: pointer;}
		div#publish input[type="submit"]{width: 70px; height: 25px; border-radius: 3px; float: right; margin-right: 15px; border: none; margin-top: 5px; background: #4169E1; color: #FFF; cursor: pointer;}
		div#publish input[type="submit"]:hover{background: #001F3F;}

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
	<div id="publish">
		<form method="POST" enctype="multipart/form-data">
			<br />
			<textarea placeholder="Escreva uma nova publicação" name="texto"></textarea>
			<label for="file-input">
				<img src="img/imagegrey.png" title="Inserir uma imagem" />
			</label>
			<input type="submit" value="Publicar" name="publish" />

			<input type="file" id="file-input" name="file" hidden />
		</form>
	</div>
	
	<?php
		$login_cookie = $_SESSION['emailUser'];
		$pubs = "SELECT DISTINCT
					T.codigo, 
				    T.user, 
				    T.texto, 
				    T.imagem, 
				    T.data
				 FROM
				    post AS T,
				    amizades AS U 
				 WHERE
				    T.user = U.de AND U.para = '$login_cookie' AND U.aceite='sim'
				    OR T.user = U.para AND U.de = '$login_cookie' AND U.aceite='sim'
				    OR T.user = '$login_cookie'
				 ORDER BY T.codigo DESC;";

		$result = $conexao->prepare($pubs);
	    $result->execute();
	    foreach($result as $pub) {
			$email = $pub['user'];
			$select = "SELECT * FROM usuario WHERE email='$email'";
            $result2 = $conexao->prepare($select);
            $result2->execute();
            foreach($result2 as $saber) {
				$nome = $saber['nome'];
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
			}
		}
	?>

	<br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>