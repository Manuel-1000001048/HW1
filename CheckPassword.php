<?php

      $contatore=0;
      $lunghezza= strlen($_GET['q']);
      
      
      For($i=0; $i<$lunghezza; $i++){
              if($_GET['q'][$i] == "/" || $_GET['q'][$i] == "+" || $_GET['q'][$i] == "?" || $_GET['q'][$i] == "!" ) $contatore++;
      }
      
      if($lunghezza < 6 && $contatore>=2){
          $result="Errore lunghezza";
      } else if ($lunghezza < 6 && $contatore<2){
          $result="lunghezza e speciali";   
      }else if ($lunghezza >= 6 && $contatore<2){
          $result="speciali";
      } else {
          $result="Pass corretta";
      }
      echo json_encode($result);

?>

