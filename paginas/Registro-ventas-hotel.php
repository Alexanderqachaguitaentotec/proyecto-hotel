<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Los Corales</title>
  <link rel="stylesheet" href="..//style/estilo principal.css">
  <link rel="stylesheet" href="../style/heramias-del-sistemas.css">
  <link rel="stylesheet" href="../style/estilo-formulario-de busqueda-inventario.css">

</head>
<body>
<div class="container">
<header>
  <ul class="menu1">
    <li><a href="../index.html">Cerrar Sesión y Regresar a Inicio</a></li>
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
  <h1 class="titulo-gestion-empresarial">Ventas o Ingresos</h1>

  <form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="buscar">Buscar:</label>
    <input type="text" name="buscar" id="buscar">
    <button type="submit">Buscar</button>
  </form>

  <form class="delete-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="eliminar">ID a Eliminar:</label>
    <input type="text" name="eliminar" id="eliminar">
    <button type="submit" name="btnEliminar">Eliminar Producto</button>
  </form>

  <main>
    <?php
    // Datos de conexión a la base de datos
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'mi_sitio';

    // Conexión a la base de datos
    $conn = new mysqli($host, $user, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Procesamiento del formulario de inserción
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fechaIngreso'])) {
        // Validar y sanitizar datos del formulario 
        $fechaIngreso = mysqli_real_escape_string($conn, trim($_POST['fechaIngreso']));
        $tipoIngreso = mysqli_real_escape_string($conn, trim($_POST['tipoIngreso']));
        $montoIngreso = mysqli_real_escape_string($conn, trim($_POST['montoIngreso']));
        $formaPago = mysqli_real_escape_string($conn, trim($_POST['formaPago']));
        $metodoPago = isset($_POST['metodoPago']) ? mysqli_real_escape_string($conn, trim($_POST['metodoPago'])) : null;
        $observaciones = isset($_POST['observaciones']) ? mysqli_real_escape_string($conn, trim($_POST['observaciones'])) : null;

        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO ventas (fechaIngreso, tipoIngreso, montoIngreso, formaPago, metodoPago, observaciones)
                VALUES ('$fechaIngreso', '$tipoIngreso', '$montoIngreso', '$formaPago', '$metodoPago', '$observaciones')";

        // Ejecutar la consulta y verificar si se insertó correctamente
        if ($conn->query($sql) === TRUE) {
            echo "Ingreso registrado correctamente";
        } else {
            echo "Error al registrar el ingreso: " . $conn->error;
        }
    }

    // Procesamiento del formulario de búsqueda
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
        $buscar = mysqli_real_escape_string($conn, trim($_POST['buscar']));

        // Preparar la consulta SQL para la búsqueda
        $consulta = "SELECT * FROM ventas WHERE fechaIngreso LIKE '%$buscar%' OR tipoIngreso LIKE '%$buscar%'";
        $resultado = $conn->query($consulta);

    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
        $expenseID = $_POST["eliminar"];
        $sql = "DELETE FROM ventas WHERE id = $expenseID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<br>Gasto eliminado correctamente.";
        } else {
            echo "<br>Error al eliminar el gasto: " . $conn->error;
        }
    }

    // Mostrar los resultados de la búsqueda
    if (isset($resultado) && $resultado->num_rows > 0) {
        echo "<h3>Resultados de la búsqueda</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Fecha Ingreso</th><th>Tipo Ingreso</th><th>Monto Ingreso</th><th>Forma Pago</th><th>Método Pago</th><th>Observaciones</th></tr>";
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['fechaIngreso']}</td><td>{$row['tipoIngreso']}</td><td>{$row['montoIngreso']}</td><td>{$row['formaPago']}</td><td>{$row['metodoPago']}</td><td>{$row['observaciones']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }

    // Mostrar todos los datos ingresados
    $sql_mostrar = "SELECT * FROM ventas";
    $result_mostrar = $conn->query($sql_mostrar);

    if ($result_mostrar->num_rows > 0) {
        echo "<h3>Datos ingresados</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Fecha Ingreso</th><th>Tipo Ingreso</th><th>Monto Ingreso</th><th>Forma Pago</th><th>Método Pago</th><th>Observaciones</th></tr>";
        while ($row = $result_mostrar->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['fechaIngreso']}</td><td>{$row['tipoIngreso']}</td><td>{$row['montoIngreso']}</td><td>{$row['formaPago']}</td><td>{$row['metodoPago']}</td><td>{$row['observaciones']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron datos ingresados.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
  </main>
</main>
</div>
</body>
</html>
