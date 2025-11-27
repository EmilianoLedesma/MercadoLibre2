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
# API Endpoints Documentation

## Base URL

```
http://localhost:8000/api
```

En producción, reemplazar con la URL de tu servidor.

## Autenticación

La mayoría de los endpoints requieren un token JWT válido. Incluye el token en el header de autorización:

```
Authorization: Bearer {tu_token_jwt}
```

## Respuestas Estandarizadas

Todas las respuestas siguen el mismo formato:

### Respuesta Exitosa

```json
{
  "success": true,
  "message": "Mensaje descriptivo",
  "data": {
    // datos de respuesta
  }
}
```

### Respuesta con Error

```json
{
  "success": false,
  "message": "Descripción del error",
  "errors": {
    // detalles del error (opcional)
  }
}
```

## Endpoints

### 1. Health Check

Verifica que la API está funcionando.

**Endpoint:** `GET /api/health`

**Auth requerida:** No

**Respuesta exitosa:**

```json
{
  "success": true,
  "message": "API funcionando correctamente",
  "version": "1.0.0",
  "timestamp": "2024-11-12T15:30:00.000000Z"
}
```

---

## Autenticación

### 2. Registro de Usuario

Registra un nuevo usuario en el sistema.

**Endpoint:** `POST /api/auth/register`

**Auth requerida:** No

**Body Parameters:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|-----------|-------------|
| name | string | Sí | Nombre completo del usuario |
| email | string | Sí | Email único del usuario |
| password | string | Sí | Contraseña (mínimo 8 caracteres) |
| password_confirmation | string | Sí | Confirmación de contraseña |
| phone | string | No | Número de teléfono |
| role | string | No | Rol del usuario (admin, seller, customer). Default: customer |

**Ejemplo Request:**

```json
{
  "name": "Juan Pérez",
  "email": "juan.perez@ejemplo.com",
  "password": "password123",
  "password_confirmation": "password123",
  "phone": "+54 11 1234-5678",
  "role": "customer"
}
```

**Respuesta exitosa (201):**

```json
{
  "success": true,
  "message": "Usuario registrado exitosamente",
  "data": {
    "user": {
      "id": 1,
      "name": "Juan Pérez",
      "email": "juan.perez@ejemplo.com",
      "phone": "+54 11 1234-5678",
      "role": "customer",
      "is_active": true
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600
  }
}
```

**Posibles Errores:**

- **422 Validation Error:** Datos inválidos o email ya existe
- **500 Server Error:** Error interno del servidor

---

### 3. Login

Inicia sesión y obtiene un token JWT.

**Endpoint:** `POST /api/auth/login`

**Auth requerida:** No

**Body Parameters:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|-----------|-------------|
| email | string | Sí | Email del usuario |
| password | string | Sí | Contraseña del usuario |

**Ejemplo Request:**

```json
{
  "email": "admin@mercadolibre.com",
  "password": "admin123"
}
```

**Respuesta exitosa (200):**

```json
{
  "success": true,
  "message": "Inicio de sesión exitoso",
  "data": {
    "user": {
      "id": 1,
      "name": "Administrador MercadoLibre",
      "email": "admin@mercadolibre.com",
      "phone": "+54 11 1234-5678",
      "role": "admin",
      "is_active": true
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600
  }
}
```

**Posibles Errores:**

- **401 Unauthorized:** Credenciales incorrectas o usuario inactivo
- **422 Validation Error:** Datos de entrada inválidos
- **500 Server Error:** No se pudo crear el token

---

### 4. Obtener Usuario Autenticado

Obtiene la información del usuario actualmente autenticado.

**Endpoint:** `GET /api/auth/me`

**Auth requerida:** Sí

**Headers:**

```
Authorization: Bearer {token}
```

**Respuesta exitosa (200):**

```json
{
  "success": true,
  "message": "Usuario autenticado",
  "data": {
    "id": 1,
    "name": "Administrador MercadoLibre",
    "email": "admin@mercadolibre.com",
    "phone": "+54 11 1234-5678",
    "avatar": null,
    "role": "admin",
    "is_active": true,
    "email_verified_at": "2024-11-12T10:00:00.000000Z",
    "created_at": "2024-11-01T10:00:00.000000Z",
    "updated_at": "2024-11-12T10:00:00.000000Z"
  }
}
```

**Posibles Errores:**

- **401 Unauthorized:** Token inválido, expirado o no proporcionado
- **500 Server Error:** Error al obtener usuario

---

### 5. Cerrar Sesión

Invalida el token JWT actual.

**Endpoint:** `POST /api/auth/logout`

**Auth requerida:** Sí

**Headers:**

```
Authorization: Bearer {token}
```

**Respuesta exitosa (200):**

```json
{
  "success": true,
  "message": "Sesión cerrada exitosamente",
  "data": null
}
```

**Posibles Errores:**

- **401 Unauthorized:** Token inválido o no proporcionado
- **500 Server Error:** Error al cerrar sesión

---

### 6. Refrescar Token

Obtiene un nuevo token JWT invalidando el actual.

**Endpoint:** `POST /api/auth/refresh`

