<?php
/**
 * Acceso directo al panel de WordPress sin depender de cookies
 * Este script inicia sesión y te mantiene dentro forzadamente
 */

// Desactivar redirecciones
define('FORCE_SSL_ADMIN', false);
define('FORCE_SSL_LOGIN', false);

// Cargar WordPress
require_once('wp-load.php');
require_once('wp-admin/includes/admin.php');

// Credenciales
$username = '';
$password = '';

// Verificar credenciales
$user = get_user_by('login', $username);

if (!$user || !wp_check_password($password, $user->data->user_pass, $user->ID)) {
    die('<h2 style="color:red;">Error: Credenciales incorrectas</h2>');
}

// Limpiar cookies antiguas
wp_clear_auth_cookie();

// Establecer usuario actual
wp_set_current_user($user->ID, $username);

// Establecer cookies sin SSL
wp_set_auth_cookie($user->ID, true, false);

// Ejecutar hook de login
do_action('wp_login', $username, $user);

// Verificar si está logueado
if (!is_user_logged_in()) {
    // Si las cookies no funcionan, forzar el inicio de sesión de otra manera
    $_COOKIE[LOGGED_IN_COOKIE] = wp_generate_auth_cookie($user->ID, time() + 31536000, 'logged_in');
    $_COOKIE[AUTH_COOKIE] = wp_generate_auth_cookie($user->ID, time() + 31536000, 'auth');
}

// Establecer capacidades de admin
$user->set_role('administrator');

// Redirigir al panel
wp_safe_redirect(admin_url());
exit;
?>
