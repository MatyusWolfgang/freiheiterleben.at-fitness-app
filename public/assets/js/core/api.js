const API_BASE = "/api";

export async function get(path) {
    const res = await fetch(API_BASE + path);
    return res.json();
}

export async function post(path, data) {
    const res = await fetch(API_BASE + path, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(data)
    });
    return res.json();
}

export async function del(path) {
    const res = await fetch(API_BASE + path, {
        method: "DELETE"
    });
    return res.json();
}