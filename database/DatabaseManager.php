<?php 
namespace Proyecto\Core;
use App\Database\QueryBuilders\QueryBuilder;
use Exception;

class DatabaseManager{
    private $Connection;
    private $QueryBuilder;

    public function __construct(){
        $this->QueryBuilder = new QueryBuilder();
    }
    
   
    
    
}
?>