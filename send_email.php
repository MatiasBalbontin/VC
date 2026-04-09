<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y sanitizar los datos del formulario
    $nombre = strip_tags(trim($_POST["nombre"] ?? ''));
    $empresa = strip_tags(trim($_POST["empresa"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $desafio = strip_tags(trim($_POST["desafio"] ?? ''));

    // Configurar correo de destino (cámbialo por el tuyo)
    $destinatario = "matias.bablbo@hotmail.com"; 
    $asunto = "Nuevo registro de diagnóstico: $nombre";

    // Construir el cuerpo del mensaje
    $mensaje = "Has recibido un nuevo mensaje del formulario de diagnóstico de Visión Cordillera.\n\n";
    $mensaje .= "Detalles del contacto:\n";
    $mensaje .= "------------------------\n";
    $mensaje .= "Nombre Completo: $nombre\n";
    $mensaje .= "Empresa: $empresa\n";
    $mensaje .= "Email: $email\n";
    $mensaje .= "Principal desafío:\n$desafio\n";

    // Configurar cabeceras
    $headers = "From: Vision Cordillera <no-reply@visioncordillera.cl>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Enviar correo
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        // Redirigir de vuelta a la página principal con un mensaje de éxito (opcional)
        echo "<script>alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.'); window.location.href='code.html';</script>";
    } else {
        echo "<script>alert('Hubo un error al enviar el mensaje. Por favor, intenta de nuevo más tarde.'); window.location.href='code.html';</script>";
    }
} else {
    // Si no se accede por POST, redirigir al inicio
    header("Location: code.html");
    exit;
}
?>
