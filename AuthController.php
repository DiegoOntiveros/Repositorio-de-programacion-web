<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $usuario = $_POST['mail'] ?? '';
    $contrasena = $_POST['password'] ?? '';
    
    // Hardcoded credentials
    $usuario_valido = 'admin';
    $contrasena_valida = '12345';
    
    // Validate credentials
    if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
        // Redirect to home on success
        header('Location: home.html');
        exit();
    } else {
        // Redirect back to login on failure
        header('Location: login.html');
        exit();
    }
} else {
    // If not a POST request, redirect to login
    header('Location: login.html');
    exit();
}