<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('categories.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field("POST"); ?>
            <input type="text" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>" hidden>
            <div class="mb-3">
                <label for="c-name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="" name="c_name" placeholder="Enter the name">
                <?php if($errors->has('c_name')): ?>
                    <div class="text-danger"><?php echo e($errors->first('c_name')); ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="c-name" class="form-label"> ADD Icons</label>
                <input type="file" class="form-control" id="icon" name="icon" placeholder="select icons">
                <?php if($errors->has('icon')): ?>
                    <div class="text-danger"><?php echo e($errors->first('icon')); ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views\categories\create.blade.php ENDPATH**/ ?>