// Clase Producto
class Producto {
    constructor(id, nombre, categoria, precio, descripcionCorta, descripcionLarga, ingredientes = [], destacado = false) {
        this.id = id;
        this.nombre = nombre;
        this.categoria = categoria;
        this.precio = precio;
        this.descripcionCorta = descripcionCorta;
        this.descripcionLarga = descripcionLarga;
        this.imagen = this._generarRutaImagen(nombre);
        this.ingredientes = ingredientes;
        this.destacado = destacado;
    }

    // Optimizada para carga de imágenes
    _generarRutaImagen(nombre) {
        const nombreFormateado = nombre.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[áéíóú]/g, letra => 'aeiou'['áéíóú'.indexOf(letra)]);
        return `https://lautidev.com/ProyectoPasteleria/assets/images/productos/${nombreFormateado}.webp`;
    }
}

// Configuración de paginación y filtros
const config = {
    itemsPorPagina: 6,       // Para filtros distintos a "todos"
    paginaActual: 1,
    observer: null,
    filtroCategoria: 'todos',
    filtroBusqueda: '',
    itemsMostrar: 7          // Solo se usará en el modo "todos" sin búsqueda
};

// Array de Productos
const productos = [
    new Producto(
        1,
        'Torta de Chocolate',
        ['Pasteles'],
        45.99,
        'Clásico pastel de chocolate con relleno cremoso',
        'Deliciosa torta de chocolate con tres capas de bizcocho húmedo, relleno de ganache y cubierta de chocolate semi-amargo. Decorada con virutas de chocolate negro.',
        ['harina', 'huevos', 'chocolate', 'azúcar', 'mantequilla'],
        true
    ),
    new Producto(
        2,
        'Cheesecake Oreo',
        ['Pasteles'],
        52.99,
        'Cheesecake con base de galletas Oreo',
        'Suave cheesecake estilo Nueva York con base de galletas Oreo trituradas, topping de crema batida y trozos de galleta Oreo.',
        ['queso crema', 'galletas oreo', 'crema batida', 'azúcar']
    ),
    new Producto(
        3,
        'Macarons surtidos',
        ['Otros'],
        4.99,
        'Paquete de 6 macarons de diferentes sabores',
        'Delicados macarons franceses con sabores: limón, chocolate, vainilla, kiwi, mora y fresa. Hechos con ingredientes premium.',
        ['almendra', 'azúcar glas', 'clara de huevo', 'colorantes naturales']
    ),
    new Producto(
        4,
        'Tarta de Frutillas',
        ['Tartas'],
        38.50,
        'Tarta fresca con frutillas de temporada',
        'Base de masa quebrada dulce, crema pastelera casera y decoración con frutillas frescas. Glaseado brillante natural.',
        ['harina', 'mantequilla', 'frutillas', 'crema pastelera']
    ),
    new Producto(
        5,
        'Cupcake Red Velvet',
        ['Cupcakes'],
        6.99,
        'Esponjoso cupcake con frosting de queso crema',
        'Clásico cupcake Red Velvet con textura aterciopelada, topping de frosting de queso crema y decoración con virutas de chocolate blanco.',
        ['harina', 'cacao', 'colorante rojo', 'queso crema']
    ),
    new Producto(
        6,
        'Panettone Navideño',
        ['Especiales de Temporada'],
        29.99,
        'Especialidad de invierno con frutas confitadas',
        'Panettone tradicional italiano con pasas, frutas confitadas y aroma a vainilla. Presentación en caja regalo.',
        ['harina', 'mantequilla', 'huevos', 'frutas confitadas', 'vainilla'],
        true
    ),
    new Producto(
        7,
        'Red Velvet Clásico',
        ['Pasteles'],
        49.99,
        'Terciopelo rojo con frosting de queso',
        'Icono sureño americano con capas de bizcocho rojo intenso y frosting cremoso.',
        ['harina', 'suero de leche', 'cacao', 'colorante']
    ),
    new Producto(
        8,
        'Mousse de Maracuyá',
        ['Postres Individuales'],
        7.99,
        'Postre tropical en vasito individual',
        'Suave mousse de maracuyá con base de galleta y topping de fruta fresca.',
        ['maracuyá', 'crema', 'gelatina', 'galleta']
    ),
    new Producto(
        9,
        'Cupcake de Lima',
        ['Cupcakes'],
        6.50,
        'Esponjoso cupcake cítrico',
        'Base de lima con frosting de merengue italiano y ralladura natural.',
        ['lima', 'harina', 'clara de huevo', 'azúcar']
    ),
    new Producto(
        10,
        'Tarta de Manzana',
        ['Tartas'],
        34.99,
        'Clásica tarta estilo americano',
        'Finas láminas de manzana en disposición floral sobre base de canela.',
        ['manzana', 'canela', 'masa quebrada', 'mermelada']
    ),
    new Producto(
        11,
        'Alfajor Clásico',
        ['Otros'],
        2.99,
        'Dos galletas con dulce de leche',
        'Alfajor tradicional argentino bañado en chocolate semi-amargo.',
        ['harina', 'dulce de leche', 'chocolate', 'coco']
    ),
    new Producto(
        12,
        'Tronco Navideño',
        ['Especiales de Temporada'],
        39.99,
        'Tradicional bûche de Noël',
        'Bizcocho de chocolate enrollado con crema de avellanas y decoración invernal.',
        ['chocolate', 'avellanas', 'crema', 'merengue'],
        true
    ),
    new Producto(
        13,
        'Chocotorta Clásica',
        ['Pasteles'],
        42.99,
        'Capas de galleta, dulce de leche y queso crema',
        'Icono argentino con galletas Chocolinas, café y crema de dulce de leche artesanal.',
        ['galletas chocolinas', 'dulce de leche', 'queso crema', 'café'],
        true
    ),
    new Producto(
        14,
        'Flan de la Abuela',
        ['Postres Individuales'],
        5.99,
        'Crema caramelizada en vasito individual',
        'Textura sedosa con caramelo líquido y toque de vainilla natural.',
        ['huevo', 'leche', 'azúcar', 'vainilla']
    ),
    new Producto(
        15,
        'Brazo de Gitano',
        ['Postres Individuales'],
        7.50,
        'Bizcocho enrollado con crema de cacao',
        'Esponjoso rollo de vainilla relleno de crema ligera y chocolate.',
        ['huevo', 'harina', 'cacao', 'azúcar']
    ),
    new Producto(
        16,
        'Cupcake de Dulce de Leche',
        ['Cupcakes'],
        7.25,
        'Núcleo sorpresa de dulce de leche',
        'Base esponjosa coronada con merengue dorado y virutas de cacao.',
        ['dulce de leche', 'harina', 'huevo', 'azúcar']
    ),
    new Producto(
        17,
        'Tarta Santiago',
        ['Tartas'],
        41.99,
        'Tarta de almendras con cruz dorada',
        'Mezcla tostada de almendra molida y aroma a limón, glaseada al horno.',
        ['almendra', 'huevo', 'azúcar', 'limón']
    ),
    new Producto(
        18,
        'Turrón de Jijona',
        ['Otros'],
        14.99,
        'Turrón blando de almendra premium',
        'Textura cremosa con 60% almendra seleccionada y miel de flores.',
        ['almendra', 'miel', 'clara de huevo', 'azúcar']
    ),
    new Producto(
        19,
        'Polvorones Sevillanos',
        ['Especiales de Temporada'],
        9.99,
        'Galletas de almendra y manteca derretida',
        'Crujiente exterior que se deshace en la boca, espolvoreado con azúcar glass.',
        ['harina', 'almendra', 'manteca de cerdo', 'azúcar']
    ),
    new Producto(
        20,
        'Tarta de Queso Vasca',
        ['Tartas'],
        44.50,
        'Queso crema con superficie quemada',
        'Contraste entre la cremosidad interior y la costra caramelizada.',
        ['queso crema', 'huevo', 'nata', 'azúcar']
    ),
    new Producto(
        21,
        'Mini Cheesecake Frambuesa',
        ['Postres Individuales'],
        8.50,
        'Postre individual con coulis de frutos rojos',
        'Base crujiente de galleta con suave queso crema y salsa de frambuesa.',
        ['galleta', 'queso crema', 'frambuesa', 'azúcar'],
        true
    ),
    new Producto(
        22,
        'Alfajores de Maicena',
        ['Otros'],
        3.75,
        'Dos tapas unidas por dulce de leche',
        'Esponjosas galletas de maicena rellenas y espolvoreadas con coco rallado.',
        ['maicena', 'dulce de leche', 'huevo', 'coco'],
        true
    )
];

