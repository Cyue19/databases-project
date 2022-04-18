<?php
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

      $sql = "INSERT into Media (mediaID, title, director, country, description, 0, releaseYear) 
           values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."', '".$getData[5]."')";
      $result = mysqli_query($db, $sql);
      if(!isset($result)) {
        echo "<script type=\"text/javascript\">
            alert(\"Invalid File:Please Upload CSV File.\");
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