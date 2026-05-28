<?php

session_start();
require_once '../config/connect.php';
$usuario = $_POST['inUser'];
$senha = $_POST['inPass'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $dados = $result->fetch_assoc();

    if (password_verify($senha, $dados['senha'])) {
        $_SESSION['usuario'] = $dados['usuario'];
        header ("Location: ../../public/dashboard.php");
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Senha incorreta"
        ]);
    }

} else {
    echo json_encode([
        "success" => false,
        "message" => "Usuário não encontrado"
    ]);
}
?>