**Auth requerida:** Sí

**Headers:**

```
Authorization: Bearer {token}
```

**Respuesta exitosa (200):**

```json
{
  "success": true,
  "message": "Token refrescado exitosamente",
  "data": {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600
  }
}
```

**Posibles Errores:**

- **401 Unauthorized:** Token inválido o expirado fuera del período de refresh
- **500 Server Error:** No se pudo refrescar el token

---

### 7. Obtener Usuario (Ejemplo Protegido)

Endpoint de ejemplo para mostrar cómo acceder a recursos protegidos.

**Endpoint:** `GET /api/user`

**Auth requerida:** Sí

**Headers:**

```
Authorization: Bearer {token}
```

**Respuesta exitosa (200):**

```json
{
  "success": true,
  "message": "Usuario autenticado",
  "data": {
    "id": 1,
    "name": "Administrador MercadoLibre",
    "email": "admin@mercadolibre.com",
    "phone": "+54 11 1234-5678",
    "avatar": null,
    "role": "admin",
    "is_active": true,
    "email_verified_at": "2024-11-12T10:00:00.000000Z",
    "remember_token": null,
    "created_at": "2024-11-01T10:00:00.000000Z",
    "updated_at": "2024-11-12T10:00:00.000000Z",
    "deleted_at": null
  }
}
```

---

## Códigos de Estado HTTP

| Código | Descripción |
|--------|-------------|
| 200 | OK - Solicitud exitosa |
| 201 | Created - Recurso creado exitosamente |
| 400 | Bad Request - Solicitud mal formada |
| 401 | Unauthorized - No autenticado |
| 403 | Forbidden - No autorizado (usuario inactivo) |
| 404 | Not Found - Recurso no encontrado |
| 422 | Unprocessable Entity - Error de validación |
| 500 | Internal Server Error - Error del servidor |

---

## Errores de Autenticación

### Token Expirado

```json
{
  "success": false,
  "message": "Token expirado",
  "error": "token_expired"
}
```

**Solución:** Usar el endpoint `/api/auth/refresh` para obtener un nuevo token.

### Token Inválido

```json
{
  "success": false,
  "message": "Token inválido",
  "error": "token_invalid"
}
```

**Solución:** Hacer login nuevamente en `/api/auth/login`.

### Token No Proporcionado

```json
{
  "success": false,
  "message": "Token no proporcionado",
  "error": "token_absent"
}
```

**Solución:** Incluir el header `Authorization: Bearer {token}` en la solicitud.

### Usuario No Encontrado

```json
{
  "success": false,
  "message": "Usuario no encontrado"
}
```

### Usuario Inactivo

```json
{
  "success": false,
  "message": "Usuario inactivo. Contacte al administrador."
}
```

---

## Ejemplos de Uso

### JavaScript (Fetch API)

```javascript
// Login
const login = async () => {
  const response = await fetch('http://localhost:8000/api/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      email: 'admin@mercadolibre.com',
      password: 'admin123'
    })
  });
  
  const data = await response.json();
  
  if (data.success) {
    // Guardar token
    localStorage.setItem('token', data.data.access_token);
    console.log('Login exitoso:', data.data.user);
  }
};

// Obtener usuario autenticado
const getMe = async () => {
  const token = localStorage.getItem('token');
  
  const response = await fetch('http://localhost:8000/api/auth/me', {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    }
  });
  
  const data = await response.json();
  console.log('Usuario:', data.data);
};

// Logout
const logout = async () => {
  const token = localStorage.getItem('token');
  
  await fetch('http://localhost:8000/api/auth/logout', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    }
  });
  
  localStorage.removeItem('token');
};
```

### Python (Requests)

```python
import requests

BASE_URL = 'http://localhost:8000/api'

# Login
def login():
    response = requests.post(
        f'{BASE_URL}/auth/login',
        json={
            'email': 'admin@mercadolibre.com',
            'password': 'admin123'
        }
    )
    data = response.json()
    
    if data['success']:
        return data['data']['access_token']
    return None

# Obtener usuario autenticado
def get_me(token):
    response = requests.get(
        f'{BASE_URL}/auth/me',
        headers={'Authorization': f'Bearer {token}'}
    )
    return response.json()

# Uso
token = login()
if token:
    user_data = get_me(token)
    print(user_data)
```

---

## Endpoints Implementados en Sprint 3 ✅

Los siguientes endpoints fueron implementados en Sprint 3 (20-26 Nov 2025):

### Productos ✅

#### GET /api/products
Listar productos con filtros y paginación.

**Auth requerida:** Sí

**Query Parameters:**

| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| category_id | integer | Filtrar por categoría |
| is_active | boolean | Filtrar por estado activo |
| is_featured | boolean | Filtrar por destacados |
| min_price | decimal | Precio mínimo |
| max_price | decimal | Precio máximo |
| search | string | Búsqueda en nombre/descripción/SKU |
| sort_by | string | Campo para ordenar (default: created_at) |
| sort_order | string | Orden: asc/desc (default: desc) |
| per_page | integer | Resultados por página (default: 15) |
| page | integer | Número de página |

