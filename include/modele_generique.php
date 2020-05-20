<?php

class ModeleGenerique {

	private static $dns;
	private static $user;
	private static $password;
	protected static $connexion;

	function __construct() {
		self::$dns = "mysql:host=db5000192667.hosting-data.io;dbname=dbs187492";
		self::$user = "dbu307082";
		self::$password = 's2kSE$F21mN1';
		self::$connexion = self::init();
	}

	function init() {
		self::$connexion = new PDO( self::$dns, self::$user, self::$password );
		self::$connexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		self::$connexion->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
		self::$connexion->query( 'SET NAMES utf8' );
		return self::$connexion;
	}

}


?>