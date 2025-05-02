<?php
$serverName = "localhost";  // Nota: el punto se reemplaza por guión
$database = "prodraftdb";         // Nombre de tu base de datos
$username = "";                   // Vacío para autenticación Windows
$password = "";                   // Vacío para autenticación Windows
//$serverName = "MEDINALAPTOP\\SQLDEVELOPERPR";
//$database = "prodraftdb"; // Nuevo nombre de la base de datos
//$username = "sa"; // Usuario de SQL Server
//$password = "12345"; // Contraseña de SQL Server

try {
    // Configuración para autenticación Windows
    $dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=true";
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    
    // Conexión sin usuario/contraseña para autenticación Windows
    $pdo = new PDO($dsn, $username, $password, $options);
    
    echo "¡Conexión exitosa!";
    
    // Ejemplo de consulta
    $stmt = $pdo->query("SELECT name FROM sys.tables");
    while ($row = $stmt->fetch()) {
        echo "<br>Tabla: " . $row['name'];
    }
    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}