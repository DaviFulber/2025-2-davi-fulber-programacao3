<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiza e coleta os dados
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
    $remember = isset($_POST['remember']) ? "Sim" : "Não";

    // Validação básica
    $erros = [];
    if (empty($email)) {
        $erros[] = "O campo email é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email informado não é válido.";
    }
    if (empty($senha)) {
        $erros[] = "O campo senha é obrigatório.";
    }

    // Exibe os resultados ou erros
    if (empty($erros)) {
        echo "<h2>Dados Recebidos:</h2>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Senha:</strong> " . htmlspecialchars($senha) . "</p>";
        echo "<p><strong>Lembrar-me:</strong> " . htmlspecialchars($remember) . "</p>";
        echo '<a href="index.html" class="btn btn-primary">Voltar</a>';
    } else {
        echo "<h2>Erros no Formulário:</h2>";
        foreach ($erros as $erro) {
            echo "<p style='color: red;'>$erro</p>";
        }
        echo '<a href="index.html" class="btn btn-primary">Voltar</a>';
    }
} else {
    // Se não for POST, redireciona para o formulário
    header("Location: index.html");
    exit();
}
?>