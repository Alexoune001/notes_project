<?php
    require_once 'config/database.php';
    require_once 'classes/Note.php';
    require_once 'classes/NoteManager.php';

    $noteManager = new NoteManager();
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $notes = $noteManager->getAllNotes($search);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion de Notes</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="text-center mb-4 font-weight-bold">Gestion de Notes</h1>

            <!-- Barre de recherche -->
            <form method="GET" action="" class="mb-4">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Rechercher une note..." class="form-control w-50 mx-auto">
            </form>

            <!-- Bouton Ajouter une note -->
            <a href="create_note.php" class="btn btn-sm btn-primary mb-3">Ajouter une note</a>

            <!-- Liste des notes -->
            <div class="list-group">
                <?php foreach ($notes as $note): ?>
                    <?php 
                        // Formater la date avec DateTime pour obtenir le format d/m/y H:i
                        $date = new DateTime($note['created_at']);
                        $formattedDate = $date->format('d/m/Y H:i');
                    ?>
                    <div class="list-group-item note-item mb-3 shadow-lg rounded">
                        <h5 class="note-title"><?= htmlspecialchars($note['title']) ?></h5>
                        <p class="note-content"><?= nl2br(htmlspecialchars($note['content'])) ?></p>
                        <small class="text-muted note-date">Créé le <?= $formattedDate ?></small>
                        <div class="note-actions mt-3">
                            <a href="edit_note.php?id=<?= $note['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_note.php?id=<?= $note['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
