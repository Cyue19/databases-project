<?php

function addAccount($username, $firstName, $lastName, $email, $password) {
        //db handler from connect-db
        global $db;
    
        //insert sql statement
        $query = "INSERT INTO Account VALUES (:username, :firstName, :lastName, :email, :password)";
    
        //prepare, bind, and execute sql query
        $statement = $db->prepare($query);
        if (!$statement) {
            echo print_r($db->errorInfo());
        }

        $statement->bindValue(":username", $username);
        $statement->bindValue(":firstName", $firstName);
        $statement->bindValue(":lastName", $lastName);
        $statement->bindValue(":email", $email);
        echo password_hash($password, PASSWORD_DEFAULT);
        $statement->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
    
        $result = $statement->execute();
        
        //release the hold
        $statement->closeCursor();

        if ($result) {
            $_SESSION["user"] = $username;
            return true;
        } else {
            return false;
        }
}

function addUser($username, $firstName, $lastName, $email, $password, $birthDate, $gender) {
    //db handler from connect-db
    global $db;

    $success = addAccount($username, $firstName, $lastName, $email, $password);

    if ($success) {
        //insert sql statement
        $query = "INSERT INTO User VALUES (:username, :birthDate, :gender)";

        //prepare, bind, and execute sql query
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":birthDate", $birthDate);
        $statement->bindValue(":gender", $gender);

        $result = $statement->execute();
        
        //release the hold
        $statement->closeCursor();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    return $success;
}

function login($username, $password) {
    //db handler from connect-db
    global $db;

    //insert sql statement
    $query = "SELECT password FROM Account WHERE username=:username";

    //prepare, bind, and execute sql query
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);

    $statement->execute();
    $result = $statement->fetch()["password"];

    //release the hold
    $statement->closeCursor();

    if (password_verify($password, $result)) {
        $_SESSION["user"] = $username; 
        return true;
    } else {
        return false;
    }
}

function logout() {
    unset($_SESSION["user"]);
    header('Location: http://localhost/cs4750/databases-project/login.php');
}


?>