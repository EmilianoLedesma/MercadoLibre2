# 🔐 Credenciales de Acceso - Usuarios de Prueba

## Usuarios Principales (SEALS)

### 👨‍💼 ADMINISTRADOR
```
Email:    admin@seals.mx
Password: admin123
Rol:      admin
```
**✅ Este usuario puede acceder a /admin/products**

---

### 👤 Vendedor
```
Email:    seller@seals.mx
Password: seller123
Rol:      seller
```
**Puede acceder a /seller/products (solo sus propios productos)**

---

### 🛒 Cliente
```
Email:    customer@seals.mx
Password: customer123
Rol:      customer
```
**Acceso regular de comprador**

---

## Usuarios Adicionales

### Administradores Adicionales

**Admin Diego Ramírez**
```
Email:    diego.ramirez@admin.mx
Password: password123
Rol:      admin
```

---

## Vendedores Adicionales

Todos con contraseña: `password123`

1. **TechStore México**
   - Email: `ventas@techstore.mx`
   
2. **ElectroHogar MX**
   - Email: `contacto@electrohogar.mx`
   
3. **Moda & Estilo CDMX**
   - Email: `ventas@modayestilo.mx`
   
4. **Deportes Total MTY**
   - Email: `info@deportestotal.mx`
   
5. **Librería Porrúa**
   - Email: `ventas@porrua.mx`

---

## Clientes Adicionales

Todos con contraseña: `password123`

1. **Juan Pérez Sánchez**
   - Email: `juan.perez@gmail.com`
   
2. **María González López**
   - Email: `maria.gonzalez@hotmail.com`
   
3. **Carlos Rodríguez Mendoza**
   - Email: `carlos.rodriguez@yahoo.com`
   
4. **Ana Martínez Flores**
   - Email: `ana.martinez@outlook.com`
   
5. **Luis Fernández Torres**
   - Email: `luis.fernandez@gmail.com`

---

## 🚀 Cómo Ejecutar los Seeders

Si la base de datos no tiene usuarios, ejecuta:

```bash
php artisan db:seed --class=UserSeeder
```

O ejecuta todos los seeders:

```bash
php artisan db:seed
```

O reinicia toda la base de datos con datos de prueba:

```bash
php artisan migrate:fresh --seed
```

---

## 📝 Notas Importantes

- **Todos los usuarios están verificados** (`email_verified_at` = now)
- **Todos los usuarios están activos** (`is_active` = true)
- **Las contraseñas están hasheadas** con `bcrypt`
- El seeder **no duplica** usuarios si ya existen (verifica por email)

---

## 🎯 Acceso Rápido para Testing

### Para Probar Admin de Productos:
1. Inicia sesión con: `admin@seals.mx` / `admin123`
2. ✅ **Redirección automática a** `http://localhost:8000/admin/products`
3. ✅ Podrás ver y gestionar TODOS los productos

### Para Probar Panel de Vendedor:
1. Inicia sesión con: `seller@seals.mx` / `seller123`
2. ✅ **Redirección automática a** `http://localhost:8000/seller/dashboard`
3. ✅ Solo verás tus propios productos

---

## 🔒 Seguridad

⚠️ **IMPORTANTE**: Estas son credenciales de desarrollo/testing.
- NO uses estas contraseñas en producción
- Cambia las contraseñas antes de desplegar
- Usa contraseñas seguras en producción
- Considera usar variables de entorno para credenciales de admin

---

## 📧 Formato de Login

**Ruta de login:** `http://localhost:8000/login`

**Formulario:**
```
Email: [correo del usuario]
Password: [contraseña]
```

Después del login, serás redirigido según tu rol:
- **Admin** → puede acceder a `/admin/products`
- **Seller** → puede acceder a `/seller/dashboard` y `/seller/products`
- **Customer** → puede navegar y comprar productos
