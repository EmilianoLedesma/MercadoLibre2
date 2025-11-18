# Documentación de Endpoints CRUD - Sprint 2

## Información General

Base URL (Desarrollo): `http://localhost:8000`

Todos los endpoints soportan dos formatos de respuesta:
- **HTML**: Para navegación web tradicional
- **JSON**: Agregar header `Accept: application/json` para obtener respuestas JSON

## Autenticación

La mayoría de endpoints requieren autenticación. Usar las credenciales de sesión de Laravel.

### Roles de Usuario
- `customer`: Cliente normal
- `seller`: Vendedor
- `admin`: Administrador

---

## 1. CRUD de Productos

### 1.1 Listar Productos
**GET** `/products`

**Permisos**: Público

**Respuesta JSON**:
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Producto Ejemplo",
        "slug": "producto-ejemplo",
        "price": "99.99",
        "stock_quantity": 50,
        "is_active": true,
        "category_id": 1,
        "created_at": "2025-11-18T00:00:00.000000Z",
        "category": {
          "id": 1,
          "name": "Categoría"
        }
      }
    ],
    "per_page": 10,
    "total": 100
  }
}
```

### 1.2 Ver Producto
**GET** `/products/{id}`

**Permisos**: Público

**Respuesta JSON**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Producto Ejemplo",
    "slug": "producto-ejemplo",
    "description": "Descripción completa",
    "short_description": "Descripción corta",
    "sku": "SKU-001",
    "price": "99.99",
    "sale_price": "79.99",
    "stock_quantity": 50,
    "category_id": 1,
    "user_id": 1,
    "images": ["products/image1.jpg"],
    "is_active": true,
    "is_featured": false,
    "category": {...},
    "user": {...}
  }
}
```

### 1.3 Crear Producto
**POST** `/products`

**Permisos**: Autenticado

**Body (multipart/form-data)**:
```
name: string (required, max:255)
description: string (required)
short_description: string (optional, max:500)
sku: string (required, max:100, unique)
price: numeric (required, min:0)
sale_price: numeric (optional, min:0, lt:price)
stock_quantity: integer (required, min:0)
category_id: integer (required, exists:categories)
is_active: boolean (optional)
is_featured: boolean (optional)
images[]: file[] (optional, image, max:2MB)
```

**Respuesta JSON (201)**:
```json
{
  "success": true,
  "message": "Producto creado correctamente",
  "data": {
    "id": 1,
    "name": "Producto Nuevo",
    ...
  }
}
```

**Errores (422)**:
```json
{
  "message": "El nombre del producto es obligatorio.",
  "errors": {
    "name": ["El nombre del producto es obligatorio."]
  }
}
```

### 1.4 Actualizar Producto
**PUT/PATCH** `/products/{id}`

**Permisos**: Autenticado

**Body**: Mismo que crear producto, más:
```
delete_images[]: array (optional) - Índices de imágenes a eliminar
```

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Producto actualizado correctamente",
  "data": {...}
}
```

### 1.5 Eliminar Producto
**DELETE** `/products/{id}`

**Permisos**: Autenticado

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Producto eliminado correctamente"
}
```

---

## 2. CRUD de Usuarios

### 2.1 Listar Usuarios
**GET** `/users`

**Permisos**: Admin

**Query Parameters**:
- `role`: Filter by role (customer, seller, admin)
- `is_active`: Filter by status (0, 1)
- `search`: Search by name or email

**Respuesta JSON**:
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Usuario",
        "last_name": "Apellido",
        "email": "user@example.com",
        "role": "customer",
        "is_active": true,
        "created_at": "2025-11-18T00:00:00.000000Z"
      }
    ],
    "per_page": 15,
    "total": 50
  }
}
```

### 2.2 Ver Usuario
**GET** `/users/{id}`

**Permisos**: Admin

**Respuesta JSON**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Usuario",
    "last_name": "Apellido",
    "email": "user@example.com",
    "phone": "1234567890",
    "role": "customer",
    "is_active": true,
    "addresses": [...],
    "orders": [...],
    "products": [...],
    "store": {...}
  }
}
```

### 2.3 Crear Usuario
**POST** `/users`

**Permisos**: Admin

**Body (JSON)**:
```json
{
  "name": "string (required, max:255)",
  "last_name": "string (optional, max:255)",
  "email": "string (required, email, unique)",
  "password": "string (required, min:8)",
  "password_confirmation": "string (required)",
  "phone": "string (optional, max:30)",
  "role": "customer|seller|admin (required)",
  "is_active": "boolean (optional)"
}
```

**Respuesta JSON (201)**:
```json
{
  "success": true,
  "message": "Usuario creado correctamente",
  "data": {
    "id": 1,
    "name": "Usuario Nuevo",
    ...
  }
}
```

### 2.4 Actualizar Usuario
**PUT/PATCH** `/users/{id}`

**Permisos**: Admin

**Body**: Mismo que crear, pero password es opcional

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Usuario actualizado correctamente",
  "data": {...}
}
```

### 2.5 Eliminar Usuario (Soft Delete)
**DELETE** `/users/{id}`

**Permisos**: Admin

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Usuario eliminado correctamente"
}
```

---

## 3. CRUD de Pedidos

### 3.1 Listar Pedidos
**GET** `/orders`

**Permisos**: 
- Admin/Seller: Ver todos
- Customer: Solo sus pedidos

**Query Parameters**:
- `status`: Filter by status (pending, processing, shipped, delivered, cancelled)
- `payment_status`: Filter by payment (pending, paid, failed, refunded)
- `search`: Search by order number

