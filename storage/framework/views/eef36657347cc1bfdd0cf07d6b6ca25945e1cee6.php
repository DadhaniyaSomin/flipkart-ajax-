<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="container">
                       <h1> WELCOME ADMIN</h1>
                            <a href="<?php echo e(route('products.index')); ?>"><button type="button" class="btn btn-primary"> Producst</button></a>
                            <a href="<?php echo e(route('categories.index')); ?>"><button type="button" class="btn btn-primary"> Category</button></a>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views/home.blade.php ENDPATH**/ ?>