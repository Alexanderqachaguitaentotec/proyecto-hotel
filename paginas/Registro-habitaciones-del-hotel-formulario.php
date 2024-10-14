
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
  <br>
  <br>
  <h1 class="titulo-gestion-empresarial">Habitacion</h1>
  

<form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="buscar">Buscar Por Nombres:</label>
    <input type="text" name="buscar" id="buscar">
    <button type="submit" name="submitBuscar">Buscar</button>
</form>

<form class="delete-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="eliminar">ID de la Persona:</label>
    <input type="text" name="eliminar" id="eliminar">
    <button type="submit" name="submitEliminar">Eliminar Producto</button>
</form>
<br>
<br>
  
<br>
<br>
<main>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel los corales</title>
    <!-- Tus estilos CSS y otros elementos del head aquí -->
</head>
<body>
    <div class="container">
        <!-- Tu código HTML aquí -->

        <main>
            <!-- Formularios de búsqueda y eliminación -->

            <?php
            // Detalles de conexión a la base de datos
            $dbHost = "localhost"; 
            $dbUsername = "root"; 
            $dbPassword = ""; 
            $dbName = "mi_sitio"; 

            // Establece conexión a la base de datos
            $dbConnection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

            if (!$dbConnection) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            // Maneja la búsqueda
            if (isset($_POST['submitBuscar'])) {
                $terminoBusqueda = mysqli_real_escape_string($dbConnection, $_POST['buscar']);
                $sqlBuscar = "SELECT * FROM habitacion WHERE nombre LIKE '%{$terminoBusqueda}%' OR apellido LIKE '%{$terminoBusqueda}%'";
                $resultadoBuscar = mysqli_query($dbConnection, $sqlBuscar);

                // Muestra los resultados de la búsqueda
                while ($fila = mysqli_fetch_assoc($resultadoBuscar)) {
                    echo "ID: " . $fila['id'] . " - Nombre: " . $fila['nombre'] . " " . $fila['apellido'] . "<br>";
                }
            }

            // Maneja la eliminación
            if (isset($_POST['submitEliminar'])) {
                $idEliminar = mysqli_real_escape_string($dbConnection, $_POST['eliminar']);
                $sqlEliminar = "DELETE FROM habitacion WHERE id = {$idEliminar}";
                $resultadoEliminar = mysqli_query($dbConnection, $sqlEliminar);

                if (mysqli_affected_rows($dbConnection) > 0) {
                    echo "Registro eliminado con éxito.";
                } else {
                    echo "No se encontró el registro para eliminar.";
                }
            }

            // Muestra todos los registros de la tabla habitacion
            $sqlMostrar = "SELECT * FROM habitacion";
            $resultadoMostrar = mysqli_query($dbConnection, $sqlMostrar);

            echo "<h2>Listado de Habitaciones</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Fecha Llegada</th><th>Fecha Salida</th><th>Número Habitación</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultadoMostrar)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellido'] . "</td>";
                echo "<td>" . $fila['fecha_llegada'] . "</td>";
                echo "<td>" . $fila['fecha_salida'] . "</td>";
                echo "<td>" . $fila['numero_habitacion'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Maneja el envío del formulario
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
                // Verifica si las claves existen antes de usarlas
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $fechaLlegada = $_POST['fecha-Llegada'];
                $fechaSalida = $_POST['fecha-Salida'];
                $numeroHabitacion = isset($_POST['numero-Habitacion']) ? $_POST['numero-Habitacion'] : NULL;

                // Continúa con la lógica de inserción solo si los campos requeridos están presentes
                if ($nombre && $apellido && $fechaLlegada && $fechaSalida) {
                    $sql = "INSERT INTO habitacion (nombre, apellido, fecha_llegada, fecha_salida, numero_habitacion) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($dbConnection, $sql);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $fechaLlegada, $fechaSalida, $numeroHabitacion);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "¡Registro de huésped exitoso!";
                        } else {
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error: " . mysqli_error($dbConnection);
                    }
                } else {
                    echo "Por favor, completa todos los campos requeridos.";
                }
            }

            // Cierra la conexión a la base de datos
            mysqli_close($dbConnection);
            ?>

        </main>
    </div>
</body>
</html>






</main>


    
    </div>
</body>
</html>
























