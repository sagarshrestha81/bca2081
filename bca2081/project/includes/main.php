<?php
require_once __DIR__ . '/../database/connection.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Sabaiko Bazar — Your one-stop online marketplace for groceries, electronics, fashion, and more. Shop fresh, shop smart.">
    <title>Sabaiko Bazar — Your Online Marketplace</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Splide Slider -->
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/bca2081/project/assets/css/style.css">
</head>

<body>

    <!-- ══ SITE HEADER ══════════════════════════════════════ -->
    <header class="site-header">
        <div class="container-xl">
            <div class="d-flex align-items-center justify-content-between gap-3">

                <!-- Logo -->
                <a href="/bca2081/project/index.php" class="brand-name text-decoration-none">
                    🛒 Sabaiko Bazar
                </a>

                <!-- Nav Links -->
                <ul class="nav d-none d-md-flex align-items-center gap-1 mb-0">
                    <li><a href="/bca2081/project/index.php" class="nav-link">Home</a></li>
                    <li><a href="/bca2081/project/index.php#products" class="nav-link">Products</a></li>
                    <li><a href="#" class="nav-link">Deals</a></li>
                    <li><a href="#" class="nav-link">About</a></li>
                </ul>

                <!-- Search + Cart -->
                <div class="d-flex align-items-center gap-2">
                    <form class="d-none d-lg-flex" role="search">
                        <input type="search" class="form-control form-control-sm" placeholder="Search products..."
                            aria-label="Search" style="width: 200px; border-radius: 50px; padding-left: 1rem;">
                    </form>

                    <a href="#" class="btn-cart-icon" id="cart-btn">
                        🛒 Cart
                        <span
                            style="background: var(--clr-accent); color: var(--clr-text); border-radius: 50px; padding: 1px 8px; font-size: 0.75rem; font-weight:800;">0</span>
                    </a>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--clr-text);">
                                <i class="fa-regular fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="border-radius: var(--radius-md); box-shadow: var(--shadow-md);">
                                <li><a class="dropdown-item" href="/bca2081/project/user/profile.php">👤 Profile</a></li>
                                <li><a class="dropdown-item" href="#">⚙️ Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="#">↩ Sign out</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="/bca2081/project/user/login.php" class="nav-link">Login</a>
                        <a href="/bca2081/project/user/form.php" class="nav-link">Register</a>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </header>

    <main>