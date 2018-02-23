<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue;

interface Factory
{
    /**
     * Resolve a queue connection instance.
     *
     * @param  string  $name
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\Queue
     */
    public function connection($name = null);
}
