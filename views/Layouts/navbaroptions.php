<style>
	body {
  padding-bottom: 20px;
  display: flex;
}
 .mi-clase{
    display:none;
 }
 .divider{
		background:gray;
		height :50px;
	}
  .master-table{
    padding: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  
  .ini{
    rotate:-360deg;
    transition: all 500ms ease;
  }

  a{
    color: black;
    padding: 6px;
    display: block;
    border-bottom: 1px solid #8080807d;
    width: 100%;
    transition: all 500ms ease;

  }  

  a:hover{
    scale: 0.96;
    transition: all 500ms ease;
    font-size: 15px;
    text-shadow: -1px 0px 8px black;
  }
.maintoggler{
  cursor: pointer;
    height: 35px;
    color: white !important;
    font-weight: 600;
    width: 100%;
    padding: 3px 7px !important;
    border-radius: 4px;
    display: flex
;
    gap: 7px;
    flex-direction: row;
    align-items: center;
}
header{
  height: 100vh;
    justify-content: center;
    background: #80808030;
    border-right: 2px solid black;
}

.navbar-nav{
  gap: 14px;
}
.navbar{
  align-items: center;
    padding: 4px;
    justify-content: center;
}

.submenu-div{
  padding: 6px;
    color: black;
    border-radius: 0px 0px 8px 8px;
    background: #ffffff;
    font-weight: 600;
    text-decoration: none;
    border: 2px;
    transition: all 500ms ease;
    
}

.user-container{
  margin-top: 8px;
  border-bottom: 1px solid white;

}
.fa-circle-user{
  font-size: 20px;

}
.user-container p{
  margin: 0px;
  padding: 5px;

}

header{
  padding: 0px 0px;
  padding-left: 0px !important;
  padding-right: 0px !important;
}
.agenda{
  transition: all 500ms ease;
  background: #178d17;

}
.nav-item{
  display: flex
;
    justify-content: center;
    flex-direction: column;
}
.agenda:hover{
  border: 2px solid goldenrod;
  background: #20bc20;
  position: relative;
  margin-left: 8px;
  scale: 1.05;
  transition: all 500ms ease;

}

.modules{
  transition: all 500ms ease;
  background: #ff8100;
}

.modules:hover{
  border: 2px solid goldenrod;
  background: #cf6900;
  scale: 1.05;
  position: relative;
  margin-left: 8px;
  transition: all 500ms ease;


}

.seg{
  transition: all 500ms ease;
  background: #4170a1;
}

.seg:hover{
  border: 2px solid goldenrod;
  background: #317ac5;
  scale: 1.05;
  position: relative;
  margin-left: 8px;
  transition: all 500ms ease;


}

.pers{
  transition: all 500ms ease;
  background: #ef4614;
}

.pers:hover{
  border: 2px solid goldenrod;
  
  background: #b95234;
  scale: 1.05;
  position: relative;
  margin-left: 8px;
  transition: all 500ms ease;


}

.cont{
  transition: all 500ms ease;
  background: #004d00;

}

.cont:hover{
  border: 2px solid goldenrod;
  background:#008700;
  scale: 1.05;
  position: relative;
  margin-left: 8px;
  transition: all 500ms ease;



}
.database-add{
  display:block !important;
}
.masters{
  transition: all 500ms ease;
  background: #00b8ff;
}

.masters:hover{
  border: 2px solid goldenrod;
  background: #095674;
  scale: 1.05;
  position: relative;
  margin-left: 8px;
  transition: all 500ms ease;


}

.dom:hover{
  border: 2px solid goldenrod;
    background: #ff0000;
    scale: 1.05;
    position: relative;
    margin-left: 8px;
    transition: all 500ms ease;

}

.dom{
  transition: all 500ms ease;
  background: #810a0a;

}
.rotate{
  transition: all 500ms ease;
  rotate: 360deg;
}
</style>

<div class="user-container">
  <p><i class="fa-solid fa-circle-user"></i> <span id="username"></span></p>
</div>

<nav class="navbar navbar-light col-12">

  <div class=" navbar-collapse" id="navbarNav">
  
  
  <ul class="navbar-nav">
      <li class="nav-item active">
        
          <a id="toggler1" class="nav-link maintoggler agenda"><i class="fa-regular fa-calendar icon ini" id="icon1"></i> Agenda</a>
          <div id="Agenda" class="d-none submenu-div">
            <a href="" class="sub-menu-option">Principal</a>
          </div>

      </li>
      <li class="nav-item">
        <a id="toggler2" class="nav-link maintoggler modules" href="#"><i class="fa-solid fa-gear icon ini"  id="icon2"></i>Modulos</a>
        <div id="Modulos" class="d-none submenu-div">
          <a href="" class="sub-menu-option">Principal</a>
        </div>
      </li>
      <li class="nav-item">
        <a id="toggler3" class="nav-link maintoggler seg" href="#"><i class="fa-solid fa-lock icon ini"  id="icon3"></i> Seguridad</a>
        <div id="Seguridad" class="d-none submenu-div">
          <a href="" class="sub-menu-option">Principal</a>
        </div>
      </li>
      <li class="nav-item">
        <a id="toggler4" class="nav-link maintoggler pers" href="#"><i class="fa-solid fa-pen icon ini"  id="icon4"></i> Personalización</a>
        <div id="Per" class="d-none submenu-div">
          <a href="" class="sub-menu-option">Principal</a>
        </div>
      </li>
      <li class="nav-item">
        <a id="toggler5" class="nav-link maintoggler cont" href="#"><i class="fa-solid fa-calculator icon ini"  id="icon5"></i>Contabilidad</a>
        <div id="Cont" class="d-none submenu-div">
          <a href="" class="sub-menu-option">Principal</a>
        </div>
      </li>
      <li class="nav-item">
        <a id="toggler6" class="nav-link maintoggler masters" href="#"><i class="fa-solid fa-chalkboard-user icon ini"  id="icon6"></i> Maestros</a>
        <div id="Master" class="d-none submenu-div">
          <a href="" class="sub-menu-option">Principal</a>
        </div>
      </li>
      <li class="nav-item">
        <a id="toggler7" class="nav-link maintoggler dom" href="#"><i class="fa-solid fa-building-user icon ini"  id="icon7"></i> Domicilio</a>
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

    // Ensure the elements exist before setting up datatables
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

