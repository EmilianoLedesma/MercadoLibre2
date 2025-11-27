# 🎯 INICIO RÁPIDO - Administración de Productos

## ✅ Credenciales de Acceso Admin

### Usuario Administrador Principal

```
📧 Email:    admin@seals.mx
🔑 Password: admin123
👤 Rol:      admin
```

### Usuario Administrador Adicional

```
📧 Email:    diego.ramirez@admin.mx
🔑 Password: password123
👤 Rol:      admin
```

---

## 🚀 Pasos para Acceder

### 1️⃣ Iniciar el Servidor
```bash
php artisan serve
```

### 2️⃣ Iniciar Sesión
- Ve a: `http://localhost:8000/login`
- Ingresa email: `admin@seals.mx`
- Ingresa contraseña: `admin123`
- Haz clic en "Iniciar Sesión"
- ✅ **Serás redirigido automáticamente a `/admin/products`**

### 3️⃣ ¡Listo!
- Ya estás en el panel de administración de productos
- Puedes gestionar todos los productos del sistema

---

## 📋 Funcionalidades Disponibles

Una vez dentro de `/admin/products` podrás:

✅ **Ver todos los productos** del sistema (de todos los vendedores)
✅ **Filtrar productos** por:
   - Búsqueda de texto (nombre, SKU, descripción)
   - Categoría
   - Vendedor
   - Estado (activo/inactivo)
   
✅ **Editar cualquier producto**:
   - Cambiar información básica
   - Modificar precios y stock
   - Actualizar imágenes
   - **Cambiar el vendedor asignado** (exclusivo del admin)
   - Activar/desactivar
   - Marcar como destacado
   
✅ **Eliminar productos**

---

## 🔍 Verificar Usuarios Admin

Si quieres verificar qué usuarios admin existen en tu base de datos:

```bash
php check_admin.php
```

---

## 🔄 Si No Hay Usuarios

Si la base de datos no tiene usuarios, ejecuta:

```bash
php artisan db:seed --class=UserSeeder
```

Esto creará:
- 2 usuarios admin
- 5 vendedores
- 5 clientes
- Usuarios adicionales hasta completar 25

---

## 📚 Documentación Adicional

- **Guía completa**: `ADMIN_PRODUCTS_COMPLETED.md`
- **Funcionalidades detalladas**: `docs/ADMIN_PRODUCTS.md`
- **Todas las credenciales**: `CREDENCIALES_ADMIN.md`

---

## 🆚 Comparación con Panel de Vendedor

| Característica | Panel Vendedor (`/seller/products`) | Admin Supremo (`/admin/products`) |
|----------------|-------------------------------------|-----------------------------------|
| Productos visibles | Solo propios | **Todos del sistema** |
| Cambiar vendedor | ❌ No | ✅ **Sí** |
| Ver info vendedor | - | ✅ Sí (nombre + email) |
| Filtrar por vendedor | ❌ No | ✅ **Sí** |
| Eliminar productos ajenos | ❌ No | ✅ **Sí** |

---

## ⚠️ Importante

- Estas credenciales son para **desarrollo/testing**
- NO uses `admin123` en producción
- Cambia las contraseñas antes de desplegar
- El middleware `role:admin` protege las rutas

---

## 🎨 Diseño

El panel de administración mantiene el **mismo diseño** que el panel de vendedores:
- Paleta de colores corporativa (#EE403D)
- Tipografía Jost
- UI responsiva y moderna
- Feedback visual para todas las acciones

---

## 🛠️ Soporte Técnico

Si tienes problemas:
1. Verifica que el servidor esté corriendo: `php artisan serve`
2. Verifica la conexión a la base de datos en `.env`
3. Ejecuta: `php check_admin.php` para ver usuarios admin
4. Limpia cachés: `php artisan config:clear && php artisan route:clear`

---

**¡Listo para usar!** 🚀
