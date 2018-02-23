<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Eloquent;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\EntityNotFoundException;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\EntityResolver as EntityResolverContract;

class QueueEntityResolver implements EntityResolverContract
{
    /**
     * Resolve the entity for the given ID.
     *
     * @param  string  $type
     * @param  mixed  $id
     * @return mixed
     *
     * @throws \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\EntityNotFoundException
     */
    public function resolve($type, $id)
    {
        $instance = (new $type)->find($id);

        if ($instance) {
            return $instance;
        }

        throw new EntityNotFoundException($type, $id);
    }
}
