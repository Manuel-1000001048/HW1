<?php

//ATTENZIONE: per ogni if e quindi per ogni ramo dovra essere tornato un risultato, sarà anche un echo che sara convertito in JSON 
//e quindi i ritorni non sarà normale, ma sarà un JSON e quindi dobbiamo sempre tornare un JSON.
   require_once 'dbconfig.php';
   session_start();
   
   if(isset($_POST['nome']) && isset($_POST['image']) && isset($_POST['nutri']) ){
       
    $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
    $nome=mysqli_real_escape_string($conn, $_POST["nome"]);
    $image=mysqli_real_escape_string($conn, $_POST["image"]);
    $nutri=mysqli_real_escape_string($conn, $_POST["nutri"]);
    
    $emailSession=$_SESSION['email']; //Prendo la sessione di email che mi serve per id della tabella utente
    
    $SelectCibo="SELECT Nome, Immagine, Nutrienti FROM cibo WHERE Nome='".$nome."' AND Immagine='".$image."' AND Nutrienti='".$nutri."'";
    $resSelectCibo=mysqli_query($conn, $SelectCibo);        //IMPORTANTE DOPO UNA QUERY FARE SEMPRE IL RES ALLORA LA QUERY NON FUNZIONA E RESTITUISCE ERRORE
    
    if(mysqli_num_rows($resSelectCibo)>0){ //se già IL CIBO è presente nella tabella cibo allora devo inserirlo solo in likes
        $id_cibo="SELECT id from cibo where Nome='".$nome."'";
        $resid_cibo=mysqli_query($conn, $id_cibo);   //IMPORTANTE DOPO UNA QUERY FARE SEMPRE IL RES ALLORA LA QUERY NON FUNZIONA E RESTITUISCE ERRORE
        $row = mysqli_fetch_row($resid_cibo);
        $controllikes="SELECT * from likes where Email_utente='".$emailSession."' AND Id_cibo='".$row[0]."'";
        $rescontrollikes=mysqli_query($conn,$controllikes);
        if(mysqli_num_rows($rescontrollikes)>0){
            echo json_encode("Alimento già inserito nella tua dieta");
        }else{
            
            $query3="INSERT into likes(Email_utente, Id_cibo) VALUES ('$emailSession', '$row[0]')";
            $res3=mysqli_query($conn, $query3);   //IMPORTANTE DOPO UNA QUERY FARE SEMPRE IL RES ALLORA LA QUERY NON FUNZIONA E RESTITUISCE ERRORE
            echo json_encode("Molte persone come te, hanno scelto questo alimento");
        }
      
    }else //se cibo selezionato non c'è ancora nella tabella cibo
    {
        $query="INSERT into cibo(Nome, Immagine, Nutrienti) VALUES ('$nome', '$image', '$nutri')";
        $res= mysqli_query($conn, $query);    //IMPORTANTE DOPO UNA QUERY FARE SEMPRE IL RES ALLORA LA QUERY NON FUNZIONA E RESTITUISCE ERRORE
        
        if($res) {  //se l'inserimento va a buon fine
        
            $id_cibo="SELECT id from cibo where Nome='".$nome."'";
            $resid_cibo=mysqli_query($conn, $id_cibo);   //IMPORTANTE DOPO UNA QUERY FARE SEMPRE IL RES ALLORA LA QUERY NON FUNZIONA E RESTITUISCE ERRORE
            $row = mysqli_fetch_row($resid_cibo);
                if(mysqli_num_rows($resid_cibo)>0){
                         $query3="INSERT into likes(Email_utente, Id_cibo) VALUES ('$emailSession', '$row[0]')";
                         $res3=mysqli_query($conn, $query3);
                         echo json_encode("Alimento Inserito nella tua dieta");
                }
        }else{
            echo json_encode("Errore, Alimento non inserito nella dieta");
        }
    }
    mysqli_close($conn);
   }
?>