<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Iniciar sesión</h2>

        <form action="index.php?action=reset_password_process" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">
            <div class="mb-3">
                <label for="new_password">Nueva contraseña</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Cambiar contraseña</button>
        </form>


        <div class="mt-3">
            <a href="index.php?action=forgot_password" class="link-primary">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<?php if (!empty($_SESSION['login_error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error al iniciar sesión',
            text: 'Correo o contraseña incorrectos.'
        });
    </script>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['reset_success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Contraseña actualizada!',
            text: 'Ahora puedes iniciar sesión con tu nueva contraseña.'
        });
    </script>
    <?php unset($_SESSION['reset_success']); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>