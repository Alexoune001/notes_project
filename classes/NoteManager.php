<?php
class NoteManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllNotes($search = '') {
        $sql = "SELECT * FROM notes WHERE title LIKE :search OR content LIKE :search ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['search' => "%$search%"]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    public function getNoteById($id) {
        $sql = "SELECT * FROM notes WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();
    }

    public function createNote($title, $content) {
        $sql = "INSERT INTO notes (title, content) VALUES (:title, :content)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['title' => $title, 'content' => $content]);
    }

    public function updateNote($id, $title, $content) {
        $sql = "UPDATE notes SET title = :title, content = :content WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id, 'title' => $title, 'content' => $content]);
    }

    public function deleteNote($id) {
        $sql = "DELETE FROM notes WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(['id' => $id]);
    }
}
