# freiheiterleben.at-fitness-app
Fitness-App zum Tracken von Trainingseinheiten und Mahlzeiten für die Ermittlung eines Kaloriendefizits.

TEST:

alle Tests:
docker compose exec php composer test

bestimmter Test:
docker compose exec php ./vendor/bin/phpunit tests/...

docker exec -it freiheiterlebenat-fitness-app-postgres-1 psql -U fitness_user -d fitness

docker exec: Sagt Docker, dass du einen Befehl in einem bereits laufenden Container ausführen möchtest.
-it: Kombiniert zwei Argumente (-i für interaktiv und -t für ein Pseudo-TTY). Das sorgt dafür, dass du Eingaben im Container machen kannst (wie ein Terminal im Terminal).
freiheiterlebenat-fitness-app-postgres-1: Das ist der exakte Name des Docker-Containers, in den du hineingehen möchtest.

🐘 PostgreSQL-Spezifische Befehlepsql: Das ist das Kommandozeilen-Tool von PostgreSQL, das im Container aufgerufen wird, um die Datenbank zu steuern.
-U fitness_user: Der Benutzername (User), mit dem du dich an der Datenbank anmeldest (fitness_user).
-d fitness: Der Name der spezifischen Datenbank (fitness), mit der du dich verbinden willst.

SQL Tabelle exercise erstellen
siehe database/migrations/001_schema.sql

DOCKER:

*Standard Start:
docker compose up -d

*Nur neu starten:
docker compose restart

*Komplett neu bauen:
docker compose down -v // -v löscht alles ohne -v bleiben tabellen erhalten
docker compose up --build -d

*Vorhandene Tabellen auslesen in Bash:
docker exec -it freiheiterlebenat-fitness-app-postgres-1 psql -U fitness_user -d fitness  
\dt

Projektstruktur:

project-root/

 
 ├── api/                       ← HTTP LAYER (internal)

 │    ├── controllers/

 │    │    ├── ExerciseController.php
 
 │    │    ├── WorkoutController.php

 │    │    └── WorkoutController.php

 │    ├── middleware/

 │    └── routes/

 │    │    ├── exerciseRoutes.php
 
 │    │    ├── workoutExerciseRoutes.php

 │    │    └── workoutRoutes.php

 │

 ├── bootstrap/

 │    └── app.php               ← wiring (router + middleware)

 │

 ├── config/

 │    └── database.php

 │

 ├── database/
 
 │    ├── migrations/

 │    │    ├── 001_create_exercise.sql

 │    │    ├── 001_schema.sql

 │    │    ├── 002_create_workout.sql

 │    │    └── 003_create_workout_exercieses.sql

 │    └── seeds

 │
 
 ├── docker/

 │    ├── nginx/

 │    │    └── default.conf

 │    ├── php/

 │    │    └── Dockerfile

 │    └── postgres

 │    │    └── postgres

 │    │    │    └── init

 │
 
 ├── docs/

 │

 ├── public/                     ← ONLY WEB ACCESSIBLE
 
 │    ├── api/

 │    │    └── index.php        ← API ENTRY POINT

 │    ├── assets/               ← JS/CSS/Images

 │    │    └── css

 │    │    │    └── app.css

 │    │    ├── images

 │    │    ├──  js

 │    │    │    ├──  components

 │    │    │    │        ├──  atmos

 │    │    │    │        │        ├── button.js

 │    │    │    │        │        └── input.js

 │    │    │    │        ├──  molecuels

 │    │    │    │        │        ├── exerciseRow.js

 │    │    │    │        │        └── formField.js

 │    │    │    │        └──  organisms

 │    │    │    │        │        ├── exerciseList.js

 │    │    │    │        │        └── workoutForm.js


 │    │    │    └──  core

 │    │    │    │        ├── api.js

 │    │    │    │        ├── apiClient.js

 │    │    │    │        ├── config.js

 │    │    │    │        ├── https.js

 │    │    │    │        ├── router.js

 │    │    │    │        └── state.js

 │    │    ├── ui

 │    │    │    ├── pages

 │    │    │    │        ├── exercisePage.js

 │    │    │    │        ├── workoutDetailPage.js

 │    │    │    │        └── workoutPage.js

 │    │    │    ├── paritals

 │    │    │    └── templates

 │    └── index.php             ← UI ENTRY (HTML + JS SPA)

 ├── src/                       ← DOMAIN CORE

 │    ├── http/

 │    ├── models/

 │    ├── repositories/

 │    ├── services/

 │    ├── utils/

 │    └── workers/

 ├── tests/

 ├── vendor/

 ├── composer.json

 ├── composer.lock

 ├── docker-compose.yml

 ├── phpunit.xml

 └── README.md