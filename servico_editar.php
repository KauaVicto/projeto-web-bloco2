<?php
    require_once 'includes/conectaBD.php';
    // Declaração das variáveis
    $erro = '';
    $msg = '';
    $nome = '';
    $valor = '';
    $descricao = '';

    $id = filter_input(INPUT_GET, 'id');

    $sql = 'SELECT * FROM servicos WHERE id = ?';
    $prepare = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($prepare, 'i', $id);

    if(mysqli_stmt_execute($prepare)){
        $result = mysqli_stmt_get_result($prepare);
        $servico = mysqli_fetch_assoc($result);
        $nome = $servico['nome'];
        $valor = $servico['valor'];
        $descricao = $servico['descricao'];

        $elementos = explode(', ', $servico['elementos']);
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
                    <label for="descricao" class="labels labelText" id="labelText">Descrição</label>
                    <textarea name="descricao" id="descricao" class="Text" title="Digite a descrição do serviço."><?=$descricao?></textarea>
                </div>
                
                <div class="campos check">
                    <h4>Elementos Entregues</h4>
                    <input type="checkbox" name="elemento[]" id="gabinete" value="Gabinete" <?php echo in_array('Gabinete', $elementos) ? 'checked' : ''; ?> ><label for="gabinete" class="labelCheck">Gabinete</label><br>

                    <input type="checkbox" name="elemento[]" id="carregador" value="Carregador" <?php echo in_array('Carregador', $elementos) ? 'checked' : ''; ?> ><label for="carregador" class="labelCheck">Carregador</label><br>

                    <input type="checkbox" name="elemento[]" id="hd-externo" value="HD Externo" <?php echo in_array('HD Externo', $elementos) ? 'checked' : ''; ?> ><label for="hd-externo" class="labelCheck">HD Externo</label><br>
                    

                    <div class="campos input">
                        <label for="elementos" class="labels labelInput">Outros(Separe por vírgulas)</label>
                        <input type="text" name="elemento[]" class="inputs" id="elementos">
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