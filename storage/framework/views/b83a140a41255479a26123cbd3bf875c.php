<?php $__env->startSection('title', 'Mi Cuenta'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Page Title -->
<div style="background-color: #F5F6F2; padding: 60px 0 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-family: 'Jost', sans-serif; font-size: 48px; font-weight: 700; color: #212529; margin: 0 0 16px 0;">
            Mi Cuenta
        </h1>
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
            <a href="<?php echo e(route('home')); ?>" style="color: #666; text-decoration: none;">Inicio</a>
            <span style="color: #999;">›</span>
            <span style="color: #EE403D; font-weight: 500;">Mi Cuenta</span>
        </nav>
    </div>
</div>

<!-- Account Dashboard -->
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;">

            <!-- Sidebar Navigation -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <button class="account-nav-btn active" data-section="dashboard" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: #EE403D; color: white; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-chart-line" style="width: 20px;"></i>
                    <span>Dashboard</span>
                </button>

                <button class="account-nav-btn" data-section="orders" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-shopping-cart" style="width: 20px;"></i>
                    <span>Compras</span>
                </button>

                <button class="account-nav-btn" data-section="address" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-map-marker-alt" style="width: 20px;"></i>
                    <span>Direcciones</span>
                </button>

                <button class="account-nav-btn" data-section="details" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-user" style="width: 20px;"></i>
                    <span>Detalles de la Cuenta</span>
                </button>

                <a href="<?php echo e(route('wishlist.index')); ?>" style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s; text-decoration: none;">
                    <i class="fas fa-heart" style="width: 20px;"></i>
                    <span>Wishlist</span>
                </a>

                <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; color: #666; border: 1px solid #E5E5E5; border-radius: 8px; cursor: pointer; font-family: 'Jost', sans-serif; font-size: 15px; font-weight: 500; transition: all 0.3s;">
                        <i class="fas fa-sign-out-alt" style="width: 20px;"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

            <!-- Main Content Area -->
            <div>
                <?php if(auth()->guard()->check()): ?>
                <!-- Dashboard Section -->
                <div id="section-dashboard" class="account-section">
                    <!-- User Profile Header -->
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #EE403D 0%, #E32020 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: 700; flex-shrink: 0;">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                            <div>
                                <div style="font-size: 14px; color: #999; margin-bottom: 4px;">Hola,</div>
                                <div style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 600; color: #212529;"><?php echo e(Auth::user()->name); ?></div>
                                <div style="font-size: 14px; color: #999; margin-top: 4px;"><?php echo e(now()->format('F d, Y')); ?></div>
                            </div>
                        </div>
                        <p style="color: #666; line-height: 1.6; margin: 0; font-size: 15px;">
                            Desde el dashboard de tu cuenta puedes ver tus compras recientes, manejar tus dirección de envío y facturación, y editar tu contraseña y detalles de la cuenta.
                        </p>
                    </div>

                    <!-- Stats Grid -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="showSection('orders')" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #FEF3F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-shopping-cart" style="color: #EE403D; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Compras</div>
                            <div style="font-size: 28px; font-weight: 700; color: #212529;"><?php echo e($ordersCount ?? 0); ?></div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #F0F9FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-download" style="color: #3B82F6; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Facturación</div>
                            <div style="font-size: 28px; font-weight: 700; color: #212529;">0</div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="showSection('address')" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #F0FDF4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-map-marker-alt" style="color: #10B981; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Direcciones  </div>
                            <div style="font-size: 14px; font-weight: 500; color: #212529; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                <?php if(isset($addresses) && count($addresses) > 0): ?>
                                    <?php echo e($addresses[0]['street'] ?? 'Agregar Dirección'); ?>

                                <?php else: ?>
                                    Agregar Dirección
                                <?php endif; ?>
                            </div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="showSection('details')" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #FEF3F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-user" style="color: #EE403D; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Detalles de la Cuenta</div>
                            <div style="font-size: 14px; font-weight: 500; color: #212529;"><?php echo e(Auth::user()->email); ?></div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="window.location.href='<?php echo e(route('wishlist.index')); ?>'" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #FFF1F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-heart" style="color: #F43F5E; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Wishlist</div>
                            <div style="font-size: 28px; font-weight: 700; color: #212529;"><?php echo e(count(session()->get('wishlist', []))); ?></div>
                        </div>

                        <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.3s; cursor: pointer;" onclick="document.querySelector('form[action=\\'<?php echo e(route('logout')); ?>\\']').submit()" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                            <div style="width: 50px; height: 50px; background: #F5F5F5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-sign-out-alt" style="color: #666; font-size: 24px;"></i>
                            </div>
                            <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Logout</div>
                            <div style="font-size: 14px; font-weight: 500; color: #212529;">Sign Out</div>
                        </div>
                    </div>
                </div>

                <!-- Orders Section -->
                <div id="section-orders" class="account-section" style="display: none;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 24px 0;">
                            Mis compras
                        </h2>

                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #E5E5E5;">
                                        <th style="text-align: left; padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Pedido</th>
                                        <th style="text-align: left; padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Fecha</th>
                                        <th style="text-align: left; padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Estado</th>
                                        <th style="text-align: left; padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Total</th>
                                        <th style="text-align: left; padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; font-weight: 600; color: #666;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($orders) && $orders->count() > 0): ?>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="border-bottom: 1px solid #F5F5F5;">
                                            <td style="padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; color: #212529; font-weight: 600;">
                                                #<?php echo e($order->order_number); ?>

                                            </td>
                                            <td style="padding: 16px; font-family: 'Jost', sans-serif; font-size: 14px; color: #666;">
                                                <?php echo e($order->created_at->format('d M, Y')); ?>

                                            </td>
                                            <td style="padding: 16px;">
                                                <?php if($order->status === 'pending'): ?>
                                                    <span style="display: inline-block; padding: 6px 12px; background: #FEF3C7; color: #D97706; border-radius: 6px; font-size: 13px; font-weight: 500;">Pendiente</span>
                                                <?php elseif($order->status === 'processing'): ?>
                                                    <span style="display: inline-block; padding: 6px 12px; background: #DBEAFE; color: #2563EB; border-radius: 6px; font-size: 13px; font-weight: 500;">Procesando</span>
                                                <?php elseif($order->status === 'completed'): ?>
                                                    <span style="display: inline-block; padding: 6px 12px; background: #D1FAE5; color: #059669; border-radius: 6px; font-size: 13px; font-weight: 500;">Completado</span>
                                                <?php elseif($order->status === 'cancelled'): ?>
                                                    <span style="display: inline-block; padding: 6px 12px; background: #FEE2E2; color: #DC2626; border-radius: 6px; font-size: 13px; font-weight: 500;">Cancelado</span>
                                                <?php else: ?>
                                                    <span style="display: inline-block; padding: 6px 12px; background: #F3F4F6; color: #6B7280; border-radius: 6px; font-size: 13px; font-weight: 500;"><?php echo e(ucfirst($order->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 16px; font-family: 'Jost', sans-serif; font-size: 15px; color: #212529; font-weight: 600;">
                                                $<?php echo e(number_format($order->total, 2)); ?>

                                            </td>
                                            <td style="padding: 16px;">
                                                <a href="<?php echo e(route('checkout.confirmation', $order->id)); ?>" style="display: inline-block; padding: 8px 16px; background: #EE403D; color: white; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 500; transition: background 0.3s;" onmouseover="this.style.background='#E32020'" onmouseout="this.style.background='#EE403D'">
                                                    Ver detalles
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" style="text-align: center; padding: 48px 16px; color: #999; font-size: 15px;">
                                                Sin compras. <a href="<?php echo e(route('shop.index')); ?>" style="color: #EE403D; text-decoration: none; font-weight: 500;">Empieza a comprar</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div id="section-address" class="account-section" style="display: none;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                            <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0;">
                                Direcciones
                            </h2>
                            <button id="add-address" type="button" style="background: #10B981; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 14px; transition: background 0.3s;">
                                <i class="fas fa-plus" style="margin-right: 8px;"></i>Agregar Dirección
                            </button>
                        </div>

                        <form method="POST" action="<?php echo e(route('account.addresses.save')); ?>" id="addresses-form">
                            <?php echo csrf_field(); ?>
                            <div id="addresses-list" style="display: grid; gap: 20px;">
                                <?php if(isset($addresses) && count($addresses)): ?>
                                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="address-item" style="border: 1px solid #E5E5E5; padding: 24px; border-radius: 12px; position: relative; background: #FAFAFA;">
                                        <input type="hidden" name="addresses[<?php echo e($idx); ?>][id]" value="<?php echo e($addr['id'] ?? ''); ?>">
                                        <button type="button" class="remove-address" style="position: absolute; right: 16px; top: 16px; background: #FEF2F2; border: none; color: #EF4444; cursor: pointer; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: all 0.3s;">
                                            <i class="fas fa-trash" style="margin-right: 6px;"></i>Eliminar
                                        </button>

                                        <div style="display: grid; grid-template-columns: 1fr 150px; gap: 16px; margin-bottom: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Calle</label>
                                                <input name="addresses[<?php echo e($idx); ?>][street]" value="<?php echo e(old('addresses.'.$idx.'.street', $addr['street'] ?? '')); ?>" placeholder="Nombre de la calle" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Número</label>
                                                <input name="addresses[<?php echo e($idx); ?>][number]" value="<?php echo e(old('addresses.'.$idx.'.number', $addr['number'] ?? '')); ?>" placeholder="Número" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>

                                        <div style="display: grid; grid-template-columns: 180px 1fr; gap: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Código Postal</label>
                                                <input name="addresses[<?php echo e($idx); ?>][postal_code]" value="<?php echo e(old('addresses.'.$idx.'.postal_code', $addr['postal_code'] ?? '')); ?>" placeholder="Código postal" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Información Adicional</label>
                                                <input name="addresses[<?php echo e($idx); ?>][note]" value="<?php echo e(old('addresses.'.$idx.'.note', $addr['note'] ?? '')); ?>" placeholder="Ciudad / Estado o referencia" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="address-item" style="border: 1px solid #E5E5E5; padding: 24px; border-radius: 12px; position: relative; background: #FAFAFA;">
                                        <button type="button" class="remove-address" style="position: absolute; right: 16px; top: 16px; background: #FEF2F2; border: none; color: #EF4444; cursor: pointer; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: all 0.3s;">
                                            <i class="fas fa-trash" style="margin-right: 6px;"></i>Eliminar
                                        </button>

                                        <div style="display: grid; grid-template-columns: 1fr 150px; gap: 16px; margin-bottom: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Calle</label>
                                                <input name="addresses[0][street]" placeholder="Nombre de la calle" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Número</label>
                                                <input name="addresses[0][number]" placeholder="Número" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>

                                        <div style="display: grid; grid-template-columns: 180px 1fr; gap: 16px;">
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Código Postal</label>
                                                <input name="addresses[0][postal_code]" placeholder="Código postal" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Información Adicional</label>
                                                <input name="addresses[0][note]" placeholder="Ciudad / Estado o referencia" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div style="display: flex; gap: 12px; margin-top: 24px;">
                                <button type="submit" style="background: #EE403D; color: white; border: none; padding: 14px 32px; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; cursor: pointer; transition: background 0.3s;">
                                    Save All Direcciones
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Detalles de la Cuenta Section -->
                <div id="section-details" class="account-section" style="display: none;">
                    <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 32px;">
                        <h2 style="font-family: 'Jost', sans-serif; font-size: 28px; font-weight: 700; color: #212529; margin: 0 0 24px 0;">
                            Detalles de la Cuenta
                        </h2>

                        <!-- Personal Info (Read-only) -->
                        <div style="margin-bottom: 32px; padding: 24px; background: #FAFAFA; border-radius: 8px;">
                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 20px 0;">
                                Información Personal
                            </h3>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #666; font-size: 13px;">Nombre Completo</label>
                                    <div style="padding: 12px 16px; background: white; border-radius: 6px; border: 1px solid #E5E5E5; color: #212529;">
                                        <?php echo e(Auth::user()->name); ?>

                                    </div>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #666; font-size: 13px;">Correo Electrónico</label>
                                    <div style="padding: 12px 16px; background: white; border-radius: 6px; border: 1px solid #E5E5E5; color: #212529;">
                                        <?php echo e(Auth::user()->email); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actualizar Teléfono -->
                        <form method="POST" action="<?php echo e(route('account.update')); ?>" style="margin-bottom: 32px;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #212529; margin: 0 0 20px 0;">
                                Actualizar Número de Teléfono
                            </h3>

                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;">Número de Teléfono</label>
                                <input type="tel" name="phone" value="<?php echo e(old('phone', optional(Auth::user())->phone)); ?>" placeholder="Tu número de teléfono" style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: 'Jost', sans-serif; font-size: 15px;">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div style="color: #EF4444; font-size: 13px; margin-top: 6px;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <button type="submit" style="background: #EE403D; color: white; border: none; padding: 12px 28px; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; cursor: pointer; transition: background 0.3s;">
                                Actualizar Teléfono
                            </button>
                        </form>

                        <!-- Zona Peligrosa -->
                        <div style="border-top: 1px solid #E5E5E5; padding-top: 32px;">
                            <h3 style="font-family: 'Jost', sans-serif; font-size: 18px; font-weight: 600; color: #EF4444; margin: 0 0 12px 0;">
                                Zona Peligrosa
                            </h3>
                            <p style="color: #666; margin: 0 0 16px 0; font-size: 14px;">
                                Una vez que elimines tu cuenta, no hay vuelta atrás. Por favor, ten certeza.
                            </p>
                            <button type="button" onclick="showDeleteModal()" style="background: #FEF2F2; color: #EF4444; border: 1px solid #EF4444; padding: 12px 28px; border-radius: 8px; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px; cursor: pointer; transition: all 0.3s;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>Eliminar Cuenta
                            </button>
                        </div>
                    </div>
                </div>

                <?php else: ?>
                <div style="background: white; border: 1px solid #E5E5E5; border-radius: 12px; padding: 48px; text-align: center;">
                    <i class="fas fa-user-lock" style="font-size: 64px; color: #E5E5E5; margin-bottom: 24px;"></i>
                    <h2 style="font-family: 'Jost', sans-serif; font-size: 24px; font-weight: 600; color: #212529; margin: 0 0 12px 0;">
                        Please Sign In
                    </h2>
                    <p style="color: #666; margin: 0 0 24px 0;">You need to be logged in to access your account dashboard.</p>
                    <a href="<?php echo e(route('login')); ?>" style="display: inline-block; background: #EE403D; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; font-family: 'Jost', sans-serif; font-size: 15px;">
                        Sign In
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('components.delete-account-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.account-nav-btn:hover {
    background: #FEF3F2 !important;
    border-color: #EE403D !important;
    color: #EE403D !important;
}

.account-nav-btn.active {
    background: #EE403D !important;
    color: white !important;
    border-color: #EE403D !important;
}

.remove-address:hover {
    background: #EF4444 !important;
    color: white !important;
}

#add-address:hover {
    background: #059669 !important;
}

@media (max-width: 768px) {
    section > div > div {
        grid-template-columns: 1fr !important;
    }

    #section-dashboard > div:last-child {
        grid-template-columns: 1fr !important;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Section Navigation
function showSection(sectionName) {
    // Hide all sections
    document.querySelectorAll('.account-section').forEach(section => {
        section.style.display = 'none';
    });

    // Show selected section
    document.getElementById('section-' + sectionName).style.display = 'block';

    // Update active button
    document.querySelectorAll('.account-nav-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.background = 'white';
        btn.style.color = '#666';
        btn.style.borderColor = '#E5E5E5';
    });

    const activeBtn = document.querySelector(`[data-section="${sectionName}"]`);
    if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.style.background = '#EE403D';
        activeBtn.style.color = 'white';
        activeBtn.style.borderColor = '#EE403D';
    }
}

// Navigation button click handlers
document.querySelectorAll('.account-nav-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const section = this.getAttribute('data-section');
        showSection(section);
    });
});

