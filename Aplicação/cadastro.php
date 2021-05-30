<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
	 <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
	<script src="js/script.js" type="text/javascript"></script>
	<link rel="sortcut icon" href="icon.png" type="image/x-icon">

	<title>Cadastro</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<header>
		<h2>Controle de Qualidade</h2>
		<input type="checkbox" id="menu">
  		<label for="menu" class="menu">&#9776;</label>

		<nav class="menu-cabecalho">
			<ul>
				<a href="index.php"><li>Login</li></a> 
				<a href="cadastro.php"><li>Cadastro</li></a> 
				<a href="empresa.php"><li>Empresa</li></a>
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


<form class="form cadastro" onsubmit="event.preventDefault(); cadastro();" id="form">
	<fieldset>
		<div class="row">
			<div class="form-group">
				<label>Nome:</label>
				<input type="text" class="form-control" id="nome" placeholder="Ex.: Cristiano Silva" required>

				<label>Login: </label>
				<input type="text" class="form-control" id="login" placeholder="Ex.: CristianoSS" onblur="consulta()" required>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Senha:</label>
				<input type="password" class="form-control" id="new-password" placeholder="Senha" required>

				<label>Senha: </label>
				<input type="password" class="form-control" id="con-senha" placeholder="Confirme Sua Senha" required autocomplete="off" onblur="senha()">
				<span class="erro" id="erro_senha">Senhas não Compativeis</span>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Email: </label>
				<input type="email" class="form-control" id="e-email" placeholder="Insira seu Email aqui" required>

				<label>Email: </label>
				<input type="email" class="form-control" id="con_email" placeholder="Confirme seu Email" required onblur="email()">
				<span class="erro" id="erro_email">Email estão diferentes</span>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label class="line">Data de <p></p>Nascimento:	</label>
				<input type="date" class="form-control" id="data_nas" placeholder="Insira seu emai aqui" required>

				<label>CNJP:	</label>
				<input type="text" class="form-control" id="empresa" placeholder="Insira sua Empresa aqui" required>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label>Setor:	</label>
				<input type="text" class="form-control" id="setor" placeholder="Insira seu Setor aqui" required>

				<label>Cargo:	</label>
				<input type="text" class="form-control" id="cargo" placeholder="Insira seu Cargo aqui" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group-one">
				<button type="submit" class="btn btn-primary">Enviar</button>
				<button class="btn btn-danger">Cancelar</button>
			</div>
		</div>
	</fieldset>
</form>
</body>
</html>