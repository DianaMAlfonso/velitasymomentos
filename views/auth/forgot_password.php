<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 mb-4">
        <h2>Recuperar contraseña</h2>
        <p>Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>

        <form action="index.php?action=forgot_password_process" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Enviar enlace</button>
        </form>
    </div>
</div>

<?php if (!empty($_SESSION['forgot_success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: '¡Revisa tu correo!',
    text: 'Si el correo está registrado, te enviaremos un enlace para restablecer tu contraseña.'
});
</script>
<?php unset($_SESSION['forgot_success']); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
