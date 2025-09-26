document.addEventListener('DOMContentLoaded', function() {
    cargarCategorias();
    cargarProductos();
    configurarFormularios();
});

async function cargarCategorias() {
    try {
        const response = await fetch('api/categorias.php');
        const categorias = await response.json();

        const categoriaSelect = document.getElementById('categoria');
        const categoriaFiltro = document.getElementById('categoriaFiltro');
        const categoriasLista = document.getElementById('categoriasLista');

        // Limpiar selectores
        categoriaSelect.innerHTML = '<option value="">Seleccionar categoría</option>';
        categoriaFiltro.innerHTML = '<option value="">Todas las categorías</option>';
        categoriasLista.innerHTML = '';

        categorias.forEach(categoria => {
            // Agregar a los select
            const option1 = new Option(categoria.nombre, categoria.nombre);
            const option2 = new Option(categoria.nombre, categoria.nombre);
            categoriaSelect.add(option1);
            categoriaFiltro.add(option2);

            // Crear tarjeta de categoría
            const categoriaCard = document.createElement('div');
            categoriaCard.className = 'categoria-card';
            categoriaCard.innerHTML = `
                <div class="categoria-nombre">${categoria.nombre}</div>
                <div class="categoria-descripcion">${categoria.descripcion || 'Sin descripción'}</div>
            `;
            categoriasLista.appendChild(categoriaCard);
        });
    } catch (error) {
        console.error('Error al cargar categorías:', error);
        mostrarMensaje('Error al cargar categorías', 'error');
    }
}

async function cargarProductos(filtros = {}) {
    try {
        let url = 'api/productos.php';
        const params = new URLSearchParams();

        if (filtros.categoria) {
            params.append('categoria', filtros.categoria);
        }
        if (filtros.busqueda) {
            params.append('busqueda', filtros.busqueda);
        }

        if (params.toString()) {
            url += '?' + params.toString();
        }

        const response = await fetch(url);
        const productos = await response.json();

        const productosGrid = document.getElementById('productosGrid');
        productosGrid.innerHTML = '';

        if (productos.length === 0) {
            productosGrid.innerHTML = '<p style="text-align: center; grid-column: 1/-1; color: #666;">No se encontraron productos.</p>';
            return;
        }

        productos.forEach(producto => {
            const productoCard = document.createElement('div');
            productoCard.className = 'producto-card';
            const imagenUrl = producto.imagen_url && producto.imagen_url.trim() !== ''
                ? producto.imagen_url
                : `https://picsum.photos/300/200?random=${producto.id}`;

            productoCard.innerHTML = `
                <div class="imagen-container">
                    <img src="" alt="${producto.nombre}" class="producto-imagen loading"
                         data-src="${imagenUrl}">
                </div>
                <div class="producto-nombre">${producto.nombre}</div>
                <div class="producto-categoria">${producto.categoria}</div>
                <div class="producto-precio">$${parseFloat(producto.precio).toLocaleString('es-CO')}</div>
                <div class="producto-descripcion">${producto.descripcion || 'Sin descripción'}</div>
                <div class="producto-info">
                    <span><strong>Marca:</strong> ${producto.marca || 'N/A'}</span>
                    <span><strong>Stock:</strong> ${producto.stock}</span>
                </div>
                <div class="producto-acciones">
                    <button onclick="editarProducto(${producto.id})" class="btn-editar">
                        Editar
                    </button>
                    <button onclick="eliminarProducto(${producto.id})" class="btn-eliminar">
                        Eliminar
                    </button>
                </div>
            `;

            // Cargar imagen con lazy loading
            const img = productoCard.querySelector('.producto-imagen');
            lazyLoadImage(img);
            productosGrid.appendChild(productoCard);
        });
    } catch (error) {
        console.error('Error al cargar productos:', error);
        mostrarMensaje('Error al cargar productos', 'error');
    }
}

