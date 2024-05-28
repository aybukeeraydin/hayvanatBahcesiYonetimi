<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';
include 'includes/header.php';

$action = $_GET['action'];
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];

    if ($action == "add") {
        $sql = "INSERT INTO animals (name, species, birth_date, gender) VALUES ('$name', '$species', '$birth_date', '$gender')";
    } else {
        $sql = "UPDATE animals SET name='$name', species='$species', birth_date='$birth_date', gender='$gender' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    if ($action == "edit") {
        $sql = "SELECT * FROM animals WHERE id=$id";
        $result = $conn->query($sql);
        $animal = $result->fetch_assoc();
    }
}
?>

<div class="container">
    <h2><?php echo ucfirst($action); ?> Hayvan</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">İsim:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($animal['name']) ? $animal['name'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="species">Tür:</label>
            <input type="text" class="form-control" id="species" name="species" value="<?php echo isset($animal['species']) ? $animal['species'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="birth_date">Doğum Tarihi:</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo isset($animal['birth_date']) ? $animal['birth_date'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="gender">Cinsiyet:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="Male" <?php echo isset($animal['gender']) && $animal['gender'] == 'Male' ? 'selected' : ''; ?>>Erkek</option>
                <option value="Female" <?php echo isset($animal['gender']) && $animal['gender'] == 'Female' ? 'selected' : ''; ?>>Dişi</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo ucfirst($action); ?> Hayvan</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
