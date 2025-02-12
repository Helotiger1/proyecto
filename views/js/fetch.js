export async function fetchRequest(endpoint, method = "GET", body = null) {
    const API_BASE_URL = "http://localhost/proyecto/";
    const url = API_BASE_URL + endpoint;
    const options = {
        method,
        headers: { "Content-Type": "application/json" },
        body: body ? JSON.stringify(body) : null,
    };

    try {
        const response = await fetch(url, options);
        if (!response.ok)
            throw new Error(`Error ${response.status}: ${response.statusText}`);
        return await response.json();
    } catch (error) {
        console.error("Fetch Error:", error.message);
        throw error;
    }
}

export async function saveItem(item = null) {
    const fields = FIELDS_CONFIG[currentSection];
    const body = {};

    fields.forEach((field) => {
        body[field] = document.getElementById(field).value;
    });

    console.log(body);

    const method = currentId ? "PUT" : "POST";
    const endpoint = currentId
        ? `${API_ENDPOINTS[currentSection]}/${currentId}`
        : API_ENDPOINTS[currentSection];
    try {
        await fetchMultiple(item, method, currentSection, body);
        await loadData(currentSection);
        new bootstrap.Modal(document.getElementById("formModal")).hide();
    } catch (error) {
        alert("Error guardando los datos");
    }
}

export async function deleteItem(section, id) {
    if (confirm("¿Estás seguro de eliminar este registro?")) {
        try {
            await fetchRequest(`${section}/${id}`, "DELETE");
            await loadData(section);
        } catch (error) {
            alert("Error eliminando el registro");
        }
    }
}
