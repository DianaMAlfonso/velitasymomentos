<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Catálogo de Productos</h1>

    <!-- If user is admin, show add new product button -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
        <div class="text-end mb-3">
            <a href="index.php?action=product_create" class="btn btn-outline-secondary">
                + Agregar nuevo producto
            </a>
        </div>
    <?php endif; ?>

    <!-- Display product list -->
    <?php if (!empty($products)) : ?>
        <div class="row g-3">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 shadow-sm p-2" style="font-size: 0.9rem;">
                        <!-- Product image -->
                        <img src="<?= htmlspecialchars($product['image_path']) ?>"
                             class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>"
                             style="max-height: 150px; object-fit: cover;">

                        <div class="card-body p-2 d-flex flex-column">
                            <h6 class="card-title mb-1"><?= htmlspecialchars($product['name']) ?></h6>
                            <p class="card-text mb-1" style="font-size: 0.85rem;">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>
                            <p class="mb-1"><small><strong>Precio:</strong> $<?= number_format($product['price'], 2) ?></small></p>
                            <p class="mb-1"><small><strong>Categoría:</strong> <?= htmlspecialchars($product['category_name'] ?? 'Sin categoría') ?></small></p>

                            <div class="mt-auto">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
                                    <!-- Admin: edit / delete -->
                                    <a href="index.php?action=product_edit&id=<?= $product['id'] ?>"
                                       class="btn btn-sm btn-outline-secondary w-100">Editar</a>

                                <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                                    <!-- Logged in client can add to cart -->
                                    <form action="index.php?action=add_to_cart" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100">
                                            Agregar al carrito
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <!-- Visitor must login first -->
                                    <a href="index.php?action=login" class="btn btn-sm btn-outline-secondary w-100">
                                        Comprar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-warning text-center mt-4">
            No se encontraron productos.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
