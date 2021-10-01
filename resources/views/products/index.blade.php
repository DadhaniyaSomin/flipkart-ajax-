@extends('layouts.app')
@section('content')


    <div tabindex="-1" class="modal pmd-modal fade" id="form-dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pmd-modal-border">
                    <h2 class="modal-title">ADD SOMETHING AMAZING</h2>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                </div>
                <div class="modal-body">
                    <form id="add_product" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Product name" class="form-label">Product Name</label>
                            <input type="text" class="form-control rounded-3 name" name="name" placeholder="Enter the name">
                            @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control  rounded-3  des" name="des" rows="3"></textarea>
                            @if ($errors->has('des'))
                                <div class="text-danger">{{ $errors->first('des') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select Product image</label>
                            <input class="form-control image" name="image" type="file">
                            @if ($errors->has('image'))
                                <div class="text-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="Product price" class="form-label">price</label>
                            <input type="text" class="form-control  rounded-3 price" name="price"
                                placeholder="Enter the price">
                            @if ($errors->has('price'))
                                <div class="text-danger">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>selct category</label>
                                <select class="form-control  rounded-3 categories" multiple data-live-search="true"
                                    name="category">
                                    <option value="" selected>select category</option>
                                    @for ($i = 0; $i < count($category); $i++)
                                        <option value="{{ $category[$i]->id }}">{{ $category[$i]->c_name }}</option>
                                    @endfor
                                </select>
                            </div>
                            @if ($errors->has('category'))
                                <div class="text-danger">{{ $errors->first('category') }}</div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn pmd-ripple-effect btn-dark pmd-btn-flat"
                                type="button">cancel</button>
                            <button data-dismiss="modal" class="btn pmd-ripple-effect btn-dark pmd-btn-flat"
                                type="submit">ADD</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <div tabindex="-1" class="modal pmd-modal fade" id="update_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl-down">
            <div class="modal-content">
                <div class="modal-header pmd-modal-border">
                    <h2 class="modal-title">YOU CAN EDIT ANY TIME </h2>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                </div>
                <div class="modal-body">
                    <form class="update_product" id="simple_form" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="id" class="id" hidden>
                        <div class="mb-3">
                            <label for="Product name" class="form-label">Product Name</label>
                            <input type="text" class="form-control rounded-3 name" id="name" name="name"
                                placeholder="Enter the name">
                            @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control  rounded-3  des" id="des" name="des" rows="3"></textarea>
                            @if ($errors->has('des'))
                                <div class="text-danger">{{ $errors->first('des') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="Product price" class="form-label">price</label>
                            <input type="text" class="form-control  rounded-3 price" name="price" id="price"
                                placeholder="Enter the price">
                            @if ($errors->has('price'))
                                <div class="text-danger">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>selct category</label>
                                <select class="form-control  rounded-3 categories" multiple data-live-search="true"
                                    name="category" id="category">
                                    <option value="" selected>select category</option>
                                    @for ($i = 0; $i < count($category); $i++)
                                        <option value="{{ $category[$i]->id }}">{{ $category[$i]->c_name }}</option>
                                    @endfor
                                </select>
                            </div>
                            @if ($errors->has('category'))
                                <div class="text-danger">{{ $errors->first('category') }}</div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn pmd-ripple-effect btn-dark pmd-btn-flat"
                                type="button">cancel</button>
                            <button data-dismiss="modal" class="btn pmd-ripple-effect btn-dark pmd-btn-flat update"
                                type="submit">update</button>
                        </div>
                    </form>
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
                    class="btn pmd-ripple-effect btn-primary pmd-btn-raised" type="button">ADD producst</button>
            </div>
            <div class="col-5 ">
                <a href="{{ route('categories.index') }}"><button type="button"> CATEGORIES</button></a>
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
                    <th>image</th>
                    <th> Actions</th>



                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    @endsection

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('products.index') }}",
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
                            data: "image",
                            "render": function(data, type, row) {
                                return '<img src="image/' + data + '" width="100px" />';
                            },
                            name: 'image'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                        },
                    ]
                });



                //insert data into database 
                $('#add_product').on('submit', (function(e) {
                    e.preventDefault();
                    var name = $('.name').val();
                    var description = $('.des').val();
                    var price = $('.price').val();
                    var category = $('.categories').val();
                    var image = $('.image').val();
                    console.log(name, description, price, category, image);
                    var formData = new FormData(this);




                    $.ajax({

                        url: "{{ route('products.store') }}",
                        data: formData,
                        type: 'POST',
                        datatype: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#add_product').trigger('reset');
                            table.draw();
                            ("#form-dialog").display.none();
                        },
                    });
                }));

                //delete data from database
                $(document).on('click', '.product_delete', function(e) {
                    var id = $(this).data('id');
                    console.log(id);

                    $('#delete').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "{{ url('products') }}" + '/' + id,
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                'id': id,
                                _token: "{{ csrf_token() }}",
                                _method: "DELETE"
                            },
                            success: function(data) {
                                table.draw();

                            },
                        });

                    });
                });

                //edit image from the database
                $(document).on('click', '.product_edit', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        url: "{{ url('products') }}" + '/' + id + "/edit",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            'id': id,
                        },
                        success: function(data) {
                            $('#id').val(data.id);
                            $('#name').val(data.name);
                            $('#des').val(data.description);
                            $('#price').val(data.price);
                            $('#category').val(data.category);
                        }

                    });

                });

                //update the data
                $(document).on('click', '.update', (function(e) {
                    e.preventDefault();
                        $('#simple_form input  , #simple_form textarea').jqBootstrapValidation({
                            var id = $('#id').val();
                            var name = $('#name').val();
                            var description = $('#des').val();
                            var price = $('#price').val();
                            var category = $('#category').val();

                            console.log(name, description, price, category, id);
                            //var formData = new FormData(this);
                            $.ajax({
                                url: "{{ url('products') }}" + '/' + id,
                                data: {
                                    name: name,ss
                                    description: description,
                                    price: price,
                                    category: category,
                                    _token: "{{ csrf_token() }}",
                                    _method: 'PATCH',

                                },
                                type: 'POST',
                                datatype: 'json',
                                success: function(data) {
                                    $('#add_product').trigger('reset');
                                    table.draw();
                                    // ("#form-dialog").display.none();
                                },
                            });
                        });

                }));
            });
        </script>
    @endpush
