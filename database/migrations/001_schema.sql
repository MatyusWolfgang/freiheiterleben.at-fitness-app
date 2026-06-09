CREATE TABLE exercises (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    type TEXT NOT NULL,
    calories_factor NUMERIC DEFAULT 1.0
);

CREATE TABLE workouts (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE workout_exercises (
    id SERIAL PRIMARY KEY,
    workout_id INT NOT NULL,
    exercise_id INT NOT NULL,
    sets INT,
    reps INT,
    duration_seconds INT,
    created_at TIMESTAMP DEFAULT NOW()
);