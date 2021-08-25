<?php
    require_once "config.php";

    $con = mysqli_connect(Banco::getServidor(), Banco::getUsuario(), Banco::getSenha(), Banco::getDatabase());