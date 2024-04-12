<?php
session_start();
require_once "conn.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="span4">...</div>
        <div class="span4">...</div>
    </div>

    <div class="row justify-content-around">
        <div class="card mb-3 text-bg-primary" style="max-width: 50rem;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Welkom:
                            <?php echo $_SESSION["name"] . " " . $_SESSION["surname"]; ?>
                        </h5>
                        <p class="card-text">Op school zijn er soms studenten die vanwege financiële redenen geen
                            schoolboeken kunnen aanschaffen, op deze website kunt u boeken gratis reserveren op kosten
                            van school.</p>

                    </div>
                </div>
                <div class="col-md-4">
                    <img src="Pictures/studykids.png" class="img-fluid rounded-start" alt="...">
                </div>
            </div>
        </div>
        <div class="card mb-3 text-bg-dark" style="max-width: 40rem;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">EVKE Boekenwinkel</h5>
                        <p class="card-text">Ontdek ons uitgebreide assortiment aan studieboeken, werkboeken, en
                            naslagwerken voor alle niveaus en vakgebieden.<br> Bij ons vind je alles wat je nodig hebt
                            om succesvol te zijn in je studie.</p>

                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="card mb-3 text-bg-dark" style="max-width: 40rem;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Wat wij bieden:</h5>
                        <p class="card-text">
                        <ul>
                            <li>Leerboeken voor alle vakken en niveaus</li>
                            <li>Werkboeken en oefenmateriaal</li>
                            <li>Naslagwerken en encyclopedieën</li>
                            <li>Examenbundels en samenvattingen</li>
                        </ul>
                        </p>

                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <div class="card mb-3 text-bg-primary" style="max-width: 50rem;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">Blader door onze collectie en vind de juiste materialen om je studie te
                            ondersteunen. Onze deskundige medewerkers staan klaar om je te helpen bij het vinden van de
                            juiste boeken voor jouw specifieke behoeften.
                        <div class="row spacer text-light">
                            <div class="span4"></div>
                        </div>
                        <br>Bezoek onze winkel en bereid je optimaal voor op succes in je studie!
                        </p>

                    </div>
                </div>
                <div class="col-md-4">
                    <img src="Pictures/school1.png" class="img-fluid rounded-start" alt="..." height="10px">
                </div>
            </div>
        </div>
    </div>
    <div class="row spacer text-light">
        <div class="span4">...</div>
        <div class="span4">...</div>

    </div>

    <footer class="bg-dark text-center text-light">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-light" href="https://github.com/PERENSAPP/Leerjaar2OOP">Evan&KevinInc.</a>
        </div>
    </footer>

</body>

</html>