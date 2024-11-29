<?php
session_start();
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['user'] = $result->fetch_assoc();
            header("Location: down.html");
            exit();
        } else {
            header("Location: login.html?erro=1");
            exit();
        }
    } catch (Exception $e) {
        error_log("Erro no login: " . $e->getMessage());
        header("Location: login.html?erro=1");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}
?>
