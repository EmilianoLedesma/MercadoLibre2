@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="container" style="margin-top: 50px; padding: 0 20px;">
    <h1 style="margin-bottom: 30px;">Listado de Clientes/Usuarios</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 15px; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">ID</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Nombre</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Email</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Rol</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Teléfono</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Activo</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $cliente->id }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $cliente->name }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $cliente->email }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        <span style="padding: 4px 8px; border-radius: 4px; background:
                            {{ $cliente->role == 'admin' ? '#007bff' : ($cliente->role == 'seller' ? '#28a745' : '#6c757d') }};
                            color: white; font-size: 12px;">
                            {{ ucfirst($cliente->role) }}
                        </span>
                    </td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $cliente->phone ?? 'N/A' }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        <span style="color: {{ $cliente->is_active ? 'green' : 'red' }};">
                            {{ $cliente->is_active ? 'Sí' : 'No' }}
                        </span>
                    </td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center; border: 1px solid #ddd;">
                        No hay clientes registrados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="{{ route('home') }}" style="padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; display: inline-block;">Volver al Home</a>
    </div>
</div>
@endsection
