<?php
require("connect-db.php");
require("account_db.php");
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Import Data</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
        <link rel="stylesheet" href="./styles/index.css" />
    </head>

    <?php
        if (isset($err)) {
            echo $err;
        }
    ?>

    <body style="background-color: #0F1C48">
        <?php
        include("navBar.php");
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-10 text-white" style="background-color: #091436">
                    <!-- Page title -->
                    <div class="my-5">
                        <h3>Import Data</h3>
                        <hr>
                    </div>

                    <div class="row mb-5 gx-5">
                        <!-- account detail -->
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Upload File</h4>
                                    <!-- left column -->
                                    <div class="col-md-6">
                                        <h6 class="mb-0">
                                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                              Select CSV to upload with additional data:
                                              <input type="file" name="fileToUpload" id="fileToUpload">
                                              <br><br>
                                              <input type="submit" value="Upload file" name="submit">
                                            </form>
                                        </h6>
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>       
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>