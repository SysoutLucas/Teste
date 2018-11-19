<?php
namespace App\model;

class ConnectionFactory {
    private static $instance;
    
    public static function getInstance()
    {
        try
        {
            if (!isset(static::$instance))
            {
                $dns = "mysql:host=localhost;dbname=teste_revict;charset=utf8";
                $pass = "";
                $user = "root";
                static::$instance = new \PDO($dns, $user, $pass);
                static::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                static::$instance->setAttribute(\PDO::ATTR_ORACLE_NULLS, \PDO::NULL_EMPTY_STRING);
               // static::$instance->setAttribute(\PDO::ATTR_AUTOCOMMIT, FALSE);
               // static::$instance->setAttribute(\PDO::ATTR_PERSISTENT, TRUE);
            }
            return static::$instance;
            }catch(\PDOException $e)
            {
            	$error = array(
            		'message' => 'Erro ao se conectar com a base de dados',
            		'errror'  => $e->getMessage());
            	echo(json_encode($error));
            }
        }
    public static function closeInstance()
    {
            static::$instance=null;
    }
}

