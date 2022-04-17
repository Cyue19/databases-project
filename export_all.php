<?php
require("connect-db.php");
global $db;
session_start();
$filename = 'export.csv';

$query = "SELECT mediaID, title, description, rating FROM Media NATURAL JOIN WatchList WHERE username=? AND type=?;";
$type = "watch_again";

$result = $db->prepare($query); 
$result->execute(array($_SESSION['user'], $type));
 
if($result->rowCount() > 0){ 
    $delimiter = ","; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Title', 'Description', 'Rating'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    // $row = $result->fetch(PDO::FETCH_ASSOC);
    while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
        $lineData = array($row['mediaID'], $row['title'], $row['description'], $row['rating']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 