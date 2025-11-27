@extends('layouts.app')

@section('title', 'Mi cuenta')

@section('content')
<!-- ========== TOP BANNER ========== -->
<div style="background-color: #EE403D; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <p style="margin: 0;">
            Envío gratis en compras mayores a $100
            <a href="#" style="color: white; text-decoration: underline; margin-left: 8px;">Descubre Ahora</a>
        </p>
    </div>
</div>

<!-- ========== SECONDARY HEADER ========== -->
<div style="background-color: #F5F6F2; padding: 12px 0; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <nav style="display: flex; gap: 20px;">
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Nosotros</a>
            <a href="{{ route('account') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Cuenta</a>
            <a href="{{ route('wishlist.index') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Favoritos</a>
            <a href="#" style="color: #212529; text-decoration: none; transition: color 0.25s;">Rastrear Pedido</a>
            @auth
                @if(Auth::user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Dashboard</a>
                @endif
            @endauth
        </nav>

        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="color: #212529;">
                ¿Necesitas ayuda?
                <strong>Llámanos: <a href="tel:+1234567890" style="color: #EE403D; text-decoration: none;">+ 0020 500</a></strong>
            </span>
        </div>
    </div>
</div>

<!-- ========== MAIN HEADER ========== -->
<header style="background-color: white; padding: 20px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div style="flex-shrink: 0;">
            <a href="{{ route('home') }}" style="font-size: 32px; font-weight: 800; color: #212529; text-decoration: none; letter-spacing: 2px;">SEALS</a>
        </div>

        <!-- Main Navigation -->
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center;">
            <a href="{{ route('home') }}" style="color: #EE403D; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Shop</a>
            <a href="{{ route('categories') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Categorías</a>
            <a href="{{ route('contact') }}" style="color: #212529; font-weight: 500; text-decoration: none; transition: color 0.25s;">Contacto</a>
        </nav>

        <!-- Header Actions -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <!-- Search -->
            <button style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Buscar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>

            <!-- User -->
            @auth
                <a href="{{ route('account') }}" style="color: #212529; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Hola, {{ Auth::user()->name }}
                </a>
            @else
                <a href="{{ route('login') }}" style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Cuenta">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            @endauth

            <!-- Cart -->
            <a href="{{ route('cart') }}" style="position: relative; background: none; border: none; cursor: pointer; padding: 8px; text-decoration: none; color: inherit;" aria-label="Carrito">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span style="position: absolute; top: 0; right: 0; background-color: #EE403D; color: white; font-size: 10px; font-weight: 600; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">3</span>
            </a>
        </div>
    </div>
</header>

<!-- ========== CONTENT: MI CUENTA ========== -->
<section style="padding: 40px 20px; background: #F8F8F8; min-height: 60vh;">
    <div style="max-width:1200px; margin:0 auto;">
        <div style="display:flex; gap:24px; flex-wrap:wrap;">
            <div style="flex:1 1 320px; background:white; padding:24px; border-radius:8px; box-shadow:0 6px 18px rgba(16,24,40,0.06);">
                <h3 style="margin:0 0 8px 0;">Mi cuenta</h3>
                <p style="color:#6b7280; margin:0 0 16px 0;">Información personal</p>

                @auth
                <div style="margin-bottom:12px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">Nombre</label>
                    <div style="padding:10px; background:#F8FAFC; border-radius:6px;">{{ Auth::user()->name }}</div>
                </div>

                <div style="margin-bottom:12px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">Correo electrónico</label>
                    <div style="padding:10px; background:#F8FAFC; border-radius:6px;">{{ Auth::user()->email }}</div>
                </div>

                <form method="POST" action="{{ route('account.update') }}">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom:12px;">
                        <label style="display:block; font-weight:600; margin-bottom:6px;">Teléfono</label>
                        <input type="tel" name="phone" value="{{ old('phone', optional(Auth::user())->phone) }}" placeholder="Número telefónico" style="width:100%; padding:10px; border-radius:6px; border:1px solid #e6e6e6;">
                        @error('phone') <div class="text-danger" style="margin-top:6px;">{{ $message }}</div> @enderror
                    </div>
                    <div style="display:flex; gap:8px;"><button type="submit" style="background:#EE403D; color:#fff; border:none; padding:10px 14px; border-radius:6px; font-weight:600;">Guardar</button></div>
                </form>
                @else
                <p>Inicia sesión para ver y editar tu cuenta.</p>
                @endauth
            </div>

            <div style="flex:2 1 640px; background:white; padding:24px; border-radius:8px; box-shadow:0 6px 18px rgba(16,24,40,0.06);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                    <div>
                        <h3 style="margin:0;">Direcciones</h3>
                        <p style="color:#6b7280; margin:4px 0 0 0;">Agrega una o varias direcciones de entrega</p>
                    </div>
                    <button id="add-address" type="button" style="background:#10B981; color:#fff; border:none; padding:8px 14px; border-radius:6px; cursor:pointer; font-weight:600;">Agregar dirección</button>
                </div>

                <form method="POST" action="{{ route('account.addresses.save') }}" id="addresses-form">
                    @csrf
                    <div id="addresses-list" style="display:flex; flex-direction:column; gap:12px;">
                        @if(isset($addresses) && count($addresses))
                            @foreach($addresses as $idx => $addr)
                            <div class="address-item" style="border:1px solid #eef2f6; padding:12px; border-radius:8px; position:relative;">
                                <button type="button" class="remove-address" style="position:absolute; right:8px; top:8px; background:transparent; border:none; color:#ef4444; cursor:pointer;">Eliminar</button>

                                <div style="display:grid; grid-template-columns:1fr 120px; gap:10px; margin-bottom:8px;">
                                    <input name="addresses[{{ $idx }}][street]" value="{{ old('addresses.'.$idx.'.street', $addr['street'] ?? '') }}" placeholder="Calle" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                    <input name="addresses[{{ $idx }}][number]" value="{{ old('addresses.'.$idx.'.number', $addr['number'] ?? '') }}" placeholder="Número" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                </div>

                                <div style="display:grid; grid-template-columns:160px 1fr; gap:10px;">
                                    <input name="addresses[{{ $idx }}][postal_code]" value="{{ old('addresses.'.$idx.'.postal_code', $addr['postal_code'] ?? '') }}" placeholder="Código postal" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                    <input name="addresses[{{ $idx }}][note]" value="{{ old('addresses.'.$idx.'.note', $addr['note'] ?? '') }}" placeholder="Indicación para ubicar (ej: piso, referencia)" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="address-item" style="border:1px solid #eef2f6; padding:12px; border-radius:8px; position:relative;">
                                <button type="button" class="remove-address" style="position:absolute; right:8px; top:8px; background:transparent; border:none; color:#ef4444; cursor:pointer;">Eliminar</button>

                                <div style="display:grid; grid-template-columns:1fr 120px; gap:10px; margin-bottom:8px;">
                                    <input name="addresses[0][street]" placeholder="Calle" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                    <input name="addresses[0][number]" placeholder="Número" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                </div>

                                <div style="display:grid; grid-template-columns:160px 1fr; gap:10px;">
                                    <input name="addresses[0][postal_code]" placeholder="Código postal" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                    <input name="addresses[0][note]" placeholder="Indicación para ubicar (ej: piso, referencia)" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div style="display:flex; gap:10px; margin-top:14px;"><button type="submit" style="background:#111827; color:#fff; border:none; padding:10px 14px; border-radius:8px; font-weight:600;">Guardar direcciones</button></div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-address');
    const list = document.getElementById('addresses-list');

    function createAddressItem(index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'address-item';
        wrapper.style = 'border:1px solid #eef2f6; padding:12px; border-radius:8px; position:relative;';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-address';
        removeBtn.textContent = 'Eliminar';
        removeBtn.style = 'position:absolute; right:8px; top:8px; background:transparent; border:none; color:#ef4444; cursor:pointer;';
        removeBtn.addEventListener('click', () => wrapper.remove());

        wrapper.appendChild(removeBtn);

        const row1 = document.createElement('div');
        row1.style = 'display:grid; grid-template-columns:1fr 120px; gap:10px; margin-bottom:8px;';

        const street = document.createElement('input');
        street.name = `addresses[${index}][street]`;
        street.placeholder = 'Calle';
        street.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        const number = document.createElement('input');
        number.name = `addresses[${index}][number]`;
        number.placeholder = 'Número';
        number.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        row1.appendChild(street);
        row1.appendChild(number);

        const row2 = document.createElement('div');
        row2.style = 'display:grid; grid-template-columns:160px 1fr; gap:10px;';

        const postal = document.createElement('input');
        postal.name = `addresses[${index}][postal_code]`;
        postal.placeholder = 'Código postal';
        postal.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        const note = document.createElement('input');
        note.name = `addresses[${index}][note]`;
        note.placeholder = 'Indicación para ubicar (ej: piso, referencia)';
        note.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        row2.appendChild(postal);
        row2.appendChild(note);

        wrapper.appendChild(row1);
        wrapper.appendChild(row2);

        return wrapper;
    }

    addBtn && addBtn.addEventListener('click', function () {
        // compute next index
        const cur = list.querySelectorAll('.address-item').length;
        const item = createAddressItem(cur);
        list.appendChild(item);
    });

    // attach remove handlers to existing buttons
    document.querySelectorAll('.remove-address').forEach(btn => btn.addEventListener('click', function () {
        this.closest('.address-item')?.remove();
    }));
});
</script>
@endpush

@endsection
