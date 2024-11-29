<?php
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    try {
        $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hash_senha);
        $stmt->fetch();

        if ($hash_senha && password_verify($senha, $hash_senha)) {
            echo "Login válido!";
        } else {
            echo "Credenciais inválidas!";
        }
    } catch (Exception $e) {
        error_log("Erro na validação: " . $e->getMessage());
        echo "Erro ao validar a conta.";
    }
} else {
    echo "Acesso não permitido.";
}
?>
