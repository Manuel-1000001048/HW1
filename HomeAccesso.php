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
        <link rel="stylesheet" href="Accesso.css">
        <!-- <script src="HomeWork1.js" defer></script> -->
         <script src="Ricerca.js" defer></script>
         
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
                    <a href="HomeAccesso.php.php"> HOME </a>
                    <a href="Dieta.php"> DIETA </a>          
                </div>
            </nav>  
            
            <h1>
                <strong id='Titolo'> HARDCORE FITNESS </strong> <br/>
                <em id='Second'> Resta in forma con noi! </em> <br/>
                
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
                     echo "<h1>Benvenuto $utente</h1>";
                }
                
                ?>
            
            <form id='Prodotti' method="get"> 
                        Alimenti Dieta:
                        <input type="text" id="prodotto">
                        <input type="submit" id="submit" value="Cerca">
                    </form>
            
        </header>
        
        <section id="Attività">
            
        </section>

        
        <footer>
            <address>Manuel Rosario Maugeri 1000001048</address>
            
        </footer>
    </body>
</html>
