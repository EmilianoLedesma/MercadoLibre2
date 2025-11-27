# Cómo Obtener y Usar el Token JWT

## ¿Qué es el Token JWT?

El token JWT (JSON Web Token) es como una **llave digital** que te da acceso a la API después de hacer login. Piénsalo como:

- **Sin token** = Puerta cerrada ❌
- **Con token** = Puerta abierta ✅

## 📝 Pasos para Obtener tu Token

### Método 1: Usando el Navegador (MÁS FÁCIL)

1. **Inicia el servidor Laravel:**
   ```bash
   php artisan serve
   ```

2. **Abre el archivo de pruebas en tu navegador:**
   ```
   http://localhost:8000/api-test.html
   ```

3. **Haz click en uno de los botones de login rápido:**
   - 👑 Admin (Acceso total)
   - 🛍️ Seller (Crear productos)
   - 👤 Customer (Solo lectura)

4. **¡Listo!** El token se guardará automáticamente y verás la información del usuario.

El token se guarda en `localStorage` y se usa automáticamente en todas las peticiones.

---

### Método 2: Usando PowerShell (Automático)

1. **Ejecuta el script de testing:**
   ```powershell
   .\test-api.ps1
   ```

2. **El script te mostrará el token al final:**
   ```
   Tu TOKEN JWT (guárdalo para usarlo en Postman/Thunder Client):
   eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg...
   ```

3. **Copia ese token** y úsalo en tus peticiones.

---

### Método 3: Con cURL (Manual)

#### Windows PowerShell:
```powershell
curl -X POST http://localhost:8000/api/auth/login `
  -H "Content-Type: application/json" `
  -H "Accept: application/json" `
  -d '{"email":"admin@mercadolibre.com","password":"admin123"}'
```

#### Windows CMD:
```cmd
curl -X POST http://localhost:8000/api/auth/login ^
  -H "Content-Type: application/json" ^
  -H "Accept: application/json" ^
  -d "{\"email\":\"admin@mercadolibre.com\",\"password\":\"admin123\"}"
```

#### Respuesta que recibirás:
```json
{
  "success": true,
  "message": "Inicio de sesión exitoso",
  "data": {
    "user": {
      "id": 1,
      "name": "Administrador MercadoLibre",
      "email": "admin@mercadolibre.com",
      "role": "admin"
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg...",
    "token_type": "bearer",
    "expires_in": 3600
  }
}
```

**¡El token es ese texto largooo que está en `access_token`!**

---

### Método 4: Con Thunder Client / Postman

#### Thunder Client (VS Code):

1. **Instala Thunder Client:**
   - Abre VS Code
   - Ve a Extensions (Ctrl+Shift+X)
   - Busca "Thunder Client"
   - Instala

2. **Importa la colección:**
   - Abre Thunder Client
   - Click en "Collections"
   - Click en "..." → "Import"
   - Selecciona el archivo `thunder-client-collection.json`

3. **Haz login:**
   - En la carpeta "🔐 Autenticación"
   - Click en "Login - Admin"
   - Click en "Send"
   - ¡El token se guarda automáticamente en la variable `{{token}}`!

4. **Usa las otras peticiones:**
   - Todas las demás peticiones ya tienen configurado `Bearer {{token}}`
   - Solo haz click en "Send" y funcionarán

#### Postman:

1. **Importa la colección:**
   - Abre Postman
   - File → Import
   - Selecciona `thunder-client-collection.json`

2. **Configura la variable de entorno:**
   - Crea un nuevo Environment llamado "ML2 Local"
   - Añade la variable: `token` = (déjala vacía por ahora)

3. **Haz login y copia el token:**
   - Ejecuta la petición "Login - Admin"
   - En la respuesta, copia el valor de `data.access_token`
   - Pégalo en la variable `token` de tu Environment

---

## 🔑 Cómo Usar el Token en tus Peticiones

### Formato del Header:

```
Authorization: Bearer TU_TOKEN_AQUI
```

**Ejemplo completo:**

```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg...
```

### Con cURL:

```powershell
curl -X GET http://localhost:8000/api/products `
  -H "Authorization: Bearer TU_TOKEN_AQUI" `
  -H "Accept: application/json"
```

### Con JavaScript (Fetch):

```javascript
const token = 'TU_TOKEN_AQUI';

fetch('http://localhost:8000/api/products', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data));
```

### Con Axios:

```javascript
import axios from 'axios';

const token = 'TU_TOKEN_AQUI';

axios.get('http://localhost:8000/api/products', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
})
.then(response => console.log(response.data));
```

---

## 👥 Usuarios Disponibles

Después de ejecutar `php artisan db:seed`:

| Email | Password | Rol | Qué puede hacer |
|-------|----------|-----|-----------------|
| admin@mercadolibre.com | admin123 | admin | TODO (crear/editar/eliminar productos y categorías) |
| seller@mercadolibre.com | seller123 | seller | Crear y editar productos |
| customer@mercadolibre.com | customer123 | customer | Solo ver productos y categorías |

---

## ⏰ Duración del Token

- **Tiempo de expiración:** 60 minutos (3600 segundos)
- **Qué hacer cuando expira:**
  1. Opción 1: Hacer login nuevamente
  2. Opción 2: Usar el endpoint `/api/auth/refresh` para renovarlo

### Renovar token:

```bash
curl -X POST http://localhost:8000/api/auth/refresh \
  -H "Authorization: Bearer TU_TOKEN_VIEJO" \
  -H "Accept: application/json"
```

Te devolverá un token nuevo que durará otros 60 minutos.

---

## 🐛 Problemas Comunes

### Error: "Token no proporcionado"
❌ **Problema:** No estás enviando el header `Authorization`
✅ **Solución:** Agrega el header `Authorization: Bearer TU_TOKEN`

### Error: "Token inválido"
❌ **Problema:** El token está mal copiado o corrupto
✅ **Solución:** Vuelve a hacer login y copia el token completo

### Error: "Token expirado"
❌ **Problema:** Pasaron más de 60 minutos
✅ **Solución:**
```bash
# Opción 1: Login nuevo
curl -X POST http://localhost:8000/api/auth/login ...

# Opción 2: Refresh
curl -X POST http://localhost:8000/api/auth/refresh ...
```

### Error: "Usuario inactivo"
❌ **Problema:** Tu usuario tiene `is_active = false` en la base de datos
✅ **Solución:** Contacta al administrador o actualiza la BD

### Error: "Unauthorized" en productos/categorías
❌ **Problema:** Tu rol no tiene permiso para esa acción
✅ **Solución:**
- **Customer** → Solo puede VER (GET)
- **Seller** → Puede crear/editar productos
- **Admin** → Puede hacer TODO

---

## 📚 Recursos Adicionales

- [Guía de Testing Completa](docs/GUIA_TESTING_API.md)
- [Documentación de Endpoints](docs/API_ENDPOINTS.md)
- [Configuración JWT](docs/JWT_SETUP.md)

---

## 🎯 Resumen Rápido

1. **Inicia el servidor:** `php artisan serve`
2. **Opción fácil:** Abre `http://localhost:8000/api-test.html` y haz click en "Login"
3. **Opción script:** Ejecuta `.\test-api.ps1`
4. **Opción manual:** Usa cURL/Postman para hacer POST a `/api/auth/login`
5. **Guarda el token** que recibes en `data.access_token`
6. **Úsalo** en tus peticiones con el header: `Authorization: Bearer TU_TOKEN`

---

**¡Listo para empezar! 🚀**

Fecha: 26 Noviembre 2025
Equipo: MercadoLibre2 - UPQ Sistemas
