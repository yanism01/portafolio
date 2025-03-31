USE proyectos;

-- Tabla de usuarios (para el login)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

-- Tabla de proyectos (para tu portafolio)
CREATE TABLE proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(100) DEFAULT 'default.jpg'
);

-- Inserta tu usuario (la contraseña está encriptada con PHP)
INSERT INTO usuarios (usuario, contrasena) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

SELECT usuario, contrasena, LENGTH(contrasena) as hash_length 
FROM usuarios 
WHERE usuario = 'admin';