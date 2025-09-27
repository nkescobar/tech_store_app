<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$type = $_GET['type'] ?? '';

try {
    switch ($type) {
        case 'productos':
            exportProductosCSV($db);
            break;
        case 'categorias':
            exportCategoriasCSV($db);
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Tipo de export no válido. Usar: productos o categorias']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}

function exportProductosCSV($db) {
    try {
        $stmt = $db->prepare("SELECT
            p.id,
            p.nombre,
            p.categoria,
            p.precio,
            p.descripcion,
            p.marca,
            p.stock,
            p.fecha_creacion
            FROM productos p
            ORDER BY p.fecha_creacion DESC");

        $stmt->execute();
        $productos = $stmt->fetchAll();

        // Headers para descarga CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=productos_techstore_' . date('Y-m-d_H-i-s') . '.csv');

        // Crear output
        $output = fopen('php://output', 'w');

        // BOM para UTF-8 (para Excel)
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Headers del CSV
        fputcsv($output, [
            'ID',
            'Nombre',
            'Categoría',
            'Precio (COP)',
            'Descripción',
            'Marca',
            'Stock',
            'Fecha Creación'
        ], ';', '"', '\\');

        // Datos
        foreach ($productos as $producto) {
            fputcsv($output, [
                $producto['id'],
                strip_tags($producto['nombre']),  // Remover HTML
                strip_tags($producto['categoria']),
                number_format($producto['precio'], 0, ',', '.'),
                strip_tags($producto['descripcion']),
                strip_tags($producto['marca']),
                $producto['stock'],
                $producto['fecha_creacion']
            ], ';', '"', '\\');
        }

        fclose($output);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al exportar productos: ' . $e->getMessage()]);
    }
}

function exportCategoriasCSV($db) {
    try {
        $stmt = $db->prepare("SELECT
            c.id,
            c.nombre,
            c.descripcion,
            COUNT(p.id) as total_productos
            FROM categorias c
            LEFT JOIN productos p ON p.categoria = c.nombre
            GROUP BY c.id, c.nombre, c.descripcion
            ORDER BY c.nombre");

        $stmt->execute();
        $categorias = $stmt->fetchAll();

        // Headers para descarga CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=categorias_techstore_' . date('Y-m-d_H-i-s') . '.csv');

        // Crear output
        $output = fopen('php://output', 'w');

        // BOM para UTF-8
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Headers del CSV
        fputcsv($output, [
            'ID',
            'Nombre',
            'Descripción',
            'Total Productos'
        ], ';', '"', '\\');

        // Datos
        foreach ($categorias as $categoria) {
            fputcsv($output, [
                $categoria['id'],
                strip_tags($categoria['nombre']),    // Remover HTML
                strip_tags($categoria['descripcion']),
                $categoria['total_productos']
            ], ';', '"', '\\');
        }

        fclose($output);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al exportar categorías: ' . $e->getMessage()]);
    }
}