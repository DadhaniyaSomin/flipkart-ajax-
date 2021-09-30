<?php $__env->startSection('content'); ?>
    <?php
    $categoryArr = [];
    if (!($products->category->isEmpty())) {
        foreach ($products->category as $c) {
            $categoryArr[] = $c->category_id;
        }
    }
    ?>
    <div class="container">
        <form action="<?php echo e(route('products.update', $products->id)); ?>" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="text" name="id" value="<?php echo e($products->id); ?>" hidden>

            <div class="mb-3">
                <label for="Product name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Enter the name"
                    value="<?php echo e($products->name); ?>">
                <?php if($errors->has('name')): ?>
                    <div class="text-danger"><?php echo e($errors->first('name')); ?></div>
                <?php endif; ?>

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" id="" name="des" rows="3"><?php echo e($products->description); ?></textarea>
                <?php if($errors->has('des')): ?>
                    <div class="text-danger"><?php echo e($errors->first('des')); ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="Product price" class="form-label">price</label>
                <input type="" class="form-control" name="price" id="" placeholder="Enter the price"
                    value="<?php echo e($products->price); ?>">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>selct category</label>
                    <select class="form-control" multiple data-live-search="true" name="category[]">

                        <option value=""> select category</option>
                        
                        <?php if(!$category->isEmpty()): ?>
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($o->id); ?>"
                                    <?php echo e(in_array($o->id, $categoryArr) ? 'selected' : ' '); ?>><?php echo e($o->c_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views\products\edit.blade.php ENDPATH**/ ?>