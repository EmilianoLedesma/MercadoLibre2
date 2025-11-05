

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startPush('styles'); ?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Jost', sans-serif;
        background-color: #FFFFFF;
        color: #212529;
    }

    .product-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 80px;
    }

    /* Product Images */
    .product-images {
        position: sticky;
        top: 120px;
        height: fit-content;
    }

    .main-image-container {
        width: 100%;
        padding-top: 125%;
        position: relative;
        background-color: #F5F6F2;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .main-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-thumbnails {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .thumbnail {
        padding-top: 100%;
        position: relative;
        background-color: #F5F6F2;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .thumbnail.active {
        border-color: #EE403D;
    }

    .thumbnail img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Info */
    .product-detail-info {
        font-family: 'Jost', sans-serif;
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .star {
        color: #FFC107;
        font-size: 16px;
    }

    .star.empty {
        color: #E5E5E5;
    }

    .reviews-count {
        color: #666;
        font-size: 14px;
    }

    .product-title {
        font-size: 32px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .product-price {
        margin-bottom: 24px;
    }

    .price-current {
        font-size: 36px;
        font-weight: 700;
        color: #EE403D;
    }

    .price-original {
        font-size: 24px;
        color: #999;
        text-decoration: line-through;
        margin-left: 12px;
    }

    .stock-badge {
        display: inline-block;
        background-color: #28A745;
        color: white;
        padding: 6px 16px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .stock-badge.low {
        background-color: #FFC107;
    }

    .stock-badge.out {
        background-color: #DC3545;
    }

    .product-description {
        color: #666;
        line-height: 1.8;
        margin-bottom: 32px;
    }

    /* Admin Badges */
    .admin-badges {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .admin-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .admin-badge.featured {
        background-color: #667eea;
    }

    .admin-badge.inactive {
        background-color: #64748b;
    }

    /* Product Options */
    .product-options {
        margin-bottom: 32px;
    }

    .option-group {
        margin-bottom: 24px;
    }

    .option-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 12px;
    }

    .option-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .option-btn {
        padding: 12px 24px;
        border: 2px solid #E5E5E5;
        background-color: white;
        color: #666;
        font-size: 14px;
        font-weight: 500;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .option-btn.active,
    .option-btn:hover {
        border-color: #EE403D;
        color: #EE403D;
    }

    /* Quantity Selector */
    .quantity-selector {
        margin-bottom: 32px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #E5E5E5;
        background-color: white;
        color: #212529;
        font-size: 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .qty-btn:hover {
        background-color: #F8F8F8;
    }

    .qty-input {
        width: 80px;
        height: 40px;
        border: 1px solid #E5E5E5;
        text-align: center;
        font-size: 16px;
        border-radius: 4px;
    }

    /* Actions */
    .product-actions {
        display: flex;
        gap: 12px;
        margin-bottom: 32px;
    }

    .btn-add-cart {
        flex: 1;
        padding: 16px 32px;
        background-color: #EE403D;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-add-cart:hover {
        background-color: #E32020;
    }

    .btn-wishlist,
    .btn-edit,
    .btn-delete {
        width: 48px;
        height: 48px;
        border: 2px solid #E5E5E5;
        background-color: white;
        color: #666;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-edit {
        border-color: #667eea;
        color: #667eea;
    }

    .btn-edit:hover {
        background-color: #667eea;
        color: white;
    }

    .btn-delete {
        border-color: #DC3545;
        color: #DC3545;
    }

    .btn-delete:hover {
        background-color: #DC3545;
        color: white;
    }

    .btn-wishlist:hover {
        border-color: #EE403D;
        color: #EE403D;
    }

    /* Meta Info */
    .product-meta-info {
        border-top: 1px solid #E5E5E5;
        padding-top: 24px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #F8F8F8;
    }

    .meta-label {
        font-weight: 600;
        color: #212529;
        min-width: 120px;
    }

    .meta-value {
        color: #666;
    }

    .stock-status {
        color: #28A745;
        font-weight: 600;
    }

    .stock-status.out {
        color: #DC3545;
    }

    /* Product Tabs */
    .product-tabs {
        margin-top: 60px;
    }

    .tabs-header {
        display: flex;
        gap: 32px;
        border-bottom: 2px solid #E5E5E5;
        margin-bottom: 32px;
    }

    .tab-btn {
        padding: 16px 0;
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        color: #666;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: -2px;
    }

    .tab-btn.active {
        color: #EE403D;
        border-bottom-color: #EE403D;
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    .full-description {
        color: #666;
        line-height: 2;
        font-size: 15px;
    }

    .details-table {
        width: 100%;
        border-collapse: collapse;
    }

    .details-table tr {
        border-bottom: 1px solid #E5E5E5;
    }

    .details-table th,
    .details-table td {
        padding: 16px;
        text-align: left;
    }

    .details-table th {
        font-weight: 600;
        color: #212529;
        width: 200px;
    }

    .details-table td {
        color: #666;
    }

    /* Breadcrumb */
    .breadcrumb-container {
        background-color: #F8F8F8;
        padding: 20px 0;
    }

    .breadcrumb {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        font-size: 14px;
        color: #666;
    }

    .breadcrumb a {
        color: #666;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: #EE403D;
    }

    .breadcrumb span {
        margin: 0 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .product-images {
            position: static;
        }

        .product-title {
            font-size: 24px;
        }

        .price-current {
            font-size: 28px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Breadcrumb -->
<div class="breadcrumb-container">
    <div class="breadcrumb">
        <a href="<?php echo e(route('home')); ?>">Inicio</a>
        <span>/</span>
        <a href="<?php echo e(route('products.index')); ?>">Productos</a>
        <span>/</span>
        <span style="color: #212529; font-weight: 500;"><?php echo e($product->name); ?></span>
    </div>
</div>

<!-- Product Detail -->
<div class="product-detail-container">
    <div class="product-detail-grid">
        <!-- Product Images -->
        <div class="product-images">
            <?php
                $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                $images = $images ?? [];
                
                if (count($images) > 0) {
                    $mainImage = $images[0];
                    $mainStorage = public_path('storage/' . $mainImage);
                    $mainPublic = public_path($mainImage);
                    
                    if (file_exists($mainStorage)) {
                        $mainUrl = asset('storage/' . $mainImage);
                    } elseif (file_exists($mainPublic)) {
                        $mainUrl = asset($mainImage);
                    } else {
                        $mainUrl = asset('images/placeholder-product.svg');
                    }
                } else {
                    $mainUrl = asset('images/placeholder-product.svg');
                }
            ?>

            <div class="main-image-container">
                <img src="<?php echo e($mainUrl); ?>" alt="<?php echo e($product->name); ?>" class="main-image" id="mainImage">
            </div>

            <?php if(count($images) > 1): ?>
            <div class="image-thumbnails">
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $storagePath = public_path('storage/' . $image);
                        $publicPath = public_path($image);
                        
                        if (file_exists($storagePath)) {
                            $thumbUrl = asset('storage/' . $image);
                        } elseif (file_exists($publicPath)) {
                            $thumbUrl = asset($image);
                        } else {
                            $thumbUrl = asset('images/placeholder-product.svg');
                        }
                    ?>
                    <div class="thumbnail <?php echo e($index === 0 ? 'active' : ''); ?>" onclick="changeImage('<?php echo e($thumbUrl); ?>', this)">
                        <img src="<?php echo e($thumbUrl); ?>" alt="<?php echo e($product->name); ?> - <?php echo e($index + 1); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="product-detail-info">
            <!-- Admin Badges -->
            <div class="admin-badges">
                <?php if($product->is_featured): ?>
                    <span class="admin-badge featured">⭐ Destacado</span>
                <?php endif; ?>
                <?php if(!$product->is_active): ?>
                    <span class="admin-badge inactive">❌ Inactivo</span>
                <?php endif; ?>
            </div>

            <div class="product-meta">
                <div class="product-rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star empty">★</span>
                </div>
                <span class="reviews-count">(24 reseñas)</span>
            </div>

            <h1 class="product-title"><?php echo e($product->name); ?></h1>

            <div class="product-price">
                <?php if($product->sale_price): ?>
                    <span class="price-current">$<?php echo e(number_format($product->sale_price, 2)); ?></span>
                    <span class="price-original">$<?php echo e(number_format($product->price, 2)); ?></span>
                <?php else: ?>
                    <span class="price-current">$<?php echo e(number_format($product->price, 2)); ?></span>
                <?php endif; ?>
            </div>

            <?php if($product->stock_quantity > 0): ?>
                <span class="stock-badge <?php echo e($product->stock_quantity < 10 ? 'low' : ''); ?>">
                    Disponible (<?php echo e($product->stock_quantity); ?>)
                </span>
            <?php else: ?>
                <span class="stock-badge out">Agotado</span>
            <?php endif; ?>

            <p class="product-description">
                <?php echo e($product->short_description ?? $product->description); ?>

            </p>

            <!-- Quantity -->
            <div class="quantity-selector">
                <label class="option-label">Cantidad:</label>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="decrementQty()">−</button>
                    <input type="number" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>" class="qty-input" id="qtyInput">
                    <button class="qty-btn" onclick="incrementQty()">+</button>
                </div>
            </div>

            <!-- Actions -->
            <div class="product-actions">
                <button class="btn-add-cart">
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
                <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn-edit" title="Editar">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>

            <!-- Meta Info -->
            <div class="product-meta-info">
                <div class="meta-item">
                    <span class="meta-label">SKU:</span>
                    <span class="meta-value"><?php echo e($product->sku); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Categoría:</span>
                    <span class="meta-value"><?php echo e($product->category->name ?? 'Sin categoría'); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Vendedor:</span>
                    <span class="meta-value"><?php echo e($product->user->name ?? 'Desconocido'); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Stock:</span>
                    <span class="stock-status <?php echo e($product->stock_quantity > 0 ? '' : 'out'); ?>">
                        <?php echo e($product->stock_quantity > 0 ? 'Disponible (' . $product->stock_quantity . ')' : 'Agotado'); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="product-tabs">
        <div class="tabs-header">
            <button class="tab-btn active" onclick="switchTab('description')">Descripción Completa</button>
            <button class="tab-btn" onclick="switchTab('details')">Información Adicional</button>
        </div>

        <div class="tabs-content">
            <div class="tab-panel active" id="description">
                <div class="full-description">
                    <?php echo nl2br(e($product->description)); ?>

                </div>
            </div>

            <div class="tab-panel" id="details">
                <table class="details-table">
                    <tbody>
                        <tr>
                            <th>ID del Producto</th>
                            <td>#<?php echo e($product->id); ?></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><?php echo e($product->slug); ?></td>
                        </tr>
                        <tr>
                            <th>Fecha de Creación</th>
                            <td><?php echo e($product->created_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                        <tr>
                            <th>Última Actualización</th>
                            <td><?php echo e($product->updated_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>
                                <span style="color: <?php echo e($product->is_active ? '#28A745' : '#DC3545'); ?>; font-weight: 600;">
                                    <?php echo e($product->is_active ? '✓ Activo' : '✗ Inactivo'); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Destacado</th>
                            <td><?php echo e($product->is_featured ? '⭐ Sí' : 'No'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(url, element) {
        document.getElementById('mainImage').src = url;
        
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        element.classList.add('active');
    }

    function switchTab(tabName) {
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.remove('active');
        });

        event.target.classList.add('active');
        document.getElementById(tabName).classList.add('active');
    }

    function incrementQty() {
        const input = document.getElementById('qtyInput');
        const max = parseInt(input.max);
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }

    function decrementQty() {
        const input = document.getElementById('qtyInput');
        const min = parseInt(input.min);
        const current = parseInt(input.value);
        if (current > min) {
            input.value = current - 1;
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Lenguajes Automatas\MercadoLibre2\resources\views/products/show.blade.php ENDPATH**/ ?>