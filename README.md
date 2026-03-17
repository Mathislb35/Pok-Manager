# 🧬 PokeManager

PokeManager est une application web développée avec **Laravel** permettant de consulter un Pokédex complet et de créer des **decks personnalisés de Pokémon**.

Les utilisateurs peuvent parcourir la liste des Pokémon, filtrer les résultats, consulter leurs caractéristiques et les ajouter à des decks personnalisés avec un nombre d’exemplaires défini.

Ce projet a été réalisé dans le cadre d’un exercice de développement web avec **Laravel**, en mettant l’accent sur la gestion des données, l’architecture MVC et la conception d’une interface responsive.

---

# 📚 Objectifs du projet

L’objectif de cette application est de permettre :

- la **consultation d’un Pokédex**
- la **gestion de decks de Pokémon**
- l’**administration des données**
- la **gestion des utilisateurs**

Le projet respecte les contraintes suivantes :

- développement **solo**
- utilisation du **framework Laravel**
- gestion du projet via **Git**
- interface **responsive**
- architecture **MVC propre**

---

# ⚙️ Technologies utilisées

### Backend
- ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
- ![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
- **Eloquent ORM**

### Frontend
- ![Blade](https://img.shields.io/badge/Blade-FC4F4F?style=for-the-badge&logo=laravel&logoColor=white)
- ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
- ![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
- ![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)

### Authentification
- **Laravel Breeze**

### Données
- Dataset Pokémon provenant de **Kaggle**

---

# 🧩 Fonctionnalités

## 🔍 Consultation des Pokémon

Tout utilisateur peut :

- parcourir la liste complète des Pokémon
- voir leurs statistiques
- consulter leur type
- accéder à la fiche détaillée d’un Pokémon

La liste inclut :

- pagination
- affichage responsive
- cartes Pokémon avec statistiques

---

## 🎯 Filtrage des Pokémon

Les utilisateurs peuvent filtrer les Pokémon selon différents critères :

- **Type de Pokémon**
- **Recherche par nom**
- autres critères possibles selon l’évolution du projet

---

## 🧑‍💻 Gestion des utilisateurs

L'application permet :

- création d’un compte
- connexion
- déconnexion

Les comptes sont gérés via **Laravel Breeze**.

---

# 🃏 Gestion des Decks

Les utilisateurs connectés peuvent créer et gérer leurs propres decks.

Un deck représente une **collection personnalisée de Pokémon**.

Fonctionnalités :

- créer un deck
- modifier un deck
- supprimer un deck
- voir la liste de ses decks

Chaque deck est **privé** et appartient uniquement à son propriétaire.

---

## ➕ Ajouter des Pokémon à un deck

Depuis la fiche d’un Pokémon, un utilisateur peut :

- choisir un deck
- ajouter ce Pokémon au deck

Il est également possible de :

- définir **le nombre d’exemplaires d’un Pokémon**
- modifier ce nombre
- supprimer le Pokémon du deck

---

# ⚙️ Installation

1. Cloner le dépôt :
```
git clone https://github.com/ton-username/pokemanager.git
cd pokemanager/pockedeck
```
2. Installer les dépendances backend :
```composer install```
3. Installer les dépendances frontend :
```npm install```
4. Générer la clé de l'application :
```php artisan key:generate```
5. Configurer la base de données dans le fichier `.env`
6. Lancer les migrations et seeders : ```php artisan migrate --seed```

---

# 🚀 Lancement

1. Lancer le serveur Laravel :
```
php artisans serve
```
2. Lancer le serveur frontend (Vite):
```
npm run dev
```
3. Accéder à l'applcation :
```
http://127.0.0.1:8000
```

---

# 🗂 Structure du projet

Le projet suit l’architecture MVC de Laravel :

```
Pokemanager/
pokedeck/
│
├── app/
│ ├── Http/
│ │ ├── Controllers/ # Contrôleurs de l'application
│ │ │ ├── PokemonController.php
│ │ │ ├── DeckController.php
│ │ │ ├── TypeController.php
│ │ │ └── ProfileController.php
│ │ ├── Auth/ # Fichier d'authenfication Breeze
│ │ │
│ │ └── Middleware/
│ │
│ └── Models/ # Modèles Eloquent
│ ├── Pokemon.php
│ ├── Deck.php
│ ├── Type.php
│ └──  User.php
│ 
├── bootstrap/
│
├── config/ # Configuration Laravel
│
├── database/
│ ├── migrations/ # Création des tables
│ ├── seeders/ # Remplissage automatique de la base
│ └── factories/
│    └── UserFactory.php
│
├── data/
│ └── csv/ # Dataset Pokémon provenant de Kaggle
│
├── public/ # Fichiers publics (images, index.php)
│
├── resources/
│ ├── css/
│ ├── js/
│ │
│ └── views/ # Templates Blade
│ ├── layouts/
│ │ ├── app.blade.php
│ │ └── navigation.blade.php
│ │
│ ├── pokemons/
│ │ ├── index.blade.php
│ │ ├── show.blade.php
│ │ ├── create.blade.php
│ │ └── edit.blade.php
│ │
│ ├── decks/
│ │ ├── index.blade.php
│ │ ├── show.blade.php
│ │ └── edit.blade.php
│ │
│ └── auth/ # Vues générées par Laravel Breeze
│
├── routes/
│ ├── web.php # Routes principales
│ └── auth.php # Routes d'authentification
│
├── storage/
│
├── tests/
│
└── .env.example
├── composer.json
├── package.json
└── README.md
```

---

# 🚧 Améliorations possibles

- Création de pokémons personnalisés
- Ajout de filtres avancés (stats, génération, etc.)
- Système de partage de decks entre utilisateurs
- Ajout d’images officielles via API
- Optimisation des performances (lazy loading, cache)
- Ajout de tests automatisés
- Amélioration de l’UI/UX (animations, transitions)

---

# 👤 Auteur

**Mathis Lebreton-Béchu**
`Étudiant en Bachelor Développeur Web`

🔗 GitHub : https://github.com/Mathislb35

---

# 📄 Licence

Ce projet est réalisé dans un cadre pédagogique et n’a pas vocation à être utilisé en production.
