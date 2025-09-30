// Script para compatibilidad con el sistema de seguridad de InfinityFree
// Asegura que JavaScript esté habilitado y las cookies funcionen

document.addEventListener('DOMContentLoaded', function() {
    // Test de cookies requerido por InfinityFree
    document.cookie = "infinityfree_test=1; path=/";

    // Verificar que las cookies funcionen
    if (document.cookie.indexOf('infinityfree_test') === -1) {
        console.warn('Cookies no habilitadas - InfinityFree requiere cookies');
    }

    // Marcar JavaScript como activo
    document.body.classList.add('js-enabled');

    // Agregar meta tag para compatibilidad con InfinityFree
    if (!document.querySelector('meta[name="infinityfree-compatible"]')) {
        const meta = document.createElement('meta');
        meta.name = 'infinityfree-compatible';
        meta.content = 'true';
        document.head.appendChild(meta);
    }
});