<?php
date_default_timezone_set('UTC');

require('vendor/autoload.php');

try {
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $password = $dbparts['pass'];
    $username = $dbparts['user'];
    $database = ltrim($dbparts['path'],'/');

    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
}
catch(PDOException $e) {
    echo "Recarrege a pagina Erro : " . $e->getMessage();
}


if(isset($_POST['q'])){

    $q = $_POST['q'];
    switch ($q) {
        case 'login':
            $senha=md5(mb_strtoupper($_POST['senha'],"utf-8"));
            $user=mb_strtoupper($_POST['user'],"utf-8");
            
            $consulta = $pdo->prepare("SELECT id_user FROM cadastro_do_usuario WHERE login=:log  AND senha =:senha");
            $consulta->execute(array(
                'log' => $user,
                'senha' => $senha));
            
           if ($consulta->rowCount()) {
                session_start();
                $_SESSION['user'] = $user;
                foreach($consulta as $row) {
                    $_SESSION['id_user']=$row['id_user'];
                    echo "1";
                } 
            }else{
                echo "Usuario não encontrado";
            }

            $pdo = null;
        break;

        case 'cadastro':
            $nome_c=mb_strtoupper($_POST['nome'],"utf-8");
            $login=mb_strtoupper($_POST['login'],"utf-8");
            $senha=md5(mb_strtoupper($_POST['senha'],"utf-8"));
            $email=mb_strtoupper($_POST['email'],"utf-8");
            $data_nascimento=mb_strtoupper($_POST['nasc'],"utf-8");
            $cnpj=mb_strtoupper($_POST['empresa'],"utf-8");
            $setor=mb_strtoupper($_POST['setor'],"utf-8");
            $cargo=mb_strtoupper($_POST['cargo'],"utf-8");
            $valido=1;
        
            $consulta = $pdo->prepare("SELECT cnpj FROM cadastro_empresa WHERE valido=:valido and cnpj=:cnpj or nome_e=:cnpj");
            $consulta->execute(array(':cnpj' => $cnpj,':valido'=> $valido));
           
            if ($consulta->rowCount()) {
                try {
                    $cad= $pdo->prepare("INSERT INTO cadastro_do_usuario(login, nome_u,senha,data_nascimento,email,setor,cargo,cnpj)
                        VALUES (:login,:nome,:senha,:data_n,:email,:setor,:cargo,:empresa)");
                    $cad->execute(array(
                        ':nome'=>$nome_c,
                        ':login'=>$login,
                        ':senha'=>$senha,
                        ':email'=>$email,
                        ':data_n'=>$data_nascimento,
                        ':setor'=>$setor,
                        ':cargo'=>$cargo,
                        ':empresa'=>$cnpj
                    ));

                    echo $cad->rowCount();
                } catch ( PDOException $excecao ){
                    echo $excecao->getMessage();
                    exit();
                }
            }else{
                echo "CPNJ não encontrado na nossa Base de dados<br>Empresa aguardando validação";
            }
            $pdo = null;

        break;

        case 'consulta':
            $user=mb_strtoupper($_POST['user'],"utf-8");

            try {
                $consulta = $pdo->prepare("SELECT * FROM cadastro_do_usuario WHERE login=:user");
                $consulta->execute(array(':user' => $user));
                foreach ($consulta as $row) {
                    if ($row) {
                       echo "1";
                    }                    
                }
            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;

        case 'consulta_cnpj':
            $cnpj=$_POST['cnpj'];

            try {
                $consulta = $pdo->prepare("SELECT * FROM cadastro_empresa WHERE cnpj=:cnpj");
                $consulta->execute(array(":cnpj" => $cnpj));
                    if ($consulta->rowCount()) {
                       echo "1";
                    }
                    
            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;

        case 'cad_empresa':

            $cnpj=$_POST['cnpj'];
            $nome_e=mb_strtoupper($_POST['razao'],"utf-8");
            $cep=$_POST['cep'];
            $numero=mb_strtoupper($_POST['numero'],"utf-8");
            $cidade=mb_strtoupper($_POST['cidade'],"utf-8");
            $obs=mb_strtoupper($_POST['endereco'],"utf-8");
            $data_fundacao=$_POST['fundacao'];
            $email=mb_strtoupper($_POST['email'],"utf-8");
            $telefone=$_POST['tele'];
          


            try {
                $consulta=$pdo->prepare("INSERT INTO cadastro_empresa (cnpj, nome_e, cep, numero, cidade, obs, data_fundacao, email, telefone, valido)
                    VALUES (:cnpj, :nome_e, :cep, :numero, :cidade, :obs, :data_fundacao, :email, :telefone,:valido)");
                $consulta->execute(array(
                    ':cnpj'=>$cnpj,
                    ':nome_e'=>$nome_e,
                    ':cep'=>$cep,
                    ':numero'=>$numero,
                    ':cidade'=>$cidade,
                    ':obs'=>$obs,
                    ':data_fundacao'=>$data_fundacao,
                    ':email'=>$email,
                    ':telefone'=>$telefone,
                    ':valido'=>0
                ));

                echo $consulta->rowCount();

            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;
        case 'sair':
            session_start();
            
            unset($_SESSION["user"]);
            session_destroy();
         break;

        default:
            
            break;
    }
}




elseif(isset($_POST['tela'])){
    session_start();

    $tela=$_POST['tela'];

    switch ($tela) {
        case 'avaria':
            $placa=str_replace("-","", $_POST["placa"]);
            $carga=$_POST["carga"];
            $produto=$_POST["produto"];
            $motivo=$_POST["motivo"];
            $img1=$_POST["img1"];

            if (isset($_POST['img2']))
                $img2=$_POST["img2"];
            else
                $img2="NULL";
            if (isset($_POST['img3']))
                $img3=$_POST["img3"];
            else
                $img3="NULL";
            if (isset($_POST['img4']))
                $img4=$_POST["img4"];
            else
                $img4="NULL";

            try {
                $consulta= $pdo->prepare("INSERT INTO avaria (placa,carga_v,data_avaria,produto,motivo,imagem, img2,img3,img4,id_user)
                    VALUES (:placa,:carga,:data,:produto,:motivo,:img1,:img2,:img3,:img4,:login)");
                $consulta->execute(array(
                    ':placa'=>$placa,
                    ':carga'=>$carga,
                    ':produto'=>$produto,
                    ':data'=> date('Y/m/d/'),
                    ':motivo'=>$motivo,
                    ':img1'=>$img1,
                    ':img2'=>$img2,
                    ':img3'=>$img3,
                    ':img4'=>$img4,
                    ':login'=>$_SESSION['id_user']
                ));

                echo $consulta->rowCount();
            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;
        
        case 'ccr':
            $placa=str_replace("-","", $_POST["placa"]);
            $carga=$_POST["carga"];
            $produto=$_POST["produto"];
            $cliente=$_POST["cliente"];
            $img1=$_POST["img1"];

            if (isset($_POST['img2']))
                $img2=$_POST["img2"];
            else
                $img2="NULL";
            if (isset($_POST['img3']))
                $img3=$_POST["img3"];
            else
                $img3="NULL";
            if (isset($_POST['img4']))
                $img4=$_POST["img4"];
            else
                $img4="NULL";


            try {
                $consulta= $pdo->prepare("INSERT INTO c_control_rec
                    VALUES (:placa,:carga,:data,:produto,:fabrica,:img1,:img2,:img3,:img4,:login)");
                $consulta->execute(array(
                    ':placa'=>$placa,
                    ':carga'=>$carga,
                    ':data'=>date('Y/m/d'),
                    ':produto'=>$produto,
                    ':fabrica'=>$cliente,
                    ':img1'=>$img1,
                    ':img2'=>$img2,
                    ':img3'=>$img3,
                    ':img4'=>$img4,
                    ':login'=>$_SESSION['id_user']
                ));
                echo $consulta->rowCount();
            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;

        case 'cce':
            $placa=str_replace("-","", $_POST["placa"]);
            $oe=$_POST["oe"];
            $produto=$_POST["produto"];
            $cliente=$_POST["cliente"];
            $img1=$_POST["img1"];

            if (isset($_POST['img2']))
                $img2=$_POST["img2"];
            else
                $img2="NULL";

            try {
                $consulta= $pdo->prepare("INSERT INTO c_control_exp
                    VALUES (:placa,:oe,:data,:produto,:cliente,:img1,:img2,:login)");
                $consulta->execute(array(
                    ':placa'=>$placa,
                    ':oe'=>$oe,
                    ':data'=>date('Y/m/d/'),
                    ':produto'=>$produto,
                    ':cliente'=>$cliente,
                    ':img1'=>$img1,
                    ':img2'=>$img2,
                    ':login'=>$_SESSION['id_user']
                ));
                echo $consulta->rowCount();
            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;

        case 'recolha':
            $placa=str_replace("-","", $_POST["placa"]);
            $num=$_POST["num"];
            $produto=$_POST["produto"];
            $motivo=$_POST["motivo"];

            try {
                $consulta= $pdo->prepare("INSERT INTO rac(placa,carga_rac,data_chegada, produto, motivo, id_user)
                    VALUES (:placa,:num,:data,:produto,:motivo,:login)");
                $consulta->execute(array(
                    ':placa'=>$placa,
                    ':num'=>$num,
                    ':data'=>date('Y/m/d/'),
                    ':produto'=>$produto,
                    ':motivo'=>$motivo,
                    ':login'=>$_SESSION['id_user']
                ));
                echo $consulta->rowCount();
            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;
        
        case 'SKU':
            try {
                $teste=["AVARIA" =>1,
                       "RECEBIMENTO"=>2,
                       "EXPEDIÇÃO"=>3,
                       "RECOLHA"=>4
               ];
                $consulta= $pdo->query("SELECT sku.N_processo,sku.nome_process,sku.data_processo,cadastro_do_usuario.login FROM sku  INNER JOIN cadastro_do_usuario ON sku.id_user=cadastro_do_usuario.id_user ORDER BY sku.data_processo DESC");
                foreach($consulta as $row) {
                    $data=implode("/",array_reverse(explode("-",$row["data_processo"])));
                    print_r("
                    <tr>
                        <td>".$row["N_processo"]."</td>
                        <td>".$row["nome_process"]."</td>
                        <td>".$row["login"]."</td>
                        <td>".$data."</td>
                        <td onclick='skuConsulta(".$row['N_processo'].",".$teste[$row['nome_process']].")'>&#x1f441;</td>
                    </tr>");
                }

            } catch ( PDOException $excecao ){
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;
        break;

        case 'consulta':
            $tabela=[1 =>"avaria",
                   2=>"c_control_rec",
                   3=>"c_control_exp",
                   4=>"rac"
               ];

            $coluna=[1 =>"carga_v",
                   2=>"carga_r",
                   3=>"OE",
                   4=>"carga_rac"
               ]; 

            $numero=$_POST["numero"];

            $nome=$_POST["nome"];

            $pesquisa="SELECT * FROM ".$tabela[$nome]." WHERE ".$coluna[$nome]."=".$numero;

            try {
                $consulta= $pdo->query($pesquisa);
                foreach($consulta as $row) {
                    echo $row[0]."¨";
                    echo $row[1]."¨";
                    echo $row[2]."¨";
                    echo $row[3]."¨";
                    echo $row[4]."¨";
                    echo $row[5]."¨";
                    echo $row[6]."¨";
                    echo $row[7]."¨";
                    echo $row[8]."¨";
                    echo $row[8]."¨";
                    echo $row[9];
                }
            } catch (PDOException $excecao) {
                echo $excecao->getMessage();
                exit();
            }
            $pdo = null;        
        break;

        case 'configuracao':

            $consulta = $pdo->prepare("SELECT nome_u, login, email, setor, cargo FROM cadastro_do_usuario WHERE id_user:id");

            $consulta->execute(array('id' => $_SESSION['id_user']));
            foreach($consulta as $row) {
                echo $row[0]."¨";
                echo $row[1]."¨";
                echo $row[2]."¨";
                echo $row[3]."¨";
                echo $row[4]; 
            }
        break;

        default:
            $pdo = null;
            break;
    }
}
?>
