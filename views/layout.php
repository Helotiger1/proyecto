<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout con Grid y Bootstrap</title>
    <link href="styles/base.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="grid-container">

        <nav class="navbar">
            <?php require_once "components/navbar.php" ?>
        </nav>

        <section class="main-content" id="mainContent">
        </section>


        <footer class="footer">
            <?php require_once "components/footer.php" ?>
        </footer>
    </div>
</body>
<script type="module" src="./js/main.js"></script>
<script type="module" src="./js/configs.js"></script>
<script type="module" src="./js/fetch.js"></script>
<script type="module" src="./js/renderTable.js"></script>
<script type="module" src="./js/eventListeners.js"></script>
</html>