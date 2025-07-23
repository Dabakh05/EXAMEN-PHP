<?php
$pdo = new PDO("mysql:host=localhost;dbname=contacts_db", "root", "");
$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM contacts WHERE nom LIKE ? OR prenom LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$search%", "%$search%"]);
$contacts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des contacts</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <ul>
      <li><a href="accueil.php">🏠 Accueil</a></li>
      <li><a href="add_contact.php">➕ Ajouter</a></li>
      <li><a href="list et reseach.php">📋 Contacts</a></li>
    </ul>
  </nav>

  <div class="page-container">
    <h2>📋 Liste des contacts</h2>

    <form method="GET">
      <input type="text" name="search" placeholder="Rechercher un contact..." value="<?= htmlspecialchars($search) ?>">
      <button type="submit">🔍</button>
    </form>

    <table>
      <tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Email</th><th>Photo</th><th>Actions</th></tr>
      <?php foreach ($contacts as $contact): ?>
      <tr>
        <td><?= htmlspecialchars($contact['nom']) ?></td>
        <td><?= htmlspecialchars($contact['prenom']) ?></td>
        <td><?= htmlspecialchars($contact['telephone']) ?></td>
        <td><?= htmlspecialchars($contact['email']) ?></td>
        <td><img src="photos/<?= htmlspecialchars($contact['photo']) ?>" width="50" /></td>
        <td>
          <a href="modifie.php?id=<?= $contact['id'] ?>">✏️ Modifier</a> |
          <a href="supprimer.php?id=<?= $contact['id'] ?>" onclick="return confirm('Supprimer ce contact ?')">🗑️ Supprimer</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
