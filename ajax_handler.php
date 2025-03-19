<?php
// These file handles all the AJAX requests from the client-side //
require 'config.php';
require 'classes/book.php';

$book = new Book($link);

$action = $_POST['action'];

switch ($action) {
    case 'create':
        $book->create($_POST['title'], $_POST['isbn'], $_POST['author'], $_POST['publisher'], $_POST['year_published'], $_POST['category']);
        break;
    case 'read':
        echo json_encode($book->read());
        break;
    case 'update':
        $book->update($_POST['id'], $_POST['title'], $_POST['isbn'], $_POST['author'], $_POST['publisher'], $_POST['year_published'], $_POST['category']);
        break;
    case 'delete':
        $book->delete($_POST['id']);
        break;
}
?>