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
        <div class="row">
            
            <nav class="col-12 col-md-3 col-lg-2 p-0">
                <?php require_once "components/navbar.php" ?>
            </nav>

            <section class="col-12 col-md-9 col-lg-10 p-3" id="mainContent">
            </section>
        </div>
        <footer class="footer mt-auto py-3 bg-light">
        <?php require_once "components/footer.php" ?>
    </footer>
    </div> 
<script type="module" src="./js/main.js" defer></script>
<script type="module" src="./js/init.js" defer></script>
<script type="module" src="./js/api.js" defer></script>
<script type="module" src="./js/features/modalForms.js" defer></script>
<script type="module" src="./js/features/renderTable.js" defer></script>
<script type="module" src="./js/features/configs.js" defer></script>
</body>
</html>

