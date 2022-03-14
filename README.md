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

Les technologies utilisées sont Symfony, Doctrine, Twig, Bootstrap, Jquery, Javascript, PHP, HTML, CSS, MySQL, Git,
GitHub.

## Installation

Pour installer et utiliser le projet, il faut suivre les étapes suivantes :

- D'abord il faut avoir un compte GitHub et accéder au repository suivant afin de télécharger le
  projet : [GestionLocations](https://github.com/Nirdeo/GestionLocations)
- Puis, il faut ouvrir le projet dans le terminal et exécuter la commande suivante : `composer install`
- Ensuite, il faut créer une base de données et un utilisateur avec les droits nécessaires pour l'utiliser.
- Puis, il faut se connecter à la base de données et exécuter la commande
  suivante : `php bin/console doctrine:schema:update --force`
- Enfin pour démarrer le projet, il faut exécuter la commande suivante : `php bin/console server:run`
- Après avoir démarré le serveur, il faut se connecter à l'adresse suivante : `http://localhost:8000`
- Et pour finir, il faut se connecter avec les identifiants fournis afin d'accéder à l'application.
- Pour stopper l'application, il faut exécuter la commande suivante : `php bin/console server:stop`
