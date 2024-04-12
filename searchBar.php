<?php
require_once "conn.php";
require_once "bookArchive.php";

class SearchBooksLogic
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function searchBooks($keyword)
    {
        $query = "SELECT * FROM books WHERE nameAuthor LIKE :keyword OR bookName LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $keyword = "%$keyword%"; // It also searches partial matches
        $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (isset($_POST['search'])) {
    $keyword = strip_tags($_POST["keyword"]);

    $searchBooksLogic = new SearchBooksLogic($conn);
    $searchResults = $searchBooksLogic->searchBooks($keyword);
} else {
    // Handle case when search form is not submitted
    $searchResults = [];
};
?>