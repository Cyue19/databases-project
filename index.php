<?php
  include("media_db.php");
  global $db;
  /*
  if(isset($_POST['sort'])) {
    switch($_POST['sort']) {
      case '1':
        $list_of_media = getMedia_AtoZ();
        break;
      case '2':
        $list_of_media = getMedia_ZtoA();
        break;
      case '3':
        $list_of_media = getMedia_lateDate();
        break;
      case '4':
        $list_of_media = getMedia_earlyDate();
        break;
      default:
        #$query = "select title, description, rating from media";
        #$statement = $db->prepare($query);
        #$statement->execute();
        #$results = $statement->get_result();   
        #$list_of_media = $results->fetch_all(MYSQLI_ASSOC);
        $list_of_media = [];
        array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
        break;
    }
  }

  if(isset($_POST['yearReleased'])) {
    switch($_POST['yearReleased']) {
      case '1':
        $list_of_media = getMedia_year("2022");
        break;
      case '2':
        $list_of_media = getMedia_year("2021");
        break;
      case '3':
        $list_of_media = getMedia_year("2020");
        break;
      case '4':
        $list_of_media = getMedia_year("2019");
        break;
      case '5':
        $list_of_media = getMedia_year("2018");
        break;
      case '6':
        $list_of_media = getMedia_year("2017");
        break;
      case '7':
        $list_of_media = getMedia_year("2016");
        break;
      case '8':
        $list_of_media = getMedia_year("2015");
        break;
      case '9':
        $list_of_media = getMedia_year("2014");
        break;
      default:
        #$query = "select title, description, rating from media";
        #$statement = $db->prepare($query);
        #$statement->execute();
        #$results = $statement->get_result();   
        #$list_of_media = $results->fetch_all(MYSQLI_ASSOC);
        $list_of_media = [];
        array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
        break;
    }
  }

  if(isset($_POST['genre'])) {
    switch($_POST['genre']) {
      case '0':
        $list_of_media = getMedia_genre("TV Shows");
        break;
      case '1':
        $list_of_media = getMedia_genre("Comedy");
        break;
      case '2':
        $list_of_media = getMedia_genre("Drama");
        break;
      case '3':
        $list_of_media = getMedia_genre("International");
        break;
      case '4':
        $list_of_media = getMedia_genre("Action");
        break;
      case '5':
        $list_of_media = getMedia_genre("Suspense");
        break;
      case '6':
        $list_of_media = getMedia_genre("Fantasy");
        break;
      case '7':
        $list_of_media = getMedia_genre("Kids");
        break;
      case '8':
        $list_of_media = getMedia_genre("Science Fiction");
        break;
      case '9':
        $list_of_media = getMedia_genre("Adventure");
        break;
      case '10':
        $list_of_media = getMedia_genre("Horror");
        break;
      case '11':
        $list_of_media = getMedia_genre("Documentary");
        break;
      case '12':
        $list_of_media = getMedia_genre("Sports");
        break;
      case '13':
        $list_of_media = getMedia_genre("Talk Show and Variety");
        break;
      case '14':
        $list_of_media = getMedia_genre("Special Interest");
        break;
      case '15':
        $list_of_media = getMedia_genre("Anime");
        break;
      case '16':
        $list_of_media = getMedia_genre("Animation");
        break;
      case '19':
        $list_of_media = getMedia_genre("Music Videos and Concert");
        break;
      case '20':
        $list_of_media = getMedia_genre("Fitness");
        break;
      case '21':
        $list_of_media = getMedia_genre("Faith and Spirituality");
        break;
      case '22':
        $list_of_media = getMedia_genre("Military and War");
        break;
      case '23':
        $list_of_media = getMedia_genre("Western");
        break;
      case '24':
        $list_of_media = getMedia_genre("Arts");
        break;
      case '25':
        $list_of_media = getMedia_genre("LGTBQ");
        break;
      case '26':
        $list_of_media = getMedia_genre("Romance");
        break;
      case '27':
        $list_of_media = getMedia_genre("Unscripted");
        break;
      case '28':
        $list_of_media = getMedia_genre("and Culture");
        break;
      case '29':
        $list_of_media = getMedia_genre("Entertainment");
        break;
      case '30':
        $list_of_media = getMedia_genre("Young Adult Audience");
        break;
      default:
        #$query = "select title, description, rating from media";
        #$statement = $db->prepare($query);
        #$statement->execute();
        #$results = $statement->get_result();   
        #$list_of_media = $results->fetch_all(MYSQLI_ASSOC);
        $list_of_media = [];
        array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
        break;
    }  
  }

  if(isset($_POST['rating'])) {
    switch($_POST['rating']) {
      case '1':
        $list_of_media = getMedia_rating("1");
        break;
      case '2':
        $list_of_media = getMedia_rating("2");
        break;
      case '3':
        $list_of_media = getMedia_rating("3");
        break;
      case '4':
        $list_of_media = getMedia_rating("4");
        break;
      case '5':
        $list_of_media = getMedia_rating("5");
        break;
      default:
        #$query = "select title, description, rating from media";
        #$statement = $db->prepare($query);
        #$statement->execute();
        #$results = $statement->get_result();   
        #$list_of_media = $results->fetch_all(MYSQLI_ASSOC);
        $list_of_media = [];
        array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
        break;
    }
  }

  if(isset($_POST['showLength'])) {
    switch($_POST['showLength']) {
      case '1':
        $list_of_media = getMedia_showLen("1");
        break;
      case '2':
        $list_of_media = getMedia_showLen("2");
        break;
      case '3':
        $list_of_media = getMedia_showLen("3");
        break;
      case '4':
        $list_of_media = getMedia_showLen("4");
        break;
      case '5':
        $list_of_media = getMedia_showLen("5");
        break;
      case '6':
        $list_of_media = getMedia_showLen("6");
        break;
      default:
        #$query = "select title, description, rating from media";
        #$statement = $db->prepare($query);
        #$statement->execute();
        #$results = $statement->get_result();   
        #$list_of_media = $results->fetch_all(MYSQLI_ASSOC);
        $list_of_media = [];
        array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
        break;
    }
  }

  if(isset($_POST['movieLength'])) {
    switch($_POST['movieLength']) {
      case '1':
        $list_of_media = getMedia_movLen("0","60");
        break;
      case '2':
        $list_of_media = getMedia_movLen("60","120");
        break;
      case '3':
        $list_of_media = getMedia_movLen("120","180");
        break;
      case '4':
        $list_of_media = getMedia_movLen("180","240");
        break;
      default:
        #$query = "select title, description, rating from media";
        #$statement = $db->prepare($query);
        #$statement->execute();
        #$results = $statement->get_result();   
        #$list_of_media = $results->fetch_all(MYSQLI_ASSOC);
        $list_of_media = [];
        array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
        break;
    }
  }
  */
  $list_of_media = [];
  array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));
  array_push($list_of_media, array("title" => "title", "description" => "description", "rating" => "5.0"));

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
      background-color: midnightblue;
    }

    h2 {
      color: white;
    }

    table td {
      color: white;
    }
  </style>
