<?php
  include("connect-db.php");
  include("media_db.php");

  global $db;

  session_start();

  function searchMediaByTitle($titleQuery) {
    global $db;
	$query = "SELECT * from Media where title LIKE :title";
	
	$statement = $db->prepare($query);

    $pattern = "%".$titleQuery."%";
    $statement->bindValue(':title', $pattern);
	$statement->execute();

	// fetchAll() returns an array of all rows in the result set
	$results = $statement->fetchAll();   
	$statement->closeCursor();

    logSearch($titleQuery);

	return $results;
  }

  function logSearch($searchQuery) {
    global $db;
    
    $query = "INSERT INTO Searches VALUES (:username, :searchQuery, NOW())";

    $statement = $db->prepare($query);

    $statement->bindValue(":username", $_SESSION["user"]);
    $statement->bindValue(":searchQuery", $searchQuery);

    $result = $statement->execute();
    
    $statement->closeCursor();
  }

  $searchResults = searchMediaByTitle($_POST["titleQuery"]);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>Browse Catalog</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <style>
    h2 {
      color: white;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
</head>
<body style="background-color: white">
  <?php
    // session_start();
    include("navBar.php");
  ?>
  <div class="container-lg">
    <br>
    <div class="row">
        <div class="col">
          <h2>Browse</h2>
        </div>
        <div class="col-6"></div>
    </div> 

    <hr id="divider"class="bg-danger border-2 border-top">

    <div class="row">

    </div> 

    <table style="width:100%">
      <thead>
          <tr style="background-color:#B0B0B0">
              <th width="10%">Title</th>   
              <th width="35%">Description</th>        
              <th width="5%">Rating</th> 
          </tr>
      </thead>
      <tbody>
        <?php foreach ($searchResults as $media): ?>
          <tr>
              <td> <a href="media_page.php?id=<?php echo $media['mediaID'] ?>" > <?php echo $media["title"]; ?> </a> </td>
              <td> <?php echo $media["description"]; ?> </td>
              <td> <?php echo $media["rating"]; ?> </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table> 
  </div>    
   

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>