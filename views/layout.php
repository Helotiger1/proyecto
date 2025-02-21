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
        
        <?php require_once "components/navbar.php" ?>

        <section class="main-content" id="mainContent">
        </section>


    </div>
    <footer class="footer">
            <?php require_once "components/footer.php" ?>
        </footer>
</body>
<script type="module" src="./js/main.js"></script>
<script type="module" src="./js/init.js"></script>
<script type="module" src="./js/api.js"></script>
<script type="module" src="./js/features/domicilios/modalForms.js"></script>
<script type="module" src="./js/features/domicilios/renderTable.js"></script>
<script type="module" src="./js/features/domicilios/configs.js"></script>
</html>