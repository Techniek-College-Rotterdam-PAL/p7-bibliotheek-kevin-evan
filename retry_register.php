<?php
?>
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
    <title>sign up</title>
</head>

<body>

    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="Pictures/logo2.png" alt="" width="70" height="50" class="d-inline-block align-text-top"
                    href="index.php">
            </a>
        </div>
    </nav>
    <div class="row spacer text-light">
        <div class="span4">...</div>
        <div class="span4">...</div>
        <div class="span4">...</div>

    </div>
    <section>
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="Pictures/school1.png" width="393" height="393" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="alert alert-danger" role="alert">
                        Email bestaat al of is niet goed! probeer opnieuw (alleen studenten E-mail toegestaan).
                    </div>
                    <form action="signUpLogic.php" method="post">
                        <!-- Name / surname  -->
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="form3Example1">Name</label>
                                <input type="text" id="form3Example1" class="form-control form-control-lg"
                                    placeholder="Enter your name" name="name">
                            </div>

                            <!-- Surname -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="form3Example2">Surname</label>
                                <input type="text" id="form3Example2" class="form-control form-control-lg"
                                    placeholder="Enter your surname" name="surname">
                            </div>
                        </div>
                        <!-- E-mail input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Email</label>
                            <input type="email" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Voer je E-mail in" name="email" />
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Wachtwoord</label>
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Voer je wachtwoord in" name="password" />

                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Heb je al een account? <a href="login.php"
                                    class="link-primary">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row spacer text-light">
            <div class="span4">...</div>
            <div class="span4">...</div>
            <div class="span4">...</div>
            <div class="span4">...</div>
            <div class="span4">...</div>
        </div>
        <footer class="bg-dark text-center text-light">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Copyright:
                <a class="text-light" href="https://github.com/PERENSAPP/Leerjaar2OOP">Evan&KevinInc.</a>
            </div>
        </footer>
    </section>

</body>



</body>

</html>