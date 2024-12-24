<?php 
class QueryBuilder
{
    public static function select(): SelectQuery
    {
        return new SelectQuery();
    }

    public static function insert(): InsertQuery
    {
        return new InsertQuery();
    }

    public static function update(): UpdateQuery
    {
        return new UpdateQuery();
    }

    public static function delete(): DeleteQuery
    {
        return new DeleteQuery();
    }
}
?>