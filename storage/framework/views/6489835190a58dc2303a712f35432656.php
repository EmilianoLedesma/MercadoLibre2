<?php $__env->startSection('title', 'Gestión de Productos'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Header */
    .header {
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .top-bar {
        background: #EE403D;
        color: white;
        padding: 8px 0;
        text-align: center;
        font-size: 14px;
    }

    .header-main {
        padding: 16px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo h1 {
        font-family: 'Jost', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .nav {
        display: flex;
        gap: 32px;
    }

    .nav-link {
        font-family: 'Jost', sans-serif;
        font-size: 15px;
        color: #666;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #EE403D;
    }

    .header-actions {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        transition: color 0.3s;
        position: relative;
        padding: 8px;
    }

    .icon-btn:hover {
        color: #EE403D;
    }

    .cart-count {
        position: absolute;
        top: 0;
        right: 0;
        background: #EE403D;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    /* Breadcrumb */
    .breadcrumb {
        padding: 20px 0;
        background: #F8F9FA;
    }

    .breadcrumb-nav {
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 14px;
    }

    .breadcrumb-nav a {
        color: #666;
        text-decoration: none;
    }

    .breadcrumb-nav a:hover {
        color: #EE403D;
    }

    .breadcrumb-nav span {
        color: #212529;
        font-weight: 500;
    }

    /* Main Content */
    .products-page {
        padding: 40px 0 80px;
        background: #F8F9FA;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .page-header h1 {
        font-family: 'Jost', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .btn-new-product {
        background-color: #EE403D;
        color: white;
        padding: 12px 28px;
        border-radius: 4px;
        text-decoration: none;
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-new-product:hover {
        background-color: #E32020;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(238, 64, 61, 0.3);
    }

    /* Alert Messages */
    .alert {
        padding: 16px 20px;
        border-radius: 4px;
        margin-bottom: 24px;
        font-size: 15px;
        font-family: 'Jost', sans-serif;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Table Container */
    .table-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Products Table */
    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead {
        background-color: #F8F9FA;
    }

    .products-table thead th {
        padding: 16px 20px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e9ecef;
        font-family: 'Jost', sans-serif;
    }

    .products-table tbody tr {
        border-bottom: 1px solid #f1f3f5;
        transition: background-color 0.2s ease;
    }

    .products-table tbody tr:hover {
        background-color: #F8F9FA;
    }

    .products-table tbody td {
        padding: 20px;
        color: #495057;
        font-size: 14px;
        vertical-align: middle;
        font-family: 'Jost', sans-serif;
    }

    /* ID Column */
    .products-table tbody td:first-child {
        font-weight: 600;
        color: #212529;
    }

    /* Product Image */
    .product-image {
        width: 60px;
        height: 60px;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
        background-color: #F8F9FA;
    }

    /* Product Name */
    .product-name {
        font-weight: 500;
        color: #212529;
        max-width: 300px;
    }

    /* Price */
    .product-price {
        font-weight: 600;
        color: #212529;
    }

    /* Stock */
    .product-stock {
        font-weight: 500;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
    }

    .status-badge.active {
        background-color: #d4edda;
        color: #28a745;
    }

    .status-badge.inactive {
        background-color: #f8d7da;
        color: #dc3545;
    }

    /* Action Buttons */
    .actions-cell {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: transparent;
        text-decoration: none;
    }

    .btn-action.view {
        color: #6c757d;
    }

    .btn-action.view:hover {
        background-color: #e9ecef;
        color: #495057;
    }

    .btn-action.edit {
        color: #EE403D;
    }

    .btn-action.edit:hover {
        background-color: #ffe5e4;
        color: #E32020;
    }

    .btn-action.delete {
        color: #dc3545;
    }

    .btn-action.delete:hover {
        background-color: #ffe5e8;
        color: #c82333;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 20px;
        margin-bottom: 8px;
        color: #495057;
        font-family: 'Jost', sans-serif;
    }

    .empty-state p {
        font-size: 14px;
        margin-bottom: 24px;
        font-family: 'Jost', sans-serif;
    }

    /* Pagination */
    .pagination-container {
        padding: 24px;
        display: flex;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 16px;
        }

        .nav {
            gap: 16px;
        }

        .page-header {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }

        .products-table {
            font-size: 13px;
        }

        .products-table thead th {
            padding: 12px;
            font-size: 11px;
        }

        .products-table tbody td {
            padding: 12px;
        }

        .product-name {
            max-width: 150px;
            font-size: 13px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Top Bar -->
<div class="top-bar">
    Envío gratis en compras mayores a $100
</div>

<!-- Header -->
<header class="header">
    <div class="header-main">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1>SEALS</h1>
                </div>

                <nav class="nav">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link">Inicio</a>
                    <a href="<?php echo e(route('shop.index')); ?>" class="nav-link">Shop</a>
                    <a href="<?php echo e(route('categories')); ?>" class="nav-link">Categorías</a>
                    <a href="<?php echo e(route('products.index')); ?>" class="nav-link active">Productos</a>
                </nav>

                <div class="header-actions">
                    <button class="icon-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>

                    <?php if(auth()->guard()->check()): ?>
                        <div style="display: flex; align-items: center; gap: 16px;">
                            <span style="color: #666; font-weight: 500; font-size: 14px;">Hola, <?php echo e(Auth::user()->name); ?></span>
                            <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="icon-btn" title="Cerrar Sesión">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="icon-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 1-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('cart')); ?>" class="icon-btn cart">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="<?php echo e(route('home')); ?>">Inicio</a>
            <span>/</span>
            <span>Productos</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="products-page">
    <div class="container">
        <div class="page-header">
            <h1>Gestión de Productos</h1>
            <a href="<?php echo e(route('products.create')); ?>" class="btn-new-product">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nuevo Producto
            </a>
        </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            ✓ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="table-card">
        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IMAGEN</th>
                    <th>NOMBRE</th>
                    <th>SKU</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <th>CATEGORÍA</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($product->id); ?></td>
                        <td>
                            <div class="product-image">
                                <?php
                                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                    $images = $images ?? [];
                                    $imagePath = !empty($images) ? $images[0] : null;
                                    
                                    if ($imagePath) {
                                        $storageFile = public_path('storage/' . $imagePath);
                                        $publicFile = public_path($imagePath);
                                        
                                        if (file_exists($storageFile)) {
                                            $imageUrl = asset('storage/' . $imagePath);
                                        } elseif (file_exists($publicFile)) {
                                            $imageUrl = asset($imagePath);
                                        } else {
                                            $imageUrl = asset('images/placeholder-product.svg');
                                        }
                                    } else {
                                        $imageUrl = asset('images/placeholder-product.svg');
                                    }
                                ?>
                                <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($product->name); ?>">
                            </div>
                        </td>
                        <td class="product-name"><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->sku); ?></td>
                        <td class="product-price">$<?php echo e(number_format($product->price, 2)); ?></td>
                        <td class="product-stock"><?php echo e($product->stock_quantity); ?></td>
                        <td><?php echo e($product->category->name ?? 'N/A'); ?></td>
                        <td>
                            <span class="status-badge <?php echo e($product->is_active ? 'active' : 'inactive'); ?>">
                                <?php echo e($product->is_active ? 'Activo' : 'Inactivo'); ?>

                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="<?php echo e(route('products.show', $product)); ?>" class="btn-action view" title="Ver">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn-action edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action delete" title="Eliminar">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <h3>No hay productos</h3>
                            <p>Comienza agregando tu primer producto</p>
                            <a href="<?php echo e(route('products.create')); ?>" class="btn-new-product">
                                Crear Producto
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if($products->hasPages()): ?>
        <div class="pagination-container">
            <?php echo e($products->links()); ?>

        </div>
        <?php endif; ?>
    </div>
    </div>
</main>

<!-- Footer -->
<footer class="footer" style="background-color: #212529; color: white; padding: 60px 0 20px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <!-- Columna 1 -->
            <div>
                <h3 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; margin-bottom: 20px;">SEALS</h3>
                <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD; line-height: 1.6;">
                    Tu tienda online de confianza. Encuentra los mejores productos al mejor precio.
                </p>
            </div>

            <!-- Columna 2 -->
            <div>
                <h4 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; margin-bottom: 16px;">Enlaces Rápidos</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 12px;">
                        <a href="<?php echo e(route('home')); ?>" style="font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD; text-decoration: none; transition: color 0.3s;">Inicio</a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <a href="<?php echo e(route('shop.index')); ?>" style="font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD; text-decoration: none; transition: color 0.3s;">Shop</a>
                    </li>
                    <li style="margin-bottom: 12px;">
                        <a href="<?php echo e(route('categories')); ?>" style="font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD; text-decoration: none; transition: color 0.3s;">Categorías</a>
                    </li>
                </ul>
            </div>

            <!-- Columna 3 -->
            <div>
                <h4 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; margin-bottom: 16px;">Contacto</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 12px; font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD;">
                        📧 info@seals.com
                    </li>
                    <li style="margin-bottom: 12px; font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD;">
                        📞 +0020 500
                    </li>
                    <li style="margin-bottom: 12px; font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD;">
                        📍 Buenos Aires, Argentina
                    </li>
                </ul>
            </div>

            <!-- Columna 4 -->
            <div>
                <h4 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; margin-bottom: 16px;">Síguenos</h4>
                <div style="display: flex; gap: 16px;">
                    <a href="#" style="color: #ADB5BD; transition: color 0.3s;">
                        <i class="fab fa-facebook" style="font-size: 20px;"></i>
                    </a>
                    <a href="#" style="color: #ADB5BD; transition: color 0.3s;">
                        <i class="fab fa-instagram" style="font-size: 20px;"></i>
                    </a>
                    <a href="#" style="color: #ADB5BD; transition: color 0.3s;">
                        <i class="fab fa-twitter" style="font-size: 20px;"></i>
                    </a>
                    <a href="#" style="color: #ADB5BD; transition: color 0.3s;">
                        <i class="fab fa-youtube" style="font-size: 20px;"></i>
                    </a>
                </div>
            </div>
        </div>

        <div style="border-top: 1px solid #495057; padding-top: 20px; text-align: center;">
            <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #ADB5BD; margin: 0;">
                &copy; <?php echo e(date('Y')); ?> SEALS. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Lenguajes Automatas\MercadoLibre2\resources\views/products/index.blade.php ENDPATH**/ ?>