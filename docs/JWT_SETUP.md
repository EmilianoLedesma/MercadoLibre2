# Configuración JWT Authentication

## Descripción General

Este documento describe la implementación completa de autenticación JWT (JSON Web Tokens) en el proyecto MercadoLibre2 usando el paquete `tymon/jwt-auth`.

## Requisitos Previos

- PHP 8.2+
- Laravel 12
- Composer
- Base de datos configurada (MySQL, PostgreSQL, SQLite)

## Instalación

### 1. Instalar el paquete JWT

```bash
composer require tymon/jwt-auth
```

### 2. Publicar la configuración (Opcional)

El archivo `config/jwt.php` ya está incluido en el proyecto, pero si necesitas republicarlo:

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

### 3. Generar la clave secreta JWT

```bash
php artisan jwt:secret
```

Este comando agregará `JWT_SECRET` a tu archivo `.env`.

### 4. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto creará las tablas necesarias y poblará la base de datos con usuarios de prueba.

## Configuración

### Archivo .env

Asegúrate de tener las siguientes variables en tu archivo `.env`:

```env
JWT_SECRET=tu_clave_secreta_aqui
JWT_TTL=60
JWT_REFRESH_TTL=20160
JWT_ALGO=HS256
JWT_BLACKLIST_ENABLED=true
JWT_BLACKLIST_GRACE_PERIOD=0
JWT_SHOW_BLACKLIST_EXCEPTION=true
```

### Guards de Autenticación

El guard `api` está configurado en `config/auth.php`:

```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
        'hash' => false,
    ],
],
```

### Modelo User

El modelo `User` implementa la interfaz `JWTSubject` con dos métodos requeridos:

```php
public function getJWTIdentifier()
{
    return $this->getKey();
}

public function getJWTCustomClaims()
{
    return [
        'role' => $this->role,
        'email' => $this->email,
    ];
}
```

## Estructura de Archivos

```
MercadoLibre2/
├── config/
│   ├── jwt.php                 # Configuración JWT
│   └── auth.php                # Guards de autenticación
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   └── AuthController.php    # Controlador de autenticación
│   │   ├── Middleware/
│   │   │   └── JwtMiddleware.php     # Middleware JWT
│   │   └── Traits/
│   │       └── ApiResponseTrait.php  # Respuestas estandarizadas
│   └── Models/
│       └── User.php            # Modelo con JWTSubject
├── routes/
│   └── api.php                 # Rutas API
├── database/
│   └── seeders/
│       └── UserSeeder.php      # Seeders con roles
└── docs/
    ├── JWT_SETUP.md
    └── API_ENDPOINTS.md
```

## Usuarios de Prueba

Después de ejecutar los seeders, tendrás acceso a los siguientes usuarios:

### Administradores
- **Email:** admin@mercadolibre.com
- **Password:** admin123
- **Role:** admin

- **Email:** joaquin.moreno@admin.com
- **Password:** password123
- **Role:** admin

### Vendedores (Sellers)
- **Email:** ventas@techstore.com.ar | **Password:** password123
- **Email:** contacto@electrohogar.com | **Password:** password123
- **Email:** ventas@modayestilo.com | **Password:** password123
- **Email:** info@deportestotal.com | **Password:** password123
- **Email:** ventas@elateneo.com | **Password:** password123

### Clientes (Customers)
- **Email:** juan.perez@gmail.com | **Password:** password123
- **Email:** maria.gonzalez@hotmail.com | **Password:** password123
- **Email:** carlos.rodriguez@yahoo.com | **Password:** password123
- **Email:** ana.martinez@outlook.com | **Password:** password123
- **Email:** luis.fernandez@gmail.com | **Password:** password123

## Uso Básico

### Ejemplo con cURL

#### 1. Registro de Usuario

```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Nuevo Usuario",
    "email": "nuevo@ejemplo.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+54 11 1234-5678",
    "role": "customer"
  }'
```

#### 2. Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "admin@mercadolibre.com",
    "password": "admin123"
  }'
