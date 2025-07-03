<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Crear nuevo producto</h2>

    <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Seleccionar categoría</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="form-label">Imagen del producto</label>
            <input class="form-control" type="file" id="image" name="image" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-outline-secondary">Guardar producto</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
