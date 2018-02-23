<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\database;

use jacknoordhuis\pocketeloquent\database\driver\EloquentDrivers;

class DatabaseCredentials {

	/** @var string */
	private $driver;

	/** @var string */
	private $host;

	/** @var int */
	private $port;

	/** @var string */
	private $schema;

	/** @var string */
	private $username;

	/** @var string */
	private $password;

	/** @var string */
	private $socket;

	/**
	 * Construct a database credentials instance from an array
	 *
	 * @param array $data
	 *
	 * @return DatabaseCredentials
	 */
	public static function fromArray(array $data) : DatabaseCredentials {
		return new DatabaseCredentials($data["driver"] ?? EloquentDrivers::DRIVER_MYSQL, $data["host"] ?? "127.0.0.1", $data["port"] ?? 3306, $data["schema"] ?? $data["database"] ?? "", $data["username"] ?? "root", $data["password"] ?? "", $data["unix_socket"] ?? "");
	}

	/**
	 * Constructs a new database credentials instance
	 *
	 * @param string $driver
	 * @param string $host
	 * @param int    $port
	 * @param string $schema
	 * @param string $username
	 * @param string $password
	 * @param string $socket
	 */
	public function __construct(string $driver, string $host, int $port, string $schema, string $username, string $password, string $socket = "") {
		$this->driver = $driver;
		$this->host = $host;
		$this->port = $port;
		$this->schema = $schema;
		$this->username = $username;
		$this->password = $password;
		$this->socket = $socket;
	}

	/**
	 * @return string
	 */
	public function getDriver() : string {
		return $this->driver;
	}

	/**
	 * @return string
	 */
	public function getHost() : string {
		return $this->host;
	}

	/**
	 * @return int
	 */
	public function getPort() : int {
		return $this->port;
	}

	/**
	 * @return string
	 */
	public function getSchema() : string {
		return $this->schema;
	}

	/**
	 * @return string
	 */
	public function getUsername() : string {
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getPassword() : string {
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getSocket() : string {
		return $this->socket;
	}

	/**
	 * Convert the credentials to an array
	 *
	 * @return array
	 */
	public function toArray() {
		return [
			"driver" => $this->driver,
			"host" => $this->host,
			"port" => $this->port,
			"database" => $this->schema,
			"username" => $this->username,
			"password" => $this->password,
			"unix_socket" => $this->socket,
		];
	}

	/**
	 * Conver the credentials to a human readable string without leaking the password
	 *
	 * @return string
	 */
	public function __toString() {
		return "{$this->username}@{$this->host}:{$this->port}/{$this->schema},{$this->socket}";
	}

	/**
	 * Allows the credentials to be var_dump()'ed without leaking the password
	 *
	 * @return array
	 */
	public function __debugInfo() {
		return [
			"driver" => $this->driver,
			"host" => $this->host,
			"port" => $this->port,
			"schema" => $this->schema,
			"username" => $this->username,
			"password" => str_repeat("*", strlen($this->password)),
			"unix_socket" => $this->socket
		];
	}
}