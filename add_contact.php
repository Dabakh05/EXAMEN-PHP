<?php
$pdo = new PDO("mysql:host=localhost;dbname=contacts_db", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $pdo->prepare("INSERT INTO contacts (nom, prenom, telephone, email, photo) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([
    $_POST['nom'],
    $_POST['prenom'],
    $_POST['telephone'],
    $_POST['email'],
    $_FILES['photo']['name']
  ]);
  move_uploaded_file($_FILES['photo']['tmp_name'], "photos/" . $_FILES['photo']['name']);
  header("Location: liste.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un contact</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <ul>
      <li><a href="accueil.html">🏠 Accueil</a></li>
      <li><a href="add_contact.php">➕ Ajouter</a></li>
      <li><a href="list et reseach.php">📋 Contacts</a></li>
    </ul>
  </nav>

  <div class="page-container">
    <h2>➕ Ajouter un contact</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="text" name="telephone" placeholder="Téléphone" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="file" name="photo">
      <button type="submit">Ajouter</button>
    </form>
  </div>
</body>
</html>
