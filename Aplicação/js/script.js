$(document).ready(function() {

	$("#cnpj").mask("00.000.000/0000-00");
	$("#empresa").mask("00.000.000/0000-00");
	$("#tel").mask("(00)0000-00000");
	$("#cep").mask("00000-000");
	$("#carga_avaria").mask("0000000000");
	$("#carga_cce").mask("0000000000");
	$("#carga_ccr").mask("0000000000");
	$("#num_rec").mask('0000000000');
	$("#placa_avaria").mask('SSS-0A00');
	$("#placa_ccr").mask('SSS-0A00');
	$("#placa_cce").mask('SSS-0A00');
	$("#placa_rec").mask('SSS-0A00');
	$("#placa_rac").mask('SSS-0A00');
	
});

function loadFile(event,ident,id) {
	var reader = new FileReader();
	if(ident<4){
		liberar="lbl"+(ident+1);
		document.getElementById(liberar).style.display="table-cell";
	}

	var aliImg=0;
    var imagem = document.getElementById(id);
    imagem.src=URL.createObjectURL(event.target.files[0]);

	  var xhr = new XMLHttpRequest();
	  xhr.onload = function() {
	    var reader = new FileReader();
	    reader.onloadend = function() {
	      imagem.alt=reader.result;
	    }
	    reader.readAsDataURL(xhr.response);
	  };
	  xhr.open('GET', imagem.src);
	  xhr.responseType = 'blob';
	  xhr.send();


	document.getElementById(id).style.display="block";
}


function fechar() {
	document.querySelector(".wrap").style.display = "none";
}

function erro(argument) {
	document.getElementById("txt").innerHTML=argument;
	document.querySelector(".wrap").style.display = "block";
}


// consultar igualdade de entradas
function senha() {
	var id1=document.getElementById('new-password');
	var id2=document.getElementById('con-senha');

	if (id1.value != id2.value){
		erro("Senhas não Compativeis");
	}
}

function email() {

	var id1=document.getElementById('e-email').value;
	var id2=document.getElementById('con_email').value;

	if (id1.toLowerCase() != id2.toLowerCase()){
		erro("E-mail não Compativeis");
	}
}
//

//consultar se existe o msm usuario cadastrado
function consulta() {
	var q='consulta';
	var user = document.getElementById('login').value;
	var dados={'q':q,'user':user};
	$.ajax({	
        url: "../backend.php",
        method: "POST",                    
        data: dados,
        success: function(ressult) {
        	if (ressult){
        		document.getElementById('login').value="";
        		erro("Esse login ja existe!");
        	}
				
        		
			
        }
    });
}

function consulta_cnpj() {
	var q='consulta_cnpj';
	var cnpj = document.getElementById('empresa');
	var dados={'q':q,'cnpj':cnpj.value};
	$.ajax({	
        url: "./backend.php",
        method: "POST",                    
        data: dados,
        success: function(ressult) {
        	if (ressult)
				document.getElementById('cnpj').style.display="block";
        	else
        		document.getElementById('cnpj').style.display="none";
        }
    });
}
function consultacad_cnpj() {
	var q='consulta_cnpj';
	var cnpj = document.getElementById('cnpj').value;
	cnpj=cnpj.replace(/[^\d]/g, "");

	var dados={'q':q,'cnpj':cnpj};
	
	$.ajax({	
       	url: "./backend.php",
        method: "POST",
        type: "POST",
        async: false, 

        data: dados,
        success: function(ressult) {
        	if (ressult=="1")
				return false;
        	else
        		return true;
        }
    });
}

// CEP
function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            alert("CEP não encontrado.");
        }
}
function pesquisacep() {

        //Nova variável "cep" somente com dígitos.
        var valor=document.getElementById("cep").value;
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
            	document.getElementById('rua').value=("");
           		document.getElementById('bairro').value=("");
            	document.getElementById('cidade').value=("");
            	document.getElementById('uf').value=("");
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
        }
}

