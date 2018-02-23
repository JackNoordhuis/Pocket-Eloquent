<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Support;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Support\MessageBag
     */
    public function getMessageBag();
}
