<?php

if (isset($_SESSION['User']) == 1)
{   
    require_once('controllers/NoticiaController.php');
    $controller= new NoticiaController();
    $result_noticia= $controller->BuscarUltimaNoticia();
    $numrows = mysqli_num_rows($result_noticia)
?>

<div class="contaniner"> <!-- 1 -->

 <div class="page-content"><!-- 3 --> 
    <form action= "?controller=Noticia&action=IngresarNoticia1" method = "POST"> <!-- 3 -->
       <div class="col-12"> <!-- 5 -->
       <br>
			    	<h4> Ingreso de Noticias Publicadas o por Publicar</h4>
       <br>
       <div class="alert alert-success">
            <div class ="row"> <!-- 6 -->
              <div class="col-6">
                       
                       <label for="busqueda" align="right" size="40"> <b>Id de la Noticia: </b> </label> 

                   <?php
                  
                       while ($numrows = mysqli_fetch_array($result_noticia))
                       {
                       ?>
                            <input class="form-control mr-sm-2" aria-label="Search" title= "Sólo números son permitidos. Tamaño máximo 2 caracteres" type="" align="left" placeholder = "<?php echo $numrows["identific"] + 1; ?>" maxlength = "5" id="busqueda" readonly=readonly name="id" required pattern="[1-9]{1,2}" value= "<?php echo $numrows["identific"] + 1; ?>" /> <br>
                       <?php
                       }?>


                       <label for="busqueda" align="right" size="40" > <b>Título en Español: </b> </label>   
                       <textarea class="form-control" maxlength = "200" placeholder = "ingrese aquí el título del artículo en español" id="exampleFormControlTextarea1" name = "titular" rows="4" required></textarea> 
                    

                			<label for="busqueda" align="right" size="40"> <b>Visible: </b> </label>    
      		        	  <select class="form-control" name ="visible" required> 
      			                  <option>si </option>
      			                  <option>no </option>
        				      </select> <br>

                      <label for="busqueda" align="right" size="40"> <b>Fecha de Publicación: </b> </label> 
                      <p> <input type="date" name="fecha" size="40" step="1" min="2020-01-01" max="2030-12-31" value="<?php echo date("Y-m-d");?>"> </p>

                      <label for="busqueda" align="right" size="40"> <b>Categoría: </b> </label>    
                      <select class="form-control" name ="categoria" required> 
                              <option>Ciencia y Tecnología </option>
                              <option>Medicina </option>
                              <option>Investigación </option>
                              <option>Salud </option>
                              <option>Alimentación </option>
                              <option>Política </option>
                              <option>Estética y Belleza</option>
                              <option>Deporte</option>
                              <option>Geografía</option>
                              <option>Comunicación</option>

                      </select> <br>
                </div>

   	           <div class="col-6">
 	
     			            <label for="busqueda" align="right" size="40"> <b>Url de la Noticia:</b> </label>    
                      <textarea class="form-control" maxlength = "500" placeholder = "ingrese aquí el título del artículo en español" id="exampleFormControlTextarea1" name= "url_noticia" rows="7" required></textarea> 

                      <br>

                      <label for="busqueda" align="right" size="40"> <b>Url de la Imagen:</b> </label>    
                      <textarea class="form-control" maxlength = "500" placeholder = "ingrese aquí el título del artículo en español" id="exampleFormControlTextarea1" name= "url_imagen" rows="7" required></textarea> 
                      	
 	              </div> <!-- 6 -->
          </div>
               
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button> 

       </div> <!-- 5 -->
       </div>
    </form>  <!-- 3 -->
 </div> <!-- 4 -->

<p> <br> </p>

</div> <!-- 1 -->


<?php 
}
else {
   require_once('../revista-cientifica-catedra-digital/views/noticias/insertnot.php');
}

?>