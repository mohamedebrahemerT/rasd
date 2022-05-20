$('.icp-dd').iconpicker();
     $('.icp-dd').on('iconpickerSelected', function (e) {
    var selectedIcon = e.iconpickerValue;
    $(this).parent().parent().children('input').val(selectedIcon);
});<?php /**PATH /home/u939890021/domains/rasd.news/public_html/@core/resources/views/components/icon-picker.blade.php ENDPATH**/ ?>