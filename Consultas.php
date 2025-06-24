<?php
session_start();
include 'conexao.php';

// Supondo que o ID do usuário está salvo na sessão após o login
$usuarioId = $_SESSION['usuario_id']; // Ex: $_SESSION['usuario_id'] = 101;

$sql = "SELECT id, data_consulta, hora_consulta FROM consulta WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Minhas Consultas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Minhas Consultas</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Data</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['descricao']) ?></td>
            <td><?= htmlspecialchars($row['data']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>