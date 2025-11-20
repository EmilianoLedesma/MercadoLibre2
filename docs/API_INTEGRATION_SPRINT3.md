# API Integration Guide - Sprint 3

## Resumen de Implementación

Este documento describe la integración completa API-Frontend implementada en Sprint 3.

## 🎯 Objetivos Cumplidos

### 1. Integración API con Frontend ✅
- Cliente API completo en `resources/js/api.js`
- Servicios para autenticación, productos y categorías
- Manejo automático de tokens JWT
- Refresh automático de tokens expirados
- Interceptores de axios para headers y errores

### 2. Endpoints API Implementados ✅

#### Autenticación (ya existía)
- `POST /api/auth/register` - Registro
- `POST /api/auth/login` - Login
- `POST /api/auth/logout` - Logout
- `POST /api/auth/refresh` - Refrescar token
- `GET /api/auth/me` - Usuario autenticado

#### Productos (nuevo)
- `GET /api/products` - Listar con filtros
- `GET /api/products/{id}` - Ver producto
- `POST /api/products` - Crear (admin/seller)
- `PUT /api/products/{id}` - Actualizar (admin/seller)
- `DELETE /api/products/{id}` - Eliminar (admin/seller)

#### Categorías (nuevo)
- `GET /api/categories` - Listar
- `GET /api/categories/{id}` - Ver categoría
- `POST /api/categories` - Crear (admin)
- `PUT /api/categories/{id}` - Actualizar (admin)
- `DELETE /api/categories/{id}` - Eliminar (admin)

### 3. Filtros Implementados ✅

Los endpoints de productos soportan los siguientes filtros:

```javascript
// Ejemplo de uso
const params = {
  category_id: 1,           // Filtrar por categoría
  is_active: true,          // Solo productos activos
  is_featured: true,        // Solo destacados
  min_price: 10.00,         // Precio mínimo
  max_price: 100.00,        // Precio máximo
  search: 'laptop',         // Búsqueda en nombre/descripción/SKU
  sort_by: 'price',         // Ordenar por campo
  sort_order: 'asc',        // Orden ascendente/descendente
  per_page: 15,             // Resultados por página
  page: 1                   // Página actual
};

await productService.getAll(params);
```

### 4. Middleware de Autorización ✅

#### JwtMiddleware (ya existía)
- Valida token JWT
- Verifica usuario activo
- Maneja errores de token

#### RoleMiddleware (nuevo)
- Valida roles de usuario (admin, seller, customer)
- Protege endpoints por nivel de acceso
- Respuestas claras de autorización

### 5. Respuestas JSON Estandarizadas ✅

Todas las respuestas siguen el formato:

```json
{
  "success": true,
  "message": "Mensaje descriptivo",
  "data": {
    // datos de respuesta
  }
}
```

## 📚 Uso del Cliente API

### Instalación

El cliente ya está incluido en `resources/js/api.js`. Para usarlo:

```javascript
import { authService, productService, categoryService, handleApiError } from './api.js';
```

### Ejemplos de Uso

#### Autenticación

```javascript
// Login
try {
  const response = await authService.login({
    email: 'admin@mercadolibre.com',
    password: 'admin123'
  });
  
  console.log('Usuario:', response.data.user);
  console.log('Token:', response.data.access_token);
} catch (error) {
  const errorInfo = handleApiError(error);
  console.error(errorInfo.message);
}

// Obtener usuario autenticado
const userData = await authService.me();

// Logout
await authService.logout();
```

#### Productos

```javascript
// Listar productos
const products = await productService.getAll({
  category_id: 1,
  is_active: true,
  per_page: 20
});

// Ver producto
const product = await productService.getById(1);

// Crear producto (requiere admin/seller)
const newProduct = await productService.create({
  name: 'Laptop Gaming',
  sku: 'LAP-001',
  price: 999.99,
  stock_quantity: 10,
  category_id: 1,
  is_active: true
});

// Actualizar producto
const updated = await productService.update(1, {
  price: 899.99,
  stock_quantity: 8
});

// Eliminar producto
await productService.delete(1);
```

#### Categorías

```javascript
// Listar categorías
const categories = await categoryService.getAll();

// Ver categoría con productos
const category = await categoryService.getById(1);

// Crear categoría (requiere admin)
const newCategory = await categoryService.create({
  name: 'Electrónicos',
  description: 'Productos electrónicos'
});
```

## 🔒 Seguridad

### Roles de Usuario

- **admin**: Acceso completo a todos los endpoints
- **seller**: Puede crear y modificar productos
- **customer**: Solo lectura de productos y categorías

### Protección de Rutas

```php
// Productos - Solo admin/seller pueden crear/editar
Route::middleware(['auth:api', 'role:admin,seller'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
});

// Categorías - Solo admin
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/categories', [CategoryController::class, 'store']);
});
```

## 🧪 Testing

### Tests Implementados

1. **AuthApiTest** - Tests de autenticación
   - Registro de usuario
   - Login exitoso/fallido
   - Obtener perfil
   - Logout
   - Usuario inactivo
   - Acceso sin token

2. **ProductApiTest** - Tests de productos
   - Listar productos
   - Ver producto específico
   - Filtrar por categoría
   - Crear producto (admin/seller)
   - Permisos de customer
   - Actualizar producto
   - Eliminar producto
   - Búsqueda

### Ejecutar Tests

```bash
php artisan test --filter=Api
```

## 📊 Criterios de Aceptación Sprint 3

- ✅ API conectada exitosamente con frontend
- ✅ Respuestas JSON limpias y estandarizadas
- ✅ Seguridad y roles verificados
- ✅ Integración sin errores críticos

## 🎓 Asignaciones Completadas

- ✅ **Artemio Hurtado**: Supervisión API-Frontend, ajuste respuestas
- ✅ **Ricardo Méndez**: Endpoints con filtros implementados
- ✅ **Joaquín Moreno**: Autenticación y middleware de roles
- ✅ **Abraham Velázquez**: Tests de integración

## 📝 Próximos Pasos (Futuro)

1. Implementar endpoints de órdenes
2. Agregar más filtros avanzados
3. Implementar paginación en categorías
4. Agregar rate limiting
5. Implementar caching de respuestas
6. Tests de rendimiento
7. Documentación en Swagger/OpenAPI

## 🐛 Debugging

Si encuentras problemas:

1. Verifica que el token JWT esté en localStorage
2. Revisa la consola del navegador para errores
3. Usa Network tab para ver requests/responses
4. Verifica permisos de usuario
5. Consulta logs de Laravel: `php artisan pail`

## 📞 Soporte

Para reportar bugs o solicitar funcionalidades:
- Crear issue en el repositorio
- Contactar al equipo de desarrollo
