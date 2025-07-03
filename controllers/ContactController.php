<?php
require_once __DIR__ . '/../core/EmailService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input from contact form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email subject and HTML body
    $subject = "New contact message from Velitas y Momentos";
    $body = "
        <h3>New contact message</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    // Use the existing EmailService to send the message to your own email
    $success = EmailService::sendResetLink("velitasymomentos@gmail.com", $subject, $body);

    /**
     * Print minimal HTML to ensure the browser renders the SweetAlert correctly.
     * This avoids a blank page after sending the email.
     */
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Velitas y Momentos</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>";

    // Show SweetAlert feedback based on whether the email was successfully sent
    if ($success) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Mensaje enviado!',
                text: 'Gracias por contactarnos. Vuelve pronto.',
                confirmButtonColor: '#a7725c'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El mensaje no pudo ser enviado. Por favor intenta más tarde.',
                confirmButtonColor: '#a7725c'
            }).then(() => {
                window.location.href = 'index.php?action=contact';
            });
        </script>";
    }

    echo "</body></html>";
}

