<?php
include 'includes/conexiune.php';

if(!isset($_GET['id'])) echo "<script> window.location.replace('index.php') </script>";
    
     
$sql="DELETE FROM Sarcini WHERE [ID Sarcina]=".$_GET['id'];
     
 
    $stmt = sqlsrv_query( $conn, $sql);

     
 if ($stmt != false ) 
 {  echo "<script> window.location.replace('Home.php') </script>";
    echo "Record updated successfully";
    
         
 }
 else
 {
    echo "There was a problem deleting this!";
     echo $sql;
 }
   

    

?>