</head>
<body style="background-color: darkslateblue">
  <?php
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
          <form action="index.php" method="post">
            <select class="form-select" id="sort">
                <option selected>Sort By</option>
                <option value="1">Alphabetical (Ascending)</option>
                <option value="2">Alphabetical (Descending)</option>
                <option value="3">By Release Date (Most Recent)</option>
                <option value="4">By Release Date (Least Recent)</option>
            </select>
            <br>
            <input type="submit" id="applySort" value="Apply Sort" />
          </form>
        </div>
    </div>  
    <hr id="divider"class="bg-danger border-2 border-top">
    <div class="row">
          <div class="col">
              <form action="index.php" method="post">
                <select class="form-select" id="yearReleased">
                  <option selected>Year Release</option>
                  <option value="1">2022</option>
                  <option value="2">2021</option>
                  <option value="3">2020</option>
                  <option value="4">2019</option>
                  <option value="5">2018</option>
                  <option value="6">2017</option>
                  <option value="7">2016</option>
                  <option value="8">2015</option>
                  <option value="9">2014</option>
                </select>
              </form>
              <br>
              <input type="submit" id="applyFilter" value="Apply Filter" />
          </div>
          <div class="col">
              <form action="index.php" method="post">
                <select class="form-select" aria-label="genre">
                  <option selected>Genre</option>
                  <option value="0">TV Shows</option>
                  <option value="1">Comedy</option>
                  <option value="2">Drama</option>
                  <option value="3">International</option>
                  <option value="4">Action</option>
                  <option value="5">Suspense</option>
                  <option value="6">Fantasy</option>
                  <option value="7">Kids</option>
                  <option value="8">Science Fiction</option>
                  <option value="9">Adventure</option>
                  <option value="10">Horror</option>
                  <option value="11">Documentary</option>
                  <option value="12">Sports</option>
                  <option value="13">Talk Show and Variety</option>
                  <option value="14">Special Interest</option>
                  <option value="15">Anime</option>
                  <option value="16">Animation</option>
                  <option value="19">Music Videos and Concert</option>
                  <option value="20">Fitness</option>
                  <option value="21">Faith and Spirituality</option>
                  <option value="22">Military and War</option>
                  <option value="23">Western</option>
                  <option value="24">Arts</option>
                  <option value="25">LGBTQ</option>
                  <option value="26">Romance</option>
                  <option value="27">Unscripted</option>
                  <option value="28">and Culture</option>
                  <option value="29">Entertainment</option>
                  <option value="30">Young Adult Audience</option>
                </select>
              </form>
          </div>
          <div class="col">
            <form action="index.php" method="post">
              <select class="form-select" aria-label="rating">
                <option selected>Rating</option>
                <option value="1">1.0 and Up</option>
                <option value="2">2.0 and Up</option>
                <option value="3.0">3.0 and Up</option>
                <option value="4.0">4.0 and Up</option>
                <option value="5.0">5.0</option>
              </select>
            </form>
          </div>
          <div class="col">
            <form action="index.php" method="post">
              <select class="form-select" aria-label="mediaPlatform">
                <option selected>Streaming Service</option>
                <option value="1">Amazon Prime Video</option>
                <option value="2">Netflix</option>
                <option value="3">Hulu</option>
                <option value="4">Disney Plus</option>
              </select>
            </form>
          </div>
          <div class="col">
            <form action="index.php" method="post">
              <select class="form-select" aria-label="showLength">
                <option selected>Show Length</option>
                <option value="1">1 Season</option>
                <option value="2">2 Seasons</option>
                <option value="3">3 Seasons</option>
                <option value="4">4 Seasons</option>
                <option value="5">5 Seasons</option>
                <option value="6">6 Seasons</option>
              </select>
            </form>
          </div>
          <div class="col">
            <form action="index.php" method="post">
              <select class="form-select" aria-label="movieLength">
                <option selected>Movie Length</option>
                <option value="1">Less than 1 hour</option>
                <option value="2">1 - 2 hours</option>
                <option value="3">2 - 3 hours</option>
                <option value="4">3 - 4 hours</option>
              </select>
            </form>
          </div>
    </div> 
    <br>
    <br>
    <table border="1" class="w3-table w3-bordered w3-card-4" style="width:100%">
      <thead>
          <tr style="background-color:#B0B0B0">
              <th width="15%">Title</th>        
              <th width="35%">Description</th>        
              <th width="5%">Rating</th> 
              <th width="5%">Watchlist</th> 
          </tr>
      </thead>
      <?php foreach ($list_of_media as $media): ?>
      <tr>
          <td><?php echo $media['title']; ?></td>
          <td><?php echo $media['description']; ?></td>
          <td><?php echo $media['rating']; ?></td> 
          <td>
          <form action="index.php" method="post">
              <input type="submit" value="add" name="add" id="add"class="btn btn-danger" />
          </form>
          </td> 
      </tr>
      <?php endforeach; ?>
    </table> 
    <br>
    <br>
    <br>
  </div>    
   

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>