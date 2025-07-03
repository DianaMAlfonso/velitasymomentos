<?php require __DIR__ . '/../partials/header.php'; ?>

<script>
Swal.fire({
    icon: 'success',
    title: '¡Pedido realizado!',
    text: 'Tu pedido ha sido registrado. Pronto te contactaremos.',
    confirmButtonColor: '#8c4d3f'
}).then(() => {
    window.location.href = "index.php";
});
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
