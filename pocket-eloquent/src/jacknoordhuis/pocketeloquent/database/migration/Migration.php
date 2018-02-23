<?php
declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\database\migration;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Migrations\Migration as BaseMigration;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder;

abstract class Migration extends BaseMigration {

	/** @var int */
	public static $migrationCount = 0;

	/** @var MigrationManager */
	private $manager;

	/** @var int */
	private $id;

	public function __construct() {
		$this->id = static::$migrationCount++;
	}

	/**
	 * @return MigrationManager|null
	 */
	public function getManager() : ?MigrationManager {
		return $this->manager;
	}

	/**
	 * @return int
	 */
	public function getId() : int {
		return $this->id;
	}

	/**
	 * @param MigrationManager $manager
	 */
	public function setManager(MigrationManager $manager) : void {
		$this->manager = $manager;
	}

	/**
	 * Execute the migration
	 */
	public abstract function up();

	/**
	 * Reverse the migration
	 */
	public abstract function down();

}