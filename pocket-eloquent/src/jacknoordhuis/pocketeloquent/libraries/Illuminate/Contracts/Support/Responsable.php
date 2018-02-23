<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Support;

interface Responsable
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \jacknoordhuis\pocketeloquent\libraries\Illuminate\Http\Request  $request
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Http\Response
     */
    public function toResponse($request);
}
