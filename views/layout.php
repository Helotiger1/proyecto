<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout con Grid y Bootstrap</title>
    <link href="styles/base.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <nav class="col-12 col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100 overflow-auto">
                <?php require_once "components/navbar.php" ?>
            </nav>
            <main class="col-md-9 col-lg-10 d-flex flex-column">
                <section class="col-12 col-md-9 col-lg-10 p-3 100vw" id="mainContent">
                </section>
            </main>
        </div>

    </div>
    <footer class="footer mt-auto py-3 bg-light w-100">
        <?php require_once "components/footer.php" ?>
    </footer>
    <script type="module" src="./js/main.js" defer></script>
</body>

</html>