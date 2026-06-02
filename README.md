# freiheiterleben.at-fitness-app
Fitness-App zum Tracken von Trainingseinheiten und Mahlzeiten für die Ermittlung eines Kaloriendefizits.

TEST:

docker exec -it freiheiterlebenat-fitness-app-postgres-1 psql -U fitness_user -d fitness

docker exec: Sagt Docker, dass du einen Befehl in einem bereits laufenden Container ausführen möchtest.
-it: Kombiniert zwei Argumente (-i für interaktiv und -t für ein Pseudo-TTY). Das sorgt dafür, dass du Eingaben im Container machen kannst (wie ein Terminal im Terminal).
freiheiterlebenat-fitness-app-postgres-1: Das ist der exakte Name des Docker-Containers, in den du hineingehen möchtest.

🐘 PostgreSQL-Spezifische Befehlepsql: Das ist das Kommandozeilen-Tool von PostgreSQL, das im Container aufgerufen wird, um die Datenbank zu steuern.
-U fitness_user: Der Benutzername (User), mit dem du dich an der Datenbank anmeldest (fitness_user).
-d fitness: Der Name der spezifischen Datenbank (fitness), mit der du dich verbinden willst.

SQL Tabelle exercise erstellen
CREATE TABLE IF NOT EXISTS exercises (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(20) NOT NULL,
    calories_factor NUMERIC(10,2) NOT NULL DEFAULT 1.0
);

DOCKER:

