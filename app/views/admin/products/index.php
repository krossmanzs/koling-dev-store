<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Products</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin-style.css">
</head>
<body>
    <header>
        <div class="logo-wrapper">
            <img class="logo" src="/img/logo.png" alt="Logo"/>
            <p>Koling Dev. Store</p>
        </div>
        <nav>
            <a class="btn" href="<?= BASE_URL ?>/admin/transactions">MANAGE TRANSACTIONS</a>
            <a class="btn" href="<?= BASE_URL ?>/">Home</a>
            <a class="btn" href="<?= BASE_URL ?>/auth/logout">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Product List</h2>
            <div class="header-menu">
                <form method="GET" action="<?= BASE_URL ?>/admin/products" class="search-form">
                    <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <button type="submit" class="btn">Search</button>
                </form>
                <a href="<?= BASE_URL ?>/admin/products/create" class="btn">Add Product</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= htmlspecialchars($product['price']) ?></td>
                            <td><?= htmlspecialchars($product['stock']) ?></td>
                            <td class="action-cell">
                                <a class="btn" href="<?= BASE_URL ?>/admin/products/edit/<?= $product['id'] ?>" class="btn">Edit</a>
                                <a class="btn-danger" href="<?= BASE_URL ?>/admin/products/delete/<?= $product['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="<?= BASE_URL ?>/admin/products?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Koling Dev Store. All rights reserved.</p>
    </footer>
</body>
</html>
