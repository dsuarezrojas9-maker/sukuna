<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validar contraseña segura
if (strlen($password) < 6) {
    die("La contraseña debe tener al menos 6 caracteres.");
}

// Encriptar contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario
$sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $passwordHash);

if ($stmt->execute()) {
    echo "Usuario registrado correctamente. <a href='index.html'>Volver</a>";
} else {
    echo "Error: El correo ya está registrado.";
}

$stmt->close();
$conn->close();
?>
