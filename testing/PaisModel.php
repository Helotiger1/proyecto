<?php

use PHPUnit\Framework\TestCase;
use App\ORM\QueryBuilder;

require_once 'vendor/autoload.php';

class QueryBuilderTest extends TestCase {
    protected $queryBuilder;

    protected function setUp(): void {
        $this->queryBuilder = new QueryBuilder('', 'paises');
    }

    public function testSelect() {
        
        $resultado = $this->queryBuilder->get();
        $this->assertEquals([''], $resultado['columns']);
    }

}

?>