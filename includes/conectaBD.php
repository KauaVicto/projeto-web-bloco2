<?php
    require_once "config.php";
    session_start();

    $con = mysqli_connect(Banco::getServidor(), Banco::getUsuario(), Banco::getSenha(), Banco::getDatabase());