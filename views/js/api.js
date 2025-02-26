export async function fetchRequest(endpoint, method = "GET", body = null) {
    const API_BASE_URL = "http://localhost/proyecto/";
    
    const url = API_BASE_URL + endpoint;
    console.log(url, method);
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





