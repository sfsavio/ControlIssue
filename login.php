<?php
session_start(); // Start a new session or resume an existing session

// Function to load users from the JSON file
function loadUsers() {
    $filename = 'users.json';
    if (!file_exists($filename)) {
        return []; // Return an empty array if the file does not exist
    }
    $data = file_get_contents($filename); // Read the file contents
    return json_decode($data, true); // Decode the JSON data into a PHP array
}

// Function to load login backlog from the JSON file
function loadLoginBacklog() {
    $filename = 'login_backlog.json';
    if (!file_exists($filename)) {
        return []; // Return an empty array if the file does not exist
    }
    $data = file_get_contents($filename); // Read the file contents
    return json_decode($data, true); // Decode the JSON data into a PHP array
}

// Function to save login backlog to the JSON file
function saveLoginBacklog($data) {
    $filename = 'login_backlog.json';
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)); // Encode and save the data
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header('Location: index.php?error=Username and password are required!');
        exit;
    }

    $users = loadUsers(); // Load existing users

    date_default_timezone_set('America/Sao_Paulo'); // Set the right timezone

    // Check if the user exists and the password matches
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['username'] = $username; // Set the session username
            $_SESSION['nome'] = $user['nome']; // Set the session name
            $_SESSION['is_admin'] = $user['is_admin']; // Set the session is_admin

            // Add login entry to the backlog
            $loginBacklog = loadLoginBacklog(); // Load existing backlog
            $loginEntry = [
                'username' => $username,
                'nome' => $user['nome'],
                'datetime' => date('Y-m-d H:i:s') // Add current date and time
            ];
            $loginBacklog[] = $loginEntry; // Add the new entry to the backlog
            saveLoginBacklog($loginBacklog); // Save the updated backlog

            header('Location: home.php'); // Redirect to home.php
            exit;
        }
    }

    // If the user does not exist or the password is incorrect
    header('Location: index.php?error=Usuário ou senha inválidos!');
    exit;
} else {
    header('Location: index.php?error=Invalid request method!');
    exit;
}
?>
