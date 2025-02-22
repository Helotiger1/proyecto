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
        <div class="register-masters">
            <strong>Registro de Maestros</strong>
            <div class="register-masters">
            <div class="register-masters">
            <div class="register-masters">
    <form id="registerForm" action="process_register.php" method="POST">
        <!-- Campos existentes -->
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select" id="sexo" name="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="estadoCivil" class="form-label">Estado Civil</label>
            <select class="form-select" id="estadoCivil" name="estadoCivil" required>
                <option value="soltero">Soltero</option>
                <option value="casado">Casado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
        </div>
        <div class="mb-3">
            <label for="telefono1" class="form-label">Teléfono 1</label>
            <input type="tel" class="form-control" id="telefono1" name="telefono1" required>
        </div>
        <div class="mb-3">
            <label for="telefono2" class="form-label">Teléfono 2</label>
            <input type="tel" class="form-control" id="telefono2" name="telefono2">
        </div>
        <div class="mb-3">
            <label for="email1" class="form-label">Email 1</label>
            <input type="email" class="form-control" id="email1" name="email1" required>
        </div>
        <div class="mb-3">
            <label for="email2" class="form-label">Email 2</label>
            <input type="email" class="form-control" id="email2" name="email2">
        </div>
        <div class="mb-3">
            <label for="cargoActual" class="form-label">Cargo Actual</label>
            <input type="text" class="form-control" id="cargoActual" name="cargoActual" required>
        </div>
        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <select class="form-select" id="pais" name="pais" required>
                <option value="">Seleccione un país</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3" id="estado-container" style="display: none;">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required disabled>
                <option value="">Seleccione un estado</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3" id="municipio-container" style="display: none;">
            <label for="municipio" class="form-label">Municipio</label>
            <select class="form-select" id="municipio" name="municipio" required disabled>
                <option value="">Seleccione un municipio</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3" id="parroquia-container" style="display: none;">
            <label for="parroquia" class="form-label">Parroquia</label>
            <select class="form-select" id="parroquia" name="parroquia" required disabled>
                <option value="">Seleccione una parroquia</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3" id="ciudad-container" style="display: none;">
            <label for="ciudad" class="form-label">Ciudad</label>
            <select class="form-select" id="ciudad" name="ciudad" required disabled>
                <option value="">Seleccione una ciudad</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea class="form-control" id="direccion" name="direccion" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
</div>
</div>
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


<script>
document.addEventListener('DOMContentLoaded', function () {
    const paisSelect = document.getElementById('pais');
    const estadoSelect = document.getElementById('estado');
    const municipioSelect = document.getElementById('municipio');
    const parroquiaSelect = document.getElementById('parroquia');
    const ciudadSelect = document.getElementById('ciudad');

    const estadoContainer = document.getElementById('estado-container');
    const municipioContainer = document.getElementById('municipio-container');
    const parroquiaContainer = document.getElementById('parroquia-container');
    const ciudadContainer = document.getElementById('ciudad-container');

    paisSelect.addEventListener('change', function () {
        if (paisSelect.value) {
            loadOptions('estado', paisSelect.value, estadoSelect, estadoContainer);
        } else {
            estadoContainer.style.display = 'none';
            municipioContainer.style.display = 'none';
            parroquiaContainer.style.display = 'none';
            ciudadContainer.style.display = 'none';
        }
    });

    estadoSelect.addEventListener('change', function () {
        if (estadoSelect.value) {
            loadOptions('municipio', estadoSelect.value, municipioSelect, municipioContainer);
        } else {
            municipioContainer.style.display = 'none';
            parroquiaContainer.style.display = 'none';
            ciudadContainer.style.display = 'none';
        }
    });

    municipioSelect.addEventListener('change', function () {
        if (municipioSelect.value) {
            loadOptions('parroquia', municipioSelect.value, parroquiaSelect, parroquiaContainer);
        } else {
            parroquiaContainer.style.display = 'none';
            ciudadContainer.style.display = 'none';
        }
    });

    parroquiaSelect.addEventListener('change', function () {
        if (parroquiaSelect.value) {
            loadOptions('ciudad', parroquiaSelect.value, ciudadSelect, ciudadContainer);
        } else {
            ciudadContainer.style.display = 'none';
        }
    });

    function loadOptions(type, id, selectElement, containerElement) {
        selectElement.innerHTML = '<option value="">Cargando...</option>';
        selectElement.disabled = true;

        fetch(`load_locations.php?type=${type}&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    selectElement.innerHTML = '<option value="">Seleccione una opción</option>';
                    data.forEach(option => {
                        const opt = document.createElement('option');
                        opt.value = option.id;
                        opt.textContent = option.nombre;
                        selectElement.appendChild(opt);
                    });
                    selectElement.disabled = false;
                    if (containerElement) {
                        containerElement.style.display = 'block';
                    }
                } else {
                    console.error('Error:', data.error);
                    selectElement.innerHTML = '<option value="">Error al cargar</option>';
                    if (containerElement) {
                        containerElement.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                selectElement.innerHTML = '<option value="">Error al cargar</option>';
                if (containerElement) {
                    containerElement.style.display = 'none';
                }
            });
    }

    // Cargar los países al cargar la página
    loadOptions('pais', '', paisSelect, null);
});
</script>
<script src="js/functions.js"></script>
<script src="js/fetchMultiple.js"></script>
</html>

