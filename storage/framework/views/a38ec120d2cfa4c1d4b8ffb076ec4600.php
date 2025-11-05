<?php $__env->startSection('title', 'Crear Producto'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Crear Producto
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="<?php echo e(route('home')); ?>" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <a href="<?php echo e(route('products.index')); ?>" style="color: #666; text-decoration: none;">Productos</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Crear</span>
        </nav>
    </div>
</div>

<!-- Main Content -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Back Button -->
        <div style="margin-bottom: 32px;">
            <a href="<?php echo e(route('products.index')); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #666; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 500; font-size: 15px; transition: color 0.3s;" onmouseover="this.style.color='#EE403D'" onmouseout="this.style.color='#666'">
                <i class="fas fa-arrow-left"></i>
                Volver a Productos
            </a>
        </div>

        <!-- Error Messages -->
        <?php if($errors->any()): ?>
            <div style="background: #FEE2E2; border: 1px solid #FECACA; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px;">
                <div style="display: flex; align-items-start; gap: 12px;">
                    <i class="fas fa-exclamation-circle" style="color: #991B1B; font-size: 20px; margin-top: 2px;"></i>
                    <div style="flex: 1;">
                        <h3 style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #991B1B; margin: 0 0 8px 0;">
                            Por favor corrige los siguientes errores:
                        </h3>
                        <ul style="margin: 0; padding-left: 20px; color: #991B1B; font-family: 'Jost', sans-serif; font-size: 14px;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">

                <!-- Column 1 -->
                <div>
                    <!-- Información Básica -->
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                        <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                            Información Básica
                        </h3>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                Nombre del Producto <span style="color: #EF4444;">*</span>
                            </label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                SKU (Código) <span style="color: #EF4444;">*</span>
                            </label>
                            <input type="text" name="sku" value="<?php echo e(old('sku')); ?>" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                Categoría <span style="color: #EF4444;">*</span>
                            </label>
                            <select name="category_id" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s; background: white;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'">
                                <option value="">Seleccionar categoría</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                    Precio <span style="color: #EF4444;">*</span>
                                </label>
                                <input type="number" name="price" value="<?php echo e(old('price')); ?>" step="0.01" min="0" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                    Precio de Oferta
                                </label>
                                <input type="number" name="sale_price" value="<?php echo e(old('sale_price')); ?>" step="0.01" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'">
                            </div>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                Cantidad en Stock <span style="color: #EF4444;">*</span>
                            </label>
                            <input type="number" name="stock_quantity" value="<?php echo e(old('stock_quantity', 0)); ?>" min="0" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'">
                        </div>
                    </div>

                    <!-- Opciones -->
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                            Opciones
                        </h3>

                        <div style="margin-bottom: 16px;">
                            <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                                <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', '1') ? 'checked' : ''); ?> style="width: 20px; height: 20px; cursor: pointer;">
                                <span style="font-family: 'Jost', sans-serif; font-size: 15px; color: #212529; font-weight: 500;">Producto Activo</span>
                            </label>
                        </div>

                        <div>
                            <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                                <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured') ? 'checked' : ''); ?> style="width: 20px; height: 20px; cursor: pointer;">
                                <span style="font-family: 'Jost', sans-serif; font-size: 15px; color: #212529; font-weight: 500;">Producto Destacado</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div>
                    <!-- Descripción -->
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                        <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                            Descripción
                        </h3>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                Descripción Corta
                            </label>
                            <textarea name="short_description" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s; resize: vertical;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'"><?php echo e(old('short_description')); ?></textarea>
                            <small style="display: block; margin-top: 6px; font-size: 13px; color: #666; font-family: 'Jost', sans-serif;">
                                Breve resumen del producto (máximo 500 caracteres)
                            </small>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 8px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                Descripción Completa <span style="color: #EF4444;">*</span>
                            </label>
                            <textarea name="description" rows="6" required style="width: 100%; padding: 12px 16px; border: 1px solid #E5E5E5; border-radius: 8px; font-family: 'Jost', sans-serif; font-size: 15px; transition: border-color 0.3s; resize: vertical;" onfocus="this.style.borderColor='#EE403D'" onblur="this.style.borderColor='#E5E5E5'"><?php echo e(old('description')); ?></textarea>
                        </div>
                    </div>

                    <!-- Imágenes -->
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #212529; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 2px solid #F5F6F2;">
                            Imágenes
                        </h3>

                        <div>
                            <label style="display: block; margin-bottom: 12px; font-family: 'Jost', sans-serif; font-weight: 600; color: #212529; font-size: 14px;">
                                Imágenes del Producto
                            </label>
                            <div style="border: 2px dashed #E5E5E5; border-radius: 8px; padding: 32px; text-align: center; position: relative; transition: all 0.3s; background: #FAFAFA;" id="uploadContainer">
                                <input type="file" name="images[]" multiple accept="image/*" id="imageInput" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 2;">
                                <div id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #CCC; margin-bottom: 16px;"></i>
                                    <p style="font-family: 'Jost', sans-serif; font-size: 15px; color: #666; margin: 0;">
                                        Arrastra imágenes o haz clic para seleccionar
                                    </p>
                                </div>
                                <div id="imagePreview" style="display: flex; flex-wrap: wrap; gap: 12px; padding-top: 20px; justify-content: center;"></div>
                            </div>
                            <small style="display: block; margin-top: 8px; font-size: 13px; color: #666; font-family: 'Jost', sans-serif;">
                                Se pueden subir múltiples imágenes (JPG, PNG, GIF - máx. 2MB cada una)
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; padding-top: 32px; border-top: 1px solid #E5E5E5;">
                <a href="<?php echo e(route('products.index')); ?>" style="padding: 14px 32px; border-radius: 8px; border: 1px solid #E5E5E5; background: white; color: #666; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.backgroundColor='#F8F9FA'" onmouseout="this.style.backgroundColor='white'">
                    Cancelar
                </a>
                <button type="submit" style="padding: 14px 32px; border-radius: 8px; border: none; background: #EE403D; color: white; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#E32020'" onmouseout="this.style.backgroundColor='#EE403D'">
                    <i class="fas fa-plus-circle"></i> Crear Producto
                </button>
            </div>
        </form>
    </div>
</section>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startPush('styles'); ?>
<style>
#uploadContainer:hover {
    border-color: #EE403D;
    background: #FFF5F5;
}

.preview-item {
    width: 120px;
    height: 120px;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #E5E5E5;
    position: relative;
}

.preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@media (max-width: 768px) {
    section > div > form > div {
        grid-template-columns: 1fr !important;
        gap: 24px !important;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');

    imageInput.addEventListener('change', function() {
        imagePreview.innerHTML = '';

        if (this.files && this.files.length > 0) {
            uploadPlaceholder.style.display = 'none';

            Array.from(this.files).forEach(file => {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'preview-item';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;

                        imgContainer.appendChild(img);
                        imagePreview.appendChild(imgContainer);
                    }

                    reader.readAsDataURL(file);
                }
            });
        } else {
            uploadPlaceholder.style.display = 'block';
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/products/create.blade.php ENDPATH**/ ?>