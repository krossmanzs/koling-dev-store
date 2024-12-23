<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body>
<header>
    <div class="logo-wrapper">
        <img class="logo" src="/img/logo.png" alt="Logo"/>
        <p>Koling Dev. Store</p>
    </div>
    <nav>
        <?php if (isset($_SESSION['user'])): ?>
            <span>Hello, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin" class="btn">Dashboard</a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/auth/logout" class="btn">Logout</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/auth/login" class="btn">Login</a>
        <?php endif; ?>
    </nav>
</header>
<div class="container">
    <?php if (!isset($_SESSION['user'])): ?>
        <div class="information-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
            </svg>
            <p>You must login to order those item!</p>
        </div>
        <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] == "admin"): ?>
            <div class="danger-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
            </svg>
            <p>Admin cannot order products!</p>
        </div>
    <?php endif; ?>

    <div class="header-product">
        <h1>List Product</h1>
        <form method="GET" action="<?= BASE_URL ?>/" class="search-form">
            <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <div class="price">$<?= htmlspecialchars($product['price']) ?></div>
                <p>Stock: <?= htmlspecialchars($product['stock']) ?></p>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'member'): ?>
                    <form action="<?= BASE_URL ?>/order/create/<?= $product['id'] ?>" method="POST">
                        <label for="quantity_<?= $product['id'] ?>">Quantity:</label>
                        <input type="number" id="quantity_<?= $product['id'] ?>" name="quantity" min="1" required>
                        <button type="submit">Order</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?= BASE_URL ?>/?search=<?= urlencode($search) ?>&page=<?= $i ?>"
               class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>
<footer>
    <p>&copy; <?= date('Y') ?> Koling Dev Store. All rights reserved.</p>
</footer>
</body>
</html>
