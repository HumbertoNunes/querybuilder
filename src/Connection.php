<?php

namespace Passionate\Practitioner;

class Connection
{
    public static function make()
    {
    	try {
            return new \PDO('mysql:host=localhost;dbname=estoque','humberto.souza','');
    	} catch (\PDOException $e) {
    		throw new \Exception($e->getMessage());
    	}
    }
}