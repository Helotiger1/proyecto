<?php 

interface IQueryBuilders {
    public function table(string $table): self;

    public function select(array $columns): self;

    public function where(array $columns, array $operators): self;

    public function orderBy(array $columns, array $directions) : self;

    public function limit(string $limit): self; 

    public function join(string $table, string $first, string $operator, string $second, string $type): self;

    public function delete(): array;

    public function update(): array;

    public function create(): array;

    public function get(): array;
}
?>