//Validadndo CNPJ
function validar() {
	var valor=document.getElementById("cnpj").value;
	if(valiCnpj(valor)==false){
		document.getElementById('cnpj').focus();
		erro("Revise seu CNPJ");
	}else if(consultacad_cnpj()==false){
		document.getElementById('cnpj').value="";
		erro("CNPJ ja se encontra no Sistema");

	}
}

function valiCnpj(val) {
	
    cnpj = val.replace(/[^\d]/g, "");
 
    if(cnpj == "") return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}

//fazendo login e cadastrando
function login_user(){

	var q='login';
	var user = document.getElementById('login').value;
	var senha = document.getElementById('senha').value;;

	var dados ={'q':q, 'user': user ,'senha':senha};
	$.ajax({	
        url: "./backend.php",
        method: "POST",
        data: dados,
        success: function(ressult) {
        	if (ressult=="1"){
				window.location.href = "user/index.php";
			}else if(!ressult){
				window.location.href = "user/index.php";
			}else{
				erro(ressult);
			}
        }
    });
	return false;
}

function cadastro(){

	var q='cadastro';
	var nome = document.getElementById('nome').value;
	var login = document.getElementById('login').value;
	var senha = document.getElementById('new-password').value;
	var email = document.getElementById('e-email').value;
	var nasc = document.getElementById('data_nas').value;
	var empresa = document.getElementById('empresa').value;
	empresa=empresa.replace(/[^\d]/g, "");
	var setor = document.getElementById('setor').value;
	var cargo = document.getElementById('cargo').value;

	var dados ={'q':q, 'nome': nome ,'login':login,'senha':senha,'email':email,'nasc':nasc, 
			'empresa':empresa,'setor':setor,'cargo':cargo};


	$.ajax({	
        url: "./backend.php",
        method: "POST",
        dataType : "text",
        data: dados,
        success: function(ressult) {
			if (ressult=="1"){
				document.getElementById('form').reset();
				erro("Cadastro Realizado Com Sucesso");
				//window.location.href = "index.php";
			}

			else{
				document.getElementById('form').reset();
				erro(ressult);
			}
        }
    });
}

function cadempresa() {


	var complemeto="";
	var q='cad_empresa';
	var cnpj = document.getElementById('cnpj').value;
	cnpj=cnpj.replace(/[^\d]/g, "");
	var razao = document.getElementById('nome').value;
	var email = document.getElementById('email').value;
	var tele = document.getElementById('tel').value;
	tele=tele.replace(/[^\d]/g, "");

	var cep = document.getElementById('cep').value;
	cep=cep.replace(/[^\d]/g, "");
	var cidade = document.getElementById('cidade').value;
	var numero = document.getElementById('numero').value;
	
	var rua = document.getElementById('rua').value;
	complemeto = document.getElementById('complemento').value;
	var bairro = document.getElementById('bairro').value;
	var uf = document.getElementById('uf').value;
	var fundacao = document.getElementById('fundacao').value;


	var endereco =rua+", "+bairro+", "+uf+","+complemeto;

	var dados ={'q':q, 'cnpj':cnpj,'razao':razao,'email':email,'tele':tele,'cep':cep,'cidade':cidade,
			'numero':numero,'endereco':endereco,'fundacao':fundacao};
	$.ajax({	
        url: "./backend.php",
        method: "POST",
        dataType : "text",             
        data: dados,
        success: function(ressult) {
        	console.log(ressult);
			if (ressult=="1"){
				erro("O cadastro seja validado<br>dentro de 24 Horas ele sera Liberado");
				document.getElementById('form').reset();
			}

			else{
				erro("Por Favor Revise Seus dados Cadastro não efetuado");
			}
        }
    });

}
//



//funcoes para exibir as telas
function tela(telas) {
	var funcoes=['form-avaria','form-ccr','form-cce','form-recolha','sku-consulta'];

	funcoes.forEach(function(element){
		document.getElementById(element).style.display="none";
		document.getElementById(element).reset();
	});
	document.getElementById(telas).reset();
	document.getElementById(telas).style.display="block";

}


