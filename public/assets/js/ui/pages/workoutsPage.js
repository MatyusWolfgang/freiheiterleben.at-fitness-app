import { api } from '../../core/api.js';
import { state } from '../../core/state.js';

export async function renderWorkoutsPage(root) {

    const res = await api.get('/workouts');

    root.innerHTML = `
        <h1>Workouts</h1>

        <ul>
            ${res.data.map(w => `
                <li>
                    <button data-id="${w.id}">
                        ${w.name}
                    </button>
                </li>
            `).join('')}
        </ul>
    `;

    root.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', () => {
            state.currentWorkoutId = btn.dataset.id;
            location.hash = '#/workout';
        });
    });
}