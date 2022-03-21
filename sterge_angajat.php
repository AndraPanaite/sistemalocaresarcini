<?php
include 'includes/conexiune.php';

if(!isset($_GET['id'])) echo "<script> window.location.replace('index.php') </script>";
    
$sql0 = "UPDATE AngajatiComenzi SET [ID Angajat] = NULL WHERE [ID Angajat]=".$_GET['id'];     
$sql="DELETE FROM Angajati WHERE [ID Angajat]=".$_GET['id'];
     
    $stmt0 = sqlsrv_query( $conn, $sql0);
    $stmt = sqlsrv_query( $conn, $sql);

     
 if ($stmt != false || $stmt0 != false) 
 {  echo "<script> window.location.replace('Home.php') </script>";
    echo "Record updated successfully";
    
         
 }
 else
 {
    echo "There was a problem deleting this!";
 }
   
  


?>