import { api } from '../../core/api.js';
import { state } from '../../core/state.js';

async function loadWorkoutExercises(workoutId) {

    const res = await api.get(`/workouts/${workoutId}`);
    const list = document.getElementById('list');

    if (!res.data?.exercises?.length) {
        list.innerHTML = "<p>No exercises yet</p>";
        return;
    }

    list.innerHTML = res.data.exercises.map(ex => `
        <div style="padding:8px; border:1px solid #ccc; margin:4px;">
            <strong>${ex.name}</strong>
            <div>Sets: ${ex.sets ?? '-'}</div>
            <div>Reps: ${ex.reps ?? '-'}</div>
            <div>Duration: ${ex.duration_seconds ?? '-'}</div>
        </div>
    `).join('');
}

export async function renderWorkoutDetailPage(root) {

    const workoutId = state.currentWorkoutId;

    if (!workoutId) {
        root.innerHTML = `<p>No workout selected</p>`;
        return;
    }

    const workout = await api.get(`/workouts/${workoutId}`);
    const exercises = await api.get(`/exercises`);

    root.innerHTML = `
        <h1>${workout.data.name}</h1>

        <a href="#/workouts">← Back</a>

        <hr>

        <h2>Add Exercise</h2>

        <select id="exerciseSelect">
            ${exercises.data.map(e => `
                <option value="${e.id}">
                    ${e.name}
                </option>
            `).join('')}
        </select>

        <input id="sets" placeholder="Sets">
        <input id="reps" placeholder="Reps">
        <input id="duration" placeholder="Seconds">

        <button id="addBtn">Add</button>

        <hr>

        <h2>Workout Exercises</h2>
        <div id="list"></div>
    `;

    document.getElementById('addBtn').addEventListener('click', async () => {

        await api.post(`/workouts/${workoutId}/exercises`, {
            exercise_id: document.getElementById('exerciseSelect').value,
            sets: document.getElementById('sets').value || null,
            reps: document.getElementById('reps').value || null,
            duration_seconds: document.getElementById('duration').value || null
        });

        await loadWorkoutExercises(workoutId);
    });

    await loadWorkoutExercises(workoutId);
}