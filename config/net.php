<?php
$serverName = "MEDINALAPTOP\SQLDEVELOPERPR"; // Nombre del servidor
$database = "ControlAlumnoLM242664"; // Nombre de la base de datos
$username = "sa"; // Usuario de SQL Server
$password = "12345"; // Contraseña de SQL Server

try {
    // DSN con usuario y contraseña
    $dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=true";
    
    // Crear conexión PDO con usuario y contraseña
    $pdo = new PDO($dsn, $username, $password);

    // Configurar el modo de error a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "¡Conexión exitosa a la base de datos!";
    
    // Consulta de prueba
    $testquery = 'SELECT * FROM Alumno';
    $teststmt = $pdo->prepare($testquery);

    // Ejecutar la consulta
    $teststmt->execute();

    // Obtener los datos
    $datostest = $teststmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los datos
    var_dump($datostest);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
