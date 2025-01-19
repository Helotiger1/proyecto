<?php
if (isset($_SESSION['User']) == 1 and (isset($_GET['i']) == 1))
{ 
  $id = $_GET['i'];
  require_once('controllers/NoticiaController.php');
  $controller= new NoticiaController();
  $result_noticia= $controller->BuscarNoticiaById($id);
  $numrows = mysqli_num_rows($result_noticia);
  
  if ($numrows != 0)
  {
     while ($numrows = mysqli_fetch_array($result_noticia))
     {
           $titular = $numrows["titular"];
           $fecha = $numrows["fecha"];
           $visible = $numrows["visible"];
           $categoria = $numrows["categoria"];
           $url_noticia = $numrows["url_noticia"];
           $url_imagen = $numrows["url_imagen"];
      }
?>

<div class="contaniner"> <!-- 1 -->

 <div class="page-content"><!-- 3 --> 
    <form action= "?controller=Noticia&action=UpdateNoticia1" method = "POST"> <!-- 3 -->
       <div class="col-12"> <!-- 5 -->
       <br>
			    	<h4> Actualización de Noticias Publicadas o por Publicar</h4>
       <br>
       <div class="alert alert-success">
            <div class ="row"> <!-- 6 -->
              <div class="col-6">
                       
                       <label for="busqueda" align="right" size="40"> <b>Id de la Noticia: </b> </label> 

                       <input class="form-control mr-sm-2" aria-label="Search" title= "Sólo números son permitidos. Tamaño máximo 2 caracteres" type="" align="left" placeholder = "<?php echo $id; ?>" maxlength = "5" id="busqueda" readonly=readonly name="id" required pattern="[1-9]{1,2}" value= "<?php echo $id; ?>" /> <br>
                

                       <label for="busqueda" align="right" size="40" > <b>Título en Español: </b> </label>   
                       <textarea class="form-control" maxlength = "200"id="Textarea1" name = "titular" rows="4" required><?php echo $titular; ?></textarea> 
                    

                			<label for="busqueda" align="right" size="40"> <b>Visible: </b> </label>    
      		        	  <select class="form-control" name ="visible" required >
                      <?php
                         echo "<option value='".$visible."'>".$visible."</option>";   
                         if ($visible !== "si")  echo "<option>si</option>";
                         if ($visible !== "no") echo "<option>no</option>";
                       
                      ?>
      
        				      </select> <br>

                      <label for="busqueda" align="right" size="40"> <b>Fecha de Publicación: </b> </label> 
                      <p> <input type="date" name="fecha" size="40" step="1" min="2020-01-01" max="2030-12-31" value= "<?php echo $fecha; ?>"> </p>

                      <label for="busqueda" align="right" size="40"> <b>Categoría: </b> </label>    
                      <select class="form-control" name ="categoria" required> 
                      <?php
                         echo "<option value='".$categoria."'>".$categoria."</option>";   
                         if ($categoria !== "Ciencia y Tecnología")  echo "<option>Ciencia y Tecnología</option>";
                         if ($categoria !== "Medicina") echo "<option>Medicina</option>";
                         if ($categoria !== "Investigación") echo "<option>Investigación</option>";
                         if ($categoria !== "Salud") echo "<option>Salud</option>";
                         if ($categoria !== "Alimentación") echo "<option>Alimentación</option>";
                         if ($categoria !== "Política") echo "<option>Política</option>";
                         if ($categoria !== "Estética y Belleza") echo "<option>Estética y Belleza</option>";
                         if ($categoria !== "Deporte") echo "<option>Deporte</option>";
                               
                         if ($categoria !== "Geografía") echo "<option>Geografía</option>";
                               
                         if ($categoria !== "Comunicación") echo "<option>Comunicación</option>";
                       
                      ?>
      
                      </select> <br>
                </div>

   	           <div class="col-6">
 	
     			            <label for="busqueda" align="right" size="40"> <b>Url de la Noticia:</b> </label>    
                      <textarea class="form-control" maxlength = "500" id="Textarea2" name= "url_noticia" rows="7" required><?php echo $url_noticia; ?></textarea> 

                      <br>

                      <label for="busqueda" align="right" size="40"> <b>Url de la Imagen:</b> </label>    
                      <textarea class="form-control" maxlength = "500" id="Textarea3" name= "url_imagen" rows="7" required><?php echo $url_imagen; ?></textarea> 
                      	
 	              </div> <!-- 6 -->
          </div>
               
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Actualizar</button> 

       </div> <!-- 5 -->
      </div>
    </form>  <!-- 3 -->
 </div> <!-- 4 -->

<p> <br> </p>

</div> <!-- 1 -->
<?php

}else{
    require_once('../revista-cientifica-catedra-digital/views/noticias/listnot.php');
}
 
}else 
{
   require_once('../revista_catedra_digital/views/noticias/listnot.php');
}
?>