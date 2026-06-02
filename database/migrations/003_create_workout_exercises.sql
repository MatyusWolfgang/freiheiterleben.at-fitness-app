CREATE TABLE workout_exercises (
    id SERIAL PRIMARY KEY,
    workout_id INT NOT NULL,
    exercise_id INT NOT NULL,

    sets INT DEFAULT NULL,
    reps INT DEFAULT NULL,
    duration_seconds INT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);