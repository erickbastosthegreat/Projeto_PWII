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
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $cpf = $_POST['CPF'];

    $stmt = $conn->prepare("INSERT INTO cliente (nome, telefone, data_nascimento, email, senha, cpf) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $telefone, $data_nascimento, $email, $senha, $cpf);

    if ($stmt->execute()) {
        // redirecionar após sucesso
        header("Location: medicos.html");
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