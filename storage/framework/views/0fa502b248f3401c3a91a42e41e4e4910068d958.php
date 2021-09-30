<?php $__env->startSection('content'); ?>
    <div class="container mb-3">
        <a href="<?php echo e(route('categories.create')); ?>"><button type="button" class="btn btn-light">ADD category</button></a>
    </div>
    <div class="container">

        <table id="myTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                   
                    <th>icon</th>
                   
                </tr>
            </thead>
            <tbody>
         
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

 <script >
    
    $(document).ready(function(){
       $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "<?php echo e(route('categories.index')); ?>",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'c_name',
                            name: 'c_name'
                        } 
                    ],
       });
         
    });
   
  </script>  

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views\categories\index.blade.php ENDPATH**/ ?>