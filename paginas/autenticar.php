<?php
// autenticar.php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena = $_POST["contrasena"];

    // Realizar consulta a la base de datos para verificar las credenciales
    
    // Redirigir a otra página web
    header("Location:herramias-del sistemas.html");

    exit; 
}
?>