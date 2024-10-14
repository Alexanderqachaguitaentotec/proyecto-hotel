<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel los corales</title>
  <link rel="stylesheet" href="../style/estilo principal.css">
  <link rel="stylesheet" href="../style/formulario-inicio de secio.css">

</head>
<body class="imagen-fondo">
  <div class="container">
    <header>
      <ul class="menu">
        <li><a href="../index.html">Inicio</a></li>
        <li><a href="#">El Hotel</a>
          <ul class="submenu">
            <li><a href="../paginas/Sobre nosotros.html">Sobre Nosotros </a></li>
            <li><a href="../paginas/Responsabilidad social.html">Responsabilidad Social </a></li>
            <li><a href="../paginas/caliquenos.html">Califiquenos</a></li>
            <li><a href="../paginas/politicas de rivacidad.html">Politicas de Privacidad </a></li>
          </ul>
        </li>
        <li><a href="#">Servicios</a>
          <ul class="submenu">
            <li><a href="../paginas/planes especiales.html">Planes Especiales </a></li>
            <li><a href="../paginas/Club coralitos.html">Club Coralits </a></li>
            <li><a href="../paginas/habitaciones.html">Habitaciones</a></li>
            <li><a href="../paginas/salon para eventos.html">Salones Para Eventos</a></li>
            <li><a href="../paginas/Recreacion.html">Recreacion </a></li>
            <li><a href="../paginas/zonas humedas.html">Zonas Humedas</li>
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
      <h1 class="titulo-bienvenida">BIENVENIDOS A HOTEL LOS CORALES EN TUMACO! RESERVA EXITOSA</h1>
      <br>
      <br>
      <br>
      <?php
$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "";
$db_name = "mi_sitio";

// Crea una conexión a la base de datos
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Obtiene los datos del formulario
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$fecha_entrada = $_POST["fecha_entrada"];
$fecha_salida = $_POST["fecha_salida"];
$numero_personas = $_POST["numero_personas"];
$tipo_habitacion = $_POST["tipo_habitacion"];

// Prepara y ejecuta la consulta SQL para insertar 
$sql = "INSERT INTO reservas (nombre, apellidos, fecha_entrada, fecha_salida, numero_personas, tipo_habitacion)
        VALUES ('$nombre', '$apellidos', '$fecha_entrada', '$fecha_salida', '$numero_personas', '$tipo_habitacion')";

if ($mysqli->query($sql) === TRUE) {
    echo "¡Nuevo registro creado exitosamente!";
    
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Cierra la conexión

$mysqli->close();
?>
      
    </main>
  <footer>
    <p>Encuéntrenos en:</p>
    <p>Isla del Morro, Sector El Morro, Tumaco, Nariño, Colombia</p>
    <p><strong>2022-Hotel Los Corales - Tumaco</strong></p>
    <p>00 (+57) 317 436 8949<br>(+57) 312 841 1949</p>
    <p>RNT 15329</p>
    <p>info@hotelloscorales.com</p>
  </footer>
  
  </div>
</body>

</html>
     
      
      <br>
      <br>
    </main>
    <footer>
      <p>Encuéntrenos en:</p>
      <p>Isla del Morro, Sector El Morro, Tumaco, Nariño, Colombia</p>
      <p><strong>2022-Hotel Los Corales - Tumaco</strong></p>
      <p>00 (+57) 317 436 8949<br>(+57) 312 841 1949</p>
      <p>RNT 15329</p>
      <p>info@hotelloscorales.com</p>
    </footer>
  </div>
</body>
</html>






















      