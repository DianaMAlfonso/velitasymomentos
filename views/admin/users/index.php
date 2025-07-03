<?php require_once __DIR__ . '/../../partials/header.php'; ?>

<div class="container">
    <h2>Gestión de usuarios</h2>
    <a href="index.php?action=admin_user_create" class="btn btn-secondary mb-3">Crear nuevo usuario</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Email</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= ($user['roles_mask'] == 2) ? 'Administrador' : 'Cliente' ?></td>
                <td>
                    <a href="index.php?action=admin_user_edit&id=<?= $user['id'] ?>" class="btn btn-outline-secondary">Editar</a>
                    <a href="index.php?action=admin_user_delete&id=<?= $user['id'] ?>" class="btn btn-outline-secondary"
                        onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if (!empty($_SESSION['update_success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Usuario actualizado',
    text: 'Los datos del usuario se actualizaron correctamente.'
});
</script>
<?php unset($_SESSION['update_success']); ?>
<?php endif; ?>

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

<?php if (!empty($_SESSION['delete_success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Usuario eliminado',
    text: 'El usuario ha sido eliminado correctamente.'
});
</script>
<?php unset($_SESSION['delete_success']); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>
