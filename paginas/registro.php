<?php
// registro.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre_usuario = $_POST["nombre_usuario"];
  $correo = $_POST["correo"];
  $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); // Hash de la contraseña

  // Conexión a la base de datos
  $conexion = new mysqli("localhost", "root", "", "mi_sitio");

  // Insertar datos en la tabla de usuarios
  $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES ('$nombre_usuario', '$correo', '$contrasena')";

  if ($conexion->query($sql) === TRUE) {
    // Registro exitoso
    header("Location:inicio de secion.html"); // Redirigir a otra página
    exit;
  } else {
    // Error al registrar
    echo "Error al registrar: " . $conexion->error;
  }

  $conexion->close();
}
?>
