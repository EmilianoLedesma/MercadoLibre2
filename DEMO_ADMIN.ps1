# Script de Inicio Rápido - Admin de Productos

Clear-Host

Write-Host ""
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host "                           ADMINISTRACIÓN SUPREMA DE PRODUCTOS - INICIO RÁPIDO" -ForegroundColor Yellow
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host ""

# Verificar usuarios admin
Write-Host "🔍 Verificando usuarios admin en la base de datos..." -ForegroundColor Green
Write-Host ""

php check_admin.php

Write-Host ""
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host "                                     GUÍA DE INICIO RÁPIDO" -ForegroundColor Yellow
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "📝 PASO 1: Iniciar el servidor Laravel" -ForegroundColor Yellow
Write-Host ""
Write-Host "   En una terminal nueva, ejecuta:" -ForegroundColor White
Write-Host "   php artisan serve" -ForegroundColor Cyan
Write-Host ""

Write-Host "📝 PASO 2: Iniciar sesión como admin" -ForegroundColor Yellow
Write-Host ""
Write-Host "   URL:      http://localhost:8000/login" -ForegroundColor White
Write-Host "   Email:    admin@seals.mx" -ForegroundColor Cyan
Write-Host "   Password: admin123" -ForegroundColor Cyan
Write-Host ""
Write-Host "   ✅ REDIRECCIÓN AUTOMÁTICA a /admin/products" -ForegroundColor Green
Write-Host ""

Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host "                                    FUNCIONALIDADES DISPONIBLES" -ForegroundColor Yellow
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "✅ Ver TODOS los productos del sistema" -ForegroundColor Green
Write-Host "✅ Filtrar por búsqueda, categoría, vendedor y estado" -ForegroundColor Green
Write-Host "✅ Editar cualquier producto" -ForegroundColor Green
Write-Host "✅ Cambiar el vendedor de un producto (exclusivo admin)" -ForegroundColor Green
Write-Host "✅ Actualizar imágenes de productos" -ForegroundColor Green
Write-Host "✅ Activar/desactivar productos" -ForegroundColor Green
Write-Host "✅ Marcar productos como destacados" -ForegroundColor Green
Write-Host "✅ Eliminar productos del sistema" -ForegroundColor Green
Write-Host ""

Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host "                                    DIFERENCIAS CON VENDEDOR" -ForegroundColor Yellow
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "  Característica" -NoNewline -ForegroundColor White
Write-Host "                    │ " -NoNewline -ForegroundColor DarkGray
Write-Host "Vendedor" -NoNewline -ForegroundColor Yellow
Write-Host "           │ " -NoNewline -ForegroundColor DarkGray
Write-Host "Admin Supremo" -ForegroundColor Cyan
Write-Host "  ──────────────────────────────────┼──────────────────┼──────────────────" -ForegroundColor DarkGray
Write-Host "  Productos visibles" -NoNewline -ForegroundColor White
Write-Host "                │ " -NoNewline -ForegroundColor DarkGray
Write-Host "Solo propios" -NoNewline -ForegroundColor Yellow
Write-Host "     │ " -NoNewline -ForegroundColor DarkGray
Write-Host "Todos del sistema" -ForegroundColor Cyan
Write-Host "  Cambiar vendedor" -NoNewline -ForegroundColor White
Write-Host "                  │ " -NoNewline -ForegroundColor DarkGray
Write-Host "❌ No" -NoNewline -ForegroundColor Red
Write-Host "             │ " -NoNewline -ForegroundColor DarkGray
Write-Host "✅ Sí" -ForegroundColor Green
Write-Host "  Ver info vendedor" -NoNewline -ForegroundColor White
Write-Host "                 │ " -NoNewline -ForegroundColor DarkGray
Write-Host "-" -NoNewline -ForegroundColor DarkGray
Write-Host "                │ " -NoNewline -ForegroundColor DarkGray
Write-Host "✅ Sí (nombre+email)" -ForegroundColor Green
Write-Host "  Filtrar por vendedor" -NoNewline -ForegroundColor White
Write-Host "             │ " -NoNewline -ForegroundColor DarkGray
Write-Host "❌ No" -NoNewline -ForegroundColor Red
Write-Host "             │ " -NoNewline -ForegroundColor DarkGray
Write-Host "✅ Sí" -ForegroundColor Green
Write-Host "  Eliminar productos ajenos" -NoNewline -ForegroundColor White
Write-Host "        │ " -NoNewline -ForegroundColor DarkGray
Write-Host "❌ No" -NoNewline -ForegroundColor Red
Write-Host "             │ " -NoNewline -ForegroundColor DarkGray
Write-Host "✅ Sí" -ForegroundColor Green
Write-Host ""

Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host "                                      ARCHIVOS DE AYUDA" -ForegroundColor Yellow
Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "📄 INICIO_ADMIN.md" -ForegroundColor Cyan
Write-Host "   Guía rápida de inicio" -ForegroundColor White
Write-Host ""
Write-Host "📄 CREDENCIALES_ADMIN.md" -ForegroundColor Cyan
Write-Host "   Todas las credenciales de usuarios de prueba" -ForegroundColor White
Write-Host ""
Write-Host "📄 ADMIN_PRODUCTS_COMPLETED.md" -ForegroundColor Cyan
Write-Host "   Resumen completo de la implementación" -ForegroundColor White
Write-Host ""
Write-Host "📄 docs/ADMIN_PRODUCTS.md" -ForegroundColor Cyan
Write-Host "   Documentación técnica detallada" -ForegroundColor White
Write-Host ""

Write-Host "========================================================================================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "🚀 ¿Quieres iniciar el servidor ahora? (S/N): " -NoNewline -ForegroundColor Yellow
$respuesta = Read-Host

if ($respuesta -eq "S" -or $respuesta -eq "s") {
    Write-Host ""
    Write-Host "🚀 Iniciando servidor Laravel..." -ForegroundColor Green
    Write-Host ""
    php artisan serve
} else {
    Write-Host ""
    Write-Host "✅ Recuerda iniciar el servidor con: php artisan serve" -ForegroundColor Yellow
    Write-Host ""
}
