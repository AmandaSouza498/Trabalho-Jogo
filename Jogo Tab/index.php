<?php
session_start();

if (!isset($_SESSION['numero_aleatorio'])) {
    $_SESSION['numero_aleatorio'] = rand(0, 100);
    $_SESSION['tentativas'] = 0;
}

$mensagem = "Iniciar Jogo";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adivinhar = (int)$_POST['guess'];
    $_SESSION['tentativas']++;

    if ($adivinhar === $_SESSION['numero_aleatorio']) {
        $mensagem = "Parabéns, você acertou! Genial {$_SESSION['tentativas']} tentativas.";
        unset($_SESSION['numero_aleatorio']);
    } elseif (abs($adivinhar - $_SESSION['numero_aleatorio']) <= 3) {
        $mensagem = 'Quente';
    } else {
        $mensagem = 'Frio';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quente e Frio</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: wheat;
            color: purple;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: lightblue;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 1px 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-transform: uppercase;
            color: lightgray;
            text-shadow: 1px 1px 2px black;
            text-align: center;
            text-decoration: underline;
        }
        form {
            margin-top: 20px;
        }
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .mensagem {
            font-weight: bold;
            margin-top: 10px;
            color: black;
        }
        a {
            text-decoration: none;
            color: #0056b3;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quente e Frio</h1>
        <p>Coloque seu palpite.</p>
        <form method="POST" action="">
            <input type="number" name="guess" min="0" max="100" required placeholder="Digite um número">
            <button type="submit" name="enviar">Enviar</button>
        </form>
        <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
        <p><a href="reset.php">Reiniciar Jogo</a></p>
    </div>
</body>
</html>
