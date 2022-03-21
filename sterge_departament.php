<?php
include 'includes/conexiune.php';

if(!isset($_GET['id'])) echo "<script> window.location.replace('index.php') </script>";
    
     
$sql="DELETE FROM Departamente WHERE [ID Departament]=".$_GET['id'];
     

    
    $stmt = sqlsrv_query( $conn, $sql);

     
 if ($stmt  != false) 
 {  echo "<script> window.location.replace('Home.php') </script>";
    echo "Record updated successfully";
    
         
 }
 else
 {
    echo "There was a problem deleting this!";
     
 }
   
  
    
    

?>