//cadastrar avaria e outros
function favaria() {
	var tela = 'avaria';
	var placa=document.getElementById('placa_avaria').value;
	var carga=document.getElementById('carga_avaria').value;
	var produto=document.getElementById('produto_avaria').value;
	var motivo=document.getElementById('motivo_avaria').value;

	var imgs=[document.getElementById('output1-avaria').alt,document.getElementById('output2-avaria').alt,
		document.getElementById('output3-avaria').alt,document.getElementById('output4-avaria').alt];

	
	var dados = {'tela':tela,'placa':placa,'carga':carga,'produto':produto,'motivo':motivo,"img1":imgs[0],"img2":imgs[1],"img3":imgs[2],"img4":imgs[3]};

	$.ajax({
		url:"../backend.php",
		method: "POST",
		data: dados,
		success:function(ressult) {
			if (ressult==1){
				erro("Nota de Avaria Lançada");
			}else{
				erro("Erro<br>Tente Novamente");
			}
		}
	});

}

function fccr() {
	
	var tela = "ccr";
	var placa=document.getElementById('placa_ccr').value;
	var carga=document.getElementById('carga_ccr').value;
	var produto=document.getElementById('produto_ccr').value;
	var cliente=document.getElementById('cliente_ccr').value;

	var imgs=[document.getElementById('output1-ccr').alt,document.getElementById('output2-ccr').alt,
		document.getElementById('output3-ccr').alt,document.getElementById('output4-ccr').alt];

	
	var dados = {'tela':tela,'placa':placa,'carga':carga,'produto':produto,'cliente':cliente,"img1":imgs[0],"img2":imgs[1],"img3":imgs[2],"img4":imgs[3]};

	$.ajax({
		url:"../backend.php",
		method: "POST",
		data: dados,
		success:function(ressult) {
			if (ressult==1){
				erro("Nota de Recebimento Lançado");
			}else{
				erro("Erro<br>Tente Novamente");
			}
		}
	});
}

function fcce() {
	
	var tela = 'cce';
	var placa=document.getElementById('placa_cce').value;
	var oe=document.getElementById('oe_cce').value;
	var produto=document.getElementById('confe_cce').value;
	var cliente=document.getElementById('cliente_cce').value;

	var imgs=[document.getElementById('output1-cce').alt,document.getElementById('output2-cce').alt];

	
	var dados = {'tela':tela,'placa':placa,'oe':oe,'produto':produto,'cliente':cliente,"img1":imgs[0],"img2":imgs[1]};

	$.ajax({
		url:"../backend.php",
		method: "POST",
		data: dados,
		success:function(ressult) {
			if (ressult==1){
				erro("Nota de Expedição Lançada");
			}else{
				erro("Erro<br>Tente Novamente");
			}
		}
	});

}

function frecolha() {
	
	var tela = 'recolha';
	var placa=document.getElementById('placa_rac').value;
	var num=document.getElementById('num_rac').value;
	var produto=document.getElementById('produto_rac').value;
	var motivo=document.getElementById('motivo_rac').value;

	var dados = {'tela':tela,'placa':placa,'num':num,'produto':produto,'motivo':motivo};

	$.ajax({
		url:"../backend.php",
		method: "POST",
		data: dados,
		success:function(ressult) {
			if (ressult==1){
				erro("Nota de Recolha Lançado");
			}else{
				erro("Erro<br>Tente Novamente");
			}
		}
	});
}

function sku() {

	var dados = {'tela':"SKU"};

	$.ajax({
		url:"../backend.php",
		method: "POST",
		data: dados,
		success:function(ressult) {
			var add=document.getElementById("tabela_sku");
			add.innerHTML =ressult;
		}
	});
}

