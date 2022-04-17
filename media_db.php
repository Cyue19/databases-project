<?php

function getAllMedia()
{
	global $db;
	$query = "select * from Media";
	
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


//for dropdowns
function getYears() {
	global $db;
	$query = "SELECT DISTINCT releaseYear FROM Media ORDER BY releaseYear";
	
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   
	
	$statement->closeCursor();

	return $results;	
}

function getGenres() {
	global $db;
	$query = "SELECT DISTINCT genre FROM Media_Genre ORDER BY genre";
	
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   
	
	$statement->closeCursor();

	return $results;	
}

function getSeasons() {
	global $db;
	$query = "SELECT DISTINCT seasons FROM Shows ORDER BY seasons";
	
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   
	
	$statement->closeCursor();

	return $results;	
}

### filtering and sorting media ###
# sorting alphabetically (A to Z)
function getMedia_AtoZ()
{
	global $db;
	$query = "SELECT mediaID, title, description, rating FROM Media ORDER BY title ASC";
	
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
	$query = "SELECT mediaID, title, description, rating FROM Media ORDER BY title DESC";
	
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
	$query = "SELECT mediaID, title, description, rating FROM Media ORDER BY releaseYear DESC";
	
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
	$query = "SELECT mediaID, title, description, rating FROM Media ORDER BY releaseYear ASC";
	
    // 1. prepare
    // 2. bindValue & execute
	$statement = $db->prepare($query);
	$statement->execute();

	$results = $statement->fetchAll();   

	$statement->closeCursor();

	return $results;	
}

// function filterMedia($where, $vals) {
// 	global $db;
// 	$query = "SELECT mediaID, title, description, rating FROM Media ";

// 	if (strpos($where, "genre=:genre")) {
// 		$query .= "NATURAL JOIN Media_Genre ";
// 	}

// 	$query .= "WHERE " . $where;
// 	echo $query;
// 	echo print_r($vals);
// 	$statement = $db->prepare($query); 
// 	foreach ($vals as $key => $value) {
// 		$statement->bindValue($key, $value);
// 		echo $key;
// 		echo $value;
// 	}
// 	$statement->execute();
// 	$results = $statement->fetchAll();
// 	$statement->closeCursor();

// 	return $results;
// }

# filtering by year
function getMedia_year($releaseYear)
{
	global $db;
	$query = "select mediaID, title, description, rating from Media where releaseYear=:releaseYear";
	$statement = $db->prepare($query); 
	$statement->bindValue(':releaseYear', $releaseYear);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}

# filtering by genre
function getMedia_genre($genre)
{
	global $db;
	$query = "SELECT mediaID, title, description, rating FROM Media_Genre NATURAL JOIN Media WHERE genre=:genre";
	$statement = $db->prepare($query); 
	$statement->bindValue(':genre', $genre);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}

# filtering by movie length
function getMedia_movieLen($time2)
{
	global $db;
	$time1 = $time2-60; 
	$query = "SELECT mediaID, title, description, rating FROM Movie NATURAL JOIN Media WHERE length BETWEEN :time1 and :time2";
	$statement = $db->prepare($query); 
	$statement->bindValue(':time1', $time1);
    $statement->bindValue(':time2', $time2);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}

# filtering by show/season length
function getMedia_showLen($numSeasons)
{
	global $db;
	$query = "select mediaID, title, description, rating from Shows NATURAL JOIN Media where seasons=:numSeasons";
	$statement = $db->prepare($query); 
	$statement->bindValue(':numSeasons', $numSeasons);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}

# filtering by rating
function getMedia_rating($rating)
{
	global $db;
	if ($rating==="") {
		return getAllMedia();
	}

	$query = "select mediaID, title, description, rating from Media where rating>=:rating";
	$statement = $db->prepare($query); 
	$statement->bindValue(':rating', $rating);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}

# filtering by rating
function getMedia_platform($platform)
{
	global $db;
	if ($platform==="") {
		return getAllMedia();
	}

	$query = "select mediaID, title, description, rating from Media NATURAL JOIN Media_Platform WHERE platform=:platform";
	$statement = $db->prepare($query); 
	$statement->bindValue(':platform', $platform);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}

//get specific media item
function getMediaItem($mediaID)
{
	global $db;

	$query = "select * from Media  WHERE mediaID=:mediaID";
	$statement = $db->prepare($query); 
	$statement->bindValue(':mediaID', $mediaID);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	return $results;
}


?>

