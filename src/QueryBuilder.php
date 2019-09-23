<?php

namespace Passionate\Practitioner;

use Passionate\Practitioner\Connection;

class QueryBuilder
{
    private $connection;

    private $className;

    public function __construct()
    {
        $this->connection = Connection::make();

        $this->className = classTreatment(get_class($this));
    }

    public static function all()
    {
        $object = new static;

        $objects = $object->connection->query("SELECT * FROM {$object->className}");

        return $objects = $objects->fetchAll(\PDO::FETCH_CLASS, get_class($object));
    }

    public static function find($id)
    {
        $object = new static;

        $stmt = $object->connection->prepare("SELECT * FROM {$object->className} WHERE id = :id");

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetchObject(get_class($object));
    }

    public function save($request)
    {
    	$columns = $this->getFillableColumns();

    	$values = $this->getValues($request);

    	$this->connection->query("INSERT INTO boxes ({$columns}) VALUES ({$values})");
    }

    public function update($request)
    {
    	$columns = $this->getFillableColumns();

    	foreach ($request as $column => $value) {
    		$this->connection->query("UPDATE boxes set {$column} = '{$value}' WHERE id = $this->id");
    	}
    }

    public function getValues($request) {
        foreach($request as $attr => $value) {
            if(!in_array($attr, $this->fillable)) {
                unset($request[$attr]);
            }
        }

        if(empty($request)) {
    		throw new \Exception("Nenhum valor passado");
    	}

        return "'".implode("', '",$request)."'";
    }

    public function getFillableColumns()
    {
    	return implode(", ", $this->fillable);
    }
}