<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Redis;

interface Factory
{
    /**
     * Get a Redis connection by name.
     *
     * @param  string  $name
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Redis\Connections\Connection
     */
    public function connection($name = null);
}
