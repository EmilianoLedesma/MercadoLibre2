@extends('layouts.app')

@section('title', 'Lista de Deseos')

@section('content')
@include('layouts.navbar')

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Lista de Deseos
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="{{ route('home') }}" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Lista de Deseos</span>
        </nav>
    </div>
</div>

<!-- Wishlist Content -->
<section style="padding: 60px 20px; background: white; min-height: 60vh;">
    <div style="max-width: 1200px; margin: 0 auto;">
        @if(isset($wishlistItems) && $wishlistItems->count() > 0)
        <!-- Wishlist Table -->
        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; overflow: hidden; margin-bottom: 32px;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #FAFAFA; border-bottom: 2px solid #E5E5E5;">
                            <th style="padding: 20px; text-align: center; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666; width: 80px;"></th>
                            <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Product</th>
                            <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Unit Price</th>
                            <th style="padding: 20px; text-align: left; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Stock Status</th>
                            <th style="padding: 20px; text-align: center; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666; width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlistItems as $item)
                        <tr style="border-bottom: 1px solid #E5E5E5;" id="wishlist-item-{{ $item->id }}">
                            <!-- Remove Button -->
                            <td style="padding: 20px; text-align: center;">
                                <button onclick="removeFromWishlist({{ $item->id }})" style="background: none; border: none; color: #999; cursor: pointer; font-size: 18px; width: 40px; height: 40px; border-radius: 50%; transition: all 0.3s;" onmouseover="this.style.background='#FEF2F2'; this.style.color='#EF4444';" onmouseout="this.style.background='none'; this.style.color='#999';">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>

                            <!-- Product Info -->
                            <td style="padding: 20px;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <a href="{{ route('shop.show', $item->slug) }}" style="flex-shrink: 0;">
                                        <img src="{{ $item->image ?? '/images/placeholder.jpg' }}" alt="{{ $item->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #E5E5E5;">
                                    </a>
                                    <div>
                                        <a href="{{ route('shop.show', $item->slug) }}" style="font-family: 'Jost', sans-serif; font-size: 16px; font-weight: 600; color: #212529; text-decoration: none; display: block; margin-bottom: 4px; transition: color 0.3s;" onmouseover="this.style.color='#EE403D'" onmouseout="this.style.color='#212529'">
                                            {{ $item->name }}
                                        </a>
                                        @if($item->category)
                                        <div style="font-size: 13px; color: #999;">{{ $item->category->name }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Price -->
                            <td style="padding: 20px;">
                                <div style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #EE403D;">
                                    ${{ number_format($item->price, 2) }}
                                </div>
                            </td>

                            <!-- Stock Status -->
                            <td style="padding: 20px;">
                                @if($item->stock > 0)
                                <div style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #F0FDF4; border-radius: 20px; font-size: 13px; font-weight: 500; color: #10B981;">
                                    <i class="fas fa-check-circle"></i>
                                    <span>In Stock</span>
                                </div>
                                @else
                                <div style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #FEF2F2; border-radius: 20px; font-size: 13px; font-weight: 500; color: #EF4444;">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Out of Stock</span>
                                </div>
                                @endif
                            </td>

                            <!-- Add to Cart Button -->
                            <td style="padding: 20px; text-align: center;">
                                @if($item->stock > 0)
                                <button onclick="moveToCart({{ $item->id }})" style="background: #EE403D; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 14px; transition: background 0.3s; white-space: nowrap;" onmouseover="this.style.background='#E32020'" onmouseout="this.style.background='#EE403D'">
                                    <i class="fas fa-shopping-cart" style="margin-right: 6px;"></i>Add to Cart
                                </button>
                                @else
                                <button disabled style="background: #E5E5E5; color: #999; border: none; padding: 10px 20px; border-radius: 8px; cursor: not-allowed; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 14px; white-space: nowrap;">
                                    Out of Stock
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Wishlist Actions -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <!-- Clear Wishlist -->
            <form action="{{ route('wishlist.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your entire wishlist?');">
                @csrf
                <button type="submit" style="background: white; color: #EF4444; border: 2px solid #EF4444; padding: 12px 28px; border-radius: 8px; cursor: pointer; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; transition: all 0.3s;" onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='white'">
                    <i class="fas fa-trash" style="margin-right: 8px;"></i>Clear Wishlist
                </button>
            </form>

            <!-- Share Wishlist -->
            <div style="display: flex; gap: 12px; align-items: center;">
                <span style="font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; color: #666;">Share:</span>
                <div style="display: flex; gap: 8px;">
                    <button onclick="shareWishlist('facebook')" style="width: 40px; height: 40px; border-radius: 50%; background: #1877F2; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button onclick="shareWishlist('twitter')" style="width: 40px; height: 40px; border-radius: 50%; background: #1DA1F2; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button onclick="shareWishlist('pinterest')" style="width: 40px; height: 40px; border-radius: 50%; background: #E60023; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fab fa-pinterest-p"></i>
                    </button>
                    <button onclick="shareWishlist('whatsapp')" style="width: 40px; height: 40px; border-radius: 50%; background: #25D366; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                </div>
            </div>
        </div>

        @else
        <!-- Empty Wishlist State -->
        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 80px 40px; text-align: center;">
            <div style="width: 120px; height: 120px; background: #F5F6F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <i class="fas fa-heart" style="font-size: 56px; color: #E5E5E5;"></i>
            </div>
            <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 12px 0;">
                Tu wishlist está vacía
            </h2>
            <p style="color: #666; margin: 0 0 32px 0; font-size: 16px; max-width: 400px; margin-left: auto; margin-right: auto;">
                Empieza añadiendo productos a tu wishlist al hacer clic en el ícono de corazón en la página de productos.
            </p>
            <a href="{{ route('shop.index') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #EE403D; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; transition: background 0.3s;" onmouseover="this.style.background='#E32020'" onmouseout="this.style.background='#EE403D'">
                <i class="fas fa-shopping-bag"></i>
                <span>Continua comprando</span>
            </a>
        </div>
        @endif

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div id="success-message" style="position: fixed; top: 20px; right: 20px; background: #10B981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; display: flex; align-items: center; gap: 12px; animation: slideIn 0.3s ease;">
            <i class="fas fa-check-circle" style="font-size: 20px;"></i>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
        @endif
    </div>
</section>

@include('layouts.footer')

@push('styles')
<style>
@keyframes slideIn {
    from {
        transform: translateX(400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
        transform: translateX(400px);
    }
}

@media (max-width: 768px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 12px !important;
    }

    td div[style*="display: flex"] {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 8px !important;
    }

    td img {
        width: 60px !important;
        height: 60px !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Remove from Wishlist
function removeFromWishlist(productId) {
    if (!confirm('Remove this product from your wishlist?')) {
        return;
    }

    fetch(`/wishlist/remove/${productId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove row with animation
            const row = document.getElementById(`wishlist-item-${productId}`);
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            row.style.transition = 'all 0.3s';

            setTimeout(() => {
                row.remove();

                // Check if wishlist is now empty
                const tbody = document.querySelector('tbody');
                if (!tbody || tbody.children.length === 0) {
                    location.reload();
                }
            }, 300);

            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to remove item from wishlist', 'error');
    });
}

// Move to Cart
function moveToCart(productId) {
    fetch(`/wishlist/move-to-cart/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove from wishlist UI
            const row = document.getElementById(`wishlist-item-${productId}`);
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            row.style.transition = 'all 0.3s';

            setTimeout(() => {
                row.remove();

                // Check if wishlist is now empty
                const tbody = document.querySelector('tbody');
                if (!tbody || tbody.children.length === 0) {
                    location.reload();
                }
            }, 300);

            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to move item to cart', 'error');
    });
}

// Share Wishlist
function shareWishlist(platform) {
    const url = window.location.href;
    const text = 'Check out my wishlist!';
    let shareUrl;

    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
            break;
        case 'pinterest':
            shareUrl = `https://pinterest.com/pin/create/button/?url=${encodeURIComponent(url)}&description=${encodeURIComponent(text)}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
            break;
    }

    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

// Show Notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? '#10B981' : '#EF4444';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';

    notification.innerHTML = `
        <i class="fas fa-${icon}" style="font-size: 20px;"></i>
        <span style="font-weight: 500;">${message}</span>
    `;
    notification.style = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${bgColor};
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Auto-hide success message
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => successMessage.remove(), 300);
        }, 3000);
    }
});
</script>
@endpush

@endsection
