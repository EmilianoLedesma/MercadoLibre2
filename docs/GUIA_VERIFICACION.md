# Guía de Verificación - Sprint 2

## Requisitos Previos

1. Servidor Laravel corriendo: `php artisan serve`
2. Base de datos configurada y migrada
3. Al menos un usuario admin en la BD

---

## Paso 1: Crear Usuario Admin (Si no existe)

### Opción A: Via Tinker
```bash
php artisan tinker
```

```php
$admin = new App\Models\User();
$admin->name = 'Admin';
$admin->email = 'admin@test.com';
$admin->password = bcrypt('password123');
$admin->role = 'admin';
$admin->is_active = true;
$admin->save();
exit
```

### Opción B: Via Seeder
Crear archivo `database/seeders/AdminSeeder.php`:
```php
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
```

Ejecutar:
```bash
php artisan db:seed --class=AdminSeeder
```

---

## Paso 2: Verificar Archivos Creados

### Verificar FormRequests
```powershell
Get-ChildItem "app\Http\Requests" | Select-Object Name
```

**Esperado**:
- StoreProductRequest.php
- UpdateProductRequest.php
- StoreUserRequest.php
- UpdateUserRequest.php
- UpdateOrderRequest.php

### Verificar Controllers
```powershell
Get-ChildItem "app\Http\Controllers" | Where-Object { $_.Name -match "User|Order" } | Select-Object Name
```

**Esperado**:
- UserController.php
- OrderController.php

### Verificar Middleware
```powershell
Get-ChildItem "app\Http\Middleware" | Select-Object Name
```

**Esperado**:
- CheckRole.php

### Verificar Documentación
```powershell
Get-ChildItem "docs" | Select-Object Name
```

**Esperado**:
- API_ENDPOINTS.md
- SPRINT2_COMPLETADO.md

---

## Paso 3: Verificar Rutas

```bash
php artisan route:list --name=products
php artisan route:list --name=users
php artisan route:list --name=orders
```

**Rutas esperadas**:

### Productos
```
GET    /products
GET    /products/create
POST   /products
GET    /products/{product}
GET    /products/{product}/edit
PUT    /products/{product}
DELETE /products/{product}
```

### Usuarios
```
GET    /users
GET    /users/create
POST   /users
GET    /users/{user}
GET    /users/{user}/edit
PUT    /users/{user}
DELETE /users/{user}
```

### Pedidos
```
GET    /orders
GET    /orders/{order}
GET    /orders/{order}/edit
PUT    /orders/{order}
DELETE /orders/{order}
POST   /orders/{order}/cancel
```

---

## Paso 4: Pruebas con Navegador Web

### 4.1 Login como Admin
1. Ir a: `http://localhost:8000/login`
2. Email: `admin@test.com`
3. Password: `password123`

### 4.2 CRUD Productos
1. **Listar**: `http://localhost:8000/products`
2. **Crear**: `http://localhost:8000/products/create`
   - Llenar formulario
   - Verificar validaciones funcionan
3. **Ver**: Click en un producto
4. **Editar**: Click en "Editar"
5. **Eliminar**: Click en "Eliminar"

### 4.3 CRUD Usuarios (requiere admin)
1. **Listar**: `http://localhost:8000/users`
2. **Crear**: `http://localhost:8000/users/create`
   - Llenar formulario
   - Verificar validación de email único
   - Verificar validación de password
3. **Ver**: Click en un usuario
4. **Editar**: Click en "Editar"
5. **Eliminar**: Click en "Eliminar"

### 4.4 CRUD Pedidos
1. **Listar**: `http://localhost:8000/orders`
2. **Ver**: Click en un pedido (si hay)
3. **Editar**: Click en "Editar" (solo admin/seller)
4. **Cancelar**: Botón "Cancelar pedido"

---

## Paso 5: Pruebas con PowerShell (API JSON)

### 5.1 Verificar Productos (JSON)

```powershell
# Listar productos
Invoke-RestMethod -Uri "http://localhost:8000/products" -Headers @{ "Accept" = "application/json" } -Method Get | ConvertTo-Json -Depth 5

# Ver producto específico
Invoke-RestMethod -Uri "http://localhost:8000/products/1" -Headers @{ "Accept" = "application/json" } -Method Get | ConvertTo-Json -Depth 5
```

