<?php
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = password_hash(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $data_nascimento = $_POST['data_nascimento']; // Data validada no HTML
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);

    try {
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, sexo, data_nascimento, cidade, estado, endereco) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nome, $email, $senha, $sexo, $data_nascimento, $cidade, $estado, $endereco);
        $stmt->execute();
        $conn->commit();

      //  header("Location: login.html");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Erro ao criar conta: " . $e->getMessage());
        header("Location: creat.html?erro=1");
        exit();
    }
} else {
    header("Location: creat.html");
    exit();
}
?>



