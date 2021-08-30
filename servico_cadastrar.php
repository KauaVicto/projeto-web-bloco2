<?php
    require_once 'includes/conectaBD.php';

    // Declaração das variáveis
    $erro = '';
    $msg = '';
    $nome_servico = '';
    $nome_cliente = '';
    $valor = '';
    $descricao = '';

    $listaItens = ['Gabinete', 'Carregador', 'HD_Externo', 'Notebook']; // Lista dos itens já salvos

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ // Teste para verificar se o botão foi apertado

        // Recebimento dos dados
        $nome_cliente = filter_input(INPUT_POST, 'nome_cliente');
        $nome_servico = filter_input(INPUT_POST, 'nome_servico');
        $valor = filter_input(INPUT_POST, 'valor');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $itens = $_POST['item'];

        if(end($itens) == ''){ // Verifica se o campo itens foi preenchido, caso não remove o último valor do array
            array_pop($itens);
        }
        $itens = implode(', ', $itens); // Junta todos os valores do array itens em uma string

        if($nome_cliente == ''){ // Testa o campo nome do cliente
            $erro = 'O campo Nome do Cliente é obrigatório!';
        }else if($nome_servico == ''){
            $erro = 'O campo Nome do Serviço é obrigatório!';
        }else if($valor == ''){ // Testa o campo valor
            $erro = 'O campo valor é obrigatório!';
        }else{ // Realiza o cadastro

            $sql = 'INSERT INTO servicos(nome_cliente, nome_servico, descricao, valor, itens) VALUES (?,?,?,?,?)';

            $prepare = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($prepare, 'sssds', $nome_cliente, $nome_servico, $descricao, $valor, $itens);
            
            if(mysqli_stmt_execute($prepare)){
                $msg = 'Serviço cadastrado com sucesso!';
                $nome_cliente = '';
                $nome_servico = '';
                $valor = '';
                $descricao = '';
                $itens = '';
            }else{
                $erro = 'Erro ao cadastrar o serviço, verifique os dados e/ou tente mais tarde.';
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
                <div class="sep">
                    <div class="campos input">
                        <label for="nome_cliente" class="labels labelInput">Nome do Cliente</label>
                        <input type="text" name="nome_cliente" id="nome_cliente" class="inputs" autocomplete="off" title="Digite seu Nome." value="<?=$nome_cliente?>">
                    </div>
                    <div class="campos input">
                        <label for="nome_servico" class="labels labelInput">Nome do Serviço</label>
                        <input type="text" name="nome_servico" id="nome_servico" class="inputs" autocomplete="off" title="Digite o nome do serviço." value="<?=$nome_servico?>">
                    </div>
                    <div class="campos text">
                        <label for="descricao" class="labels labelText" id="labelText">Descrição</label>
                        <textarea name="descricao" id="descricao" class="Text" title="Digite a descrição do serviço."><?=$descricao?></textarea>
                    </div>
                    
                </div>
                <div class="linha"></div>
                <div class="sep">
                    
                    <div class="campos input">
                        <label for="valor" class="labels labelInput">Valor R$</label>
                        <input type="number" name="valor" id="valor" class="inputs" step="0.01" min="0" title="Digite o valor do serviço" value="<?=$valor?>">
                    </div>
                    <div class="campos check">
                        <h4>Itens Entregues</h4>
                        <?php foreach($listaItens as $elem){ ?>
                            <input type="checkbox" name="item[]" id="<?= $elem ?>" value="<?= $elem ?>"><label for="<?= $elem ?>" class="labelCheck"><?= str_replace('_', ' ', $elem) ?></label><br>
                        <?php } ?>
                        <div class="campos input">
                            <label for="itens" class="labels labelInput">Outros(Separe por vírgulas)</label>
                            <input type="text" name="item[]" class="inputs" id="itens">
                        </div>
                    </div>
                    
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