//--------- GESTISCI LA LISTA DA SELEZIONARE -----------------

//Seleziono gli elementi del div e li inserisco in un form che poi invio tramite fetch con metodo post al server

let container=0;    //Per capire il div selezionato

function jsonCheckDelete(json){
    //Qui posso sistemare tutti i json che ritorno in base all'immagine selezionata
console.log(json);

//Per eliminare tutto il div selezionato
container.parentNode.removeChild(container);

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
    
    
    fetch('DeleteFood.php', {
      method: 'post',
      body: form_data
    }).then(fetchResponse).then(jsonCheckDelete);
}

function fetchResponse(response){
    if(!response.ok)return null;
    return response.json();
    
}

//Aggiungere il click a tutti i div dentro la section, per eliminarli

const ListaPrima=[];
const section =document.querySelector('#dieta');
const test=section.querySelectorAll("div");

console.log(test);

for(let i=0; i<test.length; i++){
    test[i].addEventListener('click',selezionato1);
}

