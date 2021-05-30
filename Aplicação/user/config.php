<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

	<script type='text/javascript' src='https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>

	<script src="../js/script.js" type="text/javascript"></script>

	<link rel="sortcut icon" href="../icon.png" type="image/x-icon">

	<title>Configurações</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body onload="config();">
	<header class="desktop"> 
		<h2>Informações</h2>

		<nav class="menu-user menu-cabecalho">
			<ul>
				<a href="index.php"><li>Inicio</li></a>
				<a href="#"><li onclick="sair()">Sair</li></a>
			</ul>
		</nav>
	</header>

	<header class="mobile">
		<h2>Informações</h2>
		<input type="checkbox" id="menu">
  		<label for="menu" class="menu">&#x2699;</label>

		<nav class="menu-cabecalho menu-mobile">
			<ul>
				<a href="#"><li onclick="tela('form-avaria')" >AVARIA</li></a>
				<a href="#"><li onclick="tela('form-ccr')">CCR</li></a>
				<a href="#"><li onclick="tela('form-cce')">CCE</li></a><br><br>
				<a href="#"><li onclick="tela('form-recolha')">RECOLHA</li></a>
				<a href="#"><li onclick="sku(); tela('sku-consulta');">SKU</li></a>
				<a href="index.php"><li>inicio</li></a>
				<a href="#"><li onclick="sair()">Sair</li></a>
			</ul>
		</nav>
	</header>
	
<div class="wrap">
    <div class="box">
    	<span onclick="fechar()">x</span>
    	<p id="txt">Info</p>
    	<br>
    	<button type="submit" class="btn" onclick="fechar()">FECHAR</button>
    </div>

</div>


<form class="form cadastro" id="form" onsubmit="event.preventDefault();">
	<fieldset>
		<div class="row">
			<div class="form-group">
				<label>Nome:</label>
				<input type="text" class="form-control" id="nome-conf" placeholder="Ex.: Cristiano Silva" disabled="">

				<label>Login: </label>
				<input type="text" class="form-control" id="login-conf" placeholder="Ex.: CristianoSS" disabled="">
			</div>

			<div class="form-group-one">
				<button class="btn btn-primary" id="btnlogin" onclick="loginConfig()">Mudar Login</button>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="form-group">
				<label>Nova Senha:</label>
				<input type="password" class="form-control" id="new-password" placeholder="Senha" disabled="">

				<label>Repita a Senha: </label>
				<input type="password" class="form-control" id="con-password" placeholder="Confirme Sua Senha" autocomplete="off" onblur="senha()" disabled="">
				<span class="erro" id="erro_senha">Senhas não Compativeis</span>
			</div>

			<div class="form-group-one">
				<button class="btn btn-primary" id="btnsenha" onclick="senhaConfig()">Mudar Senha</button>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="form-group">
				<label>Email: </label>
				<input type="email" class="form-control" id="email" placeholder="Insira seu Email aqui" disabled="">
			</div>

			<div class="form-group-one">
					<button class="btn btn-primary" id="btnmail" onclick="mailConfig()">Mudar Email</button>
			</div>

		</div>
		
		<hr>

		<div class="row">
			<div class="form-group">
				<label>Setor:	</label>
				<input type="text" class="form-control" id="setor" placeholder="Insira seu Setor aqui" disabled="">

				<label>Cargo:	</label>
				<input type="text" class="form-control" id="cargo" placeholder="Insira seu Cargo aqui" disabled="">

				<div class="form-group-one">
					<button class="btn btn-primary" id="btncargo" onclick="ambosConfig()">Alterar Informações</button>
				</div>
			</div>
		</div>
	</fieldset>
</form>
</body>
</html>