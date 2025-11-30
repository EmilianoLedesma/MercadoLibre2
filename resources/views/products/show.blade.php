@extends('layouts.app')

@section('title', $product->name)

@section('content')
@include('layouts.navbar')

<!-- Breadcrumb -->
<div style="background-color: #F8F9FA; padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <a href="{{ route('products.index') }}" style="color: #666; text-decoration: none;">Productos</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">{{ $product->name }}</span>
        </div>
    </div>
</div>

<!-- Product Detail -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Back and Actions -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
            <a href="{{ route('products.index') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #666; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 500; font-size: 15px; transition: color 0.3s;" onmouseover="this.style.color='#EE403D'" onmouseout="this.style.color='#666'">
                <i class="fas fa-arrow-left"></i>
                Volver a Productos
            </a>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('products.edit', $product) }}" style="display: inline-flex; align-items: center; gap: 8px; background: #EE403D; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; transition: all 0.3s;">
                    <i class="fas fa-edit"></i>
                    Editar Producto
                </a>
            </div>
        </div>

        <!-- Product Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; margin-bottom: 60px;">

            <!-- Images -->
            <div>
                @php
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
                @endphp

                <div style="width: 100%; padding-top: 100%; position: relative; background-color: #F5F6F2; border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                    <img src="{{ $mainUrl }}" alt="{{ $product->name }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" id="mainImage">
                </div>

                @if(count($images) > 1)
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;">
                    @foreach($images as $index => $image)
                        @php
                            $storagePath = public_path('storage/' . $image);
                            $publicPath = public_path($image);

                            if (file_exists($storagePath)) {
                                $thumbUrl = asset('storage/' . $image);
                            } elseif (file_exists($publicPath)) {
                                $thumbUrl = asset($image);
                            } else {
                                $thumbUrl = asset('images/placeholder-product.svg');
                            }
                        @endphp
                        <div onclick="changeImage('{{ $thumbUrl }}')" style="padding-top: 100%; position: relative; background-color: #F5F6F2; border-radius: 8px; overflow: hidden; cursor: pointer; border: 2px solid {{ $index === 0 ? '#EE403D' : 'transparent' }}; transition: border-color 0.3s;" class="thumbnail" onmouseover="this.style.borderColor='#EE403D'" onmouseout="if(!this.classList.contains('active')) this.style.borderColor='transparent'">
                            <img src="{{ $thumbUrl }}" alt="{{ $product->name }} - {{ $index + 1 }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <!-- Admin Badges -->
                @if($product->is_featured || !$product->is_active)
                <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                    @if($product->is_featured)
                        <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #667EEA; color: white;">
                            <i class="fas fa-star"></i> Destacado
                        </span>
                    @endif
                    @if(!$product->is_active)
                        <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #64748B; color: white;">
                            <i class="fas fa-times-circle"></i> Inactivo
                        </span>
                    @endif
                </div>
                @endif

                <h1 style="font-family: 'Jost', sans-serif; font-size: 32px; font-weight: 600; color: #212529; margin: 0 0 20px 0; line-height: 1.3;">
                    {{ $product->name }}
                </h1>

                <div style="margin-bottom: 24px;">
                    @if($product->sale_price)
                        <span style="font-size: 36px; font-weight: 700; color: #EE403D;">${{ number_format($product->sale_price, 2) }}</span>
                        <span style="font-size: 24px; color: #999; text-decoration: line-through; margin-left: 12px;">${{ number_format($product->price, 2) }}</span>
                    @else
                        <span style="font-size: 36px; font-weight: 700; color: #EE403D;">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                @if($product->stock_quantity > 0)
                    <span style="display: inline-block; background-color: #28A745; color: white; padding: 6px 16px; border-radius: 6px; font-size: 13px; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-check-circle"></i> Disponible ({{ $product->stock_quantity }})
                    </span>
                @else
                    <span style="display: inline-block; background-color: #DC3545; color: white; padding: 6px 16px; border-radius: 6px; font-size: 13px; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-times-circle"></i> Agotado
                    </span>
                @endif

                <p style="color: #666; line-height: 1.8; margin: 0 0 32px 0; font-family: 'Jost', sans-serif; font-size: 15px;">
                    {{ $product->short_description ?? $product->description }}
                </p>

                <!-- Meta Info -->
                <div style="border-top: 1px solid #E5E5E5; padding-top: 24px; margin-bottom: 32px;">
                    <div style="display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #F8F8F8;">
                        <span style="font-weight: 600; color: #212529; min-width: 120px; font-family: 'Jost', sans-serif; font-size: 14px;">SKU:</span>
                        <span style="color: #666; font-family: 'Jost', sans-serif; font-size: 14px;">{{ $product->sku }}</span>
                    </div>
                    <div style="display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #F8F8F8;">
                        <span style="font-weight: 600; color: #212529; min-width: 120px; font-family: 'Jost', sans-serif; font-size: 14px;">Categoría:</span>
                        <span style="color: #666; font-family: 'Jost', sans-serif; font-size: 14px;">{{ $product->category->name ?? 'Sin categoría' }}</span>
                    </div>
                    <div style="display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #F8F8F8;">
                        <span style="font-weight: 600; color: #212529; min-width: 120px; font-family: 'Jost', sans-serif; font-size: 14px;">Vendedor:</span>
                        <span style="color: #666; font-family: 'Jost', sans-serif; font-size: 14px;">{{ $product->user->name ?? 'Desconocido' }}</span>
                    </div>
                    <div style="display: flex; align-items: center; padding: 12px 0;">
                        <span style="font-weight: 600; color: #212529; min-width: 120px; font-family: 'Jost', sans-serif; font-size: 14px;">Estado:</span>
                        <span style="font-weight: 600; font-family: 'Jost', sans-serif; font-size: 14px; {{ $product->is_active ? 'color: #28A745;' : 'color: #DC3545;' }}">
                            {{ $product->is_active ? '✓ Activo' : '✗ Inactivo' }}
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('shop.show', $product->slug) }}" target="_blank" style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; background: #10B981; color: white; padding: 16px 32px; border-radius: 8px; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 16px; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#059669'" onmouseout="this.style.backgroundColor='#10B981'">
                        <i class="fas fa-external-link-alt"></i>
                        Ver en Tienda
                    </a>
                    <button type="button" onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')" style="display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border: 2px solid #DC3545; background: white; color: #DC3545; border-radius: 8px; cursor: pointer; transition: all 0.3s;" title="Eliminar" onmouseover="this.style.backgroundColor='#DC3545'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#DC3545'">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div>
            <div style="display: flex; gap: 32px; border-bottom: 2px solid #E5E5E5; margin-bottom: 32px;">
                <button onclick="switchTab('description')" class="tab-btn active" style="padding: 16px 0; background: none; border: none; border-bottom: 2px solid #EE403D; color: #EE403D; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; margin-bottom: -2px; font-family: 'Jost', sans-serif;">
                    Descripción Completa
                </button>
                <button onclick="switchTab('details')" class="tab-btn" style="padding: 16px 0; background: none; border: none; border-bottom: 2px solid transparent; color: #666; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; margin-bottom: -2px; font-family: 'Jost', sans-serif;">
                    Información Adicional
                </button>
            </div>

            <div class="tabs-content">
                <div class="tab-panel active" id="description" style="display: block;">
                    <div style="color: #666; line-height: 2; font-size: 15px; font-family: 'Jost', sans-serif;">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <div class="tab-panel" id="details" style="display: none;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr style="border-bottom: 1px solid #E5E5E5;">
                                <th style="padding: 16px; text-align: left; font-weight: 600; color: #212529; width: 200px; font-family: 'Jost', sans-serif;">ID del Producto</th>
                                <td style="padding: 16px; text-align: left; color: #666; font-family: 'Jost', sans-serif;">#{{ $product->id }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #E5E5E5;">
                                <th style="padding: 16px; text-align: left; font-weight: 600; color: #212529; width: 200px; font-family: 'Jost', sans-serif;">Slug</th>
                                <td style="padding: 16px; text-align: left; color: #666; font-family: 'Jost', sans-serif;">{{ $product->slug }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #E5E5E5;">
                                <th style="padding: 16px; text-align: left; font-weight: 600; color: #212529; width: 200px; font-family: 'Jost', sans-serif;">Fecha de Creación</th>
                                <td style="padding: 16px; text-align: left; color: #666; font-family: 'Jost', sans-serif;">{{ $product->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #E5E5E5;">
                                <th style="padding: 16px; text-align: left; font-weight: 600; color: #212529; width: 200px; font-family: 'Jost', sans-serif;">Última Actualización</th>
                                <td style="padding: 16px; text-align: left; color: #666; font-family: 'Jost', sans-serif;">{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #E5E5E5;">
                                <th style="padding: 16px; text-align: left; font-weight: 600; color: #212529; width: 200px; font-family: 'Jost', sans-serif;">Estado</th>
                                <td style="padding: 16px; text-align: left; font-family: 'Jost', sans-serif;">
                                    <span style="color: {{ $product->is_active ? '#28A745' : '#DC3545' }}; font-weight: 600;">
                                        {{ $product->is_active ? '✓ Activo' : '✗ Inactivo' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 16px; text-align: left; font-weight: 600; color: #212529; width: 200px; font-family: 'Jost', sans-serif;">Destacado</th>
                                <td style="padding: 16px; text-align: left; color: #666; font-family: 'Jost', sans-serif;">{{ $product->is_featured ? '⭐ Sí' : 'No' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
@if($relatedProducts->count() > 0)
<section style="padding: 60px 20px; background-color: #F8F8F8;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 40px 0; text-align: center;">Productos Relacionados</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
            @foreach($relatedProducts as $relatedProduct)
            <!-- Related Product Card -->
            <div style="background-color: white; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)';" onclick="window.location.href='{{ route('products.show', $relatedProduct->id) }}'">
                <div style="position: relative; width: 100%; height: 350px; overflow: hidden;">
                    @php
                        $badgeTop = 12;
                    @endphp
                    
                    @if($relatedProduct->hasDiscount())
                        <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #E32020; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">-{{ $relatedProduct->discount_percentage }}%</span>
                        @php $badgeTop += 33; @endphp
                    @endif
                    
                    @if($relatedProduct->isNew())
                        <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #28A745; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">NEW</span>
                        @php $badgeTop += 33; @endphp
                    @endif
                    
                    @if($relatedProduct->is_featured)
                        <span style="position: absolute; top: {{ $badgeTop }}px; right: 12px; background-color: #EE403D; color: white; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 3px; z-index: 10;">HOT</span>
                    @endif
                    
                    @php
                        $relatedImages = is_string($relatedProduct->images) ? json_decode($relatedProduct->images, true) : $relatedProduct->images;
                        $relatedImages = $relatedImages ?? [];
                        
                        if (count($relatedImages) > 0) {
                            $relatedImage = $relatedImages[0];
                            $relatedStoragePath = public_path('storage/' . $relatedImage);
                            $relatedPublicPath = public_path($relatedImage);

                            if (file_exists($relatedStoragePath)) {
                                $relatedImageUrl = asset('storage/' . $relatedImage);
                            } elseif (file_exists($relatedPublicPath)) {
                                $relatedImageUrl = asset($relatedImage);
                            } else {
                                $relatedImageUrl = asset('images/placeholder-product.svg');
                            }
                        } else {
                            $relatedImageUrl = asset('images/placeholder-product.svg');
                        }
                    @endphp
                    
                    <img src="{{ $relatedImageUrl }}" alt="{{ $relatedProduct->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 500; color: #212529; margin: 0 0 12px 0;">{{ Str::limit($relatedProduct->name, 40) }}</h4>
                    
                    @if($relatedProduct->hasDiscount())
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                            <span style="font-size: 14px; color: #999; text-decoration: line-through;">${{ number_format($relatedProduct->price, 2) }}</span>
                            <span style="font-size: 20px; font-weight: 700; color: #E32020;">${{ number_format($relatedProduct->sale_price, 2) }}</span>
                        </div>
                    @else
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                            <span style="font-size: 20px; font-weight: 700; color: #404040;">${{ number_format($relatedProduct->price, 2) }}</span>
                        </div>
                    @endif
                    
                    <form action="{{ route('cart.add', $relatedProduct->id) }}" method="POST" onclick="event.stopPropagation();">
                        @csrf
                        <button type="submit" style="width: 100%; background-color: transparent; color: #212529; border: 2px solid #212529; padding: 12px; font-size: 14px; font-weight: 600; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: all 0.25s;">
                            Agregar al Carrito
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;" onclick="closeDeleteModal(event)">
    <div style="background: white; border-radius: 12px; max-width: 500px; width: 90%; padding: 32px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); animation: modalSlideIn 0.3s ease;" onclick="event.stopPropagation()">
        <div style="width: 64px; height: 64px; border-radius: 50%; background: #FEF2F2; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
            <i class="fas fa-exclamation-triangle" style="color: #EF4444; font-size: 28px;"></i>
        </div>

        <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0 0 12px 0; text-align: center;">
            ¿Eliminar Producto?
        </h2>

        <p style="color: #666; font-family: 'Jost', sans-serif; font-size: 15px; line-height: 1.6; text-align: center; margin: 0 0 24px 0;">
            Estás a punto de eliminar el producto <strong id="productName"></strong>. Esta acción no se puede deshacer.
        </p>

        <div style="display: flex; gap: 12px; justify-content: center;">
            <button type="button" onclick="closeDeleteModal()" style="padding: 12px 24px; border-radius: 8px; border: 1px solid #E5E5E5; background: white; color: #666; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#F8F9FA'" onmouseout="this.style.backgroundColor='white'">
                Cancelar
            </button>
            <form id="deleteForm" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 12px 24px; border-radius: 8px; border: none; background: #EF4444; color: white; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#DC2626'" onmouseout="this.style.backgroundColor='#EF4444'">
                    Eliminar Producto
                </button>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
@keyframes modalSlideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.tab-btn:hover {
    color: #EE403D !important;
}

.tab-btn.active {
    color: #EE403D !important;
    border-bottom-color: #EE403D !important;
}

.thumbnail.active {
    border-color: #EE403D !important;
}

@media (max-width: 768px) {
    section > div > div:first-of-type {
        grid-template-columns: 1fr !important;
        gap: 32px !important;
    }

    h1 {
        font-size: 24px !important;
    }

    .price-current {
        font-size: 28px !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
function changeImage(url) {
    document.getElementById('mainImage').src = url;

    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
        thumb.style.borderColor = 'transparent';
    });
    event.currentTarget.classList.add('active');
    event.currentTarget.style.borderColor = '#EE403D';
}

function switchTab(tabName) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.color = '#666';
        btn.style.borderBottomColor = 'transparent';
    });
    document.querySelectorAll('.tab-panel').forEach(panel => {
        panel.style.display = 'none';
    });

    event.target.classList.add('active');
    event.target.style.color = '#EE403D';
    event.target.style.borderBottomColor = '#EE403D';
    document.getElementById(tabName).style.display = 'block';
}

function confirmDelete(productId, productName) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const nameSpan = document.getElementById('productName');

    nameSpan.textContent = productName;
    form.action = `/products/${productId}`;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal(event) {
    if (event && event.target !== event.currentTarget && !event.target.closest('button')) {
        return;
    }

    const modal = document.getElementById('deleteModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endpush

@endsection
