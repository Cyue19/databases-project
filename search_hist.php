<?php
    require("connect-db.php");
    session_start();

    $query = "CALL getSearchHistory('" . $_SESSION['user'] . "')";
    $statement = $db->prepare($query);
    $results = $statement->execute();
    $results = $statement->fetchAll();
?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>My Profile</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body style="background-color: #0F1C48">
    <?php
        include("navBar.php");
    ?>

<div class="container">
<div class="row justify-content-md-center">
	<div class="col-10 text-white" style="background-color: #091436">
		<!-- Page title -->
		<div class="my-5">
			<h3>Search History</h3>
			<hr>
		</div>
        <table class="table table-striped table-dark">
            <tbody>
                <?php foreach ($results as $search): ?>
                    <tr>
                        <td class="col-10"><h4><?php echo $search["searchQuery"]; ?><h5></td>
                        <td><h5><?php echo $search["searchTime"]; ?><h5></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($results)) {
                    echo "<div style='color: white'> No searches yet </div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>