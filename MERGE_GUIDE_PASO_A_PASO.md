# Guía Paso a Paso: Merge de Correcciones a Main

## Preparación Inicial

### Paso 0: Hacer Backups
```bash
# Crear copias de seguridad
git checkout correcciones
git branch backup-correcciones-$(date +%Y%m%d)

git checkout main
git branch backup-main-$(date +%Y%m%d)

# Verificar que los backups existen
git branch | grep backup
```

---

## Fase 1: Iniciar el Merge

### Paso 1: Posicionarse en Main e Iniciar Merge
```bash
git checkout main
git merge --allow-unrelated-histories --no-commit --no-ff correcciones
```

**Resultado esperado:**
```
Auto-merging [archivos...]
CONFLICT (add/add): Merge conflict in [36 archivos]
Automatic merge failed; fix conflicts and then commit the result.
```

### Paso 2: Ver la Lista de Conflictos
```bash
git status
# o
git diff --name-only --diff-filter=U
```

---

## Fase 2: Resolver Conflictos Archivo por Archivo

### Estrategia General
- **Archivos de configuración**: Combinar ambas versiones
- **Controladores web**: Usar versión de correcciones
- **Modelos**: Usar correcciones pero añadir métodos JWT
- **Vistas**: Usar correcciones (más completas)
- **Rutas web**: Usar correcciones (más completas)
- **Config/auth**: Usar main (tiene JWT) pero verificar

---

### Grupo 1: Archivos de Configuración

#### `.gitignore`
**Acción:** Combinar ambas versiones

```bash
# Editar manualmente
nano .gitignore
```

**Contenido final recomendado:**
```gitignore
# Claude Code local configuration
.claude/

# Dependencies
node_modules/

# Build outputs
dist/
build/

# Environment variables
.env
.env.local
.env.*.local

# IDE
.vscode/
.idea/
*.swp
*.swo
*~

# OS
.DS_Store
Thumbs.db

# Logs
logs/
*.log
npm-debug.log*
yarn-debug.log*
yarn-error.log*

# Testing
coverage/
.nyc_output/

# Laravel - Ignorar vistas compiladas de Blade
/storage/framework/views/

# Laravel - Ignorar backups de entorno
.env.backup
```

```bash
git add .gitignore
```

---

#### `README.md`
**Acción:** Usar versión de main (tiene documentación de API) y añadir nota sobre funcionalidad de vendedores

```bash
# Aceptar versión de main
git checkout --theirs README.md
git add README.md
```

O si prefieres combinar manualmente, edita el archivo.

---

#### `.env.example`
**Acción:** Usar versión de correcciones (más actualizada)

```bash
git checkout --ours .env.example
git add .env.example
```

---

### Grupo 2: Bootstrap y Configuración

#### `bootstrap/app.php`
**Acción:** Comparar ambas versiones y combinar

```bash
# Ver diferencias
git diff HEAD:bootstrap/app.php MERGE_HEAD:bootstrap/app.php

# Si son muy similares, usar correcciones
git checkout --ours bootstrap/app.php
git add bootstrap/app.php
```

---

#### `config/auth.php`
**Acción:** Usar versión de main (tiene configuración JWT)

```bash
git checkout --theirs config/auth.php
git add config/auth.php
```

---

### Grupo 3: Modelos (CRÍTICO)

#### `app/Models/User.php`
**Acción:** COMBINAR MANUALMENTE - Este es el más importante

```bash
nano app/Models/User.php
```

