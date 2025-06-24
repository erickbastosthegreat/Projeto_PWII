<?php
require_once 'conexao.php';

$sql = "SELECT c.id, cli.nome AS cliente, m.nome AS medico, c.data_consulta, c.hora_consulta
    FROM consulta c
    JOIN cliente cli ON c.id_cliente = cli.id
    JOIN medico m ON c.id_medico = m.id";
$result = $conn->query($sql);

echo "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <title>Consultas Agendadas</title>
    <style>
    table { border-collapse: collapse; width: 60%; margin: 20px auto; }
    th, td { border: 1px solid #333; padding: 8px; text-align: center; }
    th { background: #f2f2f2; }
    </style>
</head>
<body>";

if ($result && $result->num_rows > 0) {
    echo "<h1 style='text-align:center;'>Consultas Agendadas</h1>";
    echo "<table>
        <tr>
        <th>Cliente</th>
        <th>Médico</th>
        <th>Data</th>
        <th>Hora</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row["cliente"]) . "</td>
        <td>" . htmlspecialchars($row["medico"]) . "</td>
        <td>" . htmlspecialchars(date('d/m/Y', strtotime($row["data_consulta"]))) . "</td>
        <td>" . htmlspecialchars($row["hora_consulta"]) . "</td>
          </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Nenhuma consulta encontrada.</p>";
}

echo "</body></html>";

$conn->close();
?>