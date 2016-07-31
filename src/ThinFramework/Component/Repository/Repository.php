<?php

namespace ThinFramework\Component\Repository;


interface Repository
{

    public function connect();

    public function execute($statement);

    public function query($sql);

    public function prepare($sql);

    public function prepareParam($type, $value);

    public function bindParams($statement);

    public function startTransaction();

    public function lastInsertId();

    public function commit();

    public function rollBack();

    public function setResults($results);

    public function getResults();

}
