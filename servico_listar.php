<?php
    require_once 'includes/conectaBD.php';
    $erro = '';
    $msg = '';

    if(isset($_SESSION['erro'])){
        $erro = $_SESSION['erro'];
        unset($_SESSION['erro']);
    }
    if(isset($_SESSION['msg'])){
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    $sql = "SELECT * FROM servicos";
    $result = mysqli_query($con, $sql);// Busca os dados do banco

    $qt = mysqli_num_rows($result);//Pega a quantidade de linhas da consulta
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <?php include "includes/menu.php"; ?>

    
    
    <main class="container">
        <h2>Você possui <?=$qt?> serviços pendentes.</h2>
        <div class="tabela">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome do Serviço</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Elementos</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($servico = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?= $servico['id'] ?></th>
                            <td><?= $servico['nome'] ?></td>
                            <td><?= $servico['descricao'] ?></td>
                            <td>R$<?= number_format($servico['valor'], 2, ',', '.')  ?></td>
                            <td><?= $servico['elementos'] ?></td>
                            <td>
                                <a href="servico_editar.php?id=<?=$servico['id']?>">Editar</a>
                                <a href="servico_finalizar.php?id=<?=$servico['id']?>">Finalizar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if($erro != ''){ ?>
            <div class="erro">
                <?= $erro ?>
            </div>
        <?php } ?>
        <?php if($msg != ''){ ?>
            <div class="msg">
                <?= $msg ?>
            </div>
        <?php } ?>
    </main>
    
</body>
</html>