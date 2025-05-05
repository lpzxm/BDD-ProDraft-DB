<?php
// include("../config/net.php");
if ($action == 'login') {
    $username = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Intentar primero con la tabla 'Entrenador'
        $query = "SELECT * FROM Entrenador WHERE email = :n1 LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':n1', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $role = 'Entrenador';
        } else {
            // Si no se encuentra, intentar con 'Jugador'
            $query = "SELECT * FROM Jugador WHERE email = :n1 LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':n1', $username, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $role = 'Jugador';
            } else {
                echo false;
                exit;
            }
        }

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombres'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $role; // 'Entrenador' o 'Jugador'
            echo $role; // <- devuelve el rol como texto
        } else {
            echo false;
        }
    } catch (PDOException $e) {
        $error = "Error de conexión: " . $e->getMessage();
        echo false;
    }
}
