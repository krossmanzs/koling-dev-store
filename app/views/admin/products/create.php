<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin-style.css">
</head>
<body>
    <div class="form-container">
        <div class="header-form">
            <h1>Create Product</h1>
            <a href="<?= BASE_URL?>/admin/products">Manage Products</a>
        </div>
        <form action="<?= BASE_URL ?>/admin/products/create" method="POST" class="form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>

            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</body>
</html>
