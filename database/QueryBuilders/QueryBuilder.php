<?php 
namespace App\Database\QueryBuilders;
require __DIR__ . '/../../vendor/autoload.php';
class QueryBuilder
{
    public static function select(): SelectBuilder
    {
        return new SelectBuilder();
    }

    public static function insert(): InsertBuilder
    {
        return new InsertBuilder();
    }

    public static function update(): UpdateBuilder
    {
        return new UpdateBuilder();
    }

    public static function delete(): DeleteBuilder
    {
        return new DeleteBuilder();
    }
}
?>