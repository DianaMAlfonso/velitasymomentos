<?php require_once __DIR__ . '/../../partials/header.php'; ?>

<div class="container mb-4">
    <h2>Crear nuevo usuario</h2>

    <form action="index.php?action=admin_user_store" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roles_mask" class="form-label">Rol</label>
            <select name="roles_mask" class="form-select" required>
                <option value="1">Cliente</option>
                <option value="2">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-outline-secondary">Crear usuario</button>
        <a href="index.php?action=admin_users" class="btn btn-outline-secondary
        ">Cancelar</a>
    </form>
</div>

<?php if (!empty($_SESSION['create_success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Usuario creado',
    text: 'El usuario ha sido creado exitosamente.'
});
</script>
<?php unset($_SESSION['create_success']); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>
