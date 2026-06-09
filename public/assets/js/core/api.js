const API_BASE = "/api";

async function request(path, options = {}) {

    const res = await fetch(API_BASE + path, {
        headers: {
            "Content-Type": "application/json",
            ...(options.headers || {})
        },
        ...options
    });

    if (!res.ok) {
        throw new Error("API Error: " + res.status);
    }

    return res.json();
}

export const api = {
    get: (path) => request(path),
    post: (path, data) =>
        request(path, {
            method: "POST",
            body: JSON.stringify(data)
        }),
    delete: (path) =>
        request(path, { method: "DELETE" })
};