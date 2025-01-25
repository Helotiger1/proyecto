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
            <div class="accordion" id="mainNavAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#agendaCollapse">Agenda</button>
                    </h2>
                    <div id="agendaCollapse" class="accordion-collapse collapse" data-bs-parent="#mainNavAccordion">
                        <div class="accordion-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action">Principal</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#modulosCollapse">
                            Módulos
                        </button>
                    </h2>
                    <div id="modulosCollapse" class="accordion-collapse collapse" 
                         data-bs-parent="#mainNavAccordion">
                        <div class="accordion-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action">Principal</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#seguridadCollapse">
                            Seguridad
                        </button>
                    </h2>
                    <div id="seguridadCollapse" class="accordion-collapse collapse" 
                         data-bs-parent="#mainNavAccordion">
                        <div class="accordion-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action">Principal</a>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Personalización -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#personalizacionCollapse">
                        Personalización
                    </button>
                </h2>
                <div id="personalizacionCollapse" class="accordion-collapse collapse" 
                     data-bs-parent="#mainNavAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">Principal</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contabilidad -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#contabilidadCollapse">
                        Contabilidad
                    </button>
                </h2>
                <div id="contabilidadCollapse" class="accordion-collapse collapse" 
                     data-bs-parent="#mainNavAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">Principal</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maestros -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#maestrosCollapse">
                        Maestros
                    </button>
                </h2>
                <div id="maestrosCollapse" class="accordion-collapse collapse" 
                     data-bs-parent="#mainNavAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">Principal</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Domicilios -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#domiciliosCollapse">
                        Domicilios
                    </button>
                </h2>
                <div id="domiciliosCollapse" class="accordion-collapse collapse" data-bs-parent="#mainNavAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action nav-link" data-section="paises">Países</a>
                            <a href="#" class="list-group-item list-group-item-action nav-link" data-section="estados">Estados</a>
                            <a href="#" class="list-group-item list-group-item-action nav-link" data-section="municipios">Municipios</a>
                            <a href="#" class="list-group-item list-group-item-action nav-link" data-section="parroquias">Parroquias</a>
                            <a href="#" class="list-group-item list-group-item-action nav-link" data-section="estado">Estado</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
<script src="js/functions.js"></script>
</html>

