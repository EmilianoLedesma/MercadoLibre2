# Configuración de Servidor para Optimización de Rendimiento

Este documento contiene las configuraciones recomendadas para optimizar el rendimiento del servidor web para MercadoLibre2.

## 🚀 Mejoras de Rendimiento Implementadas en la Aplicación

### Base de Datos
- ✅ Índices agregados en columnas frecuentemente consultadas
- ✅ Caché de categorías con invalidación automática
- ✅ Eager loading optimizado con selección de columnas específicas
- ✅ Queries optimizadas para reducir carga de datos innecesarios

### Frontend
- ✅ Lazy loading en todas las imágenes de productos
- ✅ Font Awesome cargado de forma asíncrona
- ✅ Preloader sin delay artificial
- ✅ Preconnect para recursos externos

### Backend
- ✅ Caché de consultas con expiración de 1 hora
- ✅ Observer pattern para invalidación automática de caché
- ✅ Código optimizado según estándares Laravel Pint

## ⚙️ Configuraciones Adicionales del Servidor (Recomendadas)

### 1. Compresión Gzip/Brotli (Apache)

Agregar al archivo `.htaccess` o configuración de Apache:

```apache
# Habilitar compresión mod_deflate
<IfModule mod_deflate.c>
    # Comprimir HTML, CSS, JavaScript, Text, XML y fuentes
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
    AddOutputFilterByType DEFLATE application/x-font
    AddOutputFilterByType DEFLATE application/x-font-opentype
    AddOutputFilterByType DEFLATE application/x-font-otf
    AddOutputFilterByType DEFLATE application/x-font-truetype
    AddOutputFilterByType DEFLATE application/x-font-ttf
    AddOutputFilterByType DEFLATE application/x-javascript
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE font/opentype
    AddOutputFilterByType DEFLATE font/otf
    AddOutputFilterByType DEFLATE font/ttf
    AddOutputFilterByType DEFLATE image/svg+xml
    AddOutputFilterByType DEFLATE image/x-icon
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/xml
</IfModule>
```

### 2. Compresión Gzip/Brotli (Nginx)

Agregar a la configuración de Nginx:

```nginx
# Habilitar compresión gzip
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_proxied any;
gzip_comp_level 6;
gzip_types
    text/plain
    text/css
    text/xml
    text/javascript
    application/json
    application/javascript
    application/xml+rss
    application/rss+xml
    font/truetype
    font/opentype
    application/vnd.ms-fontobject
    image/svg+xml;

# Habilitar compresión Brotli (si está disponible)
brotli on;
brotli_comp_level 6;
brotli_types
    text/plain
    text/css
    application/json
    application/javascript
    application/xml
    image/svg+xml;
```

### 3. Caché del Navegador (Apache)

```apache
<IfModule mod_expires.c>
    ExpiresActive On
    
    # Imágenes
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    ExpiresByType image/x-icon "access plus 1 year"
    
    # CSS y JavaScript
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/x-javascript "access plus 1 month"
    
    # Fuentes
    ExpiresByType font/ttf "access plus 1 year"
    ExpiresByType font/otf "access plus 1 year"
    ExpiresByType font/woff "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
    ExpiresByType application/font-woff "access plus 1 year"
    
    # HTML
    ExpiresByType text/html "access plus 1 hour"
</IfModule>
```

### 4. Caché del Navegador (Nginx)

```nginx
location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|otf)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

location ~* \.(html)$ {
    expires 1h;
    add_header Cache-Control "public";
}
```

### 5. Configuración de PHP para Producción

Editar `php.ini`:

```ini
; OPcache para mejor rendimiento
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
opcache.revalidate_freq=0
opcache.save_comments=1

; Límites de memoria y tiempo
memory_limit=256M
max_execution_time=60
upload_max_filesize=10M
post_max_size=10M
```

### 6. Laravel - Optimizaciones de Producción

Ejecutar los siguientes comandos en producción:

```bash
# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache

# Optimizar autoloader de Composer
composer install --optimize-autoloader --no-dev

# Ejecutar migraciones (incluye los nuevos índices)
php artisan migrate --force
```

### 7. Configuración de Base de Datos MySQL

Agregar al archivo `my.cnf` o `my.ini`:

```ini
[mysqld]
# InnoDB settings
innodb_buffer_pool_size=1G
innodb_log_file_size=256M
innodb_flush_log_at_trx_commit=2
innodb_flush_method=O_DIRECT

# Query cache
query_cache_type=1
query_cache_size=64M
query_cache_limit=2M

# Table cache
table_open_cache=4000
table_definition_cache=2000
```

## 📊 Métricas de Rendimiento Esperadas

Con todas estas optimizaciones implementadas, deberías ver:

- **Reducción del 40-60% en tiempo de carga inicial** gracias a:
  - Eliminación del delay de 500ms del preloader
  - Carga asíncrona de Font Awesome
  - Lazy loading de imágenes

- **Reducción del 30-50% en consultas a base de datos** gracias a:
  - Índices en columnas frecuentemente consultadas
  - Caché de categorías
  - Eager loading optimizado

- **Reducción del 50-70% en transferencia de datos** gracias a:
  - Compresión gzip/brotli
  - Selección específica de columnas en queries
  - Caché del navegador

- **Mejora del 20-30% en tiempo de respuesta del servidor** gracias a:
  - OPcache habilitado
  - Configuración optimizada de MySQL
  - Caché de Laravel

## 🔍 Monitoreo

Para verificar las mejoras, puedes usar:

1. **Chrome DevTools** - Network tab para ver tiempos de carga
2. **Google PageSpeed Insights** - https://pagespeed.web.dev/
3. **Laravel Debugbar** - Para monitorear queries en desarrollo
4. **New Relic o similar** - Para monitoreo de producción

## ⚠️ Notas Importantes

- **Migraciones**: Ejecuta `php artisan migrate` para aplicar los nuevos índices
- **Caché**: En desarrollo, puedes limpiar el caché con `php artisan cache:clear`
- **OPcache**: Después de desplegar, reinicia PHP-FPM para limpiar OPcache
- **Monitoreo**: Observa el uso de memoria de MySQL después de aplicar los cambios

## 🎯 Próximos Pasos Recomendados

1. Implementar CDN para assets estáticos
2. Agregar Redis para caché de sesiones y queries
3. Implementar compresión de imágenes automática
4. Agregar HTTP/2 o HTTP/3 en el servidor
5. Implementar Service Workers para PWA
