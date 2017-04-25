<?php
    session_start();
    ob_start();
    include("db.php");
    if(!isset($_SESSION['emailUser']) && !isset($_SESSION['senhaUser'])){
      $redirect = "login.php";
      header("location:$redirect");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
		*{font-family: 'Montserrat', cursive; margin: 0;}
		body{background: #F6F6F6;}
		div#topo{width: 100%; top: 0; background: #FFF; box-shadow: 0 0 10px #000; height: 95px;}
		div#topo img[name="logo"]{float: left; margin-left: 20px; margin-top: 10px;}
		div#topo img[name="menu"]{float: right; margin-right: 25px; margin-top: -22px;}
		div#topo input[type="text"]{border: 1px solid #CCC; width: 300px; height: 25px; padding-left: 10px; border-radius: 3px; display: block; margin: auto;}
		
		div#topo form{width: 300px; display: block; margin: auto; padding-top: 35px;}
		div#footer{bottom: 0; text-align: center; color: #666;}

		div#topo img#perfil{float: left; margin-top: -3px; margin-left: -3px; width: 25px; height: 25px;}
		div#topo ul{float: right; margin-right: 100px; margin-top: -25px; padding: 0; list-style: none; width: 200px;}
		div#topo ul li{position: relative;}
    	div#topo li ul{position: absolute; top: 56; display: none;}
    	div#topo ul li a{display: block; text-decoration: none; color: #666; background: #F6F6F6; padding: 5px; border: 1px solid #ccc;}
    	div#topo li:hover ul{display: block;}
    	div#topo ul li a:hover{text-decoration: none; color: #111;}
	</style>
</head>
<body>
	<div id="topo">
		<a href="index.php"><img src="img/logo.png" width="80" height="80" name="logo"></a>
		<form method="GET" action="pesquisar.php">
			<input type="text" placeholder="Pesquisar" name="query" autocomplete="off"><input type="submit" hidden>
		</form>

		<!-- top navigation -->
		<?php 
		 	$email = $_SESSION['emailUser'];
		  	$select = "SELECT * FROM usuario WHERE email ='$email'";
		  	$result = $conexao->prepare($select);
		  	$result->execute();
		  	foreach($result as $valor){
		    	$nome = $valor["nome"];
		 	}

		 	$msg = "SELECT * FROM mensagens WHERE para='$email' AND status=0";
			$result2 = $conexao->prepare($msg);
		    $result2->execute();
		    $count_msg = $result2->rowCount();

		    $pedidos = "SELECT * FROM amizades WHERE para='$email' AND aceite='nao'";
		    $result3 = $conexao->prepare($pedidos);
		    $result3->execute();
		    $count_pedidos = $result3->rowCount();
        ?>
        <ul id="nav">
		    <li>
		    	<a href="myprofile.php">
		    	<?php
					if ($valor["foto"]=="") {
						echo '<img src="img/perfil.png" alt="" id="perfil">';
					}else{
						echo '<img src="upload/'.$valor["foto"].'" alt="" id="perfil">';
					}
					echo $valor["nome"]; 
				?>
			    </a>
		      <ul>
		        <li><a href="pedidos.php">Solicitações (<?php echo $count_pedidos; ?>)</a></li>
		        <li><a href="inbox.php">Inbox (<?php echo $count_msg; ?>)</a></li>
		        <li><a href="logout.php">Sair</a></li>
		      </ul>
		    </li>
		</ul>
        <!-- /top navigation -->
	</div>
</body>
</html>