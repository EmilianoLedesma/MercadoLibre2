# Guarda este archivo como test_login_session.ps1 y ejecútalo en PowerShell desde la carpeta del proyecto.
$session = New-Object Microsoft.PowerShell.Commands.WebRequestSession

# 1) Obtener la página de login para recibir cookies (XSRF-TOKEN y laravel-session)
Write-Host "1) GET /login ..."
$r1 = Invoke-WebRequest -Uri 'http://127.0.0.1:8000/login' -WebSession $session -Headers @{ 'Accept' = 'application/json' } -ErrorAction SilentlyContinue
Write-Host "GET /login StatusCode:" $r1.StatusCode

# 2) Extraer XSRF-TOKEN (si existe)
$cookie = $session.Cookies.GetCookies('http://127.0.0.1') | Where-Object { $_.Name -eq 'XSRF-TOKEN' }
if ($cookie) {
    $xsrf = [System.Uri]::UnescapeDataString($cookie.Value)
    Write-Host "XSRF token encontrado."
} else {
    $xsrf = $null
    Write-Host "No se encontró XSRF-TOKEN en las cookies."
}

# 3) Preparar body de login (form data)
$body = @{ email = 'juan.perez@gmail.com'; password = 'password123' }

# 4) POST a /login usando la sesión y el header X-XSRF-TOKEN si lo tenemos
Write-Host "2) POST /login ..."
$headers = @{ 'Accept' = 'application/json' }
if ($xsrf) { $headers['X-XSRF-TOKEN'] = $xsrf }
$r2 = Invoke-WebRequest -Method Post -Uri 'http://127.0.0.1:8000/login' -Body $body -WebSession $session -Headers $headers -ErrorAction SilentlyContinue

if ($r2) {
    Write-Host "POST /login StatusCode:" $r2.StatusCode
    $len = if ($r2.Content) { [Math]::Min(1000, $r2.Content.Length) } else { 0 }
    if ($len -gt 0) {
        Write-Host "Respuesta (primeros $len caracteres):"
        $r2.Content.Substring(0,$len) | Write-Output
    } else { Write-Host "Sin contenido en la respuesta POST." }
} else {
    Write-Host "POST /login no devolvió respuesta (posible error de conexión)."
}

# 5) GET /account usando la misma sesión (cookies)
Write-Host "3) GET /account (misma sesión) ..."
$r3 = Invoke-WebRequest -Method Get -Uri 'http://127.0.0.1:8000/account' -WebSession $session -Headers @{ 'Accept' = 'application/json' } -ErrorAction SilentlyContinue

if ($r3) {
    Write-Host "GET /account StatusCode:" $r3.StatusCode
    $len2 = if ($r3.Content) { [Math]::Min(2000, $r3.Content.Length) } else { 0 }
    if ($len2 -gt 0) {
        Write-Host "Respuesta /account (primeros $len2 caracteres):"
        $r3.Content.Substring(0,$len2) | Write-Output
    } else { Write-Host "Sin contenido en la respuesta /account." }
} else {
    Write-Host "GET /account no devolvió respuesta (posible error de conexión)."
}

# 6) Información adicional: mostrar cookies de sesión actuales
Write-Host "Cookies actuales:"
$session.Cookies.GetCookies('http://127.0.0.1') | ForEach-Object { Write-Host "$($_.Name) = $($_.Value.Substring(0,[Math]::Min(60,$_.Value.Length)))..." }