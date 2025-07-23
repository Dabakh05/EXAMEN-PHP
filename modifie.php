<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=contacts_db", "root", "");

// Vérification : présence du paramètre id dans l'URL
if (!isset($_GET['id'])) {
  die("Erreur : Paramètre 'id' manquant.");
}

$id = $_GET['id'];

// Récupération du contact à modifier
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
  die("Erreur : Aucun contact trouvé avec l'ID donné.");
}

// Mise à jour du contact si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $pdo->prepare("UPDATE contacts SET nom=?, prenom=?, telephone=?, email=? WHERE id=?");
  $stmt->execute([
    $_POST['nom'],
    $_POST['prenom'],
    $_POST['telephone'],
    $_POST['email'],
    $id
  ]);
  echo "<p>✅ Contact modifié avec succès !</p>";
  echo '<p><a href="liste.php">Retour à la liste</a></p>';
  exit;
}
?>

<!-- Formulaire de modification -->
<form method="POST">
  <input type="text" name="nom" value="<?= htmlspecialchars($contact['nom']) ?>" required>
  <input type="text" name="prenom" value="<?= htmlspecialchars($contact['prenom']) ?>" required>
  <input type="text" name="telephone" value="<?= htmlspecialchars($contact['telephone']) ?>" required>
  <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required>
  <button type="submit">Enregistrer</button>
</form>
