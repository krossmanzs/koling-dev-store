<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin-style.css">
</head>
<body>
    <div class="form-container">
        <div class="header-form">
            <h1>Edit Product</h1>
            <a href="<?= BASE_URL?>/admin/products">Manage Products</a>
        </div>
        <form action="<?= BASE_URL ?>/admin/products/edit/<?= $product['id'] ?>" method="POST" class="form">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>

            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>

            <div>
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>
            </div>

            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
  