// Optimización: Carga diferida de imágenes
function inicializarLazyLoading() {
    if (!config.observer) {
        config.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazyload');
                    config.observer.unobserve(img);
                }
            });
        }, { rootMargin: '100px 0px' });
    }
    document.querySelectorAll('.lazyload').forEach(img => {
        config.observer.observe(img);
    });
}

// Función de renderizado optimizada
function renderizarProductos(productosAMostrar) {
    const contenedor = document.getElementById('productos-grid');
    if (!contenedor) return;

    let html = '';

    // Modo "todos" sin búsqueda: se usa el sistema "Ver más"/"Ver menos"
    if (config.filtroCategoria === 'todos' && config.filtroBusqueda === '') {
        const productosMostrados = productosAMostrar.slice(0, config.itemsMostrar);
        html = productosMostrados.map(producto => `
            <div class="col-md-4 mb-4">
                <div class="card h-100 producto-card">
                    <img data-src="${producto.imagen}" 
                         class="card-img-top lazyload fondo-imagen" 
                         alt="${producto.nombre}" 
                         loading="lazy"
                         style="height: 250px; object-fit: cover; background: #f5f5f5;">
                    <div class="card-body d-flex flex-column">
                        ${producto.destacado ? `<div class="badge bg-accent mb-2">¡Nuevo!</div>` : ''}
                        <h5 class="card-title">${producto.nombre}</h5>
                        <p class="card-text small">${producto.descripcionCorta}</p>
                        <div class="mt-auto">
                            <p class="h4 text-accent fw-bold">$${producto.precio.toFixed(2)}</p>
                            <div class="d-flex gap-2 mt-3">
                                <button class="btn btn-secondary btn-sm ver-detalle" data-id="${producto.id}">
                                    Ver Detalle
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    <i class="bi bi-cart-plus"></i> Añadir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    } else {
        // Para otros filtros se utiliza la paginación tradicional
        const inicio = (config.paginaActual - 1) * config.itemsPorPagina;
        const productosPagina = productosAMostrar.slice(inicio, inicio + config.itemsPorPagina);
        html = productosPagina.map(producto => `
            <div class="col-md-4 mb-4">
                <div class="card h-100 producto-card">
                    <img data-src="${producto.imagen}" 
                         class="card-img-top lazyload" 
                         alt="${producto.nombre}" 
                         loading="lazy"
                         style="height: 250px; object-fit: cover; background: #f5f5f5;">
                    <div class="card-body d-flex flex-column">
                        ${producto.destacado ? `<div class="badge bg-accent mb-2">¡Nuevo!</div>` : ''}
                        <h5 class="card-title">${producto.nombre}</h5>
                        <p class="card-text small">${producto.descripcionCorta}</p>
                        <div class="mt-auto">
                            <p class="h4 text-accent fw-bold">$${producto.precio.toFixed(2)}</p>
                            <div class="d-flex gap-2 mt-3">
                                <button class="btn btn-secondary btn-sm ver-detalle" data-id="${producto.id}">
                                    Ver Detalle
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    <i class="bi bi-cart-plus"></i> Añadir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }
    contenedor.innerHTML = html;

    // Carga diferida
    inicializarLazyLoading();

    // Actualizar contenedor de botones para modo "todos"
    if (config.filtroCategoria === 'todos' && config.filtroBusqueda === '') {
        // Si no existe el contenedor "ver-mas-container", lo creamos e insertamos después del grid
        let verMasContainer = document.getElementById('ver-mas-container');
        if (!verMasContainer) {
            verMasContainer = document.createElement('div');
            verMasContainer.id = 'ver-mas-container';
            verMasContainer.className = 'd-flex justify-content-center mt-4';
            contenedor.insertAdjacentElement('afterend', verMasContainer);
        }
        let botonesHTML = '';
        // Si se muestran 7 productos, solo se muestra "Ver más"
        if (config.itemsMostrar === 7 && productosAMostrar.length > 7) {
            botonesHTML += `<button id="btn-ver-mas" class="btn btn-accent">Ver más</button>`;
        }
        // Si se muestran 14, se muestran ambos: "Ver menos" y "Ver más" (si hay más de 14)
        if (config.itemsMostrar === 14) {
            botonesHTML += `<button id="btn-ver-menos" class="btn btn-danger me-2">Ver menos</button>`;
            if (productosAMostrar.length > 14) {
                botonesHTML += `<button id="btn-ver-mas" class="btn btn-accent">Ver más</button>`;
            }
        }
        // Si se muestran todos (22 en este caso) y se está mostrando más que 14, se muestra solo "Ver menos"
        if (config.itemsMostrar === productosAMostrar.length && config.itemsMostrar > 14) {
            botonesHTML += `<button id="btn-ver-menos" class="btn btn-danger">Ver menos</button>`;
        }
        verMasContainer.innerHTML = botonesHTML;
        
        // Asignar eventos a "Ver más" y "Ver menos"
        if(document.getElementById('btn-ver-mas')) {
            document.getElementById('btn-ver-mas').addEventListener('click', () => {
                if (config.itemsMostrar === 7) {
                    config.itemsMostrar = 14;
                } else if (config.itemsMostrar === 14) {
                    config.itemsMostrar = productosAMostrar.length;
                }
                renderizarProductos(productosAMostrar);
            });
        }
        if(document.getElementById('btn-ver-menos')) {
            document.getElementById('btn-ver-menos').addEventListener('click', () => {
                if (config.itemsMostrar === 14) {
                    config.itemsMostrar = 7;
                } else if (config.itemsMostrar === productosAMostrar.length && config.itemsMostrar > 14) {
                    config.itemsMostrar = 14;
                }
                renderizarProductos(productosAMostrar);
            });
        }
    // si el config.filtroCategoria es diferente a todos no se muestran los botones
    } else if(config.filtroCategoria !== "todos"){
        // Se ocultan los botones de "Ver más" y "Ver menos"
        const verMasContainer = document.getElementById('ver-mas-container');
        if (verMasContainer) {
            verMasContainer.innerHTML = '';
        }
    }
}

// Delegación de eventos para botones "Ver Detalle"
// Se añade una sola vez en la inicialización para evitar acumulación de event listeners.
document.addEventListener('DOMContentLoaded', () => {
    const contenedor = document.getElementById('productos-grid');
    if (contenedor) {
        contenedor.addEventListener('click', (e) => {
            const botonDetalle = e.target.closest('.ver-detalle');
            if (botonDetalle) {
                mostrarDetalleProducto(botonDetalle.dataset.id);
            }
        });
    }
});

// Función de filtrado con caché
let cacheFiltrado = {
    tiempo: 0,
    categoria: '',
    busqueda: '',
    datos: []
};

function filtrarProductos(categoria = 'todos', busqueda = '') {
    const ahora = Date.now();
    
    if (ahora - cacheFiltrado.tiempo < 5000 && 
        cacheFiltrado.categoria === categoria && 
        cacheFiltrado.busqueda === busqueda) {
        return cacheFiltrado.datos;
    }

    const resultado = productos.filter(producto => {
        const coincideCategoria = categoria === 'todos' || producto.categoria.includes(categoria);
        const coincideBusqueda = producto.nombre.toLowerCase().includes(busqueda.toLowerCase());
        return coincideCategoria && coincideBusqueda;
    });

    cacheFiltrado = {
        tiempo: ahora,
        categoria,
        busqueda,
        datos: resultado
    };

    return resultado;
}

// Control de paginación (sólo se usa para filtros distintos a "todos")
function actualizarPaginacion(totalProductos) {
    // Si estamos en modo "todos", ocultamos la paginación
    if (config.filtroCategoria === 'todos' && config.filtroBusqueda === '') {
        const paginacion = document.getElementById('paginacion');
        if (paginacion) {
            paginacion.innerHTML = '';
        }
        return;
    }

    const paginacion = document.getElementById('paginacion');
    if (!paginacion) return;

    const totalPaginas = Math.ceil(totalProductos / config.itemsPorPagina);
    
    paginacion.innerHTML = `
        <button class="btn btn-outline-accent ${config.paginaActual === 1 ? 'disabled' : ''}" 
                onclick="cambiarPagina(-1)">
            Anterior
        </button>
        <span class="mx-3">Página ${config.paginaActual} de ${totalPaginas}</span>
        <button class="btn btn-outline-accent ${config.paginaActual === totalPaginas ? 'disabled' : ''}" 
                onclick="cambiarPagina(1)">
            Siguiente
        </button>
    `;
}

function cambiarPagina(direccion) {
    // Se utilizan los filtros actuales almacenados en config
    const productosFiltrados = filtrarProductos(config.filtroCategoria, config.filtroBusqueda);
    const totalPaginas = Math.ceil(productosFiltrados.length / config.itemsPorPagina);
    
    config.paginaActual = Math.max(1, Math.min(totalPaginas, config.paginaActual + direccion));
    renderizarProductos(productosFiltrados);
    actualizarPaginacion(productosFiltrados.length);
}   

// Event Listeners optimizados
function inicializarEventos() {
    // Filtros
    document.querySelectorAll('[data-categoria]').forEach(boton => {
        boton.addEventListener('click', (e) => {
            config.paginaActual = 1;
            const categoria = e.target.dataset.categoria;
            config.filtroCategoria = categoria;
            if (categoria === 'todos') {
                config.itemsMostrar = 7;
            }
            // Quitar la clase active de todos y agregarla al botón clickeado
            document.querySelectorAll('[data-categoria]').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
    
            // Usar requestAnimationFrame para que el navegador pinte el cambio de clase
            requestAnimationFrame(() => {
                const resultados = filtrarProductos(categoria, config.filtroBusqueda);
                renderizarProductos(resultados);
                actualizarPaginacion(resultados.length);
            });
        });
    });
    

    // Buscador con debounce
    let timeoutBusqueda;
    document.getElementById('buscador').addEventListener('input', (e) => {
        clearTimeout(timeoutBusqueda);
        timeoutBusqueda = setTimeout(() => {
            config.paginaActual = 1;
            const busqueda = e.target.value;
            config.filtroBusqueda = busqueda;
            const categoriaActiva = config.filtroCategoria || 'todos';
            const resultados = filtrarProductos(categoriaActiva, busqueda);
            // Si hay búsqueda, se utiliza paginación; de lo contrario, modo "Ver más"
            renderizarProductos(resultados);
            actualizarPaginacion(resultados.length);
        }, 300);
    });

    // Detección de cambio de vista
    if (window.location.pathname.includes('producto-individual.php')) {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');
        if (productId) cargarProducto(productId);
    }
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
    inicializarEventos();
    const resultadosIniciales = filtrarProductos(config.filtroCategoria, config.filtroBusqueda);
    renderizarProductos(resultadosIniciales);
    actualizarPaginacion(resultadosIniciales.length);
});

