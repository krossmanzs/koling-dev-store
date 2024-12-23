<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="header-auth">
            <h1>Register</h1>
            <a href="<?= BASE_URL ?>/">Home</a>
        </div>
        <form action="<?= BASE_URL ?>/auth/register" method="POST" class="auth-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php if (isset($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="<?= BASE_URL ?>/auth/login">Login here</a>.</p>
    </div>
</body>
</html>
