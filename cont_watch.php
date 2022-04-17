<?php
  include("connect-db.php");
  include("watchlist_db.php");

  global $db;
  session_start();

  $list = getWatchlist("watching");
?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
  <title>Continue Watching</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style="background-color: #0F1C48">
    <?php
        include("navBar.php");
    ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row justify-content-md-center">
	<div class="col-10 text-white" style="background-color: #091436">
        <div class="my-5">
			<h3>Continue Watching</h3>
			<hr>
		</div>

    <?php if (empty($list)) {
        echo "<div style='color: white'> No items saved yet </div>";
      }
      ?>

      <?php foreach ($list as $media): ?>
        <div class="mb-3" > <a style="color: white" href="media_page.php?id=<?php echo $media['mediaID'] ?>" > <?php echo $media["title"]; ?></a></div>
      <?php endforeach; ?>
    </div>
</div>
</div>
</body>
</html>