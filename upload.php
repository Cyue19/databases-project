<?php
include("connect-db.php");
echo $_FILES["fileToUpload"]["name"];
$filename = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$fileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  if($fileType != "csv") {
    echo "Sorry, only CSV files are allowed.";
    $uploadOk = 0;
  }

  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    global $db;
    $file = fopen($filename, "r");
    while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
      // put sql commands and stuff here

              //insert sql statement
              $query = "INSERT INTO Media (mediaID, title, director, country, description, rating, releaseYear) 
              values (:mediaID, :title, :director, :country, :description, :rating, :releaseYear)";
    
              //prepare, bind, and execute sql query
              $statement = $db->prepare($query);
      
              $statement->bindValue(":mediaID", $getData[0]);
              $statement->bindValue(":title", $getData[1]);
              $statement->bindValue(":director", $getData[2]);
              $statement->bindValue(":country", $getData[3]);
              $statement->bindValue(":description", $getData[4]);
              $statement->bindValue(":rating", 0);
              $statement->bindValue(":releaseYear", $getData[5]);
          
              $result = $statement->execute();
              
              //release the hold
              $statement->closeCursor();

      echo $result;
      if(!isset($result)) {
        echo "<script type=\"text/javascript\">
            alert(\"Invalid File:Please Upload CSV File.\");\
            window.location = \"index.php\"
            </script>";    
      }
      else {
          echo "<script type=\"text/javascript\">
          alert(\"CSV File has been successfully Imported.\");
          window.location = \"index.php\"
        </script>";
      }
    }
    fclose($file);  
  }
}
?>