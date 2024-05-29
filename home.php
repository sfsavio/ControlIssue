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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Seja bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h2> <!-- Display the user's name -->
    <!-- Checa se o usuário tem as permissões de administrador -->
    <?php if ($_SESSION['is_admin']): ?> 
        <!-- Somente para admins -->
        <p><a href="view_backlog.php">Login Backlog</a></p>
        <p><a href="manage_requests.php">Gerenciar Chamados</a></p>
    <?php endif; ?>
    
    <!-- Para todos os usuários -->
    <a href="request_form.php">Criar chamado</a> <br> <br>
    <a href="logout.php">Logout</a> <!-- Logout link -->
</body>
</html>
