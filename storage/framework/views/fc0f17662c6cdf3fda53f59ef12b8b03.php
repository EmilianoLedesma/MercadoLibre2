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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/clientes/index.blade.php ENDPATH**/ ?>