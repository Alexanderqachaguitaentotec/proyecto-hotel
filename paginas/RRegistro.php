<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel los corales</title>
  <link rel="stylesheet" href="../style/estilo principal.css">
  <link rel="stylesheet" href="../style/heramias-del-sistemas.css">
  <link rel="stylesheet" href="../style/estilo-formulario-de busqueda-inventario.css">
</head>
<body>
<div class="container">
<header>
  <ul class="menu1">
    <li><a href="../index.html">Cerrar Secion y Regresar a Inicio</a></li>
    <li><a href="#">Herramientas del Sistema</a>
      <ul class="submenu">
        <li><a href="../paginas/inventario.html">Inventario</a></li>
        <li><a href="../paginas/Personal Del Hotel.html">Personal Del Hotel</a></li>
        <li><a href="../paginas/Habitaciones-formulario.html">Habitaciones</a></li>
        <li><a href="../paginas/Ventas.html">Ventas</a></li>
        <li><a href="../paginas/Facturas.html">Facturas</a></li>
        <li><a href="../paginas/Gatos.html">Gatos</a></li>
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
  <br>
  <br>
  <h1 class="titulo-gestion-empresarial">Inventario</h1>

  <form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="buscar">Buscar Producto:</label>
    <input type="text" name="buscar" id="buscar">
    <button type="submit">Buscar</button>
  </form>

  <form class="delete-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="eliminar">ID del Producto a Eliminar:</label>
    <input type="text" name="eliminar" id="eliminar">
    <button type="submit">Eliminar Producto</button>
  </form>

  

  <br>
  <br>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_sitio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Búsqueda de producto por nombre
    if (isset($_POST["buscar"])) {
        $buscar = $conn->real_escape_string($_POST["buscar"]);
        $sql = "SELECT * FROM inventario WHERE producto LIKE '%$buscar%'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<br>Resultados de la búsqueda:<br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Fecha</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["producto"] . "</td><td>" . $row["cantidad"] . "</td><td>$" . number_format($row["precio"], 2) . "</td><td>" . $row["fecha"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados para la búsqueda.";
        }
    }

    // Eliminación de producto por ID
    if (isset($_POST["eliminar"])) {
        $eliminar = $conn->real_escape_string($_POST["eliminar"]);
        $sql = "DELETE FROM inventario WHERE id = $eliminar";
        if ($conn->query($sql) === TRUE) {
            echo "Producto con ID $eliminar eliminado correctamente.";
        } else {
            echo "Error al eliminar el producto.";
        }
    }

    // Inserción de nuevo producto
    if (isset($_POST["producto"]) && isset($_POST["cantidad"]) && isset($_POST["precio"])) {
        $producto = $conn->real_escape_string($_POST["producto"]);
        $cantidad = $conn->real_escape_string($_POST["cantidad"]);
        $precio = $conn->real_escape_string($_POST["precio"]);
        $sql_insert = "INSERT INTO inventario (producto, cantidad, precio) VALUES ('$producto', $cantidad, $precio)";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Nuevo producto agregado al inventario.";
        } else {
            echo "Error al agregar el producto.";
        }
    }
}

// Mostrar inventario
$sql_select = "SELECT * FROM inventario";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<br>Datos almacenados en la base de datos:<br>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Fecha</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["producto"] . "</td><td>" . $row["cantidad"] . "</td><td>$" . number_format($row["precio"], 2) . "</td><td>" . $row["fecha"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No hay datos almacenados.";
}

$conn->close();

?>

</div>
</body>
</html>