
async function procesarFormulario(event) {
    event.preventDefault(); // Detiene el envío por defecto del formulario
  
    const form = event.target; // Referencia al formulario
    const formData = new FormData(form); // Captura los datos del formulario
  

    const jsonData = Object.fromEntries(formData.entries());
    console.log(jsonData);
}