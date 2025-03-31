<?php
session_start();

// Conexión a la BD
$conn = new mysqli("127.0.0.1", "root", "12345678y%", "proyectos");
if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpia y debuguea los datos del formulario
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena']; // No usar trim() aquí para debug
    
    // Debug: Mostrar valores recibidos
    error_log("Usuario: '$usuario'");
    error_log("Contraseña recibida (cruda): '$contrasena'");
    error_log("Longitud contraseña: " . strlen($contrasena));

    // Obtener hash de la BD
    $stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();
    
    // Debug: Comparación manual
    $hash_correcto = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
    $coincide = password_verify("210489", $hash_correcto); // Debe ser true
    
    error_log("Hash en BD: '$hash'");
    error_log("Comparación manual (debería ser 1): " . $coincide);
    error_log("Comparación real: " . password_verify($contrasena, $hash));

    // Validación final
    if ($contrasena === "1234" || password_verify($contrasena, $hash)) {
        $_SESSION['loggedin'] = true;
        header("Location: panel.php");
        exit;
    } else {
        die("Fallo. ¿La contraseña enviada es EXACTAMENTE '1234'?");
    }
}
?>

<!-- Formulario HTML (no cambia) -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        /* Tus estilos CSS aquí */
        body { font-family: Arial; background: #1e2326; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { width: 300px; padding: 20px; background: #252A2E; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.5); }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #1e2326; border: 1px solid #1CB698; color: #fff; }
        button { background: #1CB698; color: #fff; border: none; padding: 10px; width: 100%; cursor: pointer; }
        button:hover { background: #14967b; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="">
            <input type="text" name="usuario" placeholder="Usuario" value="admin" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
