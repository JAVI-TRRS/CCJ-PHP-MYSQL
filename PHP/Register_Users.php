<?php
// Incluir la conexión
include 'conexion.php';

$mensaje = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos para evitar inyecciones básicas
    $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
    $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $fecha_nacimiento = mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
    $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // 1. Encriptar la contraseña de forma segura
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    // 2. Verificar si el correo ya existe
    $buscar_correo = "SELECT * FROM Usuarios WHERE correo = '$correo'";
    $resultado_busqueda = mysqli_query($conexion, $buscar_correo);

    if (mysqli_num_rows($resultado_busqueda) > 0) {
        $mensaje = "<div class='alert error'>El correo ya está registrado. Intenta con otro.</div>";
    } else {
        // 3. Insertar el nuevo usuario
        $sql = "INSERT INTO Usuarios (nombres, apellidos, telefono, fecha_nacimiento, direccion, correo, contrasena) 
                VALUES ('$nombres', '$apellidos', '$telefono', '$fecha_nacimiento', '$direccion', '$correo', '$contrasena_encriptada')";

        if (mysqli_query($conexion, $sql)) {
            $mensaje = "<div class='alert exito'>¡Usuario registrado con éxito!</div>";
        } else {
            $mensaje = "<div class='alert error'>Error al registrar: " . mysqli_error($conexion) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="contenedor-formulario">
        <h2>Crear Cuenta</h2>
        
        <!-- Mostrar mensajes de éxito o error -->
        <?php echo $mensaje; ?>

        <form action="registro.php" method="POST">
            <div class="grupo-input">
                <label for="nombres">Nombres</label>
                <input type="text" id="nombres" name="nombres" required>
            </div>

            <div class="grupo-input">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>

            <div class="grupo-input">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>

            <div class="grupo-input">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>

            <div class="grupo-input">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>

            <div class="grupo-input">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <div class="grupo-input">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <button type="submit" class="btn-enviar">Registrarse</button>
        </form>
    </div>

</body>
</html>