<?php require __DIR__ . '/../../../views/partials/header.php'; ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">Todos los pedidos</h2>

    <!-- Export button -->
    <div class="text-end mb-3">
        <a href="index.php?action=export_orders_excel" target="_blank" class="btn btn-outline-secondary">
            <i class="bi bi-file-earmark-excel"></i> Descargar pedidos Excel
        </a>
    </div>

    <?php if (!empty($orders)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Cliente ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['user_id']) ?></td>
                        <td><?= htmlspecialchars($order['client_name']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= htmlspecialchars($order['product_name']) ?></td>
                        <td><?= htmlspecialchars($order['product_quantity']) ?></td>
                        <td>$<?= number_format($order['unit_price'], 2) ?></td>
                        <td>$<?= number_format($order['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No hay pedidos registrados aún.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../../../views/partials/footer.php'; ?>
