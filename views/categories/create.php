<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h2 class="mb-4">Crear nueva categoría</h2>

<form action="index.php?controller=category&action=store" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">categoría</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-outline-secondary mb-4">Guardar</button>
    <a href="index.php?controller=category&action=index" class="btn btn-outline-secondary mb-4">Cancel</a>
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
