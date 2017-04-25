<?php
	include("home.php");
?>
<html>
	<header>
		<style type="text/css">
			img#profile2{float: left; margin-left: 10px; margin-top: 0px; width: 20px; height: 20px;}
			div#box a[name="d"]{margin-left: 5px; color: #666; text-decoration: none;}
			div#box a[name="d"]:hover{color: #4169E1; text-decoration: none;}
			div#box p{margin-left: 10px; color: #333;}
			div#box{min-width: 100px; max-width: 500px; display: block; margin: auto;}
			div#box:hover{box-shadow: inset 0 0 6px #AAA; border-radius: 5px;}
			hr{width: 500px; display: block; margin: auto; border: 1px solid #555;}
			h1{text-align: center; color: #4169E1;}
			h3{text-align: center; color: #AAA;}
		</style>
	</header>
	<body>
		<br />
		<h1>Conversas</h1><br />
		<form method="POST">
			<div>
				<?php
					$login_cookie = $_SESSION['emailUser'];
					$sql = "SELECT * FROM mensagens WHERE para='$login_cookie' GROUP BY de ORDER BY id";
					$result = $conexao->prepare($sql);
				    $result->execute();
				    foreach($result as $msg) {
						$from = $msg["de"];
						$tudo = "SELECT * FROM usuario WHERE email='$from'";
						$result2 = $conexao->prepare($tudo);
					    $result2->execute();
					    foreach($result2 as $img);

						$conta = "SELECT * FROM mensagens WHERE de='$from' AND para='$login_cookie' AND status=0";
						$result3 = $conexao->prepare($conta);
					    $result3->execute();
					    $contar = $result3->rowCount(); 

						if ($contar > 1) {
							$texto = $contar.' novas mensagens';
						}elseif ($contar == 1) {
							$texto = '1 nova mensagem';
						}else {
							$texto = 'Nenhuma nova mensagem';
						}

						echo '<div id="box">
								<br /><p>';
								if ($img["foto"]=="") {
									echo '<a href="profile.php?id='.$img["codigo"].'" style="width: 20px; display: block;"><img src="img/perfil.png" id="profile2">';
								}else{
									echo '<a href="profile.php?id='.$img["codigo"].'" style="width: 20px; display: block;"><img src="upload/'.$img["foto"].'" id="profile2">';
								}
								echo '<a name="d" href="chat.php?from='.$img["codigo"].'">'.$img["nome"].' - '.$texto.'</a></p><br />
								</div>';
					}
				?>
			</div>
		</form>
	<br /><hr /><br /><br />
	<div id="footer"><p>&copy; A Rede Social, 2016 - Todos os direitos reservados</p></div><br />
	</body>
</html>