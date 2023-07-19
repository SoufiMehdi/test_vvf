
# Teste entretien pour VVF

## Enoncé du test
Création d'un formulaire de demande avec :
- Objet de la demande
- Texte de la demande
- Email du demandeur

L'email doit être unique. Un demandeur peut faire plusieurs demandes.
À la soumission du formulaire, en plus d'enregistrer la demande. Un mail doit être envoyé, le destinataire doit être paramétrable.
Vous devez utiliser le framework symfony.


## Authors

- Soufi Mahdi



## Tech Stack

**Symfony 6.3** 

**postgres** 

**docker** 

**Bootstrap 5.4**


## Environment Variables BDD

`POSTGRES_PASSWORD: main
      POSTGRES_USER: main
      POSTGRES_DB: main`


## Installation

```bash
  composer install
  npm install
  docker-compose up 
  symfony console doctrine:migrations:migrate
```
## Demmarer app

```bash
  symfony server:start 
  npm run watch
```
## Test


## Creer user admin

    