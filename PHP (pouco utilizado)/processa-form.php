<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiza e coleta os dados
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
    $remember = isset($_POST['remember']) ? "Sim" : "Não";

    // Validação básica
    $erros = [];
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail inválido ou não fornecido.";
    }
    if (empty($senha) || strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resposta do Formulário</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        crossorigin="anonymous"
    />
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 15px;
        }
        .response-card {
            max-width: 500px;
            width: 100%;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        .card-body {
            padding: 2rem;
        }
        .data-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .data-item strong {
            color: #495057;
        }
        .btn-back {
            width: 100%;
            padding: 0.75rem;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        .alert {
            border-radius: 10px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        crossorigin="anonymous"
    ></script>
</head>
<body>
    <div class="container">
        <div class="response-card">
            <?php if (empty($erros)): ?>
                <div class="card-header bg-info text-white">
                    Dados Recebidos com Sucesso
                </div>
                <div class="card-body">
                    <div class="data-item">
                        <strong>Email:</strong>
                        <span><?php echo htmlspecialchars($email); ?></span>
                    </div>
                    <div class="data-item">
                        <strong>Senha:</strong>
                        <span>[Ocultada por segurança]</span>
                    </div>
                    <div class="data-item">
                        <strong>Lembrar-me:</strong>
                        <span><?php echo htmlspecialchars($remember); ?></span>
                    </div>
                    <a href="bootstrap.html" class="btn btn-primary btn-back">Voltar ao Formulário</a>
                </div>
            <?php else: ?>
                <div class="card-header bg-danger text-white">
                    Erros no Formulário
                </div>
                <div class="card-body">
                    <?php foreach ($erros as $erro): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($erro); ?>
                        </div>
                    <?php endforeach; ?>
                    <a href="index.html" class="btn btn-primary btn-back">Voltar ao Formulário</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
} else {
    // Se não for POST, redireciona para o formulário
    header("Location: index.html");
    exit();
}
?>