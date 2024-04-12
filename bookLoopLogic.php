<?php
session_start();
require_once "conn.php";

class BookLoopLogic
{
    private $conn;
    private $name;
    private $surname;
    private $title;
    private $isbn;
    private $time;

    public function __construct($conn, $name, $surname, $title, $isbn, $time)
    {
        $this->conn = $conn;
        $this->name = $name;
        $this->surname = $surname;
        $this->title = $title;
        $this->isbn = $isbn;
        $this->time = $time;
    }

    public function reserve()
    {
        $query = "INSERT INTO reserveer (bookName, ISBN, name, surname, time) VALUES (:bookName, :ISBN, :name, :surname, :time)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":bookName", $this->title);
        $stmt->bindParam(":ISBN", $this->isbn);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":time", $this->time);
        $stmt->execute();
    }

    public function hasReservedBook()
    {
        $query = "SELECT COUNT(*) FROM reserveer WHERE name = :name AND surname = :surname AND ISBN = :isbn";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}

class UpdateStock
{
    private $conn;
    private $id;
    private $stock;

    public function __construct($conn, $id, $stock)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->stock = $stock;
    }

    public function update()
    {
        if ($this->stock == 0) {
            header("Location: bookReservedError.php");
            exit;
        }
        $updateStock = $this->stock - 1;

        $query = "UPDATE books SET stock = :stock WHERE idbooks = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":stock", $updateStock);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
    }
}

if (isset($_POST['submit'])) {
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $id = strip_tags($_POST['submit']);
    $time = date("Y-m-d H:i:s");

    $query = 'SELECT bookName, ISBN, stock FROM books WHERE idbooks = :id';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        $title = $book['bookName'];
        $isbn = $book['ISBN'];
        $stock = $book['stock'];

        if ($stock <= 0) {
            header("Location: bookReservedError.php");
            exit;
        }

        $bookLoopLogic = new BookLoopLogic($conn, $name, $surname, $title, $isbn, $time);

        if ($bookLoopLogic->hasReservedBook()) {
            header("Location: bookReservedError.php");
            exit;
        }

        $updateStock = new UpdateStock($conn, $id, $stock);

        $bookLoopLogic->reserve();
        $updateStock->update();

        header("Location: bookReservedSucces.php");
        exit;
    } else {
        header("Location: bookReservedError.php");
        exit;
    }
}
