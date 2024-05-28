<?php include 'includes/header.php'; ?>
<div class="container">
    <h2>Giriş Yap</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Şifre:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Giriş Yap</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
        } else {
            echo "Geçersiz şifre!";
        }
    } else {
        echo "Bu kullanıcı adıyla kayıtlı kullanıcı bulunamadı! Lütfen sağ üst köşeden kayıt olup tekrar deneyiniz.";
    }

    $conn->close();
}
?>
