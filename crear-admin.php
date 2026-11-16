<?php
/**
 * Crear un nuevo usuario administrador directamente en la base de datos
 * Esto bypasea completamente el sistema de login de WordPress
 */

// Configuración


// Nuevo usuario admin de emergencia


// Conectar a la base de datos
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("<h2 style='color:red;'>Error de conexión: " . $conn->connect_error . "</h2>");
}

echo "<h2>✓ Conexión exitosa a la base de datos</h2>";

// Verificar si el usuario ya existe
$check = "SELECT ID FROM wp_users WHERE user_login = '$new_username'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<p style='color:orange;'>El usuario '$new_username' ya existe. Actualizando contraseña...</p>";
    
    $update = "UPDATE wp_users SET user_pass = MD5('$new_password') WHERE user_login = '$new_username'";
    if ($conn->query($update) === TRUE) {
        echo "<h3 style='color:green;'>✓ Contraseña actualizada</h3>";
    }
    
    $row = $result->fetch_assoc();
    $user_id = $row['ID'];
    
} else {
    echo "<p>Creando nuevo usuario administrador...</p>";
    
    // Crear nuevo usuario
    $insert = "INSERT INTO wp_users (user_login, user_pass, user_nicename, user_email, user_registered, user_status, display_name) 
               VALUES ('$new_username', MD5('$new_password'), '$new_username', '$new_email', NOW(), 0, 'Admin Emergencia')";
    
    if ($conn->query($insert) === TRUE) {
        $user_id = $conn->insert_id;
        echo "<h3 style='color:green;'>✓ Usuario creado con ID: $user_id</h3>";
        
        // Asignar rol de administrador
        $meta1 = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ($user_id, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}')";
        $meta2 = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ($user_id, 'wp_user_level', '10')";
        
        $conn->query($meta1);
        $conn->query($meta2);
        
        echo "<p style='color:green;'>✓ Rol de administrador asignado</p>";
    } else {
        die("<h2 style='color:red;'>Error al crear usuario: " . $conn->error . "</h2>");
    }
}

echo "<hr>";
echo "<h2 style='color:green;'>✓ Usuario administrador de emergencia listo</h2>";
echo "<hr>";
echo "<h3>Credenciales de acceso:</h3>";
echo "<p><strong>Usuario:</strong> $new_username</p>";
echo "<p><strong>Contraseña:</strong> $new_password</p>";
echo "<hr>";
echo "<h3>Instrucciones:</h3>";
echo "<ol>";
echo "<li>Ve al login de WordPress: <a href='/wordpress/wp-login.php' style='color:blue; font-weight:bold;'>CLICK AQUÍ PARA IR AL LOGIN</a></li>";
echo "<li>Usa las credenciales de arriba</li>";
echo "<li>Una vez dentro, ve a <strong>Usuarios</strong> y cambia la contraseña de tu usuario principal 'jsersan'</li>";
echo "<li><strong style='color:red;'>ELIMINA este archivo inmediatamente por seguridad</strong></li>";
echo "</ol>";
echo "<hr>";

// Verificar usuarios en la base de datos
echo "<h3>Usuarios en la base de datos:</h3>";
$users = "SELECT ID, user_login, user_email FROM wp_users";
$result = $conn->query($users);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Usuario</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["user_login"] . "</td><td>" . $row["user_email"] . "</td></tr>";
    }
    echo "</table>";
}

$conn->close();
?>
