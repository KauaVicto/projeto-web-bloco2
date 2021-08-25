<?php
    require_once 'includes/conectaBD.php';

    $sql = "SELECT * FROM servicos";
    $result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <?php include "includes/menu.php"; ?>

    
    <div class="tabela">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do Serviço</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Elementos</th>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>