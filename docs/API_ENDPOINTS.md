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
