<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Database;

use PDO;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\MySqlBuilder;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Processors\MySqlProcessor;
use jacknoordhuis\pocketeloquent\libraries\Doctrine\DBAL\Driver\PDOMySql\Driver as DoctrineDriver;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Grammars\MySqlGrammar as QueryGrammar;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\MySqlGrammar as SchemaGrammar;

class MySqlConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Grammars\MySqlGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\MySqlBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new MySqlBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\MySqlGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Processors\MySqlProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new MySqlProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \Doctrine\DBAL\Driver\PDOMySql\Driver
     */
    protected function getDoctrineDriver()
    {
        return new DoctrineDriver;
    }

    /**
     * Bind values to their parameters in the given statement.
     *
     * @param  \PDOStatement $statement
     * @param  array  $bindings
     * @return void
     */
    public function bindValues($statement, $bindings)
    {
        foreach ($bindings as $key => $value) {
            $statement->bindValue(
                is_string($key) ? $key : $key + 1, $value,
                is_int($value) || is_float($value) ? PDO::PARAM_INT : PDO::PARAM_STR
            );
        }
    }
}
