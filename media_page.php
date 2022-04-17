<?php
  include("connect-db.php");
  include("media_db.php");

  global $db;
  session_start();

  $media = getMediaItem($_GET['id']);

  function saveToList($type, $listID) {
      global $db;
      echo "here";

      $query = "INSERT INTO WatchList VALUES (:username, :listID, :mediaID, :type, :posIndex);";

      $statement = $db->prepare($query);
      $statement->bindValue(":username", $_SESSION["user"]);
      $statement->bindValue(":listID", $listID);
      $statement->bindValue(":mediaID", $_GET['id']);
      $statement->bindValue(":type", $type);
      $statement->bindValue(":posIndex", NULL);

      $result = $statement->execute();
      
      $statement->closeCursor();
  }

  function findTypeAndLength($mediaID) {
    global $db;

	$query = "SELECT * FROM Movie NATURAL JOIN Media WHERE mediaID=:mediaID";

	$statement = $db->prepare($query); 
	$statement->bindValue(':mediaID', $mediaID);
	$statement->execute();
	$results = $statement->fetch();

	$statement->closeCursor();

	if (empty($results)) {
        $query = "SELECT * FROM Shows NATURAL JOIN Media WHERE mediaID=:mediaID";

        $statement = $db->prepare($query); 
        $statement->bindValue(':mediaID', $mediaID);
        $statement->execute();
        $results = $statement->fetch();
    
        $statement->closeCursor();
        if (empty($results)) {
            return "N/A";
        } else {
            if ($results['seasons']===1) {
                return $results['seasons'] . " season";
            } else {
                return $results['seasons'] . " seasons";
            }
        }
    } else {
        return $results['length'] . " minutes";
    }
  }

  function getMediaPlatform($mediaID) {
    global $db;

	$query = "SELECT * FROM Media_Platform NATURAL JOIN Media WHERE mediaID=:mediaID";

	$statement = $db->prepare($query); 
	$statement->bindValue(':mediaID', $mediaID);
	$statement->execute();
	$results = $statement->fetch();

	$statement->closeCursor();

    if (empty($results)) {
        return "N/A";
    } else {
        return $results['platform'];
    }
  }

  $platform = getMediaPlatform($media[0]['mediaID']);
  $length = findTypeAndLength($media[0]['mediaID']);
  $type = "";
  if ($length==="N/A") {
    $type = "N/A";
  } else if (strpos($length, "minute")) {
      $type = "Movie";
  } else if (strpos($length, "season")) {
      $type = "Show";
  }

  if (isset($_GET['save']) && $_GET['save']==="watch_again") {
    saveToList($_GET['save'], 1);
    $loc = "./media_page.php?id=".$_GET['id']; 
    header('Location: '.$loc);
  } else if (isset($_GET['save']) && $_GET['save']==="wishlist") {
    saveToList($_GET['save'], 2);
    $loc = "./media_page.php?id=".$_GET['id']; 
    header('Location: '.$loc);
  } else if (isset($_GET['save']) && $_GET['save']==="watching") {
    saveToList($_GET['save'], 3);
    $loc = "./media_page.php?id=".$_GET['id']; 
    header('Location: '.$loc);
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  

  <title>Media Description</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>
<body style="background-color: white">
  <?php
    // session_start();
    include("navBar.php");
  ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <?php if (isset($_SESSION["user"])) {
        $endpoint = "media_page.php?id=" . $media[0]['mediaID'];
        $endpoint .= "&save=watch_again";
        echo "    <a class='btn btn-primary' href='$endpoint' >Watch Again</a>";
    }
    ?>

    <?php if (isset($_SESSION["user"])) {
        $endpoint = "media_page.php?id=" . $media[0]['mediaID'];
        $endpoint .= "&save=wishlist";
        echo "    <a class='btn btn-primary' href='$endpoint' >Wishlist</a>";
    }
    ?>

    <?php if (isset($_SESSION["user"])) {
        $endpoint = "media_page.php?id=" . $media[0]['mediaID'];
        $endpoint .= "&save=watching";
        echo "    <a class='btn btn-primary' href='$endpoint' >Watching</a>";
    }
    ?>

<div class="container">
<div class="row justify-content-md-center">
	<div class="col-10 text-white" style="background-color: #091436">
		<!-- Page title -->
		<div class="my-5">
			<h3><?php echo $media[0]["title"] ?></h3>
			<hr>
		</div>  
    <div class="row mb-5 gx-5">
				<!-- media detail -->
				<div class="col-xxl-8 mb-5 mb-xxl-0">
					<div class="bg-secondary-soft rounded">
						<div class="row g-3">
							<h4 class="mb-4 mt-0">Type: <?php echo $type ?> </h4>
							<h4 class="mb-4 mt-0">Rating: <?php echo $media[0]["rating"] ?> </h4>
							<h4 class="mb-4 mt-0">Duration: <?php echo $length ?> </h4>
							<h4 class="mb-4 mt-0">Release Year: <?php echo $media[0]["releaseYear"] ?></h4>
							<h4 class="mb-4 mt-0">Available on: <?php echo $platform ?> </h4>
            </div>
          </div>
        </div>
      </div>
		<!-- ratings -->
    <div class="my-5">
			<h3>REVIEWS</h3>
			<hr>
		</div>  
    <div class="row">
    <div class="col-xxl-8 mb-5 mb-xxl-0">
					<div class="bg-secondary-soft rounded">
						<div class="row g-3">
							<h4 class="mb-4 mt-0">Average User Rating: </h4>
              <h4 class="mb-4 mt-0 bold padding-bottom-7">4.3 <small>/ 5</small></h4>
              <hr>
              <h4 class="mb-4 mt-0">Write a Review: </h4>
          <form>
            <!-- Rating input -->
            <div class="form-outline mb-4">
            <label class="form-label" for="form4Example1">Rating</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>-</option>
              <option value="1">1</option>
              <option value="1">1.5</option>
              <option value="2">2</option>
              <option value="1">2.5</option>
              <option value="3">3</option>
              <option value="1">3.5</option>
              <option value="1">4</option>
              <option value="1">4.5</option>
              <option value="1">5</option>
            </select>
            </div>
            <!-- Message input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form4Example3">Description</label>
              <textarea class="form-control" id="form4Example3" rows="4"></textarea>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-secondary btn-block mb-4">Submit</button>
          </form><hr>
          <!-- user reviews -->
          <h4 class="mb-4 mt-0">Reviews: </h4>
          <div class="review p-4">
              <div class="row d-flex">
                  <div class="d-flex flex-column pl-2">
                      <h4>John Smith (4/5) </h4>
                      <p class="grey-text">4/17/2022</p>
                  </div>
              </div>
              <div class="row pb-3">
                      <h6 class="mb-0 pl-3">blah blah blah yay this was so good  </h6>
                  </div>
              </div>
          </div>
		  </div>
   

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>