### 5.2 Crear Producto (JSON)

Primero necesitas obtener un token CSRF y cookies de sesión. Para pruebas simples, usa el navegador o Postman.

**Con Postman**:
1. Hacer login en `POST http://localhost:8000/login`
2. Copiar cookies de sesión
3. Crear producto:

```
POST http://localhost:8000/products
Headers:
  Accept: application/json
  Content-Type: multipart/form-data
  Cookie: laravel_session=...

Body (form-data):
  name: Producto de Prueba
  description: Descripción completa del producto
  sku: TEST-001
  price: 99.99
  stock_quantity: 10
  category_id: 1
```

### 5.3 Verificar Validaciones (JSON)

**Enviar datos inválidos**:
```
POST http://localhost:8000/products
Headers:
  Accept: application/json
Body:
  name: "" (vacío)
  sku: "" (vacío)
  price: -10 (negativo)
```

**Respuesta esperada (422)**:
```json
{
  "message": "El nombre del producto es obligatorio.",
  "errors": {
    "name": ["El nombre del producto es obligatorio."],
    "sku": ["El SKU es obligatorio."],
    "price": ["El precio debe ser mayor o igual a 0."]
  }
}
```

---

## Paso 6: Verificar Middleware de Roles

### 6.1 Intentar acceder a /users sin autenticación

```powershell
Invoke-WebRequest -Uri "http://localhost:8000/users" -Method Get
```

**Esperado**: Redirección a login (302) o error 401 si se pide JSON

### 6.2 Intentar acceder a /users como customer

1. Logout del admin
2. Login como customer
3. Ir a `http://localhost:8000/users`

**Esperado**: Error 403 Forbidden

### 6.3 Acceder a /users como admin

1. Login como admin
2. Ir a `http://localhost:8000/users`

**Esperado**: Lista de usuarios

---

## Paso 7: Verificar Manejo de Errores JSON

### 7.1 Error 404 (Not Found)
```powershell
Invoke-RestMethod -Uri "http://localhost:8000/products/99999" -Headers @{ "Accept" = "application/json" } -Method Get
```

**Esperado**: Error 404

### 7.2 Error 403 (Forbidden)
```powershell
# Sin autenticación
Invoke-RestMethod -Uri "http://localhost:8000/users" -Headers @{ "Accept" = "application/json" } -Method Get
```

**Esperado**: Error 401 o 403

### 7.3 Error 422 (Validation)
Ver paso 5.3

---

## Paso 8: Verificar Relaciones Eloquent

### 8.1 Usuario con relaciones
```powershell
Invoke-RestMethod -Uri "http://localhost:8000/users/1" -Headers @{ "Accept" = "application/json" } -Method Get | ConvertTo-Json -Depth 10
```

**Esperado**: Usuario con addresses, orders, products, store

### 8.2 Producto con relaciones
```powershell
Invoke-RestMethod -Uri "http://localhost:8000/products/1" -Headers @{ "Accept" = "application/json" } -Method Get | ConvertTo-Json -Depth 5
```

**Esperado**: Producto con category, user

### 8.3 Pedido con relaciones
```powershell
Invoke-RestMethod -Uri "http://localhost:8000/orders/1" -Headers @{ "Accept" = "application/json" } -Method Get | ConvertTo-Json -Depth 10
```

**Esperado**: Pedido con user, address, items (con products)

---

## Paso 9: Verificar Funcionalidades Especiales

### 9.1 Cancelar Pedido

**Requisitos**:
- Tener un pedido con status "pending" o "processing"
- Estar autenticado como propietario, admin o seller

```
POST http://localhost:8000/orders/{id}/cancel
Headers:
  Accept: application/json
```

**Verificar**:
1. Status cambia a "cancelled"
2. Payment status cambia a "refunded"
3. Stock de productos se restaura

### 9.2 Soft Delete de Usuario

```
DELETE http://localhost:8000/users/{id}
Headers:
  Accept: application/json
```

**Verificar en BD**:
```sql
SELECT id, name, email, deleted_at FROM users WHERE id = {id};
```

El campo `deleted_at` debe tener fecha.

### 9.3 Filtros y Búsqueda

**Usuarios por rol**:
```
GET http://localhost:8000/users?role=customer
```

