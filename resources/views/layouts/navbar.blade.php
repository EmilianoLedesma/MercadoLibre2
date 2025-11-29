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
            <a href="{{ route('about') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Nosotros</a>
            <a href="{{ route('account') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Mi Cuenta</a>
            <a href="{{ route('wishlist.index') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Favoritos</a>
            <a href="{{ route('track.order') }}" style="color: #212529; text-decoration: none; transition: color 0.25s;">Rastrear Pedido</a>
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
        <nav style="display: flex; gap: 32px; flex: 1; justify-content: center; align-items: center;">
            <a href="{{ route('home') }}" style="color: {{ request()->routeIs('home') ? '#EE403D' : '#212529' }}; font-weight: 500; text-decoration: none; transition: color 0.25s;">Inicio</a>
            <a href="{{ route('shop.index') }}" style="color: {{ request()->routeIs('shop.*') ? '#EE403D' : '#212529' }}; font-weight: 500; text-decoration: none; transition: color 0.25s;">Shop</a>
            
            <!-- Categorías con Dropdown -->
            <div class="categories-dropdown">
                <a href="{{ route('categories') }}" style="color: {{ request()->routeIs('categories') ? '#EE403D' : '#212529' }}; font-weight: 500; text-decoration: none; transition: color 0.25s; display: flex; align-items: center; gap: 6px;">
                    Categorías
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu">
                    <div style="display: grid; gap: 12px;">
                        @php
                            $navCategories = \App\Models\Category::where('is_active', true)->orderBy('name', 'asc')->get();
                        @endphp
                        @foreach($navCategories as $category)
                        <a href="{{ route('shop.index', ['category' => $category->id]) }}" style="display: flex; align-items: center; padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #212529; transition: all 0.25s; background-color: #F8F9FA;" onmouseover="this.style.backgroundColor='#EE403D'; this.style.color='white';" onmouseout="this.style.backgroundColor='#F8F9FA'; this.style.color='#212529';">
                            <span style="font-weight: 500;">{{ $category->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <a href="{{ route('contact') }}" style="color: {{ request()->routeIs('contact') ? '#EE403D' : '#212529' }}; font-weight: 500; text-decoration: none; transition: color 0.25s;">Contacto</a>
        </nav>

        <!-- Header Actions -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <!-- Search -->
            <button onclick="toggleSearch()" style="background: none; border: none; cursor: pointer; padding: 8px;" aria-label="Buscar">
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
                @php
                    $cart = session()->get('cart', []);
                    $cartCount = array_sum(array_column($cart, 'quantity'));
                @endphp
                @if($cartCount > 0)
                <span style="position: absolute; top: 0; right: 0; background-color: #EE403D; color: white; font-size: 10px; font-weight: 600; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </div>
</header>

<!-- Search Modal -->
<div id="searchModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); z-index: 9999; align-items: flex-start; justify-content: center; padding-top: 100px;">
    <div style="background-color: white; width: 90%; max-width: 600px; border-radius: 8px; box-shadow: 0 4px 24px rgba(0,0,0,0.2); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #E5E5E5; display: flex; align-items: center; gap: 12px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input 
                type="text" 
                id="searchInput" 
                placeholder="Buscar productos..." 
                style="flex: 1; border: none; outline: none; font-size: 16px; font-family: 'Jost', sans-serif;"
                autocomplete="off"
            >
            <button onclick="toggleSearch()" style="background: none; border: none; cursor: pointer; padding: 4px; color: #666; font-size: 24px; line-height: 1;">&times;</button>
        </div>
        <div id="searchResults" style="max-height: 400px; overflow-y: auto; padding: 12px;">
            <div style="text-align: center; padding: 40px 20px; color: #999; font-family: 'Jost', sans-serif;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#E5E5E5" stroke-width="2" style="margin: 0 auto 16px;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <p>Escribe para buscar productos</p>
            </div>
        </div>
    </div>
</div>

<script>
let searchTimeout;
let searchInitialized = false;

function toggleSearch() {
    const modal = document.getElementById('searchModal');
    const input = document.getElementById('searchInput');
    
    if (!modal || !input) {
        console.error('Search modal or input not found');
        return;
    }
    
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'flex';
        setTimeout(() => input.focus(), 100);
    } else {
        modal.style.display = 'none';
        input.value = '';
        document.getElementById('searchResults').innerHTML = `
            <div style="text-align: center; padding: 40px 20px; color: #999; font-family: 'Jost', sans-serif;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#E5E5E5" stroke-width="2" style="margin: 0 auto 16px;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <p>Escribe para buscar productos</p>
            </div>
        `;
    }
}

// Initialize search functionality
function initializeSearch() {
    if (searchInitialized) return;
    searchInitialized = true;
    
    const modal = document.getElementById('searchModal');
    const searchInput = document.getElementById('searchInput');
    
    if (!modal || !searchInput) {
        console.error('Search elements not found');
        return;
    }
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            toggleSearch();
        }
    });
    
    // Search input listener
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            document.getElementById('searchResults').innerHTML = `
                <div style="text-align: center; padding: 40px 20px; color: #999; font-family: 'Jost', sans-serif;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#E5E5E5" stroke-width="2" style="margin: 0 auto 16px;">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <p>Escribe al menos 2 caracteres</p>
                </div>
            `;
            return;
        }
        
        // Show loading
        document.getElementById('searchResults').innerHTML = `
            <div style="text-align: center; padding: 40px 20px; color: #999; font-family: 'Jost', sans-serif;">
                <div style="width: 40px; height: 40px; border: 3px solid #E5E5E5; border-top-color: #EE403D; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 16px;"></div>
                <p>Buscando...</p>
            </div>
        `;
        
        // Debounce search
        searchTimeout = setTimeout(() => {
            searchProducts(query);
        }, 300);
    });
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            toggleSearch();
        }
    });
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeSearch);
} else {
    initializeSearch();
}

