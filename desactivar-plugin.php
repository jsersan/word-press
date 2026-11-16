<?php
/**
 * Script para desactivar TODOS los plugins de WordPress
 * Esto permite entrar al admin cuando un plugin está bloqueando el acceso
 */

require_once('wp-load.php');

// Obtener todos los plugins activos
$active_plugins = get_option('active_plugins');

echo "<h2>Plugins activos encontrados:</h2>";
echo "<ul>";
foreach ($active_plugins as $plugin) {
    echo "<li>" . $plugin . "</li>";
}
echo "</ul>";
echo "<hr>";

// Desactivar TODOS los plugins
update_option('active_plugins', array());

echo "<h2 style='color:green;'>✓ TODOS los plugins han sido desactivados</h2>";
echo "<hr>";
echo "<p><strong>Ahora intenta hacer login:</strong></p>";
echo "<p><a href='/wordpress/wp-login.php' style='font-size:20px; color:blue; font-weight:bold;'>→ IR AL LOGIN</a></p>";
echo "<hr>";
echo "<p><strong>Credenciales:</strong></p>";
echo "<p>Usuario: jsersan</p>";
echo "<p>Contraseña: Jss12aoz</p>";
echo "<hr>";
echo "<p style='color:orange;'>Una vez dentro, podrás reactivar los plugins desde el panel de administración</p>";
echo "<p style='color:red; font-weight:bold;'>⚠️ ELIMINA este archivo después de usarlo</p>";
?>