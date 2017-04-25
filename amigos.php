<?php
	include("home.php");
?>
<html>
<header>
	<style type="text/css">
		h2{text-align: center; padding-top: 30px; color: #007fff;}
		div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px;}
		div.pub a{color: inherit; text-decoration: none;}
		div.pub a:hover{color: #007fff; text-decoration: none;}
		div.pub p{text-align: center; color: #666; padding-top: 10px;}
		div.pub span{display: block; margin: auto; width: 380px; margin-top: 10px; text-align: center; font-size: 24px;}
		img#profile2{float: center; margin-top: 15px; width: 80px; height: 80px;}
	</style>
</header>
<body>
	<?php
		$login_cookie = $_SESSION['emailUser'];
		$select = "SELECT * FROM amizades WHERE de='$login_cookie' OR para='$login_cookie' ORDER BY id desc;";
		$result = $conexao->prepare($select);
	    $result->execute();
	    $amigos = $result->rowCount();
	    echo '<h2>Amigos ('.$amigos.')</h2>';

	    foreach($result as $pub) {
			if ($pub['de'] == $login_cookie) {
				$para = $pub['para'];
				$select = "SELECT * FROM usuario WHERE email = '$para';";
				$info = $conexao->prepare($select);
			    $info->execute();
			    foreach($info as $amigoinfo) {
			    	$id = $amigoinfo['codigo'];
			    }
				echo '<div class="pub">';
					if ($amigoinfo["foto"]=="") {
						echo '<a href="profile.php?id='.$amigoinfo["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="img/perfil.png" id="profile2"></a>';
					}else{
						echo '<a href="profile.php?id='.$amigoinfo["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="upload/'.$amigoinfo["foto"].'" id="profile2"></a>';
					}
					echo '<span><a href="profile.php?id='.$amigoinfo['codigo'].'">'.$amigoinfo['nome'].'</a></span>
						  <p>Amigos desde: '.date('d/m/Y', strtotime($pub["data"])).'</p><br />
				</div>';
			}else{
				$de = $pub['de'];
				$select = "SELECT * FROM usuario WHERE email = '$de';";
				$info = $conexao->prepare($select);
			    $info->execute();
			    foreach($info as $amigoinfo) {
			    	$id = $amigoinfo['codigo'];
			    }
				echo '<div class="pub">';
					if ($amigoinfo["foto"]=="") {
						echo '<a href="profile.php?id='.$amigoinfo["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="img/perfil.png" id="profile2"></a>';
					}else{
						echo '<a href="profile.php?id='.$amigoinfo["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="upload/'.$amigoinfo["foto"].'" id="profile2"></a>';
					}
					echo '<span><a href="profile.php?id='.$amigoinfo['codigo'].'">'.$amigoinfo['nome'].'</a></span>
						  <p>Amigos desde: '.date('d/m/Y', strtotime($pub["data"])).'</p><br />
				</div>';
			}
		}
	?>
	<br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>