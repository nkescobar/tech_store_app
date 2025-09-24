<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));

try {
    switch ($method) {
        case 'GET':
            if (isset($request[0]) && is_numeric($request[0])) {
                // Obtener producto específico
                getProducto($db, $request[0]);
            } else {
                // Obtener todos los productos con filtros opcionales
                getProductos($db);
            }
            break;

        case 'POST':
            createProducto($db);
            break;

        case 'PUT':
            if (isset($request[0]) && is_numeric($request[0])) {
                updateProducto($db, $request[0]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID de producto requerido']);
            }
            break;

        case 'DELETE':
            if (isset($request[0]) && is_numeric($request[0])) {
                deleteProducto($db, $request[0]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID de producto requerido']);
            }
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

function getProductos($db) {
    $query = "SELECT * FROM productos";
    $params = [];

    // Filtro por categoría
    if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
        $query .= " WHERE categoria = ?";
        $params[] = $_GET['categoria'];
    }

    // Filtro por búsqueda
    if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
        if (count($params) > 0) {
            $query .= " AND (nombre LIKE ? OR descripcion LIKE ? OR marca LIKE ?)";
        } else {
            $query .= " WHERE (nombre LIKE ? OR descripcion LIKE ? OR marca LIKE ?)";
        }
        $searchTerm = '%' . $_GET['busqueda'] . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }

    $query .= " ORDER BY fecha_creacion DESC";

    $stmt = $db->prepare($query);
    $stmt->execute($params);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($productos);
}

function getProducto($db, $id) {
    $stmt = $db->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        echo json_encode($producto);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Producto no encontrado']);
    }
}

function createProducto($db) {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['nombre']) || !isset($input['categoria']) || !isset($input['precio'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Nombre, categoría y precio son obligatorios']);
        return;
    }

    $stmt = $db->prepare("INSERT INTO productos (nombre, categoria, precio, descripcion, marca, stock, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $success = $stmt->execute([
        $input['nombre'],
        $input['categoria'],
        $input['precio'],
        $input['descripcion'] ?? '',
        $input['marca'] ?? '',
        $input['stock'] ?? 0,
        $input['imagen_url'] ?? ''
    ]);

    if ($success) {
        http_response_code(201);
        echo json_encode([
            'id' => $db->lastInsertId(),
            'message' => 'Producto creado exitosamente'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error al crear producto']);
    }
}

function updateProducto($db, $id) {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['nombre']) || !isset($input['categoria']) || !isset($input['precio'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Nombre, categoría y precio son obligatorios']);
        return;
    }

    $stmt = $db->prepare("UPDATE productos SET nombre = ?, categoria = ?, precio = ?, descripcion = ?, marca = ?, stock = ?, imagen_url = ? WHERE id = ?");

    $success = $stmt->execute([
        $input['nombre'],
        $input['categoria'],
        $input['precio'],
        $input['descripcion'] ?? '',
        $input['marca'] ?? '',
        $input['stock'] ?? 0,
        $input['imagen_url'] ?? '',
        $id
    ]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode(['message' => 'Producto actualizado exitosamente']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Producto no encontrado']);
    }
}

function deleteProducto($db, $id) {
    $stmt = $db->prepare("DELETE FROM productos WHERE id = ?");
    $success = $stmt->execute([$id]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode(['message' => 'Producto eliminado exitosamente']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Producto no encontrado']);
    }
}
?>