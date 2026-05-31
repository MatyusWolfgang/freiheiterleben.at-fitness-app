<?php

require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

try {

    $db = Database::getConnection();

    $result = $db->query("SELECT NOW()");

    $time = $result->fetchColumn();

    echo json_encode([
        "status" => "ok",
        "database" => "connected",
        "time" => $time
    ]);

} catch(Exception $e) {

    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}