<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>HW1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    <!-- Per la visualizzazione su mobile -->
        <link rel="stylesheet" href="dieta.css">
        <!-- <script src="HomeWork1.js" defer></script> -->
        <script src="dieta.js" defer></script>
         
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Raleway:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
        // put your code here
        
        ?>
        <header>  
            <div id="overlay"></div>         <!-- Per la trasparenza dell'immagione -->
            <nav>  
                <div id="Icone"> 
                    <a href="Logout.php"> LOGOUT </a>
                    <a href="HomeAccesso.php"> HOME </a>
                    <a href="Dieta.php"> DIETA </a>           
                </div>
            </nav>  
            
            <h1>
                <strong id='Titolo'> La tua Dieta </strong> <br/>
                <em id='Second'> Tieni d'occhio la tua Alimentazione </em> <br/>
                
            </h1>
           
                <?php
                //Avviamo la sessione
                session_start();
                
                //se non è fatto accesso quindi non c'è nessuna variabile di sessione settata, si ritorna login
                if(!isset($_SESSION['nome'])){
                    header("Location: Login.php");
                    exit;
                }else {
                    $utente=$_SESSION['nome'];
                     echo "<h1>$utente</h1>";
                }
                
                ?>
            

            
        </header>
        
        <section id="dieta">
            <?php
          require_once 'dbconfig.php';
          //session_start();      Qui non si mette dato che gia la stiamo attivando sopra la sessione
          $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
          
          $email=$_SESSION['email'];
          $query = "SELECT * FROM likes WHERE Email_utente = '".$email."'";
          $res= mysqli_query($conn, $query);
          
          if(mysqli_num_rows($res)==0){        //non ci sono righe trovate
              echo '<div id="Errore2"> "Nessun Alimento Selezionato"</div>';
              //exit;
          }else{
              
            //Qui controlliamo tutte le righe esistenti 
          $num = mysqli_num_rows($res);    // Qui cointrolliamo il numero di righe che ci sono
          
          //------------ATTENZIONE GESTIRE RIGHE DELLA QUERY ------------------
          
          for($i=0; $i<$num; $i++){            //Fare cigclo in base al numero di righe che esistono nella query 
            $row = mysqli_fetch_assoc($res);  //Fare un associazione riga per riga, con questa funzione si fa a uno a uno
             $query1 = "SELECT * FROM cibo WHERE id = '".$row['Id_cibo']."'";
             $res1= mysqli_query($conn, $query1);
             $row1 = mysqli_fetch_assoc($res1);
             
             echo "<div>"."<h1>".$row1['Nome']
                     . "</h1>"
                     ."<img src=".$row1['Immagine']
                     . "></img>"
                     ."<p>".$row1['Nutrienti']
                     . "</p>"
                     ."<p id='delete'>"."[PREMI PER ELIMINARE L'ALIMENTO]"
                     . "</p>"
             . "</div>";
            
          }
     
          }
      
  
                ?>
        </section>

        
        <footer>
            <address>Manuel Rosario Maugeri 1000001048</address>
            
        </footer>
    </body>
</html>


