<?php
$serverName = "MEDINALAPTOP\\SQLDEVELOPERPR";  // Nota: el punto se reemplaza por guión
$database = "prodraftdb";         // Nombre de tu base de datos
$username = "sa";                   // Vacío para autenticación Windows
$password = "12345";                   // Vacío para autenticación Windows

try {
    // Configuración para autenticación Windows
    $dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=true";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    // Conexión sin usuario/contraseña para autenticación Windows
    $pdo = new PDO($dsn, $username, $password, $options);
    // echo "¡Conexión exitosa!";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}