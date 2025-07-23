<?php
$pdo = new PDO("mysql:host=localhost;dbname=contacts_db", "root", "");
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->execute([$id]);
header("Location: liste.php");
exit;
?>
 \