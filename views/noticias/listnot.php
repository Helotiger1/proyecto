<?php 
   require_once('controllers/NoticiaController.php');
   $controller= new NoticiaController();
   $result_noticia= $controller->ListarNoticia1();
   $numrows = mysqli_num_rows($result_noticia);
?>

<div class="contaniner">

<br> <br>
<h4> Listado de Noticias Registradas en el Sistema de Telemedicina </h4>
<br> <br>
 

<div class="table-responsive">
<table id="dtBasicExample" data-order='[[ 0, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%" >
 
  <thead>
     <tr>
              <th class="th-sm">Id</th>
              <th class="th-sm">Titular</th>
              <th class="th-sm">Categoría</th>
              <th class="th-sm">Fecha</th>
              <th class="th-sm">Visible</th>
              <th class="th-sm">Imagen</th>
              <th class="th-sm">Modificar</th>
              <th class="th-sm">Eliminar</th>
     </tr>

  </thead>

 <tbody>
 <?php 
     
      if ($numrows != 0)
      {
                       while ($numrows = mysqli_fetch_array($result_noticia))
                       {?>
                            <tr>
                              
                            </tr>
                  <?php }
      }
?>
</tbody>
</table>
</div>
</div>


 


