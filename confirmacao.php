<?php
require_once 'conexao.php';

$sql = "SELECT medico_consulta , data_consulta, hora_consulta FROM consulta;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Começar a exibir os dados em formato HTML
    echo "<h1>Consultas Agendadas</h1>";
    echo "<table border='1'>
            <tr>
                
                <th>Médico</th>
                <th>Data</th>
                <th>Hora</th>
            </tr>";
    
    // Exibir cada linha de dados
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["medico"] . "</td>
                <td>" . $row["data"] . "</td>
                <td>" . $row["hora"] . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "Nenhuma consulta encontrada.";
}

// Fechar a conexão
$conn->close();
?>