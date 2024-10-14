
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
  <h1 class="titulo-gestion-empresarial">Gastos</h1>
  
  <form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="buscar">Buscar :</label>
  <input type="text" name="buscar" id="buscar">
  <button type="submit">Buscar</button>
</form>

<form class="delete-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="eliminar">ID a Eliminar:</label>
  <input type="text" name="idGastoEliminar" id="idGastoEliminar">
  <button type="submit">Eliminar Producto</button>
</form>
<br>
<br>
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "mi_sitio";

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["buscar"])) {
        $searchTerm = $_POST["buscar"];
        $sql = "SELECT * FROM gastos WHERE categoriaGasto LIKE '%$searchTerm%' ORDER BY id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<br><br>Resultados de búsqueda:";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Fecha</th><th>Descripción</th><th>Cantidad</th><th>Categoría</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["fechaGasto"] . "</td>";
                echo "<td>" . $row["descripcionGasto"] . "</td>";
                echo "<td>$" . $row["montoGasto"] . "</td>";
                echo "<td>" . $row["categoriaGasto"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<br>No se encontraron resultados para la búsqueda: '$searchTerm'";
        }
    } elseif (isset($_POST["idGastoEliminar"])) {
        $expenseID = $_POST["idGastoEliminar"];
        $sql = "DELETE FROM gastos WHERE id = $expenseID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<br>Gasto eliminado correctamente.";
        } else {
            echo "<br>Error al eliminar el gasto: " . $conn->error;
        }
    } else {
        $expenseDate = $_POST["fechaGasto"];
        $expenseDescription = $_POST["descripcionGasto"];
        $expenseAmount = $_POST["montoGasto"];
        $expenseCategory = $_POST["categoriaGasto"];

        $sql = "INSERT INTO gastos (fechaGasto, descripcionGasto, montoGasto, categoriaGasto) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $expenseDate, $expenseDescription, $expenseAmount, $expenseCategory);

        if ($stmt->execute()) {
            echo "Gasto registrado correctamente.";

            $sql = "SELECT id, fechaGasto, descripcionGasto, montoGasto, categoriaGasto FROM gastos WHERE fechaGasto = '$expenseDate' ORDER BY id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<br><br>Gasto registrado:";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Fecha</th><th>Descripción</th><th>Monto</th><th>Categoría</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fechaGasto"] . "</td>";
                    echo "<td>" . $row["descripcionGasto"] . "</td>";
                    echo "<td>$" . $row["montoGasto"] . "</td>";
                    echo "<td>" . $row["categoriaGasto"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<br>No se encontraron detalles de gasto registrados.";
            }
        } else {
            echo "Error al registrar el gasto: " . $stmt->error;
        }
    }
}

// Display all records
$sql = "SELECT * FROM gastos ORDER BY id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<br><br>Todos los gastos:";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Fecha</th><th>Descripción</th><th>Cantidad</th><th>Categoría</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["fechaGasto"] . "</td>";
        echo "<td>" . $row["descripcionGasto"] . "</td>";
        echo "<td>$" . $row["montoGasto"] . "</td>";
        echo "<td>" . $row["categoriaGasto"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<br>No se encontraron gastos registrados.";
}

// Close database connection
$conn->close();
?>
</main>
    
</div>
</body>
</html>

  
  

  