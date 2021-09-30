<?php $__env->startSection('content'); ?>


    <div tabindex="-1" class="modal pmd-modal fade" id="form-dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pmd-modal-border">
                    <h2 class="modal-title">Get In Touch</h2>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                </div>
                <div class="modal-body">
                    <form id="add_product">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="Product name" class="form-label">Product Name</label>
                            <input type="text" class="form-control rounded-3 name" id="" name="name"
                                placeholder="Enter the name">
                            <?php if($errors->has('name')): ?>
                                <div class="text-danger"><?php echo e($errors->first('name')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control  rounded-3  des" id="" name="des" rows="3"></textarea>
                            <?php if($errors->has('des')): ?>
                                <div class="text-danger"><?php echo e($errors->first('des')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select Product image</label>
                            <input class="form-control image" name="image " type="file" id="image">
                            <?php if($errors->has('image')): ?>
                                <div class="text-danger"><?php echo e($errors->first('image')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="Product price" class="form-label">price</label>
                            <input type="text" class="form-control  rounded-3 price" name="price" id=""
                                placeholder="Enter the price">
                            <?php if($errors->has('price')): ?>
                                <div class="text-danger"><?php echo e($errors->first('price')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>selct category</label>
                                <select class="form-control  rounded-3 categories" multiple data-live-search="true"
                                    name="category">
                                    <option value="" selected>select category</option>
                                    <?php for($i = 0; $i < count($category); $i++): ?>
                                        <option value="<?php echo e($category[$i]->id); ?>"><?php echo e($category[$i]->c_name); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <?php if($errors->has('category')): ?>
                                <div class="text-danger"><?php echo e($errors->first('category')); ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn pmd-ripple-effect btn-dark pmd-btn-flat"
                        type="button">cancel</button>
                    <button data-dismiss="modal" class="btn pmd-ripple-effect btn-primary pmd-btn-flat" id="submit"
                        type="button">submit</button>
                </div>
            </div>
        </div>
    </div>

<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Are you sure?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fa fa-times fa-4x animated rotateIn"></i>
        <p>Are you sure you want to delte this Product .This can not be undone</p>
     
        
      </div>
     
      <!--Footer-->
      <div class="modal-footer flex-center">

        <button data-dismiss="modal" class="btn pmd-ripple-effect btn-danger pmd-btn-flat" id="delete" 
        type="button">yes</button>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->

    <div class="container mb-3 ">
        <div class="row justify-content-between p-3 mb-4">
            <div class="col-5 ">
                <button data-target="#form-dialog" data-toggle="modal"
                    class="btn pmd-ripple-effect btn-primary pmd-btn-raised" type="button">Form Modal</button>
            </div>
            <div class="col-5 ">
                <a href="<?php echo e(route('categories.index')); ?>"><button type="button"> CATEGORIES</button></a>
            </div>

        </div>
    </div>
    <div class="container">

        <table class="table table-striped table-hover data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th> Actions</th>



                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('scripts'); ?>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $(document).ready(function() {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "<?php echo e(route('products.index')); ?>",
                    columns: [{
                            data: 'id',
                            name: 'id',

                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                        },
                    ]
                });
                //insert data into database 
                $(document).on('click', '#submit', function() {

                    var name = $('.name').val();
                    var description = $('.des').val();
                    var price = $('.price').val();
                    var category = $('.categories').val();
                    var image = $('.image').val();


                    console.log(name, description, price, category, image);

                    $.ajax({
                        url: "<?php echo e(route('products.store')); ?>",
                        data: $('#add_product').serialize(),
                        type: 'POST',
                        datatype: 'json',
                        success: function(data) {
                            $('#add_product').trigger('reset');
                            table.draw();

                        },
                    });
                });
            });
            //delete data from database
            $(document).on('click', '#delete', function() {
                             
                  var id = $(".product_delete").data('id');
                  console.log(id);
                    // $.ajax({
                    //     url: "<?php echo e(route('products.store')); ?>"+'/'+id,
                    //     type: 'DELETE',
                    //     success: function(data) {
                    //         table.draw();
                    //     },
                    // });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laravel\CRUD_YAJRA\resources\views\products\index.blade.php ENDPATH**/ ?>