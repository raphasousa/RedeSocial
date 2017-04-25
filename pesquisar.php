<?php
	include("home.php");
?>
<html>
<header>
	<style type="text/css">
		h2{text-align: center; padding-top: 30px; color: #4169E1;}
		hr{border: 1px solid #666; width: 500px; display: block; margin: auto;}
		img#profile2{float: center; margin-top: 15px; width: 80px; height: 80px;}
		div.pub{width: 400px; min-height: 70px; max-height: 1000px; display: block; margin: auto; border: none; border-radius: 5px; background-color: #FFF; box-shadow: 0 0 6px #A1A1A1; margin-top: 30px; text-align: center;}
		div.pub a{color: #666; text-decoration: none;}
		div.pub a:hover{color: #4169E1; text-decoration: none;}
		div.pub p{content: #666; text-align: center;}
		div.pub span{display: block; margin: auto; padding-top: 20px; text-align: center; font-size: 24px;}
	</style>
</header>
<body>
	<?php
		$query = $_GET['query'];

		$min_length = 1;

		if (strlen($query) >= $min_length) {
			$query = htmlspecialchars($query);

			$select = "SELECT * FROM usuario WHERE (`nome` LIKE '%".$query."%')";
		    $result = $conexao->prepare($select);
		    $result->execute();
		    $count = $result->rowCount(); 
		    if ($count > 1) {
		    	echo '<h2>Foram encontrados '.$count.' resultados na sua pesquisa:</h2>';
		    }elseif($count == 1){
		    	echo '<h2>Foi encontrado apenas '.$count.' resultado na sua pesquisa:</h2>';
		    }

			if ($count > 0) {
				foreach($result as $results) {
					echo '<div class="pub">';
							if ($results["foto"]=="") {
								echo '<a href="profile.php?id='.$results["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="img/perfil.png" id="profile2"></a>';
							}else{
								echo '<a href="profile.php?id='.$results["codigo"].'" style="width: 80px; display: block; margin: auto;"><img src="upload/'.$results["foto"].'" id="profile2"></a>';
							}
						echo '<p><a href="profile.php?id='.$results["codigo"].'" name="p"><p name="p"><span>'.$results["nome"].'</span></p></a></p><br />
					</div>';
				}
			}else{
				echo "<br /><h2>Nenhum resultado encontrado.</h2>";
			}
		}else{
			echo '<br /><h2>Escreva pelo menos uma letra.</h2>';
		}
	?>

	<br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
</body>
</html>