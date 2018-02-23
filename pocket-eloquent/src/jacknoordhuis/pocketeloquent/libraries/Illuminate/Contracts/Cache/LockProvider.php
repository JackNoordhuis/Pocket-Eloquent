<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Cache;

interface LockProvider
{
    /**
     * Get a lock instance.
     *
     * @param  string  $name
     * @param  int  $seconds
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Cache\Lock
     */
    public function lock($name, $seconds = 0);
}
