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

- `feature/homepage` : Développement de la page d'accueil.
- `feature/menu` : Développement du menu de navigation.
- `feature/services-overview` : Développement de la vue globale des services.
- `feature/habitats-overview` : Développement de la vue globale des habitats.
- `feature/reviews` : Implémentation du système d'avis des visiteurs.
- `feature/admin-space` : Création de l'espace administrateur.
- `feature/employee-space` : Création de l'espace employé.
- `feature/vet-space` : Création de l'espace vétérinaire.
- `feature/authentication` : Mise en place du système de connexion.
- `feature/contact-form` : Développement du formulaire de contact.
- `feature/stats` : Implémentation des statistiques de consultation des animaux.
- `feature/deployment` : Préparation et documentation du processus de déploiement.
- `feature/documentation` : Rédaction de la documentation du projet.
- `feature/testing` : Mise en place des tests unitaires et d'intégration.
- `feature/ui-design` : Développement des maquettes et intégration de la charte graphique.
- `feature/optimizations` : Mises à jour et optimisations globales du projet.

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

Les détails du processus de déploiement sont décrits dans la branche `feature/deployment`. Ce processus inclut les étapes nécessaires pour déployer l'application sur une plateforme cloud telle que Heroku, Vercel, ou Azure.

## Installation

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

### Structure du projet

- **`/assets`** : Contient les fichiers CSS, JS, et images.
- **`/classes`** : Contient les classes PHP pour la logique métier.
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

## Contribuer

Merci de suivre les lignes directrices du projet pour contribuer :

- **Fork** le dépôt et créez une nouvelle branche pour chaque fonctionnalité ou correctif.
- **Testez** vos changements avant de créer une Pull Request.
- **Soumettez** une Pull Request lorsque votre branche est prête à être revue.

## Auteurs

- **Virginie FUSTER PEREZ** - Développeur Principal

## Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE.md](LICENSE.md) pour plus de détails.

## Gestion des Tâches avec Trello

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

