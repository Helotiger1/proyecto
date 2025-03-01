import { API_CONFIG } from "./configs.js";

export async function fetchRequest(endpoint, method = "GET", body = null) {
    const API_BASE_URL = "http://localhost/proyecto/";

    let splitted = endpoint.split("/")[0];

    if(body){
        body = pick(body, API_CONFIG[splitted]);
    }

    const url = API_BASE_URL + endpoint;
    const options = {
        method,
        headers: { "Content-Type": "application/json" },
        body: body ? JSON.stringify(body) : null,
    };

    console.log(options);

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


const pick = (obj, keys) => Object.fromEntries(keys.map(k => [k, obj[k]]));





