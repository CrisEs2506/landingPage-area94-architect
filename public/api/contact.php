<?php
/**
 * Endpoint de contacto – Área 94
 * Reemplaza al endpoint Node.js para hosting estático (Hostinger).
 * Recibe JSON vía POST y envía el correo con mail().
 */

header('Content-Type: application/json; charset=utf-8');

// ── Preflight CORS (por si se sirve desde sub-dominio) ──
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(200);
    exit;
}

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
    exit;
}

// ── Leer body JSON ──
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Datos inválidos.']);
    exit;
}

$nombre   = trim($input['nombre']   ?? '');
$correo   = trim($input['correo']   ?? '');
$telefono = trim($input['telefono'] ?? '');
$mensaje  = trim($input['mensaje']  ?? '');

// ── Validación ──
if ($nombre === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'El nombre es obligatorio.']);
    exit;
}

if ($correo === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'El correo es obligatorio.']);
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'El formato de correo no es válido.']);
    exit;
}

if ($mensaje === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'El mensaje es obligatorio.']);
    exit;
}

// ── Escapar HTML para prevenir XSS ──
$nombreSafe   = htmlspecialchars($nombre,   ENT_QUOTES, 'UTF-8');
$correoSafe   = htmlspecialchars($correo,   ENT_QUOTES, 'UTF-8');
$telefonoSafe = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
$mensajeSafe  = htmlspecialchars($mensaje,  ENT_QUOTES, 'UTF-8');

// ── Fila de teléfono (solo si se proporcionó) ──
$telefonoRow = '';
if ($telefono !== '') {
    $telefonoRow = <<<HTML
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: #23272F; vertical-align: top;">Teléfono:</td>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; color: #444;">{$telefonoSafe}</td>
            </tr>
HTML;
}

// ── Construir el email HTML ──
$htmlContent = <<<HTML
<div style="font-family: 'Montserrat', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #f7f7f7; border-radius: 8px; overflow: hidden;">
  <div style="background: #23272F; padding: 32px 24px; text-align: center;">
    <h1 style="color: #c9a96e; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.3px;">
      Nuevo mensaje de contacto
    </h1>
  </div>
  <div style="padding: 32px 24px;">
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: #23272F; width: 120px; vertical-align: top;">Nombre:</td>
        <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; color: #444;">{$nombreSafe}</td>
      </tr>
      <tr>
        <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: #23272F; vertical-align: top;">Correo:</td>
        <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; color: #444;">
          <a href="mailto:{$correoSafe}" style="color: #444; text-decoration: none;">{$correoSafe}</a>
        </td>
      </tr>
      {$telefonoRow}
      <tr>
        <td style="padding: 12px 0; font-weight: 600; color: #23272F; vertical-align: top;">Mensaje:</td>
        <td style="padding: 12px 0; color: #444; white-space: pre-wrap;">{$mensajeSafe}</td>
      </tr>
    </table>
  </div>
  <div style="background: #23272F; padding: 16px 24px; text-align: center;">
    <p style="color: rgba(255,255,255,0.5); font-size: 12px; margin: 0;">
      Este mensaje fue enviado desde el formulario de contacto de area-94.com
    </p>
  </div>
</div>
HTML;

// ── Headers del correo ──
$to      = 'contacto@area-94.com';
$subject = "Nuevo contacto: {$nombre}";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: \"Área 94 – Web\" <contacto@area-94.com>\r\n";
$headers .= "Reply-To: {$correo}\r\n";

// ── Enviar ──
$sent = mail($to, $subject, $htmlContent, $headers);

if ($sent) {
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error al enviar el mensaje. Intenta de nuevo más tarde.']);
}
