<?php require_once __DIR__ . '/../../partials/header.php'; ?>

<div class="container mb-4">
    <h2>Editar usuario</h2>

    <form action="index.php?action=admin_user_update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($editUser['id']) ?>">

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($editUser['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($editUser['username']) ?>">
        </div>

        <div class="mb-3">
            <label for="roles_mask" class="form-label">Rol</label>
            <select name="roles_mask" class="form-select" required>
                <option value="1" <?= ($editUser['roles_mask'] == 1) ? 'selected' : '' ?>>Cliente</option>
                <option value="2" <?= ($editUser['roles_mask'] == 2) ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-outline-secondary">Guardar cambios</button>
        <a href="index.php?action=admin_users" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>
