<?php 


public function matchNameAndID($nombreMunicipio){
    $Municipios = $this->Municipioontroller->index(); 
    foreach ($Municipios as $Municipio) { 
        if ($nombreMunicipio== $Municipio->nombreMunicipio) { 
            return $Municipio>codMunicipio 
        }
    }
    return;
}

?>