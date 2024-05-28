<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/header.php';
include 'includes/db.php';
?>

<div class="container">
    <h2>Hayvan Listesi</h2>
    <a href="animal.php?action=add" class="btn btn-primary">Hayvan Ekle</a>
    <table class="table">
        <thead>
            <tr>
                <th>İsim</th>
                <th>Tür</th>
                <th>Doğum Tarihi</th>
                <th>Cinsiyet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM animals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['species']}</td>
                        <td>{$row['birth_date']}</td>
                        <td>{$row['gender']}</td>
                        <td>
                            <a href='animal.php?action=edit&id={$row['id']}' class='btn btn-warning'>Düzenle</a>
                            <a href='animalDelete.php?action=delete&id=<?php?action=edit&id={$row['id']} ' class='btn btn-danger' onclick='return confirmDelete()'>Sil</a>

                            </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Hayvan bulunamadı</td></tr>";
            }

            $conn->close();
            ?>

            
        </tbody>
    </table>
</div>


<script>
    function confirmDelete() {
        return confirm("Bu hayvanı silmek istediğinize emin misiniz?");
    }
</script>

<?php include 'includes/footer.php'; ?>
