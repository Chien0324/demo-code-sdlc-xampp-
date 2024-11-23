<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM Grades WHERE id = $id");
header("Location: Manage.php");
exit;
?>
