<?php
session_start(); // Start a new session or resume an existing session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to index.php if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Form</title>
</head>
<body>
    <h2>Request Form</h2>
     <p>Welcome, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p> <!-- Display the user's name -->
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
    } elseif (isset($_GET['success'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_GET['success']) . '</p>';
    }
    ?>
    <form action="submit_request.php" method="post">
        <label for="assunto">Assunto:</label><br>
        <input type="text" id="assunto" name="assunto" required><br><br>

        <label for="setor">Setor:</label><br>
        <select id="setor" name="setor" required>
            <option value="assesoria">Assesoria</option>
            <option value="agendamento">Agendamento</option>
            <option value="almoxarifado">Almoxarifado</option>
            <option value="clinica_medica">Clínica Médica</option>
            <option value="CME">CME</option>
            <option value="compras">Compras</option>
            <option value="conforto_medico">Conforto Médico</option>
            <option value="departamento_pessoal">Departamento Pessoal</option>
            <option value="farmacia">Farmácia</option>
            <option value="faturamento">Faturamento</option>
            <option value="financeiro">Financeiro</option>
            <option value="manutencao">Manutenção</option>
            <option value="maternidade">Maternidade</option>
            <option value="posto_enfermagem_clinica">Posto de Enfermagem - Clínica</option>
            <option value="posto_enfermagem_pronto_atendimento">Posto de Enfermagem - Pronto Atendimento</option>
            <option value="recepcao_principal">Recepção - Principal</option>
            <option value="raio_x">Raio X</option>
            <option value="recepcao_pronto_atendimento">Recepção - Pronto Atendimento</option>
            <option value="SAME">SAME</option>
            <option value="SND">SND</option>
            <option value="tesouraria">Tesouraria</option>
            <option value="triagem">Triagem</option>
        </select><br><br>

        <label for="descricao">Descrição do Problema:</label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Enviar">
    </form>
    <br>
    <a href="home.php">Voltar</a><br><br>
    <a href="logout.php">Sair</a>
</body>
</html>
