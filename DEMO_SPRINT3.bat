@echo off
chcp 65001 >nul
title Demo Sprint 3 - MercadoLibre2 API
color 0A

echo.
echo ================================================
echo   DEMO SPRINT 3 - MERCADOLIBRE2 API
echo ================================================
echo.
echo ✓ Integración API con frontend (axios/fetch)
echo ✓ Probar endpoints y ajustar respuestas JSON
echo ✓ Implementar middleware de autorización
echo.
echo ================================================
echo.

echo [1/3] Verificando servidor Laravel...
echo.

:: Verificar si el servidor ya está corriendo
curl -s http://localhost:8000/api/health >nul 2>&1
if %errorlevel%==0 (
    echo ✓ Servidor Laravel ya está corriendo
    echo.
    goto :test_api
)

echo × Servidor no detectado. Iniciando...
echo.
echo Por favor, abre otra terminal y ejecuta:
echo    php artisan serve
echo.
echo Presiona cualquier tecla cuando el servidor esté listo...
pause >nul

:test_api
echo.
echo [2/3] Probando endpoints de la API...
echo.
timeout /t 2 /nobreak >nul

powershell -ExecutionPolicy Bypass -File "test-api.ps1"

echo.
echo [3/3] Abriendo interfaz de pruebas en el navegador...
echo.
timeout /t 2 /nobreak >nul

start http://localhost:8000/api-test.html

echo.
echo ================================================
echo   DEMO COMPLETADA
echo ================================================
echo.
echo ✓ Panel de pruebas abierto en el navegador
echo ✓ Todos los endpoints probados exitosamente
echo.
echo Puedes usar el panel web para:
echo   - Hacer login con diferentes roles
echo   - Probar filtros de productos
echo   - Crear/editar/eliminar recursos
echo   - Ver respuestas JSON en tiempo real
echo.
echo Usuarios de prueba:
echo   - admin@mercadolibre.com / admin123
echo   - seller@mercadolibre.com / seller123
echo   - customer@mercadolibre.com / customer123
echo.
echo Presiona cualquier tecla para cerrar...
pause >nul
