<?php
session_start();
include 'conexao.php';

// Supondo que o ID do usuário está salvo na sessão após o login
$usuario = $_SESSION['id_cliente']; // Ex: $_SESSION['usuario_id'] = 101;

$sql = "SELECT id, data_consulta, hora_consulta FROM consulta WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario);  // Corrigido: substitua $usuarioId por $usuario
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Consultas</title>
    <!-- Link para o arquivo CSS -->
    <link rel="stylesheet" href="consulta.css">
</head>
<body>
    <h1>Minhas Consultas</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Consulta</th>
            <th>Data</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>  <!-- Corrigido: id ao invés de id_medico -->
            <td><?= htmlspecialchars($row['hora_consulta']) ?></td>
            <td><?= htmlspecialchars($row['data_consulta']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
