@extends('layouts.app')

@section('title', 'Editar Producto - Admin')

@section('content')
@include('layouts.navbar')

<main style="background-color: #F5F6F2; padding: 40px 0; min-height: calc(100vh - 400px);">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 600; color: #212529; margin: 0 0 8px 0;">Editar Producto</h1>
                <p style="color: #666; margin: 0; font-size: 14px;">Administración suprema - Edición de cualquier producto</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.products.index') }}" style="display: inline-block; padding: 10px 20px; background-color: white; color: #212529; border: 1px solid #D7D9D2; border-radius: 4px; text-decoration: none; font-weight: 500; transition: all 0.25s;">
                    ← Volver a Lista
                </a>
            </div>
        </div>

        @if($errors->any())
            <div style="background-color: #fee2e2; border-left: 4px solid #EE403D; padding: 16px 20px; border-radius: 4px; margin-bottom: 24px;">
                <h4 style="margin: 0 0 10px 0; color: #991b1b; font-size: 16px; font-weight: 600;">Hay errores en el formulario:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #991b1b;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background-color: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); padding: 40px;">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Información del Vendedor -->
                <div style="margin-bottom: 40px; background: #FEF2F2; padding: 20px; border-radius: 8px; border-left: 4px solid #EE403D;">
                    <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 16px 0;">
                        <i class="fas fa-user-tie" style="margin-right: 8px; color: #EE403D;"></i>
                        Vendedor Asignado
                    </h3>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                            Seleccionar Vendedor <span style="color: #EE403D;">*</span>
                        </label>
                        <select name="user_id" required 
                            style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; background-color: white;">
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}" {{ old('user_id', $product->user_id) == $seller->id ? 'selected' : '' }}>
                                    {{ $seller->name }} ({{ $seller->email }})
                                </option>
                            @endforeach
                        </select>
                        <small style="color: #666; font-size: 13px; display: block; margin-top: 6px;">
                            <i class="fas fa-info-circle"></i> Puedes cambiar el vendedor propietario de este producto
                        </small>
                    </div>
                </div>
                
                <!-- Información Básica -->
                <div style="margin-bottom: 40px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid #EE403D;">
                        Información Básica
                    </h3>
                    
                    <div style="display: grid; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                Nombre del Producto <span style="color: #EE403D;">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required 
                                style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; transition: border-color 0.2s;"
                                placeholder="Ej: Zapatillas Nike Air Max">
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                    SKU (Código) <span style="color: #EE403D;">*</span>
                                </label>
                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required 
                                    style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; transition: border-color 0.2s;"
                                    placeholder="SKU-001">
                            </div>
                            
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                    Categoría <span style="color: #EE403D;">*</span>
                                </label>
                                <select name="category_id" required 
                                    style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; background-color: white; transition: border-color 0.2s;">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                    Precio <span style="color: #EE403D;">*</span>
                                </label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required 
                                    style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; transition: border-color 0.2s;"
                                    placeholder="99.99">
                            </div>
                            
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                    Precio de Oferta
                                </label>
                                <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0" 
                                    style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; transition: border-color 0.2s;"
                                    placeholder="79.99">
                            </div>
                            
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                    Stock <span style="color: #EE403D;">*</span>
                                </label>
                                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required 
                                    style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; transition: border-color 0.2s;"
                                    placeholder="100">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Descripción -->
                <div style="margin-bottom: 40px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid #EE403D;">
                        Descripción
                    </h3>
                    
                    <div style="display: grid; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                Descripción Corta
                            </label>
                            <textarea name="short_description" rows="2" 
                                style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; resize: vertical; transition: border-color 0.2s;"
                                placeholder="Breve resumen del producto">{{ old('short_description', $product->short_description) }}</textarea>
                            <small style="color: #777777; font-size: 13px;">Máximo 500 caracteres</small>
                        </div>
                        
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #212529;">
                                Descripción Completa <span style="color: #EE403D;">*</span>
                            </label>
                            <textarea name="description" rows="6" required 
                                style="width: 100%; padding: 12px 16px; border: 1px solid #D7D9D2; border-radius: 4px; font-size: 15px; resize: vertical; transition: border-color 0.2s;"
                                placeholder="Descripción detallada del producto, características, materiales, etc.">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Imágenes Actuales -->
                @php
                    $currentImages = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
                @endphp
                
                @if(count($currentImages) > 0)
                <div style="margin-bottom: 40px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid #EE403D;">
                        Imágenes Actuales
                    </h3>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        @foreach($currentImages as $index => $image)
                        <div style="position: relative; width: 120px; height: 120px; border: 1px solid #D7D9D2; border-radius: 4px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $image) }}" alt="Imagen del producto" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                    <p style="margin-top: 12px; color: #666; font-size: 13px;">
                        <i class="fas fa-info-circle"></i> Para cambiar las imágenes, sube nuevas imágenes abajo (esto reemplazará todas las imágenes actuales)
                    </p>
                </div>
                @endif
                
                <!-- Imágenes Nuevas -->
                <div style="margin-bottom: 40px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid #EE403D;">
                        {{ count($currentImages) > 0 ? 'Reemplazar Imágenes' : 'Agregar Imágenes' }}
                    </h3>
                    
                    <div style="border: 2px dashed #D7D9D2; border-radius: 8px; padding: 40px; text-align: center; position: relative; background-color: #F5F6F2; transition: all 0.2s;">
                        <input type="file" id="images" name="images[]" multiple accept="image/*" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 2;">
                        <div>
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="2" style="margin: 0 auto 16px;">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <p style="margin: 0 0 8px 0; font-size: 16px; font-weight: 500; color: #212529;">Arrastra imágenes aquí o haz clic para seleccionar</p>
                            <p style="margin: 0; font-size: 13px; color: #777777;">JPG, PNG, GIF - Máximo 2MB cada una</p>
                        </div>
                    </div>
                    <div id="imagePreview" style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 16px;"></div>
                </div>
                
                <!-- Opciones -->
                <div style="margin-bottom: 40px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: #212529; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid #EE403D;">
                        Opciones
                    </h3>
                    
                    <div style="display: grid; gap: 16px;">
                        <div style="background-color: #F5F6F2; padding: 16px; border-radius: 4px;">
                            <label style="display: flex; align-items: start; cursor: pointer;">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} 
                                    style="width: 18px; height: 18px; margin-right: 12px; margin-top: 2px; cursor: pointer; accent-color: #EE403D;">
                                <div>
                                    <span style="font-weight: 500; color: #212529; display: block; margin-bottom: 4px;">Producto Activo</span>
                                    <span style="font-size: 13px; color: #777777; display: block;">Si se desactiva, el producto no estará disponible para compra</span>
                                </div>
                            </label>
                        </div>
                        
                        <div style="background-color: #F5F6F2; padding: 16px; border-radius: 4px;">
                            <label style="display: flex; align-items: start; cursor: pointer;">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} 
                                    style="width: 18px; height: 18px; margin-right: 12px; margin-top: 2px; cursor: pointer; accent-color: #EE403D;">
                                <div>
                                    <span style="font-weight: 500; color: #212529; display: block; margin-bottom: 4px;">Producto Destacado</span>
                                    <span style="font-size: 13px; color: #777777; display: block;">El producto aparecerá en la sección de destacados</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #E5E5E5;">
                    <a href="{{ route('admin.products.index') }}" 
                        style="display: inline-block; padding: 12px 24px; background-color: white; color: #212529; border: 1px solid #D7D9D2; border-radius: 4px; text-decoration: none; font-weight: 500; transition: all 0.25s;">
                        Cancelar
                    </a>
                    <button type="submit" 
                        style="display: inline-block; padding: 12px 32px; background-color: #EE403D; color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer; transition: all 0.25s;">
                        <i class="fas fa-save" style="margin-right: 8px;"></i>Actualizar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

