<?php

namespace Passionate\Practitioner\Services;

use Passionate\Practitioner\Core\Connection;

class QueryBuilder
{
	private $connection;

	public function __construct()
	{
        $this->connection = Connection::make();
	}

	public static function all()
	{
		$object = new static;

		$className = classTreatment(get_class($object));

        $objects = $object->connection->query("SELECT * FROM {$className}");

        return $objects->fetchAll(\PDO::FETCH_CLASS, get_class($object));
	}

	public static function find($id)
	{
		$object = new static;

		$className = classTreatment(get_class($object));

        $stmt = $object->connection->prepare("SELECT * FROM :className where id = :id");

        $stmt->bindParam(':className', $className);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetchObject(get_class($object));
	}
}