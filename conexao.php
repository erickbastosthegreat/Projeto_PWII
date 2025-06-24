<?php
$host = 'localhost';
$usuario = 'root';      // usuário do seu banco
$senha = '';            // senha do banco (vazia!)
$banco = 'CLINICA';     // nome do banco

$conn = new mysqli($host, $usuario, $senha, $banco); 

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>