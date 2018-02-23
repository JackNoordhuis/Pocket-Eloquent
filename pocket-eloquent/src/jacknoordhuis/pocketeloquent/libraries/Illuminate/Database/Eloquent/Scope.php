<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Eloquent;

interface Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Eloquent\Builder  $builder
     * @param  \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model);
}
