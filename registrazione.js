/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validazione(event){
   if(form.nome.value.length === 0 || form.cognome.value.length === 0 || form.email.value.length === 0 ||form.password.value.length === 0 || form.conferma.value.length === 0 ){
       header.textContent='Compilare tutti i campi !';
       risultato.appendChild(header);
       
       //Blocchiamo l'invio al server
       event.preventDefault();
   } 
}

//Selezioniamo il form
let form = document.forms['regi'];
form.addEventListener('submit',validazione); 

const risultato = document.querySelector('#Errore');
const header = document.createElement('h1');




/*--------PER VEDERE SE EMAIL CORRETTA LATO SERVER-------------*/

function jsonCheckMail(json){
    console.log(json);
    
    const risultato = document.querySelector('#contenitore');
    const header = document.createElement('h1'); 
    header.id='Errore2';
    
    risultato.innerHTML='';
    
    if(json.exists == true){
        header.textContent="E-mail già esistente";
        risultato.appendChild(header); 
    }
}

function fetchResponse(response){
    if(!response.ok)return null;
    return response.json();
    
}

function checkMail(event){
    const email=document.querySelector('#Mail');
    const risultato = document.querySelector('#contenitore');
    const header = document.createElement('h1'); 
    header.id='Errore2';
    risultato.innerHTML='';
    
     if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
         console.log('Ciao');
         console.log(email);
         header.textContent="E-mail non valida";
         risultato.appendChild(header); 
         
         
      }else{
          fetch("check_mail.php?q="+encodeURIComponent(email.value)).then(fetchResponse).then(jsonCheckMail);
      }
      
    
}


document.querySelector('#Mail').addEventListener('blur', checkMail);




/*--------PER VEDERE SE PASSWORD CORRETTA LATO SERVER-------------*/

function jsonCheckPass(json){
    const errore1=document.querySelector('#min');
    const errore2=document.querySelector('#spec');
    
    errore1.style.color= 'white';
    errore2.style.color= 'white';
    
    console.log(json);
    
    if (json==="speciali"){
         errore2.style.color= 'Red';
    }
}



function checkPass(event){
    const pass=document.querySelector('#Pass');
    const risultato = document.querySelector('#contenitore');
    const header = document.createElement('h1'); 
    header.id='Errore2';
    risultato.innerHTML='';
    const errore1=document.querySelector('#min');
    const errore2=document.querySelector('#spec');
    
    errore1.style.color= 'white';
    errore2.style.color= 'white';
    
     if (!/[\$\@\#\!\?\*\+\.\&\%\(\)\_\:\,\;\/\|\=\-\']+/i.test(pass.value) && pass.value.length<6){
         
         errore1.style.color= 'Red';
        
         errore2.style.color= 'Red';
         
         
      }else if (pass.value.length<6){

        
         errore1.style.color= 'Red';
         
         
         
      }else if (!/[\$\@\#\!\?\*\+\.\&\%\(\)\_\:\,\;\/\|\=\-\']+/i.test(pass.value)){

         console.log(pass.value);
         errore2.style.color= 'Red';
         
         
         
      }else{
          fetch("checkPassword.php?q="+encodeURIComponent(pass.value)).then(fetchResponse).then(jsonCheckPass);
      }
      
    
}


document.querySelector('#Pass').addEventListener('blur', checkPass);


/*--------PER VEDERE SE NOME E COGNOME SONO CORRETTI -------------*/
//non c'è bisogno fare la fetch 


function checkNome(event){
    const nome=document.querySelector('#nome');
    
    const risultato = document.querySelector('#contenitore');
    const header = document.createElement('h1'); 
    header.id='Errore2';
    risultato.innerHTML='';
    
     if (!/^[a-zA-Z0-9_]{1,15}$/.test(nome.value)){
         header.textContent="Nome non valido";
         risultato.appendChild(header);   
      }
    
}


function checkCognome(event){
    const cognome=document.querySelector('#cognome');
    
    const risultato = document.querySelector('#contenitore');
    const header = document.createElement('h1'); 
    header.id='Errore2';
    risultato.innerHTML='';
    
     if (!/^[a-zA-Z0-9_]{1,15}$/.test(cognome.value)){
         header.textContent="Cognome non valido";
         risultato.appendChild(header);   
      }
    
}
document.querySelector('#nome').addEventListener('blur', checkNome);
document.querySelector('#cognome').addEventListener('blur', checkCognome);