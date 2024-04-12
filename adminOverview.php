<?php
session_start();
require_once "conn.php";

// Check if the user is logged in and has the appropriate role ID
if (!isset($_SESSION["roleId"]) || ($_SESSION["roleId"] !== 1 && $_SESSION["roleId"] !== 3)) {
    header("Location: unauthorized.php");
    exit();
}

// Define the $is_admin variable
$is_admin = ($_SESSION["roleId"] === 1 || $_SESSION["roleId"] === 3);

function deleteOrder($conn, $orderID)
{
    // First, retrieve the book's information
    $sqlGetOrder = "SELECT * FROM reserveer WHERE id = :orderID";
    $stmtGetOrder = $conn->prepare($sqlGetOrder);
    $stmtGetOrder->bindParam(":orderID", $orderID, PDO::PARAM_INT);
    $stmtGetOrder->execute();
    $order = $stmtGetOrder->fetch(PDO::FETCH_ASSOC);

    // If the order is found, proceed with deleting and returning stock
    if ($order) {
        // Delete the order
        $sqlDeleteOrder = "DELETE FROM reserveer WHERE id = :orderID";
        $stmtDeleteOrder = $conn->prepare($sqlDeleteOrder);
        $stmtDeleteOrder->bindParam(":orderID", $orderID, PDO::PARAM_INT);
        $stmtDeleteOrder->execute();

        // Update the stock
        // $sqlUpdateStock = "UPDATE books SET stock = stock + 1 WHERE id = :bookID";
        // $stmtUpdateStock = $conn->prepare($sqlUpdateStock);
        // $stmtUpdateStock->bindParam(":bookID", $order['book_id'], PDO::PARAM_INT);
        // $stmtUpdateStock->execute();

        return true; // Return true to indicate successful deletion
    } else {
        return false; // Return false if the order is not found
    }
}

// Check if the form is submitted for deleting an order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
    $orderID = $_POST["delete_order"];
    if (deleteOrder($conn, $orderID)) {
        $message = "Order successfully deleted and stock returned.";
    } else {
        $error = "Error deleting order.";
    }
}

// Query to retrieve borrowed books
$sql = "SELECT * FROM reserveer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pagina - Uitgeleende Boeken</title>
    <link href="src/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="logged_in_user.php">
                <img src="Pictures/logo2.png" alt="" width="70" height="50" class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="bookArchive.php">Bibliotheek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="createBooks.php">Boeken toevoegen</a>
                    </li>
                    <?php if ($is_admin): ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="adminOverview.php">Admin Pagina</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logOut.php">log uit</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="searchBar.php" method="POST">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Zoeken"
                        aria-label="Search">
                    <button class="btn btn-outline-light" type="submit" name="search">Zoek</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-3">Overzicht van Uitgeleende Boeken</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Bestelling Id</th>
                    <th scope="col">Titel Book</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Lener</th>
                    <th scope="col">Uitgeleend Sinds</th>
                    <?php if ($is_admin): ?>
                        <th scope="col">Verwijder bestelling</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->rowCount() > 0): ?>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td>
                                <?= $row["id"] ?>
                            </td>
                            <td>
                                <?= $row["bookName"] ?>
                            </td>
                            <td>
                                <?= $row["ISBN"] ?>
                            </td>
                            <td>
                                <?= $row["name"] . " " . $row["surname"] ?>
                            </td>
                            <td>
                                <?= $row["time"] ?>
                            </td>
                            <?php if ($is_admin): ?>
                                <td>
                                    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                                        <input type="hidden" name="delete_order" value="<?= $row["id"] ?>">
                                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Geen uitgeleende boeken gevonden</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer class="bg-dark text-center text-light fixed-bottom">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-light" href="https://github.com/PERENSAPP/Leerjaar2OOP">Evan&KevinInc.</a>
        </div>
    </footer>
</body>

</html>