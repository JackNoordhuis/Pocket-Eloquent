<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Routing;

interface UrlRoutable
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey();

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName();

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value);
}
