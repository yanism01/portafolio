<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la BD
$conn = new mysqli("127.0.0.1", "root", "12345678y%", "proyectos");
if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);

$mensaje = '';
$error = '';

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    
    // Procesar la imagen
    $nombre_imagen = 'default.jpg';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre_imagen = uniqid() . '.' . $extension;
        // $ruta_destino = 'img/' . $nombre_imagen;
        // Por esta versión mejorada:
        $directorio_img = __DIR__ . '/../img/'; // Ruta absoluta al directorio img
        if (!file_exists($directorio_img)) {
            mkdir($directorio_img, 0755, true); // Crea el directorio si no existe
        }
        $ruta_destino = $directorio_img . $nombre_imagen;
        
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            $error = "Error al subir la imagen.";
        }
    }
    
    if (empty($error)) {
        $stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $titulo, $descripcion, $nombre_imagen);
        
        if ($stmt->execute()) {
            $mensaje = "Proyecto agregado correctamente!";
            $titulo = $descripcion = '';
        } else {
            $error = "Error al guardar el proyecto: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Proyecto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <!-- Barra lateral -->
        <div class="admin-sidebar">
            <h2>Panel Admin</h2>
            <nav class="admin-nav">
                <ul>
                    <li><a href="panel.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="nuevo_proyecto.php" class="active"><i class="fas fa-plus-circle"></i> Nuevo Proyecto</a></li>
                    <li><a href="index.php" target="_blank"><i class="fas fa-eye"></i> Ver Portafolio Web</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>

        <!-- Contenido principal -->
        <div class="admin-main">
            <div class="admin-header">
                <h1 class="admin-title">Nuevo Proyecto</h1>
                <a href="panel.php" class="btn"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>

            <div class="admin-card">
                <h3 class="card-title">Agregar Proyecto al Portafolio</h3>
                
                <?php if ($mensaje): ?>
                    <div style="background: #1CB698; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                        <?= $mensaje ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div style="background: #ff6b6b; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <form class="admin-form" action="nuevo_proyecto.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="titulo">Título del Proyecto</label>
                        <input type="text" id="titulo" name="titulo" required value="<?= isset($titulo) ? htmlspecialchars($titulo) : '' ?>">
                    </div>
                    
                    <div>
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="5" required><?= isset($descripcion) ? htmlspecialchars($descripcion) : '' ?></textarea>
                    </div>
                    
                    <div>
                        <label for="imagen">Imagen del Proyecto</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*">
                        <small>Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Proyecto</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>