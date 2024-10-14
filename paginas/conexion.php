

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel los corales</title>
  <link rel="stylesheet" href="../style/estilo principal.css">
</head>
<body>
  <div class="container">
    <header>
      <ul class="menu">
        <li><a href="../index.html">Inicio</a></li>
        <li><a href="#">El Hotel</a>
          <ul class="submenu">
            <li><a href="../paginas/Sobre nosotros.html">Sobre Nosotros </a></li>
            <li><a href="../paginas/Responsabilidad social.html">Responsabilidad Social </a></li>
            <li><a href="../paginas/caliquenos.html">Califiquenos</a></li>
            <li><a href="../paginas/politicas de rivacidad.html">Politicas de Privacidad</a></li>
          </ul>
        </li>
        <li><a href="#">Servicios</a>
          <ul class="submenu">
            <li><a href="../paginas/planes especiales.html">Planes Especiales </a></li>
            <li><a href="../paginas/Club coralitos.html">Club Coralitos </a></li>
            <li><a href="habitaciones.html">Habitaciones</a></li>
            <li><a href="../paginas/salon para eventos.html">Salones Para Eventos</a></li>
            <li><a href="../paginas/Recreacion.html">Recreacion </a></li>
            <li><a href="../paginas/zonas humedas.html">Zonas Humedas</li>
              <li><a href="../paginas/Contactos.html">Zonas Humedas</li>
          </ul>
        </li>
        
        <li><a href="../paginas/Contactos.html">Contáctenos</a></li>
        <li><a href="#">Tumaco</a>
          <ul class="submenu">
            <li><a href="../paginas/Dtsgenerales.html">Datos Generales </a></li>
            <li><a href="../paginas/Que hacer en tumaco.html"> Que Hacer en Tumaco</a></li>
          </ul>
          <li><a href="inicio de secion.html">Iniciar sesión</a></li>
        </li>
        <img class="menu-imagen-derecha" src="../multimedia/logo-los-corales.png" alt="Imagen del menú">
      </ul>
      
    </header>
    <main>
      <br>
      <br>
      <br>
      <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contacto";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$nombre = $conn->real_escape_string($_POST['nombre']);
$apellido = $conn->real_escape_string($_POST['apellido']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$edad = $conn->real_escape_string($_POST['edad']);
$genero = $conn->real_escape_string($_POST['genero']);

$sql = "INSERT INTO personas (nombre, apellido, email, telefono, edad, genero) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $apellido, $email, $telefono, $edad, $genero);

if ($stmt->execute()) {
    echo "Registro Exitoso";
} else {
    echo "Error al registrar al usuario: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
    <br>
    <br>
    </main>
    
  </div>
</body>
</html>
