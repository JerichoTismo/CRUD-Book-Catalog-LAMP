# Book Catalog

This project is a simple book catalog application built with PHP, MySQL, jQuery, and Bootstrap. It allows users to add, edit, and delete books using a Bootstrap modal and AJAX for CRUD operations.

## Features

- Add new books
- Edit book information
- Delete books
- Each book has the following fields:
  - Title (Text)
  - ISBN (Text)
  - Author (Text)
  - Publisher (Text)
  - Year Published (Int)
  - Category (Text)

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache server (XAMPP recommended for local development)
- Composer (for dependency management)

## Setup

1. **Clone the repository:**

   ```sh
   git clone <repository_url>
   cd August99Inc_Dev
   ```

2. **Install Dependencies:**

   ```sh
   composer install
   ```

3. **Database Setup**

   Ensure MySQL is running.
   Create a database named August99Inc_Dev.
   Import the database schema from the sql/tables.sql file:

4. **Configure the database connection:**

   Update the config.php file with your database credentials if they differ from the default settings.

5. **Run the application:**

   Ensure your Apache server is running. Open your web browser and navigate to:

   ```
   http://localhost/August99Inc_Dev/index.php
   ```

## Usage

Click the "Add Book" button to open the modal and add a new book.
Click the "Edit" button next to a book to edit its information.
Click the "Delete" button next to a book to delete it.

## Project Structure

index.php: Main entry point of the application.
config.php: Database configuration file.
classes/Book.php: PHP class for handling CRUD operations.
ajax_handler.php: Handles AJAX requests for CRUD operations.
sql/tables.sql: SQL file to create the books table.
vendor/: Contains third-party libraries (e.g., FontAwesome, DataTables).

## Testing

This project uses PHPUnit for unit testing. To run the tests, follow these steps:

1. **Install PHPUnit:**

   If you haven't installed PHPUnit yet, you can install it via Composer:

   ```sh
   composer require --dev phpunit/phpunit
   ```

2. **Run the tests:**

   To run the tests, execute the following command in the project root directory:

   ```sh
   ./vendor/bin/phpunit
   ```

3. **Test Structure:**

   The tests are located in the `tests` directory. Each test file corresponds to a class in the `classes` directory and contains unit tests for that class.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.

## Acknowledgements
- [Bootstrap](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [FontAwesome](https://fontawesome.com/)
- [DataTables](https://datatables.net/)

## Contact
For any questions or inquiries, please contact [jerichotismo0@gmail.com].

