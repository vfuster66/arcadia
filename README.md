# Arcadia Project

## Description

Arcadia est un projet de développement web pour un zoo situé en France. L'application permet aux visiteurs de consulter des informations sur les animaux, les habitats, et les services offerts par le zoo. Elle inclut également des espaces dédiés aux vétérinaires, employés, et administrateurs pour la gestion des données du zoo.

## Structure des Branches

Notre projet utilise une gestion des branches basée sur les conventions suivantes :

### Branches principales
- **main** : Branche de production stable.
- **dev** : Branche de développement où toutes les nouvelles fonctionnalités sont intégrées et testées avant d'être fusionnées dans `main`.

### Branches de fonctionnalités
Les branches de fonctionnalités sont dérivées de `dev` et suivent la convention de nommage `feature/*`. Voici les branches de fonctionnalités actuellement actives :

- `feature/US1-accueil` : Développement de la page d'accueil.
- `feature/US2-menu` : Développement du menu de navigation.
- `feature/US3-services` : Développement de la vue globale des services.
- `feature/US4-habitats-overview` : Développement de la vue globale des habitats.
- `feature/US6-admin` : Création de l'espace administrateur.
- `feature/US7-employe` : Création de l'espace employé.
- `feature/US8-veterinaire` : Création de l'espace vétérinaire.
- `feature/US10-contact` : Développement du formulaire de contact.
- `feature/db` : Implémentation de la base de données
- `feature/deployment` : Préparation et documentation du processus de déploiement.
- `feature/doc` : Rédaction de la documentation du projet.
- `feature/tests` : Mise en place des tests unitaires et d'intégration.

## Workflow Git

Nous suivons un flux de travail Git basé sur les branches principales et de fonctionnalités. Voici les étapes à suivre pour contribuer au projet :

1. **Créer une nouvelle branche de fonctionnalité à partir de `dev`** :
   ```bash
   git checkout dev
   git checkout -b feature/new-feature

2. **Développez et testez sur la branche de fonctionnalité** :
   
   - Effectuez vos changements et testez-les localement.

3. **Fusionnez la branche de fonctionnalité dans `dev` après validation** :

   ```bash
   git checkout dev
   git merge feature/new-feature

4. **Poussez les changements vers GitHub** :

   ```bash
   git push origin dev

5. **Lorsque dev est stable, fusionnez dans main pour le déploiement :** :

   ```bash
   git checkout main
   git merge dev
   git push origin main

## Processus de déploiement

Ce processus inclut les étapes nécessaires pour déployer l'application sur une plateforme cloud telle que Heroku.

### Prérequis

