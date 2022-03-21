<?php
    include('Includes/conexiune.php');
echo

"<!DOCTYPE html>
    <html>
    <head> <title> Home </title> 
        
    <style>
        
        
                body {
                            font-family: sans-serif;
                            background: linear-gradient(to right, #ff7070, #84c5fa)
                        }
        
        
    </style>    
        
        <title>Statistici</title>
        
        </head>
        
       <body> 
           
           <a href='Home.php' style='width:100px;border: 0;background: none;display: block;margin: 20px ;text-align: center;border: 2px solid #2ecc71; margin-left: 90%;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Inapoi</a>
           
           <h1 style='color:white;font-weight:bold;margin-left:47%'><i>Statistici</i></h1>";
           
           
  $date=date("Y-m-d");

//Angajati cu comenzi in desfasurare:
 $sql= "SELECT A.Nume,A.Prenume FROM Angajati A WHERE A.[ID Angajat] IN (SELECT AC.[ID Angajat] FROM AngajatiComenzi AC WHERE AC.Deadline >'".$date."'".")" ;  


//Angajatul cu cele mai multe sarcini :
$sql1="SELECT A.Nume,A.Prenume FROM Angajati A WHERE A.[ID Angajat] IN (SELECT AC1.[ID Angajat] FROM AngajatiComenzi AC1 GROUP BY AC1.[ID Angajat] HAVING  COUNT(AC1.[ID Sarcina]) = 
 (SELECT TOP 1 COUNT(AC.[ID Sarcina])  FROM AngajatiComenzi AC GROUP BY AC.[ID Angajat] ORDER BY COUNT(AC.[ID Sarcina]) DESC))";


//SELECT A.Nume,A.Prenume FROM Angajati A WHERE A.[ID Angajat] = (SELECT TOP 1 AC.[ID Angajat] FROM AngajatiComenzi AC GROUP BY AC.[ID Angajat] ORDER BY COUNT([ID Sarcina]) DESC)";


//Primele 3 departamente cu cele mai multe comenzi
$sql2= "SELECT D.Nume,COUNT(C.[ID Comanda]) AS Comenzi FROM Comenzi C INNER JOIN Departamente D ON C.[ID Departament]=D.[ID Departament] GROUP BY D.Nume  HAVING COUNT([ID Comanda]) IN (SELECT TOP 3 COUNT([ID Comanda]) FROM Comenzi GROUP BY [ID Departament] ORDER BY COUNT([ID Comanda]) DESC) ORDER BY Comenzi DESC";

//Afisare serviciu favorit
$sql3="SELECT [Tip Serviciu] FROM Comenzi GROUP BY [Tip Serviciu] HAVING COUNT([ID Comanda]) =( SELECT TOP 1 COUNT([ID Comanda]) FROM Comenzi GROUP BY [Tip Serviciu]
ORDER BY COUNT([ID Comanda]) DESC )";

    $stmt = sqlsrv_query( $conn, $sql);

    $stmt1 = sqlsrv_query( $conn, $sql1);
    
    $stmt2=sqlsrv_query( $conn, $sql2);
   
    $stmt3=sqlsrv_query( $conn, $sql3);


//Afisare angajati cu sarcini in desfasurare 

   echo "<p style='font-weight:bold;'>Angajati cu comenzi in desfasurare:</p>";
            
    if( $stmt === false )
    { 
      echo "<div style='margin-left:42.5%;margin-top:2%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {   echo  "<div style='margin-left:3%;margin-top:1%;'>"; 
           
            echo "<ol>";  
    
        
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
      
    
      if($row === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:2%;'>
        <p style='color:white;font-weight:bold;'>Nu exista! </p></div>";
      }
    
      else
      
      {
          
          
            
            echo "<li style='color:white;'>"; echo $row['Nume']; echo " ";
            echo $row['Prenume'];  
            echo "</li>" ;
                }
     
            }
            echo "</ol>";
            echo "</div>";
                      
      
         
    }
//Afisare angajat cu cele mai multe sarcini 

echo "<p style='font-weight:bold;'>Angajatul cu cele mai multe sarcini :</p>";

  if( $stmt1 === false )
    { 
      echo "<div style='margin-left:42.5%;margin-top:2%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {   echo  "<div style='margin-left:3%;margin-top:1%;'>"; 
           
            echo "<ol>";  
    
        
        while($row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC)){
      
    
      if($row1 === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:2%;'>
        <p style='color:white;font-weight:bold;'>Nu exista! </p></div>";
      }
    
      else
      
      {
          
          
            
            echo "<li style='color:white;'>"; echo $row1['Nume']; echo " ";
            echo $row1['Prenume'];  
            echo "</li>" ;
                }
     
            }
            echo "</ol>";
            echo "</div>";
                      
          
    }

//Afisare departamente cu cele mai multe comenzi

echo "<p style='font-weight:bold;'>Primele 3 departamente cu cele mai multe comenzi:</p>";


           
    if( $stmt2 === false )
    { 
      echo "<div style='margin-left:42.5%;margin-top:2%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {   echo  "<div style='margin-left:3%;margin-top:1%;'>"; 
           
            echo "<ol>";  
    
        
        while($row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC)){
      
    
      if($row2 === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:2%;'>
        <p style='color:white;font-weight:bold;'>Nu exista! </p></div>";
      }
    
      else
      
      {
            
            echo "<li style='color:white;'>"; echo $row2['Nume']; echo " "; echo "--"; 
            echo " ";
            echo "Nr comenzi: "; echo $row2['Comenzi'];  
            echo "</li>" ;
                }
     
            }
            echo "</ol>";
            echo "</div>";
                      
      
        
            
         
    }
           
           
//Afisare tipul de serviciu favorit (regasit in cele mai multe comenzi)

echo "<p style='font-weight:bold;'>Serviciul favorit:</p>";

     if( $stmt3 === false )
    { 
      echo "<div style='margin-left:42.5%;margin-top:2%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {   echo  "<div style='margin-left:3%;margin-top:1%;'>"; 
           
            echo "<ol>";  
    
        
        while($row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC)){
      
    
      if($row3 === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:2%;'>
        <p style='color:white;font-weight:bold;'>Nu exista! </p></div>";
      }
    
      else
      
      {
            
            echo "<li style='color:white;'>"; echo $row3['Tip Serviciu']; echo " ";   
            echo "</li>" ;
                }
     
            }
            echo "</ol>";
            echo "</div>";
                      
      
        
            
         
    }

           
    echo " </body> </html>";



?>