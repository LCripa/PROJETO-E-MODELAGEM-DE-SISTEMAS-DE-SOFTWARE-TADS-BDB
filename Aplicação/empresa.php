<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
	 <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
	<script src="js/script.js" type="text/javascript"></script>
	<link rel="sortcut icon" href="icon.png" type="image/x-icon">

	<title>Tela Cadastro</title>
	
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

    	<p id="txt"></p>
    	<br>
    	<button type="submit" class="btn" onclick="fechar()">FECHAR</button>
    </div>

</div>


<form id="form" class="form empresa" method="post" onsubmit="event.preventDefault(); cadempresa();" >
	<fieldset>
		<div class="row">
			<div class="form-group">
				<label>CNPJ: </label>
				<input type="text" class="form-control" id="cnpj" maxlength="18" placeholder="12.345.678/0001-90" onblur="validar()">
				<label>Razão Social: </label>
				<input type="text" class="form-control" id="nome" placeholder="Ex.: CristianoSS" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label>E-mail: </label>
				<input type="email" class="form-control" id="email" placeholder="Ex.: Cristiano@cris.com" required>

				<label>Telefone: </label>
				<input type="text" class="form-control" maxlength="15" id="tel" placeholder="Ex.: (11)91234-5678" required >
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label>CEP:</label>
				<input type="text" id="cep" class="form-control" maxlength="10" onblur="pesquisacep();" placeholder="Ex.: 00000-000"/>
               	<label>Rua:	</label>
				<input type="text" id="rua" class="form-control" placeholder="Ex.: ABC"/>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label>Numero: </label>
				<input type="text" id="numero" maxlength="4"  class="form-control" placeholder="Ex.:123"/>

				<label>Bairro:</label>
        		<input type="text" id="bairro" class="form-control" placeholder="Ex.: AlfaNumerico"/>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Complemento: </label>
				<input type="text" class="form-control" id="complemento" placeholder="Galpão A">
				<label>Cidade: </label>
				<input name="cidade" type="text" id="cidade"  class="form-control" placeholder="Ex.:Alfa"/>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				
				<label>Estado: </label>
				<input type="text" id="uf" class="form-control"/>
				<label>Fundação: </label>
				<input name="cidade" type="date" id="fundacao"  class="form-control" placeholder="Ex.:Alfa"/>
			</div>
		</div>

		<div class="row">
			<div class="form-group-one">
				<button type="submit" class="btn btn-primary">Enviar</button>
				<button type="reset" class="btn btn-danger">Cancelar</button>
			</div>
		</div>
	</fieldset>
</form>
</body>
</html>