**Pedidos por estado**:
```
GET http://localhost:8000/orders?status=pending
```

**Búsqueda de usuarios**:
```
GET http://localhost:8000/users?search=admin
```

---

## Paso 10: Checklist Final

### Archivos Creados
- [ ] 5 FormRequest classes
- [ ] UserController.php
- [ ] OrderController.php
- [ ] CheckRole.php middleware
- [ ] API_ENDPOINTS.md
- [ ] SPRINT2_COMPLETADO.md

### Rutas Registradas
- [ ] 7 rutas de productos
- [ ] 7 rutas de usuarios (con middleware role:admin)
- [ ] 6 rutas de pedidos (con middleware auth)

### Validaciones
- [ ] FormRequests funcionan en todos los controllers
- [ ] Mensajes de error en español
- [ ] Validaciones personalizadas (ej: sale_price < price)

### Middleware
- [ ] CheckRole registrado en bootstrap/app.php
- [ ] Rutas protegidas con middleware role
- [ ] Respuestas JSON cuando se pide Accept: application/json

### JSON Support
- [ ] ProductController retorna JSON
- [ ] UserController retorna JSON
- [ ] OrderController retorna JSON
- [ ] Errores retornan JSON apropiado

### Relaciones
- [ ] User → addresses, orders, products, store
- [ ] Product → category, user, store
- [ ] Order → user, address, items

### Funcionalidades
- [ ] CRUD completo de productos
- [ ] CRUD completo de usuarios
- [ ] CRUD completo de pedidos
- [ ] Cancelación de pedidos con restauración de stock
- [ ] Soft delete de usuarios
- [ ] Filtros y búsqueda

---

## Comandos Útiles de Verificación

### Ver todas las rutas
```bash
php artisan route:list
```

### Ver rutas específicas
```bash
php artisan route:list --name=products
php artisan route:list --name=users
php artisan route:list --name=orders
```

### Verificar middleware registrado
```bash
php artisan route:list --columns=uri,name,middleware
```

### Limpiar caché
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### Ver logs de errores
```bash
Get-Content storage\logs\laravel.log -Tail 50
```

---

## Solución de Problemas Comunes

### Error: Class CheckRole not found
**Solución**:
```bash
composer dump-autoload
php artisan config:clear
```

### Error: Route not found
**Solución**:
```bash
php artisan route:clear
php artisan route:cache
```

### Error: Validation messages not showing
**Verificar**:
1. FormRequest está siendo usado en el controller
2. `rules()` retorna array correcto
3. `messages()` retorna mensajes personalizados

### Error: Middleware not working
**Verificar**:
1. Middleware registrado en `bootstrap/app.php`
2. Alias correcto en las rutas
3. Usuario tiene rol correcto en BD

---

## Reporte de Pruebas

Documentar resultados en este formato:

```
FECHA: 18 Nov 2025
RESPONSABLE: [Tu nombre]

PRODUCTOS:
✅ GET /products - OK
✅ POST /products - OK, validaciones funcionan
✅ GET /products/{id} - OK, relaciones cargadas
✅ PUT /products/{id} - OK
✅ DELETE /products/{id} - OK

USUARIOS:
✅ GET /users - OK (solo admin)
✅ POST /users - OK, validaciones funcionan
⚠️ GET /users/{id} - Lento (optimizar consulta)
✅ PUT /users/{id} - OK
✅ DELETE /users/{id} - OK, soft delete funciona

PEDIDOS:
✅ GET /orders - OK, filtros funcionan
✅ GET /orders/{id} - OK, items cargados
✅ PUT /orders/{id} - OK (solo admin/seller)
✅ POST /orders/{id}/cancel - OK, stock restaurado
✅ DELETE /orders/{id} - OK (solo cancelados)

MIDDLEWARE:
✅ CheckRole funciona correctamente
✅ Bloquea acceso no autorizado
✅ Permite múltiples roles

JSON:
✅ Respuestas JSON correctas
✅ Códigos HTTP apropiados
✅ Errores bien formateados

ISSUES ENCONTRADOS:
- [Describir cualquier problema]

RECOMENDACIONES:
- [Sugerencias de mejora]
```

---

**Preparado por**: Emiliano Ledesma  
**Fecha**: 18 Noviembre 2025  
**Sprint**: Sprint 2 - CRUD y Validaciones
