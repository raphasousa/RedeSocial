<?php
	include("home.php");

	$id = $_GET["from"];
	$login_cookie = $_SESSION['emailUser'];

	$tudo = "SELECT * FROM usuario WHERE codigo='$id'";
	$result = $conexao->prepare($tudo);
    $result->execute();
    foreach($result as $saber);

	$email = $saber["email"];

	$sql = "SELECT * FROM mensagens WHERE para='$login_cookie' AND de='$email' OR de='$login_cookie' AND para='$email' ORDER BY id";
	$result = $conexao->prepare($sql);
    $result->execute();

	if (isset($_POST["send"])) {
		$msg = $_POST['text'];
		$data = date("Y/m/d");

		if ($_FILES["file"]["error"] > 0) {
			if ($msg=="") {
				echo "<h3>Digite a mensagem antes de enviar.</h3>";
			}else{
				$query = "INSERT INTO mensagens (`de`,`para`,`texto`,`status`,`data`) VALUES ('$login_cookie','$email','$msg',0,'$data')";
				$result2 = $conexao->prepare($query);
			    $result2->execute();
				if ($result2) {
					header("refresh:0;");
				}else{
					echo "<h3>Algo não correu muito bem ao enviar a sua mensagem.</h3>";
				}
			}
		}else{
			$n = rand (0, 10000000);
			$img = $n.$_FILES["file"]["name"];

			move_uploaded_file($_FILES['file']['tmp_name'], "upload/".$img);

			$query = "INSERT INTO mensagens (`de`,`para`,`texto`,`imagem`,`status`,`data`) VALUES ('$login_cookie','$email','$msg','$img','0','$data')";
			$result2 = $conexao->prepare($query);
    		$result2->execute();
			if ($result2) {
				header("Location: chat.php?from=".$id);
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao enviar a sua foto.');</script>";
			}
		}
	}
?>
<html>
	<head>
		<style type="text/css">
			h2{text-align: center; font-size: 32px; color: #4169E1;}
			h3{text-align: center; font-size: 25px; color: #666;}
			a{color: #4169E1; text-decoration: none;}
			div#box{display: block; margin: auto; width: 650px; height: 400px;}
			div#send{display: block; margin: auto; width: 650px; text-align: center; font-size: 20px;}
			div#send input[name="text"]{width: 430px; height: 35px; border: 1px solid #CCC; border-radius: 3px; font-size: 16px; padding-left: 10px;}
			div#send input[name="send"]{width: 100px; height: 35px; border: none; border-radius: 3px; font-size: 16px; background: #007fff; color: #FFF; cursor: pointer;}
			div#send input[name="send"]:hover{background: #001F3F;}
			div#send img{float: left; display: block; margin: auto; margin-top: -8px; margin-left: 30px; width: 50px; cursor: pointer;}
		</style>
	</head>
	<body>
		<br />
		<h2><a href="profile.php?id=<?php echo $id; ?>"><?php echo $saber["nome"]; ?></a></h2><br />
		<form method="POST" enctype="multipart/form-data">
			<div id="box">
				<object type="text/html" data="bubble.php?from=<?php echo $id; ?>#bottom" width="635px" height="390px" style="overflow: auto;"></object>
			</div>
			<br />
			<div id="send">
				<label for="file-input">
					<img src="img/imagegrey.png" title="Enviar uma imagem" />
				</label>
				<input type="text" name="text" placeholder="Escreva aqui a mensagem" autocomplete="off">&nbsp;&nbsp;&nbsp;
				<input type="submit" name="send" value="Enviar">
				
				<input type="file" id="file-input" name="file" hidden />
			</div>
		</form>
		<br />
	</body>
</html>