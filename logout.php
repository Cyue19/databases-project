<?php
require("connect-db.php");
require("account_db.php");
session_start();

logout();
header('Location: http://localhost/cs4750/databases-project/login.php');

?>