<?php 
    session_start(); // Inicia a sessão

    // Checa se tem uma mensagem de erro vinda de 'authenticate.php'

    $error_message = 'teste';
    if (isset($_GET['error'])) {
        $error_message = htmlspecialchars($_GET['error']);
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Control - Login</title>
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<!-- onload ???? -->
<body>
    <main>
        <div class="card">
            <div class="top">
                <h2>Entrar</h2>
            </div>

            <!-- Prints one of the two message errors -->
            <div class="mid">
                <p class="status">Status:&nbsp</p>
                <?php
                if (isset($_GET['error'])) {
                    echo '<p>' . ' '. htmlspecialchars($_GET['error']) . '</p>';
                    
                }

            ?>
            </div>
            <!-- Login form -->
            <div class="bot">
                <form action="login.php" method="post">
                    <label for="username">Usuário/Matrícula:</label><br>
                    <input type="text" id="username" name="username" required><br>
                    <label for="password">Senha:</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                    <!-- <input type="submit" value="Login"> -->
                    <button type="submit" >Entrar</button>
            </form>
            </div>
        </div>
    </main>
</body>
</html>
