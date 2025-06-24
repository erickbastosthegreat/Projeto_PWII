<?php
require 'conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o id e senha do cliente pelo email
    $stmt = $conn->prepare("SELECT id, senha FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_cliente, $senha_hash);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            $_SESSION['email'] = $email;
            $_SESSION['id_cliente'] = $id_cliente; // ← Salva o id_cliente na sessão

            header("Location: inicio.html");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!');window.location.href='login2.html';</script>";
        }
    } else {
        echo "<script>alert('Email não encontrado!');window.location.href='login2.html';</script>";
    }
}
?>