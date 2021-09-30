<?php $__env->startSection('content'); ?>
    <div class="container">
        <form action="<?php echo e(route('products.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            

            <div class="mb-3">
                <label for="Product name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Enter the name">
                <?php if($errors->has('name')): ?>
                    <div class="text-danger"><?php echo e($errors->first('name')); ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" id="" name="des" rows="3"></textarea>
                <?php if($errors->has('des')): ?>
                    <div class="text-danger"><?php echo e($errors->first('des')); ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Select Product image</label>
                <input class="form-control" name="image" type="file" id="image">
                <?php if($errors->has('image')): ?>
                    <div class="text-danger"><?php echo e($errors->first('image')); ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="Product price" class="form-label">price</label>
                <input type="text" class="form-control" name="price" id="" placeholder="Enter the price">
                <?php if($errors->has('price')): ?>
                    <div class="text-danger"><?php echo e($errors->first('price')); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>selct category</label>
                    <select class="form-control" multiple data-live-search="true" name="category[]">
                        <option value="" selected>select category</option>
                        <?php for($i = 0; $i < count($products1); $i++): ?>
                            <option value="<?php echo e($products1[$i]->id); ?>"><?php echo e($products1[$i]->c_name); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <?php if($errors->has('category')): ?>
                    <div class="text-danger"><?php echo e($errors->first('category')); ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views\products\create.blade.php ENDPATH**/ ?>