<?php
/**
 * Endpoint para enviar emails con Resend API
 * Ubicación: /wp-content/themes/kadence/send-email.php
 */

// IMPORTANTE: Descomentar estas líneas si hay problemas de CORS
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type');

// Manejar preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');

// Configuración - CAMBIA ESTOS VALORES
define('RESEND_API_KEY', ''); // ⚠️ TU API KEY DE RESEND
define('DESTINATION_EMAIL', '');
define('FROM_EMAIL', '');

// Log para debugging (borrar después)
error_log('send-email.php llamado - Method: ' . $_SERVER['REQUEST_METHOD']);

// Leer datos del POST
$json = file_get_contents('php://input');
error_log('Datos recibidos: ' . $json);

$data = json_decode($json, true);

// Validar datos
if (!$data || !isset($data['firstName']) || !isset($data['email']) || !isset($data['message'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos',
        'received' => $data
    ]);
    exit;
}

// Sanitizar datos
$firstName = htmlspecialchars($data['firstName']);
$lastName = htmlspecialchars($data['lastName'] ?? '');
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($data['subject'] ?? 'Sin asunto');
$message = htmlspecialchars($data['message']);

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Email inválido'
    ]);
    exit;
}

// Preparar el email HTML
$emailHTML = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
</head>
<body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
    <h2 style='color: #2563eb;'>Nuevo mensaje de contacto</h2>
    
    <p><strong>Nombre:</strong><br>
    $firstName $lastName</p>
    
    <p><strong>Email:</strong><br>
    <a href='mailto:$email' style='color: #2563eb;'>$email</a></p>
    
    <p><strong>Asunto:</strong><br>
    $subject</p>
    
    <p><strong>Mensaje:</strong><br>
    $message</p>
    
    <hr style='border: none; border-top: 1px solid #e0e0e0; margin: 20px 0;'>
    <p style='font-size: 12px; color: #666;'>
        Enviado desde txemaserrano.com el " . date('d/m/Y H:i:s') . "
    </p>
</body>
</html>
";

// Preparar datos para Resend
$emailData = [
    'from' => FROM_EMAIL,
    'to' => [DESTINATION_EMAIL],
    'subject' => '[Txema Serrano] ' . $subject,
    'html' => $emailHTML
];

error_log('Enviando a Resend...');

// Enviar a Resend API
$ch = curl_init('https://api.resend.com/emails');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . RESEND_API_KEY
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

error_log('Respuesta Resend - Code: ' . $httpCode . ' - Response: ' . $response);

// Procesar respuesta
if ($httpCode === 200) {
    echo json_encode([
        'success' => true,
        'message' => 'Email enviado correctamente'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al enviar el email',
        'debug' => [
            'httpCode' => $httpCode,
            'response' => $response,
            'curlError' => $curlError
        ]
    ]);
}
?>
