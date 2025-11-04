@extends('layouts.app')

@section('title', 'Editar Producto')

@push('styles')
<style>
input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: #EE403D;
    box-shadow: 0 0 0 3px rgba(238, 64, 61, 0.1);
}

input[type="checkbox"]:checked {
    background-color: #EE403D;
    border-color: #EE403D;
}

button[type="submit"]:hover {
    background-color: #DC2626;
}
</style>
@endpush
</style>
@endsection

@section('content')
<!-- TOP BANNER -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <p style="margin: 0;">
            Panel de Administración de Productos
            <a href="{{ route('home') }}" style="color: white; text-decoration: underline; margin-left: 8px;">Volver a la Tienda</a>
        </p>
    </div>
</div>

<!-- MAIN HEADER -->
<header style="background-color: white; padding: 20px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div style="flex-shrink: 0;">
            <a href="{{ route('home') }}" style="font-size: 32px; font-weight: 800; color: #212529; text-decoration: none; letter-spacing: 2px;">SEALS</a>
        </div>

        <!-- Main Navigation -->
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center;">
            <a href="{{ route('home') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="{{ route('products.index') }}" style="color: #EE403D; font-weight: 500; text-decoration: none; transition: color 0.25s;">Productos</a>
            <a href="{{ route('categories') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Contacto</a>
        </nav>

        <!-- Header Actions -->
        <div style="display: flex; align-items: center; gap: 20px;">
            @auth
                <div style="display: flex; align-items: center; gap: 16px;">
                    <span style="color: #212529; font-weight: 500;">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: #EE403D; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: background-color 0.3s;">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>

