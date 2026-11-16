<?php
// SCRIPT FINAL DE LOGIN - Método más agresivo
define('FORCE_SSL_ADMIN', false);
define('FORCE_SSL_LOGIN', false);

require_once('wp-load.php');

// Limpiar TODAS las cookies
if (isset($_COOKIE)) {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, '', time() - 3600, '/');
    }
}

$username = 'jsersan';
$password = 'Jss12aoz';

// Método 1: Login programático
$creds = array(
    'user_login'    => $username,
    'user_password' => $password,
    'remember'      => true
);

$user = wp_signon($creds, false);

if (is_wp_error($user)) {
    echo '<h2 style="color:red;">Error en login: ' . $user->get_error_message() . '</h2>';
    echo '<hr>';
}

// Método 2: Forzar usuario y cookies manualmente
$user = get_user_by('login', $username);

if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
    
    // Limpiar cookies antiguas
    wp_clear_auth_cookie();
    
    // Establecer usuario actual
    wp_set_current_user($user->ID, $username);
    
    // Establecer cookies de autenticación SIN SSL
    wp_set_auth_cookie($user->ID, true, false);
    
    // Forzar inicio de sesión
    do_action('wp_login', $username, $user);
    
    echo '<h2 style="color:green;">✓ Login procesado correctamente</h2>';
    echo '<p><strong>Usuario:</strong> ' . $username . '</p>';
    echo '<p><strong>ID:</strong> ' . $user->ID . '</p>';
    
    // Verificar si está logueado
    if (is_user_logged_in()) {
        echo '<p style="color:green;"><strong>Estado:</strong> Usuario autenticado ✓</p>';
    } else {
        echo '<p style="color:orange;"><strong>Estado:</strong> Cookies no funcionan correctamente</p>';
    }
    
    echo '<hr>';
    echo '<h3>Opciones para acceder:</h3>';
    
    // Opción 1: Redirección automática
    echo '<p>1. <strong>Espera 3 segundos</strong> para redirección automática...</p>';
    echo '<script>
        setTimeout(function(){ 
            window.location.href = "/wordpress/wp-admin/"; 
        }, 3000);
    </script>';
    
    // Opción 2: Enlaces manuales
    echo '<p>2. Si no funciona, prueba estos enlaces:</p>';
    echo '<ul>';
    echo '<li><a href="/wordpress/wp-admin/" style="font-size:18px; color:blue;">→ Ir al Panel de Administración</a></li>';
    echo '<li><a href="/wordpress/wp-admin/profile.php" style="font-size:18px; color:blue;">→ Ir a Tu Perfil</a></li>';
    echo '</ul>';
    
    // Opción 3: Generar URL con autenticación temporal
    $nonce = wp_create_nonce('auto-login-' . $user->ID);
    $admin_url = admin_url('index.php?auto_login=' . $user->ID . '&nonce=' . $nonce);
    echo '<p>3. URL alternativa con autenticación:</p>';
    echo '<p><a href="' . $admin_url . '" style="font-size:18px; color:green; font-weight:bold;">→ Acceso directo con token</a></p>';
    
} else {
    echo '<h2 style="color:red;">✗ Error: Credenciales incorrectas</h2>';
}

echo '<hr>';
echo '<p style="color:red; font-weight:bold;">IMPORTANTE: Una vez dentro, elimina este archivo por seguridad</p>';
?>