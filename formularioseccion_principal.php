<?php
// Conexión a la base de datos
$servername = "localhost";  // Cambia si tienes un servidor diferente
$username = "root";         // Cambia si usas un usuario diferente
$password = "";             // Si no tienes contraseña, déjalo vacío
$dbname = "formulario_principal";  // Asegúrate de que el nombre de la base de datos sea correcto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanear los datos del formulario para evitar inyección SQL
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $career = $conn->real_escape_string($_POST['career']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO formulario_seccion_principal (name, email, phone, career) 
            VALUES ('$name', '$email', '$phone', '$career')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "<p>¡Formulario enviado exitosamente!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Cerrar la conexión
$conn->close();
?>
