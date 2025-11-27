# Demo Sprint 3 - Guía Rápida

## 🎯 Objetivo del Sprint 3

Demostrar que la API está completamente integrada y funcionando:

1. ✅ **Integrar API con frontend** (axios/fetch)
2. ✅ **Probar endpoints y ajustar respuestas JSON**
3. ✅ **Implementar middleware de autorización**

---

## 🚀 Inicio Rápido (3 opciones)

### Opción 1: Demo Automática (RECOMENDADO)

**Windows PowerShell:**
```powershell
.\INICIAR_DEMO.ps1
```

**Windows CMD:**
```cmd
DEMO_SPRINT3.bat
```

Esto hará:
- ✓ Verificar/iniciar servidor Laravel
- ✓ Probar todos los endpoints automáticamente
- ✓ Generar evidencia del Sprint 3
- ✓ Abrir panel web de pruebas
- ✓ Mostrar el token JWT

---

### Opción 2: Panel Web (Visual)

1. **Inicia el servidor:**
   ```bash
   php artisan serve
   ```

2. **Abre en tu navegador:**
   ```
   http://localhost:8000/api-test.html
   ```

3. **Haz login:**
   - Click en el botón "👑 Admin (Acceso total)"
   - O ingresa: `admin@mercadolibre.com` / `admin123`

4. **¡Listo!** Ya puedes probar todos los endpoints visualmente.

---

### Opción 3: Testing Manual

1. **Inicia el servidor:**
   ```bash
   php artisan serve
   ```

2. **Ejecuta el script de testing:**
   ```powershell
   .\test-api.ps1
   ```

3. **Obtendrás:**
   - ✓ Health check de la API
   - ✓ Login y token JWT
   - ✓ Listado de productos y categorías
   - ✓ Producto de prueba creado
   - ✓ Token para usar en Postman

---

## 📋 Checklist de Demostración

### 1. Integración API con Frontend ✅

**Evidencia:**
- ✓ Cliente API en `resources/js/api.js`
- ✓ Servicios implementados:
  - `authService` - Login, registro, logout
  - `productService` - CRUD de productos
  - `categoryService` - CRUD de categorías
- ✓ Interceptores de axios para manejo automático de tokens
- ✓ Refresh automático de tokens expirados

**Demostrar:**
```javascript
// En el panel web o consola del navegador
import { productService } from './resources/js/api.js';

// Esto funciona porque el token se maneja automáticamente
const products = await productService.getAll({ per_page: 10 });
console.log(products);
```

---

### 2. Endpoints y Respuestas JSON ✅

**Evidencia:**
- ✓ 17 endpoints implementados
- ✓ Formato de respuesta estandarizado:
  ```json
  {
    "success": true,
    "message": "Descripción clara",
    "data": { ... }
  }
  ```
- ✓ Manejo de errores consistente
- ✓ Validaciones en todos los controllers

**Demostrar:**

1. **Health Check:**
   ```
   GET http://localhost:8000/api/health
   ```

2. **Login:**
   ```
   POST http://localhost:8000/api/auth/login
   Body: { "email": "admin@mercadolibre.com", "password": "admin123" }
   ```

3. **Listar productos con filtros:**
   ```
   GET http://localhost:8000/api/products?category_id=1&min_price=10&max_price=500
   ```

4. **Crear producto:**
   ```
   POST http://localhost:8000/api/products
   Headers: Authorization: Bearer {token}
   Body: { "name": "Test", "sku": "T001", "price": 99, "stock_quantity": 10, "category_id": 1 }
   ```

---

### 3. Middleware de Autorización ✅

**Evidencia:**
- ✓ `JwtMiddleware` - Validación de tokens
- ✓ `RoleMiddleware` - Control por roles
- ✓ 3 roles implementados: admin, seller, customer

**Demostrar:**

1. **Sin token → Error 401:**
   ```bash
   curl http://localhost:8000/api/products
   # Respuesta: "Token no proporcionado"
   ```

2. **Con token de customer → Solo lectura:**
   ```bash
   # Login como customer
   # Intentar crear producto → Error 403: "No autorizado"
   ```

3. **Con token de admin → Acceso total:**
   ```bash
   # Login como admin
   # Crear/editar/eliminar productos y categorías → Exitoso
   ```

**Matriz de permisos:**

| Endpoint | Customer | Seller | Admin |
|----------|----------|--------|-------|
| GET /api/products | ✅ | ✅ | ✅ |
| POST /api/products | ❌ | ✅ | ✅ |
| PUT /api/products/{id} | ❌ | ✅ | ✅ |
| DELETE /api/products/{id} | ❌ | ✅ | ✅ |
| POST /api/categories | ❌ | ❌ | ✅ |
| PUT /api/categories/{id} | ❌ | ❌ | ✅ |
| DELETE /api/categories/{id} | ❌ | ❌ | ✅ |

