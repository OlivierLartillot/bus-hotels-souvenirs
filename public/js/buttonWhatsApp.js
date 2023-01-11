/* 
 * Récupère tous les boutons qui ont la classe linkButton => les bouttons client et Commercante
 * Ouvre une autre fenetre pour le whatsapp
* apres un temps d'arret (pour laisser la bdd se mettre a jour), reload la page 
*/

let liens = document.querySelectorAll('.linkButton');

for (let lien of liens) {
    console.log('chaque lien : ' + lien)
    lien.addEventListener('click', handleClick);
}

    function handleClick (event) {
    
        var url = this.getAttribute('href');
        event.preventDefault();
        window.open(url);
        window.setTimeout(() => {
            location.reload(true);
        }, 2000);
        
    }   