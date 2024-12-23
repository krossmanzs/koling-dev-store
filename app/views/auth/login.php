<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="header-auth">
            <h1>Login</h1>
            <a href="<?= BASE_URL ?>/">Beranda</a>
        </div>
        <form action="<?= BASE_URL ?>/auth/login" method="POST" class="auth-form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php if (isset($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="<?= BASE_URL ?>/auth/register">Register here</a>.</p>
    </div>
</body>
</html>
