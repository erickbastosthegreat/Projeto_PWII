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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">  
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
    body {
  min-height: 100vh;
  margin: 0;
  padding: 0;
  background: linear-gradient(120deg, #d3f7e6 0%, #aee1ce 100%);
  display: flex;
  justify-content: center;
  align-items: center;
}

.main-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  max-width: 480px; /* ajuste o tamanho conforme desejar */
  margin: 0 auto;
}

header {
  width: 100%;
  background-color: #007b5e;
  color: white;
  padding: 16px 0;
  border-radius: 40px 40px 0 0;
  text-align: center;
  margin-bottom: 10px;
}

.cards {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 18px;
  width: 100%;
  margin-bottom: 30px;
}

.card {
  width: 100%;
  max-width: 350px;
  background-color: white;
  padding: 18px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  transition: transform 0.2s;
}

.card:hover {
  transform: translateY(-5px) scale(1.02);
}

.image-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 8px;
}

.image-container img {
  width: 100px;
  height: auto;
  border-radius: 15px;
  margin-bottom: 8px;
}

.info {
  opacity: 0;
  max-height: 0;
  overflow: hidden;
  transition: opacity 0.3s, max-height 0.3s;
  text-align: center;
  background: #f1f1f1;
  border-radius: 8px;
  font-size: 14px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
  padding: 10px;
}

.card:hover .info,
.image-container:hover .info {
  opacity: 1;
  max-height: 200px;
}

.wrapper {
  width: 100%;
  max-width: 400px;
  margin: 0 auto 0 auto;
  background: #e8f8f5;
  border-radius: 20px;
  box-shadow: 0 2px 16px rgba(0,0,0,0.07);
  padding: 32px 24px;
  text-align: center;
}

.input-box {
  margin-bottom: 16px;
}

.input-box select, .input-box input[type="date"], .input-box input[type="time"] {
  width: 100%;
  padding: 14px;
  border-radius: 40px;
  border: 2px solid #85d8b1;
  background: rgba(16, 142, 44, 0.10);
  font-size: 16px;
  outline: none;
  box-shadow: 0 0 0 2px rgba(255,255,255,0.2);
  transition: border .3s, background .3s;
}

.input-box select:focus, .input-box input:focus {
  border: 2px solid #108e2c;
  background: rgba(16, 142, 44, 0.20);
}

.btn, .btn1 {
  display: block;
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
}

.btn1 {
  background: white;
  color: #007b5e;
  border: 2px solid #007b5e;
  margin-top: 10px;
}

.btn:hover, .btn1:hover {
  background-color: #108e2c;
  color: white;
}

@media (max-width: 600px) {
  .main-container {
    max-width: 99vw;
    padding: 0 4vw;
  }
  .card, .wrapper {
    max-width: 100%;
  }
}
    </style>
</head>
<body>
<body>
  <div class="main-container">
    <header>
      <h2>Seus médicos:</h2>
    </header>
    <div class="cards">
      <!-- Cards dos médicos (um por div.card) -->
      <div class="card">
        Doutor Antonio Pitomba
        <div class="image-container">
          <img src="imagens/normal.png" alt="">
          <div class="info">
            <strong>Urologista</strong><br>
            Formado em Harvard<br>
            45 anos, 1.95 de altura<br>
            Descrição: Super gentil e carinhoso com seus pacientes.
          </div>
        </div>
      </div>
      <div class="card">
        Doutor Evaldo Pinto
        <div class="image-container">
          <img src="imagens/hasha.png" alt="">
          <div class="info">
            <strong>Dentista</strong><br>
            Formado na USP<br>
            36 anos, 1.86 de altura<br>
            Descrição: Com suas mãos ele faz magica nos seus dentes.
          </div>
        </div>
      </div>
      <div class="card">
        Doutora Carla Medusa
        <div class="image-container">
          <img src="imagens/meme.png" alt="">
          <div class="info">
            <strong>Clínica Geral</strong><br>
            Formada em Hogwarts<br>
            40 anos, 1.70 de altura<br>
            Descrição: Especialista em feitiços de cura.
          </div>
        </div>
      </div>
      <div class="card">
        Doutora Laura Chorona
        <div class="image-container">
          <img src="imagens/chocho.png" alt="">
          <div class="info">
            <strong>Psiquiatra</strong><br>
            Formada em Oxford<br>
            38 anos, 1.65 de altura<br>
            Descrição: Excelente ouvinte, com empatia e sabedoria.
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <!-- Formulário de marcação -->
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
        <div>
          <a class="btn1" href="Consultas.php">Exibir Consultas</a>
        </div>
      </form>
    </div>
  </div>
</body>
</body>
</html>