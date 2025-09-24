<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            getCategorias($db);
            break;

        case 'POST':
            createCategoria($db);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}

function getCategorias($db) {
    $stmt = $db->query("SELECT * FROM categorias ORDER BY nombre");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categorias);
}

function createCategoria($db) {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['nombre']) || empty($input['nombre'])) {
        http_response_code(400);
        echo json_encode(['error' => 'El nombre de la categoría es obligatorio']);
        return;
    }

    try {
        $stmt = $db->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
        $success = $stmt->execute([
            $input['nombre'],
            $input['descripcion'] ?? ''
        ]);

        if ($success) {
            http_response_code(201);
            echo json_encode([
                'id' => $db->lastInsertId(),
                'message' => 'Categoría creada exitosamente'
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear categoría']);
        }
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'UNIQUE') !== false) {
            http_response_code(409);
            echo json_encode(['error' => 'La categoría ya existe']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear categoría']);
        }
    }
}
?>