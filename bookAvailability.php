<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Bibliotheek</title>
    <link href="src/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
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

    <H1 class="text-center">Boeken verwijderen</H1>

    <div class="row spacer text-light">
        <div class="span4">...</div>
        <div class="span4">...</div>

    </div>
    <div class="container text-center">
        <div class="row justify-content-start g-2 gap-3">

            <?php
            include 'bookAvailabilitylogic.php';
            ?>
        </div>
    </div>







    <!-- <footer class="bg-dark text-center text-light">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-light" href="https://github.com/PERENSAPP/Leerjaar2OOP">Evan&KevinInc.</a>
        </div>
    </footer> -->
</body>

</html>