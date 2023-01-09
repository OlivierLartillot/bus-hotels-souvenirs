console.log('form : init');

let myForm = document.querySelector('form');
myForm.addEventListener('click', handleClick);
//myForm.addEventListener('change', handleChange);
let date = document.querySelector('#date');
//console.log(date.value);

// div des étapes
let preStep = document.querySelector('#preStep');
let secondStep = document.querySelector('#secondStep');
let thirdStep = document.querySelector('#thirdStep');

// les boutons
let divNextStepButton = document.querySelector('#divNextStepButton');
let divLastStepButton = document.querySelector('#divLastStepButton');

// buttons
let nextStepButton = document.querySelector('#infos_client1_nextStep');
let lastStepButton = document.querySelector('#infos_client1_lastStep');




// appel pour chaque étpae du formulaire
function handleClick (event) {

 console.log('l evenement est : ', event.target.id);
    let selectHotel = document.querySelector('#infos_client1_bus')
   
    // on vérifie qu'on ait bien cliqué sur un hotel valide
    // pour afficher / retirer le bouton de nextStep
    if (event.target.id === 'infos_client1_bus') {
        if (selectHotel.value == "") {
            divNextStepButton.classList.add('d-none');
        }
        else {
            divNextStepButton.classList.remove('d-none');
        }
    }

    // si on a cliqué sur bouton nextStep 
    // on d-none le 1er step et on affiche le second
    if ( event.target.id === 'infos_client1_nextStep')   {
        if (selectHotel.value != "") {        
            preStep.classList.add('d-none')
            secondStep.classList.remove('d-none')
        }

    }
    if ( event.target.id === 'infos_client1_day')   {
        divLastStepButton.classList.remove('d-none')
    }

    if ( event.target.id === 'infos_client1_lastStep')   {
        secondStep.classList.add('d-none')
        thirdStep.classList.remove('d-none')
    }
    

}

// fonction d affichage des checkboxes choisies
function ajoutQuads () {

    // recupère toutes les checkbox du groupe 1 
        let grpe1 = document.querySelectorAll('.grpe1');

    // si tu t arretes sur une checkbox check tu la rajoutes dans le Ul du Tour1
        let i = 0;
        while (i < grpe1.length) {
           
           
            if (grpe1[i].checked === true ) {
                console.log(grpe1[i].value);
               
                if ( grpe1[i].value === '100') {tour1.innerHTML += '<li>&#127949 Buggy Doble</li>' ; }
                else if ( grpe1[i].value === '101') {tour1.innerHTML += '<li>&#127949 Buggy Familiar</li>' ; }
                else {tour1.innerHTML += '<li>&#127949; #' + grpe1[i].value + '</li>' ; } 
                
            }
            i++;
        }

    // recupère toutes les checkbox du groupe 2
        let grpe2 = document.querySelectorAll('.grpe2');
        i = 0;
        while (i < grpe2.length) {
        if (grpe2[i].checked === true ) {
            console.log(grpe2[i].value);

            if ( grpe2[i].value === '100') {tour2.innerHTML += '<li>&#127949 Buggy Doble</li>' ; }
            else if ( grpe2[i].value === '101') {tour2.innerHTML += '<li>&#127949 Buggy Familiar</li>' ; }
            else {tour2.innerHTML += '<li>&#127949; #' + grpe2[i].value + '</li>' ; } 
        }
            i++;
        }
    // recupère toutes les checkbox du groupe 2
        let grpe3 = document.querySelectorAll('.grpe3');
        i = 0;
        while (i < grpe3.length) {
        if (grpe3[i].checked === true ) {
            console.log(grpe3[i].value);

            if ( grpe3[i].value === '100') {tour3.innerHTML += '<li>&#127949 Buggy Doble</li>' ; }
            else if ( grpe3[i].value === '101') {tour3.innerHTML += '<li>&#127949 Buggy Familiar</li>' ; }
            else {tour3.innerHTML += '<li>&#127949; #' + grpe3[i].value + '</li>' ; } 

        }
            i++;
        }  


} // fin ajout quads

// fonction de suppression des checkboxes choisies 
// grpe1 grpe2 ou grpe3
// tour1 tour2 tour3

function suppressionQuads() {
               tour1.innerHTML = '' ;     
               tour2.innerHTML = '' ;
               tour3.innerHTML = '' ;  
    
 
} // fin suppression quads

