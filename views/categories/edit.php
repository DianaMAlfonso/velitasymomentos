<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h2 class="mb-4">Editar categoría</h2>

<form action="index.php?controller=category&action=update&id=<?= $category['id'] ?>" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Categoría</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($category['name']) ?>" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-outline-secondary mb-4">Actualizar</button>
    <a href="index.php?controller=category&action=index" class="btn btn-outline-secondary mb-4">Cancel</a>
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
