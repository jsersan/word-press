<?php
require_once('wp-load.php');
require_once('wp-includes/pluggable.php');

$user_id = 1; // ID de tu usuario jsersan
$new_password = '';

wp_set_password($new_password, $user_id);

echo '<h1>✓ Contraseña actualizada correctamente</h1>';
echo '<p><strong>Usuario:</strong> jsersan</p>';
echo '<p><strong>Nueva contraseña:</strong> ' . $new_password . '</p>';
echo '<p><a href="/wordpress/wp-login.php">Ir al login</a></p>';
echo '<p style="color:red;"><strong>IMPORTANTE: Elimina este archivo inmediatamente por seguridad</strong></p>';
?>
