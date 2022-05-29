/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validazione(event){
   if(form.email.value.length === 0 || form.password.value.length === 0){
       header.textContent='Compilare tutti i campi !';
       risultato.appendChild(header);
       
       //Blocchiamo l'invio al server
       event.preventDefault();
   } 
}

//Selezioniamo il form
let form = document.forms['login'];
form.addEventListener('submit',validazione); 

const risultato = document.querySelector('#Errore');
const header = document.createElement('h1');

