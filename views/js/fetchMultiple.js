async function fetchMultiple(item, method, currentSection, body) {
let bodyData
let endpoint;
console.log(item)
    if (method == "PUT") {
      if (currentSection == "ciudades") {
        endpoint = `ciudades/${item.codCiudad}`;
         bodyData = {
          "nombreCiudad": body.nombreCiudad,
          "codParroquia": item.codParroquia
        };
        await fetchRequest(endpoint, method, bodyData);
  
        endpoint = `parroquias/${item.codParroquia}`;
        bodyData = {
          "nombreParroquia": body.nombreParroquia,
          "codMunicipio": item.codMunicipio
        };
        await fetchRequest(endpoint, method, bodyData);
  
        endpoint = `municipios/${item.codMunicipio}`;
        bodyData = {
          "nombreMunicipio": body.nombreMunicipio,
          "codEstado": item.codEstado
        };
        await fetchRequest(endpoint, method, bodyData);
  
        endpoint = `estados/${item.codEstado}`;
        bodyData = {
          "nombreEstado": body.nombreEstado,
          "codPais": item.codPais
        };
        await fetchRequest(endpoint, method, bodyData);
  
        endpoint = `paises/${item.codPais}`;
        bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
      }
  
      if (currentSection == "parroquias") {
       endpoint = `parroquias/${item.codParroquia}`;
       bodyData = {
         "nombreParroquia": body.nombreParroquia,
         "codMunicipio": item.codMunicipio
       };
       await fetchRequest(endpoint, method, bodyData);
 
       endpoint = `municipios/${item.codMunicipio}`;
       bodyData = {
         "nombreMunicipio": body.nombreMunicipio,
         "codEstado": item.codEstado
       };
       await fetchRequest(endpoint, method, bodyData);
 
       endpoint = `estados/${item.codEstado}`;
       bodyData = {
         "nombreEstado": body.nombreEstado,
         "codPais": item.codPais
       };
       await fetchRequest(endpoint, method, bodyData);
 
       endpoint = `paises/${item.codPais}`;
       bodyData = {
         "nombrePais": body.nombrePais,
         "estatus": "Activo"
       };
       await fetchRequest(endpoint, method, bodyData);
      }
  
      if (currentSection == "municipios") {
 
       endpoint = `municipios/${item.codMunicipio}`;
       bodyData = {
         "nombreMunicipio": body.nombreMunicipio,
         "codEstado": item.codEstado
       };
       await fetchRequest(endpoint, method, bodyData);
 
       endpoint = `estados/${item.codEstado}`;
       bodyData = {
         "nombreEstado": body.nombreEstado,
         "codPais": item.codPais
       };
       await fetchRequest(endpoint, method, bodyData);
 
       endpoint = `paises/${item.codPais}`;
       bodyData = {
         "nombrePais": body.nombrePais,
         "estatus": "Activo"
       };
       await fetchRequest(endpoint, method, bodyData);
      }
  
      if (currentSection == "estados") {
        endpoint = `estados/${item.codEstado}`;
        bodyData = {
          "nombreEstado": body.nombreEstado,
          "codPais": item.codPais
        };
        await fetchRequest(endpoint, method, bodyData);
  
        endpoint = `paises/${item.codPais}`;
        bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
      }
  
      if (currentSection == "paises") {
        endpoint = `paises/${item.codPais}`;
         bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
      }
    }
    





    if (method == "POST") {
      if (currentSection == "ciudades") {
        endpoint = `paises`;
         bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
    
        endpoint = `estados`;
        bodyData = {
          "nombreEstado": body.nombreEstado,
          "nombrePais": body.nombrePais
        };
        await fetchRequest(endpoint, method, bodyData);
    
        endpoint = `municipios`;
        bodyData = {
          "nombreMunicipio": body.nombreMunicipio,
          "nombreEstado": body.nombreEstado
        };
        await fetchRequest(endpoint, method, bodyData);
    

        endpoint = `parroquias`;
        bodyData = {
          "nombreParroquia": body.nombreParroquia,
          "nombreMunicipio": body.nombreMunicipio
        };
        await fetchRequest(endpoint, method, bodyData);
    
        endpoint = `ciudades`;
        bodyData = {
          "nombreCiudad": body.nombreCiudad,
          "nombreParroquia": body.nombreParroquia
        };
        await fetchRequest(endpoint, method, bodyData);
      }
    
      if (currentSection == "parroquias") {
     
        endpoint = `paises`;
         bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
    
        
        endpoint = `estados`;
        bodyData = {
          "nombreEstado": body.nombreEstado,
          "nombrePais": body.nombrePais
        };
        await fetchRequest(endpoint, method, bodyData);
    
        
        endpoint = `municipios`;
        bodyData = {
          "nombreMunicipio": body.nombreMunicipio,
          "nombreEstado": body.nombreEstado
        };
        await fetchRequest(endpoint, method, bodyData);
    
       
        endpoint = `parroquias`;
        bodyData = {
          "nombreParroquia": body.nombreParroquia,
          "nombreMunicipio": body.nombreMunicipio
        };
        await fetchRequest(endpoint, method, bodyData);
      }
    
      if (currentSection == "municipios") {
        
        endpoint = `paises`;
         bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
    
       
        endpoint = `estados`;
        bodyData = {
          "nombreEstado": body.nombreEstado,
          "nombrePais": body.nombrePais
        };
        await fetchRequest(endpoint, method, bodyData);
    
        
        endpoint = `municipios`;
        bodyData = {
          "nombreMunicipio": body.nombreMunicipio,
          "nombreEstado": body.nombreEstado
        };
        await fetchRequest(endpoint, method, bodyData);
      }
    
      if (currentSection == "estados") {
      
        endpoint = `paises`;
         bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
    
      
        endpoint = `estados`;
        bodyData = {
          "nombreEstado": body.nombreEstado,
          "nombrePais": body.nombrePais
        };
  
        await fetchRequest(endpoint, method, bodyData);
      }
    
      if (currentSection == "paises") {
        endpoint = `paises`;
         bodyData = {
          "nombrePais": body.nombrePais,
          "estatus": "Activo"
        };
        await fetchRequest(endpoint, method, bodyData);
      }
    }
  
  
  }