
# Blog applicatie Lemone

Proefopdracht blog applicatie Lemone gebouwd met PHP 8.4, MySQL 8.0, Nginx en Tailwind CSS v4.

## Instalatie
## Vereisten

- [Docker](https://www.docker.com/get-started) (incl. Docker Compose)

### Stappenplan

```bash
#1. Maak een environment bestand aan
cp .env.example .env

#2. Bouw en start de docker containers
docker compose up -d --build

#3. Installeer de PHP dependencies
docker compose exec php composer install

#4. importeer het sql schema nadat de containers draaien (voor de zekerheid tot 15 seconden wachten)
docker compose exec -T mysql mysql -u ROOT_USER_INVULLEN -pROOT_WACHTWOORD_INVULLEN DATABASE_NAAM < schema.sql
```

## Gebruik
De app is te vinden op http://localhost:8080

Op de homepage kunnen blogs bekeken worden. Als de applicatie word gestart zijn er nog geen blogs aanwezig.

Accounts kunnen worden aangemaakt en er kan worden ingelogt via /register en /login

Detailpagina's kunnen worden bezocht via /posts/{id}

Blogposts kunnen worden aangemaakt via /posts/create. Blogposts ondersteunen rich text.

Alleen posts die je zelf hebt gemaakt kunnen worden bewerkt en verwijderd.

Op een post kan worden gereageerd.

## Keuzes
### BaseModel
Er is een base model gemaakt met een generieke CRUD zodat deze code hergebruikt kon worden in de andere models

### Templates
#### Layout
Er zijn verschillende layouts gemaakt zodat op de auth pagina's niet de nav en footer te zien zijn.

#### Components
Components zijn losse stukken code die hergebruikt kunnen worden omdat ze anders meerdere malen geschreven moesten worden.

### Helpers
Globale functies zoals `e()` voor output escaping, `redirect()` voor redirects, en `render()` / `component()` om templates en componenten in te laden. Dit houdt de controllers kort en leesbaar.

### Beveiliging
CSRF-tokens op alle formulieren, wachtwoorden gehasht met bcrypt en session regeneration bij in- en uitloggen.

### Router & Middleware
Eigen router met ondersteuning voor route parameters (`/posts/{id}`) en middleware. Auth en guest middleware beschermen routes zodat bijvoorbeeld alleen ingelogde gebruikers posts kunnen aanmaken.

### Comments
Oudste eerst om het meer te laten lijken op een chronologisch gesprek.