<?php include '../app/views/includes/header.php'; ?>

<h1>Login</h1>
<?php if (isset($data['error'])): ?>
    <p style="color:red;"><?php echo $data['error']; ?></p>
<?php endif; ?>
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Login</button>
</form>

<?php include '../app/views/includes/footer.php'; ?>
