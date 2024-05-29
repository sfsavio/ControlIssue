<?php
session_start(); // Start a new session or resume an existing session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to index.php if not logged in
    exit;
}

// Function to load requests from the JSON file
function loadRequests() {
    $filename = 'requests.json';
    if (!file_exists($filename)) {
        return []; // Return an empty array if the file does not exist
    }
    $data = file_get_contents($filename); // Read the file contents
    return json_decode($data, true); // Decode the JSON data into a PHP array
}

// Function to save requests to the JSON file
function saveRequests($data) {
    $filename = 'requests.json';
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)); // Encode and save the data
}
     date_default_timezone_set('America/Sao_Paulo'); // Set the right timezone
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assunto = $_POST['assunto'];
    $setor = $_POST['setor'];
    $descricao = $_POST['descricao'];

    if (empty($assunto) || empty($setor) || empty($descricao)) {
        header('Location: request_form.php?error=All fields are required!');
        exit;
    }

    $requests = loadRequests(); // Load existing requests

    // Add new request to the requests array
    $newRequest = [
        'assunto' => $assunto,
        'setor' => $setor,
        'descricao' => $descricao,
        'datetime' => date('Y-m-d H:i:s'), // Add current date and time
        'username' => $_SESSION['username'], // Add the username of the requester
        'status' => 'pendente' // Status irá para o JSON com o valor "pendente" por padrão
    ];
    $requests[] = $newRequest; // Add the new request to the array
    saveRequests($requests); // Save the updated requests array

    header('Location: request_form.php?success=Chamado aberto com sucesso!');
    exit;
} else {
    header('Location: request_form.php?error=Erro!');
    exit;
}
?>
