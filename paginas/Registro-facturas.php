
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

  <div class="container">
    <!-- Tu código de encabezado aquí -->
    <main>  
      <h1 class="titulo-gestion-empresarial">Registro de facturas</h1>

      <form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="buscar">Buscar :</label>
        <input type="text" name="buscar" id="buscar">
        <button type="submit">Buscar</button>
      </form>

      <form class="delete-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="eliminar">ID  a Eliminar:</label>
        <input type="text" name="eliminar" id="eliminar">
        <button type="submit">Eliminar Producto</button>
      </form>

      <main>
        <?php
        // Datos de conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mi_sitio";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Procesamiento del formulario de búsqueda
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
            $buscar = mysqli_real_escape_string($conn, trim($_POST['buscar']));

            // Preparar la consulta SQL para la búsqueda
            $consulta = "SELECT * FROM facturas1 WHERE numeroFactura LIKE '%$buscar%' OR nombreProveedor LIKE '%$buscar%'";
            $resultado = $conn->query($consulta);

            if ($resultado && $resultado->num_rows > 0) {
                echo "<br>Resultados de la búsqueda:<br>";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Número de factura</th><th>Fecha de factura</th><th>Nombre del proveedor</th><th>Dirección del proveedor</th><th>Tipo de producto</th><th>Descripción del producto</th><th>Cantidad del producto</th><th>Precio por unidad</th><th>Subtotal</th><th>IVA</th><th>Total</th><th>Método de pago</th></tr>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["numeroFactura"] . "</td><td>" . $row["fechaFactura"] . "</td><td>" . $row["nombreProveedor"] . "</td><td>" . $row["direccionProveedor"] . "</td><td>" . $row["tipoProducto"] . "</td><td>" . $row["descripcionProducto"] . "</td><td>" . $row["cantidadProducto"] . "</td><td>" . $row["precioUnidad"] . "</td><td>" . $row["subtotal"] . "</td><td>" . $row["iva"] . "</td><td>" . $row["total"] . "</td><td>" . $row["metodoPago"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron resultados para la búsqueda.";
            }
        }

        elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
            $expenseID = $_POST["eliminar"];
            $sql = "DELETE FROM facturas1 WHERE id = $expenseID";
            $result = $conn->query($sql);

            if ($result) {
                echo "<br> eliminado correctamente.";
            } else {
                echo "<br>Error al eliminar el factura: " . $conn->error;
            }
        }

        // Obtener los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numeroFactura'])) {
            $numeroFactura = $_POST["numeroFactura"];
            $fechaFactura = $_POST["fechaFactura"];
            $nombreProveedor = $_POST["nombreProveedor"];
            $direccionProveedor = $_POST["direccionProveedor"];
            $tipoProducto = $_POST["tipoProducto"];
            $descripcionProducto = $_POST["descripcionProducto"];
            $cantidadProducto = $_POST["cantidadProducto"];
            $precioUnidad = $_POST["precioUnidad"];
            $subtotal = $_POST["subtotal"];
            $iva = $_POST["iva"];
            $total = $_POST["total"];
            $metodoPago = $_POST["metodoPago"];

            // Insertar los datos en la tabla "facturas1"
            $sql = "INSERT INTO facturas1 (numeroFactura, fechaFactura, nombreProveedor, direccionProveedor, tipoProducto, descripcionProducto, cantidadProducto, precioUnidad, subtotal, iva, total, metodoPago)
            VALUES ('$numeroFactura', '$fechaFactura', '$nombreProveedor', '$direccionProveedor', '$tipoProducto', '$descripcionProducto', '$cantidadProducto', '$precioUnidad', '$subtotal', '$iva', '$total', '$metodoPago')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro creado exitosamente";
            } else {
                echo "Error al crear el registro: " . $conn->error;
            }
        }

        // Realizar una consulta para obtener todos los registros
        $sql = "SELECT * FROM facturas1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Datos ingresados:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Número de factura</th><th>Fecha de factura</th><th>Nombre del proveedor</th><th>Dirección del proveedor</th><th>Tipo de producto</th><th>Descripción del producto</th><th>Cantidad del producto</th><th>Precio por unidad</th><th>Subtotal</th><th>IVA</th><th>Total</th><th>Método de pago</th></tr>";

            // Mostrar cada registro en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["numeroFactura"] . "</td>";
                echo "<td>" . $row["fechaFactura"] . "</td>";
                echo "<td>" . $row["nombreProveedor"] . "</td>";
                echo "<td>" . $row["direccionProveedor"] . "</td>";
                echo "<td>" . $row["tipoProducto"] . "</td>";
                echo "<td>" . $row["descripcionProducto"] . "</td>";
                echo "<td>" . $row["cantidadProducto"] . "</td>";
                echo "<td>" . $row["precioUnidad"] . "</td>";
                echo "<td>" . $row["subtotal"] . "</td>";
                echo "<td>" . $row["iva"] . "</td>";
                echo "<td>" . $row["total"] . "</td>";
                echo "<td>" . $row["metodoPago"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron registros.";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
      </main>
    </div>
</body>
</html>








