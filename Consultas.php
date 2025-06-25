<?php
session_start();
include 'conexao.php';

// Supondo que o ID do usuário está salvo na sessão após o login
$usuario = $_SESSION['id_cliente']; // Ex: $_SESSION['usuario_id'] = 101;

$sql = "SELECT id, data_consulta, hora_consulta FROM consulta WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario);  
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
            <th>Hora</th>
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

  <a href="inicio.html" class="btn">Volte para o inicio</a>


  <style>
.btn, .btn1 {
  display: flex;
  width: 100%;
  margin: 10px 0 0 0;
  padding: 14px 0;
  border-radius: 40px;
  border: none;
  background-color: #007b5e;
  color: white;
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
  text-decoration: none;
  justify-content: center;

}
  </style>
</body>
</html>
