@extends('layouts.app')

@section('title', 'Ofertas y Promociones')

@section('content')
@include('layouts.navbar')

<!-- HERO OFERTAS -->
<section style="background-color: #F8F8F8; padding: 80px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <div style="display: inline-block; background-color: #EE403D; color: white; padding: 8px 20px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(238, 64, 61, 0.3);">
            🔥 HOT DEALS
        </div>
        <h1 style="font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0; line-height: 1.1;">
            Ofertas y Promociones
        </h1>
        <p style="font-size: 18px; color: #666; max-width: 600px; margin: 0 auto;">
            Descubre los mejores descuentos en productos seleccionados. ¡Aprovecha antes de que se acaben!
        </p>
    </div>
</section>

<!-- FLASH SALES -->
<section style="padding: 60px 0; background-color: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="background-color: white; border: 2px solid #EE403D; border-radius: 12px; padding: 40px; margin-bottom: 60px; position: relative; overflow: hidden; box-shadow: 0 4px 16px rgba(238, 64, 61, 0.12);">
            <!-- Decorative elements -->
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(238, 64, 61, 0.05); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -80px; left: -80px; width: 250px; height: 250px; background: rgba(238, 64, 61, 0.03); border-radius: 50%;"></div>
            
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                    <div>
                        <div style="display: inline-flex; align-items: center; gap: 8px; background-color: #FEF2F2; padding: 8px 16px; border-radius: 20px; margin-bottom: 16px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EE403D" stroke-width="2.5">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                            </svg>
                            <span style="font-size: 13px; font-weight: 700; color: #EE403D; text-transform: uppercase; letter-spacing: 1px;">Ofertas Relámpago</span>
                        </div>
                        <h2 style="font-size: 32px; font-weight: 700; margin: 0 0 8px 0; color: #212529;">¡No te lo pierdas!</h2>
                        <p style="font-size: 16px; margin: 0; color: #666;">Descuentos especiales que terminan pronto</p>
                    </div>
                    
                    <!-- Countdown Timer -->
                    <div style="background-color: #F8F8F8; border: 1px solid #E5E5E5; border-radius: 10px; padding: 20px 30px; display: flex; align-items: center; gap: 18px;">
                        <div style="text-align: center;">
                            <div id="flash-hours" style="font-size: 32px; font-weight: 700; line-height: 1; color: #EE403D;">12</div>
                            <div style="font-size: 11px; margin-top: 4px; font-weight: 600; color: #666;">HORAS</div>
                        </div>
                        <div style="font-size: 24px; color: #D1D5DB;">:</div>
                        <div style="text-align: center;">
                            <div id="flash-minutes" style="font-size: 32px; font-weight: 700; line-height: 1; color: #EE403D;">30</div>
                            <div style="font-size: 11px; margin-top: 4px; font-weight: 600; color: #666;">MIN</div>
                        </div>
                        <div style="font-size: 24px; color: #D1D5DB;">:</div>
                        <div style="text-align: center;">
                            <div id="flash-seconds" style="font-size: 32px; font-weight: 700; line-height: 1; color: #EE403D;">45</div>
                            <div style="font-size: 11px; margin-top: 4px; font-weight: 600; color: #666;">SEG</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
            @forelse($products as $product)
                @if($product->hasDiscount())
                <!-- Product Card -->
                <div style="background-color: white; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.08); cursor: pointer; display: flex; flex-direction: column; position: relative;" 
                     onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.12)';" 
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)';" 
                     onclick="window.location.href='{{ route('shop.show', $product->slug) }}'">
                    
                    <!-- Discount Badge -->
                    <div style="position: absolute; top: 12px; left: 12px; background: linear-gradient(135deg, #E32020 0%, #C41E1E 100%); color: white; padding: 8px 14px; border-radius: 8px; z-index: 10; box-shadow: 0 4px 12px rgba(227, 32, 32, 0.4);">
                        <div style="font-size: 18px; font-weight: 700; line-height: 1;">-{{ $product->discount_percentage }}%</div>
                        <div style="font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9;">OFF</div>
                    </div>

                    @if($product->stock_quantity <= 5)
                        <div style="position: absolute; top: 12px; right: 12px; background: #FF9800; color: white; padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; z-index: 10;">
                            ¡ÚLTIMAS {{ $product->stock_quantity }}!
                        </div>
                    @endif
                    
                    <div style="position: relative; width: 100%; height: 280px; overflow: hidden; background-color: #F8F9FA; display: flex; align-items: center; justify-content: center; padding: 20px;">
                        @php
                            $images = is_array($product->images) ? $product->images : (is_string($product->images) ? json_decode($product->images, true) : []);
                            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                            $imageUrl = $firstImage ? (filter_var($firstImage, FILTER_VALIDATE_URL) ? $firstImage : asset('storage/' . $firstImage)) : asset('images/placeholder-product.svg');
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" loading="lazy">
                    </div>
                    
                    <div style="padding: 24px; flex: 1; display: flex; flex-direction: column;">
                        <h4 style="font-size: 15px; font-weight: 600; color: #212529; margin: 0 0 10px 0; line-height: 1.4; min-height: 42px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $product->name }}</h4>
                        
                        <div style="display: flex; align-items: baseline; gap: 10px; margin-bottom: 18px;">
                            <span style="font-size: 13px; color: #999; text-decoration: line-through; font-weight: 500;">${{ number_format($product->price, 2) }}</span>
                            <span style="font-size: 24px; font-weight: 700; color: #E32020;">${{ number_format($product->sale_price, 2) }}</span>
                        </div>
                        
                        <div style="margin-bottom: 18px;">
                            <div style="font-size: 12px; color: #666; margin-bottom: 6px;">Ahorras: ${{ number_format($product->price - $product->sale_price, 2) }}</div>
                            <!-- Progress bar -->
                            @php
                                $soldPercentage = min(100, ($product->stock_quantity > 0 ? ((100 - $product->stock_quantity) / 100) * 100 : 0));
                            @endphp
                            <div style="width: 100%; height: 6px; background: #E5E5E5; border-radius: 3px; overflow: hidden;">
                                <div style="width: {{ $soldPercentage }}%; height: 100%; background: linear-gradient(90deg, #EE403D 0%, #E32020 100%); transition: width 0.3s;"></div>
                            </div>
                        </div>
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" onclick="event.stopPropagation();" style="margin-top: auto;">
                            @csrf
                            <button type="submit" style="width: 100%; background-color: #212529; color: white; border: none; padding: 14px; font-size: 13px; font-weight: 700; border-radius: 6px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;" 
                                onmouseover="this.style.backgroundColor='#EE403D'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(238, 64, 61, 0.3)';" 
                                onmouseout="this.style.backgroundColor='#212529'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                Agregar al Carrito
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <div style="font-size: 64px; margin-bottom: 20px;">🎁</div>
                    <h3 style="font-size: 24px; color: #212529; margin-bottom: 12px;">No hay ofertas disponibles</h3>
                    <p style="color: #666; margin-bottom: 24px;">Por el momento no tenemos productos en oferta. ¡Vuelve pronto!</p>
                    <a href="{{ route('shop.index') }}" style="display: inline-block; background-color: #EE403D; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        Ver Todos los Productos
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- BENEFITS SECTION -->
<section style="padding: 60px 0; background-color: #F8F8F8;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div style="text-align: center; padding: 30px 20px; background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="width: 64px; height: 64px; background: #FEF2F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#EE403D" stroke-width="2">
                        <path d="M20 7h-4V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                    </svg>
                </div>
                <h4 style="font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 8px 0;">Ofertas Exclusivas</h4>
                <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">Descuentos especiales solo para ti</p>
            </div>
            
            <div style="text-align: center; padding: 30px 20px; background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="width: 64px; height: 64px; background: #F0F9FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2196F3" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <h4 style="font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 8px 0;">Envío Gratis</h4>
                <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">En compras mayores a $100</p>
            </div>
            
            <div style="text-align: center; padding: 30px 20px; background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="width: 64px; height: 64px; background: #F0FDF4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h4 style="font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 8px 0;">Garantía de Calidad</h4>
                <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">Productos 100% auténticos</p>
            </div>
            
            <div style="text-align: center; padding: 30px 20px; background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="width: 64px; height: 64px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h4 style="font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 8px 0;">Ofertas Limitadas</h4>
                <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">¡Aprovecha antes de que se agoten!</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Flash Sale Countdown (12 hours from now)
    const countdownDate = new Date();
    countdownDate.setHours(countdownDate.getHours() + 12);
    
    function updateFlashCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;
        
        const hours = Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        const flashHoursEl = document.getElementById('flash-hours');
        const flashMinutesEl = document.getElementById('flash-minutes');
        const flashSecondsEl = document.getElementById('flash-seconds');
        
        if (flashHoursEl) flashHoursEl.textContent = hours;
        if (flashMinutesEl) flashMinutesEl.textContent = minutes;
        if (flashSecondsEl) flashSecondsEl.textContent = seconds;
        
        if (distance < 0) {
            clearInterval(flashInterval);
            if (flashHoursEl) flashHoursEl.textContent = '0';
            if (flashMinutesEl) flashMinutesEl.textContent = '0';
            if (flashSecondsEl) flashSecondsEl.textContent = '0';
        }
    }
    
    updateFlashCountdown();
    const flashInterval = setInterval(updateFlashCountdown, 1000);
});
</script>
@endpush

@endsection
