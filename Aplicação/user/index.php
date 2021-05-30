<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
	<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
	<script src="../js/script.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="sortcut icon" href="../icon.png" type="image/x-icon">

	<title>Inicio</title>
</head>
<body>

	<header class="desktop"> 
		<h2>Controle de Qualidade</h2>

		<nav class="menu-user menu-cabecalho">
			<ul>
				<li>&#9881;</li>
				<a href="#"><li onclick="sair()">Sair</li></a>
			</ul>
		</nav>
	</header>

	<header class="mobile">
		<h2>Controle de Qualidade</h2>
		<input type="checkbox" id="menu">
  		<label for="menu" class="menu">&#x2699;</label>

		<nav class="menu-cabecalho menu-mobile">
			<ul>
				<a href="#"><li onclick="tela('form-avaria')" >AVARIA</li></a>
				<a href="#"><li onclick="tela('form-ccr')">CCR</li></a>
				<a href="#"><li onclick="tela('form-cce')">CCE</li></a><br><br>
				<a href="#"><li onclick="tela('form-recolha')">RECOLHA</li></a>
				<a href="#"><li onclick="sku(); tela('sku-consulta');">SKU</li></a>
				<a href="#"><li onclick="sair()">Sair</li></a>
			</ul>
		</nav>
	</header>

	<div class="form">
		<div class="menu-lateral">
			<ul>
				<li id="txt_avaria" onclick="tela('form-avaria')">AVARIA</li>
				<li id="txt_ccr" onclick="tela('form-ccr')">RECEBIMENTO</li>
				<li id="txt_cce" onclick="tela('form-cce')">EXPEDIÇÃO</li>
				<li id="txt_recolhe" onclick="tela('form-recolha')">RECOLHA</li><br>
				<li id="txt_SKU" onclick="sku(); tela('sku-consulta');">SKU</li>
			</ul>
		</div>

		<form id="form-avaria" class="telas form-avaria" onsubmit="event.preventDefault(); favaria();">
			<fieldset >
				<div class="row"  align="justify">
					<div class="form-group">
						<label>Placa:</label>
						<input type="text" class="form-control" id="placa_avaria" placeholder="Ex.: ACC-6445" required>

						<label>Carga:</label>
						<input type="text" class="form-control" id="carga_avaria" placeholder="Ex.: 15054" required>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group">
						<label>Produto: </label>
						<input type="text" class="form-control" id="produto_avaria" placeholder="Ex.: Monitor DELL" required>
						<label>Motivo: </label>
						<input type="text" class="form-control" id="motivo_avaria" placeholder="Ex.: Avaria" required>
					</div>
				</div>

				<div class="row line">
						<label for="img1-avaria" id="lbl1" class="form-control line" required style="cursor: pointer;">1° Imagem**</label>
						<label for="img2-avaria" id="lbl2" class="form-control line" style="display: none; cursor: pointer;">2° Imagem</label>
						<label for="img3-avaria" id="lbl3" class="form-control line" style="display: none; cursor: pointer;">3° Imagem</label>
						<label for="img4-avaria" id="lbl4" class="form-control line" style="display: none; cursor: pointer;">4° Imagem</label>
					<br><br>
					<div class="addimagens form-group-one">
  						<input id="img1-avaria" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,1,'output1-avaria')" required>
  						
  						<input id="img2-avaria" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,2,'output2-avaria')">

  						
  						<input id="img3-avaria" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,3,'output3-avaria')">

  						
  						<input id="img4-avaria" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,4,'output4-avaria')">

						<img id="output1-avaria" class="output" >
						<img id="output2-avaria" class="output" >
						<img id="output3-avaria" class="output" >
						<img id="output4-avaria" class="output" >
					</div>
				</div>

								
				
				<div class="form-group" align="center">
					<button type="submit" class="btn btn_add">Enviar</button>
					<button type="reset" class="btn">Cancelar</button>
				</div>
			</fieldset>
		</form>

		<form id="form-ccr" class="telas form-ccr" onsubmit="event.preventDefault(); fccr();">
			<fieldset>
				<div class="row"  align="justify">
					<div class="form-group">
						<label>Placa:</label>
						<input type="text" class="form-control" id="placa_ccr" placeholder="Ex.: ACC-6445" required>

						<label>Carga:</label>
						<input type="text" class="form-control" id="carga_ccr" placeholder="Ex.: 15054" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label>Produto: </label>
						<input type="text" class="form-control" id="produto_ccr" placeholder="Ex.: Monitor DELL" required>
						<label>Cliente: </label>
						<input type="text" class="form-control" id="cliente_ccr" placeholder="Ex.: Avaria" required>
					</div>
				</div>

				<div class="row line">
					<div class="form-group-one addimagens">
						
						<label for="img1-ccr" class="form-control line">1° Imagem</label>
						<label for="img2-ccr" id="lbl2" class="form-control line" style="display: none;">2° Imagem</label>
						<label for="img3-ccr" id="lbl3" class="form-control line" style="display: none;">3° Imagem</label>
						<label for="img4-ccr" id="lbl4" class="form-control line" style="display: none;">4° Imagem</label>
						<br><br>
  						<input id="img1-ccr" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,1,'output1-ccr')">
  						
  						<input id="img2-ccr" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,2,'output2-ccr')">
  						
  						<input id="img3-ccr" type="file" accept="image/png, image/jpeg"  style="display: none;" onchange="loadFile(event,3,'output3-ccr')">

  						<input id="img4-ccr" type="file" accept="image/png, image/jpeg"  style="display: none;" onchange="loadFile(event,4,'output4-ccr')">

						<img id="output1-ccr" class="output" >
						<img id="output2-ccr" class="output" >
						<img id="output3-ccr" class="output" >
						<img id="output4-ccr" class="output" >
					</div>
				</div>

								
				
				<div class="form-group" align="center">
					<button type="submit" class="btn btn_add">Enviar</button>
					<button type="reset" class="btn">Cancelar</button>
				</div>
			</fieldset>
		</form>

		<form id="form-cce" class="telas form-cce" onsubmit="event.preventDefault(); fcce();">
			<fieldset>
				<div class="row"  align="justify">
					<div class="form-group">
						<label>Placa:</label>
						<input type="text" class="form-control" id="placa_cce" placeholder="Ex.: ACC-6445" required>

						<label>OE:</label>
						<input type="text" class="form-control" id="oe_cce" placeholder="Ex.: 15054" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label>Conferente: </label>
						<input type="text" class="form-control" id="confe_cce" placeholder="Ex.: Monitor DELL" required>
						<label>Cliente: </label>
						<input type="text" class="form-control" id="cliente_cce" placeholder="Ex.:Avaria" required>
					</div>
				</div>

				<div class="row line">
					<div class="addimagens form-group-one">
						<label for="img1-cce" class="form-control line">1° Imagem</label>
						<label for="img2-cce" id="lbl2" class="form-control line" style="display: none;">2° Imagem</label>
						<br><br>
  						<input id="img1-cce" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,1, 'output1-cce')">
  						
  						<input id="img2-cce" type="file" accept="image/png, image/jpeg" style="display: none;" onchange="loadFile(event,2,'output2-cce')">

						<img id="output1-cce" class="output" >
						<img id="output2-cce" class="output" >
					</div>
				</div>
								
				
				<div class="form-group" align="center">
					<button type="submit" class="btn btn_add">Enviar</button>
					<button type="reset" class="btn">Cancelar</button>
				</div>
			</fieldset>
		</form>

		<form id="form-recolha" class="telas form-recolha" onsubmit="event.preventDefault(); frecolha();">
			<fieldset>
				<div class="row"  align="justify">
					<div class="form-group">
						<label>Placa:</label>
						<input type="text" class="form-control" id="placa_rac" placeholder="Ex.: ACC-6445" required>

						<label>N°:</label>
						<input type="text" class="form-control" id="num_rac" placeholder="Ex.: 15054" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label>Produto: </label>
						<input type="text" class="form-control" id="produto_rac" placeholder="Ex.: Monitor DELL" required>
						<label>Motivo: </label>
						<input type="text" class="form-control" id="motivo_rac" placeholder="Ex.: Avaria" required>
					</div>
				</div>				
				<div class="row">
					<div class="form-group" align="center">
						<button type="submit" class="btn btn_add">Enviar</button>
						<button type="reset" class="btn">Cancelar</button>
					</div>
				</div>
			</fieldset>
		</form>

		<form id="sku-consulta" class="telas sku-consulta">
			<br><br>
			<fieldset class="sku">
				
				<div class="row">
					<table>
						<tr>
							<th>Carga</th>
							<th>Processo</th>
							<th>Login</th>
							<th>Data</th>
							<th>&#x1f441;</th>
						</tr>
					</table>
					<div class="consulta form-group">
						<table id="tabela_sku">

						</table>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</body>
</html>