**Contenido final recomendado:**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Address;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',  // De correcciones
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Métodos JWT (de main)
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

    // Relaciones (de correcciones)
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function store()
    {
        return $this->hasOne(\App\Models\Store::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
```

```bash
git add app/Models/User.php
```

---

#### `app/Models/Product.php`
**Acción:** Usar versión de correcciones (tiene store_id)

```bash
git checkout --ours app/Models/Product.php
git add app/Models/Product.php
```

---

#### `app/Models/Order.php`
**Acción:** Usar versión de correcciones (más campos)

```bash
git checkout --ours app/Models/Order.php
git add app/Models/Order.php
```

---

### Grupo 4: Controladores Web

#### `app/Http/Controllers/AuthController.php`
**Acción:** Usar versión de correcciones (tiene registro de vendedores)

```bash
git checkout --ours app/Http/Controllers/AuthController.php
git add app/Http/Controllers/AuthController.php
```

---

#### `app/Http/Controllers/ProductController.php`
**Acción:** Usar versión de correcciones

```bash
git checkout --ours app/Http/Controllers/ProductController.php
git add app/Http/Controllers/ProductController.php
```

---

#### `app/Http/Controllers/ShopController.php`
**Acción:** Usar versión de correcciones (tiene búsqueda)

```bash
git checkout --ours app/Http/Controllers/ShopController.php
git add app/Http/Controllers/ShopController.php
```

---

#### `app/Http/Controllers/MiCuentaController.php`
**Acción:** Usar versión de correcciones

```bash
git checkout --ours app/Http/Controllers/MiCuentaController.php
git add app/Http/Controllers/MiCuentaController.php
```

---

### Grupo 5: Seeders

#### `database/seeders/ProductSeeder.php`
**Acción:** Usar versión de correcciones

```bash
git checkout --ours database/seeders/ProductSeeder.php
git add database/seeders/ProductSeeder.php
```

---

#### `database/seeders/UserSeeder.php`
**Acción:** Usar versión de correcciones

```bash
git checkout --ours database/seeders/UserSeeder.php
git add database/seeders/UserSeeder.php
```

---

### Grupo 6: Rutas

#### `routes/web.php`
**Acción:** Usar versión de correcciones (mucho más completo)

```bash
git checkout --ours routes/web.php
git add routes/web.php
```

---

### Grupo 7: Vistas (22 archivos)

**Acción:** Usar TODAS las vistas de correcciones

```bash
# Todas las vistas de correcciones
git checkout --ours resources/views/account/index.blade.php
git checkout --ours resources/views/auth/login.blade.php
git checkout --ours resources/views/cart.blade.php
git checkout --ours resources/views/categories.blade.php
git checkout --ours resources/views/components/newsletter-popup.blade.php
git checkout --ours resources/views/contact.blade.php
git checkout --ours resources/views/home.blade.php
git checkout --ours resources/views/layouts/app.blade.php
git checkout --ours resources/views/layouts/navbar.blade.php
git checkout --ours resources/views/mi-cuenta/index.blade.php
git checkout --ours resources/views/products/create.blade.php
git checkout --ours resources/views/products/edit.blade.php
git checkout --ours resources/views/products/index.blade.php
git checkout --ours resources/views/products/show.blade.php
git checkout --ours resources/views/shop/category.blade.php
git checkout --ours resources/views/shop/index.blade.php
git checkout --ours resources/views/shop/show.blade.php
git checkout --ours resources/views/wishlist/index.blade.php

# Agregar todas
git add resources/views/
```

---

## Fase 3: Verificar y Completar

### Paso 3: Verificar Estado del Merge
```bash
# Ver si quedan conflictos
git status

# Debe mostrar: "All conflicts fixed but you are still merging"
```

### Paso 4: Verificar Archivos de API (deben estar presentes)
```bash
# Estos archivos de main deben seguir presentes
ls -la app/Http/Controllers/Api/
ls -la routes/api.php
ls -la tests/Feature/Api/
```

Si no están, hay un problema. NO deberían estar en conflicto.

### Paso 5: Commit del Merge
```bash
git commit -m "Merge correcciones into main: Integrate complete seller system, checkout, and shopping cart

- Preserved seller functionality from correcciones (SellerController, SellerProductController)
- Preserved checkout system from correcciones (CheckoutController)
- Preserved shopping cart from correcciones (CartController)
- Combined User model to support both JWT authentication and seller relationships
- Maintained API controllers and routes from main
- Updated database schema with stores table and additional fields
- Integrated both authentication systems (web + JWT API)"
```

---

## Fase 4: Post-Merge - Instalación y Testing

### Paso 6: Instalar Dependencias
```bash
# Asegurarse de que JWT esté instalado
composer require tymon/jwt-auth

# Generar secret key de JWT si no existe
php artisan jwt:secret
```

### Paso 7: Ejecutar Migraciones
```bash
# Refrescar base de datos
php artisan migrate:fresh --seed

# O si prefieres no perder datos
php artisan migrate
```

### Paso 8: Limpiar Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Paso 9: Compilar Assets
```bash
npm install
npm run build
```

### Paso 10: Testing

#### Test 1: Verificar que el servidor funciona
```bash
php artisan serve
```
Visitar: http://localhost:8000

#### Test 2: Verificar autenticación web
- Ir a /login
- Ir a /register
- Ir a /seller/register (nuevo de correcciones)
- Intentar login

#### Test 3: Verificar sistema de vendedores
- Registrarse como vendedor
- Acceder a /seller/dashboard
- Crear un producto como vendedor

#### Test 4: Verificar checkout
- Añadir producto al carrito
- Ir a /cart
- Ir a /checkout
- Completar compra

#### Test 5: Verificar API JWT
```bash
# Ejecutar tests de API
php artisan test --filter Api
```

O con curl:
```bash
# Test API login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'

# Debe devolver un token JWT
```

---

## Resolución de Problemas Comunes

### Error: "Class 'Tymon\JWTAuth\Contracts\JWTSubject' not found"
```bash
composer require tymon/jwt-auth
php artisan jwt:secret
```

### Error: "Table 'stores' doesn't exist"
```bash
php artisan migrate:fresh --seed
```

### Error: "Route [seller.dashboard] not defined"
```bash
php artisan route:clear
php artisan route:cache
```

### Error en vistas: "View not found"
```bash
php artisan view:clear
```

---

## Checklist Final

- [ ] Todos los 36 conflictos resueltos
- [ ] User model combina JWT + relaciones de seller
- [ ] Controladores de API presentes (en app/Http/Controllers/Api/)
- [ ] Controladores de correcciones presentes (Cart, Checkout, Seller, etc.)
- [ ] routes/api.php existe y funciona
- [ ] routes/web.php tiene todas las rutas de correcciones
- [ ] Migraciones ejecutadas sin errores
- [ ] Seeders ejecutados sin errores
- [ ] JWT instalado y configurado
- [ ] Assets compilados
- [ ] Autenticación web funciona
- [ ] API JWT funciona
- [ ] Sistema de vendedores funciona
- [ ] Checkout funciona
- [ ] Carrito funciona

---

## Resumen de Comandos Rápidos

Si ya conoces la estrategia, aquí está el resumen:

```bash
# 1. Backup
git checkout correcciones && git branch backup-correcciones-$(date +%Y%m%d)
git checkout main && git branch backup-main-$(date +%Y%m%d)

# 2. Merge
git checkout main
git merge --allow-unrelated-histories --no-commit --no-ff correcciones

# 3. Resolver (usar correcciones excepto config/auth.php)
git checkout --theirs config/auth.php
git checkout --ours .env.example
git checkout --ours app/Models/Product.php
git checkout --ours app/Models/Order.php
git checkout --ours app/Http/Controllers/AuthController.php
git checkout --ours app/Http/Controllers/ProductController.php
git checkout --ours app/Http/Controllers/ShopController.php
git checkout --ours app/Http/Controllers/MiCuentaController.php
git checkout --ours database/seeders/ProductSeeder.php
git checkout --ours database/seeders/UserSeeder.php
git checkout --ours routes/web.php
git checkout --ours resources/views/

# 4. Combinar manualmente
# - .gitignore (combinar)
# - app/Models/User.php (combinar JWT + relaciones)
# - README.md (opcional)
# - bootstrap/app.php (revisar)

# 5. Add y commit
git add .
git commit

# 6. Post-merge
composer require tymon/jwt-auth
php artisan jwt:secret
php artisan migrate:fresh --seed
npm run build
php artisan test
```

---

## ¿Necesitas Ayuda?

Si encuentras problemas durante el merge:

1. **NO entres en pánico**
2. Anota el mensaje de error exacto
3. Verifica en qué paso estás
4. Si es necesario, aborta el merge: `git merge --abort`
5. Recupera desde el backup si es necesario

**Recuerda:** Tienes backups de ambas ramas, así que puedes intentarlo múltiples veces si es necesario.