// Address Management
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-address');
    const list = document.getElementById('addresses-list');

    function createAddressItem(index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'address-item';
        wrapper.style = 'border: 1px solid #E5E5E5; padding: 24px; border-radius: 12px; position: relative; background: #FAFAFA;';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-address';
        removeBtn.innerHTML = '<i class="fas fa-trash" style="margin-right: 6px;"></i>Eliminar';
        removeBtn.style = 'position: absolute; right: 16px; top: 16px; background: #FEF2F2; border: none; color: #EF4444; cursor: pointer; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: all 0.3s;';
        removeBtn.addEventListener('click', () => wrapper.remove());

        wrapper.appendChild(removeBtn);

        const row1 = document.createElement('div');
        row1.style = 'display: grid; grid-template-columns: 1fr 150px; gap: 16px; margin-bottom: 16px;';

        const streetDiv = document.createElement('div');
        const streetLabel = document.createElement('label');
        streetLabel.textContent = 'Calle';
        streetLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const street = document.createElement('input');
        street.name = `addresses[${index}][street]`;
        street.placeholder = 'Nombre de la calle';
        street.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        streetDiv.appendChild(streetLabel);
        streetDiv.appendChild(street);

        const numberDiv = document.createElement('div');
        const numberLabel = document.createElement('label');
        numberLabel.textContent = 'Número';
        numberLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const number = document.createElement('input');
        number.name = `addresses[${index}][number]`;
        number.placeholder = 'Número';
        number.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        numberDiv.appendChild(numberLabel);
        numberDiv.appendChild(number);

        row1.appendChild(streetDiv);
        row1.appendChild(numberDiv);

        const row2 = document.createElement('div');
        row2.style = 'display: grid; grid-template-columns: 180px 1fr; gap: 16px;';

        const postalDiv = document.createElement('div');
        const postalLabel = document.createElement('label');
        postalLabel.textContent = 'Código Postal';
        postalLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const postal = document.createElement('input');
        postal.name = `addresses[${index}][postal_code]`;
        postal.placeholder = 'Código postal';
        postal.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        postalDiv.appendChild(postalLabel);
        postalDiv.appendChild(postal);

        const noteDiv = document.createElement('div');
        const noteLabel = document.createElement('label');
        noteLabel.textContent = 'Información Adicional';
        noteLabel.style = 'display: block; font-weight: 600; margin-bottom: 8px; color: #212529; font-size: 14px;';
        const note = document.createElement('input');
        note.name = `addresses[${index}][note]`;
        note.placeholder = 'Ciudad / Estado o referencia';
        note.style = 'width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #E5E5E5; font-family: \'Jost\', sans-serif; font-size: 15px;';
        noteDiv.appendChild(noteLabel);
        noteDiv.appendChild(note);

        row2.appendChild(postalDiv);
        row2.appendChild(noteDiv);

        wrapper.appendChild(row1);
        wrapper.appendChild(row2);

        return wrapper;
    }

    addBtn && addBtn.addEventListener('click', function () {
        const cur = list.querySelectorAll('.address-item').length;
        const item = createAddressItem(cur);
        list.appendChild(item);
    });

    document.querySelectorAll('.remove-address').forEach(btn => btn.addEventListener('click', function () {
        this.closest('.address-item')?.remove();
    }));
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/account/index.blade.php ENDPATH**/ ?>