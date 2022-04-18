<?php
require("connect-db.php");
require("account_db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["btnAction"]) && $_POST["btnAction"]=="sign in") {
        //log in to website
        $res = login($_POST["username"], $_POST["password"]);
        if ($res) {
            header('Location: ./index.php');
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="CS4640">
        <meta name="description" content="CS4640 Trivia Login Page">  

        <title>Account Login</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
        <link rel="stylesheet" href="./styles/index.css" />
    </head>

    <body style="background-color: #0F1C48">
        <div class="container py-5">
            <div class="my-5 px-5 pb-5 pt-3 registerCard text-center" style="width: 35%">
                <h1 class="mt-5 mb-3" style="font-size: 30px; text-align: center">Welcome to Streaming Database</h1>
                <p class="m-3">Please log in to continue</p>

                <div class="col-7 m-auto">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input placeholder="username" type="text" class="form-control" id="username" name="username"/>
                        </div>
                        <div class="mb-3">
                            <input placeholder="password" type="password" class="form-control" id="password" name="password"/>
                        </div>

                        <div class="mt-4 mb-5 text-center">                
                            <input type="submit" value="sign in" name="btnAction" style="width: 100%" class="btn registerBtn" title="sign in to account" />   
                        </div>
                    </form>
                </div>

                <p>Don't have an account? Make one <a style="color: #BD00FF" href="register.php">here</a></p>
            </div>     
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>