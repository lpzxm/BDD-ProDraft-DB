<?php
$serverName = "MEDINALAPTOP\\SQLDEVELOPERPR";
$database = "prodraftdb"; // Nuevo nombre de la base de datos
$username = "sa"; // Usuario de SQL Server
$password = "12345"; // Contraseña de SQL Server

try {
    $dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=true";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "¡Conexión exitosa a la base de datos!";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
