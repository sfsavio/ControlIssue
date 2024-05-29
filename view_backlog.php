<?php
session_start(); // Start a new session or resume an existing session

// Function to load login backlog from the JSON file
function loadLoginBacklog() {
    $filename = 'login_backlog.json';
    if (!file_exists($filename)) {
        return []; // Return an empty array if the file does not exist
    }
    $data = file_get_contents($filename); // Read the file contents
    return json_decode($data, true); // Decode the JSON data into a PHP array
}

// Check for admin privileges
if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php'); // Redirect to index.php if not logged in or not an admin
    exit;
}

$loginBacklog = loadLoginBacklog(); // Load existing backlog
$loginBacklog = array_reverse($loginBacklog); // Inverte a ordem do array para exibir os últimos itens no topo
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Backlog</title>
</head>
<body>
    <h2>Login Backlog</h2>
    <?php if (empty($loginBacklog)): ?>
        <!-- If there is no backlog, print message -->
        <p>No login records available.</p> 
    <?php else: ?>

         <!-- Table with the backlog -->
        <table border="1">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loginBacklog as $entry): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($entry['username']); ?></td>
                        <td><?php echo htmlspecialchars($entry['nome']); ?></td>
                        <td><?php echo htmlspecialchars($entry['datetime']); ?></td>
                    </tr>
                <?php endforeach; ?> 
                 <!-- End of iterarion -->
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <a href="home.php">Voltar</a><br><br>
    <a href="logout.php">Sair</a>
</body>
</html>
