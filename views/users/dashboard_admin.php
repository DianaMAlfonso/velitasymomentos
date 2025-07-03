<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <h1 class="mb-4 text-center">Panel de Administración</h1>

    <div class="d-flex flex-wrap justify-content-center gap-4">
        <div class="card text-center shadow-sm" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Gestión de Usuarios</h5>
                <p class="card-text">Administra los usuarios registrados y sus roles.</p>
                <a href="index.php?action=admin_users" class="btn btn-outline-secondary">Ver Usuarios</a>
            </div>
        </div>

        <div class="card text-center shadow-sm" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Gestión de Productos</h5>
                <p class="card-text">Administra el catálogo de velas y productos.</p>
                <a href="index.php?action=products" class="btn btn-outline-secondary">Ver Productos</a>
            </div>
        </div>

        <div class="card text-center shadow-sm" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Gestión de Categorías</h5>
                <p class="card-text">Organiza las categorías disponibles, crea y elimina.</p>
                <a href="index.php?action=categories" class="btn btn-outline-secondary">Ver Categorías</a>
            </div>
        </div>

        <div class="card text-center shadow-sm" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Pedidos</h5>
                <p class="card-text">Consulta todos los pedidos realizados por los clientes.</p>
                <a href="index.php?action=admin_orders" class="btn btn-outline-secondary">Ver Pedidos</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
