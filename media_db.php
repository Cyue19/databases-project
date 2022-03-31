<?php

function getAllMedia()
{
	global $db;
	$query = "select * from media";
	
    // good: use a prepared statement 
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
	$statement->execute();

	// fetchAll() returns an array of all rows in the result set
	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;
}

function addMedia($mediaID, $title, $director, $country, $description, $rating, $releaseYear)
{
	// db handler
	global $db;

	// write sql
	$query = "insert into media values(:mediaID, :title, :director, :country, :description, :rating, :releaseYear)";

	// execute the sql
	// $statement = $db->query($query);   // query() will compile and execute the sql
	$statement = $db->prepare($query);

	$statement->bindValue(':mediaID', $mediaID);
	$statement->bindValue(':title', $title);
	$statement->bindValue(':director', $director);
    $statement->bindValue(':country', $country);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':releaseYear', $releaseYear);

	$statement->execute();

	// release; free the connection to the server so other sql statements may be issued 
	$statement->closeCursor();
}

function updateMedia($mediaID, $title, $director, $country, $description, $rating, $releaseYear)
{
	global $db;
	$query = "update media set title=:title, director=:director, country=:country,
    description=:descrption, rating=:rating, releaseYear=:releaseYear where mediaID=:mediaID";
	
    $statement = $db->prepare($query); 
	
    $statement->bindValue(':mediaID', $mediaID);
	$statement->bindValue(':title', $title);
	$statement->bindValue(':director', $director);
    $statement->bindValue(':country', $country);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':releaseYear', $releaseYear);
	
    $statement->execute();
	$statement->closeCursor();
}

function deleteFriend($mediaID)
{
	global $db;
	$query = "delete from media where mediaID=:mediaID";
	$statement = $db->prepare($query); 
	$statement->bindValue(':mediaID', $mediaID);
	$statement->execute();
	$statement->closeCursor();
}

### filtering and sorting media ###
# sorting alphabetically (A to Z)
function getMedia_AtoZ()
{
	global $db;
	$query = "select title, description, rating from media order title asc";
	
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   
	
	$statement->closeCursor();

	return $results;	
}

# sorting reverse alphabetically (Z to A)
function getMedia_ZtoA()
{
	global $db;
	$query = "select title, description, rating from media order title desc";
	
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;	
}

# sorting by release date (most recent)
function getMedia_lateDate()
{
	global $db;
	$query = "select title, description, rating from media order releaseYear desc";
	
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;	
}

# sorting by release date (least recent)
function getMedia_earlyDate()
{
	global $db;
	$query = "select title, description, rating from media order releaseYear asc";
	
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;	
}

# filtering by year
function getMedia_year($releaseYear)
{
	global $db;
	$query = "select title, description, rating from media where releaseYear=:releaseYear";
	$statement = $db->prepare($query); 
	$statement->bindValue(':releaseYear', $releaseYear);
	$statement->execute();
	$statement->closeCursor();
}

# filtering by genre
function getMedia_genre($genre)
{
	global $db;
	$query = "select title, description, rating from media_genre where genre=:genre";
	$statement = $db->prepare($query); 
	$statement->bindValue(':genre', $genre);
	$statement->execute();
	$statement->closeCursor();
}

# filtering by movie length
function getMedia_movLen($time1, $time2)
{
	global $db;
	$query = "select title, description, rating from movie where length between :time1 and :time2";
	$statement = $db->prepare($query); 
	$statement->bindValue(':time1', $time1);
    $statement->bindValue(':time2', $time2);
	$statement->execute();
	$statement->closeCursor();
}

# filtering by show/season length
function getMedia_showLen($numSeasons)
{
	global $db;
	$query = "select title, description, rating from shows where seasons=:numSeasons";
	$statement = $db->prepare($query); 
	$statement->bindValue(':numSeasons', $numSeasons);
	$statement->execute();
	$statement->closeCursor();
}

# filtering by rating
function getMedia_rating($rating)
{
	global $db;
	$query = "select title, description, rating from media where rating>=:rating";
	$statement = $db->prepare($query); 
	$statement->bindValue(':rating', $rating);
	$statement->execute();
	$statement->closeCursor();
}
?>