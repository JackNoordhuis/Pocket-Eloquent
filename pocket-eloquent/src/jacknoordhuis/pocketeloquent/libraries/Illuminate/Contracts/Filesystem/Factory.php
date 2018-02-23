<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Filesystem;

interface Factory
{
    /**
     * Get a filesystem implementation.
     *
     * @param  string  $name
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Filesystem\Filesystem
     */
    public function disk($name = null);
}
