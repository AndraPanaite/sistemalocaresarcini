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



     <a href='logout.php' style='width:100px;border: 0;background: none;display: block;margin: 20px ;text-align: center;border: 2px solid #2ecc71; margin-left: 90%;
padding: 14px 14px;outline: none;color: white;border-radius: 24px;transition: 0.25s;cursor: pointer;font-size:14px;text-decoration:none; background-color:#659c99'>Logout</a>
           
    <div style='margin-left:40%;position:absolute;top:5%;'>
        <h1> <i>Bine ai venit </i> <i style='color:white';> <?php echo $_SESSION['prenume']?> </i>!  </h1> 
        
     </div>
        
           <?php 
    
    echo "</br> ";
    echo "<h3 style='margin-left: 3%'>"; echo date("d/m/Y"); echo "</h3>";  
         
            $date=date("Y-m-d");
    echo " <p style='color:black;font-weight:bold;'>Sarcini curente: </p>";
   
            
    $sql = "SELECT S.Nume,AC.Deadline from Sarcini S INNER JOIN AngajatiComenzi AC ON S.[ID Sarcina] = AC.[ID Sarcina] WHERE AC.[ID Angajat]=".$_SESSION['id']." AND AC.Deadline >'".$date."'" ;
    
    $sql1= "SELECT S.Nume,AC.Deadline from Sarcini S INNER JOIN AngajatiComenzi AC ON S.[ID Sarcina] = AC.[ID Sarcina] WHERE AC.[ID Angajat]=".$_SESSION['id']." AND AC.Deadline <'".$date."'" ;   
            
    $stmt = sqlsrv_query( $conn, $sql);
    $stmt1 = sqlsrv_query($conn, $sql1);
            
    if( $stmt === false )
    { 
      echo "<div style='margin-left:42.5%;margin-top:2%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {
    
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
      
    
      if($row === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:2%;'>
        <p style='color:white;font-weight:bold;'>Angajatul cautat nu exista! </p></div>";
      }
    
      else
      
      {
          
          
          
            echo  "<div style='margin-left:3%;margin-top:2%;'>
                   <p style='color:white;font-weight:bold;'>"; 
           
            echo "<ul>";  
            echo "<li style='color:white;font-weight:bold;'>"; echo $row['Nume']; 
            echo ":"." "." ";  
            echo $row['Deadline']->format('d/m/Y'); 
            echo "</li>" ;
            echo "</ul>";
            echo "</div>";
              
            
 
              
          

         
               
      }
        
        }
            
         
    }

      echo " <p style='color:black;font-weight:bold;margin-top:2%;'>Sarcini trecute: </p>";        
            
    if($stmt1==false )     
        
         { 
      echo "<div style='margin-left:42.5%;margin-top:2%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {
    
        while($row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC)){
      
    
      if($row1 === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:2%;'>
        <p style='color:white;font-weight:bold;'>Angajatul cautat nu exista! </p></div>";
      }
    
      else
      
      {
          
          
          
            echo  "<div style='margin-left:3%;margin-top:2%;'>
                   <p style='color:white;font-weight:bold;'>"; 
           
            echo "<ul>";  
            echo "<li style='color:white;font-weight:bold;'>"; echo $row1['Nume']; 
            echo ":"." "." ";  
            echo $row1['Deadline']->format('d/m/Y'); 
            echo "</li>" ;
            echo "</ul>";
            echo "</div>";
              
            
 
              
          

         
               
      }
        
        }
            
         
    }    
            
            
    
           ?>
           
    <!--<div style='margin-left:42%;'><img src='Images/1.png' width='200' height='150'></div> -->
           
           
               <div style='weight:100px; height:20px;margin-top:3%'>
        



        
        
   
    
    </div>
     
     
   
     
     
     </body> </html> 