**Ejemplo Request:**
```
GET /api/products?category_id=1&is_active=true&min_price=10&max_price=100&search=laptop&per_page=20
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Productos obtenidos exitosamente",
  "data": {
    "products": [...],
    "pagination": {
      "total": 50,
      "per_page": 20,
      "current_page": 1,
      "last_page": 3,
      "from": 1,
      "to": 20
    }
  }
}
```

---

#### GET /api/products/{id}
Ver detalles de un producto específico.

**Auth requerida:** Sí

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Producto obtenido exitosamente",
  "data": {
    "id": 1,
    "name": "Laptop Gaming",
    "slug": "laptop-gaming",
    "sku": "LAP-001",
    "price": 999.99,
    "sale_price": 899.99,
    "stock_quantity": 10,
    "category_id": 1,
    "category": {...},
    "images": [],
    "is_active": true,
    "is_featured": true
  }
}
```

---

#### POST /api/products
Crear un nuevo producto.

**Auth requerida:** Sí (admin o seller)

**Body Parameters:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|-----------|-------------|
| name | string | Sí | Nombre del producto |
| description | string | No | Descripción |
| sku | string | Sí | SKU único |
| price | decimal | Sí | Precio |
| sale_price | decimal | No | Precio de oferta |
| stock_quantity | integer | Sí | Cantidad en stock |
| category_id | integer | Sí | ID de categoría |
| images | array | No | Array de imágenes |
| is_active | boolean | No | Activo (default: true) |
| is_featured | boolean | No | Destacado (default: false) |

**Respuesta exitosa (201):**
```json
{
  "success": true,
  "message": "Producto creado exitosamente",
  "data": {...}
}
```

---

#### PUT /api/products/{id}
Actualizar un producto existente.

**Auth requerida:** Sí (admin o seller)

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Producto actualizado exitosamente",
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
---

#### DELETE /api/products/{id}
Eliminar un producto.

**Auth requerida:** Sí (admin o seller)

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Producto eliminado exitosamente",
  "data": null
}
```

---

### Categorías ✅

#### GET /api/categories
Listar categorías con paginación.

**Auth requerida:** Sí

**Query Parameters:**

| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| is_active | boolean | Filtrar por estado activo |
| search | string | Búsqueda en nombre/descripción |
| sort_by | string | Campo para ordenar (default: name) |
| sort_order | string | Orden: asc/desc (default: asc) |
| per_page | integer | Resultados por página (default: 15) |

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Categorías obtenidas exitosamente",
  "data": {
    "categories": [...],
    "pagination": {...}
  }
}
```

---

#### GET /api/categories/{id}
Ver detalles de una categoría con sus productos.

**Auth requerida:** Sí

---

#### POST /api/categories
Crear una nueva categoría.

**Auth requerida:** Sí (solo admin)

**Body Parameters:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|-----------|-------------|
| name | string | Sí | Nombre único |
| description | string | No | Descripción |
| is_active | boolean | No | Activa (default: true) |

---

#### PUT /api/categories/{id}
Actualizar una categoría.

**Auth requerida:** Sí (solo admin)

---

#### DELETE /api/categories/{id}
Eliminar una categoría (solo si no tiene productos).

**Auth requerida:** Sí (solo admin)

---

## Próximos Endpoints (Por Implementar)

### Órdenes
- `GET /api/orders` - Listar órdenes
- `POST /api/orders` - Crear orden
- `GET /api/orders/{id}` - Ver orden
- `PUT /api/orders/{id}` - Actualizar orden

---

## Notas Importantes

1. **Formato de Fecha:** Todas las fechas están en formato ISO 8601 UTC
2. **Paginación:** Los endpoints de listado incluirán paginación en futuras versiones
3. **Rate Limiting:** Se implementará limitación de peticiones en producción
4. **CORS:** Configurar según necesidades del frontend
5. **Versionado:** Considerar versionado de API (`/api/v1/...`) para futuras versiones

---

## Changelog

- **v1.1.0** (Sprint 3 - 20-26 Nov 2025)
  - ✨ Endpoints de productos completos con filtros avanzados
  - ✨ Endpoints de categorías completos
  - 🔒 Middleware de autorización por roles (admin, seller, customer)
  - 📚 Cliente API JavaScript para integración frontend
  - 🧪 Tests de integración API
  - 📝 Documentación actualizada con ejemplos
  
- **v1.0.0** (Sprint 1 - 12 Nov 2024)
  - Endpoints de autenticación completos
  - Health check endpoint
  - Documentación inicial

---

## Contacto y Soporte

Para reportar problemas o solicitar nuevas funcionalidades:
- Crear un issue en el repositorio
- Contactar al equipo de desarrollo

**Sprint 1 - Responsable JWT:** Joaquín Moreno  
**Sprint 3 - Responsables:**
- Artemio Hurtado (Backend Lead) - API Controllers
- Ricardo Méndez (Analista BD) - Filtros y optimización
- Joaquín Moreno (Seguridad) - Middleware de roles
- Abraham Velázquez (Backend Developer) - Tests
