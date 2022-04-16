<?php

function addWatchlist($username, $listID, $mediaID, $type, $index)
{
	global $db;
	$query = "insert into watchlist values(:username, :listID, :mediaID, :type, ;index)";
	
    // good: use a prepared statement 
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':listID', $listID);
    $statement->bindValue(':mediaID', $mediaID);
    $statement->bindValue(':type', $type);
    $statement->bindValue(':index', $index);

	$statement->execute();
	$statement->closeCursor();
}

function getWatchlist($type)
{
	global $db;
	$query = "select title from watchlist where type==:type";
	
    // good: use a prepared statement 
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
    $statement->bindValue(':type', $type);
	$statement->execute();

	// fetchAll() returns an array of all rows in the result set
	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;
}

?>

