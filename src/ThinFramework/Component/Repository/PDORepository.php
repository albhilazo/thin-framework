<?php

namespace ThinFramework\Component\Repository;


class PDORepository implements Repository
{

    private $host;
    private $user;
    private $password;
    private $dbname;

    private $db;
    private $results;
    private $params = [];

    private $lastId = 0;


    public function __construct($host, $user, $password, $dbname)
    {
        $this->host     = $host;
        $this->user     = $user;
        $this->password = $password;
        $this->dbname   = $dbname;
    }


    public function connect()
    {
        $this->db = new \PDO(
            "mysql:host={$this->host};dbname={$this->dbname}",
            $this->user,
            $this->password
        );
    }


    public function execute($statement)
    {
        if ($this->params)
        {
            $this->bindParams($statement);
        }

        $statement->execute();
        $this->setResults($statement);
    }


    public function query($sql)
    {
        $results = $this->db->query($sql);
        $this->setResults($results);
    }


    public function prepare($sql)
    {
        return $this->db->prepare($sql);
    }


    public function prepareParam($type, $value)
    {
        $this->params[] = [
            'type'  => $type,
            'value' => $value
        ];
    }


    public function bindParams($statement)
    {
        foreach ($this->params as $param)
        {
            $statement->bindParam($param['type'], $param['value']);
        }

        $this->params = [];
    }


    public function startTransaction()
    {
        $this->db->beginTransaction();
    }


    public function lastInsertId()
    {
        return $this->lastId;
    }


    public function commit()
    {
        $this->lastId = $this->db->lastInsertId();
        $this->db->commit();
    }


    public function rollBack()
    {
        $this->db->rollBack();
    }


    public function setResults($results)
    {
        $this->results = $results;
        return $this;
    }


    public function getResults()
    {
        if ($this->results)
        {
            return $this->results->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

}
