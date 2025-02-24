export class TableView {
    /**
     * @param {string} containerId - ID del elemento contenedor donde se renderizará la tabla.
     * @param {Object[]} columns - Array de objetos que describen las columnas. Ej:
     *    [{ header: 'ID', field: 'id' }, { header: 'Nombre', field: 'nombre' }]
     * @param {Object[]} data - Array de objetos con los datos a mostrar.
     * @param {Object} options - Opciones adicionales, por ejemplo, botones de acción.
     *    Ej: { actions: ['edit', 'delete'] }
     */

    constructor(columns, data, options = {}) {
      this.container = document.getElementById('mainContent');
      if (!this.container) throw new Error('Contenedor no encontrado');
      this.columns = columns;
      this.data = data;
      this.options = options;
    }
  
    // Método para renderizar la tabla
    render() {
      // Limpiar contenedor
      this.container.innerHTML = '';
  
      // Crear tabla y su cuerpo
      const table = document.createElement('table');
      table.className = 'table-view'; // Puedes asignarle clases para estilos
  
      // Cabecera
      const thead = document.createElement('thead');
      const headerRow = document.createElement('tr');
      this.columns.forEach(col => {
        const th = document.createElement('th');
        th.textContent = col.header;
        headerRow.appendChild(th);
      });
  
      // Si se han definido acciones, se agrega columna adicional
      if (this.options.actions && this.options.actions.length > 0) {
        const th = document.createElement('th');
        th.textContent = 'Acciones';
        headerRow.appendChild(th);
      }
      thead.appendChild(headerRow);
      table.appendChild(thead);
  
      // Cuerpo de la tabla
      const tbody = document.createElement('tbody');
      this.data.forEach(item => {
        const row = document.createElement('tr');
        // Genera las celdas de datos según las columnas definidas
        this.columns.forEach(col => {
          const td = document.createElement('td');
          td.textContent = item[col.field];
          row.appendChild(td);
        });
        // Botones de acción
        if (this.options.actions && this.options.actions.length > 0) {
          const td = document.createElement('td');
          this.options.actions.forEach(action => {
            const btn = document.createElement('button');
            btn.textContent = action.charAt(0).toUpperCase() + action.slice(1);
            btn.className = `btn-${action}`;
            // Agregar data attributes para identificar el registro y la acción
            btn.setAttribute('data-id', item.id);
            btn.setAttribute('data-action', action);
            // Aquí se podrían agregar listeners de evento o delegarlos después
            td.appendChild(btn);
          });
          row.appendChild(td);
        }
        tbody.appendChild(row);
      });
      table.appendChild(tbody);
  
      // Agregar la tabla al contenedor
      this.container.appendChild(table);
    }
  }
  