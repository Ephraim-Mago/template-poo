<?php

namespace Config\Databases;

abstract class Model extends Database
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = strtolower(explode('\\', get_class($this))[2]) . 's';
    }

    public function findBy(string $colum, int|string $value): array|bool|Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE {$colum} = ?", [$value], true);
    }

    public function all(bool $orderBy = false): array|Model
    {
        if ($orderBy) {
            return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        }
        return $this->query("SELECT * FROM {$this->table}");
    }

    public function where(string $colum, int|string $value): array|Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE {$colum} = ? ORDER BY created_at DESC", [$value]);
    }

    public function create(array $data, ?array $relations = null)
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ", ";
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }

        return $this->query("INSERT INTO {$this->table} ($firstParenthesis) VALUES ($secondParenthesis)", $data);
    }

    public function update(int $id, array $data, ?array $relations = null)
    {
        $requestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? " " : ', ';
            $requestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;

        return $this->query("UPDATE {$this->table} SET {$requestPart} WHERE id = :id", $data);
    }

    public function destroy(int $id): bool
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    protected function query(string $sql, array $params = null, bool $signle = null)
    {
        $method = is_null($params) ? 'query' : 'prepare';

        if (
            strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'INSERT') === 0
        ) {
            $stmt = $this->getPDO()->$method($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->getPDO()]);
            return $stmt->execute($params);
        }

        $fetch = is_null($signle) ? 'fetchAll' : 'fetch';

        $stmt = $this->getPDO()->$method($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->getPDO()]);

        if ($method === 'query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute($params);
            return $stmt->$fetch();
        }
    }
}