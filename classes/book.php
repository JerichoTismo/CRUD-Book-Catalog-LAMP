<?php
class Book {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function create($title, $isbn, $author, $publisher, $year_published, $category) {
        $stmt = $this->link->prepare("INSERT INTO books (title, isbn, author, publisher, year_published, category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssds", $title, $isbn, $author, $publisher, $year_published, $category);
        return $stmt->execute();
    }

    public function read() {
        $result = $this->link->query("SELECT * FROM books");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $title, $isbn, $author, $publisher, $year_published, $category) {
        $stmt = $this->link->prepare("UPDATE books SET title=?, isbn=?, author=?, publisher=?, year_published=?, category=? WHERE id=?");
        $stmt->bind_param("ssssdsi", $title, $isbn, $author, $publisher, $year_published, $category, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->link->prepare("DELETE FROM books WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>