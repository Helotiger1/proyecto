function setupToggler(togglerId, divId, iconId) {
    document.getElementById(togglerId).addEventListener('click', function() {
        let miDiv = document.getElementById(divId);
        let miIcon = document.getElementById(iconId);
        miIcon.classList.toggle('rotate');
        miIcon.classList.remove('ini');
        miDiv.classList.toggle('mi-clase');
        miDiv.classList.remove('d-none');
    });
}

setupToggler('toggler1', 'Agenda', 'icon1');
setupToggler('toggler2', 'Modulos', 'icon2');
setupToggler('toggler3', 'Seguridad', 'icon3');
setupToggler('toggler4', 'Per', 'icon4');
setupToggler('toggler5', 'Cont', 'icon5');
setupToggler('toggler6', 'Master', 'icon6');
setupToggler('toggler7', 'Dom', 'icon7');

function setupDatatable(datatableId, tableId) {
    const datatableElement = document.getElementById(datatableId);
    if (datatableElement) {
        datatableElement.addEventListener('click', function() {
            let miDiv = document.getElementById(tableId);
            if (miDiv) {
                miDiv.classList.toggle('d-block');
            }
        });
    }
}

setupDatatable('datatable1', 'tabla1');
setupDatatable('datatable2', 'tabla2');
setupDatatable('datatable3', 'tabla3');
setupDatatable('datatable4', 'tabla4');
setupDatatable('datatable5', 'tabla5');