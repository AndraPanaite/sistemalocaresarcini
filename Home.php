<?php
    include('Includes/conexiune.php');
?>

<!DOCTYPE html>
    <html>
    <head> <title> Home </title> 
        
    <style>
        
        
                body {
                            font-family: sans-serif;
                            background: linear-gradient(to right, #ff7070, #84c5fa)
                        }
        
        
    </style>    
        
        
        </head>
        
       <body> 

 <a href='logout.php' style='width:100px;border: 0;background: none;display: block;margin: 20px ;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Logout</a>
           
<?php if($_SESSION['admin'] == 1) echo" 

<a href='adauga_comanda.php' style='width:120px;border: 0;background: none;display: block;margin-left:90%;margin-top: -70px;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Adauga Comanda</a>

<a href='adauga_sarcina.php' style='width:120px;border: 0;background: none;display: block;margin-left:90%;margin-top: 20px;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Adauga Sarcina</a>

<a href='adauga_departament.php' style='width:120px;border: 0;background: none;display: block;margin-left:90%;margin-top: 20px;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:12px;text-decoration:none; background-color:#659c99'>Adauga Departament</a>

<a href='Register.php' style='width:120px;border: 0;background: none;display: block;margin-left:90%;margin-top: 20px;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Adauga Angajat</a>

<a href='adauga_serviciu.php' style='width:120px;border: 0;background: none;display: block;margin-left:90%;margin-top: 20px;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Adauga Serviciu</a>

<a href='statistici.php' style='width:120px;border: 0;background: none;display: block;margin-left:90%;margin-top: 20px;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Statistici</a>

";
        
        ?>
        
    <div style='margin-left:40%;position:absolute;top:2%;'>
     <h1> <i>Bine ai venit <?php echo $_SESSION['prenume']?> !</i> </h1> 
        
     </div>
           
     <!-- tabel departamente -->  
           
     <div>
                <h4 style="font-weight:bold;margin-top:6%;">Departamente</h4>
                <table border="5px solid black;">
                    <tr>
                        <td>Nume</td>
                         <td>Numar Telefon</td>
                    </tr> 
                <?php 

                     $sql = "SELECT [ID Departament],Nume,Nr_Telefon FROM Departamente WHERE Nume != 'Admin'";
                     $stmt = sqlsrv_query($conn, $sql);
                     while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                     {  echo "
                            <tr>
                                <td>".$row['Nume']."</td>
                                <td>".$row['Nr_Telefon']."</td>
                                <td><a href='sterge_departament.php?id=".$row['ID Departament']."'><img src='Images/1.png'></a></td>
                            </tr>
                             ";

                     }
                ?>



                </table>
            </div>       
           
           
    <!-- tabel angajati -->       
           
     <div style='position:absolute;top:65%;right:1%;'>
                <h4 style="font-weight:bold;">Angajati</h4>
                <table border="5px solid black;">
                    <tr>
                        <td>Nume</td>
                         <td>Email</td>
                        <td>Departament</td>
                    </tr> 
                <?php 

                     $sql = "SELECT A.[ID Angajat],A.Nume,A.Prenume,Email,D.Nume AS NumeDepartament FROM Angajati A INNER JOIN Departamente D ON D.[ID Departament]= A.[ID Departament] WHERE EsteAdmin = 0";
                     $stmt = sqlsrv_query($conn, $sql);
                     while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                     {  echo "
                            <tr>
                                <td>".$row['Nume']." ".$row['Prenume']."</td>
                                <td>".$row['Email']."</td>
                                <td>".$row['NumeDepartament']."</td>
                                <td><a href='sterge_angajat.php?id=".$row['ID Angajat']."'><img src='Images/1.png'></a></td>
                            </tr>
                            
                             ";

                     }
                ?>



                </table>
            </div>   
        
                <!-- tabel servicii -->  
           
     <div>
                <h4 style="font-weight:bold;">Servicii</h4>
                <table border="5px solid black;">
                    <tr>
                        <td>Nume Serviciu</td>
                         <td>Departament</td>
                    </tr> 
                <?php 

                     $sql = "SELECT DISTINCT S.[ID Serviciu],S.Nume, D.Nume AS NumeServiciu FROM Servicii S INNER JOIN  Departamente D ON D.[ID Departament] = S.[ID Departament]";
                     $stmt = sqlsrv_query($conn, $sql);
                     while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                     {  echo "
                            <tr>
                                <td>".$row['Nume']."</td>
                                <td>".$row['NumeServiciu']."</td>
                                <td><a href='sterge_serviciu.php?id=".$row['ID Serviciu']."'><img src='Images/1.png'></a></td>
                            </tr>
                             ";

                     }
                ?>



                </table>
            </div>   
           
                           <!-- tabel sarcini -->      
           
     <div>
                <h4 style="font-weight:bold;">Sarcini</h4>
                <table border="5px solid black;">
                    <tr>
                        <td>Nume Sarcina</td>
                        <td>Serviciu</td>
                        <td>Departament</td>
                        <td></td>
                    </tr> 
                <?php 

                     $sql = "SELECT S.[ID Sarcina],S.Nume,SER.Nume as NumeServiciu,D.Nume as NumeDepartament FROM Sarcini S INNER JOIN Servicii SER on S.[ID Serviciu] = SER.[ID Serviciu] INNER JOIN
                     Departamente D ON SER.[ID Departament] = D.[ID Departament]";
                     $stmt = sqlsrv_query($conn, $sql);
                     while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                     {  echo "
                            <tr>
                                <td>".$row['Nume']."</td>
                                <td>".$row['NumeServiciu']."</td>
                                <td>".$row['NumeDepartament']."</td>
                                <td><a href='sterge_sarcina.php?id=".$row['ID Sarcina']."'><img src='Images/1.png'></a></td>
                            </tr>
                             ";

                     }
                ?>



                </table>
            </div>   
           
                                                                    <!-- AFISARE COMENZI -->         
    <!-- tabel angajaticomenzi -->       
     <div style='position:absolute;top:10%;right:15%;'>
                <h4 style="font-weight:bold;">Comenzi</h4>
                <table border="5px solid black;">
                    <tr>
                        <td>Data Comanda</td>
                        <td>Data Finalizare</td>
                        <td>Adresa</td>
                        <td>Tip Serviciu</td>
                        <td>Departament</td>
                        <td>Deadline</td>
                        <td>Angajati</td>
                        
                    </tr> 
                <?php 

                     $sql = "SELECT DISTINCT C.[ID Comanda],C.Data_primire,C.Data_Finalizare,C.Adresa,D.Nume,C.[Tip Serviciu],AC.Deadline FROM Comenzi C INNER JOIN Departamente D ON C.[ID Departament] = D.[ID Departament] INNER JOIN AngajatiComenzi AC ON C.[ID Comanda] = AC.[ID Comanda]";
                     $stmt = sqlsrv_query($conn, $sql);
                     while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
                     {   $sql_intra = "Select A.Nume,A.Prenume FROM AngajatiComenzi AC INNER JOIN Angajati A ON AC.[ID Angajat] = A.[ID Angajat] WHERE AC.[ID Comanda] =".$row['ID Comanda'];
                         $stmt_intra = sqlsrv_query($conn, $sql_intra, array(), array( "Scrollable" => 'static' ));
                
                         echo "
                            <tr>
                                
                                <td><a href='proceseaza_comanda.php?id=".$row['ID Comanda']."'>".$row['Data_primire']->format('d/m/Y')."</a></td>
                                <td>".$row['Data_Finalizare']->format('d/m/Y')."</td>
                                <td>".$row['Adresa']."</td>
                                <td>".$row['Tip Serviciu']."</td>
                                <td>".$row['Nume']."</td>
                                <td>".$row['Deadline']->format('d/m/Y')."</td>
                                <td>";
                                if (sqlsrv_num_rows($stmt_intra) == 0) echo "Comanda nu a fost procesata!";
                                else while($row_intra = sqlsrv_fetch_array( $stmt_intra, SQLSRV_FETCH_ASSOC)) echo $row_intra['Nume']." ".$row_intra['Prenume']."<br/>";
                        
                           echo "</td>
                            </tr>
                             ";

                     }
                ?>



                </table>
            </div>   
           
               <div style='weight:100px; height:20px;margin-top:3%'>
        



        
        
   
    
    </div>
     
     
   
     
     
     </body> </html> 