@include('layouts.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('imagePreview');
    
    // Input focus effects
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('focus', function() {
            this.style.borderColor = '#EE403D';
            this.style.outline = 'none';
        });
        
        element.addEventListener('blur', function() {
            this.style.borderColor = '#D7D9D2';
        });
    });
    
    // Image preview
    imageInput.addEventListener('change', function() {
        imagePreview.innerHTML = '';
        
        if (this.files) {
            Array.from(this.files).forEach(file => {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.style.cssText = 'width: 120px; height: 120px; border: 1px solid #D7D9D2; border-radius: 4px; overflow: hidden;';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';
                        
                        imgContainer.appendChild(img);
                        imagePreview.appendChild(imgContainer);
                    }
                    
                    reader.readAsDataURL(file);
                }
            });
        }
    });
    
    // Drag and drop hover effect
    const uploadContainer = imageInput.parentElement;
    uploadContainer.addEventListener('dragover', function() {
        this.style.borderColor = '#EE403D';
        this.style.backgroundColor = '#FEF2F2';
    });
    
    uploadContainer.addEventListener('dragleave', function() {
        this.style.borderColor = '#D7D9D2';
        this.style.backgroundColor = '#F5F6F2';
    });
    
    uploadContainer.addEventListener('drop', function() {
        this.style.borderColor = '#D7D9D2';
        this.style.backgroundColor = '#F5F6F2';
    });
});
</script>
@endsection
