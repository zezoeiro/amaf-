<?php
function get_connection() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "amaf";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    return $conn;
}

$conn = get_connection();
?>
