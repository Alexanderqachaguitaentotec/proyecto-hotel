
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel los corales</title>
  <link rel="stylesheet" href="..//style/estilo principal.css">
  <link rel="stylesheet" href="../style/heramias-del-sistemas.css">
  <link rel="stylesheet" href="../style/estilo-formulario-de busqueda-inventario.css">

</head>
<body>
  <div class="container">
<header>
  <ul class="menu1">
    <li><a href="../index.html">Cerrar Secion y Regresar a Inicio</a></li>
    <li><a href="#">Herramietas del Sistema</a>
      <ul class="submenu">
        <li><a href="../paginas/inventario.html">Inventario </a></li>
        <li><a href="../paginas/Personal Del Hotel.html">Personal Del Hotel</a></li>
        <li><a href="../paginas/Habitaciones-formulario.html">Habitaciones </a></li>
        <li><a href="../paginas/Ventas.html">Ventas </a></li>
        <li><a href="../paginas/Facturas.html">Facturas </a></li>
        <li><a href="../paginas/Gatos.html">Gatos </a></li>
      </ul>
      <li><a href="#">Mirar datos ingresados al sistema</a>
        <ul class="submenu">
          <li><a href="../paginas/RRegistro.php">Inventario </a></li>
          <li><a href="../paginas/Registro-personal-del-hotel.php">Trabajadores</a></li>
          <li><a href="../paginas/Registro-habitaciones-del-hotel-formulario.php">Habitaciones </a></li>
          <li><a href="../paginas/Registro-ventas-hotel.php">Ventas </a></li>
          <li><a href="../paginas/Registro-facturas.php">Facturas </a></li>
          <li><a href="../paginas/Registro-gastos-del-hotel.php">Gatos </a></li>
        </ul>
     
      <img class="menu1-imagen-derecha" src="../multimedia/logo-los-corales.png" alt="Imagen del menú">
   
    </li>           
    </ul>
    <br>
    <br>
    <br>
  
</header>
<main>  
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel los corales</title>
  <link rel="stylesheet" href="..//style/estilo principal.css">
  <link rel="stylesheet" href="../style/heramias-del-sistemas.css">
  <link rel="stylesheet" href="../style/estilo-formulario-de busqueda-inventario.css">
</head>
<body>
  <div class="container">

  <main>

  <h1 class="titulo-gestion-empresarial">Registro del Personal</h1>

  <!-- Formulario de búsqueda -->
  <form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="buscar">Buscar:</label>
    <input type="text" name="buscar" id="buscar">
    <button type="submit" name="btnBuscar">Buscar</button>
  </form>

  <!-- Formulario de eliminación -->
  <form class="delete-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="eliminar">ID  de Persona a Eliminar:</label>
    <input type="text" name="eliminar" id="eliminar">
    <button type="submit" name="btnEliminar">Eliminar Producto</button>
  </form>

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_sitio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Funcionalidad de inserción
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $fecha_registro = $conn->real_escape_string($_POST['fecha_registro']);
    $puesto_trabajo = $conn->real_escape_string($_POST['puesto_trabajo']);

    $sql = "INSERT INTO personal_hotel (nombre, apellido, fecha_nacimiento, fecha_registro, puesto_trabajo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $fecha_nacimiento, $fecha_registro, $puesto_trabajo);
    $stmt->execute();
    $stmt->close();
}

// Funcionalidad de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnBuscar'])) {
    $buscar = $conn->real_escape_string($_POST['buscar']);
    $sql_buscar = "SELECT * FROM personal_hotel WHERE nombre LIKE CONCAT('%', ?, '%') OR apellido LIKE CONCAT('%', ?, '%')";
    $stmt_buscar = $conn->prepare($sql_buscar);
    $stmt_buscar->bind_param("ss", $buscar, $buscar);
    $stmt_buscar->execute();
    $result_buscar = $stmt_buscar->get_result();

    if ($result_buscar->num_rows > 0) {
        while ($row_buscar = $result_buscar->fetch_assoc()) {
            echo "ID: " . $row_buscar["id"] . " - Nombre: " . $row_buscar["nombre"] . " - Apellido: " . $row_buscar["apellido"] . "<br>";
        }
    } else {
        echo "No se encontraron resultados para '$buscar'.";
    }
    $stmt_buscar->close();
}

// Funcionalidad de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnEliminar'])) {
    $id_eliminar = $conn->real_escape_string($_POST['eliminar']);
    $sql_eliminar = "DELETE FROM personal_hotel WHERE id = ?";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $id_eliminar);
    if ($stmt_eliminar->execute()) {
        echo "Persona eliminada correctamente.";
    } else {
        echo "Error al eliminar la persona: " . $conn->error;
    }
    $stmt_eliminar->close();
}

// Mostrar todos los datos ingresados
$sql_mostrar = "SELECT * FROM personal_hotel";
$result_mostrar = $conn->query($sql_mostrar);

if ($result_mostrar->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Fecha de Registro</th><th>Puesto de Trabajo</th></tr>";
    while($row_mostrar = $result_mostrar->fetch_assoc()) {
        echo "<tr><td>".$row_mostrar["id"]."</td><td>".$row_mostrar["nombre"]."</td><td>".$row_mostrar["apellido"]."</td><td>".$row_mostrar["fecha_nacimiento"]."</td><td>".$row_mostrar["fecha_registro"]."</td><td>".$row_mostrar["puesto_trabajo"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No hay personal registrado.";
}

// Cerrar conexión
$conn->close();
?>

   
    
  </div>
</body>
</html>

  
 


