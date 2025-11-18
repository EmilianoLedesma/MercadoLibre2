<!-- Search Modal Component -->
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

<style>
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

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
<?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/components/search-modal.blade.php ENDPATH**/ ?>