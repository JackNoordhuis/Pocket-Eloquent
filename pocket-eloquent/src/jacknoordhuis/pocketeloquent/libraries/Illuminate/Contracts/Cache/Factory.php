<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Cache;

interface Factory
{
    /**
     * Get a cache store instance by name.
     *
     * @param  string|null  $name
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Cache\Repository
     */
    public function store($name = null);
}
