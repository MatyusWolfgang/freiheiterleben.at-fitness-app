// assets/js/components/organisms/exerciseList.js

import { get, del } from "../../core/api.js";
import { ExerciseRow } from "../molecules/exerciseRow.js";

export async function ExerciseList(container) {
    const data = await get("/exercises");

    container.innerHTML = "";

    data.data.forEach(ex => {
        container.appendChild(
            ExerciseRow(ex, async (id) => {
                await del(`/exercises/${id}`);
                ExerciseList(container);
            })
        );
    });
}