# Les lieux culturels en IDF 🎬

[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.0-7952B3.svg)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow.svg)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![jQuery](https://img.shields.io/badge/jQuery-3.6.3-blue.svg)](https://jquery.com/)
[![Leaflet](https://img.shields.io/badge/Leaflet-1.7.1-199900.svg)](https://leafletjs.com/)
[![PostGIS](https://img.shields.io/badge/PostGIS-3.2.1-blue.svg)](https://postgis.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1.svg)](https://www.mysql.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4.3-blue.svg)](https://www.php.net/)
[![Open Source](https://img.shields.io/badge/Open%20Source-Yes-brightgreen.svg)](LICENSE.md)
[![Build By](https://img.shields.io/badge/Build%20By-Althéa_Feuillet-orange.svg)](https://yourportfolio.com)
[![En Cours de Modification](https://img.shields.io/badge/En%20Cours%20de%20Modification-Oui-green.svg)](LICENSE.md)


# Présentation

Ce site est dédié à la cartographie des données culturelles en Ile-de-France.

Trois catégories d'informations sont mises en avant sur la carte :
1. Les communes d'IDF
2. Les salles de cinémas d'IDF
3. Les hôtels d'IDF

Pour explorer ces données, l'utilisateur doit se connecter ou s'inscrire.

Une fois connecté, l'utilisateur peut :

- Visualiser les communes avec plus de 5 cinémas
- Afficher les communes ayant moins de deux commerces
- Explorer les communes avec plus de 20 hôtels 4 ⭐
- Voir les communes avec moins de 15 hôtels 3 ⭐ et moins de 5 cinémas

## Composition du Projet

La structure du projet est organisée pour assurer une gestion efficace du code source :

### Dossier "data"
Ce dossier contient l'ensemble des données utilisées dans la base de donnée.

### Dossier "get_data"
Le répertoire "get_data" comporte les scripts PHP dédiés à l'extraction des données depuis la base de données, garantissant un processus de récupération.

### Dossier "php-map"
Ce dossier comporte les scripts de gestion de l'initialisation de la carte ainsi que l'appel et l'affichage des données.

# Installation

La mise en place de votre environnement de développement web est une étape cruciale pour faire fonctionner ce projet. Actuellement, j'utilise WAMP, mais vous avez également la possibilité d'opter pour d'autres solutions telles que XAMPP, en fonction de vos préférences.

Pour obtenir le code source du projet, vous avez deux options : télécharger manuellement les fichiers ou utiliser la ligne de commande Git. Si vous choisissez la seconde option, exécutez la commande suivante dans l'interpréteur git :

```bash
git clone https://github.com/altheaFeu/cultural-places-IDF.git
```

# Gestion de la Base de Données

L'utilisation de ce projet nécessite un serveur MySQL. Dirigez-vous vers le fichier `config.php` et ajustez la variable `$bdd` en fonction des paramètres de votre base de donnée :

```php
$bdd = new PDO('mysql:host=localhost;dbname=your-database;charset=utf8', 'you-user', 'your-password');
```

Assurez-vous que votre base de données comprend les tables suivantes :
- **Utilisateurs**, avec les colonnes "identifiant" et "mot de passe" de types de données appropriés.

Voici comment vous pourriez créer cette table : 
```sql
CREATE TABLE Utilisateurs (
    id SERIAL PRIMARY KEY,
    identifiant VARCHAR(5) UNIQUE NOT NULL CHECK (identifiant ~ '^[0-9]{5}$'),
    password VARCHAR(255) NOT NULL
);
```

Vous aurez également besoin des tables **hotels**, **communes**, et **cinemas** qui sont incluses dans le dossier "data".

Avant de procéder, installez PostGIS et ajoutez l'extension à votre base de données. Pour ce faire, connectez-vous à votre base de données psql avec la commande :

```bash
psql -U <username> -d <database_name> -h <hostname> -p <port>
```

Ensuite, ajoutez l'extension PostGIS en exécutant la commande SQL appropriée.

Vous pourrez convertir et importer les fichiers SHP correspondant aux tables **hotels**, **communes**, et **cinemas** de la manière suivante :

```bash 
shp2pgsql -I -s <SRID> -g <geometry_column_name> <shapefile_name> <table_name> | psql -d <database_name> -U <username>
```
