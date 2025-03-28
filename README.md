# Supermarket API

## Contexte du projet
L'objectif principal de ce projet est de développer une API REST pour gérer les rayons d’un supermarché. Chaque rayon contiendra plusieurs produits, avec une gestion des stocks et une mise à jour des quantités en temps réel.

## Fonctionnalités principales
- **Gestion des rayons et des produits** : Ajouter, modifier, supprimer des rayons et des produits.
- **Authentification avec Laravel Sanctum** : Pour sécuriser les endpoints API.
- **Gestion des stocks** : Mise à jour des quantités en temps réel après chaque vente.
- **Alertes pour stocks critiques** : Notifications par email pour les administrateurs.
- **Recherche de produits** : Recherche par nom, catégorie, ou promotion.

## User Stories

### Clients
- En tant que client, je souhaite pouvoir consulter la liste des produits disponibles dans un rayon spécifique afin de savoir ce qui est en stock.
- En tant que client, je veux pouvoir rechercher un produit par son nom ou sa catégorie pour trouver rapidement ce dont j’ai besoin.
- En tant que client, je souhaite voir les produits populaires ou en promotion dans un rayon spécifique.

### Administrateur
- En tant qu'administrateur, je souhaite pouvoir ajouter, modifier ou supprimer des rayons dans le système pour gérer l'organisation du supermarché.
- En tant qu'administrateur, je souhaite ajouter, modifier ou supprimer des produits dans un rayon afin d’assurer la gestion des stocks.
- En tant qu'administrateur, je veux visualiser des statistiques sur les stocks (produits les plus vendus, niveaux de stock critiques).
- En tant qu'administrateur, je souhaite recevoir une alerte lorsqu’un produit atteint un seuil bas pour anticiper le réapprovisionnement.

### Développeur
- En tant que développeur, je veux une documentation détaillée de l’API, créée à l'aide d'outils comme Postman, Swagger ou autres outils similaires.
- En tant que développeur, je souhaite que les stocks se mettent à jour automatiquement après chaque vente en utilisant les queues et les jobs de Laravel.
- Mise en place de tests unitaires avec PHPUnit ou Pest pour les fonctionnalités clés de l'API.

### Bonus
- En tant que développeur, je peux utiliser Laravel Sail pour contenairiser l'application et simplifier le déploiement.
- En tant qu’administrateur, je souhaite recevoir des notifications par email pour les stocks critiques.
- En tant qu'administrateur, je veux utiliser des slugs pour générer des URL lisibles des rayons et des produits.

## Technologies utilisées
- **Backend** : Laravel 11
- **Base de données** : PostgreSQL
- **Authentification** : Laravel Sanctum
- **Tests** : PHPUnit, Pest
- **Conteneurisation** : Laravel Sail (optionnel)
- **Documentation** : Swagger, Postman

## Installation

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- Docker (si vous utilisez Laravel Sail)
- PostgreSQL

### Étapes d'installation

1. Clonez le repository :
   ```bash
   git clone https://github.com/username/supermarket-api.git
   cd supermarket-api
