<?php
function connectdb(){
	$dsn  = 'mysql:dbname=RankingHack;host=localhost';
	$user = 'hacker';
	$pw   = 'Duce!Duce!2017';

	try {
		$dbh = new PDO($dsn, $user, $pw);
		return($dbh);
	}
	catch (PDOException $e) {
		throw $e;
	}
}