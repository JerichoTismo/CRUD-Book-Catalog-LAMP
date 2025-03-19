<?php
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-primary text-center">Book Catalog</h1>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal">Add Book</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year Published</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bookTable">
                <!-- Book rows will be appended here by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Add/Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookForm">
                        <input type="hidden" id="bookId">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" required>
                        </div>
                        <div class="mb-3">
                            <label for="publisher" class="form-label">Publisher</label>
                            <input type="text" class="form-control" id="publisher" required>
                        </div>
                        <div class="mb-3">
                            <label for="year_published" class="form-label">Year Published</label>
                            <input type="number" class="form-control" id="year_published" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch and display books //
            function fetchBooks() {
                $.post('ajax_handler.php', { action: 'read' }, function(data) {
                    const books = JSON.parse(data);
                    let rows = '';
                    books.forEach(book => {
                        rows += `
                            <tr>
                                <td>${book.title}</td>
                                <td>${book.isbn}</td>
                                <td>${book.author}</td>
                                <td>${book.publisher}</td>
                                <td>${book.year_published}</td>
                                <td>${book.category}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="${book.id}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${book.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#bookTable').html(rows);
                });
            }

            fetchBooks();

            // Add or edit book //
            $('#bookForm').submit(function(e) {
                e.preventDefault();
                const id = $('#bookId').val();
                const action = id ? 'update' : 'create';
                const bookData = {
                    action: action,
                    id: id,
                    title: $('#title').val(),
                    isbn: $('#isbn').val(),
                    author: $('#author').val(),
                    publisher: $('#publisher').val(),
                    year_published: $('#year_published').val(),
                    category: $('#category').val()
                };
                $.post('ajax_handler.php', bookData, function() {
                    $('#bookModal').modal('hide');
                    fetchBooks();
                });
            });

            // Edit button click //
            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $.post('ajax_handler.php', { action: 'read' }, function(data) {
                    const books = JSON.parse(data);
                    const book = books.find(b => b.id == id);
                    $('#bookId').val(book.id);
                    $('#title').val(book.title);
                    $('#isbn').val(book.isbn);
                    $('#author').val(book.author);
                    $('#publisher').val(book.publisher);
                    $('#year_published').val(book.year_published);
                    $('#category').val(book.category);
                    $('#bookModal').modal('show');
                });
            });

            // Delete button click //
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this book?')) {
                    $.post('ajax_handler.php', { action: 'delete', id: id }, function() {
                        fetchBooks();
                    });
                }
            });
        });
    </script>
        <footer class="text-center mt-5">
        <p>Created by Jericho Tismo</p>
        <p><a href="https://linkedin.com/in/jericho-tismo-483b74296" target="_blank">Connect with me on LinkedIn</a></p>
        <p><a href="https://github.com/JerichoTismo" target="_blank">Connect with me on GitHub</a></p>
    </footer>
</body>
</html>