<?php

declare(strict_types=1);

namespace jacknoordhuis\virionseg\pocketeloquent\returningplayer;

use jacknoordhuis\pocketeloquent\database\DatabaseCredentials;
use jacknoordhuis\pocketeloquent\facade\Migration;
use jacknoordhuis\pocketeloquent\facade\Migrator;
use jacknoordhuis\pocketeloquent\PocketEloquent;
use jacknoordhuis\virionseg\pocketeloquent\returningplayer\migrations\CreatePlayersTable;
use jacknoordhuis\virionseg\pocketeloquent\returningplayer\model\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class ReturningPlayer extends PluginBase implements Listener {

	/** @var PocketEloquent */
	private $pocketEloquent;

	/** @var Config */
	private $config;

	public function onEnable() {
		$this->saveDefaultConfig();
		$this->config = $config = $this->getConfig();

		$this->pocketEloquent = PocketEloquent::boot(DatabaseCredentials::fromArray($config->getAll()));

		// Register all migrations this plugin uses
		Migration::registerAll([
			new CreatePlayersTable()
		]);

		// Run all new migrations
		Migrator::run();

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event) {
		$p = $event->getPlayer();

		$player = Player::where("username", "=", $p->getLowerCaseName())->first();

		if($player) {
			$player->joins++;
			$this->getServer()->broadcastMessage(sprintf("%s is a returning player who first joined on %s and last joined on %s with %s total joins.", $p->getName(), $player->created_at, $player->updated_at, $player->joins));
			$player->save();
		} else {
			$this->getServer()->broadcastMessage(sprintf("%s is a new player!", $p->getName()));

			$player = Player::create([
				"username" => $p->getLowerCaseName(),
				"joins" => 1
			]);
			$player->save();
		}
	}

}