
<?php
   //Verifica che tutti i parametri sono settati
   require_once 'dbconfig.php';
   
  if(isset($_POST["email"]) && isset($_POST["password"]))
  {    //mettere variabili che abbiamo messo nel form
          session_start();
          $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
          
          $email= mysqli_real_escape_string($conn, $_POST['email']);
          $password= mysqli_real_escape_string($conn, $_POST['password']);
          $query = "SELECT * FROM utente WHERE email = '".$email."'";
          $res= mysqli_query($conn, $query);
          
          if(mysqli_num_rows($res)==0){        //non ci sono righe trovate
              echo '<div id="Errore2"> "E-mail o Password errata "</div>';
              //exit;
          }else{
          
          $row = mysqli_fetch_assoc($res);
          if(password_verify($_POST["password"], $row['Password'])){
              $_SESSION['nome']=$row['Nome'];
              $_SESSION['email']=$_POST["email"];
              //echo $row['Nome'];
              header("Location: HomeAccesso.php");
              mysqli_close($conn);
              exit;
          } else {
              echo '<div id="Errore2"> "E-mail o Password errata "</div>';
          }
          
          }
      
  }
?>

<html>
    
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    <!-- Per la visualizzazione su mobile -->
        <link rel="stylesheet" href="Regi.css">
        <script src="Login.js" defer></script>
         
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Raleway:wght@100&display=swap" rel="stylesheet">
        
    </head>
     
    <body>
        
        <div>ACCEDI !</div>
        
        <main>
            
            <form name="login" method="post">
              
                <p>
                    <label>E_mail<input type='text' name='email'></label>
                </p>
                <p>
                    <label>Password <input type='password' name='password'></label>
                </p>
                <p>
                    <label>&nbsp;<input type='submit' value="ACCEDI"></label> <!-- Per non scrivere niente accanto -->
                </p>
            </form>
            
            
        </main>
        
        <a href="Registrazione.php" class='Bottone'>Registrati  </a>
        <div id="Errore"></div>
    </body>
</html>
