<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="delete-modal-overlay">
    <div class="delete-modal">
        <button class="modal-close" onclick="closeDeleteModal()">
            <i class="fas fa-times"></i>
        </button>

        <div class="modal-content">
            <div class="warning-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <h2 class="modal-title">Eliminar Cuenta</h2>
            <p class="modal-message">¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>

            <div class="modal-actions">
                <button onclick="closeDeleteModal()" class="btn-cancel">
                    Cancelar
                </button>
                <form action="<?php echo e(route('account.destroy')); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete">
                        Eliminar Cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.delete-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.delete-modal-overlay.show {
    opacity: 1;
}

.delete-modal {
    background: white;
    border-radius: 16px;
    max-width: 500px;
    width: 100%;
    padding: 48px 40px;
    position: relative;
    transform: scale(0.9);
    transition: transform 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.delete-modal-overlay.show .delete-modal {
    transform: scale(1);
}

.modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: none;
    border: none;
    font-size: 24px;
    color: #999;
    cursor: pointer;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s;
}

.modal-close:hover {
    background-color: #F5F6F2;
    color: #EE403D;
}

.modal-content {
    text-align: center;
}

.warning-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #EE403D 0%, #E32020 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    color: white;
    font-size: 36px;
}

.modal-title {
    font-family: 'Jost', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 12px;
}

.modal-message {
    font-family: 'Jost', sans-serif;
    font-size: 15px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 32px;
}

.modal-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
}

.btn-cancel {
    padding: 14px 28px;
    background-color: #F5F6F2;
    color: #666;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Jost', sans-serif;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-cancel:hover {
    background-color: #E5E6E2;
    color: #444;
}

.btn-delete {
    padding: 14px 28px;
    background-color: #EE403D;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Jost', sans-serif;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-delete:hover {
    background-color: #E32020;
}
</style>

<script>
function showDeleteModal() {
    const modal = document.getElementById('deleteAccountModal');
    modal.style.display = 'flex';
    // Trigger reflow to ensure transition works
    modal.offsetHeight;
    modal.classList.add('show');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteAccountModal');
    modal.classList.remove('show');
    // Wait for transition to finish before hiding
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}
</script><?php /**PATH C:\Users\Emiliano\Documents\UPQ SISTEMAS\7mo_Cuatrimestre\Programación Web\ML2 Seals Edition\MercadoLibre2\resources\views/components/delete-account-modal.blade.php ENDPATH**/ ?>