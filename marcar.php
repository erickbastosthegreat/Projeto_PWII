<?php
require_once 'conexao.php';
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = 1; // ou $_SESSION['id_cliente'] se usar login
    $id_medico = $_POST['id_medico'] ?? '';
    $data_consulta = $_POST['data_consulta'] ?? '';
    $hora_consulta = $_POST['hora_consulta'] ?? '';

    $stmt = $conn->prepare("INSERT INTO consulta (id_cliente, id_medico, data_consulta, hora_consulta) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $id_cliente, $id_medico, $data_consulta, $hora_consulta);

    if ($stmt->execute()) {
        $mensagem = "<div class='alert success'>Consulta agendada com sucesso!</div>";
    } else {
        $mensagem = "<div class='alert error'>Erro ao agendar a consulta: " . $stmt->error . "</div>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Marcar Consulta</title>
    <link rel="stylesheet" href="marcar.css"> <!-- use o nome do seu arquivo css! -->
    <style>
    /* ALERTAS DE SUCESSO E ERRO */
    .alert {
        padding: 14px 20px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-weight: 600;
        font-size: 16px;
        text-align: center;
        animation: fadeIn 0.7s;
    }
    .success {
        background: #daf5d7;
        color: #108e2c;
        border: 1.5px solid #85d8b1;
    }
    .error {
        background: #ffe1e1;
        color: #c0392b;
        border: 1.5px solid #e57373;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px);}
        to { opacity: 1; transform: translateY(0);}
    }
    /* Ajuste para selects e botões ficarem iguais ao input */
    .input-box select, .input-box input[type="date"], .input-box input[type="time"] {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
        transition: all .3s ease;
        background: rgba(16, 142, 44, 0.18);
        box-shadow: 0 0 0 2px rgba(255,255,255,0.3);
        appearance: none;
    }
    .input-box select:focus, .input-box input:focus {
        border: 2px solid #85d8b1;
        background: rgba(16, 142, 44, 0.3);
    }
    .input-box select option {
        color: #333;
    }
    </style>
</head>
<body>

    <div class="wrapper">
        <?php echo $mensagem; ?>
        <h1>Marcar Consulta</h1>
        <form action="marcar.php" method="post">
            <div class="input-box">
                <select id="id_medico" name="id_medico" required>
                    <option value="">Selecione o médico</option>
                    <option value="1">Doutor Antonio Pitomba (Urologista)</option>
                    <option value="2">Doutor Evaldo Pinto (Dentista)</option>
                    <option value="3">Doutora Carla Medusa (Clínica Geral)</option>
                    <option value="4">Doutora Laura Chorona (Psiquiatra)</option>
                </select>
            </div>
            <div class="input-box">
                <input type="date" id="data_consulta" name="data_consulta" required placeholder="Data da consulta">
            </div>
            <div class="input-box">
                <input type="time" id="hora_consulta" name="hora_consulta" required placeholder="Hora da consulta">
            </div>
            <button type="submit" class="btn">Marcar Consulta</button>
        </form>
    </div>
</body>
</html>