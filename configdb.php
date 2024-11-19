<?php

// endereco
//nome do BD
//Usuario
//Senha

$host = 'localhost';
$dbname = 'hospital';   
$port = '5432';
$user = 'postgres';
$password = 'Kesller00K7';

#para ver se esta conectado


//sgbd:host;port;dbnome
//usuario
//senha
//errmode

//try {
// String de conexão correta, separando os parâmetros com ponto e vírgula
$conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);



// Definindo o modo de erro como exceção
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo "Conectado ao banco de dados com sucesso!";
//} catch (PDOException $e) {
//    // Capturando erros e exibindo a mensagem
//    echo "Falha na conexão: " . $e->getMessage();
//}
//