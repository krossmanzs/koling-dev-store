<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction Status</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin-style.css">
</head>
<body>
    <div class="form-container">
        <div class="header-form">
            <h1>Edit Transaction Status</h1>
            <a href="<?= BASE_URL?>/admin/transactions">Manage Transactions</a>
        </div>
        <form action="<?= BASE_URL ?>/admin/transactions/edit/<?= $transaction['id'] ?>" method="POST" class="form">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pending" <?= $transaction['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $transaction['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled" <?= $transaction['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
            <br>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
