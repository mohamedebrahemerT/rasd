$(document).on('change','#langchange',function(e){
    $.ajax({
        url : "<?php echo e(route('frontend.langchange')); ?>",
        type: "GET",
    data:{
     'lang' : $(this).val()
    },
    success:function (data) {
        location.reload();
    }
    })
});<?php /**PATH C:\xampp\htdocs\dashboard\rasd\@core\resources\views/components/frontend/language-change.blade.php ENDPATH**/ ?>