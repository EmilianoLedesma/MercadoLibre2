# Guía Completa para Probar la API - Sprint 3

## Índice
1. [Preparación Inicial](#preparación-inicial)
2. [Método 1: Testing en Navegador (HTML)](#método-1-testing-en-navegador-html)
3. [Método 2: Testing con Postman/Thunder Client](#método-2-testing-con-postmanthunder-client)
4. [Método 3: Testing con cURL (Línea de comandos)](#método-3-testing-con-curl-línea-de-comandos)
5. [Método 4: Testing con JavaScript (Consola del navegador)](#método-4-testing-con-javascript-consola-del-navegador)
6. [Solución de Problemas](#solución-de-problemas)

---

## Preparación Inicial

### 1. Verificar que el servidor Laravel esté corriendo

Abre una terminal y ejecuta:

```bash
cd "c:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2"
php artisan serve
```

Deberías ver algo como:
```
INFO  Server running on [http://127.0.0.1:8000]
```

**URL BASE DE TU API:** `http://localhost:8000/api`

### 2. Verificar que la base de datos esté activa

Ejecuta las migraciones si no lo has hecho:

```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
```

---

## Método 1: Testing en Navegador (HTML)

### Paso 1: Abre el archivo de prueba

He creado un archivo llamado `api-test.html` en la carpeta `public/`.

1. Asegúrate de que el servidor esté corriendo (`php artisan serve`)
2. Abre en tu navegador: `http://localhost:8000/api-test.html`
3. Usa la interfaz para probar todos los endpoints

### Funcionalidades del HTML:
- Login con usuarios predefinidos
- Ver productos y categorías
- Crear/editar/eliminar (si eres admin o seller)
- Ver respuestas en formato JSON

---

## Método 2: Testing con Postman/Thunder Client

### Instalar Thunder Client en VS Code

1. Abre VS Code
2. Ve a Extensions (Ctrl+Shift+X)
3. Busca "Thunder Client"
4. Instala la extensión

### Importar colección

He creado un archivo `thunder-collection.json` con todas las peticiones listas.

1. Abre Thunder Client en VS Code
2. Click en "Collections"
3. Click en "..." → "Import"
4. Selecciona el archivo `thunder-collection.json`

### Usar Postman

Si prefieres Postman, importa el mismo archivo JSON.

---

## Método 3: Testing con cURL (Línea de comandos)

### A. Health Check (Verificar que la API funciona)

```bash
curl -X GET http://localhost:8000/api/health
```

Respuesta esperada:
```json
{
  "success": true,
  "message": "API funcionando correctamente",
  "version": "1.0.0",
  "timestamp": "2025-11-26T..."
}
```

### B. Login (Obtener token)

```bash
curl -X POST http://localhost:8000/api/auth/login ^
  -H "Content-Type: application/json" ^
  -H "Accept: application/json" ^
  -d "{\"email\":\"admin@mercadolibre.com\",\"password\":\"admin123\"}"
```

**IMPORTANTE:** Guarda el `access_token` que te devuelve. Lo necesitarás para las siguientes peticiones.

Ejemplo de respuesta:
```json
{
  "success": true,
  "message": "Inicio de sesión exitoso",
  "data": {
    "user": {...},
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer",
    "expires_in": 3600
  }
}
```

### C. Listar Productos (con token)

Reemplaza `TU_TOKEN_AQUI` con el token que obtuviste del login:

```bash
curl -X GET "http://localhost:8000/api/products" ^
  -H "Authorization: Bearer TU_TOKEN_AQUI" ^
  -H "Accept: application/json"
```

### D. Listar Productos con Filtros

```bash
curl -X GET "http://localhost:8000/api/products?category_id=1&is_active=true&per_page=10" ^
  -H "Authorization: Bearer TU_TOKEN_AQUI" ^
  -H "Accept: application/json"
```

### E. Ver un Producto Específico

```bash
curl -X GET "http://localhost:8000/api/products/1" ^
  -H "Authorization: Bearer TU_TOKEN_AQUI" ^
  -H "Accept: application/json"
```

### F. Crear un Producto (requiere admin o seller)

```bash
curl -X POST http://localhost:8000/api/products ^
  -H "Authorization: Bearer TU_TOKEN_AQUI" ^
  -H "Content-Type: application/json" ^
  -H "Accept: application/json" ^
  -d "{\"name\":\"Producto de Prueba\",\"sku\":\"TEST-001\",\"price\":99.99,\"stock_quantity\":10,\"category_id\":1,\"is_active\":true}"
```

### G. Listar Categorías

```bash
curl -X GET "http://localhost:8000/api/categories" ^
  -H "Authorization: Bearer TU_TOKEN_AQUI" ^
  -H "Accept: application/json"
```

---

## Método 4: Testing con JavaScript (Consola del navegador)

### Paso 1: Abre la consola del navegador

1. Abre tu navegador
2. Presiona F12
3. Ve a la pestaña "Console"

### Paso 2: Copia y pega este código

```javascript
// Configuración base
const API_URL = 'http://localhost:8000/api';
let token = null;

// Función auxiliar para hacer peticiones
async function apiRequest(endpoint, method = 'GET', body = null) {
  const options = {
    method,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    }
  };

  if (token) {
    options.headers.Authorization = `Bearer ${token}`;
  }

  if (body) {
    options.body = JSON.stringify(body);
  }

  const response = await fetch(`${API_URL}${endpoint}`, options);
  const data = await response.json();
  console.log(data);
  return data;
}

// 1. Verificar API
console.log('🔍 Verificando API...');
await apiRequest('/health');

// 2. Login
console.log('🔐 Haciendo login...');
const loginResult = await apiRequest('/auth/login', 'POST', {
  email: 'admin@mercadolibre.com',
  password: 'admin123'
});

if (loginResult.success) {
  token = loginResult.data.access_token;
  console.log('✅ Login exitoso! Token guardado.');
  console.log('Usuario:', loginResult.data.user);
}

// 3. Ver productos
console.log('📦 Obteniendo productos...');
await apiRequest('/products');

// 4. Ver categorías
console.log('📁 Obteniendo categorías...');
await apiRequest('/categories');

// 5. Ver mi perfil
console.log('👤 Obteniendo mi perfil...');
await apiRequest('/auth/me');
```

### Paso 3: Crear un producto (si eres admin o seller)

```javascript
const nuevoProducto = await apiRequest('/products', 'POST', {
  name: 'Laptop de Prueba',
  sku: 'LAP-TEST-001',
  price: 1299.99,
  stock_quantity: 5,
  category_id: 1,
  is_active: true,
  is_featured: false
});

console.log('Producto creado:', nuevoProducto);
```

---

## URLs Rápidas para Probar

### Endpoints Públicos (no requieren autenticación)
- ✅ Health Check: `http://localhost:8000/api/health`
- 🔐 Login: `http://localhost:8000/api/auth/login` (POST)
- 📝 Registro: `http://localhost:8000/api/auth/register` (POST)

### Endpoints Protegidos (requieren token JWT)

#### Autenticación
- 👤 Mi perfil: `http://localhost:8000/api/auth/me` (GET)
- 🚪 Logout: `http://localhost:8000/api/auth/logout` (POST)
- 🔄 Refresh token: `http://localhost:8000/api/auth/refresh` (POST)

#### Productos (lectura = todos, escritura = admin/seller)
- 📦 Listar: `http://localhost:8000/api/products` (GET)
- 🔍 Ver uno: `http://localhost:8000/api/products/1` (GET)
- ➕ Crear: `http://localhost:8000/api/products` (POST)
- ✏️ Editar: `http://localhost:8000/api/products/1` (PUT)
- 🗑️ Eliminar: `http://localhost:8000/api/products/1` (DELETE)

#### Categorías (lectura = todos, escritura = solo admin)
- 📁 Listar: `http://localhost:8000/api/categories` (GET)
- 🔍 Ver una: `http://localhost:8000/api/categories/1` (GET)
- ➕ Crear: `http://localhost:8000/api/categories` (POST)
- ✏️ Editar: `http://localhost:8000/api/categories/1` (PUT)
- 🗑️ Eliminar: `http://localhost:8000/api/categories/1` (DELETE)

---

## Usuarios de Prueba

Después de ejecutar `php artisan db:seed`, tendrás estos usuarios:

| Email | Password | Rol | Permisos |
|-------|----------|-----|----------|
| admin@mercadolibre.com | admin123 | admin | Todos los endpoints |
| seller@mercadolibre.com | seller123 | seller | Crear/editar productos |
| customer@mercadolibre.com | customer123 | customer | Solo lectura |

---

## Filtros Disponibles para Productos

```
GET /api/products?parametros

Parámetros:
- category_id=1           // Filtrar por categoría
- is_active=true          // Solo productos activos
- is_featured=true        // Solo destacados
- min_price=10.00         // Precio mínimo
- max_price=100.00        // Precio máximo
- search=laptop           // Buscar en nombre/descripción/SKU
- sort_by=price           // Ordenar por: name, price, created_at
- sort_order=asc          // asc o desc
- per_page=20             // Resultados por página
- page=1                  // Número de página
```

**Ejemplos:**
```
/api/products?category_id=1&is_active=true
/api/products?min_price=100&max_price=500&sort_by=price&sort_order=asc
/api/products?search=laptop&per_page=10
```

---

## Solución de Problemas

### Error: "Target class [RoleMiddleware] does not exist"

Ejecuta:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### Error: "Token not provided" o "Token inválido"

1. Verifica que estés incluyendo el header: `Authorization: Bearer TU_TOKEN`
2. Verifica que el token no haya expirado (duración: 60 minutos)
3. Haz login nuevamente para obtener un token fresco

### Error: "Unauthorized" en endpoints de productos/categorías

1. Verifica tu rol de usuario
2. Admin puede hacer todo
3. Seller puede crear/editar productos
4. Customer solo puede leer

### Error de CORS

Si estás haciendo peticiones desde otro dominio, añade esto en `config/cors.php`:

```php
'paths' => ['api/*'],
'allowed_origins' => ['*'],
```

### El servidor no responde

1. Verifica que `php artisan serve` esté corriendo
2. Verifica la URL: `http://localhost:8000/api/`
3. Revisa los logs: `php artisan pail` (en otra terminal)

### Error de base de datos

```bash
php artisan migrate:fresh --seed
```

---

## Próximos Pasos

1. ✅ Prueba el endpoint de health check
2. ✅ Haz login con un usuario
3. ✅ Lista productos y categorías
4. ✅ Intenta crear un producto (con admin o seller)
5. ✅ Prueba los filtros
6. ✅ Integra con tu frontend usando `resources/js/api.js`

---

## Recursos Adicionales

- [Documentación completa de endpoints](API_ENDPOINTS.md)
- [Guía de integración Sprint 3](API_INTEGRATION_SPRINT3.md)
- [Configuración JWT](JWT_SETUP.md)

---

**Última actualización:** Sprint 3 - 26 Nov 2025
**Autor:** Equipo MercadoLibre2 - UPQ Sistemas
