# Test rápido de login
$API_URL = "http://localhost:8000/api"

Write-Host "Probando login..." -ForegroundColor Yellow

$loginData = @{
    email = "admin@mercadolibre.com"
    password = "admin123"
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$API_URL/auth/login" `
        -Method Post `
        -ContentType "application/json" `
        -Body $loginData

    Write-Host "✓ Login exitoso!" -ForegroundColor Green
    Write-Host "Usuario: $($response.data.user.name)" -ForegroundColor Cyan
    Write-Host "Rol: $($response.data.user.role)" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "Token JWT:" -ForegroundColor Yellow
    Write-Host $response.data.access_token -ForegroundColor White

} catch {
    Write-Host "× Error:" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
}
