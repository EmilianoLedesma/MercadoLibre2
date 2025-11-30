<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MiCuentaController extends Controller
{
    /** Mostrar la página de 'Mi cuenta' */
    public function index()
    {
        $user = Auth::user();
        $addresses = $user ? $user->addresses()->get()->map(function ($a) {
            return [
                'id' => $a->id,
                'street' => $a->address_line_1,
                'number' => $a->address_line_2,
                'postal_code' => $a->postal_code,
                'note' => $a->city . ' / ' . $a->state,
            ];
        })->toArray() : [];

        // Get user's orders with products
        $orders = $user ? $user->orders()->with(['items.product'])->latest()->get() : collect();
        $ordersCount = $orders->count();

        // Get all purchased products with review status
        $purchasedProducts = collect();
        if ($user) {
            foreach ($orders as $order) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $existingReview = $item->product->reviews()->where('user_id', $user->id)->first();
                        $purchasedProducts->push([
                            'product' => $item->product,
                            'order_id' => $order->id,
                            'order_number' => $order->order_number,
                            'has_review' => $existingReview !== null,
                            'review' => $existingReview,
                        ]);
                    }
                }
            }
        }

        return view('account.index', compact('addresses', 'orders', 'ordersCount', 'purchasedProducts'));
    }

    /** Actualizar datos simples del usuario (teléfono) */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'phone' => ['nullable','string','max:30'],
        ]);

        $user->phone = $data['phone'] ?? null;
        $user->save();

        return back()->with('success', 'Perfil actualizado');
    }

    /** Guardar direcciones enviadas desde la vista */
    public function saveAddresses(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $rules = [
            'addresses' => ['required','array'],
            'addresses.*.id' => ['nullable','integer','exists:addresses,id'],
            'addresses.*.street' => ['required','string','max:255'],
            'addresses.*.number' => ['nullable','string','max:50'],
            'addresses.*.postal_code' => ['required','string','max:20'],
            'addresses.*.note' => ['nullable','string','max:255'],
        ];

        $messages = [
            'addresses.*.street.required' => 'La calle es obligatoria.',
            'addresses.*.postal_code.required' => 'El código postal es obligatorio.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $addresses = $request->input('addresses', []);
        $submittedIds = [];

        // Update existing addresses or create new ones
        foreach ($addresses as $addr) {
            $parsedNote = explode(' / ', $addr['note'] ?? '');
            $addressData = [
                'user_id' => $user->id,
                'address_line_1' => $addr['street'],
                'address_line_2' => $addr['number'] ?? null,
                'postal_code' => $addr['postal_code'],
                'city' => $parsedNote[0] ?? '',
                'state' => $parsedNote[1] ?? '',
                'country' => 'México',
                'is_default' => false,
            ];

            if (isset($addr['id']) && $addr['id']) {
                // Update existing address
                $address = Address::where('id', $addr['id'])
                    ->where('user_id', $user->id)
                    ->first();
                if ($address) {
                    $address->update($addressData);
                    $submittedIds[] = $address->id;
                }
            } else {
                // Create new address
                $newAddress = Address::create($addressData);
                $submittedIds[] = $newAddress->id;
            }
        }

        // Delete addresses that were not in the submitted data
        // BUT only if they're not referenced by orders
        $user->addresses()
            ->whereNotIn('id', $submittedIds)
            ->whereDoesntHave('orders') // Only delete if no orders reference them
            ->delete();

        return back()->with('success', 'Direcciones guardadas correctamente');
    }

    /** Eliminar cuenta de usuario (soft delete) */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $user->delete(); // Soft delete
        Auth::logout();
        
        return redirect()->route('home')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}