// Función para redireccionar al detalle del producto
function mostrarDetalleProducto(id) {
    window.location.href = `producto-individual.php?id=${id}`;
}

// Función para cargar el producto individual
function cargarProducto(id) {
    const producto = productos.find(p => p.id == id);
    if (!producto) {
        window.location.href = 'productos.php';
        return;
    }

    const contenedor = document.getElementById('detalle-producto');
    if (contenedor) {
        contenedor.innerHTML = `
            <div class="col-lg-6 mb-4">
                <img src="${producto.imagen}" class="img-fluid rounded-3" alt="${producto.nombre}" style="max-height: 500px; object-fit: cover;">
            </div>
            <div class="col-lg-6 mb-4">
                <h1 class="mb-3">${producto.nombre}</h1>
                <p class="detalle-precio">$${producto.precio.toFixed(2)}</p>
                <div class="mb-4">
                    <h4 class="fw-bold">Descripción</h4>
                    <p class="lead">${producto.descripcionLarga}</p>
                </div>
                <div class="mb-4">
                    <h4 class="fw-bold">Ingredientes</h4>
                    <div class="d-flex flex-wrap gap-2">
                        ${producto.ingredientes.map(ing => `
                            <span class="badge" style="background-color: var(--fixed-accent);">${ing}</span>
                        `).join('')}
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <button class="btn btn-primary btn-lg flex-grow-1">
                        <i class="bi bi-cart-plus"></i> Añadir al Carrito
                    </button>
                </div>
            </div>
        `;
    }

    // Productos Relacionados
    const relacionados = productos.filter(p => 
        p.categoria.some(cat => producto.categoria.includes(cat)) && 
        p.id !== producto.id
    ).slice(0, 3);
    
    renderizarProductosRelacionados(relacionados);
}

function renderizarProductosRelacionados(productos) {
    const contenedor = document.getElementById('productos-relacionados');
    contenedor.innerHTML = productos.map(p => `
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="background-color: var(--white) !important; color: var(--dark-text) !important    ;">
                <img src="${p.imagen}" class="card-img-top" alt="${p.nombre}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">${p.nombre}</h5>
                    <p class="fw-bold">$${p.precio.toFixed(2)}</p>
                    <a href="producto-individual.php?id=${p.id}" class="btn btn-secondary btn-sm">
                        Ver Detalle
                    </a>
                </div>
            </div>
        </div>
    `).join('');
}

// Al cargar producto-individual.php
if (window.location.pathname.includes('producto-individual.php')) {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');
    if (productId) {
        cargarProducto(productId);
    } else {
        window.location.href = 'productos.php';
    }
}