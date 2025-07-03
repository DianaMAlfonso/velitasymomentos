<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">Mis pedidos</h2>

    <?php if (!empty($orders)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pedido</th>
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
        <p class="text-center">Aún no tienes pedidos registrados.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
