<?php
require_once 'dbconfig.php';
session_start();
if(isset($_POST['nome']) && isset($_POST['image']) && isset($_POST['nutri']) ){
 $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
 
 //Prendiamo tutti i valori passati con POST nella form
 $name=mysqli_real_escape_string($conn, $_POST["nome"]);
 $image=mysqli_real_escape_string($conn, $_POST["image"]);
 $nutri=mysqli_real_escape_string($conn, $_POST["nutri"]);
 
 $email=$_SESSION["email"];

 //Prendiamo l'id del cibo di cui dobbiamo cancellare
 $ciboid="SELECT id from cibo where Nome='".$name."' AND Immagine='".$image."' AND Nutrienti='".$nutri."'";
 $res=mysqli_query($conn, $ciboid);
 
 $row = mysqli_fetch_row($res);
 $delete="DELETE from likes WHERE Email_utente='".$email."' AND Id_cibo='".$row[0]."'";
 $resdelete=mysqli_query($conn, $delete);
 
 echo json_encode("Rimosso dalla lista");
 mysqli_close($conn);
}
?>

