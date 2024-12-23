<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
</head>
<body>
    <h1>Order Product</h1>
    <form action="" method="POST">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        <br>
        <button type="submit">Place Order</button>
    </form>
    <a href="<?= BASE_URL ?>/">Back to Home</a>
</body>
</html>
