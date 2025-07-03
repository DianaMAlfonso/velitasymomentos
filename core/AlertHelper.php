<?php

class AlertHelper {

    /**
     * Muestra una alerta SweetAlert2 con opciones personalizadas
     * @param string $type success, error, warning, info, question
     * @param string $title Título de la alerta
     * @param string $message Mensaje de la alerta
     * @param string|null $redirect URL a la que se redirige al confirmar (opcional)
     * @param int|null $timer Tiempo en milisegundos antes de que se cierre automáticamente (opcional)
     */
    public static function sweetAlert($type, $title, $message, $redirect = null, $timer = null) {
        echo "<script>
            Swal.fire({
                icon: '$type',
                title: '$title',
                text: '$message',";

        // Si se quiere que se cierre sola
        if (!empty($timer)) {
            echo "timer: $timer,
                  timerProgressBar: true,
                  showConfirmButton: false,";
        } else {
            echo "confirmButtonText: 'Aceptar',";
        }

        echo "})
        .then((result) => {";

        // Si se especifica redirección
        if (!empty($redirect)) {
            echo "window.location.href = '$redirect';";
        }

        echo "});
        </script>";
    }
}
