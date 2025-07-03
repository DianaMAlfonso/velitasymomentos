<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="text-center mb-5">
    <h1 class="mb-3">Bienvenida a tu espacio personal</h1>
    <p>Aquí puedes explorar nuestros productos artesanales, gestionar tu carrito y ver tus pedidos 💫</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 mb-4">
        <div class="border rounded p-4 text-center shadow-sm">
            <h4>Productos</h4>
            <p>Descubre velas únicas y mágicas para cada ocasión.</p>
            <a href="index.php?action=products" class="btn btn-outline-secondary">Ver Productos</a>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="border rounded p-4 text-center shadow-sm">
            <h4>Mis Pedidos</h4>
            <p>Consulta el historial de tus compras y pedidos realizados.</p>
            <a href="index.php?action=my_orders" class="btn btn-outline-secondary">Ver mis pedidos</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
