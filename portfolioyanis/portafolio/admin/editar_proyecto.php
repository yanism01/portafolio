<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la BD
$conn = new mysqli("127.0.0.1", "root", "12345678y%", "proyectos");
if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);

// Obtener el proyecto a editar
$proyecto = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM proyectos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $proyecto = $result->fetch_assoc();
}

if (!$proyecto) {
    header("Location: panel.php");
    exit;
}

$mensaje = '';
$error = '';

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $imagen_actual = $proyecto['imagen'];
    $nombre_imagen = $imagen_actual;
    
    // Configurar directorio de imágenes
    $directorio_img = dirname(__DIR__) . '/img/';
    
    // Verificar y crear directorio si no existe
    if (!file_exists($directorio_img)) {
        if (!mkdir($directorio_img, 0755, true)) {
            $error = "No se pudo crear el directorio para imágenes.";
        }
    }
    
    // Procesar nueva imagen si se subió
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Validar tipo de imagen
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($extension, $extensiones_permitidas)) {
            $error = "Solo se permiten imágenes JPG, JPEG, PNG o GIF.";
        } elseif ($_FILES['imagen']['size'] > 2097152) { // 2MB
            $error = "La imagen es demasiado grande. Máximo 2MB permitidos.";
        } else {
            // Eliminar imagen anterior si no es la default
            if ($imagen_actual !== 'default.jpg' && file_exists($directorio_img . $imagen_actual)) {
                if (!unlink($directorio_img . $imagen_actual)) {
                    $error = "No se pudo eliminar la imagen anterior.";
                }
            }
            
            // Generar nuevo nombre y mover archivo
            $nombre_imagen = uniqid() . '.' . $extension;
            $ruta_destino = $directorio_img . $nombre_imagen;
            
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                $error = "Error al subir la imagen. Verifica los permisos del directorio.";
                $nombre_imagen = $imagen_actual; // Mantener imagen anterior si hay error
                error_log("Error al mover archivo: " . print_r(error_get_last(), true));
            }
        }
    }
    
    if (empty($error)) {
        $stmt = $conn->prepare("UPDATE proyectos SET titulo = ?, descripcion = ?, imagen = ? WHERE id = ?");
        $stmt->bind_param("sssi", $titulo, $descripcion, $nombre_imagen, $id);
        
        if ($stmt->execute()) {
            $mensaje = "Proyecto actualizado correctamente!";
            // Actualizar los datos del proyecto mostrado
            $proyecto['titulo'] = $titulo;
            $proyecto['descripcion'] = $descripcion;
            $proyecto['imagen'] = $nombre_imagen;
        } else {
            $error = "Error al actualizar el proyecto: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
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
                    <li><a href="nuevo_proyecto.php"><i class="fas fa-plus-circle"></i> Nuevo Proyecto</a></li>
                    <li><a href="index.php" target="_blank"><i class="fas fa-eye"></i> Ver Portafolio Web</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>

        <!-- Contenido principal -->
        <div class="admin-main">
            <div class="admin-header">
                <h1 class="admin-title">Editar Proyecto</h1>
                <a href="panel.php" class="btn"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>

            <div class="admin-card">
                <h3 class="card-title">Editar Proyecto: <?= htmlspecialchars($proyecto['titulo']) ?></h3>
                
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
                
                <form class="admin-form" action="editar_proyecto.php?id=<?= $proyecto['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="titulo">Título del Proyecto</label>
                        <input type="text" id="titulo" name="titulo" required value="<?= htmlspecialchars($proyecto['titulo']) ?>">
                    </div>
                    
                    <div>
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="5" required><?= htmlspecialchars($proyecto['descripcion']) ?></textarea>
                    </div>
                    
                    <div>
                        <label for="imagen">Imagen del Proyecto</label>
                        <?php if ($proyecto['imagen'] && $proyecto['imagen'] !== 'default.jpg'): ?>
                            <div style="margin-bottom: 10px;">
                                <img src="../img/<?= $proyecto['imagen'] ?>" alt="Imagen actual" style="max-width: 200px; display: block;">
                                <small>Imagen actual</small>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="imagen" name="imagen" accept="image/*">
                        <small>Dejar en blanco para mantener la imagen actual</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>