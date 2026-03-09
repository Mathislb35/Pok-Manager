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
- **Laravel**
- **PHP**
- **SQLite / MySQL**
- **Eloquent ORM**

### Frontend
- **Blade**
- **TailwindCSS**
- **Vite**
- **Alpine.js**

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
    ├── Auth/ # Fichier d'authenfication Breeze
      
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
    └── UserFactory.php
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
├── .env.example
├── composer.json
├── package.json
└── README.md
```
