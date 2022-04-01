<?php
  include("connect-db.php");
  include("media_db.php");

  global $db;

  $mediaList = getAllMedia();
  $years = getYears();
  $genres = getGenres();
  $seasons = getSeasons();

  if(isset($_POST["yearReleased"])) {
    // echo $_POST["yearReleased"];
    $mediaList = getMedia_year($_POST["yearReleased"]);
  } else if (isset($_POST["genre"])) {
    echo $_POST["genre"];
    $mediaList = getMedia_genre($_POST["genre"]);
  } else if (isset($_POST["rating"])) {
    $mediaList = getMedia_rating($_POST["rating"]);
  } else if (isset($_POST["platform"])) {
    $mediaList = getMedia_platform($_POST["platform"]);
  } else if (isset($_POST["showLength"])) {
    $mediaList = getMedia_showLen($_POST["showLength"]);
  } else if (isset($_POST["movieLength"])) {
    $mediaList = getMedia_movieLen($_POST["movieLength"]);
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
    .container-lg {
      background-color: white;
    }

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
  <div class="container-lg">
    <br>
    <div class="row">
        <div class="col">
          <h2>Browse</h2>
        </div>
        <div class="col-6"></div>
        <div class="col">
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

    <hr id="divider"class="bg-danger border-2 border-top">

    <div class="row">
          <div class="col">
              <form method="POST">
                <select class="form-select" id="yearReleased" name="yearReleased" onchange="this.form.submit()">
                  <option selected>Year Released</option>
                  <?php foreach ($years as $year): ?>
                    <option value="<?php echo $year["releaseYear"]; ?>"><?php echo $year["releaseYear"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
          </div>

          <div class="col">
              <form method="post">
                <select class="form-select" aria-label="genre" name="genre" onchange="this.form.submit()"> 
                  <option selected>Genre</option>
                  <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre["genre"]; ?>"><?php echo $genre["genre"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
          </div>

          <div class="col">
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

          <div class="col">
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

          <div class="col">
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

          <div class="col">
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
    </div> 
    <table style="width:100%">
      <thead>
          <tr style="background-color:#B0B0B0">
              <th width="15%">Title</th>   
              <!-- <th width="35%">Description</th>        
              <th width="5%">Rating</th> 
              <th width="5%">Watchlist</th>  -->
          </tr>
      </thead>
      <tbody>
        <?php foreach ($mediaList as $media): ?>
          <tr>
              <td> <?php echo $media["title"]; ?> </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table> 
  </div>    
   

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>