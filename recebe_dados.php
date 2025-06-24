<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf']; // Use the correct field name as per your HTML form
    $data_nascimento = $_POST['data'];

    $stmt = $conn->prepare("INSERT INTO cliente (nome, email, senha, telefone, cpf, data_nascimento) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $senha, $telefone, $cpf, $data_nascimento);

    if ($stmt->execute()) {
        // redirecionar após sucesso
        header("Location: inicio.html");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>

<!-- Se você quiser mostrar uma mensagem após o cadastro, pode adicionar aqui -->
