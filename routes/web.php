<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MiCuentaController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Models\Category;
use App\Models\Product;

// Página de inicio
Route::get('/', function () {
    // Obtener categorías activas con contador de productos incluyendo subcategorías
    $categories = collect();

    // Obtener todas las categorías padre
    $parentCategories = Category::where('is_active', true)
        ->whereNull('parent_id')
        ->get();

    foreach ($parentCategories as $category) {
        // Obtener IDs de subcategorías
        $subcategoryIds = Category::where('parent_id', $category->id)->pluck('id');

        // Contar productos de la categoría padre y sus subcategorías
        $productsCount = Product::where('is_active', true)->where(function($query) use ($category, $subcategoryIds) {
            $query->where('category_id', $category->id)
                  ->orWhereIn('category_id', $subcategoryIds);
        })->count();

        if ($productsCount > 0) {
            $category->products_count = $productsCount;
            $categories->push($category);
        }

        // Limitar a 8 categorías que tienen productos
        if ($categories->count() >= 8) {
            break;
        }
    }

    // Obtener TODAS las categorías para el menú desplegable con contador de productos
    $allCategories = Category::withCount('products')
        ->where('is_active', true)
        ->orderBy('name', 'asc')
        ->get();

    // Obtener más productos destacados para el carousel (8 productos)
    $featuredProducts = Product::where('is_active', true)
        ->where('is_featured', true)
        ->with('category')
        ->inRandomOrder()
        ->take(8)
        ->get();

    // Obtener productos más vendidos (simulado con productos activos aleatorios)
    // En producción, esto debería basarse en ventas reales
    $bestSellers = Product::where('is_active', true)
        ->with('category')
        ->inRandomOrder()
        ->take(8)
        ->get();

    return view('home', compact('categories', 'allCategories', 'featuredProducts', 'bestSellers'));
})->name('home');

// Ruta de ofertas/deals
Route::get('/deals', function () {
    $products = \App\Models\Product::where('is_active', true)
        ->whereNotNull('sale_price')
        ->where('sale_price', '>', 0)
        ->with('category')
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('deals', compact('products'));
})->name('deals');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/seller/register', [AuthController::class, 'showSellerRegister'])->name('seller.register');
Route::post('/seller/register', [AuthController::class, 'registerSeller'])->name('seller.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta de clientes (solo para usuarios autenticados)
Route::get('/clientes', [ClienteController::class, 'index'])->middleware('auth')->name('clientes');
Route::put('/clientes', [ClienteController::class, 'update'])->middleware('auth')->name('clientes.update');
Route::post('/clientes/addresses', [ClienteController::class, 'saveAddresses'])->middleware('auth')->name('clientes.addresses.save');

// Rutas para 'Mi cuenta' (misma funcionalidad, ruta amigable)
Route::get('/account', [MiCuentaController::class, 'index'])->middleware('auth')->name('account');
Route::put('/account', [MiCuentaController::class, 'update'])->middleware('auth')->name('account.update');
Route::post('/account/addresses', [MiCuentaController::class, 'saveAddresses'])->middleware('auth')->name('account.addresses.save');
Route::delete('/account', [MiCuentaController::class, 'destroy'])->middleware('auth')->name('account.destroy');

// Rutas para órdenes
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth')->name('orders.show');

// Carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/confirmation/{orderId}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Wishlist (Lista de deseos)
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::post('/wishlist/move-to-cart/{id}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

// Reviews (Reseñas)
Route::middleware(['auth'])->group(function () {
    Route::post('/products/{product}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Categorías
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

// Nosotros
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contacto
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// FAQ
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Returns/Devoluciones
Route::get('/returns', function () {
    $orders = collect();
    if (auth()->check()) {
        $orders = App\Models\Order::where('user_id', auth()->id())
            ->whereNotIn('status', ['returned'])
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    return view('returns', compact('orders'));
})->name('returns');

Route::post('/returns/submit', function (Illuminate\Http\Request $request) {
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'reason' => 'required|string',
        'description' => 'nullable|string|max:1000',
    ]);

    // Obtener el pedido y cambiar el estado a 'returned'
    $order = \App\Models\Order::findOrFail($request->order_id);
    
    // Verificar que el pedido pertenece al usuario autenticado
    if ($order->user_id !== auth()->id()) {
        return response()->json([
            'success' => false,
            'message' => 'No tienes permiso para devolver este pedido.'
        ], 403);
    }
    
    // Cambiar el estado del pedido a 'returned'
    $order->status = 'returned';
    $order->save();
    
    return response()->json([
        'success' => true,
        'message' => '¡Tu solicitud de devolución ha sido procesada!'
    ]);
})->middleware('auth')->name('returns.submit');

// Rastrear Pedido
Route::get('/track-order', function () {
    return view('track-order');
})->name('track.order');

// API para rastrear pedido
Route::get('/api/track-order/{orderNumber}', function ($orderNumber) {
    try {
        $order = \App\Models\Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró ningún pedido con ese número'
            ], 404);
        }

        // Calculate items count
        $itemsCount = $order->items->sum('quantity');

        // Calculate estimated delivery date (2 days after order creation)
        $estimatedDelivery = $order->created_at->copy()->addDays(2)->format('d/m/Y');

        return response()->json([
            'success' => true,
            'order' => [
                'order_number' => $order->order_number,
                'created_at' => $order->created_at->format('d/m/Y'),
                'created_at_full' => $order->created_at->format('d M Y, H:i'),
                'estimated_delivery' => $estimatedDelivery,
                'status' => $order->status,
                'shipping_name' => $order->shipping_first_name ? ($order->shipping_first_name . ' ' . ($order->shipping_last_name ?? '')) : 'No especificado',
                'shipping_address' => $order->shipping_address,
                'shipping_city' => $order->shipping_city,
                'shipping_state' => $order->shipping_state,
                'shipping_zip' => $order->shipping_zip,
                'shipping_phone' => $order->shipping_phone,
                'subtotal' => number_format($order->subtotal, 2),
                'shipping_cost' => $order->shipping_cost,
                'total' => number_format($order->total, 2),
                'items_count' => $itemsCount
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al buscar el pedido'
        ], 500);
    }
});

// Tienda - Vistas públicas para clientes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/search', [ShopController::class, 'search'])->name('shop.search');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/category/{slug}', [ShopController::class, 'category'])->name('shop.category');

// Rutas de productos - CRUD completo (Admin/Management)
Route::resource('products', ProductController::class);

// Rutas para Vendedores (Sellers)
Route::middleware(['auth'])->prefix('seller')->name('seller.')->group(function () {
    // Dashboard del vendedor
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    
    // Perfil y tienda del vendedor
    Route::get('/profile', [SellerController::class, 'profile'])->name('profile');
    Route::put('/profile', [SellerController::class, 'updateProfile'])->name('profile.update');
    Route::put('/store', [SellerController::class, 'updateStore'])->name('store.update');
    
    // CRUD de productos del vendedor
    Route::resource('products', SellerProductController::class);
});

// Rutas protegidas por rol (Admin)
Route::middleware(['auth', 'role:admin,seller'])->group(function () {
    // CRUD de Usuarios (solo admin)
    Route::resource('users', UserController::class)->middleware('role:admin');
    
    // CRUD de Pedidos
    Route::resource('orders', OrderController::class)->except(['create', 'store']);
    Route::post('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// Rutas de Administración Suprema (solo Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gestión de todos los productos
    Route::get('/products', [App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/toggle-status', [App\Http\Controllers\Admin\AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('/products/{product}/toggle-featured', [App\Http\Controllers\Admin\AdminProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
});
