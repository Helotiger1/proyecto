class ModalForm {
  /**
   * @param {Object} config - Configuración del modal.
   * @param {string} config.title - Título del modal.
   * @param {Array} config.fields - Array de campos del formulario. Cada campo puede tener:
   *        { label, name, type, options, cascade }.
   *        Si cascade está definido, debe ser un objeto con:
   *          - target: nombre del select que se actualizará.
   *          - apiUrl: URL base para obtener los datos (se le concatenará el valor seleccionado).
   *          - placeholder (opcional): texto para la opción inicial.
   * @param {Function} config.onSubmit - Función a ejecutar al enviar el formulario.
   * @param {Function} config.onCancel - Función a ejecutar al cancelar.
   */
  constructor({ title = 'Formulario', fields = [], onSubmit = () => {}, onCancel = () => {} } = {}) {
    this.title = title;
    this.fields = fields;
    this.onSubmit = onSubmit;
    this.onCancel = onCancel;
    this.modal = null;
  }

  /**
   * Abre el modal y lo agrega al DOM.
   * @param {Object} data - Datos para prellenar el formulario (opcional).
   */
  open(data = {}) {
    this.render(data);
    document.body.appendChild(this.modal);
  }

  /**
   * Renderiza la estructura del modal, crea el formulario y adjunta los listeners de cascada.
   * @param {Object} data - Datos para prellenar el formulario.
   */
  render(data) {
    // Contenedor principal del modal
    this.modal = document.createElement('div');
    this.modal.className = 'modal fade show';
    this.modal.style.display = 'block';
    this.modal.style.backgroundColor = 'rgba(0,0,0,0.5)';

    // Contenedor del diálogo
    const dialog = document.createElement('div');
    dialog.className = 'modal-dialog';

    // Contenido del modal
    const content = document.createElement('div');
    content.className = 'modal-content';

    // Cabecera del modal
    const header = document.createElement('div');
    header.className = 'modal-header';
    const title = document.createElement('h5');
    title.className = 'modal-title';
    title.textContent = this.title;
    const btnClose = document.createElement('button');
    btnClose.type = 'button';
    btnClose.className = 'btn-close';
    btnClose.addEventListener('click', () => this.close());
    header.appendChild(title);
    header.appendChild(btnClose);
    content.appendChild(header);

    // Cuerpo del modal con formulario
    const body = document.createElement('div');
    body.className = 'modal-body';
    const form = document.createElement('form');
    form.id = 'modalForm';

    // Crear cada campo del formulario
    this.fields.forEach(field => {
      const formGroup = document.createElement('div');
      formGroup.className = 'mb-3';

      const label = document.createElement('label');
      label.className = 'form-label';
      label.textContent = field.label;
      label.setAttribute('for', field.name);

      let input;
      if (field.type === 'select') {
        input = document.createElement('select');
        input.className = 'form-select';
        // Si existen opciones iniciales, se añaden
        if (field.options && Array.isArray(field.options)) {
          field.options.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.value;
            option.textContent = opt.text;
            input.appendChild(option);
          });
        }
      } else {
        input = document.createElement('input');
        input.type = field.type || 'text';
        input.className = 'form-control';
      }
      input.name = field.name;
      input.id = field.name;
      
      // Si el campo tiene configuración de cascada, lo guardamos en un data attribute
      if (field.cascade) {
        input.dataset.cascade = JSON.stringify(field.cascade);
      }
      
      // Prellenar el campo si se proporcionan datos
      if (data[field.name] !== undefined) {
        input.value = data[field.name];
      }

      formGroup.appendChild(label);
      formGroup.appendChild(input);
      form.appendChild(formGroup);
    });
    body.appendChild(form);
    content.appendChild(body);

    // Pie del modal: botones de cancelar y guardar
    const footer = document.createElement('div');
    footer.className = 'modal-footer';
    const btnCancel = document.createElement('button');
    btnCancel.type = 'button';
    btnCancel.className = 'btn btn-secondary';
    btnCancel.textContent = 'Cancelar';
    btnCancel.addEventListener('click', () => {
      if (typeof this.onCancel === 'function') this.onCancel();
      this.close();
    });
    const btnSubmit = document.createElement('button');
    btnSubmit.type = 'button';
    btnSubmit.className = 'btn btn-primary';
    btnSubmit.textContent = 'Guardar';
    btnSubmit.addEventListener('click', () => {
      // Recopilar los datos del formulario
      const formData = {};
      new FormData(form).forEach((value, key) => {
        formData[key] = value;
      });
      if (typeof this.onSubmit === 'function') this.onSubmit(formData);
      this.close();
    });
    footer.appendChild(btnCancel);
    footer.appendChild(btnSubmit);
    content.appendChild(footer);

    dialog.appendChild(content);
    this.modal.appendChild(dialog);

    // Adjuntamos los listeners para los selects en cascada
    this.attachCascadeListeners(form);
  }

  /**
   * Busca en el formulario los selects que tengan configuración de cascada y
   * les asigna un listener para actualizar el select dependiente al cambiar.
   * @param {HTMLElement} formElement - Elemento del formulario.
   */
  attachCascadeListeners(formElement) {
    // Buscar todos los selects que tengan data-cascade definido
    const selects = formElement.querySelectorAll('select[data-cascade]');
    selects.forEach(select => {
      const cascadeConfig = select.dataset.cascade;
      if (cascadeConfig) {
        const config = JSON.parse(cascadeConfig);
        // Listener para el cambio en el select "padre"
        select.addEventListener('change', async (event) => {
          const targetName = config.target;
          const targetSelect = formElement.querySelector(`select[name="${targetName}"]`);
          if (targetSelect) {
            const selectedValue = event.target.value;
            const apiUrl = `${config.apiUrl}${selectedValue}`;
            try {
              const response = await fetch(apiUrl);
              if (!response.ok) {
                throw new Error('Error en la solicitud');
              }
              const data = await response.json();
              // Limpiar las opciones actuales del select dependiente
              targetSelect.innerHTML = '';
              // Agregar opción placeholder si se definió
              if (config.placeholder) {
                const placeholderOption = document.createElement('option');
                placeholderOption.value = '';
                placeholderOption.textContent = config.placeholder;
                targetSelect.appendChild(placeholderOption);
              }
              // Rellenar el select con las nuevas opciones
              data.forEach(item => {
                const option = document.createElement('option');
                // Se asume que cada item tiene las propiedades "value" y "text"
                option.value = item.value;
                option.textContent = item.text;
                targetSelect.appendChild(option);
              });
            } catch (error) {
              console.error('Error al cargar datos en cascada:', error);
            }
          }
        });
      }
    });
  }

  /**
   * Cierra y elimina el modal del DOM.
   */
  close() {
    if (this.modal && this.modal.parentNode) {
      this.modal.parentNode.removeChild(this.modal);
      this.modal = null;
    }
  }
}
