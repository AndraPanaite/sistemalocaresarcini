

<?php


$serverName = "DESKTOP-D3PC9M1\SQLEXPRESS"; 
$connectionInfo = array( "Database"=>"Proiect");
$conn = sqlsrv_connect( $serverName, $connectionInfo);


session_start();
if(!isset($_SESSION['user'])) {header('Location: index.php');die('Redirected');}



