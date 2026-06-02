// assets/js/components/atoms/button.js

export function Button(label, onClick, type = "primary") {
    const btn = document.createElement("button");
    btn.className = `btn btn-${type}`;
    btn.innerText = label;
    btn.onclick = onClick;
    return btn;
}