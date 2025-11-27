# 📝 Actualización de .gitignore

## 🎯 Objetivo

Configurar el `.gitignore` para:
- ✅ **Ignorar** archivos temporales y de diagnóstico
- ✅ **Mantener** scripts útiles y documentación importante
- ✅ **Organizar** claramente qué se trackea y qué no

---

## 📂 Estructura de Archivos

### ❌ Archivos IGNORADOS (NO se suben a Git)

#### Temporales Generales
```
*.tmp
*.temp
.cache/
temp/
```

#### Scripts de Diagnóstico Temporal
```
diagnostico_*.php     # Ej: diagnostico_imagenes.php
test-*.php           # EXCEPTO: scripts específicos útiles
test-*.html
check_*.php          # EXCEPTO: check_admin.php
verify_*.php
```

---

### ✅ Archivos TRACKEADOS (SÍ se suben a Git)

#### Scripts Útiles PHP
```
✓ fix_product_sellers.php     - Corrección de vendedores
✓ check_admin.php              - Verificación de usuarios admin
```

#### Scripts PowerShell de Demostración
```
✓ DEMO_ADMIN.ps1              - Demo interactiva admin
✓ INICIAR_DEMO.ps1            - Inicio de demos
✓ test-admin-products.ps1     - Prueba panel admin
✓ test-api.ps1                - Pruebas de API
✓ test-login.ps1              - Pruebas de login
✓ test_login_session.ps1      - Verificación de sesiones
```

#### Documentación Markdown
```
✓ README.md
✓ ADMIN_PRODUCTS_COMPLETED.md
✓ CREDENCIALES_ADMIN.md
✓ INICIO_ADMIN.md
✓ REDIRECCION_COMPLETADA.md
✓ VENDEDORES_CORREGIDOS.md
✓ SOLUCIONADO.md
✓ SPRINT3_SUMMARY.md
✓ README_DEMO_SPRINT3.md
✓ COMO_OBTENER_TOKEN_JWT.md
✓ docs/*.md                    - Toda la documentación en /docs
```

#### Directorio de Herramientas
```
✓ tools/                       - Directorio completo
✓ tools/*.php                  - Todos los scripts en tools/
```

---

## 🔧 Reglas de Exclusión

El `.gitignore` usa **patrones de negación** (`!`) para mantener archivos específicos:

### Ejemplo:
```gitignore
# Ignorar todos los archivos check_*.php
check_*.php

# PERO mantener este específico
!check_admin.php
```

---

## 📋 Lista Completa de Archivos Importantes

### Scripts PHP (Raíz)
1. `check_admin.php` - Verifica usuarios admin en BD
2. `fix_product_sellers.php` - Corrige vendedores de productos

### Scripts PowerShell
1. `DEMO_ADMIN.ps1` - Demo completa del panel admin
2. `INICIAR_DEMO.ps1` - Inicio general de demos
3. `test-admin-products.ps1` - Prueba específica admin
4. `test-api.ps1` - Pruebas de endpoints API
5. `test-login.ps1` - Pruebas de autenticación
6. `test_login_session.ps1` - Verificación de sesiones

### Documentación Principal
1. `README.md` - Documentación principal del proyecto
2. `ADMIN_PRODUCTS_COMPLETED.md` - Resumen admin de productos
3. `CREDENCIALES_ADMIN.md` - Credenciales de testing
4. `INICIO_ADMIN.md` - Guía rápida de inicio admin
5. `REDIRECCION_COMPLETADA.md` - Documentación de redirección
6. `VENDEDORES_CORREGIDOS.md` - Corrección de vendedores
7. `SOLUCIONADO.md` - Problemas resueltos
8. `SPRINT3_SUMMARY.md` - Resumen Sprint 3
9. `README_DEMO_SPRINT3.md` - Demo Sprint 3
10. `COMO_OBTENER_TOKEN_JWT.md` - Guía JWT

### Documentación en /docs
```
docs/ADMIN_PRODUCTS.md
docs/API_ENDPOINTS.md
docs/API_INTEGRATION_SPRINT3.md
docs/GUIA_TESTING_API.md
docs/GUIA_VERIFICACION.md
docs/JWT_SETUP.md
docs/PERFORMANCE_OPTIMIZATIONS.md
docs/REDIRECCION_ADMIN.md
docs/SERVER_OPTIMIZATION.md
docs/SPRINT2_COMPLETADO.md
docs/VERIFICACION_FINAL.md
```

### Tools Directory
```
tools/count_products.php
tools/inspect_images.php
tools/show_products.php
```

---

## 🚀 Beneficios

### Organización
- ✅ Archivos temporales no ensucian el repositorio
- ✅ Documentación siempre disponible
- ✅ Scripts útiles versionados

### Colaboración
- ✅ Otros desarrolladores tienen acceso a herramientas
- ✅ Documentación compartida
- ✅ Demos reproducibles

### Mantenimiento
- ✅ Fácil identificar qué es temporal
- ✅ Histórico de documentación
- ✅ Scripts de corrección disponibles

---

## 📊 Resumen Visual

```
MercadoLibre2/
├── ❌ diagnostico_*.php         (Ignorado - Temporal)
├── ✅ check_admin.php            (Trackeado - Útil)
├── ✅ fix_product_sellers.php    (Trackeado - Útil)
├── ❌ test-random.php            (Ignorado - Temporal)
├── ✅ test-api.ps1               (Trackeado - Demo)
├── ✅ DEMO_ADMIN.ps1             (Trackeado - Demo)
├── ✅ *.md                       (Trackeado - Docs)
├── ✅ tools/                     (Trackeado - Herramientas)
│   └── ✅ *.php                  (Trackeado - Todos)
└── ✅ docs/                      (Trackeado - Documentación)
    └── ✅ *.md                   (Trackeado - Todos)
```

---

## 🔍 Verificar qué se Ignora

Para ver qué archivos se están ignorando:

```bash
git status --ignored
```

Para verificar si un archivo específico sería ignorado:

```bash
git check-ignore -v nombre_archivo.php
```

---

## ⚠️ Importante

Si agregaste archivos temporales antes de actualizar el `.gitignore`, debes eliminarlos del índice:

```bash
# Para un archivo específico
git rm --cached archivo_temporal.php

# Para todos los archivos que ahora están ignorados
git rm -r --cached .
git add .
git commit -m "Actualizar gitignore y limpiar archivos temporales"
```

---

**Actualizado**: 27 de Noviembre, 2025
**Estado**: ✅ Configurado y Documentado
