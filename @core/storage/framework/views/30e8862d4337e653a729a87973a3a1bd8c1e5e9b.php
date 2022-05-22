
<?php echo $__env->make('frontend.partials.pages-portion.footers.footer-'.get_footer_style(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="scroll-to-top">
    <i class="las la-chevron-up"></i>
</div>



 

<script src="<?php echo e(asset('assets/frontend/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.min-v4.6.0.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<!--<script src="<?php echo e(asset('assets/frontend/js/compress.js')); ?>"></script>-->
<script src="<?php echo e(asset('assets/frontend/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.fancybox.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/lazy.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/lazy.plugin.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>



<?php if(!empty(get_static_option('site_google_captcha_v3_site_key'))): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        (function() {
            "use strict";
            grecaptcha.ready(function () {
                grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {
                    if(document.getElementById('gcaptcha_token') != null){
                        document.getElementById('gcaptcha_token').value = token;
                    }
                });
            });
        })(jQuery);

    </script>
<?php endif; ?>

    <?php $twak__api = get_static_option('site_third_party_tracking_code'); ?>
    <?php if(!empty($twak__api)): ?>
        <?php echo $twak__api; ?>

    <?php endif; ?>

<script>

    //RTL RIGHT INner Bar
    var enable_rtl = "<?php echo e(get_user_lang_direction() === 'rtl'); ?>";
    if(enable_rtl){
        document.getElementById("mySidebar").style.transform = "translateX(100%)";

        function w3_close() {
            document.getElementById("mySidebar").style.transform = "translateX(100%)";
        }
    }

</script>

    <?php echo $__env->make('frontend.partials.inline-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>


</body>
</html>
<?php /**PATH C:\xampp\htdocs\dashboard\rasd\@core\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>