<?php
    require_once 'includes/conectaBD.php';

    $id = filter_input(INPUT_GET, 'id');

    $sql = 'DELETE FROM servicos WHERE id = ?';
    $prepare = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($prepare, 'i', $id);

    if(mysqli_stmt_execute($prepare)){
        $_SESSION['msg'] = 'Serviço finalizado com sucesso!';
    }else{
        $_SESSION['erro'] = 'Erro ao finalizar o serviço, tente novamente mais tarde!';
    }

    header('location: servico_listar.php');