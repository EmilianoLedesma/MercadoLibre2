<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
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

        return view('clientes.index', compact('addresses'));
    }

    /** Actualizar datos simples del usuario (teléfono) */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
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
        if (! $user) {
            return redirect()->route('login');
        }

        $rules = [
            'addresses' => ['required','array'],
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

        // Para simplificar, borraremos todas las direcciones del usuario y re-crearemos
        // Alternativamente se podría actualizar/crear por id.
        $user->addresses()->delete();

        foreach ($addresses as $addr) {
            Address::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'phone' => $user->phone ?? '',
                'address_line_1' => $addr['street'] ?? '',
                'address_line_2' => $addr['number'] ?? null,
                'city' => '',
                'state' => '',
                'postal_code' => $addr['postal_code'] ?? '',
                'country' => 'México',
                'is_default' => false,
            ]);
        }

        return back()->with('success', 'Direcciones guardadas.');
    }
}
