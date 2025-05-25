# NomDuProjet

Conception d'un Site Web pour un Professeur développée avec **Laravel** et utilisant **MySQL** comme base de données.

## Description

Ce site est un site web dynamique servant de portfolio académique pour un professeur,avec gestion de cours, partage de ressources et interaction avec les étudiants.

## Fonctionnalités

- Authentification des utilisateurs (Etudiant, Professeur).
- Création, modification et suppression de (Publications, cours, Messages, des QCM , des ressources pdf ou images) 
- Intégration de MySQL pour la gestion des données

## Technologies utilisées

- **Framework** : Laravel 10
- **Langage** : PHP 8.2.12
- **Base de données** : MySQL
- **Front-end** : Blade / Bootstrap. 
- **Autres** : Composer, Artisan 

## Installation

### 1. Cloner le projet

git clone https://github.com/AbdelkbirNA/projet_web.git
cd projet_web 


### 2. Configuration du fichier .env 

Configurer la connexion MySQL :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projetDev
DB_USERNAME=root
DB_PASSWORD=

### 3.Importation de la base de donnees (projetDev) : 
Le fichier exist dans le dossier base de donnees dans le projet 

### 4. Pour lancer le serveur
php artisan serve



### Des donnees pour le test (des donnees existe dans la base de donnees): 

--> compte etudiant : email : farah@gmail.com  password: 123zineb

--> compte professeur : email : zineb@gmail.com   password: 123zineb