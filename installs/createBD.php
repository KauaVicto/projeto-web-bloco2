<?php
require_once '../includes/config.php';

    $con = mysqli_connect(Banco::getServidor(), Banco::getUsuario(), Banco::getSenha());
    $sql = "CREATE DATABASE ".Banco::getDatabase();

    if(mysqli_query($con, $sql)){
        echo "Banco criado com sucesso!";
    }else{
        echo 'Erro ao criar o banco!';
    }
