<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Tu carrito está vacío');
        }

        // Get user information and addresses for pre-filling
        $userInfo = null;
        $defaultAddress = null;
        
        if (Auth::check()) {
            $user = Auth::user();
            
            // Split name if last_name is not set
            $firstName = $user->name;
            $lastName = $user->last_name;
            
            if (empty($lastName) && !empty($user->name)) {
                // Split the full name into first and last name
                $nameParts = explode(' ', trim($user->name), 2);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
            }
            
            $userInfo = [
                'name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->email,
                'phone' => $user->phone,
            ];
            
            // Get the default address or the first available address
            $address = $user->addresses()->where('is_default', true)->first() 
                       ?? $user->addresses()->first();
            
            if ($address) {
                $defaultAddress = [
                    'address' => $address->address_line_1 . ($address->address_line_2 ? ' ' . $address->address_line_2 : ''),
                    'city' => $address->city,
                    'state' => $address->state,
                    'postal_code' => $address->postal_code,
                    'country' => $address->country ?? 'México',
                ];
            }
        }

        return view('checkout', compact('userInfo', 'defaultAddress'));
    }

    /**
     * Process the checkout and create the order
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'payment_method' => 'required|in:cash,card,transfer',
            'notes' => 'nullable|string|max:1000',
        ], [
            'first_name.required' => 'El nombre es obligatorio',
            'last_name.required' => 'El apellido es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico no es válido',
            'phone.required' => 'El teléfono es obligatorio',
            'address.required' => 'La dirección es obligatoria',
            'city.required' => 'La ciudad es obligatoria',
            'state.required' => 'El estado es obligatorio',
            'postal_code.required' => 'El código postal es obligatorio',
            'country.required' => 'El país es obligatorio',
            'payment_method.required' => 'Selecciona un método de pago',
            'payment_method.in' => 'El método de pago no es válido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Tu carrito está vacío');
        }

        DB::beginTransaction();

        try {
            // Calculate totals
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $shipping = $subtotal >= 100 ? 0 : 15;
            $tax = $subtotal * 0.10;
            $total = $subtotal + $shipping + $tax;

            // Create the order
            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_first_name' => $request->first_name,
                'shipping_last_name' => $request->last_name,
                'shipping_email' => $request->email,
                'shipping_phone' => $request->phone,
                'shipping_address' => $request->address,
                'shipping_city' => $request->city,
                'shipping_state' => $request->state,
                'shipping_postal_code' => $request->postal_code,
                'shipping_country' => $request->country,
                'notes' => $request->notes,
            ]);

            // Create order items and reduce stock
            foreach ($cart as $id => $item) {
                $product = Product::findOrFail($id);

                // Check stock availability
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("El producto '{$product->name}' no tiene suficiente stock. Disponible: {$product->stock_quantity}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Reduce stock
                $product->decrement('stock_quantity', $item['quantity']);
            }

            // Clear the cart
            session()->forget('cart');

            DB::commit();

            return redirect()->route('checkout.confirmation', $order->id)
                ->with('success', '¡Pedido realizado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the order confirmation page
     */
    public function confirmation($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        // Verify the order belongs to the current user (if authenticated)
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        return view('checkout.confirmation', compact('order'));
    }
}
