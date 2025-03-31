<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la BD
$conn = new mysqli("127.0.0.1", "root", "12345678y%", "proyectos");
if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);

// Obtener todos los proyectos
$proyectos = [];
$result = $conn->query("SELECT * FROM proyectos ORDER BY id DESC");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $proyectos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .tabla-imagen {
            max-width: 100px;
            max-height: 60px;
            display: block;
        }
        .sin-imagen {
            background: #f0f0f0;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Barra lateral -->
        <div class="admin-sidebar">
            <h2>Panel Admin</h2>
            <nav class="admin-nav">
                <ul>
                    <li><a href="panel.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="nuevo_proyecto.php"><i class="fas fa-plus-circle"></i> Nuevo Proyecto</a></li>
                    <li><a href="../index.php" target="_blank"><i class="fas fa-eye"></i> Ver Portafolio Web</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>

        <!-- Contenido principal -->
        <div class="admin-main">
            <div class="admin-header">
                <h1 class="admin-title">Mis Proyectos</h1>
                <a href="nuevo_proyecto.php" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Proyecto</a>
            </div>

            <div class="admin-card">
                <h3 class="card-title">Listado de Proyectos</h3>
                
                <?php if (empty($proyectos)): ?>
                    <p>No hay proyectos aún. <a href="nuevo_proyecto.php">Agrega tu primer proyecto</a></p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos as $proyecto): 
                                $ruta_imagen = '../img/' . $proyecto['imagen'];
                                $imagen_existe = file_exists($ruta_imagen);
                            ?>
                            <tr>
                                <td><?= $proyecto['id'] ?></td>
                                <td><?= htmlspecialchars($proyecto['titulo']) ?></td>
                                <td>
                                    <?php if ($imagen_existe && $proyecto['imagen'] !== 'default.jpg'): ?>
                                        <img src="<?= $ruta_imagen ?>" alt="<?= htmlspecialchars($proyecto['titulo']) ?>" class="tabla-imagen">
                                    <?php else: ?>
                                        <span class="sin-imagen"><?= $proyecto['imagen'] ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="editar_proyecto.php?id=<?= $proyecto['id'] ?>" class="btn"><i class="fas fa-edit"></i> Editar</a>
                                    <a href="eliminar_proyecto.php?id=<?= $proyecto['id'] ?>" class="btn" onclick="return confirm('¿Estás seguro de eliminar este proyecto?')"><i class="fas fa-trash"></i> Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>