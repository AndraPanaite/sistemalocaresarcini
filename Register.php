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
 
 
         if($_POST['Prenume']!="")
            $prenume=$_POST['Prenume'];
    
         else {$err[$i]="Va rugam introduceti prenumele!";
          $i++;
                }

 
        if($_POST['Telefon']!="")
         $telefon=$_POST['Telefon'];
    
        else {$err[$i]="Va rugam introduceti numarul de telefon!";
          $i++;
             }
 
        if($_POST['CNP']!="")
            $cnp=$_POST['CNP'];
            
         else {$err[$i]="Va rugam introduceti CNP!";
          $i++;
             }
 
 
         if(isset($_POST['Sex']))
         $sex=$_POST['Sex'];
    
         else {$err[$i]="Va rugam selectati genul!";
          $i++;
             }
 
 
 
            if($_POST['User']!="")
            $user=$_POST['User'];
    
            else {$err[$i]="Va rugam introduceti user-ul!";
                  $i++;
                }
 
        if($_POST['Parola']!="")
            $parola=$_POST['Parola'];
    
         else {$err[$i]="Va rugam introduceti parola!";
          $i++;
             }
    
         $departament=$_POST['Departament'];
    
    
    
    if($i==0)
    
   {
        
        
        
        $sql = "INSERT INTO Angajati (Nume,Prenume,Nr_telefon,CNP,Sex,Email,Parola,[ID Departament],EsteAdmin) VALUES ('$nume','$prenume','$telefon','$cnp','$sex','$user','$parola','$departament',0)";
        
   
    $stmt = sqlsrv_query( $conn, $sql);
       if( $stmt === false )
    echo "<html>
        <head><title>Register</title></head>  
         <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'> 

         <div style='margin-left:45%;margin-top:15%'> <h3><i>Nu s-a putut realiza inregistrarea!</i></b>
         </div>
         </body>
         </html>";
       
    else {   //Inregistrare reusita  

        
        
        
        
    echo "<html>
        <head><title>Register</title></head>  
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
<head><title>Register</title></head>
<body>


 <div style='margin-left:45%;margin-top:3%'>
 <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'>  
    <h1><i><b> Register </b></i></h1>  
    </br>
    
    <form action='Register.php' nctype='multipart/form-data' method='post'>
    
    Nume: 
    <input type='text' name='Nume' placeholder='ex.Popescu'/>
    <div style='margin-top:2%;'> </div>
    
    Prenume:
      <input type='text' name='Prenume'/>
    <div style='margin-top:2%;'> </div>
    
    Numar telefon:
     <input type='text' name='Telefon' maxlength='10'/>
    <div style='margin-top:2%;'> </div>
    
    
    CNP:
    <input type='text' name='CNP' maxlength='13'/>
    <div style='margin-top:2%;'> </div>
    
    
    Sex:
    <input type='radio' id='male' name='Sex' value='M'>
    <label for='M'>M</label>
    <input type='radio' id='female' name='Sex' value='F'>
    <label for='F'>F</label>
    </br>
    </br>
    
    Email/Username:
     <input type='email' name='User' placeholder='email@yahoo.com'/> 
     
     <div style='margin-top:2%;'> </div>
    Parola:
      <input type='password' name='Parola' placeholder='******'/>
      
      <div style='margin-top:3%;'> </div>
     
    Departament:
    <select name='Departament'>
        ";
        
        $sql = "SELECT [ID Departament],Nume FROM Departamente != 'Admin'";
        $stmt = sqlsrv_query($conn, $sql);
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value='".$row['ID Departament']."'>".$row['Nume']."</option>";
        }
     echo "
    </select>
    <div style='margin-top:3%;'> </div>
      
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
   
 echo  //Afisare formular inregistrare
"
<html>
<head><title>Register</title></head>
<body>


 <div style='margin-left:45%;margin-top:3%'>
 <body style='font-family: sans-serif;background: linear-gradient(to right, #ff7070, #84c5fa)'>  
    <h1><i><b> Register </b></i></h1>  
    </br>
    
    <form action='Register.php' nctype='multipart/form-data' method='post'>
    
    Nume: 
    <input type='text' name='Nume' placeholder='ex.Popescu'/>
    <div style='margin-top:2%;'> </div>
    
    Prenume:
      <input type='text' name='Prenume'/>
    <div style='margin-top:2%;'> </div>
    
    Numar telefon:
     <input type='text' name='Telefon' maxlength='10'/>
    <div style='margin-top:2%;'> </div>
    
    
    CNP:
    <input type='text' name='CNP' maxlength='13'/>
    <div style='margin-top:2%;'> </div>
    
    
    Sex:
    <input type='radio' id='male' name='Sex' value='M'>
    <label for='M'>M</label>
    <input type='radio' id='female' name='Sex' value='F'>
    <label for='F'>F</label>
    </br>
    </br>
    
    Email/Username:
     <input type='email' name='User' placeholder='email@yahoo.com'/> 
     
     <div style='margin-top:2%;'> </div>
    Parola:
      <input type='password' name='Parola' placeholder='******'/>
      
      <div style='margin-top:3%;'> </div>
    
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
    <div style='margin-top:3%;'> </div>
      
       <input type='submit' name='inregistreaza' value='INREGISTREAZA' style='width:170px;border: 0;background: none;display: block;margin: 20px auto;text-align: center;border: 2px solid #2ecc71;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99;margin-right:90%;'/>
     
     
    
    </div>
    
    </form>";



"</body>


</html>

" ;

    
    
}
    
    
    
    
?>