- Compte Heroku actif : [Créer un compte Heroku](https://signup.heroku.com/)
- Installer **Heroku CLI** : [Installation du Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli)

### Étapes de déploiement

1. **Connexion à Heroku** :

   Connectez-vous à votre compte Heroku avec la commande suivante :

   ```bash
   heroku login

2. **Création d'une application Heroku** :

   Créez une nouvelle application Heroku avec la commande suivante :

   ```bash
   heroku create arcadia-zoo-app

3. **Ajout de PostgreSQL** :

   Ajoutez PostgreSQL comme base de données pour votre application :

   ```bash
   heroku addons:create heroku-postgresql:hobby-dev

4. **Déploiement de l'application** :

   Assurez-vous que vous êtes sur la branche main et déployez l'application sur Heroku avec la commande suivante :

   ```bash
   git push heroku main

5. **Configuration des variables d'environnement** :

   Configurez les informations de connexion à la base de données et autres variables d'environnement :

   ```bash
   heroku config:set DATABASE_URL=<url_de_la_base_heroku>

6. **Accéder à l'application ** :

   Votre application est maintenant déployée et accessible à l'URL fournie par Heroku :

   ```bash
     https://arcadia-zoo-app.herokuapp.com

### Mise à jour de l'application

1. **Poussez vos changements vers la branche main** :

   ```bash
     git push origin main

2. **Déployez les modifications sur Heroku** :

   ```bash
     git push heroku main

## Installation locale

### Prérequis

- PHP 7.4 ou supérieur
- MySQL ou MariaDB
- Composer (pour la gestion des dépendances PHP)
- XAMPP ou MAMP (pour un environnement de développement local)

### Étapes d'installation

1. **Clonez le dépôt** :

   ```bash
   git clone https://github.com/vfuster66/arcadia.git
   cd arcadia

2. **Installez les dépendances PHP :** :

   ```bash
   composer install

3. **Configurez votre base de données** :

   - Créez une base de données MySQL.
   - Importez les fichiers SQL disponibles dans le dossier `database/` pour initialiser la base de données.

4. **Configurez le fichier `.env`** :

   - Renommez le fichier `.env.example` en `.env`.
   - Mettez à jour les informations de connexion à la base de données dans le fichier `.env`.

5. **Lancez le serveur localement** :

   - Utilisez XAMPP ou MAMP pour démarrer Apache et MySQL.
   - Accédez à votre projet à l'adresse `http://localhost/arcadia`.

## Documentation

## Identifiants de test

Pour tester les différents rôles dans l'application, vous pouvez utiliser les identifiants suivants :

| Rôle            | Email                 | Mot de passe  |
|-----------------|-----------------------|---------------|
| Administrateur  | admin@arcadia.fr       | admin123      |
| Employé         | employe@arcadia.fr     | employe123    |
| Vétérinaire     | veterinaire@arcadia.fr | vet123        |

### Structure du projet

- **`/public`** : Contient les fichiers CSS, JS, et images.
- **`/models`** : Contient les classes PHP pour la logique métier.
- **`/config`** : Fichiers de configuration pour la base de données, etc.
- **`/controllers`** : Fichiers PHP qui gèrent les requêtes et la logique d'application.
- **`/views`** : Templates HTML/PHP pour l'affichage des pages.
- **`/vendor`** : Dépendances PHP installées via Composer.

### Gestion de Projet

La gestion de projet se fait via un tableau Kanban partagé (Trello, Jira, ou Notion). Le tableau est organisé comme suit :

- **To Do** : Toutes les fonctionnalités prévues, classées par priorité.
- **In Progress** : Fonctionnalités actuellement en cours de développement.
- **Done** : Fonctionnalités terminées et intégrées dans `dev`.
- **Deployed** : Fonctionnalités déployées en production (fusionnées dans `main`).

## Gestion des Tâches avec Trello

Pour consulter l'avancement et la gestion des tâches, vous pouvez accéder à notre tableau Trello en suivant ce lien : 

[Trello - Arcadia](https://trello.com/invite/b/66b6862fc57d15a627c871f1/ATTI6fe0f5308e51aa7fe7d5debfb87405d86F01ABEB/arcadia)


### Organisation des Tâches dans Trello

Pour organiser et prioriser les tâches de développement du projet Arcadia, nous utilisons un tableau Trello structuré avec des étiquettes (labels) et des checklists. Voici comment ces outils sont utilisés pour gérer efficacement les tâches du projet.

### Étiquettes de Catégorisation

Les étiquettes de catégorisation indiquent la nature des tâches. Chaque tâche dans Trello est associée à une ou plusieurs des étiquettes suivantes :
- (Liste des étiquettes, comme expliqué précédemment)

### Étiquettes de Priorité

Les étiquettes de priorité permettent de distinguer les tâches critiques des tâches moins urgentes :
- (Liste des priorités, comme expliqué précédemment)

### Utilisation des Checklists

Pour chaque tâche principale, nous utilisons des checklists pour décomposer le travail en sous-tâches plus spécifiques et plus faciles à gérer. Voici comment les checklists sont utilisées dans notre projet :

1. **Décomposition des Tâches**
   - Chaque tâche principale dans Trello peut être décomposée en sous-tâches via une checklist. Par exemple, pour la tâche **US 1 : Page d'accueil**, la checklist pourrait inclure les éléments suivants :
     - Rédaction du contenu de la page
     - Sélection et optimisation des images
     - Conception de la mise en page en accord avec la charte graphique
     - Développement de la page en HTML/CSS
     - Test de l'affichage sur différents navigateurs

2. **Suivi de l'Avancement**
   - Les checklists permettent de suivre l'avancement des tâches en cochant les éléments au fur et à mesure qu'ils sont terminés. Cela donne une vue d'ensemble claire sur l'état de la tâche principale.
   - Lorsqu'une checklist est entièrement terminée, cela indique que la tâche principale est prête pour la validation ou le passage à l'étape suivante.

3. **Organisation des Checklists**
   - Les checklists peuvent être utilisées pour organiser le travail de manière séquentielle ou par catégorie, en fonction de la nature de la tâche. Par exemple :
     - Séquentielle : "Étape 1: Rédaction", "Étape 2: Conception", "Étape 3: Développement"
     - Par catégorie : "Contenu", "Design", "Développement", "Tests"

### Exemple d'Utilisation

Voici un exemple d'utilisation des checklists pour la tâche **US 1 : Page d'accueil** :

**Carte : US 1 : Page d'accueil**
- **Étiquettes** : `Front-End`, `Moyenne Priorité`
- **Checklist : Tâches pour la page d'accueil**
  - [ ] Rédiger le contenu de la page d'accueil
  - [ ] Sélectionner et optimiser les images du zoo
  - [ ] Concevoir la mise en page en accord avec la charte graphique
  - [ ] Développer la page en HTML/CSS
  - [ ] Tester l'affichage sur différents navigateurs et appareils

### Suivi et Gestion des Tâches

En utilisant à la fois les étiquettes et les checklists, nous pouvons :
- **Catégoriser** les tâches selon leur nature (Front-End, Back-End, etc.) et leur priorité (Haute, Moyenne, Basse).
- **Décomposer** les tâches principales en sous-tâches plus petites et plus gérables.
- **Suivre l'avancement** de chaque tâche principale grâce aux checklists, en cochant les éléments au fur et à mesure qu'ils sont terminés.

Pour toute contribution au projet, merci de suivre cette structure et d'utiliser les étiquettes et checklists appropriées dans Trello.

## Implémentation des tests

### Contexte

Dans ce projet, les tests unitaires et fonctionnels sont mis en place pour garantir la fiabilité des fonctionnalités critiques, notamment celles liées à l'authentification des utilisateurs et à la gestion des comptes administratifs. Ces tests sont exécutés à l'aide de PHPUnit, un framework de test pour PHP.

### Structure des tests

Les tests sont organisés de manière à couvrir les principaux composants de l'application :

1. Tests Unitaires
Les tests unitaires vérifient des fonctionnalités isolées, comme les méthodes des modèles de données (ex. : User). Ils simulent l'interaction avec la base de données et permettent de s'assurer que les opérations CRUD (Créer, Lire, Mettre à jour, Supprimer) fonctionnent correctement.

Exemple de tests :
- **Création d'utilisateur** : Vérifie qu'un utilisateur peut être créé avec des informations valides.
- **Mise à jour d'utilisateur** : Vérifie que les informations d'un utilisateur existant peuvent être mises à jour correctement.
- **Suppression d'utilisateur** : Vérifie que la suppression d'un utilisateur fonctionne correctement.

2. Tests Fonctionnels
Les tests fonctionnels vérifient le bon comportement de fonctionnalités plus complexes, comme le processus de connexion, en simulant l'ensemble du cycle de vie de la fonction (de la requête à la réponse).

Exemple de tests :
- **Connexion avec des identifiants corrects** : Vérifie qu'un utilisateur avec des identifiants valides peut se connecter et que les informations de session sont correctement initialisées.
- **Connexion avec des identifiants incorrects** : Vérifie que la tentative de connexion échoue avec des informations incorrectes et qu'un message d'erreur approprié est renvoyé.

### Gestion de la Base de Données pendant les Tests

Pour garantir l'intégrité des données lors de l'exécution des tests, chaque test utilise un mécanisme de transaction :

- Avant chaque test, une transaction est démarrée.
- À la fin de chaque test, la transaction est annulée (rollback), ce qui permet de réinitialiser l'état de la base de données.

Cela permet d'exécuter les tests de manière isolée, sans affecter les données réelles en production ou dans la base de données de test.

### Utilisation de Mocking dans les Tests

Dans les tests unitaires, l'injection de dépendances est utilisée avec la méthode `setUserModel()` pour remplacer les interactions avec la base de données par des objets mockés, permettant de tester la logique métier indépendamment du stockage des données.

### Exécution des Tests

Les tests peuvent être exécutés via PHPUnit en utilisant la commande suivante :

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
