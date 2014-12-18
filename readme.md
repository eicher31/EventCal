
## EventCal

Le but du projet EventCal est de proposer un calendrier publique d'événements annoncés par des sociétés.
Le calendrier liste les événements futurs, regroupés par mois. Les événements sont publiés dans des catégories, qui permet une identification rapide par code couleur (par exemple, fête de village). 

Les visiteurs du site ont accès au calendrier des événements, à la liste des sociétés inscrites ainsi qu'aux détails de chaque société (par exemple, description ou site web de la société).

Les sociétés qui souhaitent publier leurs événements doivent préalablement s'inscrire. Les inscriptions sont validées par un administrateur, pour éviter les abus.

### Fonctionnalités

Le projet est développé avec le Framework PHP Laravel. Le Framework Javascript jQuery est utilisé pour les parties dynamiques, avec différents plugins si nécessaire. La partie design est réalisée avec le Framework CSS Bootstrap.

**Visiteur**

* Regarder le calendrier des évènements 

* Voir la liste des sociétés, ainsi que le détail de chaque société

* Inscription en tant que société

**Membre**

* Autentification

* Gérer ses évènements

 * Publier un évènement dans une catégorie
 * Mettre à jour un évènement
 * Suprimer un évènement

* Gérer son compte 
 * Voir son profil
 * Modifier ses informations

**Administrateur**

* Gérer les comptes des utilisateurs
 * Activer un compte 
 * Editer un compte
 * Supprimer un compte

* Gérer les évènements des utilisateurs
 * Créer un événement pour une société
 * Modifier un événement
 * Supprimer un événement

* Gérer les catégories des évènements
 * Créer/éditer une catégorie
 * Supprimer une catégorie si elle n'est pas "utilisée" pour un événement
