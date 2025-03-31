<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la BD
$conn = new mysqli("127.0.0.1", "root", "12345678y%", "proyectos");
if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Primero obtenemos el nombre de la imagen para borrarla
    $stmt = $conn->prepare("SELECT imagen FROM proyectos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $proyecto = $result->fetch_assoc();
    
    if ($proyecto) {
        // Eliminar la imagen si no es la default
        if ($proyecto['imagen'] !== 'default.jpg') {
            @unlink('img/' . $proyecto['imagen']);
        }
        
        // Eliminar el proyecto de la BD
        $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

header("Location: panel.php");
exit;
?>