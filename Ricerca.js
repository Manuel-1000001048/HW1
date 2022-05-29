/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//--------- GESTISCI LA LISTA DA SELEZIONARE -----------------

//Seleziono gli elementi del div e li inserisco in un form che poi invio tramite fetch con metodo post al server

let container=0;    //Per capire il div selezionato

function jsonCheckLike(json){
    //Qui posso sistemare tutti i json che ritorno in base all'immagine selezionata
console.log(json);
const ris= container.querySelector("h2");
if (ris != null){
    ris.innerHTML='';
    ris.textContent=json;
    container.appendChild(ris);
} else {
    const ris = document.createElement('h2');
    ris.textContent=json;
    container.appendChild(ris);
}
}

function selezionato1(event){
    container = event.currentTarget;         //definisce il div cliccato
    const nome= container.querySelector("h1");    //Mettendo container al postpo di document prende solo elementi dentro container
    const img= container.querySelector("img");
    const nutri= container.querySelector("p");
    
    console.log(nome.innerHTML);
    console.log(img.src);
    console.log(nutri.innerHTML);

    let form_data= new FormData();
    form_data.append('nome', nome.innerHTML);
    form_data.append('image', img.src);
    form_data.append('nutri', nutri.innerHTML);
    
    
    fetch('CheckLike.php', {
      method: 'post',
      body: form_data
    }).then(fetchResponse).then(jsonCheckLike);
}

//------------------------------------------------
const ListaPrima=[];



function jsonRicerca(json){
    console.log(json);
    
    const risultato = document.querySelector('#Attività');
    
    //header.id='Errore2';
    
    //risultato.innerHTML='';
    if((json.hints).length == 0){
       const contenitore = document.createElement('div');
       risultato.appendChild(contenitore);
       const header = document.createElement('h1');
       header.textContent= "NESSUN ALIMENTO TROVATO";
       contenitore.appendChild(header);
    } else{
    
          for(i=0; i<(json.hints).length; i++){
              const contenitore = document.createElement('div');
              risultato.appendChild(contenitore);
              const immagine = document.createElement('img');    
              const header = document.createElement('h1');
              const nutrienti = document.createElement('p');
              header.textContent= json.hints[i].food.label;
              contenitore.appendChild(header);
     
              if(!json.hints[i].food.image){
                  immagine.src="immagine-non-disponibile.png";
                  contenitore.appendChild(immagine);
              }else{
                  immagine.src=json.hints[i].food.image;
                  contenitore.appendChild(immagine); 
              }
     
               nutrienti.textContent= "Calorie :"+json.hints[i].food.nutrients.ENERC_KCAL+" Grassi: "+json.hints[i].food.nutrients.FAT+" Proteine: "+json.hints[i].food.nutrients.PROCNT;
               contenitore.appendChild(nutrienti); 
            }
            const ListaPrima= document.querySelectorAll("#Attività div");
    console.log(ListaPrima[1].childNodes[1]);
    
    for (const box of ListaPrima) {        //per aggiungere dentro lista1 tutti gli elementi selezionati in precedenza
  
      box.addEventListener('click',selezionato1);  
      
    }
    }
    

}



//----------PER LA RICERCA --------------------

function fetchResponse(response){
    if(!response.ok)return null;
    return response.json();
    
}

function search(event){
    event.preventDefault();
    const risultato = document.querySelector('#Attività');
    risultato.innerHTML='';
    
    const prodotto=document.querySelector('#prodotto');
    
    /*
    const risultato = document.querySelector('header');
    const errore = document.createElement('h1'); */
    /*errore.id='Errore2';*/
    /*risultato.innerHTML='';*/
    
     if (prodotto.value.length === 0 || prodotto.value===" "){
         console.log('Ciao');
         console.log(prodotto);
         const errore=document.createElement("h1");
         errore.textContent="Inserire Prodotto";
         risultato.appendChild(errore); 
         
         
      }else{
          
          //--IMPORTANTE: se io passo nel url una stringa cn spazio da errore quindi devo sostituire tuttu gli spazi con %20 nel URL
          var prod=prodotto.value;  // prendo la stringa che mi interessa cioè quella scritta dall'utente
          console.log(prodotto.value);
          var replaced = prod.replace(" ", "%20");  //Qui grazie alla funzione REPLACE sostituisco tutti gli spazi con %20 
                                                    // Così nell'URL passo la stringa con lo spazio con %20
          
          fetch("RicercaSpecifica.php?q="+encodeURIComponent(replaced)).then(fetchResponse).then(jsonRicerca);
      }
      //una fetch deve tornare sempre un JSON quindi dentro il php deve esserci un echo il risultato tornato che sara il JSON
    
}


const form =document.querySelector('#Prodotti');
form.addEventListener('submit', search);