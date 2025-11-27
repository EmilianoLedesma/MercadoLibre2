<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user:id,name,email', 'items.product']);

        // Si es un cliente, solo ver sus pedidos
        if (auth()->user()->role === 'customer') {
            $query->where('user_id', auth()->id());
        }

        // Filtro por estado
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filtro por estado de pago
        if ($request->has('payment_status') && $request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        // Búsqueda por número de orden
        if ($request->has('search') && $request->search) {
            $query->where('order_number', 'like', "%{$request->search}%");
        }

        $orders = $query->latest()->paginate(15);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $orders,
            ]);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Request $request, Order $order)
    {
        // Verificar que el usuario pueda ver este pedido
        if (auth()->user()->role === 'customer' && $order->user_id !== auth()->id()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No tienes permiso para ver este pedido',
                ], 403);
            }
            abort(403, 'No tienes permiso para ver este pedido');
        }

        $order->load(['user', 'address', 'items.product']);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $order,
            ]);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        // Solo admin y seller pueden editar
        if (!in_array(auth()->user()->role, ['admin', 'seller'])) {
            abort(403, 'No tienes permiso para editar pedidos');
        }

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            // Solo admin y seller pueden actualizar
            if (!in_array(auth()->user()->role, ['admin', 'seller'])) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No tienes permiso para actualizar pedidos',
                    ], 403);
                }
                abort(403, 'No tienes permiso para actualizar pedidos');
            }

            $data = $request->validated();
            $order->update($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pedido actualizado correctamente',
                    'data' => $order,
                ]);
            }

            return redirect()->route('orders.index')
                ->with('success', 'Pedido actualizado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar pedido: ' . $e->getMessage(),
                ], 500);
            }

            return back()->withInput()
                ->with('error', 'Error al actualizar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Request $request, Order $order)
    {
        try {
            // Solo admin puede eliminar pedidos
            if (auth()->user()->role !== 'admin') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Solo los administradores pueden eliminar pedidos',
                    ], 403);
                }
                abort(403, 'Solo los administradores pueden eliminar pedidos');
            }

            // Solo se pueden eliminar pedidos cancelados
            if ($order->status !== 'cancelled') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Solo se pueden eliminar pedidos cancelados',
                    ], 400);
                }
                return back()->with('error', 'Solo se pueden eliminar pedidos cancelados');
            }

            $order->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pedido eliminado correctamente',
                ]);
            }

            return redirect()->route('orders.index')
                ->with('success', 'Pedido eliminado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar pedido: ' . $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Error al eliminar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Cancel an order.
     */
    public function cancel(Request $request, Order $order)
    {
        try {
            // Verificar permisos
            if (auth()->user()->role === 'customer' && $order->user_id !== auth()->id()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No tienes permiso para cancelar este pedido',
                    ], 403);
                }
                abort(403, 'No tienes permiso para cancelar este pedido');
            }

            // Solo se pueden cancelar pedidos pending o processing
            if (!in_array($order->status, ['pending', 'processing'])) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Este pedido no puede ser cancelado',
                    ], 400);
                }
                return back()->with('error', 'Este pedido no puede ser cancelado');
            }

            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'refunded',
            ]);

            // Restaurar stock de productos
            foreach ($order->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pedido cancelado correctamente',
                    'data' => $order,
                ]);
            }

            return redirect()->route('orders.show', $order)
                ->with('success', 'Pedido cancelado correctamente.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al cancelar pedido: ' . $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Error al cancelar pedido: ' . $e->getMessage());
        }
    }
}
