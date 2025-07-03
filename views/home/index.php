<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="hero-home text-center d-flex flex-column justify-content-center align-items-center"
     style="background: url('assets/img/inicio.jpg') center/cover no-repeat;
            height: 400px; color: #fff; text-shadow: 1px 1px 4px rgba(0,0,0,0.7);">
    <h1>Velitas y Momentos</h1>
    <p>Descubre nuestra nueva colección de velas artesanales</p>
    <a href="index.php?action=products" class="btn btn-outline-light mt-3">Explorar Productos</a>
</div>


<div class="container my-5">
    <h2 class="text-center mb-4">Productos destacados</h2>
    <div class="row g-3">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 shadow-sm p-2" style="font-size: 0.9rem;">
                        <img src="<?= htmlspecialchars($product['image_path']) ?>"
                             class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>"
                             style="max-height: 150px; object-fit: cover;">
                        <div class="card-body p-2 d-flex flex-column">
                            <h6 class="card-title mb-1"><?= htmlspecialchars($product['name']) ?></h6>
                            <p class="card-text mb-1" style="font-size: 0.85rem;">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>
                            <p class="mb-1"><small><strong>Precio:</strong> $<?= number_format($product['price'], 2) ?></small></p>
                            <p class="mb-1"><small><strong>Categoría:</strong> <?= htmlspecialchars($product['category_name']) ?></small></p>

                            <div class="mt-auto">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                                    <form action="index.php?action=add_to_cart" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100">
                                            Agregar al carrito
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a href="index.php?action=products" class="btn btn-sm btn-outline-secondary w-100">
                                        comprar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</div>


<div class="about-section py-5">
    <div class="container d-flex flex-column flex-md-row align-items-center">
        <div class="about-text mb-4 mb-md-0 pe-md-5">
            <h3>¿Quiénes somos?</h3>
            <p>Somos un taller artesanal dedicado a crear velas únicas que acompañen tus momentos especiales.
                Cada vela es elaborada con amor y materiales naturales para brindarte luz, aroma y energía positiva.</p>
            <a href="index.php?action=products" class="link-secondary">Ver Productos</a>
        </div>
        <div class="about-image">
            <img src="assets/img/somos.jpg" class="img-fluid rounded shadow" alt="Quiénes somos">
        </div>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Lo que dicen nuestros clientes</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <p>“¡Amé las velas! Huelen delicioso y el empaque es precioso.”</p>
                    <small class="text-muted">– Laura G.</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <p>“Compré un ramo de velas para un regalo y fue un éxito.”</p>
                    <small class="text-muted">– Andrés P.</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <p>“Mi casa tiene un aroma increíble, definitivamente volveré a comprar.”</p>
                    <small class="text-muted">– Sofía M.</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h3 class="text-center mb-5">Velas Personalizadas</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="assets/img/nombres.jpeg" class="card-img-top" alt="Vela personalizada con nombres">
                    <div class="card-body">
                        <h5 class="card-title">Vela con nombres</h5>
                        <p class="card-text">Perfecta para bodas y aniversarios, personaliza con los nombres que desees.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="assets/img/aroma.jpeg" class="card-img-top" alt="Vela con aroma exclusivo">
                    <div class="card-body">
                        <h5 class="card-title">Aromas únicos</h5>
                        <p class="card-text">Creamos mezclas aromáticas personalizadas que reflejan tu esencia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="assets/img/frases.jpeg" class="card-img-top" alt="Vela temática especial">
                    <div class="card-body">
                        <h5 class="card-title">Diseños temáticos</h5>
                        <p class="card-text">Personaliza colores, formas y adornos para eventos únicos e inolvidables.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php require __DIR__ . '/../partials/footer.php'; ?>

