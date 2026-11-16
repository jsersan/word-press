<?php
require_once('wp-load.php');

$creds = array(
    'user_login'    => '',
    'user_password' => '',
    'remember'      => true
);

$user = wp_signon($creds, true);

if (is_wp_error($user)) {
    echo '<p style="color:red;">Error: ' . $user->get_error_message() . '</p>';
} else {
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, true, true);
    echo '<h2>✓ Sesión iniciada correctamente</h2>';
    echo '<p>Redirigiendo al panel...</p>';
    echo '<meta http-equiv="refresh" content="2;url=/wordpress/wp-admin/">';
}
?>
