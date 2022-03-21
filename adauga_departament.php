<?php

  //conexiunea la baza de date
include('Includes/conexiune.php');

    
if ( $_SERVER['REQUEST_METHOD'] == 'POST')
   
{   $i=0;
    
 
 
        if($_POST['Nume']!="")
          $nume=$_POST['Nume'];
         
        else {$err[$i]="Va rugam introduceti numele!";
          $i++;
              }
 
        if($_POST['Telefon']!="")
         $telefon=$_POST['Telefon'];
    
        else {$err[$i]="Va rugam introduceti numarul de telefon!";
          $i++;
             }
    
    if($i==0)
    
   {    
        $sql = "INSERT INTO Departamente (Nume,Nr_telefon) VALUES ('$nume','$telefon')";
       
    

       $stmt = sqlsrv_query( $conn, $sql);
       if( $stmt === false)
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
<head><title>Adauga Departament</title></head>
<body>


 <div style='margin-left:45%;margin-top:3%'>
 <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'>  
    <h1><i><b> Adauga departament </b></i></h1>  
    </br>
      <h3> Date departament </h3>
        
    <form action='adauga_departament.php' nctype='multipart/form-data' method='post'>
  
    Nume: 
    <input type='text' name='Nume' placeholder='ex.IT'/>
    <div style='margin-top:1%;'> </div>
    
    
    Numar telefon:
     <input type='text' name='Telefon' maxlength='10'/>
    <div style='margin-top:2%;'> </div>
   
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
   
 echo  //Afisare formular inregistrare departament
"
<html>
<head><title>Adauga Departament</title></head>
<body>


 <div style='margin-left:45%;margin-top:3%'>
 <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'>  
    <h1><i><b> Adauga departament </b></i></h1>  
    </br>
      <h3> Date departament </h3>
        
    <form action='adauga_departament.php' nctype='multipart/form-data' method='post'>
  
    Nume: 
    <input type='text' name='Nume' placeholder='ex.IT'/>
    <div style='margin-top:1%;'> </div>
    
    
    Numar telefon:
     <input type='text' name='Telefon' maxlength='10'/>
    <div style='margin-top:2%;'> </div>
   
    <div style='margin-top:2%;'> </div>
      
     <input type='submit' name='inregistreaza' value='INREGISTREAZA' style='width:170px;border: 0;background: none;display: block;margin: 20px auto;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99;margin-right:90%;'/>
     
    
    </div>
    
    </form>
</body>


</html>

" ;

    
    
}
    
    
    
    
?>