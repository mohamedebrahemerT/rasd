<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type')); ?>">
        <?php echo session('msg'); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\dashboard\rasd\@core\resources\views/components/flash-msg.blade.php ENDPATH**/ ?>