// assets/js/components/molecules/exerciseRow.js

export function ExerciseRow(exercise, onDelete) {
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between";

    const label = document.createElement("span");
    label.innerText = `${exercise.name} (${exercise.type})`;

    const btn = document.createElement("button");
    btn.className = "btn btn-danger btn-sm";
    btn.innerText = "Delete";
    btn.onclick = () => onDelete(exercise.id);

    li.appendChild(label);
    li.appendChild(btn);

    return li;
}