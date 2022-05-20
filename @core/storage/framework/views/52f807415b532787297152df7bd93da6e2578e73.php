$(document).on('click','.import',function () {
    $(this).addClass("disabled")
    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e(__("Importing..")); ?>');
});<?php /**PATH /home/xgenxchi/public_html/laravel/katerio/@core/resources/views/components/btn/import.blade.php ENDPATH**/ ?>