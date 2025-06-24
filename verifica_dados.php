<?php
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o usuário pelo email
    $stmt = $conn->prepare("SELECT senha FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($senha_hash);
        $stmt->fetch();

        // Verifica a senha usando password_verify
        if (password_verify($senha, $senha_hash)) {
            // Login bem-sucedido!
            session_start();
            $_SESSION['email'] = $email;
            header("Location: inicio.html"); // Ou a página que quiser após o login
            exit;
        } else {
            echo "<script>alert('Senha incorreta!');window.location.href='login2.html';</script>";
        }
    } else {
        echo "<script>alert('Email não encontrado!');window.location.href='login2.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>