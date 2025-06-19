<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medico = $_POST['medico'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];


    $stmt = $conn->prepare("INSERT INTO consulta (medico_consulta, data_consulta, hora_consulta) VALUES (?, ?, ?)");
    $stmt->bind_param("sss",$medico, $data, $hora);

    if ($stmt->execute()) {
        // redirecionar após sucesso
        header("Location: confirmacao.php");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
