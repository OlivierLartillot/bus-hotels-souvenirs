# bus-hotels-souvenirs

<strong>Il n'est pas permis de tester l'application avec de vrai nom/prénom ou numéro de téléphone car l'admin est disponible et donc les informations susceptibles d'être visibles</strong>

Si vous voulez tester l'appli veuillez entrer ces identifiants:
  - Nom prénom : John Doe
  - Téléphone: 0000000000
  - L'envoi de whatsApp ouvre whatApp sur votre téléphone

## Fonctionnement

### Utilisateur

1. Le client choisi sa langue parmis: anglais / francais / espagnol / russe
2. Le client peut réserver un bus en indiquant ces informations personnelles

https://bhs.fanteam.fr/

### Admin

- j'accède au dashboard et je vois les rappel encore restant à renvoyer
- je peux aller voir la liste des clients et/ou modifier des informations, 
 https://bhs.fanteam.fr/admin 

## Stack utilisée - symfony

### Easy admin

Belle vidéo sur easy admin:
https://www.youtube.com/watch?v=ze6XJTACo1s&t=1879s

### date format
https://unicode-org.github.io/icu/userguide/format_parse/datetime/#datetime-format-syntax

### translation
composer install de la translation symfony


php bin/console translation:extract --force fr
