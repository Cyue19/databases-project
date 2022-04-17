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
	$query = "select title from WatchList NATURAL JOIN Media where type=:type AND username=:username";
	
    // good: use a prepared statement 
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
    $statement->bindValue(':type', $type);
	$statement->bindValue(':username', $_SESSION['user']);
	$statement->execute();

	echo $type;

	// fetchAll() returns an array of all rows in the result set
	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;
}

?>

