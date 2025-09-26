<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                getCategoriaById($db, $_GET['id']);
            } else {
                getCategorias($db);
            }
            break;

        case 'POST':
            // Compatibilidad con InfinityFree - método via _method parameter
            if (isset($_POST['_method'])) {
                if ($_POST['_method'] === 'DELETE' && isset($_POST['id'])) {
                    deleteCategoria($db, $_POST['id']);
                } elseif ($_POST['_method'] === 'PUT' && isset($_POST['id'])) {
                    updateCategoria($db, $_POST['id']);
                }
            } else {
                createCategoria($db);
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

// Función para obtener una categoría específica por ID
function getCategoriaById($db, $id) {
    try {
        $stmt = $db->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
        $categoria = $stmt->fetch();

        if ($categoria) {
            echo json_encode($categoria);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Categoría no encontrada']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al obtener categoría']);
    }
}

// Función para actualizar categoría
function updateCategoria($db, $id) {
    try {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';

        if (empty($nombre)) {
            http_response_code(400);
            echo json_encode(['error' => 'El nombre es obligatorio']);
            return;
        }

        $stmt = $db->prepare("UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?");
        $success = $stmt->execute([$nombre, $descripcion, $id]);

        if ($success && $stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Categoría actualizada exitosamente']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Categoría no encontrada']);
        }
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'UNIQUE') !== false) {
            http_response_code(409);
            echo json_encode(['error' => 'Ya existe una categoría con ese nombre']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar categoría']);
        }
    }
}

// Función para eliminar categoría
function deleteCategoria($db, $id) {
    try {
        // Verificar si hay productos usando esta categoría
        $stmt = $db->prepare("SELECT COUNT(*) FROM productos WHERE categoria = (SELECT nombre FROM categorias WHERE id = ?)");
        $stmt->execute([$id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            http_response_code(400);
            $mensaje = $count === 1 ?
                "No se puede eliminar esta categoría porque tiene 1 producto asociado. Primero elimina o cambia la categoría del producto." :
                "No se puede eliminar esta categoría porque tiene $count productos asociados. Primero elimina o cambia la categoría de los productos.";
            echo json_encode(['error' => $mensaje]);
            return;
        }

        // Eliminar la categoría
        $stmt = $db->prepare("DELETE FROM categorias WHERE id = ?");
        $success = $stmt->execute([$id]);

        if ($success && $stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Categoría eliminada exitosamente']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Categoría no encontrada']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al eliminar categoría']);
    }
}