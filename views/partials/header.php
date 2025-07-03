<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Velitas y Momentos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php
/**
 * Navbar with:
 * - Left: hamburger dropdown menu
 * - Center: logo with vertical spacing
 * - Right: icon changes by role (dashboard, cart, login)
 */
$role = $_SESSION['role'] ?? null;
?>

<nav class="navbar shadow-sm py-4" style="background-color:rgb(247, 232, 211); position: relative;">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Left: Dropdown menu with hamburger icon -->
        <div class="dropdown">
            <a class="btn btn-outline-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </a>
            <ul class="dropdown-menu">
                <?php if ($role === 2): ?>
                    <li><a class="dropdown-item" href="index.php?action=products">Productos</a></li>
                    <li><a class="dropdown-item" href="index.php?action=admin_users">Usuarios</a></li>
                    <li><a class="dropdown-item" href="index.php?action=categories">Categorías</a></li>
                    <li><a class="dropdown-item" href="index.php?action=admin_orders">Pedidos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="index.php?action=logout">Cerrar sesión</a></li>
                <?php elseif ($role === 1): ?>
                    <li><a class="dropdown-item" href="index.php?action=products">Tienda</a></li>
                    <li><a class="dropdown-item" href="index.php?action=client_dashboard">Mi cuenta</a></li>
                    <li><a class="dropdown-item" href="index.php?action=my_orders">Mis pedidos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="index.php?action=logout">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a class="dropdown-item" href="index.php?action=register"><i class="bi bi-person-plus"></i> Registrarse</a></li>
                    <li><a class="dropdown-item" href="index.php?action=login"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</a></li>
                    <li><a class="dropdown-item" href="index.php?action=products">Tienda</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Center: Logo with vertical spacing -->
        <div class="position-absolute start-50 translate-middle-x logo-center">
            <a href="index.php">
                <img src="assets/img/logo.png" alt="Velitas y Momentos" style="height: 100px;">
            </a>
        </div>

        <!-- Right: Role-based icon -->
        <div>
            <?php if ($role === 2): ?>
                <a href="index.php?action=admin_dashboard" class="text-dark text-decoration-none">
                    <i class="bi bi-speedometer2" style="font-size: 1.5rem;"></i>
                </a>
            <?php elseif ($role === 1): ?>
                <a href="index.php?action=cart" class="text-dark text-decoration-none">
                    <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                </a>
            <?php else: ?>
                <a href="index.php?action=login" class="text-dark text-decoration-none">
                    <i class="bi bi-box-arrow-in-right" style="font-size: 1.5rem;"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Main container starts -->
<div class="container mt-4">

