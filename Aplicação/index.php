<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
	<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
	<script src="js/script.js" type="text/javascript"></script>
	<link rel="sortcut icon" href="icon.png" type="image/x-icon">

	<title>Controle de Qualidade - Login</title>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<header>
		<h2>Controle de Qualidade</h2>
		<input type="checkbox" id="menu">
  		<label for="menu" class="menu">&#9776;</label>

		<nav class="menu-cabecalho">
			<ul>
				<a href="index.php"><li> Login </li></a> 
				<a href="cadastro.php"><li> Cadastro </li></a> 
				<a href="empresa.php"><li> Empresa </li></a>
			</ul>
		</nav>
	</header>
	
<div class="wrap">
    <div class="box">
    	<span onclick="fechar()">x</span>

    	<p id="txt"> Info</p>
    	<br>
    	<button type="submit" class="btn" onclick="fechar()">FECHAR</button>
    </div>
</div>


<form class="form inicio" onsubmit="event.preventDefault(); login_user();" id="form">
	<fieldset>
		<div class="row">
			<div class="form-group">
				<label>Login:</label>
				<input type="text" class="form-control-complete" id="login" placeholder="Ex.: CristianoSS" required>
			</div>
			<div class="form-group">
				<label>Senha:</label>
				<input type="password" class="form-control-complete" id="senha" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group-one">
				<button class="btn btn-primary">Entrar</button>
			</div>
		</div>
	</fieldset>
</form>
</body>
</html>
