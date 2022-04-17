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

  echo print_r($_GET);

  if (isset($_GET['save']) && $_GET['save']==="watch_again") {
    saveToList($_GET['save'], 1);
    $loc = "./media_page.php?id=".$_GET['id']; 
    header('Location: '.$loc);
  } else if (isset($_GET['save']) && $_GET['save']==="wishlist") {
    saveToList($_GET['save'], 2);
    $loc = "./media_page.php?id=".$_GET['id']; 
    header('Location: '.$loc);
  }

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
</head>
<body style="background-color: white">
  <?php
    // session_start();
    include("navBar.php");
  ?>

    <?php echo $media[0]["title"] ?>

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
   

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>