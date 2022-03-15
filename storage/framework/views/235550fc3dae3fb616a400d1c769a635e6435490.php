

<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: <?php echo config('templatesettings.name'); ?>

    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templatesettings::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/modules/templatesettings/index.blade.php ENDPATH**/ ?>