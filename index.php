<?php

//conexiunea la baza de date
$serverName = "DESKTOP-D3PC9M1\SQLEXPRESS"; 
$connectionInfo = array( "Database"=>"Proiect");
$conn = sqlsrv_connect( $serverName, $connectionInfo);


if ( $_SERVER['REQUEST_METHOD'] == 'POST')
   
{
    $i=0;
    
    if($_POST['User']!="") 
    $user=$_POST['User'];
    
    else {$err[$i]="Va rugam introduceti email-ul!";
          $i++;
         }
    
    if($_POST['Parola']!="")
    $parola=$_POST['Parola'];
    
   else {$err[$i]="Va rugam introduceti parola!";
          $i++;
        }
    
    
    
  if($i==0)
  { 
     
 
    $sql = "SELECT [ID Angajat],Prenume,Email,Parola,EsteAdmin from Angajati WHERE Email='$user'";
    
    
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false )
    { 
      echo"<div style='margin-left:42.5%;margin-top:5%;'>
            <p style='color:white;font-weight:bold;'>Eroare de conexiune la baza de date!</p>
            </div>";
    }
    else
    {
    
      
      $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    
      if($row === false)
      {
         echo  "<div style='margin-left:42.5%;margin-top:5%;'>
        <p style='color:white;font-weight:bold;'>Email sau Parola invalida!</p></div>";
      }
    
      else
      
      {
          
          if($row['Parola'] == $parola) 
          {
              session_start();
              $_SESSION['id'] = $row['ID Angajat'];
              $_SESSION['user'] = $row['Email'];
              $_SESSION['admin'] = $row['EsteAdmin'];
              $_SESSION['prenume'] = $row['Prenume'];
              if($_SESSION['admin'] == 0) header('Location: Home_User.php');
              else header('Location: Home.php');
              die("S-a produs o eroare la redirectionare.");
          }

         else
         {
            echo  "<div style='margin-left:42.5%;margin-top:5%;'>
            <p style='color:white;font-weight:bold;'>Email sau Parola invalida!</p></div>";

         }
               
      }
    
     }  
      
     
  }
    
  else 
    
  {
 
    echo " <div style='margin-left:42.5%;margin-top:5%;'>";
      for($i=0;$i<count($err);$i++)
      echo "<p style='color:white;font-weight:bold;'><b>$err[$i]</b></p>";
   echo "</div>";     
    
  } 
    
}


?>



<!DOCTYPE html>
<html>
    <head> 
        <title>Login</title>
        <style>
        
        
                        body {
                            font-family: sans-serif;
                            background: linear-gradient(to right, #f2ccff, #be33ff)
                        }

                        .box {
                            width: 500px;
                            padding: 40px;
                            position: absolute;
                            top: 10%;
                            left: 50%;
                            background: #191919;
                            ;
                            text-align: center;
                            transition: 0.25s;
                            margin-top: 100px
                        }

                        .box input[type="email"],
                        .box input[type="password"] {
                            border: 0;
                            background: none;
                            display: block;
                            margin: 20px auto;
                            text-align: center;
                            border: 2px solid #3498db;
                            padding: 10px 10px;
                            width: 250px;
                            outline: none;
                            color: white;
                            border-radius: 24px;
                            transition: 0.25s
                        }

                        .box h1 {
                            color: white;
                            text-transform: uppercase;
                            font-weight: 500
                        }

                        .box input[type="email"]:focus,
                        .box input[type="password"]:focus {
                            width: 300px;
                            border-color: #2ecc71
                        }

                        .box input[type="submit"] {
                            border: 0;
                            background: none;
                            display: block;
                            margin: 20px auto;
                            text-align: center;
                            border: 2px solid #2ecc71;
                            padding: 14px 40px;
                            outline: none;
                            color: white;
                            border-radius: 24px;
                            transition: 0.25s;
                            cursor: pointer
                        }

                        .box input[type="submit"]:hover {
                            background: #2ecc71
                        }

                        .forgot {
                            text-decoration: underline
                        }

                        ul.social-network {
                            list-style: none;
                            display: inline;
                            margin-left: 0 !important;
                            padding: 0
                        }

                        ul.social-network li {
                            display: inline;
                            margin: 0 5px
                        }

                        .social-network a.icoFacebook:hover {
                            background-color: #3B5998
                        }

                        .social-network a.icoTwitter:hover {
                            background-color: #33ccff
                        }

                        .social-network a.icoGoogle:hover {
                            background-color: #BD3518
                        }

                        .social-network a.icoFacebook:hover i,
                        .social-network a.icoTwitter:hover i,
                        .social-network a.icoGoogle:hover i {
                            color: #fff
                        }

                        a.socialIcon:hover,
                        .socialHoverClass {
                            color: #44BCDD
                        }

                        .social-circle li a {
                            display: inline-block;
                            position: relative;
                            margin: 0 auto 0 auto;
                            border-radius: 50%;
                            text-align: center;
                            width: 50px;
                            height: 50px;
                            font-size: 20px
                        }

                        .social-circle li i {
                            margin: 0;
                            line-height: 50px;
                            text-align: center
                        }

                        .social-circle li a:hover i,
                        .triggeredHover {
                            transform: rotate(360deg);
                            transition: all 0.2s
                        }

                        .social-circle i {
                            color: #fff;
                            transition: all 0.8s;
                            transition: all 0.8s
                        }
            
            
                       #register
                        {               width:95px;
                                        border: 0;
                                        background: none;
                                        display: block;
                                        margin: 20px auto;
                                        text-align: center;
                                        border: 2px solid #2ecc71;
                                        padding: 14px 40px;
                                        outline: none;
                                        color: white;
                                        border-radius: 24px;
                                        transition: 0.25s;
                                        cursor: pointer;
                                        font-size:13px;
                                        text-decoration:none;
                        }
            
            
                      #register:hover {
                            background: #2ecc71
                        }
            
                     #register:focus{    border: 0;
                            background: none;
                            display: block;
                            margin: 20px auto;
                            text-align: center;
                            border: 2px solid #2ecc71;
                            padding: 14px 40px;
                            outline: none;
                            color: white;
                            border-radius: 24px;
                            transition: 0.25s;
                            cursor: pointer}
            
            
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <form class="box" action='index.php' nctype='multipart/form-data' method='post' style="margin-left:-19%;" >
                            <h1>Login</h1>
                            <p style="color:white;"> Va rugam introduceti datele de conectare!</p> <input type="email" name="User" placeholder="Email"> <input type="password" name="Parola" placeholder="*****"><input type="submit" name="" value="Conecteaza-te!" href="#">
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>   
</html>




