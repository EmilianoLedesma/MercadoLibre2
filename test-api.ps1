# Script PowerShell para probar la API
# Ejecuta este script en PowerShell: .\test-api.ps1

$API_URL = "http://localhost:8000/api"

Write-Host "================================================" -ForegroundColor Cyan
Write-Host "  API Testing - MercadoLibre2 Sprint 3" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# 1. Health Check
Write-Host "1. Verificando salud de la API..." -ForegroundColor Yellow
try {
    $health = Invoke-RestMethod -Uri "$API_URL/health" -Method Get
    Write-Host "   ✓ API funcionando correctamente" -ForegroundColor Green
    Write-Host "   Versión: $($health.version)" -ForegroundColor Gray
} catch {
    Write-Host "   ✗ Error: La API no está disponible" -ForegroundColor Red
    Write-Host "   Asegúrate de ejecutar: php artisan serve" -ForegroundColor Yellow
    exit
}

Write-Host ""

# 2. Login y obtener token JWT
Write-Host "2. Haciendo login y obteniendo token JWT..." -ForegroundColor Yellow

$loginData = @{
    email = "admin@mercadolibre.com"
    password = "admin123"
} | ConvertTo-Json

try {
    $loginResponse = Invoke-RestMethod -Uri "$API_URL/auth/login" `
        -Method Post `
        -ContentType "application/json" `
        -Body $loginData

    if ($loginResponse.success) {
        $token = $loginResponse.data.access_token
        Write-Host "   ✓ Login exitoso!" -ForegroundColor Green
        Write-Host "   Usuario: $($loginResponse.data.user.name)" -ForegroundColor Gray
        Write-Host "   Rol: $($loginResponse.data.user.role)" -ForegroundColor Gray
        Write-Host ""
        Write-Host "   TOKEN JWT:" -ForegroundColor Cyan
        Write-Host "   $token" -ForegroundColor White
        Write-Host ""
    }
} catch {
    Write-Host "   ✗ Error en login: $($_.Exception.Message)" -ForegroundColor Red
    exit
}

# 3. Obtener perfil usando el token
Write-Host "3. Obteniendo perfil del usuario autenticado..." -ForegroundColor Yellow

$headers = @{
    "Authorization" = "Bearer $token"
    "Accept" = "application/json"
}

try {
    $profile = Invoke-RestMethod -Uri "$API_URL/auth/me" `
        -Method Get `
        -Headers $headers

    Write-Host "   ✓ Perfil obtenido correctamente" -ForegroundColor Green
    Write-Host "   Email: $($profile.data.email)" -ForegroundColor Gray
} catch {
    Write-Host "   ✗ Error al obtener perfil" -ForegroundColor Red
}

Write-Host ""

# 4. Listar productos
Write-Host "4. Listando productos..." -ForegroundColor Yellow

try {
    $products = Invoke-RestMethod -Uri "$API_URL/products" `
        -Method Get `
        -Headers $headers

    if ($products.success) {
        $totalProducts = $products.data.pagination.total
        Write-Host "   ✓ Total de productos: $totalProducts" -ForegroundColor Green

        if ($totalProducts -gt 0) {
            Write-Host ""
            Write-Host "   Primeros 5 productos:" -ForegroundColor Gray
            foreach ($product in $products.data.products[0..4]) {
                if ($product) {
                    Write-Host "   - $($product.name) | Precio: \$$($product.price) | Stock: $($product.stock_quantity)" -ForegroundColor White
                }
            }
        }
    }
} catch {
    Write-Host "   ✗ Error al listar productos" -ForegroundColor Red
}

Write-Host ""

# 5. Listar categorías
Write-Host "5. Listando categorías..." -ForegroundColor Yellow

try {
    $categories = Invoke-RestMethod -Uri "$API_URL/categories" `
        -Method Get `
        -Headers $headers

    if ($categories.success) {
        $totalCategories = $categories.data.pagination.total
        Write-Host "   ✓ Total de categorías: $totalCategories" -ForegroundColor Green

        if ($totalCategories -gt 0) {
            Write-Host ""
            Write-Host "   Categorías disponibles:" -ForegroundColor Gray
            foreach ($category in $categories.data.categories) {
                Write-Host "   - ID: $($category.id) | $($category.name)" -ForegroundColor White
            }
        }
    }
} catch {
    Write-Host "   ✗ Error al listar categorías" -ForegroundColor Red
}

Write-Host ""

# 6. Crear un producto de prueba
Write-Host "6. Creando producto de prueba..." -ForegroundColor Yellow

$timestamp = [Math]::Floor((Get-Date).ToUniversalTime().Subtract((Get-Date "1970-01-01")).TotalSeconds)
$newProduct = @{
    name = "Producto Test $timestamp"
    sku = "TEST-$timestamp"
    price = 199.99
    stock_quantity = 15
    category_id = 1
    description = "Este es un producto de prueba creado desde PowerShell"
    is_active = $true
    is_featured = $false
} | ConvertTo-Json

try {
    $created = Invoke-RestMethod -Uri "$API_URL/products" `
        -Method Post `
        -Headers $headers `
        -ContentType "application/json" `
        -Body $newProduct

    if ($created.success) {
        Write-Host "   ✓ Producto creado exitosamente" -ForegroundColor Green
        Write-Host "   ID: $($created.data.id)" -ForegroundColor Gray
        Write-Host "   Nombre: $($created.data.name)" -ForegroundColor Gray
        Write-Host "   SKU: $($created.data.sku)" -ForegroundColor Gray
    }
} catch {
    $errorMessage = $_.ErrorDetails.Message | ConvertFrom-Json
    Write-Host "   ✗ Error al crear producto" -ForegroundColor Red
    Write-Host "   Razón: $($errorMessage.message)" -ForegroundColor Yellow
}

Write-Host ""

# 7. Buscar productos con filtros
Write-Host "7. Buscando productos con filtros (precio 0-500)..." -ForegroundColor Yellow

try {
    $filtered = Invoke-RestMethod -Uri "$API_URL/products?min_price=0&max_price=500&per_page=5" `
        -Method Get `
        -Headers $headers

    if ($filtered.success) {
        $count = $filtered.data.pagination.total
        Write-Host "   ✓ Encontrados: $count productos" -ForegroundColor Green
    }
} catch {
    Write-Host "   ✗ Error en búsqueda" -ForegroundColor Red
}

Write-Host ""
Write-Host "================================================" -ForegroundColor Cyan
Write-Host "  Testing completado!" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Tu TOKEN JWT (guárdalo para usarlo en Postman/Thunder Client):" -ForegroundColor Yellow
Write-Host "$token" -ForegroundColor White
Write-Host ""
Write-Host "Para probarlo en el navegador, abre:" -ForegroundColor Yellow
Write-Host "http://localhost:8000/api-test.html" -ForegroundColor Cyan
Write-Host ""
