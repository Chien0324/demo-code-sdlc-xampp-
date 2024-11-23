<?php include 'db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: Manage.php");
    exit;
}
?>
