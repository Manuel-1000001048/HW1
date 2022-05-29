<?php
require_once 'dbconfig.php';
$conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
$mail= mysqli_real_escape_string($conn, $_GET['q']);
$query= "SELECT * FROM utente WHERE Email='".$mail."'";
$res= mysqli_query($conn, $query);

if(mysqli_num_rows($res)>0){
    
    $response=array('exists'=> true);
} else {
    $response = array('exists'=> false);
}
/* echo $_SESSION['email'];
echo'ciao';*/
echo json_encode($response);
mysqli_close($conn);
?>

