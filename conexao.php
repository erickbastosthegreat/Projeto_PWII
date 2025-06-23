<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
$host = 'localhost';
$usuario = 'Leirbag';      // usuário do seu banco
$senha = 'MySqsenha';            // senha do banco
$banco = 'CLINICA';  // substitua pelo nome do seu banco

$conn = new mysqli(hostname: $host, username: $usuario, password: $senha, database: $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>

</body>
</html>