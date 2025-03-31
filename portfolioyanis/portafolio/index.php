<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Portfolio</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <!-- MENU ENCABEZADO -->
    <div class="contenedor-header">
        <header>
            <div class="logo">
                <a href="#">Yanis Monzón</a>
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="#inicio" onclick="seleccionar()">INICIO</a></li>
                    <li><a href="#sobremi" onclick="seleccionar()">SOBRE MI</a></li>
                    <li><a href="#skills" onclick="seleccionar()">HABILIDADES</a></li>
                    <li><a href="#curriculum" onclick="seleccionar()">CURRICULUM</a></li>
                    <li><a href="#portfolio" onclick="seleccionar()">PORTAFOLIO</a></li>
                    <!--<li><a href="#contacto" onclick="seleccionar()">CONTACTO</a></li> -->
                </ul>
            </nav>
            <div class="nav-responsive" onclick="mostrarOcultarMenu()">
                <i class="fa-solid fa-bars"></i>
            </div>
        </header>
    </div>

    <!-- SECCION INICIO -->
    <section id="inicio" class="inicio">
        <div class="contenido-banner">
            <div class="contenedor-img">
                <img src="img/perfil.jpg" alt="">
            </div>
            <h1>Yanis Monzón</h1>
            <h2>Ingeniero en Informática</h2>
        </div>
    </section>

    <!-- SECCION SOBRE MI -->
    <section id="sobremi" class="sobremi">
        <div class="contenido-seccion">
            <h2>Sobre Mí</h2>
            <p><span>Hola, soy Yanis Mariel Monzón Villamizar.</span> Una profesional en el área de informática con formación técnica y universitaria. Actualmente, estoy cursando una maestría en Informática en la UNET, lo que refleja mi pasión por el aprendizaje continuo y la tecnología. Mi enfoque se centra en el desarrollo web, la gestión de bases de datos y la aplicación de soluciones tecnológicas innovadoras. Me considero una persona proactiva, con habilidades de trabajo en equipo y una gran capacidad para adaptarme a nuevos desafíos.</p>

            <div class="fila">
                <!-- datos personales -->
                <div class="col">
                    <h3>Datos Personales</h3>
                    <ul>
                        <li>
                            <strong>Nombre</strong>
                            <span> Yanis Mariel Monzón Villamizar</span>
                        </li>
                        <li>
                            <strong>Email</strong>
                            yanismonzon65@gmail.com
                        </li>
                        <li>
                        
                        <li>
                            <strong>Dirección</strong>
                            Táchira, Venezuela
                        </li>
                    </ul>
                </div>

                <!-- intereses -->
                <div class="col">
                    <h3>Intereses</h3>
                    <div class="contenedor-intereses">
                        <div class="interes">
                            <i class="fa-solid fa-gamepad"></i>
                            <span>JUEGOS</span>
                        </div>
                        <div class="interes">
                            <i class="fa-solid fa-headphones"></i>
                            <span>MUSICA</span>
                        </div>
                        <div class="interes">
                            <i class="fa-solid fa-plane"></i>
                            <span>VIAJAR</span>
                        </div>
                        <div class="interes">
                            <i class="fa-brands fa-apple"></i>
                            <span>PC</span>
                        </div>
                        <div class="interes">
                            <i class="fa-solid fa-person-hiking"></i>
                            <span>DEPORTE</span>
                        </div>
                        <div class="interes">
                            <i class="fa-solid fa-book"></i>
                            <span>LIBROS</span>
                        </div>
                        <div class="interes">
                            <i class="fa-solid fa-car"></i>
                            <span>AUTOS</span>
                        </div>
                        <div class="interes">
                            <i class="fa-solid fa-camera"></i>
                            <span>FOTOS</span>
                        </div>
                    </div>
                </div>
            </div>
            <button>
                Descargar CV <i class="fa-solid fa-download"></i>
                <span class="overlay"></span>
            </button>
        </div>
    </section>

    <!-- SECCION SKILLS -->
    <section class="skills" id="skills">
        <div class="contenido-seccion">
            <h2>Habilidades</h2>
            <div class="fila">
                <!-- Technical Skill -->
                <div class="col">
                    <h3>Habilidades Tecnicas</h3>
                    <div class="skill">
                        <span>Lenguajes de programación: C++, PHP</span>
                        <div class="barra-skill">
                            <div class="progreso lenguajes">
                                <span>50%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill">
                        <span>HTML, CSS, JAVASCRIPT</span>
                        <div class="barra-skill">
                            <div class="progreso frontend">
                                <span>60%</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="skill">
                        <span>Wordpress</span>
                        <div class="barra-skill">
                            <div class="progreso wordpress">
                                <span>81%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill">
                        <span>Bases de datos: MYSQL</span>
                        <div class="barra-skill">
                            <div class="progreso database">
                                <span>20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Professional Skills -->
                <div class="col">
                    <h3>Habilidades Profesionales</h3>
                    <div class="skill">
                        <span>Comunicación</span>
                        <div class="barra-skill">
                            <div class="progreso comunicacion">
                                <span>80%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill">
                        <span>Puntualidad</span>
                        <div class="barra-skill">
                            <div class="progreso puntualidad">
                                <span>90%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill">
                        <span>Responsabilidad</span>
                        <div class="barra-skill">
                            <div class="progreso responsabilidad">
                                <span>99%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill">
                        <span>Trabajo en equipo</span>
                        <div class="barra-skill">
                            <div class="progreso equipo">
                                <span>90%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill">
                        <span>Seguimiento de Instrucciones</span>
                        <div class="barra-skill">
                            <div class="progreso seguimiento">
                                <span>99%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCION CURRICULUM -->
    <section id="curriculum" class="curriculum">
    <div class="contenido-seccion">
        <h2>Curriculum</h2>
        <div class="fila">
            <div class="col izquierda">
                <h3>Educación</h3>
                <div class="item izq">
                    <h4>Técnico Medio en Comercio y Servicios Administrativos Mención Contabilidad</h4>
                    <span class="casa">Escuela Técnica Colegio Maria Auxiliadora</span>
                        <!--<span class="fecha">2013 - 2018</span>-->
                        <div class="conectori">
                        <div class="circuloi"></div>
                    </div>
                </div>
                <div class="item izq">
                    <h4>Técnico Superior Universitario en Informática</h4>
                    <span class="casa">Instituto Universitario de la Frontera (IUFRONT)</span>
                    <div class="conectori">
                        <div class="circuloi"></div>
                    </div>
                </div>
                <div class="item izq">
                    <h4>Ingeniero en Informática</h4>
                    <span class="casa">Universidad Politécnica Territorial Agroindustrial del Estado Táchira (UPTAIET)</span>
                    <div class="conectori">
                        <div class="circuloi"></div>
                    </div>
                </div>
                
                <div class="item izq">
                    <h4>Maestría en Informática (En curso)</h4>
                    <span class="casa">Universidad Nacional Experimental del Táchira (UNET)</span>
                    <div class="conectori">
                        <div class="circuloi"></div>
                    </div>
                </div>
            </div>
                <!-- Mover a la derecha-->
                <div class="col derecha">
                    <h3>Experiencia de trabajo</h3>
                    <div class="item der">
                        <h4>3 Meses de pasantias realizadas en el Departamento de Recursos Humanos</h4>
                        <span class="casa">CANTV</span>
                        <div class="conectord">
                            <div class="circulod"></div>
                        </div>
                    </div>
                    <div class="item der">
                        <h4>2 Meses de pasantias realizadas en el Departamento de Seguridad Industrial, Higiene y Ambiente</h4>
                        <span class="casa">CANTV</span>
                        <div class="conectord">
                            <div class="circulod"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCION PORTAFOLIO -->
    <section id="portfolio" class="portfolio">
        <div class="contenido-seccion">
            <h2>PORTAFOLIO</h2>
            <div class="galeria">
                <?php
                // Conexión a la BD
                $conn = new mysqli("127.0.0.1", "root", "12345678y%", "proyectos");
                if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);
                
                // Obtener proyectos
                $result = $conn->query("SELECT * FROM proyectos ORDER BY id DESC");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ruta_imagen = 'img/' . htmlspecialchars($row['imagen']);
                        $imagen_existe = file_exists($ruta_imagen);
                        
                        echo '<div class="proyecto">';
                        if ($imagen_existe) {
                            echo '<img src="'.$ruta_imagen.'" alt="'.htmlspecialchars($row['titulo']).'">';
                        } else {
                            echo '<div style="background:#252A2E;width:100%;height:200px;display:flex;align-items:center;justify-content:center;color:#fff;">';
                            echo 'Imagen no encontrada: '.htmlspecialchars($row['imagen']);
                            echo '</div>';
                        }
                        echo '<div class="overlay">
                                <h3>'.htmlspecialchars($row['titulo']).'</h3>
                                <p>'.htmlspecialchars($row['descripcion']).'</p>
                              </div>
                          </div>';
                    }
                } else {
                    echo '<p style="color:#fff;width:100%;text-align:center;">No hay proyectos para mostrar.</p>';
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>