**Respuesta JSON**:
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "order_number": "ORD-ABC123",
        "status": "pending",
        "payment_status": "pending",
        "total": "199.99",
        "created_at": "2025-11-18T00:00:00.000000Z",
        "user": {
          "id": 1,
          "name": "Cliente",
          "email": "cliente@example.com"
        },
        "items": [...]
      }
    ],
    "per_page": 15,
    "total": 30
  }
}
```

### 3.2 Ver Pedido
**GET** `/orders/{id}`

**Permisos**: 
- Admin/Seller: Ver cualquier pedido
- Customer: Solo su pedido

**Respuesta JSON**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "order_number": "ORD-ABC123",
    "status": "pending",
    "payment_status": "pending",
    "payment_method": "card",
    "subtotal": "179.99",
    "tax": "18.00",
    "shipping_cost": "15.00",
    "total": "212.99",
    "notes": "Entregar en la mañana",
    "user": {...},
    "address": {...},
    "items": [
      {
        "id": 1,
        "quantity": 2,
        "price": "89.99",
        "product": {
          "id": 1,
          "name": "Producto",
          "sku": "SKU-001"
        }
      }
    ]
  }
}
```

### 3.3 Actualizar Pedido
**PUT/PATCH** `/orders/{id}`

**Permisos**: Admin, Seller

**Body (JSON)**:
```json
{
  "status": "pending|processing|shipped|delivered|cancelled",
  "payment_status": "pending|paid|failed|refunded",
  "notes": "string (optional, max:1000)"
}
```

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Pedido actualizado correctamente",
  "data": {...}
}
```

### 3.4 Cancelar Pedido
**POST** `/orders/{id}/cancel`

**Permisos**: 
- Admin/Seller: Cancelar cualquier pedido
- Customer: Solo sus pedidos (pending/processing)

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Pedido cancelado correctamente",
  "data": {...}
}
```

### 3.5 Eliminar Pedido
**DELETE** `/orders/{id}`

**Permisos**: Admin

**Restricción**: Solo pedidos cancelados

**Respuesta JSON**:
```json
{
  "success": true,
  "message": "Pedido eliminado correctamente"
}
```

---

## Códigos de Error HTTP

- **200**: OK - Solicitud exitosa
- **201**: Created - Recurso creado exitosamente
- **400**: Bad Request - Solicitud inválida
- **401**: Unauthorized - No autenticado
- **403**: Forbidden - No autorizado (sin permisos)
- **404**: Not Found - Recurso no encontrado
- **422**: Unprocessable Entity - Errores de validación
- **500**: Internal Server Error - Error del servidor

---

## Validaciones Comunes

### Productos
- **name**: Obligatorio, máximo 255 caracteres
- **sku**: Obligatorio, único, máximo 100 caracteres
- **price**: Obligatorio, numérico, mínimo 0
- **sale_price**: Opcional, debe ser menor que price
- **stock_quantity**: Obligatorio, entero, mínimo 0
- **category_id**: Obligatorio, debe existir en categorías
- **images**: Opcional, formato jpeg/png/jpg/gif/webp, máximo 2MB

### Usuarios
- **email**: Obligatorio, formato email válido, único
- **password**: Obligatorio (crear), mínimo 8 caracteres, confirmación
- **role**: Obligatorio, valores: customer, seller, admin

### Pedidos
- **status**: Obligatorio, valores: pending, processing, shipped, delivered, cancelled
- **payment_status**: Obligatorio, valores: pending, paid, failed, refunded

---

## Relaciones Eloquent Implementadas

### User (Usuario)
- `hasMany(Address)` - Direcciones
- `hasMany(Order)` - Pedidos
- `hasOne(Store)` - Tienda (si es seller)
- `hasMany(Product)` - Productos (si es seller)

### Product (Producto)
- `belongsTo(Category)` - Categoría
- `belongsTo(User)` - Vendedor
- `belongsTo(Store)` - Tienda

### Order (Pedido)
- `belongsTo(User)` - Cliente
- `belongsTo(Address)` - Dirección de envío
- `hasMany(OrderItem)` - Items del pedido

### OrderItem
- `belongsTo(Order)` - Pedido
- `belongsTo(Product)` - Producto

---

## Middleware Implementado

### CheckRole
**Uso**: `middleware('role:admin,seller')`

Verifica que el usuario autenticado tenga uno de los roles especificados.

**Ejemplos**:
```php
// Solo admin
Route::get('/admin', [Controller::class, 'index'])->middleware('role:admin');

// Admin o Seller
Route::get('/dashboard', [Controller::class, 'index'])->middleware('role:admin,seller');

// Customer, Seller o Admin
Route::get('/profile', [Controller::class, 'index'])->middleware('role:customer,seller,admin');
```

---

## Notas Adicionales

1. Todas las respuestas JSON siguen el formato estándar:
   - `success`: boolean
   - `message`: string (en caso de error o acción)
   - `data`: object|array (datos del recurso)

2. Los errores de validación (422) incluyen detalles por campo:
   ```json
   {
     "message": "Error de validación",
     "errors": {
       "email": ["El correo electrónico ya está registrado."],
       "password": ["La contraseña debe tener al menos 8 caracteres."]
     }
   }
   ```

3. Todas las fechas están en formato ISO 8601 UTC

4. Las imágenes se almacenan en `storage/app/public/products`

5. Los soft deletes permiten recuperar registros eliminados

---

**Fecha de Creación**: 18 Noviembre 2025  
**Sprint**: Sprint 2 - CRUD y Validaciones  
**Responsable**: Emiliano Ledesma (Scrum Master)