function configurarFormularios() {
    // Configurar formulario de productos
    const productoForm = document.getElementById('productoForm');
    productoForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = {
            nombre: document.getElementById('nombre').value,
            categoria: document.getElementById('categoria').value,
            precio: parseFloat(document.getElementById('precio').value),
            descripcion: document.getElementById('descripcion').value,
            marca: document.getElementById('marca').value,
            stock: parseInt(document.getElementById('stock').value) || 0,
            imagen_url: document.getElementById('imagen_url').value
        };

        try {
            let response, result;

            if (editandoProductoId) {
                // Actualizar producto existente usando POST para compatibilidad con InfinityFree
                const updateFormData = new FormData();
                updateFormData.append('_method', 'PUT');
                updateFormData.append('id', editandoProductoId);

                // Asegurar que todos los campos tengan valores, incluso si están vacíos
                Object.keys(formData).forEach(key => {
                    const value = formData[key] !== null && formData[key] !== undefined ? formData[key] : '';
                    updateFormData.append(key, value);
                });

                response = await fetch('api/productos.php', {
                    method: 'POST',
                    body: updateFormData
                });
            } else {
                // Crear nuevo producto
                response = await fetch('api/productos.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
            }

            result = await response.json();

            if (response.ok) {
                const mensaje = editandoProductoId ? 'Producto actualizado exitosamente' : 'Producto agregado exitosamente';
                mostrarMensaje(mensaje, 'exito');

                // Resetear formulario
                productoForm.reset();

                // Restaurar botón si estaba editando
                if (editandoProductoId) {
                    const submitBtn = document.querySelector('#productoForm button[type="submit"]');
                    submitBtn.textContent = 'Agregar Producto';
                    submitBtn.className = '';

                    const cancelBtn = document.querySelector('.btn-cancelar');
                    if (cancelBtn) cancelBtn.remove();

                    editandoProductoId = null;
                }

                cargarProductos();
                // Scroll hacia la sección de productos
                document.getElementById('productos').scrollIntoView({ behavior: 'smooth' });
            } else {
                const accion = editandoProductoId ? 'actualizar' : 'agregar';
                mostrarMensaje(`Error al ${accion} producto: ` + (result.error || 'Error desconocido'), 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarMensaje('Error al conectar con el servidor', 'error');
        }
    });

    // Configurar formulario de categorías
    const categoriaForm = document.getElementById('categoriaForm');
    categoriaForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = {
            nombre: document.getElementById('categoriaNombre').value,
            descripcion: document.getElementById('categoriaDescripcion').value
        };

        try {
            const response = await fetch('api/categorias.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (response.ok) {
                mostrarMensaje('Categoría agregada exitosamente', 'exito', categoriaForm.parentNode);
                categoriaForm.reset();
                cargarCategorias();
            } else {
                mostrarMensaje('Error al agregar categoría: ' + (result.error || 'Error desconocido'), 'error', categoriaForm.parentNode);
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarMensaje('Error al conectar con el servidor', 'error', categoriaForm.parentNode);
        }
    });
}

function filtrarProductos() {
    const categoria = document.getElementById('categoriaFiltro').value;
    const busqueda = document.getElementById('busqueda').value;

    const filtros = {};
    if (categoria) filtros.categoria = categoria;
    if (busqueda) filtros.busqueda = busqueda;

    cargarProductos(filtros);
}

function limpiarFiltros() {
    document.getElementById('categoriaFiltro').value = '';
    document.getElementById('busqueda').value = '';
    cargarProductos();
}

function mostrarMensaje(texto, tipo, contenedor = null) {
    // Remover mensaje existente
    const existeMensaje = document.querySelector('.mensaje');
    if (existeMensaje) {
        existeMensaje.remove();
    }

    const mensaje = document.createElement('div');
    mensaje.className = `mensaje ${tipo}`;
    mensaje.textContent = texto;

    // Insertar mensaje
    if (contenedor) {
        contenedor.insertBefore(mensaje, contenedor.firstChild);
    } else {
        const form = document.getElementById('productoForm');
        form.parentNode.insertBefore(mensaje, form);
    }

    // Auto-remover después de 5 segundos (excepto para mensajes informativos)
    const timeout = tipo === 'info' ? 3000 : 5000;
    setTimeout(() => {
        if (mensaje.parentNode) {
            mensaje.remove();
        }
    }, timeout);
}

// Event listeners adicionales
document.getElementById('busqueda').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        filtrarProductos();
    }
});

// Navegación suave
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Validación en tiempo real para números
document.getElementById('precio').addEventListener('input', function(e) {
    if (e.target.value < 0) {
        e.target.value = 0;
    }
});

document.getElementById('stock').addEventListener('input', function(e) {
    if (e.target.value < 0) {
        e.target.value = 0;
    }
});

// Previsualización de imagen
document.getElementById('imagen_url').addEventListener('blur', function(e) {
    const url = e.target.value;
    if (url) {
        // Validar que sea una URL válida
        try {
            new URL(url);
        } catch {
            mostrarMensaje('La URL de la imagen no es válida', 'error');
            e.target.focus();
        }
    }
});

// Variables globales para edición
let editandoProductoId = null;

// Función para lazy loading de imágenes
function lazyLoadImage(img) {
    const imageSrc = img.getAttribute('data-src');

    // Crear una nueva imagen para precargar
    const imageLoader = new Image();

    imageLoader.onload = function() {
        // Una vez que la imagen se carga, la mostramos
        img.src = imageSrc;
        img.classList.remove('loading');
        img.classList.add('loaded');
    };

    imageLoader.onerror = function() {
        // Si falla, usar una imagen por defecto
        img.src = `https://picsum.photos/300/200?random=${Math.floor(Math.random() * 1000)}`;
        img.classList.remove('loading');
        img.classList.add('loaded');
    };

    // Iniciar la carga
    imageLoader.src = imageSrc;
}

