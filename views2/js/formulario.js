function mostrarCampos() {
    var entidad = document.getElementById("entidad").value;

    // Ocultamos todos los campos antes de mostrar el que corresponda
    document.getElementById("campo_pais").style.display = "none";
    document.getElementById("campo_estado").style.display = "none";
    document.getElementById("campo_municipio").style.display = "none";
    document.getElementById("campo_parroquia").style.display = "none";
    document.getElementById("campo_ciudad").style.display = "none";

    // Mostramos solo el campo relevante
    if (entidad == "pais") {
        document.getElementById("campo_pais").style.display = "block";
    } else if (entidad == "estado") {
        document.getElementById("campo_estado").style.display = "block";
    } else if (entidad == "municipio") {
        document.getElementById("campo_municipio").style.display = "block";
    } else if (entidad == "parroquia") {
        document.getElementById("campo_parroquia").style.display = "block";
    } else if (entidad == "ciudad") {
        document.getElementById("campo_ciudad").style.display = "block";
    }
}

function limpiarCamposOcultos() {
    var campos = document.querySelectorAll("input, select");
    campos.forEach(function(campo) {
        if (campo.style.display === "none") {
            campo.value = ""; // Borra el valor del campo si está oculto
        }
    });
}