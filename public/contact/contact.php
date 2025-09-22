<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre  = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Nuevo mensaje de contacto - Página web';
    $phone   = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'mail.em3construcciones.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contacto@em3construcciones.com';
        $mail->Password = ',--0TT3~8Qaj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom($email, $nombre);
        $mail->addAddress('contacto@em3construcciones.com', 'Contacto');

        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto: $subject";
        $mail->Body = "
            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#050a1e; padding:20px; font-family: Arial, sans-serif;'>
                <tr>
                    <td align='center'>
                        <table width='600' cellpadding='0' cellspacing='0' style='background:#ffffff; border-radius:8px; overflow:hidden;'>
                            <tr>
                                <td style='padding:30px; color:#333;'>
                                    <h2 style='color:#ff3c00; margin-top:0;'>Nuevo mensaje de contacto</h2>
                                    <p><strong>Nombre:</strong> {$nombre}</p>
                                    <p><strong>Email:</strong> {$email}</p>
                                    <p><strong>Teléfono:</strong> {$phone}</p>
                                    <p><strong>Asunto:</strong> {$subject}</p>
                                    <hr style='border:0; border-top:1px solid #eee; margin:20px 0;'>
                                    <p style='font-size:15px; color:#041424; line-height:1.5;'><strong>Mensaje:</strong><br>{$message}</p>
                                    <div style='margin:30px 0; text-align:center;'>
                                        <a href='mailto:{$email}'
                                            style='display:inline-block; background:#ff3c00; color:#fff; padding:12px 24px; text-decoration:none; font-weight:bold; border-radius:5px;'>
                                            Responder a {$nombre}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style='background:#050a1e; color:#7a7a7a; padding:15px; text-align:center; font-size:12px;'>
                                    © ".date('Y')." Em3 | Este correo fue enviado desde el formulario de contacto.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        ";

        $mail->AltBody = "Nuevo mensaje de contacto\n\nNombre: $nombre\nEmail: $email\nTeléfono: $phone\nAsunto: $subject\n\nMensaje:\n$message";

        $mail->send();
        header("Location: ../contact.php?success=Correo enviado correctamente.");
    } catch (Exception $e) {
        error_log("Error enviando correo: " . $mail->ErrorInfo);
        header("Location: ../contact.php?error=Error al enviar el correo.");
    }
}
