<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Database;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\PostgresBuilder;
use jacknoordhuis\pocketeloquent\libraries\Doctrine\DBAL\Driver\PDOPgSql\Driver as DoctrineDriver;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Processors\PostgresProcessor;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Grammars\PostgresGrammar as QueryGrammar;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\PostgresGrammar as SchemaGrammar;

class PostgresConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Grammars\PostgresGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\PostgresBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new PostgresBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\PostgresGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Processors\PostgresProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new PostgresProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \Doctrine\DBAL\Driver\PDOPgSql\Driver
     */
    protected function getDoctrineDriver()
    {
        return new DoctrineDriver;
    }
}
