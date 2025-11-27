# Administración Suprema de Productos

Este módulo permite a los administradores gestionar **todos los productos** del sistema, sin importar a qué vendedor pertenezcan.

## Características

✅ **Vista maestra de todos los productos** - El admin puede ver y gestionar todos los productos del sistema
✅ **Filtros avanzados** - Búsqueda por nombre/SKU, filtros por categoría, vendedor y estado
✅ **Edición completa** - Modificar cualquier aspecto del producto incluyendo el vendedor asignado
✅ **Cambio de propietario** - Reasignar productos a diferentes vendedores
✅ **Control de estado** - Activar/desactivar productos y marcarlos como destacados
✅ **Gestión de imágenes** - Actualizar imágenes de productos
✅ **Eliminación segura** - Eliminar productos del sistema

## Rutas Disponibles

```
GET    /admin/products                           - Lista todos los productos
GET    /admin/products/{id}/edit                 - Formulario de edición
PUT    /admin/products/{id}                      - Actualizar producto
DELETE /admin/products/{id}                      - Eliminar producto
POST   /admin/products/{id}/toggle-status        - Activar/desactivar (API)
POST   /admin/products/{id}/toggle-featured      - Destacar/no destacar (API)
```

## Acceso

Solo usuarios con rol `admin` pueden acceder a estas rutas.

**URL de acceso:**
```
http://localhost:8000/admin/products
```

## Diferencias con el Panel de Vendedor

| Característica | Panel Vendedor | Admin Supremo |
|---------------|----------------|---------------|
| Productos visibles | Solo sus propios productos | Todos los productos del sistema |
| Cambiar vendedor | ❌ No | ✅ Sí |
| Filtrar por vendedor | ❌ No | ✅ Sí |
| Eliminar productos de otros | ❌ No | ✅ Sí |
| Ver información del vendedor | - | ✅ Sí (email, nombre) |

## Funcionalidades del Listado

### Búsqueda y Filtros
- **Búsqueda de texto**: Por nombre, SKU o descripción
- **Filtro por categoría**: Ver productos de una categoría específica
- **Filtro por vendedor**: Ver productos de un vendedor específico
- **Filtro por estado**: Filtrar por productos activos o inactivos

### Información Mostrada
Para cada producto se muestra:
- Imagen miniatura
- Nombre y SKU
- Vendedor (nombre y email)
- Categoría
- Precio y precio de oferta
- Stock (con código de colores según cantidad)
- Estado (activo/inactivo)
- Badge de producto destacado
- Acciones (editar/eliminar)

## Edición de Productos

El formulario de edición permite modificar:

1. **Vendedor asignado** (único para admin)
2. Información básica (nombre, SKU, categoría)
3. Precios (precio regular y precio de oferta)
4. Stock
5. Descripciones (corta y completa)
6. Imágenes del producto
7. Estado (activo/inactivo)
8. Destacado (sí/no)

## Seguridad

- Middleware `auth` - Requiere autenticación
- Middleware `role:admin` - Solo usuarios admin
- Validación de datos en todas las operaciones
- Protección contra eliminación de productos con pedidos asociados

## Diseño

Mantiene el mismo diseño consistente con:
- Estilo visual idéntico al panel de vendedores
- Paleta de colores corporativa (#EE403D)
- Tipografía Jost
- UI responsiva y moderna
- Feedback visual para todas las acciones

## Notas Técnicas

- **Controlador**: `App\Http\Controllers\Admin\AdminProductController`
- **Vistas**: `resources/views/admin/products/`
- **Paginación**: 20 productos por página
- **Imágenes**: Se eliminan del storage al actualizar o eliminar
- **Manejo de errores**: Validación y mensajes de error claros
