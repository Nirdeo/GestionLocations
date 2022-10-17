# GestionLocations

PPE Symfony réalisé par Maxime Etryhard et Victor De Domenico

## Description

Un client loue plusieurs appartements sur AirBnB. Plusieurs mandataires travaillent pour lui pour gérer les locations et
leur inventaire. Afin d’en simplifier leur gestion, il souhaite réaliser une plateforme pour gérer l’inventaire de ses
biens. Le but est de développer un site internet permettant de simplifier la gestion de locations AirBnB et de leur
inventaire.
(Les mandataires gèrent les résidences, les locataires sont associés à des locations, une location est une réservation à
une date d'une résidence)

## Répartition des fonctionnalités

Maxime développe la partie connexion, gestion des mandataires et gestion des biens. Victor s'occupe de la partie gestion
des locataires et gestion des locations.

## Technologies utilisées

    * Symfony
    * Doctrine
    * Twig
    * Bootstrap
    * jQuery
    * FontAwesome
    * JavaScript
    * PHP
    * HTML
    * CSS
    * SQL
    * Git
    * GitHub
    * Apache
    * MariaDB
    * Phpmyadmin
    * Adobe XD
    * MySQL Workbench
    * Visual Studio Code
    * Phpstorm

## Installation

Pour installer et utiliser l'application, il faut suivre les étapes suivantes :

- D'abord il faut avoir un compte GitHub et accéder au repository suivant afin de télécharger l'application : [GestionLocations](https://github.com/Nirdeo/GestionLocations)
- Puis, il faut exécuter la commande suivante dans un terminal à la racine du projet : `composer install`
- Ensuite, après avoir démarré le serveur Apache et le service MySQL il faut créer une base de données avec la commande
  suivante : `php bin/console doctrine:database:create`
- Puis, pour créer les tables de la base de données il faut exécuter la commande
  suivante : `php bin/console doctrine:schema:update --force`
- Et pour insérer les données de tests il faut exécuter la commande suivante : `php bin/console doctrine:fixtures:load`
- Enfin pour démarrer l'application, il faut exécuter la commande suivante : `symfony server:start`
- Après avoir démarré le serveur, il faut se connecter à l'adresse suivante : `http://localhost:8000`
- Et pour finir, il faut se connecter avec les identifiants fournis afin d'accéder à l'application.
- Pour stopper l'application, il faut exécuter la commande suivante : `symfony server:stop`
