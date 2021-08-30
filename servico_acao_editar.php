<?php
    require_once 'includes/conectaBD.php';

    // Recebimento dos dados
    $id = filter_input(INPUT_GET, 'id');

    $nome_cliente = filter_input(INPUT_POST, 'nome_cliente');
    $nome_servico = filter_input(INPUT_POST, 'nome_servico');
    $valor = filter_input(INPUT_POST, 'valor');
    $descricao = filter_input(INPUT_POST, 'descricao');
    $itens = $_POST['item'];

    if(end($itens) == ''){ // Verifica se o campo itens foi preenchido, caso não remove o último valor do array
        array_pop($itens);
    }
    $itens = implode(', ', $itens); // Junta todos os valores do array itens em uma string

    $sql = 'UPDATE servicos SET nome_cliente = ?, nome_servico = ?, valor = ?, descricao = ?, itens = ? WHERE id = ?';
    $prepare = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($prepare, 'ssdssi', $nome_cliente, $nome_servico, $valor, $descricao, $itens, $id);

    if(mysqli_stmt_execute($prepare)){
        $_SESSION['msg'] = "O serviço número $id do cliente $nome_cliente foi alterado com sucesso!";
    }else{
        $_SESSION['erro'] = 'Ocorreu um erro ao tentar editar, tente novamente mais tarde!';
    }

    header('location: servico_listar.php');