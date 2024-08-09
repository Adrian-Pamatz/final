<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config.php');

//Crear(CREATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create')
{
    $name = $_POST['name'];
    $areamedica = $_POST['areamedica'];
    $telefono = $_POST['telefono'];
    $añosexperiencia = $_POST['añosexperiencia'];

    $sql = "INSERT INTO medicos (name, areamedica, telefono, añosexperiencia) VALUES ('$name', '$areamedica', '$telefono', '$añosexperiencia')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Meidco registrado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


//Actualizar (Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update'){
    $medicoid = $_POST['medicoid'];
    $name = $_POST['name'];
    $areamedica = $_POST['areamedica'];
    $telefono = $_POST['telefono'];
    $añosexperiencia = $_POST['añosexperiencia'];

    $sql = "UPDATE medicos SET name='$name', areamedica='$areamedica', telefono='$telefono', añosexperiencia='$añosexperiencia' WHERE medicoid=$medicoid";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Datos del Medico actualizados correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Borrar (Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete'){
    $medicoid = $_POST['medicoid'];

    $sql = "DELETE FROM medicos WHERE medicoid=$medicoid";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Datos del Medico eliminados correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Leer (Read)
$sql = "SELECT medicoid, name, areamedica, telefono, añosexperiencia FROM medicos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Medicos</title>
    <link rel="stylesheet" href="ejercicio.css">
    <script src="scriptejercicio.js"></script>
</head>
<body>
<div class="container">
        <h1>Lista de Medicos</h1>
        <form id="createForm" method="POST" action="index.php">
            <input type="hidden" name="action" value="create">
            <input type="text" name="name" id="name" placeholder="Nombre" required>
            <input type="text" name="areamedica" id="areamedica" placeholder="Area Medica" required>
            <input type="text" name="telefono" id="telefono" placeholder="Numero de Telefono" required>
            <input type="text" name="añosexperiencia" id="añosexperiencia" placeholder="Años de Experiencia" required>
            <button type="submit"> "Agregar datos del Medico" </button>
        </form>

        <ul id="userList">
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<li>";
                            echo htmlspecialchars($row["name"]). " - " . htmlspecialchars($row["areamedica"]). " - " . htmlspecialchars($row["telefono"]). " - " . htmlspecialchars($row["añosexperiencia"]);
                            echo ' <button class="editBtn" data-medicoid="' . $row["medicoid"] . '" data-name="' . htmlspecialchars($row["name"]) . '" data-areamedica="' . htmlspecialchars($row["areamedica"]) . '" data-telefono"' . htmlspecialchars($row["telefono"]) . '"data-añosexperiencia"' . htmlspecialchars($row["añosexperiencia"]) . '">Editar</button>';
                            echo ' <form class="deleteForm" method="POST" action="index.php" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="medicoid" value="' . $row["medicoid"] . '">
                                <button type="submit">Eliminar</button>
                            </form>';
                            echo "</li>";
                        }
                    } else {
                        echo "<p>No hay usuarios registrados.</p>";
                    }
                        ?>
                        </ul>
                
                        <div id="editFormContainer" style="display:none;">
            <h2>Editar Datos del Medico</h2>
            <form id="editForm" method="POST" action="index.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="medicoid" id="editmedicoid">
                <input type="text" name="name" id="editName" placeholder="Nombre" required>
                <input type="text" name="areamedica" id="editareamedica" placeholder="Area Medica" required>
                <input type="text" name="telefono" id="edittelefono" placeholder="Numero de Telefono" required>
                <input type="text" name="añosexperiencia" id="editañosexperiencia" placeholder="Años de Experiencia" required>
                <button type="submit">Actualizar Datos de Medico</button>
            </form>
        </div>
    </div>

</body>
</html>