```

Respuesta:
```json
{
  "success": true,
  "message": "Inicio de sesión exitoso",
  "data": {
    "user": {
      "id": 1,
      "name": "Administrador MercadoLibre",
      "email": "admin@mercadolibre.com",
      "role": "admin",
      "is_active": true
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer",
    "expires_in": 3600
  }
}
```

#### 3. Obtener Usuario Autenticado

```bash
curl -X GET http://localhost:8000/api/auth/me \
  -H "Authorization: Bearer {tu_token_aqui}" \
  -H "Accept: application/json"
```

#### 4. Refrescar Token

```bash
curl -X POST http://localhost:8000/api/auth/refresh \
  -H "Authorization: Bearer {tu_token_aqui}" \
  -H "Accept: application/json"
```

#### 5. Cerrar Sesión

```bash
curl -X POST http://localhost:8000/api/auth/logout \
  -H "Authorization: Bearer {tu_token_aqui}" \
  -H "Accept: application/json"
```

## Uso con Postman

### 1. Configurar Environment

Crea un environment en Postman con las siguientes variables:

- `base_url`: `http://localhost:8000`
- `token`: (se llenará automáticamente después del login)

### 2. Importar Colección

Puedes crear las siguientes requests:

**POST** `{{base_url}}/api/auth/register`
- Body (JSON):
```json
{
  "name": "Test User",
  "email": "test@ejemplo.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "customer"
}
```

**POST** `{{base_url}}/api/auth/login`
- Body (JSON):
```json
{
  "email": "admin@mercadolibre.com",
  "password": "admin123"
}
```
- Tests (para guardar el token):
```javascript
var jsonData = pm.response.json();
if (jsonData.data && jsonData.data.access_token) {
    pm.environment.set("token", jsonData.data.access_token);
}
```

**GET** `{{base_url}}/api/auth/me`
- Headers:
  - Authorization: `Bearer {{token}}`

**POST** `{{base_url}}/api/auth/refresh`
- Headers:
  - Authorization: `Bearer {{token}}`

**POST** `{{base_url}}/api/auth/logout`
- Headers:
  - Authorization: `Bearer {{token}}`

## Estructura del Token JWT

El token JWT contiene los siguientes claims:

```json
{
  "iss": "http://localhost:8000",
  "iat": 1699876543,
  "exp": 1699880143,
  "nbf": 1699876543,
  "jti": "abc123...",
  "sub": 1,
  "prv": "23bd5c8...",
  "role": "admin",
  "email": "admin@mercadolibre.com"
}
```

- **iss** (Issuer): URL de la aplicación
- **iat** (Issued At): Timestamp de creación
- **exp** (Expiration): Timestamp de expiración
- **nbf** (Not Before): Timestamp desde cuándo es válido
- **jti** (JWT ID): Identificador único del token
- **sub** (Subject): ID del usuario
- **prv**: Hash del proveedor de autenticación
- **role**: Rol del usuario (custom claim)
- **email**: Email del usuario (custom claim)

## Manejo de Errores

### Errores Comunes

#### Token Expirado
```json
{
  "success": false,
  "message": "Token expirado",
  "error": "token_expired"
}
```
**Solución:** Usar el endpoint `/api/auth/refresh`

#### Token Inválido
```json
{
  "success": false,
  "message": "Token inválido",
  "error": "token_invalid"
}
```
**Solución:** Login nuevamente

#### Token No Proporcionado
```json
{
  "success": false,
  "message": "Token no proporcionado",
  "error": "token_absent"
}
```
**Solución:** Incluir el header `Authorization: Bearer {token}`

#### Credenciales Incorrectas
```json
{
  "success": false,
  "message": "Credenciales incorrectas"
}
```

## Seguridad

### Mejores Prácticas

1. **Nunca expongas el JWT_SECRET** - Mantén esta clave segura y no la versiones
2. **Usa HTTPS en producción** - Los tokens JWT deben transmitirse por canales seguros
3. **Configura un TTL apropiado** - 60 minutos es razonable para la mayoría de aplicaciones
4. **Habilita blacklist** - Para invalidar tokens al cerrar sesión
5. **Valida roles y permisos** - No confíes únicamente en los claims del token
6. **Rota las claves periódicamente** - En producción, considera rotar JWT_SECRET
7. **Implementa rate limiting** - Previene ataques de fuerza bruta

### Variables de Entorno en Producción

Asegúrate de configurar correctamente:

```env
APP_ENV=production
APP_DEBUG=false
JWT_SECRET=clave_super_secreta_de_64_caracteres_minimo
JWT_TTL=60
JWT_REFRESH_TTL=20160
```

## Próximos Pasos

1. Implementar middleware de roles para proteger rutas por rol
2. Agregar endpoints API para productos, categorías, órdenes
3. Implementar refresh token automático en el frontend
4. Configurar CORS para peticiones desde dominios externos
5. Agregar rate limiting a los endpoints de autenticación

## Troubleshooting

### Error: "Class 'Tymon\JWTAuth\...' not found"

**Solución:** Ejecuta `composer require tymon/jwt-auth`

### Error: "JWT_SECRET not set"

**Solución:** Ejecuta `php artisan jwt:secret`

### Error al refrescar token

**Solución:** Verifica que `JWT_BLACKLIST_ENABLED=true` y que la caché esté configurada

### Token no se invalida al hacer logout

**Solución:** Verifica la configuración de caché en `.env` (CACHE_STORE debe estar configurado)

## Soporte

Para más información:
- [Documentación oficial tymon/jwt-auth](https://jwt-auth.readthedocs.io/)
- [Laravel Authentication](https://laravel.com/docs/authentication)
- [JWT.io](https://jwt.io/) - Para decodificar y verificar tokens

## Changelog

- **v1.0.0** (12 Nov 2024) - Implementación inicial completa de JWT Authentication
  - Configuración JWT
  - AuthController con todos los endpoints
  - Middleware JWT
  - Rutas API públicas y protegidas
  - Seeders con roles
  - Documentación completa
