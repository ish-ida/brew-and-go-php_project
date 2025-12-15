<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew & Go</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="images/icon.png" type="image/png">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">
                <i class="fas fa-coffee"></i>
                <span>Brew & Go</span>
            </div>
            <nav class="nav-menu">
                <a href="index.php?page=home" class="<?= (isset($page) && $page === 'home') ? 'active' : '' ?>">Home</a>
                <a href="index.php?page=menu" class="<?= (isset($page) && $page === 'menu') ? 'active' : '' ?>">Menu</a>
                <a href="index.php?page=checkout" class="<?= (isset($page) && $page === 'checkout') ? 'active' : '' ?>">Checkout</a>
            </nav>
            <div class="nav-icons">
                <a href="index.php?page=cart" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if (isset($cart) && !$cart->isEmpty()): ?>
                        <span class="cart-badge"><?= count($cart->getItems()) ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </header>

    <?php if (!empty($error)): ?>
        <div class="container">
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="container">
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= htmlspecialchars($success) ?>
            </div>
        </div>
    <?php endif; ?>

    <main class="main-content">