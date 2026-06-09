import { renderExercisesPage } from '../ui/pages/exercisesPage.js';
import { renderWorkoutsPage } from '../ui/pages/workoutsPage.js';
import { renderWorkoutDetailPage } from '../ui/pages/workoutDetailPage.js';
import { state } from '../core/state.js';

function router() {

    const app = document.getElementById('app');
    const path = window.location.hash || '#/exercises';

    switch (path) {

        case '#/exercises':
            renderExercisesPage(app);
            break;

        case '#/workouts':
            renderWorkoutsPage(app);
            break;

        case '#/workout':
            renderWorkoutDetailPage(app, state.currentWorkoutId);
            break;

        default:
            renderExercisesPage(app);
    }
}

window.addEventListener('hashchange', router);
window.addEventListener('load', router);