// Función para editar producto
async function editarProducto(id) {
    try {
        console.log('Editando producto ID:', id);
        const response = await fetch(`api/productos.php?id=${id}`);
        console.log('Response status:', response.status);
        const producto = await response.json();
        console.log('Producto data:', producto);

        if (response.ok) {
            // Cambiar el título de la sección
            const tituloSeccion = document.querySelector('#agregar h3');
            tituloSeccion.innerHTML = '✏️ Editando Producto';

            // Cambiar fondo de la sección para indicar modo edición
            const seccionAgregar = document.getElementById('agregar');
            seccionAgregar.classList.add('modo-edicion');

            // Llenar el formulario con los datos del producto
            document.getElementById('nombre').value = producto.nombre;
            document.getElementById('categoria').value = producto.categoria;
            document.getElementById('precio').value = producto.precio;
            document.getElementById('descripcion').value = producto.descripcion;
            document.getElementById('marca').value = producto.marca;
            document.getElementById('stock').value = producto.stock;
            document.getElementById('imagen_url').value = producto.imagen_url;

            // Cambiar el botón del formulario
            const submitBtn = document.querySelector('#productoForm button[type="submit"]');
            submitBtn.textContent = 'Actualizar Producto';
            submitBtn.className = 'btn-actualizar';

            // Añadir botón cancelar
            if (!document.querySelector('.btn-cancelar')) {
                const cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.textContent = 'Cancelar Edición';
                cancelBtn.className = 'btn-cancelar';
                cancelBtn.onclick = cancelarEdicion;
                submitBtn.parentNode.insertBefore(cancelBtn, submitBtn.nextSibling);
            }

            editandoProductoId = id;

            // Scroll al formulario
            document.getElementById('agregar').scrollIntoView({ behavior: 'smooth' });

            mostrarMensaje(`Editando producto: "${producto.nombre}"`, 'warning');
        } else {
            mostrarMensaje('Error al cargar producto: ' + producto.error, 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarMensaje('Error al cargar producto', 'error');
    }
}

// Función para cancelar edición
function cancelarEdicion() {
    // Restaurar título de la sección
    const tituloSeccion = document.querySelector('#agregar h3');
    tituloSeccion.innerHTML = 'Agregar Nuevo Producto';

    // Quitar modo edición
    const seccionAgregar = document.getElementById('agregar');
    seccionAgregar.classList.remove('modo-edicion');

    // Limpiar formulario
    const form = document.getElementById('productoForm');
    form.reset();

    // Restaurar botón original
    const submitBtn = document.querySelector('#productoForm button[type="submit"]');
    submitBtn.textContent = 'Agregar Producto';
    submitBtn.className = '';

    // Remover botón cancelar
    const cancelBtn = document.querySelector('.btn-cancelar');
    if (cancelBtn) {
        cancelBtn.remove();
    }

    editandoProductoId = null;
    mostrarMensaje('Edición cancelada', 'info');
}

// Función para eliminar producto
async function eliminarProducto(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        return;
    }

    try {
        console.log('Eliminando producto ID:', id);

        // Usar POST con _method para compatibilidad con InfinityFree
        const formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('id', id);

        const response = await fetch('api/productos.php', {
            method: 'POST',
            body: formData
        });
        console.log('Delete response status:', response.status);

        const result = await response.json();

        if (response.ok) {
            mostrarMensaje('Producto eliminado exitosamente', 'exito');
            cargarProductos();
        } else {
            mostrarMensaje('Error al eliminar producto: ' + result.error, 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarMensaje('Error al eliminar producto', 'error');
    }
}

// Funciones para el navbar móvil
function toggleNavMenu() {
    const navMenu = document.getElementById('navMenu');
    const navToggle = document.querySelector('.nav-toggle');

    navMenu.classList.toggle('active');
    navToggle.classList.toggle('active');
}

function closeNavMenu() {
    const navMenu = document.getElementById('navMenu');
    const navToggle = document.querySelector('.nav-toggle');

    navMenu.classList.remove('active');
    navToggle.classList.remove('active');
}

// Cerrar menú al hacer clic fuera de él
document.addEventListener('click', function(event) {
    const navMenu = document.getElementById('navMenu');
    const navToggle = document.querySelector('.nav-toggle');
    const navContainer = document.querySelector('.nav-container');

    if (!navContainer.contains(event.target)) {
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
    }
});