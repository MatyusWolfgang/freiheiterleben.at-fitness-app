import { api } from '../../core/api.js';

export async function renderExercisesPage(root) {

    const data = await api.get('/exercises');

    root.innerHTML = `
        <h1>Exercises</h1>
        <a href="#/workouts">Workouts</a>

        <ul>
            ${data.data.map(ex => `
                <li>
                    <strong>${ex.name}</strong>
                    (${ex.type})
                </li>
            `).join('')}
        </ul>
    `;
}