# Gatherly #
Projet universaire d'un site de gestion d'évènement rygbystique.

![Static Badge](https://img.shields.io/badge/PHP-blue)
![Static Badge](https://img.shields.io/badge/TWIG-green)

# Mise en place #

## Prérequis ##
- Docker
- Docker Compose Plugin

## Docker Compose ##

```
docker compose up --build -d
```

## BDD ##

```
docker exec -it web_server php test/models/creation_JDD.php
```