<main style="background: linear-gradient(135deg, #F5F6F2 0%, #E7E8E0 100%); min-height: calc(100vh - 180px); padding: 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Page Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
            <div>
                <span style="display: inline-block; background-color: #EE403D; color: white; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 12px;">
                    Editando Producto
                </span>
                <h1 style="font-size: 32px; font-weight: 700; color: #212529; margin: 0;">{{ $product->name }}</h1>
            </div>
            <div style="display: flex; gap: 16px;">
                <a href="{{ route('products.show', $product) }}" style="background: #F3F4F6; color: #374151; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background-color 0.3s; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-eye"></i>
                    Ver Detalles
                </a>
                <a href="{{ route('products.index') }}" style="background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background-color 0.3s; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-arrow-left"></i>
                    Volver a Lista
                </a>
            </div>
        </div>

        @if($errors->any())
            <div style="background: #FDE8E8; color: #9B1C1C; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
                    <div>
                        <div style="margin-bottom: 32px;">
                            <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 20px;">
                                <i class="fas fa-info-circle" style="margin-right: 8px; color: #EE403D;"></i>
                                Información Básica
                            </h3>
                            
                            <div style="display: flex; flex-direction: column; gap: 20px;">
                                <div>
                                    <label for="name" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                        Nombre del Producto<span style="color: #EE403D;">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required 
                                           style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                                </div>
                                
                                <div>
                                    <label for="sku" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                        SKU (Código)<span style="color: #EE403D;">*</span>
                                    </label>
                                    <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required 
                                           style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px;">
                                </div>
                                
                                <div>
                                    <label for="category_id" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                        Categoría<span style="color: #EE403D;">*</span>
                                    </label>
                                    <select id="category_id" name="category_id" required 
                                            style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; background-color: white;">
                                        <option value="">Seleccionar categoría</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div>
                                <label for="price" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                    Precio<span style="color: #EE403D;">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required 
                                       style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px;">
                            </div>
                            
                            <div>
                                <label for="sale_price" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                    Precio de Oferta
                                </label>
                                <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0" 
                                       style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px;">
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <label for="stock_quantity" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                Cantidad en Stock<span style="color: #EE403D;">*</span>
                            </label>
                            <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required 
                                   style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px;">
                        </div>
                    </div>

                    <div style="margin-top: 32px;">
                        <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 20px;">
                            <i class="fas fa-align-left" style="margin-right: 8px; color: #EE403D;"></i>
                            Descripción
                        </h3>
                        
                        <div style="margin-bottom: 20px;">
                            <label for="short_description" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                Descripción Corta
                            </label>
                            <textarea id="short_description" name="short_description" rows="3" 
                                    style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; resize: vertical;">{{ old('short_description', $product->short_description) }}</textarea>
                            <small style="display: block; color: #6B7280; margin-top: 4px;">Breve resumen del producto (máximo 500 caracteres)</small>
                        </div>
                        
                        <div>
                            <label for="description" style="display: block; font-weight: 500; color: #374151; margin-bottom: 8px;">
                                Descripción Completa<span style="color: #EE403D;">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6" required 
                                    style="width: 100%; padding: 10px 16px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; resize: vertical;">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Imágenes Section -->
                    <div style="margin-top: 32px;">
                        <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 20px;">
                            <i class="fas fa-images" style="margin-right: 8px; color: #EE403D;"></i>
                            Imágenes
                        </h3>

                        <div>
                            <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 12px;">Imágenes Actuales</label>
                            <div style="background-color: #F9FAFB; border-radius: 8px; padding: 16px;">
                                @php
                                    $images = [];
                                    if (!is_null($product->images)) {
                                        $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                        $images = is_array($images) ? $images : [];
                                    }
                                @endphp

                                @if(!empty($images))
                                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 16px;">
                                        @foreach($images as $index => $image)
                                            <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                                <div style="position: relative; padding-top: 100%;">
                                                    <img src="{{ asset('storage/' . $image) }}" 
                                                         alt="{{ $product->name }}"
                                                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="padding: 8px; border-top: 1px solid #E5E7EB;">
                                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                                        <input type="checkbox" name="delete_images[]" value="{{ $index }}"
                                                               style="width: 16px; height: 16px; border-radius: 4px; border: 2px solid #D1D5DB;">
                                                        <span style="font-size: 14px; color: #EF4444;">Eliminar</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="text-align: center; color: #6B7280; padding: 24px;">
                                        No hay imágenes disponibles para este producto.
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <div style="margin-top: 24px;">
                            <label for="images" style="display: block; font-weight: 500; color: #374151; margin-bottom: 12px;">
                                Añadir Nuevas Imágenes
                            </label>
                            <div style="border: 2px dashed #D1D5DB; border-radius: 8px; padding: 24px; text-align: center;">
                                <input type="file" id="images" name="images[]" multiple accept="image/*" 
                                       style="display: none;">
                                <label for="images" style="cursor: pointer;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                                        <i class="fas fa-cloud-upload-alt" style="font-size: 32px; color: #EE403D;"></i>
                                        <span style="font-weight: 500; color: #374151;">Arrastra imágenes aquí o haz clic para seleccionar</span>
                                        <span style="font-size: 14px; color: #6B7280;">Formatos permitidos: JPG, PNG, GIF</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div>
                    <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); position: sticky; top: 100px;">
                        <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 20px;">
                            <i class="fas fa-cog" style="margin-right: 8px; color: #EE403D;"></i>
                            Configuración
                        </h3>

                        <div style="margin-bottom: 20px;">
                            <label for="is_active" style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                       style="width: 20px; height: 20px; border-radius: 6px; border: 2px solid #D1D5DB; accent-color: #EE403D;">
                                <span style="font-weight: 500; color: #374151;">Producto Activo</span>
                            </label>
                            <p style="margin-top: 4px; font-size: 14px; color: #6B7280;">
                                Los productos inactivos no serán visibles en la tienda
                            </p>
                        </div>

                        <div style="margin-bottom: 32px;">
                            <label for="featured" style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                                <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}
                                       style="width: 20px; height: 20px; border-radius: 6px; border: 2px solid #D1D5DB; accent-color: #EE403D;">
                                <span style="font-weight: 500; color: #374151;">Destacar Producto</span>
                            </label>
                            <p style="margin-top: 4px; font-size: 14px; color: #6B7280;">
                                Los productos destacados aparecen en la página principal
                            </p>
                        </div>

                        <button type="submit" style="width: 100%; background: #EE403D; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: background-color 0.3s; display: flex; justify-content: center; align-items: center; gap: 8px;">
                            <i class="fas fa-save"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: #EE403D;
    box-shadow: 0 0 0 3px rgba(238, 64, 61, 0.1);
}

input[type="checkbox"]:checked {
    background-color: #EE403D;
    border-color: #EE403D;
}

button[type="submit"]:hover {
    background-color: #DC2626;
}
</style>

@endsection
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
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label for="is_active">Producto Activo</label>
                        </div>
                        
                        <div class="form-group checkbox">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label for="is_featured">Producto Destacado</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} SEALS. Todos los derechos reservados.</p>
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
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Previsualización de imágenes
        const input = document.getElementById('images');
        const preview = document.querySelector('.image-upload-container');

        if (input && preview) {
            input.addEventListener('change', function() {
                Array.from(this.files).forEach(file => {
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.style.cssText = 'position: relative; width: 100px; height: 100px; margin: 5px; display: inline-block;';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.cssText = 'width: 100%; height: 100%; object-fit: cover; border-radius: 8px;';
                            
                            div.appendChild(img);
                            preview.appendChild(div);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        }
    });
</script>
@endpush
</script>
@endpush