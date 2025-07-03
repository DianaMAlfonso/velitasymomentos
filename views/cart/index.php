<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">Carrito / Pedido</h2>

    <?php
    $cart = Cart::getItems();
    $subtotal = 0;

    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $tax = $subtotal * 0.1; // 10% impuestos
    $total = $subtotal + $tax;
    ?>

    <?php if (!empty($cart)): ?>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>
                            <form action="index.php?action=update_cart" method="POST" class="d-flex align-items-center">
                                <input type="number" name="quantities[<?= $item['id'] ?>]" class="form-control form-control-sm w-50" value="<?= $item['quantity'] ?>" min="1">
                                <button type="submit" class="btn btn-outline-secondary ms-2">Actualizar</button>
                            </form>
                        </td>
                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        <td>
                            <a href="index.php?action=remove_from_cart&id=<?= $item['id'] ?>" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="index.php?action=place_order" class="btn btn-outline-secondary mt-3">Finalizar compra</a>

    <?php else: ?>
        <p class="text-center">Tu carrito está vacío. ¡Agrega productos y vuelve aquí para finalizar tu pedido!</p>
    <?php endif; ?>
</div>

<script>
function finalizarCompra() {
    Swal.fire({
        icon: 'success',
        title: '¡Pedido realizado!',
        text: 'Te contactaremos pronto para coordinar el envío.',
        confirmButtonColor: '#8c4d3f'
    })
}
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
