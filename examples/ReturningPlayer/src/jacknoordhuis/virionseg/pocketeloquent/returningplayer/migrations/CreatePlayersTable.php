<?php

declare(strict_types=1);

namespace jacknoordhuis\virionseg\pocketeloquent\returningplayer\migrations;

use jacknoordhuis\pocketeloquent\database\migration\Migration;
use jacknoordhuis\pocketeloquent\database\schema\Blueprint;
use jacknoordhuis\pocketeloquent\facade\Schema;

class CreatePlayersTable extends Migration {

	/**
	 * Execute the migration
	 */
	public function up() {
		Schema::create("players", function(Blueprint $table) {
			$table->increments("id");
			$table->string("username");
			$table->integer("joins");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migration
	 */
	public function down() {
		Schema::drop("players");
	}

}