<?php
    require_once 'includes/conectaBD.php';
    // Declaração das variáveis
    $erro = '';
    $msg = '';
    $nome = '';
    $valor = '';
    $descricao = '';
    $itens = [];
    $arrayOutrosItens = [];
    $outrosItens = '';

    $listaItens = ['Gabinete', 'Carregador', 'HD_Externo']; // Lista dos itens já salvos

    $id = filter_input(INPUT_GET, 'id');

    
    if($id){
        $sql = 'SELECT * FROM servicos WHERE id = ?'; // Busca sql no banco de dados
        $prepare = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($prepare, 'i', $id);
        mysqli_stmt_execute($prepare);

        // Preenche os campos
        $result = mysqli_stmt_get_result($prepare);
        $servico = mysqli_fetch_assoc($result);
        $nome = $servico['nome'];
        $valor = $servico['valor'];
        $descricao = $servico['descricao'];
        $itens = explode(', ', $servico['itens']); // Cria um array com os itens

        foreach($itens as $i => $elem){
            $elem = str_replace(' ', '_', $elem); // Substitui os ' ' por '_'
            $itens[$i] = $elem;
            
            if(!in_array($elem, $listaItens)){ // Verifica se o item recebido está nos itens já salvos
                array_push($arrayOutrosItens, str_replace('_', ' ', $elem)); // Faz a substituição reversa
            }
        }
        $outrosItens = implode(', ', $arrayOutrosItens); // Cria uma string para preencher o campo outros itens
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body onload="carregar()">

    <?php include "includes/menu.php"; ?>   

    <main class="container">

        <section class="form">
            <h2>Editar Serviço</h2>
            <form action="servico_acao_editar.php?id=<?= $id ?>" method="post">
                <div class="campos input">
                    <label for="nome" class="labels labelInput">Nome do Serviço</label>
                    <input type="text" name="nome" id="nome" class="inputs" autocomplete="off" title="Digite o nome do serviço." value="<?=$nome?>">
                </div>
                <div class="campos input">
                    <label for="valor" class="labels labelInput">Valor R$</label>
                    <input type="number" name="valor" id="valor" class="inputs" step="0.01" min="0" title="Digite o valor do serviço" value="<?=$valor?>">
                </div>
                <div class="campos text">
                    <label for="descricao" class="labels labelText" id="labelText">Descrição</label>
                    <textarea name="descricao" id="descricao" class="Text" title="Digite a descrição do serviço."><?=$descricao?></textarea>
                </div>
                
                <div class="campos check">
                    <h4>Itens Entregues</h4>

                    <?php foreach($listaItens as $elem){ ?>
                        <input type="checkbox" name="item[]" id="<?= $elem ?>" value="<?= $elem ?>" <?php echo in_array($elem, $itens) ? 'checked' : ''; ?> ><label for="<?= $elem ?>" class="labelCheck"><?= str_replace('_', ' ', $elem) ?></label><br>
                    <?php } ?>

                    <div class="campos input">
                        <label for="itens" class="labels labelInput">Outros(Separe por vírgulas)</label>
                        <input type="text" name="item[]" class="inputs" id="itens" value="<?= $outrosItens ?>">
                    </div>
                </div>
                
                <button>Alterar</button>
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