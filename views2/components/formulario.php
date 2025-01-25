<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agregar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="js/formulario.js"></script>
        <script src="js/functions.js"></script>
    </head>
    <body>
    <div class="container mt-5">
        <h1>Agregar</h1>
        <form action="" method="POST" onsubmit="procesarFormulario(event)">
            <div class="mb-3">
                <label for="entidad" class="form-label">Entidad:</label>
                <select id="entidad" name="entidad" class="form-select" onchange="mostrarCampos()" required>
                    <option value="" disabled selected>Seleccione una entidad</option>
                    <option value="pais">País</option>
                    <option value="estado">Estado</option>
                    <option value="municipio">Municipio</option>
                    <option value="parroquia">Parroquia</option>
                    <option value="ciudad">Ciudad</option>
                </select>
            </div>

            <!-- Campos adicionales -->

            <div id="campo_pais" class="mb-3" style="display: none;">
                <label for="pais_nombre" class="form-label">Nombre del país:</label>
                <input type="text" id="pais_nombre" name="pais_nombre" class="form-control">

                <label for="pais_estatus" class="form-label">Estatus:</label>
                <input type="text" id="pais_estatus" name="pais_estatus" class="form-control">
            </div>

            <div id="campo_estado" class="mb-3" style="display: none;">
                <label for="estado_pais" class="form-label">País al que pertenece:</label>
                <input type="text" id="estado_pais" name="estado_pais" class="form-control">

                <label for="estado_nombre" class="form-label">Nombre del estado:</label>
                <input type="text" id="estado_nombre" name="estado_nombre" class="form-control">
            </div>

            <div id="campo_municipio" class="mb-3" style="display: none;">
                <label for="municipio_estado" class="form-label">Estado al que pertenece:</label>
                <input type="text" id="municipio_estado" name="municipio_estado" class="form-control">

                <label for="municipio_nombre" class="form-label">Nombre del municipio:</label>
                <input type="text" id="municipio_nombre" name="municipio_nombre" class="form-control">
            </div>

            <div id="campo_parroquia" class="mb-3" style="display: none;">
                <label for="parroquia_municipio" class="form-label">Municipio al que pertenece:</label>
                <input type="text" id="parroquia_municipio" name="parroquia_municipio" class="form-control">

                <label for="parroquia_nombre" class="form-label">Nombre de la parroquia:</label>
                <input type="text" id="parroquia_nombre" name="parroquia_nombre" class="form-control">
            </div>

            <div id="campo_ciudad" class="mb-3" style="display: none;">
                <label for="ciudad_parroquia" class="form-label">Parroquia a la que pertenece:</label>
                <input type="text" id="ciudad_parroquia" name="ciudad_parroquia" class="form-control">

                <label for="ciudad_nombre" class="form-label">Nombre de la ciudad:</label>
                <input type="text" id="ciudad_nombre" name="ciudad_nombre" class="form-control">
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        </div>

        <!-- Enlace a los scripts de Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
