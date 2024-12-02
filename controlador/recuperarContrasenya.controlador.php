<?php
// Pau Muñoz Serra
// Creem la variable d'errors buida
$error = "";    

require_once BASE_PATH . '/model/recuperarContrasenya.model.php';
require BASE_PATH . '/lib/PHPMailer-master/src/PHPMailer.php';
require BASE_PATH . '/lib/PHPMailer-master/src/SMTP.php';
require BASE_PATH . '/lib/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviarCorreu'])) {
        $email = htmlspecialchars($_POST['correuRecuperacio']);

        if(modelCorreuExisteixEnviar($email) === 'CorreuExisteix') {
            // Generar token único
            $token = bin2hex(random_bytes(32));
            $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
            afegirTokenContraRecuperacio($email, $token, $expiration);


            $textCorreu = "<div style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>
                <table align='center' width='600' style='background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; margin-top: 20px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>
                    <tr>
                        <td style='text-align: center; padding-bottom: 20px;'>
                            <h2 style='color: #333333;'>Recupera tu contraseña</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style='color: #555555; font-size: 16px; line-height: 1.5; padding-bottom: 20px;'>
                            Hola,<br><br>
                            Has solicitado restablecer tu contraseña. Haz clic en el siguiente botón para crear una nueva:
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align: center; padding-bottom: 20px;'>
                            <a href='http://localhost/code/vista/reset_password.vista.php?token=$token' 
                            style='background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; display: inline-block;'>
                            Restablecer Contraseña
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style='color: #555555; font-size: 14px; line-height: 1.5; text-align: center; padding-top: 20px; border-top: 1px solid #dddddd;'>
                            Si no solicitaste este cambio, ignora este correo. Tu contraseña actual seguirá siendo segura.<br><br>
                            <em style='color: #999999;'>© 2023 Paumunoz.cat. Todos los derechos reservados.</em>
                        </td>
                    </tr>
                </table>
            </div>";
            // https://www.paumunoz.cat o http://localhost/code

            
            // Enviar correo con PHPMailer
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';                     // Cambia por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'munozserrap@gmail.com';          // Cambia por tu correo SMTP
            $mail->Password = 'xezu vyjk wqoz nhgf';            // Cambia por tu contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('p.munoz3@sapalomera.cat', 'Pmunoz');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperació de contrasenya';
            $mail->Body = $textCorreu;

            $mail->send();
            if ($mail->send()) {
                // eliminem els valors de les tres variables
                unset($_POST['correuRecuperacio']);
    
                // assignem la variable error 'Enviat'
                $error = 'CorreuEnviat';
            }

        } else {
            $error = 'El correu electronic no EXISTEIX';
        }
    }

?>