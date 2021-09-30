<?php $__env->startSection('content'); ?>

    <div class="container">
        <form action="<?php echo e(route('categories.update', $category->id)); ?>" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="text" name="id" value="<?php echo e($category->id); ?>" hidden>
            <div class="mb-3">

                <label for="Product name" class="form-label">Name</label>
                <input type="text" class="form-control" id="" name="c_name" placeholder="Enter the name"
                    value="<?php echo e($category->c_name); ?>">
                <?php if($errors->has('c_name')): ?>
                    <div class="text-danger"><?php echo e($errors->first('c_name')); ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="c-name" class="form-label"> ADD Icons</label>
                <input type="file" class="form-control" id="icon" name="icon" placeholder="select icons">
                <img src="<?php echo e(url('icon/', $category->icon)); ?>" width="60" height="50">
                <?php if($errors->has('icon')): ?>
                    <div class="text-danger"><?php echo e($errors->first('icon')); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views\categories\edit.blade.php ENDPATH**/ ?>