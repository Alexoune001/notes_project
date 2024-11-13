<?php
require_once 'config/database.php';
require_once 'classes/NoteManager.php';

$noteManager = new NoteManager();

if (isset($_GET['id'])) {
    $noteManager->deleteNote($_GET['id']);
    header("Location: index.php");
    exit();
}
