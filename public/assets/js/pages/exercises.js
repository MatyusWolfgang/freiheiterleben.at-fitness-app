import { post } from "../core/api.js";
import { ExerciseList } from "../components/organisms/exerciseList.js";

const list = document.getElementById("list");

async function load() {
    await ExerciseList(list);
}

window.createExercise = async function () {
    const name = document.getElementById("name").value;
    const type = document.getElementById("type").value;
    const factor = document.getElementById("factor").value;

    await post("/exercises", {
        name,
        type,
        calories_factor: factor
    });

    load();
};

load();