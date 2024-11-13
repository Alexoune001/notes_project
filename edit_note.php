<?php
    require_once 'config/database.php';
    require_once 'classes/Note.php';
    require_once 'classes/NoteManager.php';

    $noteManager = new NoteManager();
    $note = null;

    if (isset($_GET['id'])) {
        $note = $noteManager->getNoteById($_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        if (!empty($title) && !empty($content)) {
            $noteManager->updateNote($_GET['id'], $title, $content);
            header('Location: index.php');
            exit;
        } else {
            $error = "Veuillez remplir tous les champs.";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier la Note</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="text-center mb-4 font-weight-bold text-white">Modifier la Note</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($note): ?>
                <form method="POST" action="" class="form-container shadow-lg rounded p-4 bg-dark text-white">
                    <div class="mb-3">
                        <label for="title" class="form-label text-white">Titre</label>
                        <input type="text" name="title" id="title" class="form-control bg-dark text-white" value="<?= htmlspecialchars($note['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label text-white">Contenu</label>
                        <textarea name="content" id="content" rows="6" class="form-control bg-dark text-white" required><?= htmlspecialchars($note['content']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Modifier la Note</button>
                    <a href="index.php" class="btn btn-sm btn-secondary ms-3">Annuler</a>
                </form>
            <?php else: ?>
                <p class="alert alert-danger">Note introuvable.</p>
            <?php endif; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
