<?php
    require_once 'includes/conectaBD.php';
    $erro = '';
    $msg = '';
    $nome = '';
    $valor = '';
    $descricao = '';
    $elementos = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = filter_input(INPUT_POST, 'nome');
        $valor = filter_input(INPUT_POST, 'valor');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $elementos = filter_input(INPUT_POST, 'elementos');

        if($nome == ''){
            $erro = 'O campo nome é obrigatório!';
        }else{

            $sql = 'INSERT INTO servicos(nome, valor, descricao, elementos) VALUES (?,?,?,?)';

            $prepare = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($prepare, 'sdss', $nome, $valor, $descricao, $elementos);
            
            if(mysqli_stmt_execute($prepare)){
                $msg = 'Serviço cadastrado com sucesso!';
                $nome = '';
                $valor = '';
                $descricao = '';
                $elementos = '';
            }else{
                $erro = 'Erro ao cadastrar o serviço, verifique os dados ou tente mais tarde.';
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Serviço</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body onload="carregar()">

    <?php include "includes/menu.php"; ?>   

    <main class="container">

        <section class="form">
            <h2>Cadastrar Serviço</h2>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="campos input">
                    <label for="nome" class="labels labelInput">Nome do Serviço</label>
                    <input type="text" name="nome" id="nome" class="inputs" autocomplete="off" title="Digite o nome do serviço." value="<?=$nome?>">
                </div>
                <div class="campos input">
                    <label for="valor" class="labels labelInput">Valor R$</label>
                    <input type="number" name="valor" id="valor" class="inputs" step="0.01" min="0" title="Digite o valor do serviço" value="<?=$valor?>">
                </div>
                <div class="campos text">
                    <label for="descricao" class="labels labelText">Descrição</label>
                    <textarea name="descricao" id="descricao" class="Text" title="Digite a descrição do serviço."><?=$descricao?></textarea>
                </div>
                <div class="campos text">
                    <label for="elementos" class="labels labelText">Peças Entregues</label>
                    <textarea name="elementos" id="elementos" class="Text" title="Digite as peças entregue pelo cliente, como carregador, gabinete, etc..."><?=$elementos?></textarea>
                </div>
                
                <button>Cadastrar</button>
                <?php if($erro){ ?>
                    <div class="erro"><?=$erro?></div>
                <?php } ?>
                <?php if($msg){ ?>
                    <div class="msg"><?=$msg?></div>
                <?php } ?>
            </form>
        </section>
    </main>
    
    <script src="js/jquery.js"></script>
    <script src="js/form.js"></script>
</body>
</html>