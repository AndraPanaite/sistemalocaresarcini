<?php

  //conexiunea la baza de date
include('Includes/conexiune.php');

    
if ( $_SERVER['REQUEST_METHOD'] == 'POST')
   
{   $i=0;
    
 
            if($_POST['Data_primire']!="")
            $Data_primire=$_POST['Data_primire'];
    
            else {$err[$i]="Va rugam introduceti Data de primire!";
                  $i++;
                }
 
        if($_POST['Data_finalizare']!="")
            $Data_finalizare=$_POST['Data_finalizare'];
    
         else {$err[$i]="Va rugam introduceti Data de finalizare!";
          $i++;
             }
    
      if($_POST['Adresa_livrare']!="")
            $adresa_liv=$_POST['Adresa_livrare'];
    
         else {$err[$i]="Va rugam introduceti adresa de livrare!";
          $i++;
             }
        
        $departament = $_POST['Departament'];
        
        $serviciu = $_POST['Serviciu'];
        
 
    
    if($i==0)
    
   {    
    

     $sql= "INSERT INTO Comenzi (Data_primire,Data_finalizare,Adresa,[ID Departament],[Tip serviciu]) VALUES ('$Data_primire','$Data_finalizare','$adresa_liv','$departament','$serviciu')";   
     
        
       
       $stmt = sqlsrv_query( $conn, $sql);
        
        
       $sql0 = "SELECT MAX([ID Comanda]) AS ID FROM Comenzi";
       $stmt0 = sqlsrv_query( $conn, $sql0);
       $row0 = sqlsrv_fetch_array( $stmt0, SQLSRV_FETCH_ASSOC);
       $id_comanda = $row0['ID'] ;
       $sql1 = "INSERT INTO AngajatiComenzi ([ID Comanda],Deadline) VALUES ($id_comanda,'$Data_finalizare')";
        
       $stmt1 = sqlsrv_query( $conn, $sql1);
       if( $stmt1 === false)
    echo "<html>
        <head><title>Eroare</title></head>  
         <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'> 

         <div style='margin-left:45%;margin-top:15%'> <h3><i>Nu s-a putut realiza inregistrarea!</i></b>
         </div>
         </body>
         </html>";
       
    else {   //Inregistrare reusita  
   
    echo "<html>
        <head><title>Succes</title></head>  
         <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'> 

         <div style='margin-left:45%;margin-top:15%'> <h3><i>Inregistrare reusita!</i></b>
         </div>


 <a href='Home.php' style='width:120px;border: 0;background: none;display: block;margin: 20px auto;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99;margin-right:90%;margin-left:45%'>Inapoi</a>

        </body>
        </html>" ;
    }
    
    }
 else {    //Afisare erori
     
 echo
"
<html>
<head><title>Comanda</title></head>
<body>



 <div style='margin-left:45%;margin-top:3%'>
 <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'>  
    <h1><i><b> Comanda </b></i></h1>  
    </br>
      
    <h3> Date comanda </h3>    
    <form action='adauga_comanda.php' nctype='multipart/form-data' method='post'>
  

        
   
    Data primire:
     <input type='date' name='Data_primire'/> 
     
     <div style='margin-top:2%;'> </div>
     
    Data finalizare:
      <input type='date' name='Data_finalizare'/> 
      
      <div style='margin-top:3%;'> </div>
      
    Adresa livrare: 
     <input type='text' name='Adresa_livrare' maxlength='100'/>
    <div style='margin-top:2%;'> </div>
    
    Tip Serviciu:
    <select name='Serviciu'>
        ";
        
        $sql = "SELECT [ID Serviciu],Nume FROM Servicii";
        $stmt = sqlsrv_query($conn, $sql);
        
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value='".$row['Nume']."'>".$row['Nume']."</option>";
        }
     echo "
    </select>
   
    <div style='margin-top:2%;'> </div>
    
    
   Departament:
    <select name='Departament'>
        ";
        
        $sql = "SELECT [ID Departament],Nume FROM Departamente WHERE Nume != 'Admin'";
        $stmt = sqlsrv_query($conn, $sql);
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value='".$row['ID Departament']."'>".$row['Nume']."</option>";
        }
     echo "
    </select>
   
    <div style='margin-top:2%;'> </div>
      
     <input type='submit' name='inregistreaza' value='INREGISTREAZA' style='width:170px;border: 0;background: none;display: block;margin: 20px auto;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99;margin-right:90%;'/>
     
    
    </div>
    
    </form>";

    
    echo " <div style='margin-left:45%;'>";
      for($i=0;$i< count($err);$i++)
      echo "<p style='color:white;'><b>$err[$i]</b></p>";
    echo "</div>";    
    


"</body>


</html>";
     
     
     
 }
 
    
}


else {
   
 echo  //Afisare formular inregistrare comanda 
"
<html>
<head><title>Comanda</title></head>
<body>



 <div style='margin-left:45%;margin-top:3%'>
 <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'>  
    <h1><i><b> Comanda </b></i></h1>  
    </br>
      
    <h3> Date comanda </h3>    
    <form action='adauga_comanda.php' nctype='multipart/form-data' method='post'>
  

        
   
    Data primire:
     <input type='date' name='Data_primire'/> 
     
     <div style='margin-top:2%;'> </div>
     
    Data finalizare:
      <input type='date' name='Data_finalizare'/> 
      
      <div style='margin-top:3%;'> </div>
      
    Adresa livrare: 
     <input type='text' name='Adresa_livrare' maxlength='100'/>
    <div style='margin-top:2%;'> </div>
    
    Tip Serviciu:
    <select name='Serviciu'>
        ";
        
        $sql = "SELECT [ID Serviciu],Nume FROM Servicii";
        $stmt = sqlsrv_query($conn, $sql);
        
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value='".$row['Nume']."'>".$row['Nume']."</option>";
        }
     echo "
    </select>
   
    <div style='margin-top:2%;'> </div>
    
    
   Departament:
    <select name='Departament'>
        ";
        
        $sql = "SELECT [ID Departament],Nume FROM Departamente WHERE Nume != 'Admin'";
        $stmt = sqlsrv_query($conn, $sql);
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value='".$row['ID Departament']."'>".$row['Nume']."</option>";
        }
     echo "
    </select>
   
    <div style='margin-top:2%;'> </div>
      
     <input type='submit' name='inregistreaza' value='INREGISTREAZA' style='width:170px;border: 0;background: none;display: block;margin: 20px auto;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99;margin-right:90%;'/>
     
    
    </div>
    
    </form>";



"</body>


</html>

" ;

    
    
}
    
    
    
    
?>