<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/ProductImage.php';

$categoryModel = new Category();
$productImageModel = new ProductImage();

$categories = $categoryModel->getAll();
$productImages = $productImageModel->getByProductId($product['id']);
?>

<h1 class="mb-4">Editar Producto</h1>

<form action="index.php?controller=product&action=update&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data" class="row g-3">

    <div class="col-md-6">
        <label for="name" class="form-label">Producto</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>

    <div class="col-md-12">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" class="form-control" required><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <div class="col-md-4">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Categoria</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Selecciona una categoría --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label">Imagen actual:</label><br>
        <?php foreach ($productImages as $img): ?>
            <img src="public/<?= htmlspecialchars($img['image_path']) ?>" width="100" style="margin: 5px;">
        <?php endforeach; ?>
    </div>

    <div class="col-md-12">
        <label for="image" class="form-label">Subir nueva imagen</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>

    <div class="col-12 mb-4">
        <button type="submit" class="btn btn-outline-secondary">Actualizar producto</button>
        <a href="index.php?controller=product&action=index" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