---

## 🎬 Flujo de Demostración Sugerido

### Paso 1: Mostrar Estructura (2 min)
```
📁 Proyecto
├── app/Http/Controllers/Api/
│   ├── AuthController.php       ← JWT auth
│   ├── ProductController.php    ← CRUD + filtros
│   └── CategoryController.php   ← CRUD
├── app/Http/Middleware/
│   ├── JwtMiddleware.php        ← Validación tokens
│   └── RoleMiddleware.php       ← Autorización
├── resources/js/api.js          ← Cliente frontend
└── tests/Feature/Api/           ← Tests
```

### Paso 2: Ejecutar Demo Automática (1 min)
```powershell
.\INICIAR_DEMO.ps1
```
→ Muestra todos los tests pasando

### Paso 3: Panel Web Interactivo (3 min)
1. Abrir `http://localhost:8000/api-test.html`
2. Login como admin
3. Listar productos
4. Aplicar filtros (precio, categoría, búsqueda)
5. Crear un producto nuevo
6. Mostrar respuesta JSON

### Paso 4: Autorización por Roles (2 min)
1. Logout
2. Login como customer
3. Intentar crear producto → Ver error 403
4. Login como admin
5. Crear producto → Exitoso

### Paso 5: Integración Frontend (2 min)
Abrir `resources/js/api.js` y mostrar:
```javascript
// Interceptor automático de tokens
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('access_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Refresh automático si el token expira
apiClient.interceptors.response.use(
  (response) => response,
  async (error) => {
    if (error.response?.status === 401) {
      // Intenta refrescar el token automáticamente
      const { data } = await apiClient.post('/auth/refresh');
      // Reintenta la petición original
      return apiClient(originalRequest);
    }
  }
);
```

---

## 📊 Evidencia Generada

Después de ejecutar `INICIAR_DEMO.ps1`, se genera:

```
📁 evidencia_sprint3/
└── test_results_2025-11-26_14-30-00.txt
```

Contiene:
- ✅ Resultados de todos los tests
- ✅ Token JWT generado
- ✅ Lista de endpoints probados
- ✅ Confirmación de requisitos cumplidos

---

## 👥 Usuarios de Prueba

| Email | Password | Rol | Para demostrar |
|-------|----------|-----|----------------|
| admin@mercadolibre.com | admin123 | admin | Acceso completo a todo |
| seller@mercadolibre.com | seller123 | seller | Crear productos (no categorías) |
| customer@mercadolibre.com | customer123 | customer | Solo lectura (sin permisos de escritura) |

---

## 🔗 URLs Importantes

- **Panel de pruebas:** http://localhost:8000/api-test.html
- **Health check:** http://localhost:8000/api/health
- **API base:** http://localhost:8000/api

---

## 📚 Documentación Completa

- [Guía de Testing](docs/GUIA_TESTING_API.md) - Cómo probar la API (4 métodos)
- [API Endpoints](docs/API_ENDPOINTS.md) - Documentación de todos los endpoints
- [Integración Sprint 3](docs/API_INTEGRATION_SPRINT3.md) - Guía de integración
- [Obtener Token JWT](COMO_OBTENER_TOKEN_JWT.md) - Tutorial de autenticación

---

## 🐛 Solución de Problemas

### Error: "Servidor no disponible"
```bash
# Inicia el servidor manualmente
php artisan serve
```

### Error: "Token no proporcionado"
```bash
# Haz login primero para obtener el token
# O usa el panel web que lo hace automáticamente
```

### Error: "No autorizado" (403)
```bash
# Verifica que estés usando el usuario correcto:
# - Admin: puede hacer TODO
# - Seller: puede crear/editar productos
# - Customer: solo puede leer
```

### Base de datos vacía
```bash
php artisan migrate:fresh --seed
```

---

## ✅ Criterios de Aceptación Sprint 3

| Criterio | Estado | Evidencia |
|----------|--------|-----------|
| API conectada con frontend | ✅ | `resources/js/api.js` + panel web |
| Respuestas JSON estandarizadas | ✅ | Formato `{success, message, data}` |
| Seguridad y roles verificados | ✅ | JwtMiddleware + RoleMiddleware |
| Integración sin errores críticos | ✅ | Tests pasando + demo funcional |

---

## 🎉 Resumen

**Sprint 3 completado al 100%**

- ✅ 17 endpoints implementados
- ✅ 3 middlewares de seguridad
- ✅ Cliente API frontend completo
- ✅ 15 tests de integración
- ✅ Panel web de pruebas
- ✅ Documentación completa
- ✅ Demo automática

**Listo para presentar y para producción.**

---

**Fecha:** 26 Noviembre 2025
**Equipo:** MercadoLibre2 - UPQ Sistemas
**Sprint:** 3 - Integración y Testing
