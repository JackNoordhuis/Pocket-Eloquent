<?php

declare(strict_types=1);

namespace jacknoordhuis\virionseg\pocketeloquent\returningplayer\model;

use jacknoordhuis\pocketeloquent\database\model\Model as Eloquent;

class Player extends Eloquent {

	protected $fillable = ["username", "joins"];

}