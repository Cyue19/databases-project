<?php
  include("connect-db.php");
  include("media_db.php");

  global $db;

  $mediaList = getAllMedia();
  $years = getYears();
  $genres = getGenres();
  $seasons = getSeasons();
  session_start();

  if(isset($_POST["yearReleased"])) {
    // echo $_POST["yearReleased"];
    $mediaList = getMedia_year($_POST["yearReleased"]);
    // if ($where==="") {
    //   $where .= "releaseYear=:releaseYear ";
    // } else {
    //   $where .= "AND releaseYear=:releaseYear ";
    // }
    // $vals["releaseYear"] = $_POST["yearReleased"];
  } else if (isset($_POST["genre"])) {
    $mediaList = getMedia_genre($_POST["genre"]);
    // if ($where==="") {
    //   $where .= "genre=:genre ";
    // } else {
    //   $where .= "AND genre=:genre ";
    // }
    // $vals["genre"] = $_POST["genre"];
  } else if (isset($_POST["rating"])) {
    $mediaList = getMedia_rating($_POST["rating"]);
    // if ($where==="") {
    //   $where .= "rating=:rating ";
    // } else {
    //   $where .= "AND rating=:rating ";
    // }
    // $vals["rating"] = $_POST["rating"];
  } else if (isset($_POST["platform"])) {
    $mediaList = getMedia_platform($_POST["platform"]);
    // if ($where==="") {
    //   $where .= "platform=:platform ";
    // } else {
    //   $where .= "AND platform=:platform ";
    // }
    // $vals["genre"] = $_POST["genre"];
  } else if (isset($_POST["showLength"])) {
    $mediaList = getMedia_showLen($_POST["showLength"]);
    // if ($where==="") {
    //   $where .= "genre=:genre ";
    // } else {
    //   $where .= "AND genre=:genre ";
    // }
    // $vals["genre"] = $_POST["genre"];
  } else if (isset($_POST["movieLength"])) {
    $mediaList = getMedia_movieLen($_POST["movieLength"]);
    // if ($where==="") {
    //   $where .= "genre=:genre ";
    // } else {
    //   $where .= "AND genre=:genre ";
    // }
    // $vals["genre"] = $_POST["genre"];
  } else if (isset($_POST["sort"])) {
    if ($_POST["sort"] === "abc asc") {
      $mediaList = getMedia_AtoZ();
    } else if ($_POST["sort"] === "abc desc") {
      $mediaList = getMedia_ZtoA();
    } else if ($_POST["sort"] === "date asc") {
      $mediaList = getMedia_earlyDate();
    } else if ($_POST["sort"] === "date desc") {
      $mediaList = getMedia_lateDate();
    }
  }

  // if ($where !== "") {
  //   $where .= ";";
  //   $mediaList = filterMedia($where, $vals);
  //   echo $where;
  // }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>Browse SSDB</title>
  
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
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row justify-content-md-center">
	<div class="col-10 text-white" style="background-color: #091436">
		<!-- Page title -->
		<div class="my-5">
			<h3>Browse</h3>
			<hr>
      <a href="import.php" class="btn btn-primary"> Import</a><hr>
      <div class="col-2 text-right">
      <form method="post">
          <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
              <option selected>Sort By</option>
              <option value="abc asc">Alphabetical (Ascending)</option>
              <option value="abc desc">Alphabetical (Descending)</option>
              <option value="date desc">By Release Date (Most Recent)</option>
              <option value="date asc">By Release Date (Least Recent)</option>
          </select>
        </form>
      </div>
    </div>

    <div class="row mb-5 gx-5">
				<!-- media detail -->
				<div class="col-12 mb-5 mb-xxl-0">
					<div class="bg-secondary-soft rounded">
						<div class="row g-3">
              <div class="col-2">
              <form method="POST">
                <select class="form-select" id="yearReleased" name="yearReleased" onchange="this.form.submit()">
                  <option selected>Year Released</option>
                  <?php foreach ($years as $year): ?>
                    <option value="<?php echo $year["releaseYear"]; ?>"><?php echo $year["releaseYear"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
              </div>

              <div class="col-2">
              <form method="post">
                <select class="form-select" aria-label="genre" name="genre" onchange="this.form.submit()"> 
                  <option selected>Genre</option>
                  <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre["genre"]; ?>"><?php echo $genre["genre"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
              </div>

              <div class="col-2">
              <form method="POST">
                <select class="form-select" aria-label="rating" name="rating" onchange="this.form.submit()">
                  <option value="" selected>Rating</option>
                  <option value=1>1.0 and Up</option>
                  <option value=2>2.0 and Up</option>
                  <option value=3>3.0 and Up</option>
                  <option value=4>4.0 and Up</option>
                  <option value=5>5.0</option>
                </select>
              </form>
              </div>

              <div class="col-2">
              <form method="POST">
                <select class="form-select" aria-label="platform" name="platform" onchange="this.form.submit()">
                  <option selected>Streaming Service</option>
                  <option value="amazon">Amazon Prime Video</option>
                  <option value="netflix">Netflix</option>
                  <option value="hulu">Hulu</option>
                  <option value="disney">Disney Plus</option>
                </select>
              </form>
              </div>
            
              <div class="col-2">
              <form method="POST">
                <select class="form-select" aria-label="showLength" name="showLength" onchange="this.form.submit()">
                  <option selected>Show Length</option>
                  <?php foreach ($seasons as $season): ?>
                    <option value=<?php echo $season["seasons"]; ?>>
                      <?php echo $season["seasons"]; ?> 
                      <?php if($season["seasons"]==1) {
                        echo "Season";
                      } else {
                        echo "Seasons";
                      }
                      ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </form>
              </div>

              <div class="col-2">
              <form method="POST">
                <select class="form-select" aria-label="movieLength" name="movieLength" onchange="this.form.submit()">
                  <option selected>Movie Length</option>
                  <option value=60>Less than 1 hour</option>
                  <option value=120>1 - 2 hours</option>
                  <option value=180>2 - 3 hours</option>
                  <option value=240>3 - 4 hours</option>
                </select>
              </form>
              </div>

              <table class="table table-striped table-dark">
                <thead>
                    <tr style="text-black background-color: white">
                        <th width="10%">Title</th>   
                        <th width="35%">Description</th>        
                        <th width="5%">Rating</th> 
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($mediaList as $media): ?>
                    <tr>
                        <td> <a href="media_page.php?id=<?php echo $media['mediaID'] ?>" > <?php echo $media["title"]; ?> </a> </td>
                        <td> <?php echo $media["description"]; ?> </td>
                        <td> <?php echo $media["rating"]; ?> </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>  
          </div>
        </div>
      </div>  
   

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>