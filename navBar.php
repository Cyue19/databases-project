<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: #440E79">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">SSDB</a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="watch_again.php">watch again</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="cont_watch.php">continue watching</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="wishlist.php">wishlist</a>
                    </li>
                </ul>
                
                <form action="./search.php" method="POST">
                	<input name="titleQuery" id="titleQuery" class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
                
                <li>
                    <a href="profile.php">
                        <i class="fas fa-user-circle fa-2x" style="color: white;"></i>
                    </a>
                </li>

                <li class="nav-item">
					<?php 
						if (isset($_SESSION["user"])) {
							echo "<a class='nav-link text-white' href='./logout.php'>log out</a>";
						} else {
							echo "<a class='nav-link text-white' href='./login.php'>log in</a>";
						}
					?>
                </li>

            </div>
        </div>
    </nav>

  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->    
</body>
</html>