function searchProducts(query) {
    const baseUrl = window.location.origin;
    
    fetch(`${baseUrl}/shop/search?q=${encodeURIComponent(query)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (!data.success || !data.products || data.products.length === 0) {
            document.getElementById('searchResults').innerHTML = `
                <div style="text-align: center; padding: 40px 20px; color: #999; font-family: 'Jost', sans-serif;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#E5E5E5" stroke-width="2" style="margin: 0 auto 16px;">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <p>No se encontraron productos para "${query}"</p>
                    <a href="${baseUrl}/shop" style="display: inline-block; margin-top: 12px; padding: 10px 20px; background-color: #EE403D; color: white; text-decoration: none; border-radius: 4px; font-weight: 500;">Ver todos los productos</a>
                </div>
            `;
            return;
        }
        
        // Build results HTML
        let resultsHtml = '<div style="display: flex; flex-direction: column; gap: 12px;">';
        
        data.products.slice(0, 5).forEach(product => {
            const priceHtml = product.original_price 
                ? `<span style="font-weight: 600; color: #EE403D;">$${Number(product.price).toFixed(2)}</span> <span style="text-decoration: line-through; color: #999; font-size: 14px;">$${Number(product.original_price).toFixed(2)}</span>`
                : `<span style="font-weight: 600; color: #EE403D;">$${Number(product.price).toFixed(2)}</span>`;
            
            const productImage = product.image || `${baseUrl}/images/placeholder.png`;
            
            resultsHtml += `
                <a href="${product.url}" style="display: flex; gap: 16px; padding: 12px; border-radius: 6px; text-decoration: none; color: inherit; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#F5F6F2'" onmouseout="this.style.backgroundColor='transparent'">
                    <div style="flex-shrink: 0; width: 80px; height: 80px; background-color: #F5F6F2; border-radius: 6px; overflow: hidden;">
                        <img src="${productImage}" alt="${product.name}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://via.placeholder.com/80'">
                    </div>
                    <div style="flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 4px;">
                        <p style="font-family: 'Jost', sans-serif; font-size: 14px; color: #999; margin: 0;">${product.category}</p>
                        <p style="font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; color: #212529; margin: 0; line-height: 1.3;">${product.name}</p>
                        <p style="font-family: 'Jost', sans-serif; font-size: 16px; margin: 0;">${priceHtml}</p>
                    </div>
                </a>
            `;
        });
        
        if (data.products.length > 5) {
            resultsHtml += `
                <a href="${baseUrl}/shop?search=${encodeURIComponent(query)}" style="display: block; text-align: center; padding: 12px; color: #EE403D; font-family: 'Jost', sans-serif; font-weight: 500; text-decoration: none; border-top: 1px solid #E5E5E5;">
                    Ver todos los ${data.total} resultados →
                </a>
            `;
        }
        
        resultsHtml += '</div>';
        document.getElementById('searchResults').innerHTML = resultsHtml;
    })
    .catch(error => {
        console.error('Search error:', error);
        document.getElementById('searchResults').innerHTML = `
            <div style="text-align: center; padding: 40px 20px; color: #999; font-family: 'Jost', sans-serif;">
                <p style="color: #EE403D;">Error al buscar productos</p>
                <p style="font-size: 13px; color: #999;">${error.message}</p>
                <button onclick="searchProducts('${query}')" style="margin-top: 12px; padding: 10px 20px; background-color: #EE403D; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 500;">Reintentar</button>
            </div>
        `;
    });
}
</script>

<style>
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
