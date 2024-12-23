<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Transactions</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin-style.css">
</head>
<body>
    <header>
        <div class="logo-wrapper">
            <img class="logo" src="/img/logo.png" alt="Logo"/>
            <p>Koling Dev. Store</p>
        </div>
        <nav>
            <a class="btn" href="<?= BASE_URL ?>/admin/products">MANAGE PRODUCTS</a>
            <a class="btn" href="<?= BASE_URL ?>/">Home</a>
            <a class="btn" href="<?= BASE_URL ?>/auth/logout">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Transaction List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transactions)): ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?= htmlspecialchars($transaction['order_id']) ?></td>
                                <td><?= htmlspecialchars($transaction['user_name']) ?></td>
                                <td>$<?= htmlspecialchars($transaction['total_price']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($transaction['status'])) ?></td>
                                <td><?= htmlspecialchars($transaction['created_at']) ?></td>
                                <td class="action-cell">
                                    <a href="<?= BASE_URL ?>/admin/transactions/edit/<?= $transaction['order_id'] ?>" class="btn">Edit Status</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No transactions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="<?= BASE_URL ?>/admin/transactions?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
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
