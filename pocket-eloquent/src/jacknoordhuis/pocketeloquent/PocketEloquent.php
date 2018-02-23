<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent;

use jacknoordhuis\pocketeloquent\database\DatabaseCredentials;
use jacknoordhuis\pocketeloquent\database\DatabaseManager;
use jacknoordhuis\pocketeloquent\facade\Facade;
use pocketmine\Server;

class PocketEloquent implements PocketEloquentCapsule {

	/** @var PocketEloquent|null */
	private static $instance = null;

	/** @var DatabaseCredentials */
	private $defaultCredentials;

	/** @var DatabaseManager */
	private $databaseManager;

	/**
	 * Quick static method to boot the eloquent ORM
	 *
	 * @param DatabaseCredentials $credentials
	 *
	 * @return PocketEloquent
	 */
	public static function boot(DatabaseCredentials $credentials) : PocketEloquent {
		return new PocketEloquent($credentials);
	}

	/**
	 * PocketEloquent constructor.
	 *
	 * @param DatabaseCredentials $credentials  Credentials used to connect to the default database
	 */
	public function __construct(DatabaseCredentials $credentials) {
		if(static::$instance === null) {
			static::$instance = $this;
		} else {
			throw new \RuntimeException("A pocket eloquent instance already exists for this plugin!");
		}

		$this->defaultCredentials = $credentials;

		Facade::setFacadeCapsule($this);

		//Server::getInstance()->getLoader()->addPath("./libraries/Illuminate/Support/helpers.php");
		//Server::getInstance()->getLoader()->addPath("./libraries/Symfony/Polyfill/bootstrap.php");

		require_once "libraries/Illuminate/Support/helpers.php";
		require_once "libraries/Symfony/Polyfill/bootstrap.php";

		$this->databaseManager = new DatabaseManager($this);
	}

	/**
	 * @return DatabaseCredentials
	 */
	public function getDefaultDatabaseCredentials() : DatabaseCredentials {
		return $this->defaultCredentials;
	}

	/**
	 * @return DatabaseManager
	 */
	public function getDatabaseManager() : DatabaseManager {
		return $this->databaseManager;
	}

	/**
	 * @return PocketEloquent
	 */
	public static function getInstance() : PocketEloquent {
		return static::$instance;
	}

}