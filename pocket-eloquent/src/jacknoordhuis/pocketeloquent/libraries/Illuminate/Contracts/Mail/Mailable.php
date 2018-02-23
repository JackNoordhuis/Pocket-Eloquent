<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Mail;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\Factory as Queue;

interface Mailable
{
    /**
     * Send the message using the given mailer.
     *
     * @param  \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function send(Mailer $mailer);

    /**
     * Queue the given message.
     *
     * @param  \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\Factory  $queue
     * @return mixed
     */
    public function queue(Queue $queue);

    /**
     * Deliver the queued message after the given delay.
     *
     * @param  \DateTime|int  $delay
     * @param  \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Queue\Factory  $queue
     * @return mixed
     */
    public function later($delay, Queue $queue);
}
