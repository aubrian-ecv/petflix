# Petflix 🐶

## Technos
* Symfony
* PHP >= 8.1
* TailwindCSS

## Installation
```
composer install
```

```
php bin/console d:d:c
```

```
php bin/console d:s:u --force
```

<hr />

Changer les informations de connexion à la base de donnée dans le fichier .env :
`DATABASE_URL="mysql://<username>:<password>@127.0.0.1:3306/petflix?serverVersion=8.0.32&charset=utf8mb4"` (Exemple pour mysql)

Remplacer username et password par vos informations.

<hr />

Créer une base de donnée avec le nom renseigné à la fin de la variable DATABASE_URL.
Dans notre cas il faut que le nom soit `petflix`.

Importer le fichier petflix.sql situé à la racine du projet dans votre système de gestion de base de donnée.