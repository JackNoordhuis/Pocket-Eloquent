<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Database;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\SQLiteBuilder;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Processors\SQLiteProcessor;
use jacknoordhuis\pocketeloquent\libraries\Doctrine\DBAL\Driver\PDOSqlite\Driver as DoctrineDriver;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Grammars\SQLiteGrammar as QueryGrammar;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\SQLiteGrammar as SchemaGrammar;

class SQLiteConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Grammars\SQLiteGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\SQLiteBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new SQLiteBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\SQLiteGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Query\Processors\SQLiteProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new SQLiteProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \Doctrine\DBAL\Driver\PDOSqlite\Driver
     */
    protected function getDoctrineDriver()
    {
        return new DoctrineDriver;
    }
}
