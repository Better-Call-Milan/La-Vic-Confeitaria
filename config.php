<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'confeitaria_la_vic';
    
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//  If($conexao->connect_errno)
//{
//  echo "Erro ao conectar". $conexao->connect_error;
//
//}
//  else
//{
//  echo "Conexão efetuada com sucesso";
//}

?>