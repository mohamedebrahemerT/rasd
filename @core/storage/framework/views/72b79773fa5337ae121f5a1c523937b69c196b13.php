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
});<?php /**PATH /home/u939890021/domains/rasd.news/public_html/@core/resources/views/components/frontend/language-change.blade.php ENDPATH**/ ?>