function skuConsulta(code,name) {
	var telas=["form-avaria","form-ccr","form-cce","form-recolha"];

	var dados ={'tela':'consulta','numero':code,'nome':name};
	
	$.ajax({	
        url: "../backend.php",
        method: "POST",                    
        data: dados,
        success: function(ressult) {
        	var variaveis=ressult.split("¨");
        	console.log(variaveis);
       		addTela(variaveis,telas[name]);
        }
    });
}
function addTela(variaveis,telas) {
	var image = new Image();

	switch (telas) {
 		case "form-avaria":
 			tela(telas);
 			document.getElementById("placa_avaria").value=variaveis[0];
 			document.getElementById("carga_avaria").value=variaveis[1];
 			document.getElementById("produto_avaria").value=variaveis[3];
 			document.getElementById("motivo_avaria").value=variaveis[4];
 			document.getElementById("output1-avaria").src=variaveis[5];
 			document.getElementById("output1-avaria").src=variaveis[6];
 			document.getElementById("output1-avaria").src=variaveis[7];
 			document.getElementById("output1-avaria").src=variaveis[8];

 		break;
 		case "form-ccr":
 			tela(telas);

 			document.getElementById("placa_ccr").value=variaveis[0];
 			document.getElementById("carga_ccr").value=variaveis[1];
 			document.getElementById("produto_ccr").value=variaveis[3];
 			document.getElementById("cliente_ccr").value=variaveis[4];
 			document.getElementById("output1-ccr").src=variaveis[5];
 			document.getElementById("output1-ccr").src=variaveis[6];
 			document.getElementById("output1-ccr").src=variaveis[7];
 			document.getElementById("output1-ccr").src=variaveis[8];
 		break;
 		case "form-cce":
 			tela(telas);
 			document.getElementById("placa_cce").value=variaveis[0];
 			document.getElementById("oe_cce").value=variaveis[1];
 			document.getElementById("confe_cce").value=variaveis[3];
 			document.getElementById("cliente_cce").value=variaveis[4];
 			document.getElementById("output1-cce").src=variaveis[5];
 			document.getElementById("output2-cce").src=variaveis[6];
 		break;
 		case "form-recolha":
 			tela(telas);
 			document.getElementById("placa_rac").value=variaveis[1];
 			document.getElementById("num_rac").value=variaveis[2];
 			document.getElementById("produto_rac").value=variaveis[4];
 			document.getElementById("motivo_rac").value=variaveis[5];
 		break;
 	}
 	
}

function config() {
	var teste="mais";
	var dados= {'tela':'configuracao','mais':teste};

	$.ajax({	
        url: "../backend.php",
        method: "POST",                    
        data: dados,
        success: function(ressult) {
        	var variaveis=ressult.split("¨");
        	console.log(variaveis);
       		addConfig(variaveis);
        },
	    error: function(XMLHttpRequest, textStatus, errorThrown) { 
	        erro("Status: " + textStatus+"Error: " + errorThrown); 
	    }  
    });
}

function addConfig(argument) {
	 document.getElementById("nome-conf").value=argument[0];
	 document.getElementById("login-conf").value=argument[1];
	 document.getElementById("email").value=argument[2];
	 document.getElementById("setor").value=argument[3];
	 document.getElementById("cargo").value=argument[4];
}

function loginConfig() {
	document.getElementById("login-conf").disabled=false;
	document.getElementByid("btnlogin").value="Salvar Alteração";
}
function senhaConfig() {
	document.getElementById("new-password").disabled=false;
	document.getElementById("con-password").disabled=false;
	document.getElementByid("btnsenha").value="Salvar Alteração";
}
function mailConfig() {
	document.getElementById("email").disabled=false;
	document.getElementByid("btnmail").value="Salvar Alteração";
}
function ambosConfig() {
	document.getElementById("setor").disabled=false;
	document.getElementById("cargo").disabled=false;
	document.getElementByid("btncargo").value="Salvar Alteração";
}




//função sair
function sair(){
	var dados ={'q':'sair'};
	$.ajax({	
        url: "../backend.php",
        method: "POST",                    
        data: dados,
        success: function(ressult) {
			window.location.href = "../index.php";
        }
    });
}
