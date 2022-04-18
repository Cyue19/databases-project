<?php
require("connect-db.php");
require("account_db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["btnAction"]) && $_POST["btnAction"]=="Create") {
        //add user
        $result = addUser($_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"], $_POST["birthDate"], $_POST["gender"]);
        if (isset($result)) {
            if ($result) {
                header('Location: ./index.php');
            } else {
                $err = "Could not create account";
            }
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

    <?php
        if (isset($err)) {
            echo $err;
        }
    ?>

    <body style="background-color: #0F1C48">
        <div class="container pt-3">
            <div class="mt-5 px-5 pb-5 pt-3 registerCard">
                <h1 class="mb-3" style="text-align: center">Create Account</h1>
                <p style="text-align: center">Need an admin account? Make one <a style="color: #BD00FF" href="admin_register.php">here</a></p>                <form action="register.php" method="POST">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName"/>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="birthDate" class="form-label">Birth date</label>
                            <input type="date" class="form-control" id="birthDate" name="birthDate"/>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"/>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class=" col-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"/>
                        </div>
                    </div>

                    <div class="mt-4 mb-5 text-center">
                        <input type="submit" value="Create" name="btnAction" class="btn registerBtn" title="create new user" />                
                    </div>
                </form>
            </div>     
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>