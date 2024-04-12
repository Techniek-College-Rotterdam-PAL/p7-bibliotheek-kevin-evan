<?php
require_once "conn.php";

class BookArchiveLogic
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getBooks()
    {
        $query = "SELECT * FROM books";
        $get_books = $this->conn->prepare($query);
        $get_books->execute();
        return $get_books->fetchAll();
    }

    public function searchBooks($keyword)
    {
        $query = "SELECT * FROM books WHERE nameAuthor LIKE :keyword OR bookName LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBook($bookID)
    {
        $query = "DELETE FROM books WHERE idbooks = :bookID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":bookID", $bookID);
        return $stmt->execute(); // Returns true if deletion is successful, false otherwise
    }
}

$bookArchiveLogic = new BookArchiveLogic($conn);
$books = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $bookID = $_POST['submit'];
    $deleteResult = $bookArchiveLogic->deleteBook($bookID);
    if ($deleteResult) {
        $message = "Book successfully deleted.";
    } else {
        $error = "Error deleting book.";
    }
}

if (isset($_POST['search']) && isset($_POST['keyword'])) {
    $keyword = strip_tags($_POST["keyword"]);
    $searchResults = $bookArchiveLogic->searchBooks($keyword);
} else {
    // Get all books if search is not performed
    $books = $bookArchiveLogic->getBooks();
}
?>

<?php
if (isset($searchResults) && !empty($searchResults)) {

    foreach ($searchResults as $book) {
        echo "
        <div class='card text-bg-dark' style='max-width: 19rem;'>
            <div class='card-header'> Titel: " . $book['bookName'] . "</div>
            <ul class='list-group list-group-flush text-bg-dark'>
                <li class='list-group-item text-bg-dark'> ISBN: " . $book['ISBN'] . "</li>
                <li class='list-group-item text-bg-dark'> Auteur: " . $book['nameAuthor'] . "</li>
                <li class='list-group-item text-bg-dark'> Voorraad: " . $book['stock'] . "</li>
            </ul>
            <form action='#' method='post'> 
            <button name='submit' value=" . $book['idbooks'] . " class='btn btn-danger'>Verwijder boek</button>
            </form>
            <div class='span4 text-dark'>...</div>
        </div>";
    }
} else {
    // Display all books if search is not performed
    foreach ($books as $book) {
        echo "
        <div class='card text-bg-dark' style='max-width: 19rem;'>
            <div class='card-header'> Titel: " . $book['bookName'] . "</div>
            <ul class='list-group list-group-flush text-bg-dark'>
                <li class='list-group-item text-bg-dark'> ISBN: " . $book['ISBN'] . "</li>
                <li class='list-group-item text-bg-dark'> Auteur: " . $book['nameAuthor'] . "</li>
                <li class='list-group-item text-bg-dark'> Voorraad: " . $book['stock'] . "</li>
            </ul>
            <form action='#' method='post'>
            <button name='submit' value=" . $book['idbooks'] . " class='btn btn-danger'>Verwijder boek</button>
            </form>
            <div class='span4 text-dark'>...</div>
        </div>";
    }
}
?>

<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
if (isset($error)) {
    echo "<p>$error</p>";
}
?>