<?php
require_once "../includes/conectaBD.php";

$sql = "CREATE TABLE servicos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(50),
    nome_servico VARCHAR(50),
    descricao VARCHAR(150),
    valor DECIMAL,
    itens VARCHAR(150)
)";

if(mysqli_query($con, $sql)){
    echo "Tabela Serviços criada com sucesso!";
}else{
    echo "Erro ao criar a tabela Serviços";
}