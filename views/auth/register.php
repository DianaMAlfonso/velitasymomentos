<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 mb-4">
        <h2>Registrarse</h2>
        <form action="index.php?action=register_user" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-outline-secondary">Registrarse</button>
        </form>
    </div>
</div>

<?php if (!empty($_SESSION['register_success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Registro exitoso',
    text: '¡Tu cuenta ha sido creada correctamente!',
    confirmButtonText: 'Iniciar sesión'
}).then(() => {
    window.location.href = 'index.php?action=login';
});
</script>
<?php unset($_SESSION['register_success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['register_error'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Error al registrar',
    text: 'Este correo ya está en uso o hubo un problema. Intenta con otro.'
});
</script>
<?php unset($_SESSION['register_error']); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
