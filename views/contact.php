<?php require __DIR__ . '/../views/partials/header.php'; ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">Contáctanos</h2>
    <form action="index.php?action=contact_send" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-outline-secondary">Enviar mensaje</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../views/partials/footer.php'; ?>
