<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Debug;

use jacknoordhuis\pocketeloquent\libraries\Symfony\Component\VarDumper\Cloner\VarCloner;
use jacknoordhuis\pocketeloquent\libraries\Symfony\Component\VarDumper\Dumper\CliDumper;

class Dumper
{
    /**
     * Dump a value with elegance.
     *
     * @param  mixed  $value
     * @return void
     */
    public function dump($value)
    {
        if (class_exists(CliDumper::class)) {
            $dumper = in_array(PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper : new HtmlDumper;

            $dumper->dump((new VarCloner)->cloneVar($value));
        } else {
            var_dump($value);
        }
    }
}
