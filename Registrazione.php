<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
  //Verifica che tutti i parametri sono settati
require_once 'dbconfig.php';
  if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["conferma"]))
  {    //mettere variabili che abbiamo messo nel form
      session_start();
      $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
      $esistente=0;
      
      
      // echo 'Nome: '.$row["Nome"]."cognome".$row["Cognome"];
      $contatore=0;
      $lunghezza= strlen($_POST["password"]);
      
      
      For($i=0; $i<$lunghezza; $i++){
              if($_POST["password"][$i] == "/" || $_POST["password"][$i] == "+" || $_POST["password"][$i] == "?" || $_POST["password"][$i] == "!" ) $contatore++;
      }
      
      if ($esistente==0){
          $ultima= mysqli_real_escape_string($conn, $_POST["email"]);
          $query1 = "SELECT email FROM utente WHERE email = '".$ultima."'";
          $res= mysqli_query($conn, $query1);
          if(mysqli_num_rows($res)>0){
              $error[]="Email già esistente";
              //exit;
          }else{
          $esistente++;
          }
      }
      
      if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
          /*echo '<div id="Errore2">E-mail non valida</div>';*/
          $error[]="Email non valida";
      } else if($esistente==0){
          $error[]="Email esistente";
      }else if($lunghezza < 6 && $contatore>=2){
          $error[]="Pass senza speciali e corta";
      } else if ($lunghezza < 6 && $contatore<2){
          $error[]="pass corta";  
      }else if ($lunghezza >= 6 && $contatore<2){
         $error[]="pass senza speciali";
      }else if ($_POST["password"]!=$_POST["conferma"]){
          echo '<div id="Errore2">Conferma Password Errata</div>';
      } else {
          $nome= mysqli_real_escape_string($conn, $_POST['nome']);
          $cognome= mysqli_real_escape_string($conn, $_POST['cognome']);
          $email= mysqli_real_escape_string($conn, $_POST['email']);
          
          $password= mysqli_real_escape_string($conn, $_POST['password']);
          $password = password_hash($password, PASSWORD_BCRYPT);
          
          $query= "INSERT INTO utente VALUES ('$email', '$nome', '$cognome', '$password')";
          
          $res=mysqli_query($conn, $query);
          $_SESSION['nome']=$_POST["nome"];
          $_SESSION['email']=$_POST["email"];
          header("Location: HomeAccesso.php");
          mysqli_close($conn);
          exit;
      } 
      
  }
?>

<html> 
    
    <head>
        
        <title>HW1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    <!-- Per la visualizzazione su mobile -->
        <link rel="stylesheet" href="Regi.css">
        <script src="registrazione.js" defer></script>
         
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Raleway:wght@100&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <?php
           //Verifica errori
           if(isset($errore))
           {
               echo "<p class = errore>";
               echo "credenziali non valide";
               echo "</p>";
           }
        
        ?>
        <div id="contenitore"></div>
        <div>REGISTRATI !</div>
        
        <main>
            
            <form name="regi" method='post'>
              
                <p>
                    <label>Nome <input id="nome" type='text' name='nome'></label>
                </p>
                <p>
                    <label>Cognome <input id="cognome" type='text' name='cognome'></label>
                </p>
                <p>
                    <label>E-mail <input id="Mail" type='text' name='email'></label>
                </p>
                <p>
                    <label>Password  <input id="Pass" type='password' name='password'></label>
                </p>
                <p>
                    <label>Conferma Password <input type='password' name='conferma'></label>
                </p>

                <p>
                    <label>&nbsp;<input type='submit' value="Registrati"></label> <!-- Per non scrivere niente accanto -->
                </p>
            </form>
            
            
        </main>
        <p id='testo'><strong>Requisiti Password:  <br/>
                <em id="min">- Minimo 6 caratteri</em> <br/>
                <em id="spec"> - Minimo due caratteri speciali (/ + ? !)</em></strong></p>
        
        <a href="Login.php" class='Bottone'>Già Registrato?  </a>
        <div id="Errore"></div>
       
    </body>
</html>
