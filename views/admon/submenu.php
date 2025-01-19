                       
<style type="text/css">
login {
  position: absolute;
  right: 40px;
}
</style>

<head>
<script>
$(function(){
    $(".dropdown-menu > li > a.trigger").on("click",function(e){
        var current=$(this).next();
        var grandparent=$(this).parent().parent();
        if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
            $(this).toggleClass('right-caret left-caret');
        grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
        grandparent.find(".sub-menu:visible").not(current).hide();
        current.toggle();
        e.stopPropagation();
    });
    $(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
        var root=$(this).closest('.dropdown');
        root.find('.left-caret').toggleClass('right-caret left-caret');
        root.find('.sub-menu:visible').hide();
    });
});
</script>
<head>

  <div class ="container">


  <div class = "row">
    <div class="col-12">
 
		<ul class="nav nav-tabs">
                  
 				  <li class="nav-item dropdown">
    				  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Maestro</a>
    		      
              <ul class="dropdown-menu">
                      <li>
                          <a class="trigger right-caret nav-link">Noticia</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
                     
              
         
                      <li>
                          <a class="trigger right-caret nav-link">Medicina</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
                     
    
                      <li>
                          <a class="trigger right-caret nav-link">Consultorio</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
            
                      <li>
                          <a class="trigger right-caret nav-link">Especialidades</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
           
                      <li>
                          <a class="trigger right-caret nav-link">Enfermedades</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
               
                      <li>
                          <a class="trigger right-caret nav-link">Laboratorio</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
            
                      <li>
                          <a class="trigger right-caret nav-link">Radiología</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
            
                      <li>
                          <a class="trigger right-caret nav-link">Servicios</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
            
              <li>
                 <a class="trigger right-caret nav-link">Domicilio</a>
                 <ul class="dropdown-menu sub-menu">
                      <li>
                          <a class="trigger right-caret nav-link">Estado</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
                     
                      <li>
                          <a class="trigger right-caret nav-link">Municipio</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
                     
                      <li>
                          <a class="trigger right-caret nav-link">Parroquia</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
                     
                      <li>
                          <a class="trigger right-caret nav-link">Ciudad</a>
                          <ul class="dropdown-menu sub-menu">
                              <a class="dropdown-item" href="?controller=Noticia&action=ListarNoticia">Listar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="?controller=Noticia&action=IngresarNoticia">Ingresar</a>
                          </ul>
                      </li>
                     
                </ul>
  				  
            </li>
              </ul>       

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Seguridad</a>
                  <ul class="dropdown-menu">
                      <li>
                          <a class="trigger right-caret nav-link">Usuarios</a>
                             <ul class="dropdown-menu sub-menu">
                                 <a class="dropdown-item" href="?controller=Usuarios&action=ListarUsuarios">Listar </a>
                                 <a class="dropdown-item" href="?controller=Usuarios&action=IngresarUsuario">Ingresar</a>
                                 <div class="dropdown-divider"></div>
                                 <div class="dropdown-divider"></div>
                                  
                                 <a class="dropdown-item" href="?controller=Usuarios&action=Desconectar">Cerrar Sesión</a>
                          </ul>
                      </li>
                      <li>
                          <a class="trigger right-caret nav-link">Base de Datos</a>
                             <ul class="dropdown-menu sub-menu">
                                 <a class="dropdown-item" href="?controller=Revista&action=Respaldar">Respaldar </a>
                                <a class="dropdown-item" href="?controller=Revista&action=Restaurar">Restaurar </a>
                               
                          </ul>
                      </li>
                  </ul>
            </li>


  				  <li class="nav-item">
    				<a class="nav-link disabled" href="#">Disabled</a>
  				  </li>
            <login>
            <a class="text-dark" text-align="right"> <b> User: </b> <?php echo $_SESSION['User']?> <b>  Nivel:</b> <?php echo $_SESSION['Nivel']?> </a>
            </login>
				</ul>
       
		</div>
     
  </div>
</div>
 

