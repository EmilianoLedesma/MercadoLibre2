<?php $__env->startSection('title', 'Mi cuenta'); ?>

<?php $__env->startSection('content'); ?>
<section class="container" style="padding:32px 16px; max-width:1100px; margin:0 auto;">
    <div style="display:flex; gap:20px; flex-wrap:wrap;">
        <!-- Perfil -->
        <div style="flex:1 1 320px; background:#fff; padding:22px; border-radius:10px; box-shadow:0 6px 18px rgba(16,24,40,0.06);">
            <h2 style="margin:0 0 6px 0; font-size:20px;">Mi cuenta</h2>
            <p style="color:#6b7280; margin:0 0 18px 0;">Información personal</p>

            <?php if(auth()->guard()->check()): ?>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-weight:600; margin-bottom:6px;">Nombre</label>
                <div style="padding:10px; background:#F8FAFC; border-radius:8px;"><?php echo e(Auth::user()->name); ?></div>
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block; font-weight:600; margin-bottom:6px;">Correo electrónico</label>
                <div style="padding:10px; background:#F8FAFC; border-radius:8px;"><?php echo e(Auth::user()->email); ?></div>
            </div>

            <form method="POST" action="<?php echo e(route('clientes.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div style="margin-bottom:12px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">Teléfono</label>
                    <input type="tel" name="phone" value="<?php echo e(old('phone', optional(Auth::user())->phone)); ?>" placeholder="Número telefónico" style="width:100%; padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger" style="margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary" style="background:#111827; color:#fff; border:none; padding:10px 14px; border-radius:8px; font-weight:600;">Guardar</button>
                </div>
            </form>
            <?php else: ?>
            <p>Inicia sesión para ver y editar tu cuenta.</p>
            <?php endif; ?>
        </div>

        <!-- Direcciones -->
        <div style="flex:2 1 640px; background:#fff; padding:22px; border-radius:10px; box-shadow:0 6px 18px rgba(16,24,40,0.06);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <div>
                    <h2 style="margin:0; font-size:20px;">Direcciones</h2>
                    <p style="color:#6b7280; margin:4px 0 0 0;">Agrega una o varias direcciones de entrega</p>
                </div>
                <button id="add-address" type="button" style="background:#10B981; color:#fff; border:none; padding:8px 14px; border-radius:8px; cursor:pointer; font-weight:600;">Agregar dirección</button>
            </div>

            <form method="POST" action="<?php echo e(route('clientes.addresses.save')); ?>" id="addresses-form">
                <?php echo csrf_field(); ?>

                <div id="addresses-list" style="display:flex; flex-direction:column; gap:12px;">
                    <?php if(isset($addresses) && count($addresses)): ?>
                        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="address-item" style="border:1px solid #eef2f6; padding:12px; border-radius:8px; position:relative;">
                            <button type="button" class="remove-address" style="position:absolute; right:8px; top:8px; background:transparent; border:none; color:#ef4444; cursor:pointer;">Eliminar</button>

                            <div style="display:grid; grid-template-columns:1fr 120px; gap:10px; margin-bottom:8px;">
                                <input name="addresses[<?php echo e($idx); ?>][street]" value="<?php echo e(old('addresses.'.$idx.'.street', $addr['street'] ?? '')); ?>" placeholder="Calle" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                <input name="addresses[<?php echo e($idx); ?>][number]" value="<?php echo e(old('addresses.'.$idx.'.number', $addr['number'] ?? '')); ?>" placeholder="Número" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                            </div>

                            <div style="display:grid; grid-template-columns:160px 1fr; gap:10px;">
                                <input name="addresses[<?php echo e($idx); ?>][postal_code]" value="<?php echo e(old('addresses.'.$idx.'.postal_code', $addr['postal_code'] ?? '')); ?>" placeholder="Código postal" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                <input name="addresses[<?php echo e($idx); ?>][note]" value="<?php echo e(old('addresses.'.$idx.'.note', $addr['note'] ?? '')); ?>" placeholder="Indicación para ubicar (ej: piso, referencia)" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <!-- plantilla inicial -->
                        <div class="address-item" style="border:1px solid #eef2f6; padding:12px; border-radius:8px; position:relative;">
                            <button type="button" class="remove-address" style="position:absolute; right:8px; top:8px; background:transparent; border:none; color:#ef4444; cursor:pointer;">Eliminar</button>

                            <div style="display:grid; grid-template-columns:1fr 120px; gap:10px; margin-bottom:8px;">
                                <input name="addresses[0][street]" placeholder="Calle" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                <input name="addresses[0][number]" placeholder="Número" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                            </div>

                            <div style="display:grid; grid-template-columns:160px 1fr; gap:10px;">
                                <input name="addresses[0][postal_code]" placeholder="Código postal" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                                <input name="addresses[0][note]" placeholder="Indicación para ubicar (ej: piso, referencia)" style="padding:10px; border-radius:8px; border:1px solid #e6e6e6;">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:10px; margin-top:14px;">
                    <button type="submit" style="background:#111827; color:#fff; border:none; padding:10px 14px; border-radius:8px; font-weight:600;">Guardar direcciones</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-address');
    const list = document.getElementById('addresses-list');

    function createAddressItem(index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'address-item';
        wrapper.style = 'border:1px solid #eef2f6; padding:12px; border-radius:8px; position:relative;';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-address';
        removeBtn.textContent = 'Eliminar';
        removeBtn.style = 'position:absolute; right:8px; top:8px; background:transparent; border:none; color:#ef4444; cursor:pointer;';
        removeBtn.addEventListener('click', () => wrapper.remove());

        wrapper.appendChild(removeBtn);

        const row1 = document.createElement('div');
        row1.style = 'display:grid; grid-template-columns:1fr 120px; gap:10px; margin-bottom:8px;';

        const street = document.createElement('input');
        street.name = `addresses[${index}][street]`;
        street.placeholder = 'Calle';
        street.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        const number = document.createElement('input');
        number.name = `addresses[${index}][number]`;
        number.placeholder = 'Número';
        number.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        row1.appendChild(street);
        row1.appendChild(number);

        const row2 = document.createElement('div');
        row2.style = 'display:grid; grid-template-columns:160px 1fr; gap:10px;';

        const postal = document.createElement('input');
        postal.name = `addresses[${index}][postal_code]`;
        postal.placeholder = 'Código postal';
        postal.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        const note = document.createElement('input');
        note.name = `addresses[${index}][note]`;
        note.placeholder = 'Indicación para ubicar (ej: piso, referencia)';
        note.style = 'padding:10px; border-radius:8px; border:1px solid #e6e6e6;';

        row2.appendChild(postal);
        row2.appendChild(note);

        wrapper.appendChild(row1);
        wrapper.appendChild(row2);

        return wrapper;
    }

    addBtn && addBtn.addEventListener('click', function () {
        // compute next index
        const cur = list.querySelectorAll('.address-item').length;
        const item = createAddressItem(cur);
        list.appendChild(item);
    });

    // attach remove handlers to existing buttons
    document.querySelectorAll('.remove-address').forEach(btn => btn.addEventListener('click', function () {
        this.closest('.address-item')?.remove();
    }));
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('title', 'Clientes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="margin-top: 50px; padding: 0 20px;">
    <h1 style="margin-bottom: 30px;">Listado de Clientes/Usuarios</h1>

    <?php if(session('success')): ?>
        <div style="color: green; margin-bottom: 15px; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">ID</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Nombre</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Email</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Rol</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Teléfono</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Activo</th>
                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($cliente->id); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($cliente->name); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($cliente->email); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        <span style="padding: 4px 8px; border-radius: 4px; background:
                            <?php echo e($cliente->role == 'admin' ? '#007bff' : ($cliente->role == 'seller' ? '#28a745' : '#6c757d')); ?>;
                            color: white; font-size: 12px;">
                            <?php echo e(ucfirst($cliente->role)); ?>

                        </span>
                    </td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($cliente->phone ?? 'N/A'); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        <span style="color: <?php echo e($cliente->is_active ? 'green' : 'red'); ?>;">
                            <?php echo e($cliente->is_active ? 'Sí' : 'No'); ?>

                        </span>
                    </td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($cliente->created_at->format('d/m/Y H:i')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center; border: 1px solid #ddd;">
                        No hay clientes registrados
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="<?php echo e(route('home')); ?>" style="padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; display: inline-block;">Volver al Home</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views\clientes\index.blade.php ENDPATH**/ ?>