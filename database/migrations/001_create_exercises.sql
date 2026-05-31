CREATE TABLE exercises (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(20) NOT NULL, -- repetition | duration
    calories_factor NUMERIC(10,2) NOT NULL DEFAULT 1.0
);