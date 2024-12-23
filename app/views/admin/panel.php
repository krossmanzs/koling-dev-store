<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin-style.css">
</head>
<body>
    <header>
        <div class="logo-wrapper">
            <img class="logo" src="/img/logo.png" alt="Logo"/>
            <p>Koling Dev. Store</p>
        </div>
        <nav>
            <a class="btn" href="<?= BASE_URL ?>/">Home</a>
            <a class="btn" href="<?= BASE_URL ?>/auth/logout">Logout</a>
        </nav>
    </header>
    <main>
        <section class="admin-dashboard">
            <h2>Admin Dashboard</h2>
            <p>Select an option from the menu to manage the store.</p>
            <div>
                <a class="btn" href="<?= BASE_URL ?>/admin/products">Manage Products</a>
                <a class="btn" href="<?= BASE_URL ?>/admin/transactions">Manage Transactions</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Koling Dev Store. All rights reserved.</p>
    </footer>
</body>
</html>
