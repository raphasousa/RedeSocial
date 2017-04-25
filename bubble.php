<?php
	include("db.php");

	$login_cookie = $_COOKIE['login'];
	$id = $_GET['from'];

	$tudo = "SELECT * FROM usuario WHERE codigo='$id'";
	$result2 = $conexao->prepare($tudo);
    $result2->execute();
    foreach($result2 as $saber){
    	$email = $saber['email'];
    }

	$mysql = "UPDATE mensagens SET status = 1 WHERE para='$login_cookie' AND de='$email'";
	$update = $conexao->prepare($mysql);
    $update->execute();
?>
<html>
<head>
    <meta http-equiv="refresh" content="5;">
	<style type="text/css">
		html{
			font-family: Ubuntu, sans-serif;
			-webkit-animation: fadein 0s;
			-moz-animation: fadein 0s;
			-ms-animation: fadein 0s;
			-o-animation: fadein 0s;
			animation: fadein 0s;
		}

		.bubble{position: relative; margin-left: 300px; width: 300px; min-height: 60px; padding: 0px; background: #007fff; border-radius: 25px;}
		.bubble span{display: block; margin-left: auto; font-size: 14px; text-align: center; color: #FFF;}
		.bubble img{display: block; margin: auto; max-width: 95%;}
		.bubble p{display: block; margin: auto; font-size: 12px; text-align: center; color: #FFF;}

		.bubble2{position: relative; width: 300px; min-height: 60px; padding: 0px; background: #CCC; border-radius: 25px;}
		.bubble2 span{display: block; margin-left: auto; font-size: 14px; text-align: center; color: #333;}
		.bubble2 img{display: block; margin: auto; max-width: 95%;}
		.bubble2 p{display: block; margin: auto; font-size: 12px; text-align: center; color: #333;}
	</style>
</head>
<body>
	<?php
		$sql = "SELECT * FROM mensagens WHERE para='$login_cookie' AND de='$email' OR de='$login_cookie' AND para='$email'";
		$result3 = $conexao->prepare($sql);
	    $result3->execute();

	    foreach($result3 as $msg) {
			if ($msg['de']==$login_cookie) {
				if ($msg["imagem"]=="") {
					echo '<div class="bubble">
						<br />
						<span name="msg1">'.$msg["texto"].'</span>
						<br />
						<p>'.date('d/m/Y', strtotime($msg["data"])).'</p>
						<br />
					</div><br />';
				}else{
					echo '<div class="bubble">
						<br />
						<span name="msg1">'.$msg["texto"].'</span>
						<br />
						<img src="upload/'.$msg["imagem"].'" />
						<br />
						<p>'.date('d/m/Y', strtotime($msg["data"])).'</p>
						<br />
					</div><br />';
				}
			}else{
				if ($msg["imagem"]=="") {
					echo '<div class="bubble2">
						<br />
						<span name="msg1">'.$msg["texto"].'</span>
						<br />
						<p>'.date('d/m/Y', strtotime($msg["data"])).'</p>
						<br />
					</div><br />';
				}else{
					echo '<div class="bubble2">
						<br />
						<span name="msg1">'.$msg["texto"].'</span>
						<br />
						<img src="upload/'.$msg["imagem"].'" />
						<br />
						<p>'.date('d/m/Y', strtotime($msg["data"])).'</p>
						<br />
					</div><br />';
				}
			}
		}
	?>
	<a href="#" id="bottom"></a>
</body>
</html>