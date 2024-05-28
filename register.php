<?php include 'includes/header.php'; ?>
<div class="container">
    <h2>Kayıt Ol</h2>
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Şifre:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Kayıt Ol</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarılı! Giriş yapabilirsiniz.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
