<?php
	session_start(); // Start a new session or resume an existing session

	session_unset(); // Free all session variables

	session_destroy(); // Destroy the session

	header('Location: index.php'); // Redirect to index.php
?>
