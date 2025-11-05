<?php $__env->startSection('title', 'Editar Producto'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <h1>SEALS</h1>
            </div>

            <nav class="nav">
                <a href="<?php echo e(route('home')); ?>" class="nav-link">Inicio</a>
                <a href="<?php echo e(route('products.index')); ?>" class="nav-link active">Productos</a>
                <a href="<?php echo e(route('categories')); ?>" class="nav-link">Categorías</a>
                <a href="#" class="nav-link">Contacto</a>
            </nav>

            <div class="header-actions">
                <?php if(auth()->guard()->check()): ?>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="color: #333; font-weight: 500;">Hola, <?php echo e(Auth::user()->name); ?></span>
                        <a href="<?php echo e(route('account')); ?>" class="nav-link" style="margin: 0;">Mi cuenta</a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="icon-btn" style="background: none; border: none; cursor: pointer;">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="icon-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
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
</header>

<main class="product-form-page">
    <div class="container">
        <div class="page-header">
            <h1>Editar Producto</h1>
            <div class="header-actions">
                <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-secondary">Ver Detalles</a>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline">Volver a Lista</a>
            </div>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="<?php echo e(route('products.update', $product)); ?>" method="POST" enctype="multipart/form-data" class="product-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="form-grid">
                    <div class="form-section">
                        <h3>Información Básica</h3>
                        
                        <div class="form-group">
                            <label for="name">Nombre del Producto<span class="required">*</span></label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name', $product->name)); ?>" required class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="sku">SKU (Código)<span class="required">*</span></label>
                            <input type="text" id="sku" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>" required class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="category_id">Categoría<span class="required">*</span></label>
                            <select id="category_id" name="category_id" required class="form-control">
                                <option value="">Seleccionar categoría</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group half">
                                <label for="price">Precio<span class="required">*</span></label>
                                <input type="number" id="price" name="price" value="<?php echo e(old('price', $product->price)); ?>" step="0.01" min="0" required class="form-control">
                            </div>
                            
                            <div class="form-group half">
                                <label for="sale_price">Precio de Oferta</label>
                                <input type="number" id="sale_price" name="sale_price" value="<?php echo e(old('sale_price', $product->sale_price)); ?>" step="0.01" min="0" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="stock_quantity">Cantidad en Stock<span class="required">*</span></label>
                            <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo e(old('stock_quantity', $product->stock_quantity)); ?>" min="0" required class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3>Descripción</h3>
                        
                        <div class="form-group">
                            <label for="short_description">Descripción Corta</label>
                            <textarea id="short_description" name="short_description" rows="3" class="form-control"><?php echo e(old('short_description', $product->short_description)); ?></textarea>
                            <small>Breve resumen del producto (máximo 500 caracteres)</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Descripción Completa<span class="required">*</span></label>
                            <textarea id="description" name="description" rows="6" required class="form-control"><?php echo e(old('description', $product->description)); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3>Imágenes</h3>
                        
                        <div class="form-group">
                            <label>Imágenes Actuales</label>
                            <div class="current-images">
                                <?php
                                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                    $images = $images ?? [];
                                ?>
                                
                                <?php if(count($images) > 0): ?>
                                    <div class="image-grid">
                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="image-item">
                                                <div class="image-preview">
                                                    <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="<?php echo e($product->name); ?>">
                                                </div>
                                                <div class="image-actions">
                                                    <label class="checkbox-container">
                                                        <input type="checkbox" name="delete_images[]" value="<?php echo e($index); ?>">
                                                        <span class="checkmark"></span>
                                                        Eliminar
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p class="no-images-message">No hay imágenes disponibles para este producto.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="images">Añadir Nuevas Imágenes</label>
                            <div class="image-upload-container">
                                <input type="file" id="images" name="images[]" multiple accept="image/*" class="image-upload">
                                <div class="upload-placeholder">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                    <span>Arrastra imágenes o haz clic para seleccionar</span>
                                </div>
                                <div class="image-preview" id="imagePreview"></div>
                            </div>
                            <small>Se pueden subir múltiples imágenes (JPG, PNG, GIF - máx. 2MB cada una)</small>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3>Opciones</h3>
                        
                        <div class="form-group checkbox">
                            <input type="checkbox" id="is_active" name="is_active" value="1" <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?>>
                            <label for="is_active">Producto Activo</label>
                        </div>
                        
                        <div class="form-group checkbox">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?>>
                            <label for="is_featured">Producto Destacado</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; <?php echo e(date('Y')); ?> SEALS. Todos los derechos reservados.</p>
    </div>
</footer>

<style>
    /* Estilos específicos para el formulario de productos */
    .product-form-page {
        padding: 40px 0;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 28px;
        color: #333;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #667eea;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background: #5a6acf;
    }

    .btn-secondary {
        background: #64748b;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .btn-outline {
        background: transparent;
        color: #64748b;
        border: 1px solid #cbd5e0;
    }

    .btn-outline:hover {
        background: #f1f5f9;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section h3 {
        font-size: 18px;
        color: #334155;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-group.half {
        width: 50%;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #334155;
    }

    .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e0;
        border-radius: 4px;
        font-size: 16px;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
    }

    small {
        display: block;
        margin-top: 4px;
        font-size: 12px;
        color: #64748b;
    }

    .form-group.checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group.checkbox label {
        margin-bottom: 0;
    }

    /* Estilos para imágenes actuales */
    .current-images {
        margin-bottom: 20px;
        max-width: 100%;
        overflow: hidden;
    }

    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
    }

    .image-item {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .image-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .image-item .image-preview {
        width: 100%;
        height: 150px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8fafc;
    }

    .image-item .image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .image-actions {
        padding: 8px;
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #64748b;
        cursor: pointer;
    }

    .checkbox-container input {
        margin-right: 5px;
    }

    .no-images-message {
        color: #64748b;
        font-style: italic;
        padding: 10px 0;
    }

    /* Estilos para carga de nuevas imágenes */
    .image-upload-container {
        border: 2px dashed #cbd5e0;
        border-radius: 4px;
        padding: 20px;
        text-align: center;
        position: relative;
        transition: all 0.2s ease;
        margin-bottom: 10px;
        max-width: 100%;
        overflow: hidden;
    }

    .image-upload-container:hover {
        border-color: #667eea;
    }

    .image-upload {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .upload-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        color: #64748b;
        padding: 20px 0;
    }

    .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 15px;
    }
    
    .preview-item {
        width: 150px;
        height: 150px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
        position: relative;
    }
    
    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Estilos para acciones del formulario */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
    }

    /* Estilos para errores */
    .is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('images');
        const imagePreview = document.getElementById('imagePreview');
        
        imageInput.addEventListener('change', function() {
            imagePreview.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach(file => {
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'preview-item';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'preview-image';
                            img.alt = file.name;
                            
                            imgContainer.appendChild(img);
                            imagePreview.appendChild(imgContainer);
                        }
                        
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/products/edit.blade.php ENDPATH**/ ?>