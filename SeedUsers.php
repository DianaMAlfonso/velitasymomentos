<?php
require_once __DIR__ . '/config/database.php';

// Crea un hash seguro con bcrypt
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Admin
$stmt = $pdo->prepare("INSERT INTO users (email, password, username, verified, roles_mask) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([
    'admin@correo.com',
    hashPassword('123456'),
    'Admin',
    1, // verified
    2  // roles_mask: admin
]);

// Cliente
$stmt->execute([
    'cliente@correo.com',
    hashPassword('123456'),
    'Cliente',
    1, // verified
    1  // roles_mask: cliente
]);

echo "✅ Usuarios creados exitosamente:<br>";
echo "- admin@correo.com / 123456<br>";
echo "- cliente@correo.com / 123456";
