<?php
session_start(); // Start a new session or resume an existing session

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['nome'])) {
    header('Location: index.php'); // Redirect to index.php if not logged in
    exit;
}
?>
<!-- Corpo -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <!-- Ubuntu Font  -->
    <link rel="stylesheet" type="text/css" href="./styles/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <!-- Ubuntu Font  -->
</head>
<body>
    <header>
        <nav>
            <p><span><?php echo htmlspecialchars($_SESSION['nome']); ?>!</span></p>
            <!-- Display the user's name -->
            
            <p ><a href="home.php">Início</a></p>

            <p><a href="request_form.php">Criar chamado</a></p>

            <!-- Checa se o usuário tem as permissões de administrador -->
            <?php if ($_SESSION['is_admin']): ?>
                <!-- Somente para admins -->
                <p><a href="view_backlog.php">Login Backlog</a></p>
                <p><a href="manage_requests.php">Gerenciar Chamados</a></p>
            <?php endif; ?>

            <p><a href="logout.php">Sair</a></p> <!-- Logout link -->
        </nav>
    </header>
</body>
</html>