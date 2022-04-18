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
            $_SESSION['auth'] = "user";
        } else {
            return false;
        }
    }

    return $success;
}

function addAdmin($username, $firstName, $lastName, $email, $password, $company, $role) {
    //db handler from connect-db
    global $db;
    echo "here";
    $success = addAccount($username, $firstName, $lastName, $email, $password);

    if ($success) {
        //insert sql statement
        $query = "INSERT INTO Admin VALUES (:username, :company, :role)";

        //prepare, bind, and execute sql query
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":company", $company);
        $statement->bindValue(":role", $role);

        $result = $statement->execute();
        
        //release the hold
        $statement->closeCursor();

        if ($result) {
            return true;
            $_SESSION['auth'] = "admin";
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

function getFirstName() {
    //db handler from connect-db
    global $db;

    //insert sql statement
    $query = "SELECT firstName FROM Account WHERE username=:username";

    //prepare, bind, and execute sql query
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $_SESSION["user"]);

    $statement->execute();
    $results = $statement->fetch();

    //release the hold
    $statement->closeCursor();

    return $results['firstName'];
}

function getLastName() {
    //db handler from connect-db
    global $db;

    //insert sql statement
    $query = "SELECT lastName FROM Account WHERE username=:username";

    //prepare, bind, and execute sql query
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $_SESSION["user"]);

    $statement->execute();
    $results = $statement->fetch();

    $statement->closeCursor();

    return $results['lastName'];
}

function getEmail() {
    //db handler from connect-db
    global $db;

    //insert sql statement
    $query = "SELECT email FROM Account WHERE username=:username";

    //prepare, bind, and execute sql query
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $_SESSION["user"]);

    $statement->execute();
    $results = $statement->fetch();

    $statement->closeCursor();

    return $results['email'];
}

function updateProfile($username, $firstName, $lastName, $email) {
    //db handler from connect-db
    global $db;

    //insert sql statement
    $query = "UPDATE Account SET firstName=:firstName, lastName=:lastName, email=:email WHERE username=:username";

    //prepare, bind, and execute sql query
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $_SESSION["user"]);
    $statement->bindValue(":firstName", $firstName);
    $statement->bindValue(":lastName", $lastName);
    $statement->bindValue(":email", $email);

    $results = $statement->execute();

    //release the hold
    $statement->closeCursor();

    return $results;
}

?>