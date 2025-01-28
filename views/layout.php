<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout con Grid y Bootstrap</title>
    <link href="styles/base.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="grid-container">
    <nav class="navbar">
        <?php require_once "components/navbar.php"?>
    </nav>
    <section class="main-content" id="mainContent">
            <div class="table-container">
                <h4 id="tableTitle"></h4>
                <div id="loading" class="d-none">Cargando...</div>
                <table class="table table-striped" id="dataTable">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
        </section>

        <footer class="footer">
            <?php require_once "components/footer.php"?>
        </footer>
    </div>
    <div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Formulario dinámico se insertará aquí -->
            </div>
        </div>
    </div>
</div>
</body>
<script src="js/functions.js"></script>
<script src="js/fetchMultiple.js"></script>
</html>

