console.log('form : init');

/**** EVENTS LISTENER ********/ 
let myForm = document.querySelector('form');
myForm.addEventListener('click', handleClick);

let choosingDay = document.querySelector('#infos_client1_day');
choosingDay.addEventListener('change', handleChangeDay);

let choosingPersonsNumber = document.querySelector('#infos_client1_numberPersons');
choosingPersonsNumber.addEventListener('change', handleChangePersonsNumber);

/************************************************************/

/******** SELECTORS ***********/ 
let date = document.querySelector('#date');
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

/************************************************************ --- ************************************************************/

/******** FUNCTIONS ***********/ 

// écoute le changement sur la datePicker pour validation
function handleChangeDay(event) {

    console.log('we are onchange')

    // validation du jour
    if (event.target.id == 'infos_client1_day') {
    console.log('event target onchange: ' + event.target.id);

        let datePicker = document.querySelector('#infos_client1_day')
        let date = new Date(datePicker.value);
        const dateNow = new Date();        
        let formatDate = date.getFullYear() + '' + date.getMonth() + '' +date.getDate()
        let formatDateNow = dateNow.getFullYear()+ '' + dateNow.getMonth()+ '' +dateNow.getDate()

            // 0 = dimanche, si le jour est dimmanche
            // on affiche le message d erreur et on supprime le bouton continuer
            if (date.getDay() == 0) {
                event.target.value  = ''
                divLastStepButton.classList.add('d-none')
                document.querySelector('#infos_client1_day_help').classList.remove('d-none')
                document.querySelector('#infos_client1_same_day_help').classList.add('d-none')
            }
            // si la date est égale a aujourdhui
            // on affiche le message d'erreur et on enleve le bouton continuer
            else if (formatDate == formatDateNow) {
                divLastStepButton.classList.add('d-none')
                document.querySelector('#infos_client1_same_day_help').classList.remove('d-none')
                document.querySelector('#infos_client1_day_help').classList.add('d-none')
                console.log('vous ne pouvez pas choisir la date du jour')
            }
            // sinon on peut continuer
            else {
                document.querySelector('#infos_client1_day_help').classList.add('d-none')
                document.querySelector('#infos_client1_same_day_help').classList.add('d-none')
                divLastStepButton.classList.remove('d-none')
            }
    }    
}

// écoute le changement sur le nombre de personnes pour validation
function handleChangePersonsNumber (event) {

    if (event.target.id == 'infos_client1_numberPersons') {

        let number = document.querySelector('#infos_client1_numberPersons').value;
        console.log(number > 19)
        // error
        if (number > 19) {
            // on affiche le message d'erreur
            document.querySelector('#infos_client1_numberPersons_help').classList.remove('d-none')
            // si le chiffre n est pas bon, on vire le submit
            document.querySelector('#infos_client1_validate').classList.add('d-none')
        }
        else {
            document.querySelector('#infos_client1_numberPersons_help').classList.add('d-none')
            // on vire le message d erreur
            document.querySelector('#infos_client1_validate').classList.remove('d-none')
            // si le chiffre est bon on remet le submit
        }
    }
}

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
/*     if ( event.target.id === 'infos_client1_day')   {
        divLastStepButton.classList.remove('d-none')
    } */

    if ( event.target.id === 'infos_client1_lastStep')   {
        secondStep.classList.add('d-none')
        thirdStep.classList.remove('d-none')
    }
}
