<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\database\driver;

/**
 * Constants for the eloquent driver types
 */
interface EloquentDrivers {

	const DRIVER_MYSQL = "mysql";
	const DRIVER_POSTGRES = "pgsql";
	const DRIVER_SQLITE = "sqlite";
	const DRIVER_SQLSERVER = "sqlsrv";

}