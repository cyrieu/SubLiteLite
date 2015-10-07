<?php

Class MongoSingleton
{
	static $db = NULL;

	static function getMongoCon()
	{
		if (self::$db === null)
		{
			try {
				$m = new Mongo('localhost');

			} catch (MongoConnectionException $e) {
				die('Failed to connect to MongoDB ' . $e->getMessage());
			}
			self::$db = $m;
		}
		return self::$db;
	}
}