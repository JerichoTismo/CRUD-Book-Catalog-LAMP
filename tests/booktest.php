<?php

use PHPUnit\Framework\TestCase;

require_once 'c:\xampp\htdocs\August99Inc_Dev\classes\Book.php';

class BookTest extends TestCase
{
    private $link;
    private $book;

    protected function setUp(): void
    {
        $this->link = new mysqli('localhost', 'root', '', 'August99Inc_Dev');
        $this->book = new Book($this->link);
    }

    protected function tearDown(): void
    {
        $this->link->close();
    }

    private function cleanUpDatabase(): void
    {
        $this->link->query("DELETE FROM books");
    }

    /**
     * @covers Book::create
     */
    public function testCreateBook()
    {
        $result = $this->book->create('Test Title', '1234567890123', 'Test Author', 'Test Publisher', 2025, 'Test Category');
        $this->assertTrue($result);
    }

    /**
     * @covers Book::read
     */
    public function testReadBooks()
    {
        $books = $this->book->read();
        $this->assertIsArray($books);
    }

    /**
     * @covers Book::update
     */
    public function testUpdateBook()
    {
        $result = $this->book->update(1, 'Updated Title', '1234567890123', 'Updated Author', 'Updated Publisher', 2025, 'Updated Category');
        $this->assertTrue($result);
    }

    /**
     * @covers Book::delete
     */
    public function testDeleteBook()
    {
        $result = $this->book->delete(1);
        $this->assertTrue($result);
    }

    /**
     * @covers Book::create
     */
    public function testStressCreateBooks()
    {
        $this->cleanUpDatabase(); // Clean up the database before running the test //

        $numBooks = 1000; // Number of books to create for stress testing, you may change this value to increase or decrease the number of books for the stress test //
        for ($i = 0; $i < $numBooks; $i++) {
            $result = $this->book->create("Test Title $i", "123456789012$i", "Test Author $i", "Test Publisher $i", 2025, "Test Category $i");
            $this->assertTrue($result);
            if (!$result) {
                echo "Failed to create book $i\n";
            }
        }
    }

    /**
     * @covers Book::read
     */
    public function testStressReadBooks()
    {
        $books = $this->book->read();
        $this->assertIsArray($books);
        $this->assertGreaterThanOrEqual(1000, count($books)); // You may change the first value depending on the $numBooks value in testStressCreateBooks() //
    }

    /**
     * @covers Book::update
     */
    public function testStressUpdateBooks()
    {
        $books = $this->book->read();
        foreach ($books as $book) {
            $result = $this->book->update($book['id'], "Updated Title {$book['id']}", $book['isbn'], $book['author'], $book['publisher'], $book['year_published'], $book['category']);
            $this->assertTrue($result);
        }
    }

    /**
     * @covers Book::delete
     */
    public function testStressDeleteBooks()
    {
        $books = $this->book->read();
        foreach ($books as $book) {
            $result = $this->book->delete($book['id']);
            $this->assertTrue($result);
        }
    }
}
?>