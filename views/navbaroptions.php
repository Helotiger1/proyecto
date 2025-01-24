<link rel="stylesheet" href="styles.css">

<div class="user-container">
    <p><i class="fa-solid fa-circle-user"></i> <span id="username"></span></p>
</div>

<nav class="navbar navbar-light col-12">
    <div class="navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a id="toggler1" class="nav-link maintoggler agenda">
                    <i class="fa-regular fa-calendar icon ini" id="icon1"></i> Agenda
                </a>
                <div id="Agenda" class="d-none submenu-div">
                    <a href="" class="sub-menu-option">Principal</a>
                </div>
            </li>
            <li class="nav-item">
                <a id="toggler2" class="nav-link maintoggler modules" href="#">
                    <i class="fa-solid fa-gear icon ini" id="icon2"></i> Modulos
                </a>
                <div id="Modulos" class="d-none submenu-div">
                    <a href="" class="sub-menu-option">Principal</a>
                </div>
            </li>
            <li class="nav-item">
                <a id="toggler3" class="nav-link maintoggler seg" href="#">
                    <i class="fa-solid fa-lock icon ini" id="icon3"></i> Seguridad
                </a>
                <div id="Seguridad" class="d-none submenu-div">
                    <a href="" class="sub-menu-option">Principal</a>
                </div>
            </li>
            <li class="nav-item">
                <a id="toggler4" class="nav-link maintoggler pers" href="#">
                    <i class="fa-solid fa-pen icon ini" id="icon4"></i> Personalización
                </a>
                <div id="Per" class="d-none submenu-div">
                    <a href="" class="sub-menu-option">Principal</a>
                </div>
            </li>
            <li class="nav-item">
                <a id="toggler5" class="nav-link maintoggler cont" href="#">
                    <i class="fa-solid fa-calculator icon ini" id="icon5"></i> Contabilidad
                </a>
                <div id="Cont" class="d-none submenu-div">
                    <a href="" class="sub-menu-option">Principal</a>
                </div>
            </li>
            <li class="nav-item">
                <a id="toggler6" class="nav-link maintoggler masters" href="#">
                    <i class="fa-solid fa-chalkboard-user icon ini" id="icon6"></i> Maestros
                </a>
                <div id="Master" class="d-none submenu-div">
                    <a href="" class="sub-menu-option">Principal</a>
                </div>
            </li>
            <li class="nav-item">
                <a id="toggler7" class="nav-link maintoggler dom" href="#">
                    <i class="fa-solid fa-building-user icon ini" id="icon7"></i> Domicilio
                </a>
                <div id="Dom" class="d-none submenu-div">
                    <a class="sub-menu-option" id="datatable1" onclick="fetchData('/paises', 'Paises')">País</a>
                    <a class="sub-menu-option" id="datatable2" onclick="fetchData('/estados', 'Estados')">Estado</a>
                    <a class="sub-menu-option" id="datatable3" onclick="fetchData('/ciudades', 'Ciudades')">Ciudad</a>
                    <a class="sub-menu-option" id="datatable4" onclick="fetchData('/municipios', 'Municipios')">Municipio</a>
                    <a class="sub-menu-option" id="datatable5" onclick="fetchData('/parroquias', 'Parroquias')">Parroquia</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
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
</script>
