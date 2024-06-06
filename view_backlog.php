<?php
session_start(); // Start a new session or resume an existing session

// Function to load login backlog from the JSON file
function loadLoginBacklog()
{
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
    <link rel="stylesheet" type="text/css" href="./styles/viewbacklog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="usuario">
                <p>Seja bem-vindo, <span><?php echo htmlspecialchars($_SESSION['nome']); ?>!</span></p>
                <!-- Display the user's name -->
            </div>
            <div class="sair">
                <p><a href="logout.php">Sair</a></p> <!-- Logout link -->
            </div>
        </nav>
    </header>
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
    <!-- <a href="home.php">Voltar</a><br><br>
    <a href="logout.php">Sair</a> -->
</body>

</html>