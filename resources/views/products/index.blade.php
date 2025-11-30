@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Gestión de Productos
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Productos</span>
        </nav>
    </div>
</div>

<!-- Main Content -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Header with Add Button -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
            <div>
                <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 8px 0;">
                    Listado de Productos
                </h2>
                <p style="color: #666; margin: 0;">Gestiona tu inventario y productos disponibles</p>
            </div>
            <a href="{{ route('products.create') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #EE403D; color: white; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; transition: all 0.3s;">
                <i class="fas fa-plus"></i>
                Nuevo Producto
            </a>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div style="background: #D4EDDA; border: 1px solid #C3E6CB; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-check-circle" style="color: #155724; font-size: 20px;"></i>
                <span style="color: #155724; font-family: 'Jost', sans-serif; font-size: 15px;">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div style="background: #F8D7DA; border: 1px solid #F5C6CB; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-exclamation-circle" style="color: #721C24; font-size: 20px;"></i>
                <span style="color: #721C24; font-family: 'Jost', sans-serif; font-size: 15px;">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Products Table -->
        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; overflow: hidden;">
            @if($products->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #F8F9FA;">
                            <tr>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">ID</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">IMAGEN</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">NOMBRE</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">SKU</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">PRECIO</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">STOCK</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">CATEGORÍA</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">ESTADO</th>
                                <th style="padding: 16px 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 13px; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #E5E5E5;">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr style="border-bottom: 1px solid #F1F3F5; transition: background-color 0.2s ease;" onmouseover="this.style.backgroundColor='#F8F9FA'" onmouseout="this.style.backgroundColor='white'">
                                    <td style="padding: 20px; color: #212529; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600;">{{ $product->id }}</td>
                                    <td style="padding: 20px;">
                                        <div style="width: 60px; height: 60px; border-radius: 6px; overflow: hidden; background: #F8F9FA;">
                                            @php
                                                $images = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
                                                $imagePath = !empty($images) ? $images[0] : null;

                                                if ($imagePath) {
                                                    // Si es URL externa, usarla directamente
                                                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                        $imageUrl = $imagePath;
                                                    } else {
                                                        // Si es ruta local, verificar dónde existe
                                                        $storageFile = public_path('storage/' . $imagePath);
                                                        $publicFile = public_path($imagePath);

                                                        if (file_exists($storageFile)) {
                                                            $imageUrl = asset('storage/' . $imagePath);
                                                        } elseif (file_exists($publicFile)) {
                                                            $imageUrl = asset($imagePath);
                                                        } else {
                                                            $imageUrl = asset('images/placeholder-product.svg');
                                                        }
                                                    }
                                                } else {
                                                    $imageUrl = asset('images/placeholder-product.svg');
                                                }
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td style="padding: 20px; color: #212529; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500;">{{ $product->name }}</td>
                                    <td style="padding: 20px; color: #495057; font-family: 'Jost', sans-serif; font-size: 14px;">{{ $product->sku }}</td>
                                    <td style="padding: 20px; color: #212529; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600;">${{ number_format($product->price, 2) }}</td>
                                    <td style="padding: 20px; color: #495057; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 500;">{{ $product->stock_quantity }}</td>
                                    <td style="padding: 20px; color: #495057; font-family: 'Jost', sans-serif; font-size: 14px;">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td style="padding: 20px;">
                                        <span style="display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; {{ $product->is_active ? 'background: #D4EDDA; color: #28A745;' : 'background: #F8D7DA; color: #DC3545;' }}">
                                            {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px;">
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <a href="{{ route('products.show', $product) }}" style="width: 36px; height: 36px; border-radius: 6px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; background: transparent; text-decoration: none; color: #6C757D;" title="Ver" onmouseover="this.style.backgroundColor='#E9ECEF'; this.style.color='#495057'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#6C757D'">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" style="width: 36px; height: 36px; border-radius: 6px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; background: transparent; text-decoration: none; color: #EE403D;" title="Editar" onmouseover="this.style.backgroundColor='#FFE5E4'; this.style.color='#E32020'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#EE403D'">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')" style="width: 36px; height: 36px; border-radius: 6px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; background: transparent; color: #DC3545;" title="Eliminar" onmouseover="this.style.backgroundColor='#FFE5E8'; this.style.color='#C82333'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#DC3545'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div style="padding: 24px; display: flex; justify-content: center; border-top: 1px solid #E5E5E5;">
                    {{ $products->links() }}
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div style="text-align: center; padding: 80px 20px;">
                    <i class="fas fa-box-open" style="font-size: 64px; color: #E5E5E5; margin-bottom: 24px;"></i>
                    <h3 style="font-family: 'Jost', sans-serif; font-size: 20px; font-weight: 600; color: #495057; margin: 0 0 12px 0;">
                        No hay productos
                    </h3>
                    <p style="color: #6C757D; margin: 0 0 24px 0; font-family: 'Jost', sans-serif; font-size: 15px;">
                        Comienza agregando tu primer producto
                    </p>
                    <a href="{{ route('products.create') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #EE403D; color: white; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-family: 'Jost', sans-serif; font-weight: 600; font-size: 15px; transition: all 0.3s;">
                        <i class="fas fa-plus"></i>
                        Crear Producto
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>


<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;" onclick="closeDeleteModal(event)">
    <div style="background: white; border-radius: 12px; max-width: 500px; width: 90%; padding: 32px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); animation: modalSlideIn 0.3s ease;" onclick="event.stopPropagation()">
        <!-- Icon -->
        <div style="width: 64px; height: 64px; border-radius: 50%; background: #FEF2F2; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
            <i class="fas fa-exclamation-triangle" style="color: #EF4444; font-size: 28px;"></i>
        </div>

        <!-- Title -->
        <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 700; color: #212529; margin: 0 0 12px 0; text-align: center;">
            ¿Eliminar Producto?
        </h2>

        <!-- Message -->
        <p style="color: #666; font-family: 'Jost', sans-serif; font-size: 15px; line-height: 1.6; text-align: center; margin: 0 0 24px 0;">
            Estás a punto de eliminar el producto <strong id="productName"></strong>. Esta acción no se puede deshacer.
        </p>

        <!-- Buttons -->
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

/* Pagination Styles */
.pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    display: inline-block;
}

.pagination a,
.pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border-radius: 6px;
    font-family: 'Jost', sans-serif;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s;
}

.pagination a {
    color: #666;
    background: white;
    border: 1px solid #E5E5E5;
}

.pagination a:hover {
    background: #F8F9FA;
    border-color: #EE403D;
    color: #EE403D;
}

.pagination .active span {
    background: #EE403D;
    color: white;
    border: 1px solid #EE403D;
}

.pagination .disabled span {
    color: #CCC;
    background: #F8F9FA;
    border: 1px solid #E5E5E5;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    table {
        font-size: 13px;
    }

    th, td {
        padding: 12px !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
function confirmDelete(productId, productName) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const nameSpan = document.getElementById('productName');

    nameSpan.textContent = productName;
    form.action = `/products/${productId}`;
    modal.style.display = 'flex';

    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal(event) {
    if (event && event.target !== event.currentTarget && !event.target.closest('button')) {
        return;
    }

    const modal = document.getElementById('deleteModal');
    modal.style.display = 'none';

    // Restore body scroll
    document.body.style.overflow = 'auto';
}

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endpush

@endsection
