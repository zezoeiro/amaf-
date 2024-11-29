<?php
session_start();
// Verifica se o usuário está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: login.html"); // Redireciona para a página de login
    exit();
}

// Obtém o nome do usuário logado
$usuario = $_SESSION['user']['nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download APK</title>
  <link rel="stylesheet" href="down.css">
</head>
<body>
  <header class="header">
    <nav>
      <ul>
        <li><a href="index.html">Início</a></li>
        <li><a href="https://www.instagram.com/amaf_df/">Instagram</a></li>
      </ul>
    </nav>
  </header>

  <div class="main-container">
    <h1>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h1>
    <div class="download-box">
      <button class="download-btn" onclick="showMessage()">Download</button>
      <p id="message" class="hidden">Desculpe, infelizmente o download ainda não está disponível!</p>
    </div>
  </div>

  <script>
    function showMessage() {
      const message = document.getElementById("message");
      message.classList.remove("hidden");
    }
  </script>
</body>
</html>
