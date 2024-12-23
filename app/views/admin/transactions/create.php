<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transaction</title>
</head>
<body>
    <h1>Create Transaction</h1>
    <form action="<?= BASE_URL ?>/admin/transactions/create" method="POST">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required>
        <br>
        <label for="total_price">Total Price:</label>
        <input type="number" id="total_price" name="total_price" step="0.01" required>
        <br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <br>
        <button type="submit">Create</button>
    </form>
    <a href="<?= BASE_URL ?>/admin/transactions">Back</a>
</body>
</html>