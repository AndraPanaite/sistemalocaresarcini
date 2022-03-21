<?php
  include('Includes/conexiune.php');

  if ( $_SERVER['REQUEST_METHOD'] == 'POST')
  {
      $sql0= "SELECT Deadline FROM AngajatiComenzi WHERE [ID Comanda]=".$_POST['id_comanda'];
      $stmt0 = sqlsrv_query( $conn, $sql0);
      $row0 = sqlsrv_fetch_array( $stmt0, SQLSRV_FETCH_ASSOC);
      
      $sql1 = "UPDATE AngajatiComenzi SET [ID Angajat] =".$_POST['angajat1'].",[ID Sarcina]=".$_POST['sarcina1']." WHERE [ID Comanda]=".$_POST['id_comanda'];
      $sql2 ="INSERT INTO AngajatiComenzi ([ID Comanda],[ID Angajat],[ID Sarcina],Deadline) VALUES (".$_POST['id_comanda'].",".$_POST['angajat2'].",".$_POST['sarcina2'].",'".$row0['Deadline']->format("Y-m-d")."')";
      $sql3 ="INSERT INTO AngajatiComenzi ([ID Comanda],[ID Angajat],[ID Sarcina],Deadline) VALUES (".$_POST['id_comanda'].",".$_POST['angajat3'].",".$_POST['sarcina3'].",'".$row0['Deadline']->format("Y-m-d")."')";
      
    
      
      $stmt1 = sqlsrv_query( $conn, $sql1);
      $stmt2 = sqlsrv_query( $conn, $sql2);
      $stmt3 = sqlsrv_query( $conn, $sql3);
      
       if( $stmt1 === false || $stmt2 === false || $stmt3 === false )
       echo "<html>
        <head><title>Register</title></head>  
         <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'> 

         <div style='margin-left:45%;margin-top:15%'> <h3><i>Nu s-a putut realiza inregistrarea!</i></b>
         </div>
         </body>
         </html>";
       
    else {   //Inregistrare reusita  
            header('Location: Home.php');
            die("S-a produs o eroare la redirectionare.");
         }
      
  }
  else
  {
  $sql1 = "SELECT [ID Departament],[Tip Serviciu] FROM Comenzi WHERE [ID Comanda] =".$_GET['id'];
  $stmt1 = sqlsrv_query( $conn, $sql1);
  if( $stmt1 === false )
    { 
      echo"<div style='margin-left:42.5%;margin-top:5%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
  else
    {
      $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC);
      $id_departament = $row1['ID Departament'];
      $tip_serviciu = $row1['Tip Serviciu'];
    
   }
  }
?>

<!DOCTYPE html>
    <html>
        <head> <title> Procesare Comanda </title>   
            <style>
                    body {
                                font-family: sans-serif;
                                background: linear-gradient(to right, #ff7070, #84c5fa)
                        }
            </style>    
         </head>
        
         <body> 
        
            <div style='margin-left:40%;position:absolute;top:5%;'>
                <h1> <i>Procesare Comanda</i> </h1> 
            </div>
              
                <form action='proceseaza_comanda.php' method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left:30%;">
                        Angajat 1:
                        <select name='angajat1' required>
                            <option value="" disabled selected>Selecteaza angajat</option>
                            <?php
                                $sql2 = "SELECT [ID Angajat],Nume,Prenume FROM Angajati WHERE [ID Departament]=".$id_departament;
                                $stmt2 = sqlsrv_query( $conn, $sql2);
                                while($row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC))
                                {
                                    echo "<option value='".$row2['ID Angajat']."'>".$row2['Nume']." ".$row2['Prenume']."</option>";
                                }
                            ?>
                        </select>
                        Angajat 2:
                        <select name='angajat2' required>
                            <option value="" disabled selected>Selecteaza angajat</option>
                            <?php
                                $sql2 = "SELECT [ID Angajat],Nume,Prenume FROM Angajati WHERE [ID Departament]=".$id_departament;
                                $stmt2 = sqlsrv_query( $conn, $sql2);
                                while($row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC))
                                {
                                    echo "<option value='".$row2['ID Angajat']."'>".$row2['Nume']." ".$row2['Prenume']."</option>";
                                }
                            ?>
                        </select>
                        Angajat 3:
                        <select name='angajat3' required>
                            <option value="" disabled selected>Selecteaza angajat</option>
                            <?php
                                $sql2 = "SELECT [ID Angajat],Nume,Prenume FROM Angajati WHERE [ID Departament]=".$id_departament;
                                $stmt2 = sqlsrv_query( $conn, $sql2);
                                while($row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC))
                                {
                                    echo "<option value='".$row2['ID Angajat']."'>".$row2['Nume']." ".$row2['Prenume']."</option>";
                                }
                            ?>
                        </select>
                        <br/>
                        <br/>
                        Sarcina 1:
                        <select name='sarcina1' required>
                            <option value="" disabled selected>Selecteaza sarcina</option>
                            <?php
                            
                                $sql3 = "SELECT S.[ID Sarcina],S.Nume FROM Sarcini S INNER JOIN Servicii SER ON S.[ID Serviciu] = SER.[ID Serviciu] WHERE SER.Nume='".$tip_serviciu."'";

                                $stmt3 = sqlsrv_query( $conn, $sql3);
                                while($row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC))
                                {
                                    echo "<option value='".$row3['ID Sarcina']."'>".$row3['Nume']."</option>";
                                }
                                
                            ?>
                        </select>
                        Sarcina 2:
                        <select name='sarcina2' required>
                            <option value="" disabled selected>Selecteaza sarcina</option>
                           <?php
                            
                                $sql3 = "SELECT S.[ID Sarcina],S.Nume FROM Sarcini S INNER JOIN Servicii SER ON S.[ID Serviciu] = SER.[ID Serviciu] WHERE SER.Nume='".$tip_serviciu."'";

                                $stmt3 = sqlsrv_query( $conn, $sql3);
                                while($row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC))
                                {
                                    echo "<option value='".$row3['ID Sarcina']."'>".$row3['Nume']."</option>";
                                }
                                
                            ?>
                        </select>
                        Sarcina 3:
                        <select name='sarcina3' required>
                            <option value="" disabled selected>Selecteaza sarcina</option>
                           <?php
                            
                                $sql3 = "SELECT S.[ID Sarcina],S.Nume FROM Sarcini S INNER JOIN Servicii SER ON S.[ID Serviciu] = SER.[ID Serviciu] WHERE SER.Nume='".$tip_serviciu."'";

                                $stmt3 = sqlsrv_query( $conn, $sql3);
                                while($row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC))
                                {
                                    echo "<option value='".$row3['ID Sarcina']."'>".$row3['Nume']."</option>";
                                }
                                
                            ?>
                        
                        </select>
                        <br/>
                        <input type='hidden' name='id_comanda' value='<?php echo $_GET['id']?>' />
                        <input type='submit' name='inregistreaza' value='INREGISTREAZA' style='width:170px;border: 0;background: none;display: block;margin-top:20px;margin-left:20%;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99;margin-right:90%;'/>
                </form>      
         </body> 
    </html> 



