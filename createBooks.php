<?php
session_start();
require_once "conn.php";
$_SESSION["roleId"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <title>Boeken toevoegen</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="logged_in_user.php">
                <img src="Pictures/logo2.png" alt="" width="70" height="50" class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav text-light">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="bookArchive.php">Bibliotheek</a>
                    </li>
                    <?php
                    if (isset($_SESSION["roleId"]) && ($_SESSION["roleId"] == 1 || $_SESSION["roleId"] == 3)) {
                        echo '<li class="nav-item">
                            <a class="nav-link text-light" href="createBooks.php">Boeken toevoegen</a>
                          </li>';
                    }
                    ?>

                    <?php
                    // Check if the user is an admin
                    if (isset($_SESSION["roleId"])) {
                        if ($_SESSION["roleId"] === 3) {
                            echo '<li class="nav-item">
                                <a class="nav-link text-light" href="adminOverview.php">Admin Pagina</a>
                            </li>';
                        }
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logOut.php">log uit</a>
                    </li>
                </ul>
            </div>
        </div>
        <form class="d-flex" role="search" action="searchBar.php" method="POST">
            <input class="form-control me-2" type="search" name="keyword" placeholder="Zoeken" aria-label="Search">
            <button class="btn btn-outline-light" type="submit" name="search">Zoek</button>
        </form>
    </nav>

    <div class="row spacer text-light">
        <div class="span4">...</div>

    </div>


    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-between align-items-center h-100">

            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                <form action="createBooksLogic.php" method="post">
                    <!-- titel input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Titel</label>
                        <input type="text" id="title" id="form3Example3" name="bookName"
                            class="form-control form-control-lg" placeholder="Voer de naam van het boek in" required />

                    </div>

                    <!-- isbn input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">ISBN (13 Cijfers)</label>
                        <input type="text" id="apiKey" id="form3Example4" name="ISBN"
                            class="form-control form-control-lg" placeholder="Voer het ISBN nummer in" maxlength="13"
                            required />

                    </div>
                    <!-- auteur input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Auteur</label>
                        <input type="text" id="writer" id="form3Example4" name="nameAuthor"
                            class="form-control form-control-lg" placeholder="Voer de auteur in" required />

                    </div>
                    <!-- voorraad input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Voorraad</label>
                        <input type="number" id="form3Example4" name="stock" class="form-control form-control-lg"
                            placeholder="Voer het aantal boeken in" required />

                    </div>


                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" name="submited" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Voer boek in</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Boek niet beschikbaar? <a href="bookAvailability.php"
                                class="link-primary">Verander beschikbaarheid.</a></p>
                    </div>

                </form>
            </div>
            <div class="col-md-9 col-lg-6 ">
                <img src="Pictures/cartoonstudy.png" width="793" height="593" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="row spacer text-light">
        <div class="span4">...</div>
        <div class="span4">...</div>
        <div class="span4">...</div>



    </div>
    <footer class="bg-dark justify-content-between text-light">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-light" href="https://github.com/PERENSAPP/Leerjaar2OOP">Evan&KevinInc.</a>
        </div>
    </footer>
    <script>
        // laat de javascript pas uitvoeren als de pagina volledig geladen is
        document.addEventListener("DOMContentLoaded", function () {

            // Voeg een eventlistener toe aan het ISBN-veld en kijk of het ISBN is gewijzigd
            document.getElementById("apiKey").addEventListener("change", function () {
                var isbn = this.value; // haal de waarde van het ISBN-veld op
                fetchBook(isbn); // haal de boekgegevens op
            });
        });

        function fetchBook(isbn) {

            // Definieer de Google Books API-sleutel en de URL
            var apiKey = "AIzaSyAa1Nsuf-ELLSSZC1GHUVAw5nghtflws8k";
            var url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn + "&key=" + apiKey;

            // haalt de boekgegevens op van de Google Books API
            fetch(url)

                // verwerkt de JSON-reactie
                .then(response => response.json())

                // Roep de functie aan met de krijgen data
                .then(data => {
                    displayBook(data);
                })
                // Vang fouten op
                .catch(error => console.error(error));
        }

        // Toon de boekgegevens in een formulier
        function displayBook(data) {

            // Controleer of er boeken zijn gevonden uit het ISBN
            if (data.totalItems > 0) {
                // Haal de boekgegevens op uit de JSON-reactie
                var book = data.items[0].volumeInfo;
                // update html met boekgegevens
                document.getElementById("title").value = book.title || '';
                document.getElementById("writer").value = (book.authors && book.authors.length > 0) ? book.authors.join(', ') : '';


            } else {
                // Geef een foutmelding weer als er geen boek is gevonden
                console.log("No book found for the provided ISBN.");
            }
        }
    </script>
</body>

</html>