<?php
require_once "../includes/conectaBD.php";

$sql = "CREATE TABLE servicos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao VARCHAR(150),
    valor DECIMAL,
    elementos VARCHAR(150)
)";

if(mysqli_query($con, $sql)){
    echo "Tabela Serviços criada com sucesso!";
}else{
    echo "Erro ao criar a tabela Serviços";
}